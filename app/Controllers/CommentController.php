<?php

namespace App\Controllers;
use App\Models\CommentModel;

class CommentController extends BaseController
{
    private $viewData = [];
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
    }

    public function addComment()
    {
        $commentData["comment"] = $_POST["comment"];
        $commentData["id_spot"] = $_POST["id_spot"];
        $commentData["id_user"] = session()->id_user;

        $validation =  \Config\Services::validation();

        $validation->setRules([
            'comment' => 'required|max_length[1500]'
        ]); 
        
        //valide comment
        if(!$validation->run($commentData)){
            $error = $validation->getErrors();
            echo $error["comment"];
        }
        else{//comment correct
            //create new model
            $CommentModel = new CommentModel();
            if($CommentModel->insert($commentData)){
                echo "ok";
            }
            else{
                echo "database error";
            }
        }
    }
}
