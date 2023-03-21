<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'username' => 'required',
            'email'=>'required|email',
            'password'=>'required',
            'gender'=>'required',
        ]);
        if(User::where('email', $request->email)->first()){
            return response()->json([
                'message' => 'email already exists',
                'status'=>'failed'
            ],200);
        }

        $user = User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
           'gender' =>($request->type == "male") ? 'male' : 'female',

        ]);
        $token = $user->createToken($request->email)->plainTextToken;
        return response()->json([
            'token'=>$token,    
            'message' => 'registration success',
            'status'=>'success'
        ],201);
    }


    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $user= User::where('email',$request->email)->first();
        if($user && Hash::check($request->password, $user->password)){
            $token = $user->createToken($request->email)->plainTextToken;
            return response()->json([
                'token'=>$token,
                'message'=>'login success',
                'status'=>'success',
                'user'=>$user
            ],200);
            }
            return response()->json([
                'message' => 'The Provided Credentials are incorrect',
                'status'=>'failed'
            ],401);
    }
    public function getuserdata(Request $request){
        $authdata = User::find($request->id);
        return response()->json($authdata);
    }

    public function getalldata(Request $request){
        $alluser = User::get();
        return  response()->json($alluser);
    }


    public function updateuser(Request $request)
    {
        $employee = User::find($request->id);
        $employee->isactive = $request->isactive;
        $employee->role = $request->role;
        $employee->save();
        return response()->json([
            'employee'=>$employee,    
            'message' => 'update success',
            'status'=>'success'
        ],200);   
    }

}
