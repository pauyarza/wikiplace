<?php

namespace App\Controllers;

class AboutUs extends BaseController
{
    private $viewData = [];
    public function __construct()
    {
        // Load session info to viewData
        $sessionData["is_admin"] = session()->is_admin;
        $sessionData["logged_in"] = session()->logged_in;
        $sessionData["username"] = session()->username;
        if(session()->profile_pic_extension){
            $sessionData["profile_pic_src"] = 'data:'.session()->profile_pic_extension.';base64,'.base64_encode(session()->profile_pic);
        }
        else $sessionData["profile_pic_src"] = base_url('img/profile.png');
        $this->viewData["sessionData"] = $sessionData;
    }

    public function index()
    {
        return view("pages/about_us",$this->viewData);
    }
}
