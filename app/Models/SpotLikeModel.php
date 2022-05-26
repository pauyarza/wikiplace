<?php

namespace App\Models;

use CodeIgniter\Model;

class SpotLikeModel extends Model
{
    protected $table      = 'spot_like';
    protected $primaryKey = 'id_spot_like';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_spot_like',
        'id_spot',
        'id_user',
    ];
}
