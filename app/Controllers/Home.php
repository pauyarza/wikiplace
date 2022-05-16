<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $sessionData["username"] = session()->username;
        $sessionData["mail"] = session()->mail;
        $sessionData["logged_in"] = session()->logged_in;
        $data["sessionData"] = $sessionData;
        return view("pages/index",$data);
    }
}
