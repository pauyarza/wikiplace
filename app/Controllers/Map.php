<?php

namespace App\Controllers;

class Map extends BaseController
{
    public function index()
    {
        $spotsModel = model('App\Models\SpotModel');
        $sessionData["logged_in"] = session()->logged_in;
        $sessionData["is_admin"] = session()->is_admin;
        $data["sessionData"] = $sessionData;
        $data["spots"] = $spotsModel->select('id_spot, latitude, longitude')->findAll();
        return view("pages/map",$data);
    }
}
