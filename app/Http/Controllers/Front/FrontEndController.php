<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Agent\AgentProfile;
use App\Models\Agent\ShipmentPackage;
use App\Models\UserType;
use App\Traits\SharedTrait;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\User;
use App\Models\Menu;
use App\Models\Team;
use App\Models\AppSetting;
use App\Models\Contact;
use App\Models\Feature;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Constraint\Count;
use Spatie\Permission\Models\Role;

class FrontEndController extends Controller
{

    public function home()
    {
        return view('website.index');
    }
    public function searchResult(Request $request)
    {
        if (isset($id)) {
            $shipmentPackage_info = ShipmentPackage::where('barcode', $id)->first();
            if (!$shipmentPackage_info) {
                abort(404);
            }
            $total = $shipmentPackage_info->shipping_charge + $shipmentPackage_info->gov_tax + $shipmentPackage_info->service_agent_charge + $shipmentPackage_info->service_charge;
        }
        $data = [
            'shipmentPackage_info' => $shipmentPackage_info ?? null,
        ];
        return view('website.index', $data);
    }

    public function register()
    {
        $countries = Country::pluck('name', 'id');
        $data = [
            'countries' => $countries,
        ];
        return view('website.agent-register', $data);
    }

    public function storeAgent(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required|string|max:190',
            'en_name' => 'required|string|max:190',
            'address' => 'required|string|max:190',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'country' => 'required|exists:countries,id',
            'state' => 'nullable|string|max:190',
            'city' => 'required|string|max:190',
            'designation' => 'nullable|string|max:190',
            // 'postalcode' => 'required|numeric',
            'mobile' => 'required|numeric',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $data = $request->only('email', 'mobile');

        $data['name'] = [
            'en' => $request->en_name,
            'np' =>$request->en_name,
        ];
        $data['password'] = Hash::make($request->password);
        // $data['currentAddress'] = $request->address;
        DB::beginTransaction();
        try {
            $role = Role::where('name', 'Agent')->first();
            $agent = User::create($data);

            $agent->assignRole([$role->id]);
            $data_UserType = [
                'userId' => $agent->id,
                'typeId' => USER_TYPE['agent'],
            ];
            $data_AgentProfile = [
                'userId' => $agent->id,
                'company_name' => $request->company_name,
                'state' => $request->state,
                'city' => $request->city,
                'country' => $request->country,
                'address' => $request->address,
                'phone' => $request->companyPhone,
                'designation' => $request->designation,
                'twitter' => $request->twitter,
                'facebook' => $request->facebook,
                'website' => $request->website,
                'accountant_name' => $request->accountant_name,
                'accountant_email' => $request->accountant_email,
                'accountant_phone' => $request->accountant_phone,
            ];
            UserType::create($data_UserType);
            AgentProfile::create($data_AgentProfile);

            DB::commit();
            $request->session()->flash('success', 'Agent profile created successfully.');
            return redirect()->back();
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    protected function generateAccountNumber(){
        $number = mt_rand(1000000000, 9999999999);

        if ($this->checkAccountExist($number)) {
            return $this->generateAccountNumber();
        }

        return $number;
    }
    protected function checkAccountExist($number) {

        return User::where('accountNumber',$number)->exists();
    }
    public function getPage($pagedata = null)
    {
        $menu = Menu::where('slug', $pagedata)->first();
        if (!$menu) {
            abort(404);
        }
        $pagedata = $menu;

        if ($pagedata != null) {
            $pagevalue = @$pagedata->content_type;
            switch ($pagevalue) {
                case 'about':
                    $meta = $this->getMetaData($pagedata);
                    return view('website.pages.about', compact('pagedata', 'meta'));
                    break;
                case 'service':
                    $meta = $this->getMetaData($pagedata);
                    $services = Feature::where('publish_status', 1)->paginate(6);
                    return view('website.pages.services', compact('pagedata', 'meta', 'services'));
                    break;

                case 'tracking':
                    $meta = $this->getMetaData($pagedata);
                    return view('website.pages.tracking', compact('pagedata', 'meta'));
                    break;

                case 'contact':
                    $setting = AppSetting::orderBy('created_at', 'desc')->first();
                    $meta = $this->getMetaData($pagedata);

                    return view('website.pages.contact', compact('setting', 'pagedata', 'meta'));
                    break;

                case 'team':
                    $meta = $this->getMetaData($pagedata);
                    $teams =  Team::select(
                        'teams.designation_id',
                        'teams.full_name',
                        'teams.id',
                        'teams.image',
                        // "designations.title"
                    )
                        ->leftJoin('designations', 'designations.id', 'teams.designation_id')
                        ->with('designation:id,title,position')
                        ->orderBy('designations.position', 'ASC')
                        ->where('teams.publish_status', '1')
                        ->get();


                    return view('website.pages.team', compact('pagedata', 'meta', 'teams'));
                    break;

                case 'basicpage':
                    $meta = $this->getMetaData($pagedata);

                    return view('website.pages.basicpage', compact('pagedata', 'meta'));
                    break;

                default:
                    return redirect()->route('index');
                    break;
            }
        } else {
            return redirect()->route('index');
        }
    }
    protected function getMetaData($pagedata = null)
    {
        $website = AppSetting::select('*')->orderBy('created_at', 'desc')->first();

        $meta = [
            'meta_title' => @$pagedata->meta_title ?? @$website->meta_title ?? 'air logistics',
            'meta_keyword' => @$pagedata->meta_keyword ?? @$website->meta_keyword ?? 'air logistics',
            'meta_description' => @$pagedata->meta_description ??  @$website->meta_description ?? 'air logistics',
            'meta_keyphrase' =>@$pagedata->meta->keyphrase ?? @$website->meta->keyphrase ?? 'air logistic',
            'og_image' => @$pagedata->featured_img_url ?? create_image_url($website->og_image, 'same') ?? create_image_url($website->logo_url, 'banner') ?? 'og_image',
        ];
        return $meta;
    }
    public function contactSubmit(Request $request)
    {
        try {
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);
            $details = [
                'title' => 'Mail from Air Logistic Group',
                'body' => 'We have got your message. We will get back to you soon!'
            ];

            Mail::to($request->email)->send(new \App\Mail\ContactMail($details));
            return response()->json([
                'status' => true,
                'message' => ['Contact Detail Submitted Successfully']
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => true,
                'message' => ['Form not submitted: ' . $e->getMessage()]
            ], 400);
        }
    }
}
