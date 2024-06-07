<?php

namespace App\Models;

use CodeIgniter\Model;

class CodigoModel extends Model
{
    protected $table = "codigo"; // Nombre de la tabla de usuarios
    protected $primaryKey = "id_codigo_recuperacion"; // Llave primaria de la tabla

    protected $useAutoIncrement = true;

    protected $returnType = "object";
    // protected $useSoftDeletes = true;

    protected $allowedFields = ["cod_recup", "id_user"];

    protected $useTimestamps = false;
    protected $createdField = "created_at";

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    public function isCodTaken($cod_recup)
    {
        return $this->where('cod_recup', $cod_recup)->countAllResults() > 0;
    }

    public function insertcod($data)
    {
        $this->insert($data);
    }

    public function getCodeByUserId($id_user)
    {
        return $this->where("id_user", $id_user)->first(); // Cambiado a first() para obtener solo un resultado
    }

    public function updatecode($cod_recup, $id_codigo_recuperacion)
    {
        $this->set('cod_recup', $cod_recup)->where('id_codigo_recuperacion', $id_codigo_recuperacion)->update();
    }

    public function getUserByCodigo($codigo)
{
    return $this->db->table($this->table)
        ->select('id_user')
        ->where('cod_recup', $codigo)
        ->get()
        ->getRow();
}

public function deleteByCodigo($codigo)
{
    return $this->db->table($this->table)
        ->where('cod_recup', $codigo)
        ->delete();
}
}