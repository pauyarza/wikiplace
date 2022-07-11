<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'category';
    protected $primaryKey = 'id_category';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_category',
        'id_creator',
        'name',
    ];
}
