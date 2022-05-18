<?php

namespace App\Controllers;
use App\Models\SpotModel;

class SpotController extends BaseController
{
    private $viewData = [];
    public function __construct()
    {
        $sessionData["is_admin"] = session()->is_admin;
        $sessionData["logged_in"] = session()->logged_in;
        $this->viewData["sessionData"] = $sessionData;
    }

    public function spotForm(){
        //if not logged in
        if(!session()->logged_in){
            $this->viewData["goTo"] = base_url("map");
            return view("pages/redirecting", $this->viewData);
        }
        else{
            return view("pages/new_spot", $this->viewData);
        }
    }

    public function newSpot(){
        $spotData = $_POST;
        $validation =  \Config\Services::validation();

        $validation->setRules([
            'name' => 'required|max_length[50]|alpha_space',
            'description' => 'max_length[400]',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        //data incorrect
        if (!$validation->run($spotData)) {
            $errors = $validation->getErrors();
            echo json_encode($errors);
        }
        else{
            //prepare extra data
            $spotData['id_user'] = session()->id_user;
            $spotData['date'] = date('Y-m-d H:i:s');
            
            //create new spot
            $SpotModel = new SpotModel();
            $SpotModel->insert($spotData);
        }
        echo json_encode($spotData);
    }
}
