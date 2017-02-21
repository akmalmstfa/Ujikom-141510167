<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;

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
	        }else {
                $error = FALSE;
            }

	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

	        return response()->json(['token_expired'], $e->getStatusCode());

	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

	        return response()->json(['token_invalid'], $e->getStatusCode());

	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

	        return response()->json(['token_absent'], $e->getStatusCode());

	    }

	    // the token is valid and we have found the user via the sub claim
        // $user['name'] = 'dummy';
        // echo json_encode($user);
	    return response()->json([
            'error'=> FALSE,
            'user'=>$user
            ]);
	}
}
