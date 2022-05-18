<?php

namespace App\Controllers;

class Map extends BaseController
{
    private $viewData = [];
    public function __construct()
    {
        $sessionData["is_admin"] = session()->is_admin;
        $sessionData["logged_in"] = session()->logged_in;
        $this->viewData["sessionData"] = $sessionData;
        
    }

    public function index()
    {
        $spotsModel = model('App\Models\SpotModel');
        $this->viewData["spots"] = $spotsModel->select('id_spot, latitude, longitude')->findAll();
        return view("pages/map",$this->viewData);
    }
}
