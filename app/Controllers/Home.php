<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $sessionData["is_admin"] = session()->is_admin;
        $sessionData["logged_in"] = session()->logged_in;
        $data["sessionData"] = $sessionData;
        return view("pages/index",$data);
    }
}
