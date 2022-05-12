<?php
namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model {
    protected $table = 'usuaris';
    protected $primaryKey = 'codiU';
    protected $returnType = 'array';
    protected $allowedFields = [
        "codiU",
        "correu",
        "password",
        "telefon"
    ];
}


?>