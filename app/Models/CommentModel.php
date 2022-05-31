<?php
namespace App\Models;
use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comment';
    protected $primaryKey = 'id_comment';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_comment',
        'id_user', 
        'id_spot', 
        'comment',
    ];
}