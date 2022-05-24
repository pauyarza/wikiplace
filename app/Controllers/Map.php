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
        $builder->select('category.name, spot.id_spot, spot.latitude, spot.longitude');
        //if one category is filtered (if multiple they are handled with js)
        if(isset($_POST['category_name'])){
            $builder->like('name','%'.$_POST['category_name'].'%');
            $this->viewData["catFiltered"] = $_POST['category_name'];
        }
        $builder->join('category', 'category.id_category = spot.id_category');
        $spots = $builder->get()->getResultArray();

        $this->viewData["spots"] = $spots;
        return view("pages/map", $this->viewData);
    }
}
