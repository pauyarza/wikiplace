<?php

namespace App\Models;

use CodeIgniter\Model;

class SpotFavModel extends Model
{
    protected $table      = 'spot_fav';
    protected $primaryKey = 'id_spot_fav';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_spot_fav',
        'id_spot',
        'id_user',
    ];
}
