<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Otpverifay;

class HomeController extends Controller
{
    public function login(Request $request)
    {
        if ($request->type == "mobile") {
            $user = User::where('mobile_number', $request->user_data)->get();
            if (count($user) > 0) {
                $userjwt = User::find($user[0]['id']);
                $token = JWTAuth::fromUser($userjwt);
                return response()->json(['message' => "Successfully", 
                    'status' => 200,
                    'loginType' => '2',
                    '_token' => $token,
                    'userid' => $user[0]['id']
                ], 200);
            } else {
                $otpverifay = new Otpverifay();
                $otpverifay->user_data = $request->user_data;
                $otpverifay->otp = 123456;
                $otpverifay->save();

                return response()->json(['message' => "Successfully", 
                    'status' => 200,
                    'loginType' => '1',
                    'userid' => $otpverifay->id,
                    'otp' => '123456'
                ], 200);
            }
        } else if ($request->type == "email") {
            $user = User::where('email', $request->user_data)->get()->toArray();
            if (count($user) > 0) {
                $userjwt = User::find($user[0]['id']);
                $token = JWTAuth::fromUser($userjwt);
                return response()->json(['message' => "Successfully", 
                    'status' => 200,
                    'loginType' => '2',
                    '_token' => $token,
                    'userid' => $user[0]['id']
                ], 200);
            } else {
                $otpverifay = new Otpverifay();
                $otpverifay->otp = 123456;
                $otpverifay->user_data = $request->user_data;                
                $otpverifay->save();

                return response()->json(['message' => "Successfully", 
                    'status' => 200,
                    'loginType' => '1',
                    'userid' => $otpverifay->id,
                    'otp' => '123456'
                ], 200);
            }
        }

        return response()->json(['error' => 'Unauthorized', 'status' => 400,], 401);
    }

    public function otpverifay(Request $request)
    {
        $otpverifay = Otpverifay::where(['id'=>$request->userid])->get();
        if(count($otpverifay) > 0) {
            $data = Otpverifay::find($otpverifay[0]['id']);
            $data->status = 1;
            $data->save();

            if($otpverifay[0]['otp'] == $request->otp){
                if ($request->type == "mobile") {
                    $user = new User();
                    $user->mobile_number = $request->user_data;
                    $user->save();

                    $user = User::where('mobile_number', $request->user_data)->get();
                    $userjwt = User::find($user[0]['id']);
                    $token = JWTAuth::fromUser($userjwt);
                    return response()->json(['message' => "Successfully",
                        'status' => 200, 
                        '_token' => $token,
                        'userid' => $user[0]['id']
                    ], 200);
                } else if ($request->type == "email") {
                    $user = new User();
                    $user->email = $request->user_data;
                    $user->save();

                    $user = User::where('email', $request->user_data)->get();
                    $userjwt = User::find($user[0]['id']);
                    $token = JWTAuth::fromUser($userjwt);
                    return response()->json(['message' => "Successfully", 
                        'status' => 200, 
                        '_token' => $token,
                        'userid' => $user[0]['id']
                    ], 200);
                }
            } else {
                return response()->json(['message' => "OTP not match", 
                    'status' => 400, 
                ], 200);
            }
        } else {
            return response()->json(['message' => "User does not exist", 
                'status' => 400, 
            ], 200);
        }

        return response()->json(['error' => 'Unauthorized', 'status' => 400], 401);
    }

    public function viewprofile(Request $request)
    {
        $user = User::where('id', $request->userid)->get();
        if (count($user) > 0) {
            return response()->json(['message' => "Successfully", 'status' => 200, 'data' => $user], 200);
        } else {
            return response()->json(['message' => "Invalide User Id", 'status' => 400, 'data' => []], 200); 
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function socialmediaSignin(Request $request)
    {
        try {
            $social = $request->user_data;
            if(filter_var("$social", FILTER_VALIDATE_EMAIL)) {
                $user = new User();
                $user->email = $social;
                $user->save();

                $user = User::where('email', $social)->get();
                $userjwt = User::find($user[0]['id']);
                $token = JWTAuth::fromUser($userjwt);
                return response()->json(['message' => "Successfully",
                    'status' => 200, 
                    '_token' => $token,
                    'userid' => $user[0]['id']
                ], 200);
            }
            else {
                $user = new User();
                $user->mobile_number = $social;
                $user->save();

                $user = User::where('mobile_number', $social)->get();
                $userjwt = User::find($user[0]['id']);
                $token = JWTAuth::fromUser($userjwt);
                return response()->json(['message' => "Successfully",
                    'status' => 200, 
                    '_token' => $token,
                    'userid' => $user[0]['id']
                ], 200); 
            }           
        } catch (Exception $e) {
             return response()->json([ 
                'status' => 400,
                'message ' => 'Something went wrong...!',
                'error_code' => 'COMMON_ERROR',
            ]);
        }
    }

    public function editprofile(Request $request)
    {
        try {
            $user = User::find($request->id);
            if (request()->hasFile('file')) { 
                $file = $request->file('file');
                $file_name = strtolower(rand(1000,9999).time().'.'.$file->getClientOriginalExtension());
                $file->move(public_path('/user_image'),$file_name);
                $user->image = $file_name;
            }
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->mobile_number= $request->mobile_number;
            $user->save();
            return response()->json(['status' => 200,
                'data' => $user,
                'message' => 'Sucessfully edit profile'
            ]);

        }catch(Exception $e) {
            return response()->json(['status'=>false,'message'=>'BlogGallary not created successfully','error_code'=>'COMMON_ERROR']);
        }
        
    }
}
