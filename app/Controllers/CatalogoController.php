<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\CategoriaModel;
use App\Models\ImagenModel;

class CatalogoController extends BaseController
{
    public function index()
    {
        $productoModel = new ProductoModel();
        $categoriaModel = new CategoriaModel();
        $imagenModel = new ImagenModel();

        // Filtros
        $nombre     = $this->request->getGet('nombre');
        $categoria  = $this->request->getGet('categoria');
        $precioMin  = $this->request->getGet('precio_min');
        $precioMax  = $this->request->getGet('precio_max');

        $builder = $productoModel
            ->select('productos.*, imagen.url_imagen')
            ->join('imagen', 'imagen.id_producto = productos.id_producto AND imagen.es_principal = 1', 'left')
            ->where('productos.activo', 1);


        if ($nombre) {
            $builder->like('productos.nombre', $nombre);
        }

        if ($categoria) {
            $builder->where('productos.id_categoria', $categoria);
        }

        if ($precioMin) {
            $builder->where('productos.precio >=', $precioMin);
        }

        if ($precioMax) {
            $builder->where('productos.precio <=', $precioMax);
        }

        $productos  = $builder->findAll();
        $categorias = $categoriaModel->findAll();

        return view('pages/catalogoProductos', [
            'productos'  => $productos,
            'categorias' => $categorias,
            'filtros'    => [
                'nombre'      => $nombre,
                'categoria'   => $categoria,
                'precio_min'  => $precioMin,
                'precio_max'  => $precioMax
            ]
        ]);
    }
}
