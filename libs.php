<?php
use Illuminate\Http\Request;

session()->regenerate();
class core{
    public function checkAccount(){
        if(!isset(session('user_all')->UserName)){
            // return view('pages-signin');
            // header("Location: https://www.youtube.com/");
            // exit();
        }
    }
}
