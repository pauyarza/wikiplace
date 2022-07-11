<?php

namespace App\Controllers;
use App\Models\CommentModel;
use App\Models\CommentReportModel;
use App\Models\CommentLikeModel;

class CommentController extends BaseController
{
    private $viewData = [];
    public function __construct()
    {
        // Load session info to viewData
        $sessionData["is_admin"] = session()->is_admin;
        $sessionData["logged_in"] = session()->logged_in;
        $sessionData["id_user"] = session()->id_user;
        $sessionData["username"] = session()->username;
        $sessionData["profile_pic_src"] = session()->profile_pic_src;
        $sessionData["welcome_message"] = session()->welcome_message;
        $this->viewData["sessionData"] = $sessionData;
        session()->set('welcome_message', false);

        // Prepare database
        $this->db = \Config\Database::connect();
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

    public function reportComment(){
        $reportData['id_comment'] = $_POST["id_comment"];
        $reportData['report_message'] = $_POST["report_message"];
        $reportData['id_user'] = session()->id_user;

        //check if report already exists
        $builder = $this->db->table('comment_report');
        $builder->select('id_comment_report');
        $builder->where('id_comment', $reportData['id_comment']);
        $builder->where('id_user', $reportData['id_user']);

        if($builder->countAllResults()==0){
            //save report
            $CommentReportModel = new CommentReportModel();
            if($CommentReportModel->insert($reportData)){
                echo "ok";
            }
            else{
                echo "database error";
            }
        }
        else{
            echo "Comment already reported.";
        }
    }

    public function likeComment(){
        if(session()->logged_in){
            $commentData['id_comment'] = $_POST["id_comment"];
            $commentData['id_user'] = session()->id_user;

            //check that like doesn't existunlike
            $builder = $this->db->table('comment_like');
            $builder->select('id_comment_like');
            $builder->where('id_comment', $commentData['id_comment']);
            $builder->where('id_user', $commentData['id_user']);

            if($builder->countAllResults()==0){
                $CommentLikeModel = new CommentLikeModel();
                if($CommentLikeModel->insert($commentData)){
                    //count comment likes
                    $builder = $this->db->table('comment_like');
                    $builder->select('id_comment_like');
                    $builder->where('id_comment', $commentData['id_comment']);
                    $commentLikes = $builder->countAllResults();
                    echo $commentLikes;
                }
                else{
                    echo "database error";
                }
            }
        }
    }

    public function unlikeComment(){//ajax
        $commentData['id_comment'] = $_POST["id_comment"];
        $commentData['id_user'] = session()->id_user;

        $builder = $this->db->table('comment_like');
        $builder->where('id_user', $commentData['id_user']);
        $builder->where('id_comment', $commentData['id_comment']);
        $builder->delete();

        //count comment likes
        $builder = $this->db->table('comment_like');
        $builder->select('id_comment_like');
        $builder->where('id_comment', $commentData['id_comment']);
        $commentLikes = $builder->countAllResults();
        echo $commentLikes;
    }

    public function deleteComment(){//ajax
        $id_comment = $_POST["id_comment"];

        //get id_user comment creator
        $builder = $this->db->table('comment');
        $builder->select('id_user');
        $builder->where('id_comment', $id_comment);
        $comment = $builder->get(1)->getRowArray();

        //if it's owner or admin
        if($comment['id_user'] == session()->id_user || session()->is_admin == 1){
            $builder = $this->db->table('comment');
            $builder->where('id_comment', $id_comment);
            //delete comment
            if($builder->delete()){
                echo "ok";
            }
            else{
                echo "database error";
            }
        }
        else{
            echo "You are not the owner!";
        }
    }
}
