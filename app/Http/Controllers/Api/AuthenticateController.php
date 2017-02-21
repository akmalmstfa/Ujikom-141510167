<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;
use App\Pegawai;

class AuthenticateController extends Controller
{
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(["error" => TRUE,"error_msg" => "Email atau password salah. tolong coba lagi!"]);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(["error" => TRUE,"error_msg" =>"Tidak bisa membuat token"]);
        }

        // all good so return the token
        // return response()->json(compact('token'));
        // dd($credentials);
        return redirect(url('api/auth/me?token={'.$token.'}'));
    }

    
	public function getAuthenticatedUser()
	{
	    try {

	        if (! $user = JWTAuth::parseToken()->authenticate()) {
	            return response()->json(["error" => TRUE,"error_msg" =>'user_not_found']);
	        }

	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

	        return response()->json(["error" => TRUE,"error_msg" =>'token_expired']);

	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

	        return response()->json(["error" => TRUE,"error_msg" =>'token_invalid']);

	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

	        return response()->json(["error" => TRUE,"error_msg" =>'token_absent']);

	    }
        // $pegawai = Pegawai::where('user_id',$user->id)->first();
        // dd(asset('/image/'.$pegawai->Photo));
        // $user['photo_url'] = asset('/image/'.$pegawai->Photo);
	    // the token is valid and we have found the user via the sub claim
        // $user['name'] = 'dummy';
        // echo json_encode($user);
	    return response()->json([
            'error'=> FALSE,
            'user'=>$user
            ]);
	}
}
