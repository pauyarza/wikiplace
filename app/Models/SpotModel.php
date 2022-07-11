<?php
namespace App\Models;
use CodeIgniter\Model;

class SpotModel extends Model
{
    protected $table = 'spot';
    protected $primaryKey = 'id_spot';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_spot',
        'id_user', 
        'id_category',
        'latitude', 
        'longitude', 
        'date', 
        'spot_name',
        'description'
    ];
}