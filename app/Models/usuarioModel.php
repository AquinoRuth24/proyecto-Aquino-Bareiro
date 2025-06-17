<?php

namespace App\Models;
use CodeIgniter\Model;

class usuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['nombre', 'email','password','telefono' ];
}