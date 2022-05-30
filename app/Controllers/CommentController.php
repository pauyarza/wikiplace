<?php

namespace App\Controllers;

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
        $spotData['id_spot'] = $_POST["id_spot"];
        $spotData['comment'] = $_POST["comment"];
        print_r($spotData);
    }
}
