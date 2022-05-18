<?php

namespace App\Controllers;
use App\Models\SpotModel;

class SpotController extends BaseController
{
    public function spotForm(){
        $sessionData["logged_in"] = session()->logged_in;
        $data["sessionData"] = $sessionData;
        //if not logged in
        if(!$sessionData["logged_in"]){
            $data["goTo"] = base_url("map");
            return view("pages/redirecting", $data);
        }
        else{
            return view("pages/new_spot", $data);
        }
    }

    public function newSpot(){
        $spotData = $_POST;
        $validation =  \Config\Services::validation();

        $validation->setRules([
            'name' => 'required|max_length[50]',
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
