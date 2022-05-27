<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Router\RouteCollection;

class UserController extends BaseController
{
    private $viewData = [];
    private $db;

    public function __construct()
    {
        // Load session info to viewData
        $sessionData["is_admin"] = session()->is_admin;
        $sessionData["logged_in"] = session()->logged_in;
        $sessionData["username"] = session()->username;
        $sessionData["mail"] = session()->mail;
        $sessionData["profile_pic_src"] = session()->profile_pic_src;
        $this->viewData["sessionData"] = $sessionData;

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
            //hash password
            $userData['password']=password_hash($userData['password'], PASSWORD_DEFAULT);
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
                //prepare image        
                //create session
                $sessionData = [
                    'id_user'  => $userData["id_user"],
                    'username'  => $userData["username"],
                    'mail'     => $userData["mail"],
                    'logged_in' => true,
                    'is_admin' => $userData["is_admin"],
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

    public function displayProfile(){
        $builder = $this->db->table('user');
        $builder->select('description');
        $builder->where('id_user', session()->id_user);
        $user = $builder->get(1)->getRowArray();

        $this->viewData['description'] = $user['description'];

        return view("pages/profile", $this->viewData); 
          
    }
    public function displayEditProfile(){
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


    public function editProfile(){
        $username = $_POST['username'];
        $description = $_POST['description'];

        print_r($_POST);

        $builder = $this->db->table('user');

        if($username){
            $builder->set('username', $username);
        }
        if($description){
            $builder->set('description', $description);
        } 
        $builder->where('id_user',session()->id_user);

        if($builder->update()){
            //load categories again
            // $builder = $this->db->table('user');
            // $this->viewData["message"] = "User updated successfully.";
            // return view("pages/editprofile", $this->viewData);
            session()->set('username', $username);
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
                session()->set('profile_pic', $content);
                session()->set('profile_pic_extension', $extension);
                echo "ok";
            }
        }
    }
}
