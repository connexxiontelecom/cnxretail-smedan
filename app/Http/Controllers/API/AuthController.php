<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function authenticate(Request $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'success'=> false,
                'code'=> 400,
                'message' => $validator->errors()->first(),
                'data'=>""
            ]);
        }

        //Request is validated
        try {
            //throw new \Exception("Some error message");
            //Create token
            //$token =  auth('api')->attempt($credentials);//attempt($credentials);
            $myTTL = 10080; //minutes
            JWTAuth::factory()->setTTL($myTTL);
            $token =  JWTAuth::attempt($credentials);
            if (!$token) {
                return response()->json([
                    'success'=> false,
                    'code'=> 400,
                    'message' => "Login credentials are invalid.",
                    'data'=>''
                ]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'success'=> false,
                'code'=> 500,
                'message' => "Could not create token",
                'data'=>''
            ]);
        }

        //Token created, return with success response and jwt token
        return response()->json([
            'success'=> true,
            'code'=> 200,
            'message' => "Login successful",
            'data'=> ["token"=>$token, 'user'=> Auth::user()]
        ]);


    }

    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'success'=> false,
                'code'=> 400,
                'message' => $validator->errors()->first(),
                'data'=>""
            ]);
        }
        //Request is validated, do logout
        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'code'=> 200,
                'message' => 'User has been logged out',
                'data'=>""
            ]);
        } catch (JWTException $exception) {

            return response()->json([
                'success' => false,
                'code'=> 500,
                'message' => 'Sorry, user cannot be logged out',
                'data'=>""
            ]);

        }
    }

    public function getUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        $user = (new \PHPOpenSourceSaver\JWTAuth\JWTAuth)->authenticate($request->token);
        return response()->json(['user' => $user]);
    }
}
