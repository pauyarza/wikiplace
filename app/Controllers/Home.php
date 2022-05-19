<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $viewData = [];
    public function __construct()
    {
        // Load session info to viewData
        $sessionData["is_admin"] = session()->is_admin;
        $sessionData["logged_in"] = session()->logged_in;
        $this->viewData["sessionData"] = $sessionData;
    }

    public function index()
    {
        // Load categories to viewData
        $db = \Config\Database::connect();
        $builder = $db->table('category');
        $catQuery = $builder->get();
        $this->viewData["categories"] = $catQuery->getResultArray();

        return view("pages/index",$this->viewData);
    }
}
