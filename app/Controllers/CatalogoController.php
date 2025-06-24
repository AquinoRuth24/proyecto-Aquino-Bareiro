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
        // Agrupar categorías en secciones
        $categoriasAgrupadas = [
            'Por tipo de público' => ['Hombres', 'Mujeres', 'Niños', 'Niñas', 'Bebés', 'Unisex'],
            'Parte superior' => ['Remeras', 'Camisas', 'Buzos', 'Camperas', 'Chalecos', 'Tops', 'Sweaters', 'Poleras'],
            'Parte inferior' => ['Jeans', 'Pantalones', 'Calzas', 'Shorts', 'Faldas'],
            'Para dormir' => ['Pijamas', 'Batas'],
            'Otros' => ['Conjuntos', 'Trajes', 'Uniformes'],
            'Por temporada' => ['Primavera / Verano', 'Otoño / Invierno'],
            'Por estilo o actividad' => ['Deportivo', 'Urbano', 'Elegante', 'Casual', 'Formal', 'Trabajo', 'Playa'],
        ];
        // Crear un mapa de [id_categoria => nombre]
        $categoriasMap = [];
        foreach ($categorias as $cat) {
            $categoriasMap[$cat['id_categoria']] = $cat['nombre'];
        }


        return view('pages/catalogoProductos', [
            'productos'          => $productos,
            'categorias'         => $categorias,
            'categoriasAgrupadas' => $categoriasAgrupadas,
            'categoriasMap'     => $categoriasMap,
            'filtros'            => [
                'nombre'      => $nombre,
                'categoria'   => $categoria,
                'precio_min'  => $precioMin,
                'precio_max'  => $precioMax
            ],
            'title' => 'Catálogo de Productos - Yesi Yohi Store'
        ]);
    }
}
