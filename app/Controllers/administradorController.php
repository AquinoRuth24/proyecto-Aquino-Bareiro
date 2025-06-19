<?php

namespace App\Controllers;
use App\Models\ProductoModel;

class AdministradorController extends BaseController
{
    public function administrador()
    {
        $productoModel = new ProductoModel();
        $productos = $productoModel->where('activo', 1)->findAll();

        return view('pages/administrador', ['productos' => $productos]);
    }
}
