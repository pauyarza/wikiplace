<?php

namespace App\Controllers;

class Map extends BaseController
{
    private $viewData = [];
    public function __construct()
    {
        // Load session info to viewData
        $sessionData["is_admin"] = session()->is_admin;
        $sessionData["logged_in"] = session()->logged_in;
        $this->viewData["sessionData"] = $sessionData;
        
        // Prepare database
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $builder = $this->db->table('spot');
        $builder->select('*');
        $builder->join('category', 'category.id_category = spot.id_category');
        $spots = $builder->get()->getResultArray();

        $this->viewData["spots"] = $spots;
        return view("pages/map", $this->viewData);
    }
}
