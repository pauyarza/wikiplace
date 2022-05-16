<?php

namespace App\Controllers;
use App\Models\UserModel;
class UserController extends BaseController
{
    public function __construct() {
        $db = db_connect();
    }

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
            //create session
            $sessionData = [
                'username'  => $userData["username"],
                'mail'     => $userData["mail"],
                'logged_in' => true,
            ];
            session()->set($sessionData);
            
            echo "registerCorrect";
        }
    }

    public function loginAjax(){
        $loginData = $_POST;
        $validation =  \Config\Services::validation();
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
                    'username'  => $userData["username"],
                    'mail'     => $userData["mail"],
                    'logged_in' => true,
                ];
                session()->set($sessionData);
                $userData["found"] = true;
            }

            echo json_encode($userData);
        }
    }

    public function logOut(){
        session()->destroy();
        echo '<script>window.location.href = "'.previous_url().'";</script>';
    }

    public function temp(){
        //prepare query
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->get();
        $builder->where('username', "testUser");
        $builder->where('password', "123a4");

        //run query
        $result = $builder->get();
        $sendObj = $result->getRow();
        
        if($sendObj){
            echo "ok";
        }
        else{
            echo("Incorrect username or password.");
        }
    }
}
