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
        $sessionData["id_user"] = session()->id_user;
        $sessionData["username"] = session()->username;
        $sessionData["profile_pic_src"] = session()->profile_pic_src;
        $sessionData["welcome_message"] = session()->welcome_message;
        $this->viewData["sessionData"] = $sessionData;
        session()->set('welcome_message', false);
        
        // Prepare database
        $this->db = \Config\Database::connect();

        // Load categories to viewData
        $db = \Config\Database::connect();
        $builder = $db->table('category');
        $builder->orderBy('name', 'ASC');
        $catQuery = $builder->get();
        $this->viewData["categories"] = $catQuery->getResultArray();
    }

    public function index()
    {
        if(isset($_GET['id_selected_spot'])){
            $selectedSpot = $_GET;
            $this->viewData["selectedSpot"] = $selectedSpot;
        }

        //save prefiltered categories
        $catFiltered = [];
        $catFound = false;
        if(isset($_POST['category_name'])){
            $category_name = $_POST['category_name'];
        }
        else if(isset($_GET['category_name'])){
            $category_name = $_GET['category_name'];
        }

        if(isset($category_name)){
            foreach($this->viewData["categories"] as $category){
                if(strpos($category['name'], $category_name) !== false){
                    $catFiltered[] = $category['name'];
                    $catFound = true;
                }
            }
            //filtered cat doesn't exist
            if(!$catFound){
                $this->viewData["error"] = "This category doesn't exist, yet!";
                $this->viewData["categoryTry"] = $category_name;
                return view("pages/index", $this->viewData);
            }
        }
        $this->viewData["catFiltered"] = $catFiltered;
        
        //get spots
        $builder = $this->db->table('spot');
        $builder->select('category.name, spot.id_spot, spot.latitude, spot.longitude');
        $builder->join('category', 'category.id_category = spot.id_category');
        $spots = $builder->get()->getResultArray();
        
        $this->viewData["spots"] = $spots;
        return view("pages/map", $this->viewData);
    }
}
