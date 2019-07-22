<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sum_Result;
use App\KetQuaCanLamSang;
use App\KetQuaKhamLamSang;
use App\vsc_patient;
use App\v_patient_service_cls;
use App\sp_KetQua_KhamLamSan_TongQuat_Result;
use App\Http\Controllers\VscPatientController;
use App\Http\Controllers\SpKetQuaKhamLamSanTongQuatResultController;
use App\Http\Controllers\VPatientServiceClsController;
use App\Http\Controllers\DMCongTyController;
use Session;

class ajax extends Controller
{
    //
    public function getSum(){
        $SpKetQuaKhamLamSanTongQuatResultController = new SpKetQuaKhamLamSanTongQuatResultController();
        $VPatientServiceClsController = new VPatientServiceClsController();
        $SumResultController = new SumResultController();
        $VscPatientController = new VscPatientController();
        $_oneUser = $VscPatientController->getOneByFilenum($_GET['filenum']);
        $_oneKQKLS = $SpKetQuaKhamLamSanTongQuatResultController->getByPId($_oneUser->id);
        $_oneKQCLS = $VPatientServiceClsController->getByPId($_oneUser->id);
        $_oneSumResult = $SumResultController->getByPId($_oneUser->id);
        $result['KQKLS']=$_oneKQKLS;
        $result['KQCLS']=$_oneKQCLS;
        $result['SumResult']=$_oneSumResult;
        $result['SumResult']=$_oneSumResult;
        $result['Patient_id']=$_oneUser->id;
        return $result;
    }
    public function updateKQCLS(Request $request){
        $input = $request->all();
        $KetQuaCanLamSang = new KetQuaCanLamSang();
        foreach($input['data'] as $_oneKQCLS){
            if($_oneKQCLS['LoiKhuyen']=="null"){$_oneKQCLS['LoiKhuyen']=null;}
            if($_oneKQCLS['TrieuChung']=="null"){$_oneKQCLS['TrieuChung']=null;}
            if($_oneKQCLS['Result'] == 'Bình Thường'){
                $_oneKQCLS['Result']=1;
            }else if($_oneKQCLS['Result'] == 'Bất Thường'){
                $_oneKQCLS['Result']=0;
            }else if($_oneKQCLS['Result'] == 'Dương Tính'){
                $_oneKQCLS['Result']=2;
            }else if($_oneKQCLS['Result'] == 'Âm Tính'){
                $_oneKQCLS['Result']=3;
            }
            $_result = \DB::update("update ".$KetQuaCanLamSang->tbl." set LoiKhuyen = ? , TrieuChung= ? , Result= ? where ".$KetQuaCanLamSang->pkey." = ?", [$_oneKQCLS['LoiKhuyen'] , $_oneKQCLS['TrieuChung'] , $_oneKQCLS['Result'] , $_oneKQCLS['CanLamSangID']]);
        }

        return response($_result);
    }
    public function updateKQKLS(Request $request){
        $input = $request->all();
        $KetQuaKhamLamSang = new KetQuaKhamLamSang();
        foreach($input['data'] as $_oneKQKLS){
            if($_oneKQKLS['LoiKhuyen']=="null"){$_oneKQKLS['LoiKhuyen']=null;}
            if($_oneKQKLS['Note']=="null"){$_oneKQKLS['Note']=null;}
            if($_oneKQKLS['PhanLoaiSucKhoe']=="null"){$_oneKQKLS['PhanLoaiSucKhoe']=null;}
            if($_oneKQKLS['Normal'] == 'Bình Thường'){
                $_oneKQKLS['Normal']=1;$Abnormal=0;
            }else if($_oneKQKLS['Normal'] == 'Bất Thường'){
                $_oneKQKLS['Normal']=0;$Abnormal=1;
            }
            $_result = \DB::update("update ".$KetQuaKhamLamSang->tbl." set LoiKhuyen = ? , Note= ? , Normal= ? , Abnormal= ? , PhanLoaiSucKhoe= ? where ".$KetQuaKhamLamSang->pkey." = ?", [$_oneKQKLS['LoiKhuyen'] , $_oneKQKLS['Note'], $_oneKQKLS['Normal'], $Abnormal , $_oneKQKLS['PhanLoaiSucKhoe'] , $_oneKQKLS['KetQuaLamSangID']]);

        }
        return response($_result);

    }
    public function updateSumResult(Request $request){
        $input = $request->all();
        $Sum_Result = new Sum_Result();
        if($input['data']['sum'] == 'Đã Sum'){
            $input['data']['sum'] = 1;
        }else {
            $input['data']['sum'] = 0;
        }

        if($input['data']['id']==null){
            $_result = \DB::insert("insert into ".$Sum_Result->tbl." (nhanxet,ghichu,patient_id,status) values (?, ?, ?, ?)", [$input['data']['nhanxet'] , $input['data']['ghichu'] , $input['data']['patient_id'] , 1]);
        }else {
            $_result = \DB::update("update ".$Sum_Result->tbl." set nhanxet = ? , ghichu= ? where ".$Sum_Result->pkey." = ?", [$input['data']['nhanxet'] , $input['data']['ghichu'] , $input['data']['id']]);
        }


        return response($_result);

    }
}
