<?php

namespace App\Models\secondary\form;

use CodeIgniter\Model;

class CodeModel extends Model
{
    protected $table = "code"; // Nombre de la tabla de usuarios
    protected $primaryKey = "id_recovery_code"; // Llave primaria de la tabla

    protected $useAutoIncrement = true;

    protected $returnType = "object";
    // protected $useSoftDeletes = true;

    protected $allowedFields = ["recovery_code", "id_user"];

    protected $useTimestamps = false;
    protected $createdField = "created_at";

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function isCodTaken($recovery_code)
    {
        return $this->where('recovery_code', $recovery_code)->countAllResults() > 0;
    }

    public function insertcod($data)
    {
        $this->insert($data);
    }

    public function getCodeByUserId($id_user)
    {
        return $this->where("id_user", $id_user)->first(); // Cambiado a first() para obtener solo un resultado
    }

    public function updatecode($recovery_code, $id_recovery_code)
    {
        $this->set('recovery_code', $recovery_code)->where('id_recovery_code', $id_recovery_code)->update();
    }

    public function getUserByCode($code)
{
    return $this//->db->table($this->table)
        ->select('id_user')
        ->where('recovery_code', $code)
        ->get()
        ->getRow();
}

public function deleteByCode($code)
{
    return $this->db->table($this->table)
        ->where('recovery_code', $code)
        ->delete();
}
}