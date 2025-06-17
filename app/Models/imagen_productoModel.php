<?php

namespace App\Models;
use CodeIgniter\Model;

class Imagen_productoModel extends Model
{
    protected $table = 'imagenes_productos';
    protected $primaryKey = 'id_imagen';
    protected $allowedFields = ['id_producto','url_imagen', ];
}