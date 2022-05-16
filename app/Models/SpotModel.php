<?php
namespace App\Models;
use CodeIgniter\Model;

class Spots extends Model
{
    protected $table      = 'spot';
    protected $primaryKey = 'spot_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_spot',
        'id_user', 
        'latitude', 
        'longitude', 
        'date', 
        'name',
        'description'
    ];
}