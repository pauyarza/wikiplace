<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'user_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_user',
        'username', 
        'mail', 
        'password', 
        'description', 
        'pofile_pic',
        'pofile_pic_extension'
    ];
}