<?php

namespace App\Models;

use CodeIgniter\Model;

class SpotReportModel extends Model
{
    protected $table      = 'spot_report';
    protected $primaryKey = 'id_spot_report';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_spot_report',
        'id_spot',
        'id_user',
        'report_message'
    ];
}
