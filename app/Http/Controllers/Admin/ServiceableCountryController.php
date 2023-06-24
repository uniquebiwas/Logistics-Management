<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ServiceableCountry;
use App\Models\Country;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceableCountryController extends Controller
{
    //
    public function __construct(Country $country, ServiceableCountry $serviceable_country)
    {
        $this->country = $country;
        $this->serviceable_country = $serviceable_country;
    }
    public function index(Request $request)
    {
        $serviceable_country = $this->serviceable_country
        ->select('countries.id' ,'countries.name')
        ->leftJoin('countries', 'countries.id', 'serviceable_countries.countryId')
        ->orderBy('countries.id', 'DESC')
        ->paginate(20);
        $data =  [
            'countries' => $serviceable_country
        ];
        return view('admin/serviceable-country/list', $data);
    }
    public function editCountries(Request $request){
        $all_countries= $this->country->pluck('name', 'id');
        // dd($all_countries);
        $serviceable_country = $this->serviceable_country->pluck('countryId');
        $data=  [
            'serviceable_country' => $serviceable_country,
            'all_countries' => $all_countries,
            "title" => "update country list"
        ];
        return view('admin/serviceable-country/create',$data);
    }
    public function updateCountries(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'countries.*' => "nullable|numeric|exists:countries,id"
        ]);
        DB::beginTransaction();
        try {


            if($request->countries && count($request->countries) > 0){
                foreach($request->countries as $country){
                    $serviceable_country =  $this->serviceable_country->where('countryId', $country)->first();
                    if( !$serviceable_country){
                        $data = [
                            'countryId' => $country, 
                        ];
                        
                        $this->serviceable_country->fill($data)->save();
                    }
                }
                $this->serviceable_country->whereNotIn('countryId', $request->countries)->delete();
            }else {
             $this->serviceable_country->delete();   
            }
            DB::commit();

            $request->session()->flash('success', "Serviceable country list updated successfully.");
            return redirect()->route('serviceable-country.index');
        }catch(Exception $error){
            DB::rollback();
            $request->session()->flash('error',$error->getMessage());
            return redirect()->back();
        }
        
    }
}
