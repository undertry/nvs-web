<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'usuarios'; // Nombre de la tabla de usuarios
    protected $primaryKey = 'id_user'; // Llave primaria de la tabla

    protected $useAutoIncrement = true;

    protected $returnType = 'object';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'email', 'password', 'created_at'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    public function isEmailTaken($email)
{
    return $this->where('email', $email)->countAllResults() > 0;
}

public function register($ra)
{
    $this->insert($ra);

}
public function getUserByEmail($email)
{
    return $this->select('id_user, name, email,password')
                ->where('email', $email)
                ->first();
}

    /* 
    public function isCodTaken($cod_recup)
    {
        return $this->where('cod_recup', $cod_recup)->countAllResults() > 0;
    }

    public function codrecup($data)
    {
        $this->insert($data);
    }
    */
}
