<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentReportModel extends Model
{
    protected $table      = 'comment_report';
    protected $primaryKey = 'id_comment_report';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_comment_report',
        'id_comment',
        'id_user',
        'report_message'
    ];
}
