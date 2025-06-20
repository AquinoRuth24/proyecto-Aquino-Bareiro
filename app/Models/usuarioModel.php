<?php

namespace App\Models;
use CodeIgniter\Model;

class usuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['id_perfil','nombre', 'apellido', 'email','password','telefono', 'estado' ];
}