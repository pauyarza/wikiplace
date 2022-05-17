<?php

namespace App\Controllers;

class SpotController extends BaseController
{
    public function spotForm()
    {
        $sessionData["logged_in"] = session()->logged_in;
        $data["sessionData"] = $sessionData;
        return view("pages/new_spot",$data);
    }
}
