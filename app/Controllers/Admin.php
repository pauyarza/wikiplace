<?php

namespace App\Controllers;
use App\Models\CategoryModel;
use CodeIgniter\Router\RouteCollection;

class Admin extends BaseController
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
        //if user is not admin
        if(!session()->is_admin){
            $this->viewData["goTo"] = base_url("Home");
            return view("pages/redirecting", $this->viewData);
        }
        else{
            return view("pages/admin", $this->viewData);
        }
    }

    public function newCategory(){
        //if user is not admin
        if (!session()->is_admin) {
            $this->viewData["goTo"] = base_url("Home");
            return view("pages/redirecting", $this->viewData);
        } else {
            $categoryData = $_POST;

            $validation =  \Config\Services::validation();
            $validation->setRules([
                'name' => 'required|max_length[50]|min_length[3]|alpha_space|is_unique[category.name]',
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
                $CategoryModel->insert($categoryData);

                //call view
                return view("pages/admin", $this->viewData);
            }
        }
    }
}
