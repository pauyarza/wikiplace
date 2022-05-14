<?php

namespace App\Controllers;

class Map extends BaseController
{
    public function index()
    {
        $spotsModel = model('App\Models\spots');
        $spots["spots"] = $spotsModel->select('id_spot, latitude, longitude')->findAll();
        return view("pages/map",$spots);
    }
}
