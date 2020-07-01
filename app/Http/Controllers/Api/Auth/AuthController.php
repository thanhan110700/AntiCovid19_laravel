<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\phananh;
use App\thongtinnguoidung;
use App\thongtinnguoidung2;
use App\khaibaotiepxuc;
use App\nguoithan;
use App\thongtinbenhcanhan;
use App\theodoisuckhoe;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;
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
            return response()->json([
                'success'=>false,
                'message'=>$e,
                'token'=>$request->token
            ]);
        }
    }


    public function getKhaibaoDK(Request $request){
        $hovaten = $request->hovaten;
        $CMT = $request->CMT;
        $BHXH = $request->BHXH;
        $ngaysinh = $request->ngaysinh;
        $gioitinh = $request->gioitinh;
        $quoctich = $request->quoctich;
        $diachi = $request->diachi;
        $sodienthoai = $request->sodienthoai;
        $email = $request->email;
        $checkCMT = User::where('CMT',$CMT)->first();
        $encrypterPass = Hash::make($request->password);
        
        if($hovaten == null  || $CMT == null || $ngaysinh == null || $gioitinh == null || $quoctich == null || $diachi == null || $sodienthoai == null){
            return response()->json([
                'success'=>false,
                'CMT'=>"null"
                ]);
        }
        else{
            if($checkCMT){
                return response()->json([
                    'success'=>false,
                    'CMT'=>'Exist'
                    ]);
            }
            else{
                $insertUser= DB::table('users')->insert(["CMT"=>$CMT,
                                                         "name"=>$hovaten,
                                                         "sodienthoai"=>$sodienthoai,
                                                         "password"=>$encrypterPass

                                                        ]);
                $insertthongtincanhan = DB::table('thongtinnguoidung')->insert(['hovaten'=>$hovaten,
                                                                                'CMT'=>$CMT,
                                                                                'BHXH'=>$BHXH,
                                                                                'ngaysinh'=>$ngaysinh,
                                                                                'gioitinh'=>$gioitinh,
                                                                                'quoctich'=>$quoctich,
                                                                                'diachi'=>$diachi,
                                                                                'sodienthoai'=>$sodienthoai,
                                                                                'email'=>$email]);
                if($insertthongtincanhan){
                    $insertthongtinbenhcanhan = DB::table('thongtinbenhcanhan')->insert([
                                                                                        'CMT'=>$CMT,
                                                                                        'tinhhinh'=>$request->tinhhinh,
                                                                                        'didenvungquocgia'=>$request->didenvungquocgia,
                                                                                        'dauhieu'=>$request->dauhieu,
                                                                                        'macbenh'=>$request->macbenh
                                                                                        ]);
                    if($insertthongtinbenhcanhan){
                         
                        $creds = $request->only(['sodienthoai','password']);      
                        if(!$token=auth()->attempt($creds)){
                            return response()->json([
                                'success'=>false,
                                'message'=>"validate false"]);
                        }
        
                        return response()->json([
                            'success'=>true,
                            'CMT'=>'NotExist',
                            'user'=>Auth::user(),
                            'token'=>$token
                            ]);
                    }
                    else {
                        return response()->json([
                            'success'=>false,
                            'CMT'=>'NotExist1',
                            ]);
                    }
                    
                }
                else{
                    return response()->json([
                        'success'=>false,
                        'CMT'=>'NotExist2'
                        
                        ]);
                }
            }
        }
    
     }

     public function getThongtinnguoidung(Request $request)
     {
        $getthongtin = thongtinnguoidung2::where('CMT',$request->CMT)->first();
        return response()->json($getthongtin);
     }

    public function getTheodoisuckhoe(Request $request)
    {
        $today = Carbon::now();
        $insert = new theodoisuckhoe;
        $insert->CMT=$request->CMT;
        $insert->tinhhinhsuckhoe=$request->tinhhinh;
        $insert->ngaycapnhat=$today;
        $insert->save();
        
        if($insert){
            return response()->json([
                'success'=>true
            ]);
        }
        else {
            return response()->json([
            'success'=>false
        ]);
            }

    }

     public function getThongtintheodoisuckhoe(Request $request)
     {
      $thongtin = theodoisuckhoe::where("CMT", $request->CMT)->get();
         return response()->json($thongtin);
     }

     public function getGuithongtinRequest(Request $request)
     {
      $insertphananh = new phananh;
      $insertphananh->CMT=$request->CMT;
      $insertphananh->truonghopphananh=$request->truonghopphananh;
      $insertphananh->noidungphananh=$request->noidungphananh;
      $insertphananh->thoigianphathien=$request->thoigianphathien;
      $insertphananh->diadiemphathien=$request->diadiemphathien;
      $insertphananh->save();
      if($insertphananh){
        return response()->json([
            'success'=>true
        ]);
    }
    else {
        return response()->json([
        'success'=>false
    ]);
     } 
    }

    public function getKhaibaotiepxuc(Request $request)
     {
      $insertkbtx = new khaibaotiepxuc;
      $insertkbtx->CMT=$request->CMT;
      $insertkbtx->khaibao=$request->khaibao;
      $insertkbtx->save();
      if($insertkbtx){
        return response()->json([
            'success'=>true
        ]);
        }
        else {
        return response()->json([
        'success'=>false
        ]);
        } 
    }
    public function getNguoithan(Request $request)
    {
        $nguoithan = nguoithan::where("CMT",$request->CMT)->get();
        return response()->json($nguoithan);
    }
    public function getGuithongtinNguoithan(Request $request)
    {
        $nguoithan = new nguoithan;
        $nguoithan->CMT = $request->CMT;
        $nguoithan->tennguoithan = $request->tennguoithan;
        $nguoithan->quanhe = $request->quanhe;
        $nguoithan->tinhhinh = $request->tinhhinh;
        $nguoithan->save();
        if($nguoithan){
            return response()->json([
                'success'=>true
            ]);
            }
        else {
            return response()->json([
            'success'=>false
            ]);
        } 
    }
    public function GetXoanguoithan(Request $request)
    {
        $nguoithan = nguoithan::where("tennguoithan", $request->tennguoithan)->where("CMT",$request->CMT);
        $nguoithan->delete();
        if($nguoithan){
            return response()->json([
                'success'=>true

            ]);
            }
        else {
            return response()->json([
            'success'=>false
            ]);
        } 
    }
    
    public function getThongtinNguoithan(Request $request)
     {
        $thongtin = nguoithan::where("CMT",$request->CMT)->where("tennguoithan", $request->tennguoithan)->first();
        return response()->json($thongtin);
     }
     public function getCapnhatsuckhoeNguoithan(Request $request)
     {
        $thongtin = nguoithan::where("CMT",$request->CMT)->where("tennguoithan", $request->tennguoithan)->first();
        $thongtin->tinhhinh = $request->tinhhinh;
        $thongtin->save();
        if($thongtin){
            return response()->json(['success'=>true]);
        }
        else return response()->json(['success'=>false]);
     }
     
}