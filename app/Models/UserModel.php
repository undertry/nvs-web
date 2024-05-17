<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_user';

    protected $useAutoIncremental = true;

    protected $returnType = 'object';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['name','email','password','created_at'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';


    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    
 


}