<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vsc_patient;

class VscPatientController extends Controller
{
    //
    public function index(){
        $vsc_patient = new vsc_patient();
        $test = \DB::select('select top 1 * from '.$vsc_patient->tbl.' where status = 1');
        // var_dump($test[0]->id);
        // return 1;
        return view('pages-signin', compact("test"));
    }
    public function getOneByFilenum($filenum){
        $vsc_patient = new vsc_patient();
        $_one = \DB::select("select top 1 * from ".$vsc_patient->tbl." where filenum = '".$filenum."'");
        return $_one[0];
    }
    public function getAllByCompanyId($companyid){
        $vsc_patient = new vsc_patient();
        $_all = \DB::select('select  * from '.$vsc_patient->tbl.' where companyid = '.$companyid.' and status = 1 ');
        return $_all;
    }
}
