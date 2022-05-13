<?php

namespace App\Controllers;

class AboutUs extends BaseController
{
    public function index()
    {
        echo view("!about_us.php");
    }
}
