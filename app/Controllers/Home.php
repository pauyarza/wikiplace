<?php 


namespace App\Controllers;

use App\Models\UsersModel;

class Home extends BaseController
{

	//public $rutaUpload = ROOTPATH.'public/assets/client/uploads/';
    public function __construct(){
        helper('form');
        helper("file");
        $this->db = db_connect(); // Necesario para trabajar con $this->db
        $this->db = \Config\Database::connect(); // Necesario para trabajar con el modelo
        $this->session=\Config\Services::session();
        $this->session->start();
    }

	public function index()
	{
		return view('homeview');
	}

	//--------------------------------------------------------------------

}
