<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DM_CongTy;

class DMCongTyController extends Controller
{
    //
    public function getOneByCode($code){
        $DM_CongTy = new DM_CongTy();
        try{
            $_one = \DB::select("select * from $DM_CongTy->tbl where Code = '$code'");
            return $_one[0];
        }
        catch(\Exception $e){
            return 'Công ty không tồn tại';
        }
    }
}
