<?php

namespace App\Controllers;

class AboutUs extends BaseController
{
    public function index()
    {
        $sessionData["is_admin"] = session()->is_admin;
        $sessionData["logged_in"] = session()->logged_in;
        $data["sessionData"] = $sessionData;
        return view("pages/about_us",$data);
    }
}
