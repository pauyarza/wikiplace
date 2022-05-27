<?php

namespace App\Controllers;

class Home extends BaseController
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

        // Load categories to viewData
        $db = \Config\Database::connect();
        $builder = $db->table('category');
        $catQuery = $builder->get();
        $this->viewData["toastMessage"] = "test";
        $this->viewData["categories"] = $catQuery->getResultArray();
    }

    public function index()
    {
        return view("pages/index",$this->viewData);
    }
}
