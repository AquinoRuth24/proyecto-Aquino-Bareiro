<?php

namespace App\Models;
use CodeIgniter\Model;

class FacturasModel extends Model
{
    protected $table = 'facturas';
    protected $primaryKey = 'id_factura';
    protected $allowedFields = ['id_producto','cantiidad','precio_unitario','descuento','subtotal',];
}