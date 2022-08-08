<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function Login(Request $request)
    {
        try {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['validation_errors'=>$validator->errors(),'status'=> 401]);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken($user->email.'_Token')->plainTextToken;
                $logged_user = [ "id" => $user->id ,'name' =>$user->name ];
                return response()->json([
                    'status'=> 200,
                    'token' => $token,
                    'logged_user'=>$logged_user,
                     'message'=> 'Logged In successfully'
                    ]);
            } else {
                return response()->json(['error'=>'Check email and password']);
            }
        } else {
            return response()->json(['error'=>'email dose not exist']);
        }
    } catch (Throwable $th) {
        throw $th;
    }
    }



    public function logout(Request $request)
    {
        // return $request->all();
        try {
            $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Successfully logged out'
        ]);
    } catch (Throwable $th) {
        // dd($th);
        throw $th;
    }
    }
}
