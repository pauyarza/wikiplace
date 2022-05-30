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
        $sessionData["username"] = session()->username;
        $sessionData["profile_pic_src"] = session()->profile_pic_src;
        $sessionData["welcome_message"] = session()->welcome_message;
        $this->viewData["sessionData"] = $sessionData;
        session()->set('welcome_message', false);

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

        // Load unresolved reports to viewData
        $builder = $this->db->table('spot_report');
        $builder->select('
            spot_report.id_spot_report,
            spot_report.id_spot,
            spot_report.report_message,

            reported.id_user AS id_reported,
            reported.username AS username_reported,

            reporter.id_user AS id_spot_creator,
            reporter.username AS username_reporter,
            
        ');

        $builder->join('spot', 'spot.id_spot = spot_report.id_spot');//join spot table for knowing post creator id
        $builder->join('user reported', 'reported.id_user = spot.id_user','left');//join user table for knowing reported spot owner name
        $builder->join('user reporter', 'reporter.id_user = spot_report.id_user','left');//join user table for knowing report creator name
    
        $catQuery = $builder->get();

        $this->viewData["spotReports"] = $catQuery->getResultArray();
    }

    public function index()
    {
        return view("admin/admin", $this->viewData);
    }

    //========= MULTIPLE =========//
    public function deleteSpotBanUser(){
        if(session()->is_admin){
            $id_spot = $_POST["id_spot"];
            $id_user = $_POST["id_user"];

            //delete user if exists
            if($id_user){
                $userBuilder = $this->db->table('user');
                $userBuilder->where('id_user', $id_user);
                if($userBuilder->delete()){
                    $userDeleted = true;
                }
            }

            $spotBuilder = $this->db->table('spot');
            $spotBuilder->where('id_spot', $id_spot);
            
            //delete spot
            if($spotBuilder->delete()){
                echo "ok";
            }
            else{
                echo "database error";
            }
        }
        else{
            echo "You are not an admin.";
        }
    }


    //========= CATEGORIES =========//
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

            return view("admin/admin", $this->viewData);
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
                return view("admin/admin", $this->viewData);
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

    public function loadEditCategory(){
        $this->viewData["id_category"] = $_GET['id_category'];
        $this->viewData["name"] = $_GET['name'];
        return view("admin/edit_category", $this->viewData);
    }

    public function editCategory(){
        $id_category = $_POST['id_category'];
        $name = $_POST['name'];

        $builder = $this->db->table('category');
        $builder->set('name', $name);
        $builder->where('id_category',$id_category);
        if($builder->update()){
            //load categories again
            $builder = $this->db->table('category');
            $catQuery = $builder->get();
            $this->viewData["categories"] = $catQuery->getResultArray();
            $this->viewData["message"] = "Category updated successfully.";
            return view("admin/admin", $this->viewData);
        }
    }
}
