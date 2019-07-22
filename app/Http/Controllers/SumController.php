<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vsc_patient;
use App\v_patient_service_cls;
use App\sp_KetQua_KhamLamSan_TongQuat_Result;
use App\Http\Controllers\VscPatientController;
use App\Http\Controllers\SpKetQuaKhamLamSanTongQuatResultController;
use App\Http\Controllers\VPatientServiceClsController;
use App\Http\Controllers\DMCongTyController;
use Session;

class SumController extends Controller
{
    //
    public function index($filenum){
        $VscPatientController = new VscPatientController();
        $SpKetQuaKhamLamSanTongQuatResultController = new SpKetQuaKhamLamSanTongQuatResultController();
        $VPatientServiceClsController = new VPatientServiceClsController();
        $_onePatient = $VscPatientController->getOneByFilenum($filenum);
        $_oneKQKLS = $SpKetQuaKhamLamSanTongQuatResultController->getByFilenum($filenum);
        $_oneKQCLS = $VPatientServiceClsController->getByFilenum($filenum);
        return view('sum', compact("_onePatient","_oneKQKLS","_oneKQCLS"));
    }
    public function getListPatientByCompanyCode(){
        // $_POST['code'];
        if(!isset($_GET['code'])){
            return view('sum');
        }else {
            $DMCongTyController = new DMCongTyController();
            $VscPatientController = new VscPatientController();
            $_oneCompany = $DMCongTyController->getOneByCode($_GET['code']);
            if($_oneCompany != 'Công ty không tồn tại'){
                $_listPatient = $VscPatientController->getAllByCompanyId($_oneCompany->CompanyID);
                Session::forget('_listPatientSum');
                Session::put('_listPatientSum', $_listPatient);
            }
            return view('sum');
        }
    }
}
