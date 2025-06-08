<?php

namespace App\Models;
use CodeIgniter\Model;

class Carrito_compraModel extends Model
{
    protected $table = ' carrito_compra';
    protected $primaryKey = 'id_carrito';
    protected $allowedFields = [ 'id_carrito','id_producto','cantidad','precio_unitario','precio_total'];
}