<?php

namespace App\Models;
use CodeIgniter\Model;

class FacturaModel extends Model
{
    protected $table = 'facturas';
    protected $primaryKey = 'id_factura';
    protected $allowedFields = ['id_producto','cantidad','precio_unitario','descuento','subtotal','id_cabecera'];
}