<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentLikeModel extends Model
{
    protected $table      = 'comment_like';
    protected $primaryKey = 'id_comment_like';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_comment_like',
        'id_comment',
        'id_user',
    ];
}
