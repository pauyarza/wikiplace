<?php

namespace App\Controllers;
use App\Models\SpotModel;
use App\Models\SpotImageModel;
use App\Models\SpotLikeModel;

class SpotController extends BaseController
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

        // Prepare database
        $this->db = \Config\Database::connect();

        // Load categories to viewData
        $builder = $this->db->table('category');
        $catQuery = $builder->get();
        $this->viewData["categories"] = $catQuery->getResultArray();
    }

    public function spotForm(){
        return view("pages/new_spot", $this->viewData);
    }

    public function newSpot(){
        // If not logged in
        if(!session()->logged_in){
            $this->viewData["goTo"] = base_url("map");
            return view("pages/redirecting", $this->viewData);
        }
        
        $spotData = $_POST;
        $validation =  \Config\Services::validation();
        $acceptedImages = [];
        $errorImage = null;

        //check images manualy
        if (!empty($_FILES['images']['name'][0])) {
            $countfiles = count($_FILES['images']['name']);
            //go throught all images
            for($i = 0; $i < $countfiles; $i++){
                $type = $_FILES['images']['type'][$i];
                $tmpName = $_FILES["images"]["tmp_name"][$i];
                $content = file_get_contents($tmpName);
                //check type
                if($type != "image/gif" && $type != "image/jpeg" && $type != "image/png"){
                    $errorImage = 'Uploaded file is not a valid image. Only JPG, PNG and GIF files are allowed.';
                    break;
                }
                //check file size
                else if(filesize($tmpName) > 15728640){
                    $errorImage = 'Pictures larger than 15Mb are not allowed.';
                    break;
                }
                else{
                    //save data
                    $finalImage["extension"] = $type;
                    $finalImage["content"] = $content;
                    $acceptedImages[] = $finalImage;
                }
            }
        }

        $validation->reset();
        $validation->setRules([
            'spot_name' => 'required|max_length[50]|alpha_numeric_space',
            'description' => 'max_length[400]',
            'id_category' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        //data incorrect
        if (!$validation->run($spotData) || $errorImage) { 
            $errors = $validation->getErrors();
            $errors["images"] = $errorImage;
            $this->viewData["errors"] = $errors;
            $this->viewData["lastTry"] = $spotData;
            return view("pages/new_spot", $this->viewData);
        }
        //data correct
        else{
            //prepare extra data
            $spotData['id_user'] = session()->id_user;
            $spotData['date'] = date('Y-m-d H:i:s');
            
            //create new spot
            $SpotModel = new SpotModel();
            $SpotModel->insert($spotData);
            $id_spot = $SpotModel->getInsertID();

            //add images
            foreach($acceptedImages as $image){
                $SpotImageModel = new SpotImageModel();
                $image["id_spot"] = $id_spot;
                $SpotImageModel->insert($image);
            }

            $this->viewData["message"] = "Spot added successfully.";
            $this->viewData["goTo"] = base_url("map");
            return view("pages/redirecting", $this->viewData);
        }
    }

    public function getSpotPopupAjax(){
        $id_spot = $_POST["id_spot"];
        
        //get image
        $builder = $this->db->table('spot_image');
        $builder->select('content,extension');
        $builder->where('id_spot', $id_spot);
        $image = $builder->get(1)->getRowArray();

        //get spot info
        $builder = $this->db->table('spot');
        $builder->select('id_spot,latitude,longitude,spot_name,description');
        $builder->where('id_spot', $id_spot);
        $spot = $builder->get(1)->getRowArray();

        //count spot likes
        $builder = $this->db->table('spot_like');
        $builder->select('id_spot_like');
        $builder->where('id_spot', $id_spot);
        $spotLikes = $builder->countAllResults();


        //check if spot is liked
        if(session()->logged_in){
            $builder = $this->db->table('spot_like');
            $builder->select('id_spot_like');
            $builder->where('id_spot', $id_spot);
            $builder->where('id_user', session()->id_user);
            if($builder->countAllResults() == 0){
                //not liked
                $likedClass = "";
                $heartUrl = 'img/noLike.png';
            }
            else{
                //liked
                $likedClass = "liked";
                $heartUrl = 'img/like.png';
            }
        }
        else{
            //not liked
            $likedClass = "";
            $heartUrl = 'img/noLike.png';
        }
        
        
        echo "<div class='row topRow d-flex align-items-center'>";
            //name
            echo '<h2 class="col-8">'.$spot['spot_name'].'</h2>';
            //comments
            echo "
                <div class='col-2 commentDiv topRightDiv d-flex align-items-center justify-content-center'>
                    <img src='img/comment.svg'></img>
                    <p>4</p>
                </div>
            ";
            //likes
            echo "
                <div class='col-2 likeDiv topRightDiv d-flex align-items-center justify-content-center ".$likedClass."'>
                    <input type='hidden' value='".$spot['id_spot']."'>
                    <img src='$heartUrl' class=''></img>
                    <p class='totalLikes'>$spotLikes</p>
                </div>
            ";
        echo "</div>";
        //description
        if($spot['description']) echo '<p class="description">'.$spot['description'].'</p>';
        echo "<div class='row bottomRow'>";
            //image
            echo "<div class='col-7 d-flex aligns-items-center justify-content-center imageDiv'>";
                if($image) echo '<img class="mainImg" src="data:'.$image['extension'].';base64,'.base64_encode($image['content']).'"/>';
                else echo '<img class="mainImg" src="img/placeholder-image.jpg">';
            echo "</div>";
            echo "<div class='buttonsDiv col-5 d-flex align-content-between flex-wrap'>";
            //button
                echo '
                <button class="btn mapsButton" onclick="goMaps('.$spot['latitude'].','.$spot['longitude'].')">
                    <img class="mapsImg" src="img/maps.png">
                </button>';
                echo '<a class="btn moreButton">More</a>';
            echo "</div>";
        echo "</div>";
    }

    public function likeSpot(){
        $spotData['id_spot'] = $_POST["id_spot"];
        $spotData['id_user'] = session()->id_user;


        $builder = $this->db->table('spot_like');
        $builder->select('id_spot_like');
        $builder->where('id_spot', $spotData['id_spot']);
        $builder->where('id_user', $spotData['id_user']);

        if($builder->countAllResults()==0){
            $SpotLikeModel = new SpotLikeModel();
            if($SpotLikeModel->insert($spotData)){
                //count spot likes
                $builder = $this->db->table('spot_like');
                $builder->select('id_spot_like');
                $builder->where('id_spot', $spotData['id_spot']);
                $spotLikes = $builder->countAllResults();
                echo $spotLikes;
            }
            else{
                echo "database error";
            }
        }
    }

    public function unlikeSpot(){
        $spotData['id_spot'] = $_POST["id_spot"];
        $spotData['id_user'] = session()->id_user;

        $builder = $this->db->table('spot_like');
        $builder->where('id_user', $spotData['id_user']);
        $builder->where('id_spot', $spotData['id_spot']);
        $builder->delete();

        //count spot likes
        $builder = $this->db->table('spot_like');
        $builder->select('id_spot_like');
        $builder->where('id_spot', $spotData['id_spot']);
        $spotLikes = $builder->countAllResults();
        echo $spotLikes;
    }
}