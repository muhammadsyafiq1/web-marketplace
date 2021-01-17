<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', '=', $request->email)->first();
        $status = "error";
        $message = "";
        $data = null;
        $code = 401;
        if($user){
            if(Hash::check($request->password, $user->password)){
                $user->generateToken();
                $status = 'success';
                $message = 'Login sukses';
                $data = $user->toArray();
                $code = 200;
            } else {
                $message = "Login gagal, Password anda salah";
            }
        } else {
            $message = "Login gagal, email yang anda masukan salah";
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'max:100', 'confirmed'],
            'store_name' => ['nullable', 'string', 'max:50'],
            'category_id' => ['nullable', 'integer'],
            'store_status' => ['integer']
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            return response()->json([
                'data' => [
                    'message' => $errors,
                ]
            ], 400);
        }
        else {
            $user = new User;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->roles = $request->roles;
            $user->store_status = $request->store_status;
            $user->category_id = $request->category_id;

            if($user) {
                $user->generateToken();
                $status = "success";
                $message = "register successfully";
                $data = $user->toArray();
                $code = 200;
            }
            else {
                $message = "register failed";
            }
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if($user){
            $user->api_token = null;
            $user->save();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil',
            'data' => null
        ], 200);
    }
}
