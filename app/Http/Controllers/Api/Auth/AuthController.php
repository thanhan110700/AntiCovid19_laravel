<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        # code...
        $creds = $request->only(['sodienthoai','password']);      

        if(!$token=auth()->attempt($creds)){
            return response()->json([
                'success'=>false,
                'message'=>"validate false"]);
        }
        return response()->json(['success'=>true,'token'=>$token,'user'=>Auth::user()]);
    }

    public function checksodienthoai(Request $request)
    {
      $checktaikhoan = User::where('sodienthoai',$request->sodienthoai)->first();
         if($checktaikhoan= User::where('sodienthoai',$request->sodienthoai)->first()){
            return "ok";
        }
        else return "no";
        
        # code...
    }
    public function register(Request $request)
    {
        # code...
        $encrypterPass = Hash::make($request->password);
        
        $user = new User;
        try {
            $user->name = $request->name;
            $user->sodienthoai = $request->sodienthoai;
            $user->password = $encrypterPass;
            $user->save();
            return $this->login($request);
        } catch (Exception $e) {
            return response()->json([
                'success'=>false,
                'message'=>$e
            ]);
        }
    }
    public function logout(Request $request)
    {
        # code...
        try {
            
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));
            return response()->json([
                'success'=>true,
                'message'=>'logout success'
            ]);
        } catch (Exception $e) {
            response()->json([
                'success'=>false,
                'message'=>$e
            ]);
        }
    }
}
