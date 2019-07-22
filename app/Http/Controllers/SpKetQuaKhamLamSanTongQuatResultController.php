<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sp_KetQua_KhamLamSan_TongQuat_Result;

class SpKetQuaKhamLamSanTongQuatResultController extends Controller
{
    //
    public function getByPId($id){
        $sp_KetQua_KhamLamSan_TongQuat_Result = new sp_KetQua_KhamLamSan_TongQuat_Result();
        try{
            $_data = \DB::select("EXEC ".$sp_KetQua_KhamLamSan_TongQuat_Result->sto." ?", array($id));
            foreach ($_data as $one){
                $one->ChuKy =0;
            }
            return $_data;
        }catch(\Exception $e){
            return 'Không lấy được dữ liệu!';
        }
    }
}
