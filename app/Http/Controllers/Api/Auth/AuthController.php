<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\ProfileResource;
use App\Models\AgentWalletBalance;
use App\Models\ConsumedOtp;
use App\Models\User;
use App\Models\UserType;
use App\Models\WorkerWalletBalance;
use App\Traits\Api\ApiSharedTrait;
use App\Traits\Api\SendSms;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    use ApiSharedTrait;
    use SendSms;
    public function __construct(User $user, ConsumedOtp $otp, UserType $user_types)
    {
        $this->user = $user;
        $this->otp = $otp;
        $this->user_types = $user_types;
        $this->otpMinute = 5;
    }

    public function customerToken(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'mobile' => 'required|numeric', //|exists:users,mobile
        ]);
        // dd($request->all());
        if ($request->mobile) {
            $user = $this->user->where('mobile', $request->mobile)->with('userCategory')->first();
            // dd($user);
            if ($user) {
                if ($user->userCategory->type != 'customer') {
                    return response()->json([
                        'status' => false,
                        "status_code" => 403,
                        "message" => ['This number is not available for service.'],
                    ], 403);
                }
            }
        }

        if ($validation->fails()) {
            // dd($validation);
            return response()->json([
                'status' => false,
                "status_code" => 422,
                "message" => mapErrorMessage($validation),
            ], 422);
        }

        if (isset($user) && $user->userCategory->type != 'customer') {
            return response()->json([
                'status' => false,
                'status_code' => 403,
                'message' => ['You do not have permission to access here'],
            ], 403);
        }

        $otp = $this->getOtp();
        // dd($otp);
        DB::beginTransaction();
        try {
            if (!$user) {
                $this->create_customer($request, $otp);
                // $response = $this->sendSMS($request->mobile, $otp);
                // // dd($response);
                // if($response != 200){
                //     abort(502, 'There was a Problem While Sending OTP.' );
                // }
                // ($response == 200) ? $msg = 'OTP is send in your mobile' : $msg = 'There was a Problem While Sending SMS';
            } else {
                // $response = $this->sendSMS($request->mobile, $otp);
                // if($response != 200){
                //     abort(502, 'There was a Problem While Sending OTP.' );
                // }
                $otp_data = [
                    'userId' => $user->id,
                    'otp' => Hash::make($otp),
                    'purpose' => 'customer_login',
                ];
                $this->otp->create($otp_data);
            }
            DB::commit();
            return response()->json([
                "status" => true,
                "status_code" => 201,
                "otp" => $otp,
                'message' => 'OTP has been sent to your mobile',
            ], 201);
        } catch (\Exception $error) {
            DB::rollback();
            return response()->json([
                "status" => false,
                "status_code" => 502,
                'message' => [$error->getMessage()],
            ], 502);
        }
    }

    public function customerLogin(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'mobile' => 'required|numeric|exists:users,mobile',
            'otp' => 'required|digits:6',
        ]);
        if ($validation->fails()) {
            // dd($validation);
            return response()->json([
                'status' => false,
                "status_code" => 422,
                "message" => mapErrorMessage($validation),
            ], 422);
        }

        $user = $this->user->where('mobile', $request->mobile)
            ->with(['userOtp' => function ($qr) {
                return $qr->where('purpose', 'customer_login')->latest();
            }, 'userCategory' => function ($qr) {
                return $qr;
            }])
            ->first();

        // dd($user);
        // dd($user->userCategory->userId);
        if ($user->userCategory->type != 'customer') {
            return response()->json([
                'status' => false,
                'status_code' => 403,
                'message' => ['You do not have permission to access here'],
            ], 403);
        }
        // dd($user);
        // dd( $this->authenticateOtp($request, $user));
        if (!$user ||  $this->authenticateOtp($request, $user)) {
            return response()->json([
                "status" => false,
                "status_code" => 401,
                'message' => ['These credentials do not match our records'],
            ], 401);
        }
        if (now()->diffInMinutes($user->userOtp->created_at) > 10) {
            return response()->json([
                'status' => false,
                'status_code' => 422,
                'message' => ['OTP has Expired.'],
            ], 422);
        }
        DB::beginTransaction();
        try {
            $token = $user->createToken($request->mobile, ['customer:all'])->plainTextToken;

            $this->otp->where('userId', $user->id)->where('purpose', 'customer_login')->delete();
            DB::commit();
            return response([
                "status" => true,
                "status_code" => 201,
                // 'data' => new CustomerResource($user),
                'token' => $token,
            ], 201);
        } catch (\Exception $error) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'status_code' => 502,
                'message' => [$error->getMessage()],
            ], 502);
        }
    }

    private function create_customer($request, $otp)
    {
        // $refer_by = $this->user->where('referrer', $request->referrer)->first();
        // referal_code

        $data = [
            'mobile' => $request->mobile,
            'name' => [
                'en' => @$request->name,
                'np' => @$request->name,
            ],
            'email' => @$request->email,
        ];
        try {
            // $data['otp'] = Hash::make($otp);
            // $data['otp_created_at'] = date('Y-m-d H:i:s');
            $user = $this->user->create($data);
            $otp = [
                'userId' => $user->id,
                'otp' => Hash::make($otp),
                'purpose' => 'customer_login',
            ];
            $user_type = [
                'userId' => $user->id,
                'type' => 'customer',
            ];
            $this->user_types->create($user_type);
            $this->otp->create($otp);
            return true;
        } catch (\Exception $error) {
            return false;
        }
    }

    private function username($name)
    {
        $username = \Str::slug($name);
        $user = $this->user->where('username', $username)->first();
        if ($user) {
            $username = $username . '_' . rand(4444, 9999);
        }
        return $username;
    }

    public function signup(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'email' => 'nullable|email:rfc,dns|unique:users,email,',
            "mobile" => "required|numeric|unique:users,mobile",
            "password" => "required|string|min:8|confirmed",
            "type"      => "required|string|in:agent,wholesaler,worker",
            "otp" => "required",
        ]);
        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                "status_code" => 422,
                "message" => mapErrorMessage($validation),
            ], 422);
        }

        // {{-- Checking for valid otp --}}
        $validOtp = $this->otp::where('mobile', $request->mobile)->latest()->first();

        if (!$validOtp) {
            return response()->json([
                'status' => false,
                "status_code" => 422,
                "message" => ['Invalid Otp.']
            ], 422);
        }
        if (!Hash::check($request->otp, $validOtp->otp)) {
            return response()->json([
                'status' => false,
                "status_code" => 422,
                "message" => ['Invalid Otp.']
            ], 422);
        }
        if (!$validOtp->created_at->gt(now()->subMinutes($this->otpMinute))) {
            return response()->json([
                'status' => false,
                "status_code" => 422,
                "message" => ['Otp has expired.']
            ], 422);
        }

        $data = $request->only('email', 'mobile');
        $data['name'] = [
            'en' => $request->name,
            'np' => $request->name,
        ];
        $username = $this->username($request->name);
        $data['username'] = $username;
        $data['password'] = Hash::make($request->password);
        DB::beginTransaction();
        try {
            $user = User::create($data);
            UserType::create([
                'userId' => $user->id,
                'type' => $request->type ?? 'worker',
            ]);
            $this->createWallet($request, $user);
            DB::commit();
            return response()->json([

                "status" => true,
                'status_code' => 200,
                'message' => 'Your Account created Successfully',
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'status_code' => 502,
                "message" => [$e->getMessage()],
            ], 502);
        }
        // $user = auth()->user();

    }
    protected function createWallet($request, $user)
    {

        if ($request->type == 'agent') {
            $wallet = [
                'agentId' => $user->id,
                'balance' => 0
            ];
            AgentWalletBalance::create($wallet);
        } else if ($request->type == 'worker') {
            $wallet = [
                'workerId' => $user->id,
                'balance' => 0
            ];
            WorkerWalletBalance::create($wallet);
        } else if ($request->type == 'wholesaler') {
            $wallet = [
                'wholesaler' => $user->id,
                'balance' => 0
            ];
        }
    }
    public function login(Request $request)
    {

        return $this->loginByUserPassword($request);

        // dd($request->all());
    }



    public function changePassword(Request $request)
    {
        // dd(auth()->user());
        $validation = Validator::make($request->all(), [
            'old_password' => 'required|string',
            "password" => "required|string|min:8|max:32|confirmed",
        ]);
        if ($validation->fails()) {
            // dd($validation);
            return response()->json([
                'status' => false,
                "status_code" => 422,
                "message" => mapErrorMessage($validation),
            ], 422);
        }
        $auth_user = $request->user();
        $user = User::where('id', $auth_user->id)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'status_code' => 404,
                "message" => ['Rider information not found.'],

            ], 404);
        }
        if ($user->type != 'rider') {
            return response()->json([
                'status' => false,
                "status_code" => 403,
                "message" => ['Unauthorized access.'],
            ], 403);
        }
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                "status" => false,
                'status_code' => 422,
                'message' => ['Old password does not match'],
            ], 422);
        }
        if (Hash::check($request->password, $user->password)) {
            return response()->json([
                "status" => false,
                'status_code' => 422,
                'message' => ['You already have used this password in your history.'],
            ], 422);
        }

        $user->password = Hash::make($request->password);
        try {
            $user->save();
            return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => "Your password successfully changed.",
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'status' => false,
                'status_code' => 502,
                'message' => [$error->getMessage()],
            ], 502);
        }
    }
    protected function loginByUserPassword($request)
    {
        $validation = Validator::make($request->all(), [
            'mobile' => 'required|numeric|exists:users,mobile',
            "password" => "required|string|min:8",
        ]);
        if ($validation->fails()) {
            // dd($validation);
            return response()->json([
                'status' => false,
                "status_code" => 422,
                "message" => mapErrorMessage($validation),
            ], 422);
        }

        // dd($request->mobile);
        // $password = Hash::make($request->password);
        $user = $this->user->where('mobile', $request->mobile)
            ->with(['userCategory'])
            ->first();
        if ($user->userCategory->type != 'agent') {
            return response()->json([
                'status' => false,
                'status_code' => 403,
                'message' => ['You do not have permission to access here'],
            ], 403);
        }
        // dd($user);
        // dd($request->all());
        // dd($user);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "status" => false,
                "status_code" => 401,
                'message' => ['Username/Mobile or password credentials do not match our records'],
            ], 401);
        }
        $token = $user->createToken($request->mobile, ['reseller:all'])->plainTextToken;
        // $user->name = $user->name ;
        return response([
            "status" => true,
            "status_code" => 201,
            "user" => new ProfileResource($user),
            'token' => $token,
        ], 201);
    }
    /**
     * Customer Logout
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens->each->delete();

        return response()->json([
            "status" => true,
            "status_code" => 200,
            'message' => 'You are Logged out.',
        ], 200);
    }
}
