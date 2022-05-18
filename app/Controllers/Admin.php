<?php

namespace App\Controllers;
use App\Models\CategoryModel;
use CodeIgniter\Router\RouteCollection;

class Admin extends BaseController
{
    private $viewData = [];
    private $db;

    public function __construct()
    {
        
        // Load session info to viewData
        $sessionData["is_admin"] = session()->is_admin;
        $sessionData["logged_in"] = session()->logged_in;
        $this->viewData["sessionData"] = $sessionData;

        // Check if user is admin
        if(!session()->is_admin){
            $this->viewData["goTo"] = base_url("Home");
            return view("pages/redirecting", $this->viewData);
        }

        // Prepare database
        $this->db = \Config\Database::connect();

        // Load categories to viewData
        $builder = $this->db->table('category');
        $catQuery = $builder->get();

        $this->viewData["categories"] = $catQuery->getResultArray();

        //load
    }

    public function index()
    {
        return view("pages/admin", $this->viewData);
    }

    //========= NEW CATEGORY =========//
    public function newCategory(){
        $categoryData = $_POST;

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|max_length[50]|min_length[3]|alpha_numeric_space|is_unique[category.name]',
        ]);

        //incorrect input data
        if (!$validation->run($categoryData)) {
            //errors
            $errors = $validation->getErrors();
            $this->viewData["cat_errors"] = $errors;
            //last try
            $this->viewData["last_cat_name"] = $categoryData['name'];

            return view("pages/admin", $this->viewData);
        }
        
        //correct input data
        else{
            $categoryData['id_creator'] = session()->id_user;
            //create new category
            $CategoryModel = new CategoryModel();
            if($CategoryModel->insert($categoryData)){
                //load categories again
                $builder = $this->db->table('category');
                $catQuery = $builder->get();
                $this->viewData["categories"] = $catQuery->getResultArray();
                return view("pages/admin", $this->viewData);
            }
            else{
                echo "database error";
            }
        }
    }

    public function deleteCategory(){
        $id_category = $_POST['id_category'];
        $builder = $this->db->table('category');
        
        if($builder->delete(['id_category' => $id_category])){
            echo "ok";
        }
        else{
            echo "Database errror";
        }
    }
}
