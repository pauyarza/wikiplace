<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        //if user is not admin
        if(!session()->is_admin){
            $data["goTo"] = base_url("Home");
            return view("pages/redirecting", $data);
        }
        else{
            $sessionData["is_admin"] = session()->is_admin;
            $sessionData["logged_in"] = session()->logged_in;
            $data["sessionData"] = $sessionData;
            return view("pages/admin", $data);
        }
    }
}
