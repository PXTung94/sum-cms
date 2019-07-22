<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Config;

class UserController extends Controller
{
    //
    public function checkLogin(){
        $User = new User();
        // if(isset(session('user_all')->UserName)){
        //     // return redirect('/');
        //     return view('pages-home');
        // }else {
        if(!isset($_POST['Login_Username'])){
            return view('pages-signin');
        }else{
            try{
                $_account = \DB::select("select top 1 * from [".$User->tbl."] where UserName = '".$_POST['Login_Username']."'and Password ='".$_POST['Login_Password']."'");
                // return 1;
                // if($_account[0]!= null){
                if($_account[0]->Status==1){
                    Session::put('user_all', $_account[0]);
                    return redirect('/');
                }else{
                    $e="Account không tồn tại!";
                    return view('pages-signin', compact("e"));
                }
                unset($_POST['Login_Username']);
                unset($_POST['Login_Password']);
                // }else
                // {
                //     $e="Account đâu có tồn tại đâu mà login :'( !!!!!!!!!!!!!!???????????";
                //     return view('pages-error', compact("e"));
                // }
            }catch(\Exception $e){
                return view('pages-signin', compact("e"));
            }
        }
    }
    public function checkLogout(){
        Session::forget('user_all');
        return view('pages-signin');
    }
    public function index(){
        return view('pages-signin');
    }
}
