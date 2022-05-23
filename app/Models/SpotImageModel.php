<?php

namespace App\Models;

use CodeIgniter\Model;

class SpotImageModel extends Model
{
    protected $table      = 'spot_image';
    protected $primaryKey = 'id_spot_image';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_spot_image',
        'id_spot',
        'content',
        'extension',
    ];
}
