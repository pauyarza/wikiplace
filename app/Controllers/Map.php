<?php

namespace App\Controllers;

class Map extends BaseController
{
    public function index()
    {
        $spotsModel = model('App\Models\SpotModel');
        $sessionData["username"] = session()->username;
        $sessionData["mail"] = session()->mail;
        $sessionData["logged_in"] = session()->logged_in;
        $data["sessionData"] = $sessionData;
        $data["spots"] = $spotsModel->select('id_spot, latitude, longitude')->findAll();
        return view("pages/map",$data);
    }
}
