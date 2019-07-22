<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sum_Result;
use App\Http\Controllers\VscPatientController;

class SumResultController extends Controller
{
    //
    public function getByPId($id){
        $Sum_Result = new Sum_Result();
        try{
            $_data = \DB::select("select top 1 * from ".$Sum_Result->tbl." where patient_id = ".$id." and status =1");
            return $_data;
        }catch(\Exception $e){
            return 'Không lấy được dữ liệu!';
        }
    }
}
