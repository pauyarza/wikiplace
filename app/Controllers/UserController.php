<?php

namespace App\Controllers;
use App\Models\UserModel;

class UserController extends BaseController
{
    private $viewData = [];
    private $db;

    public function __construct()
    {
        // Load session info to viewData
        $sessionData["is_admin"] = session()->is_admin;
        $sessionData["logged_in"] = session()->logged_in;
        $sessionData["id_user"] = session()->id_user;
        $sessionData["username"] = session()->username;
        $sessionData["mail"] = session()->mail;//only here
        $sessionData["profile_pic_src"] = session()->profile_pic_src;
        $sessionData["welcome_message"] = session()->welcome_message;
        $this->viewData["sessionData"] = $sessionData;
        session()->set('welcome_message', false);

        $this->db = \Config\Database::connect();

        $builder = $this->db->table('user');
        $userQuery = $builder->get();
        $this->viewData["users"] = $userQuery->getResultArray();


    }
    
    //==========REGISTER==========//
    public function registerAjax()
    {
        $validation =  \Config\Services::validation();
        $userData = $_POST;
        $validation->reset();
        $validation->setRules([
            'username' => 'required|is_unique[user.username]|alpha_dash|min_length[3]|max_length[50]',
            'mail' => 'required|valid_email|min_length[4]|is_unique[user.mail]|max_length[255]',
            'password' => 'required|min_length[8]|max_length[255]',
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
            //hash password
            $userData['password']=password_hash($userData['password'], PASSWORD_DEFAULT);
            //create new user
            $UserModel = new UserModel();
            $UserModel->insert($userData);
            $id_user = $UserModel->getInsertID();

            //create session
            $sessionData = [
                'id_user' => $id_user,
                'username'  => $userData["username"],
                'mail'     => $userData["mail"],
                'logged_in' => true,
                'welcome_message' => "Welcome to Wikiplace ".$userData["username"]."!",
                'profile_pic_src' => base_url('img/profile.png'),//default img
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
        ],
        [// Errors
            'usernameMail' => [
                'required' => 'The username/mail field is required.',
            ]
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

            //run query
            $result = $builder->get(1);
            $userData = $result->getRowArray();

            //no result so user not found or incorrect password
            if(!$userData || !password_verify($loginData["password"], $userData['password'])){
                $return["customError"] = "Incorrect username or password.";
            }
            else{//user found
                //create session
                $sessionData = [
                    'id_user'  => $userData["id_user"],
                    'username'  => $userData["username"],
                    'mail'     => $userData["mail"],
                    'logged_in' => true,
                    'is_admin' => $userData["is_admin"],
                    'welcome_message' => "Welcome back ".$userData['username']."!",
                ];
                //add profile pic if user has one
                if($userData['profile_pic_extension']){
                    $sessionData['profile_pic_src'] = 'data:'.$userData["profile_pic_extension"].';base64,'.base64_encode($userData["profile_pic"]);
                }
                else{
                    $sessionData['profile_pic_src'] = base_url('img/profile.png');//default img
                }
                session()->set($sessionData);
                $return["found"] = true;
            }
            echo json_encode($return);
        }
    }

    public function logOut(){
        session()->destroy();
        $this->viewData["sessionData"] = null;
        $this->viewData["goTo"] = previous_url();
        return view("pages/redirecting", $this->viewData);
    }

    public function displayProfile($username){
        $builder = $this->db->table('user');
        $builder->select('username,description,profile_pic,profile_pic_extension,id_user');
        $builder->where('username', $username);
        $user = $builder->get(1)->getRowArray();

        //check if it's owner
        if($user['username'] == session()->username){
            $this->viewData['is_owner'] = true;
        }
        else{
            $this->viewData['is_owner'] = false;
        }

        $this->viewData['user']['username'] = $user['username'];
        $this->viewData['user']['description'] = $user['description'];
        $this->viewData['user']['id_user'] = $user['id_user'];
        if($user['profile_pic_extension']){
            $this->viewData['user']['profile_pic_src'] = 'data:'.$user['profile_pic_extension'].';base64,'.base64_encode($user['profile_pic']);
        }
        else{
            $this->viewData['user']['profile_pic_src'] = base_url('img/profile.png');//default img
        }

        return view("pages/profile", $this->viewData); 
          
    }
    public function displayEditProfile(){//load view
        if(session()->logged_in){
            $builder = $this->db->table('user');
            $builder->select('description');
            $builder->where('id_user', session()->id_user);
            $user = $builder->get(1)->getRowArray();
    
            $this->viewData['description'] = $user['description'];
    
            return view("pages/edit_profile", $this->viewData); 
        }
        else{
            $this->viewData["goTo"] = '../home';
            return view("pages/redirecting", $this->viewData);
        }          
    }


    public function editProfile(){//backend 
        if(session()->logged_in){
            $validation =  \Config\Services::validation();

            if(!isset($_POST['username'])){
                $this->viewData["goTo"] = base_url('UserController/displayEditProfile');
                return view("pages/redirecting", $this->viewData);
            }

            $userData["username"] = $_POST['username'];
            $userData["description"] = $_POST['description'];

            if($userData["username"] != session()->username){//prevent username validation when no change
                $validation->setRule('username', 'username', 'required|is_unique[user.username]|alpha_dash|min_length[3]|max_length[50]');
            }
            $validation->setRule('description', 'description', 'max_length[600]');

            //data incorrect
            if(!$validation->run($userData)){
                $errors = $validation->getErrors();
                $this->viewData['errors'] = $errors;
            }
            else{
                $builder = $this->db->table('user');
        
                if($userData["username"]){
                    $builder->set('username', $userData["username"]);
                }
                $builder->set('description', $userData["description"]);
                $builder->where('id_user',session()->id_user);
        
                if($builder->update()){
                    session()->set('username', $userData["username"]);
                }

                $this->viewData['updateCorrect'] = true;
                $this->viewData["sessionData"]["username"] = $userData["username"];
            }
            $this->viewData['description'] = $userData['description'];
            return view("pages/edit_profile", $this->viewData);
        }
        else{
            $this->viewData["goTo"] = '../home';
            return view("pages/redirecting", $this->viewData);
        }
    }

    public function updateProfilePic(){
        if ( 0 < $_FILES['avatar']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            //get image data
            $extension = $_FILES['avatar']['type'];
            $tmpName = $_FILES["avatar"]["tmp_name"];
            $content = file_get_contents($tmpName);
            
            //upload to ddbb
            $builder = $this->db->table('user');
            $builder->set('profile_pic', $content);
            $builder->set('profile_pic_extension', $extension);
            $builder->where('id_user',session()->id_user);
            if($builder->update()){
                session()->set('profile_pic_src', 'data:'.$extension.';base64,'.base64_encode($content));
                echo "ok";
            }
            else{
                echo "error";
            }
        }
    }
}
