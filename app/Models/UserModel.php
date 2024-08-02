<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "usuarios"; // Nombre de la tabla de usuarios
    protected $primaryKey = "id_user"; // Llave primaria de la tabla

    protected $useAutoIncrement = true;

    protected $returnType = "object";
    // protected $useSoftDeletes = true;

    protected $allowedFields = ["name", "email", "password", "created_at", "verification"];

    protected $useTimestamps = false;
    protected $createdField = "created_at";

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;


    public function isEmailTaken($email)
    {
        return $this->where("email", $email)->countAllResults() > 0;
    }

    public function register($data)
    {
        $this->insert($data);
    }
    // Consulta para obtener datos de un Usuario por su email, los campos id_user, name, email, password, created_at
    public function getUserByEmail($email)
    {
        return $this->select("id_user, name, email, password, created_at,verification")
            ->where("email", $email)
            ->first();
    }
    public function password_change($id_user,$data)
    {
        $this->update($id_user, $data);
    }
    public function GetIdByemail($emailU)
    {
    return $this->select("id_user")
                ->where("email",$emailU)
                ->first();
    }

    public function verification($email,$verificationstatus)
    {
        $this->where('email', $email)
             ->set(['verification' => $verificationstatus])->update();
    }
    
}
