<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\v_patient_service_cls;
use App\Http\Controllers\VscPatientController;

class VPatientServiceClsController extends Controller
{
    //
    public function getByPId($id){
        $v_patient_service_cls = new v_patient_service_cls();
        try{
            $_data = \DB::select("select CanLamSangID,TenDVKT,TrieuChung,LoiKhuyen,Result from ".$v_patient_service_cls->tbl." where patientid = ".$id."");
            return $_data;
        }catch(\Exception $e){
            return 'Không lấy được dữ liệu!';
        }
    }
}
