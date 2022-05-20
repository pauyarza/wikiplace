<?php

namespace App\Controllers;
use App\Models\UserModel;
class UserController extends BaseController
{
    private $viewData = [];
    public function __construct()
    {
        // Load session info to viewData
        $sessionData["is_admin"] = session()->is_admin;
        $sessionData["logged_in"] = session()->logged_in;
        $this->viewData["sessionData"] = $sessionData;
    }
    
    //==========REGISTER==========//
    public function registerAjax()
    {
        $validation =  \Config\Services::validation();
        $userData = $_POST;
        $validation->reset();
        $validation->setRules([
            'username' => 'required|is_unique[user.username]|alpha_dash|max_length[50]',
            'mail' => 'required|valid_email|min_length[4]|is_unique[user.mail]|max_length[255]',
            'password' => 'required|min_length[6]|max_length[255]',
            'passwordR' => ['label' => 'repeat password', 'rules' => 'required|matches[password]'],
        ],
        [// Errors
            'username' => [
                'is_unique' => 'This username already exists.',
            ],
            'mail' => [
                'is_unique' => 'This email is already taken.',
            ],
        ]);

        //data incorrect
        if(!$validation->run($userData)){
            $errors = $validation->getErrors();
            echo json_encode($errors);
        }
        //data correct
        else{
            //create new user
            $UserModel = new UserModel();
            $UserModel->insert($userData);
            $user_id = $UserModel->getInsertID();

            //create session
            $sessionData = [
                'id_user' => $user_id,
                'username'  => $userData["username"],
                'mail'     => $userData["mail"],
                'logged_in' => true,
            ];
            session()->set($sessionData);
            echo "registerCorrect";
        }
    }

    //==========LOGIN==========//
    public function loginAjax(){
        $loginData = $_POST;
        $validation =  \Config\Services::validation();
        $isMail = false;

        //check login with mail
        $validation->reset();
        if($validation->check($loginData['usernameMail'], 'valid_email')){
            $isMail = true;
        }

        $validation->reset();
        $validation->setRules([
            'usernameMail' => 'required',
            'password' => 'required'
        ]);

        //bad user input
        if(!$validation->run($loginData)){
            $errors = $validation->getErrors();
            echo json_encode($errors);
        }
        //user input correct
        else{
            $userData = [];
            //prepare query
            $db = \Config\Database::connect();
            $builder = $db->table('user');
            $builder->get();
            if($isMail){
                $builder->where('mail', $loginData['usernameMail']);
            }
            else{
                $builder->where('username', $loginData['usernameMail']);
            }
            $builder->where('password', $loginData['password']);

            //run query
            $result = $builder->get();
            $userData = $result->getRowArray();
            
            if(!$userData){//no result so user not found
                $userData["customError"] = "Incorrect username or password.";
            }
            else{//user found               
                //create session
                $sessionData = [
                    'id_user'  => $userData["id_user"],
                    'username'  => $userData["username"],
                    'mail'     => $userData["mail"],
                    'logged_in' => true,
                    'is_admin' => $userData["is_admin"],
                ];
                session()->set($sessionData);
                $userData["found"] = true;
            }

            echo json_encode($userData);
        }
    }

    public function logOut(){
        session()->destroy();
        $this->viewData["sessionData"] = null;
        $this->viewData["goTo"] = previous_url();
        return view("pages/redirecting", $this->viewData);
    }

    public function displayProfile(){
        // Load session info to viewData
        $sessionData["is_admin"] = session()->is_admin;
        $sessionData["logged_in"] = session()->logged_in;
        $sessionData["username"] = session()->username;

        $this->viewData["sessionData"] = $sessionData;

        return view("pages/profile", $this->viewData);      
    }
}
