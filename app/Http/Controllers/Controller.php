<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\thongtinnguoidung;
use App\thongtinbenhcanhan;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getKhaibao(Request $request){
        $hovaten = $request->hovaten;
        $CMT = $request->CMT;
        $BHXH = $request->BHXH;
        $ngaysinh = $request->ngaysinh;
        $gioitinh = $request->gioitinh;
        $quoctich = $request->quoctich;
        $diachi = $request->diachi;
        $sodienthoai = $request->sodienthoai;
        $email = $request->email;

        if($hovaten == null  && $CMT == null && $ngaysinh == null && $gioitinh == null && $quoctich == null && $diachi == null &&  $sodienthoai == null){
            return response()->json([
                'success'=>false,
                ]);
        }
        if($hovaten != null  && $CMT != null && $ngaysinh != null && $gioitinh != null && $quoctich != null && $diachi != null &&  $sodienthoai != null){
          
            $insertthongtincanhan = DB::table('thongtinnguoidung')->insert(['hovaten'=>$hovaten,
            'CMT'=>$CMT,
            'BHXH'=>$BHXH,
            'ngaysinh'=>$ngaysinh,
            'gioitinh'=>$gioitinh,
            'quoctich'=>$quoctich,
            'diachi'=>$diachi,
            'sodienthoai'=>$sodienthoai,
            'email'=>$email]);

            $insertthongtinbenhcanhan = DB::table('thongtinbenhcanhan')->insert([
                                        'CMT'=>$CMT,
                                        'tinhhinh'=>$request->tinhhinh,
                                        'didenvungquocgia'=>$request->didenvungquocgia,
                                        'dauhieu'=>$request->dauhieu,
                                        'macbenh'=>$request->macbenh
                                        ]);
            return response()->json([
                                    'success'=>true,
                                    ]);
        }
        

    }

}
