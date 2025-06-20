<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\ImagenModel;
use CodeIgniter\Controller;

class ProductoController extends Controller
{
    public function index()
    {
        $productoModel = new ProductoModel();
        $imagenModel = new ImagenModel();

        $productos = $productoModel->where('activo', 1)->findAll();
        $imagenes = [];

        foreach ($productos as &$producto) {
            $imagenes[$producto['id_producto']] = array_column(
                $imagenModel->where('id_producto', $producto['id_producto'])->findAll(),
                'url_imagen'
            );
        }

        return view('pages/productos/index', ['productos' => $productos, 'imagenes' => $imagenes]);
    }

    public function crearProducto()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'nombre' => 'required|min_length[3]',
                'descripcion' => 'required|min_length[3]',
                'precio' => 'required|decimal',
                'stock'  => 'required|integer'
            ];

            if (! $this->validate($validationRules)) {
                return view('pages/productos/crearProducto', [
                    'validation' => $this->validator
                ]);
            }

            $productoModel = new ProductoModel();
            $imagenModel = new ImagenModel();

            // Insertar producto
            $datos = [
                'nombre'      => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'precio'      => $this->request->getPost('precio'),
                'stock'       => $this->request->getPost('stock'),
                'activo'      => 1
            ];

            if (!$productoModel->insert($datos)) {
                dd($productoModel->errors());
            }

            // Obtener el ID insertado
            $idProducto = $productoModel->insertID();

            $imagen = $this->request->getFile('imagen');
            if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
                $nombreImagen = $imagen->getRandomName();
                $imagen->move('uploads', $nombreImagen);

                $imagenModel->insert([
                    'id_producto' => $idProducto,
                    'url_imagen'  => $nombreImagen,
                    'es_principal' => 1
                ]);
            }

            session()->setFlashdata('success', 'Producto creado exitosamente.');
            return redirect()->to('/producto');
        }

        return view('pages/productos/crearProducto');
    }


    public function editarProducto($id)
    {
        helper(['form', 'url']);
        $productoModel = new ProductoModel();
        $imagenModel = new ImagenModel();

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'nombre' => 'required|min_length[3]',
                'precio' => 'required|decimal',
                'stock'  => 'required|integer'
            ];
            if (! $this->validate($validationRules)) {
                $producto = $productoModel->find($id);
                $imagenes = $imagenModel->where('id_producto', $id)->findAll();
                return view('pages/productos/editarProducto', [
                    'producto' => $producto,
                    'imagenes' => $imagenes,
                    'validation' => $this->validator
                ]);
            }
            $productoModel->update($id, [
                'nombre'      => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'precio'      => $this->request->getPost('precio'),
                'stock'       => $this->request->getPost('stock'),
            ]);

            $imagenArchivo = $this->request->getFile('imagen');
            if ($imagenArchivo && $imagenArchivo->isValid() && !$imagenArchivo->hasMoved()) {
                // Marcar todas las imágenes existentes como no principales
                $imagenModel->where('id_producto', $id)
                    ->set(['es_principal' => 0])
                    ->update();

                // Guardar la nueva imagen como principal
                $nombre = $imagenArchivo->getRandomName();
                $imagenArchivo->move('public/assets/img/', $nombre);

                $imagenModel->insert([
                    'id_producto'  => $id,
                    'url_imagen'   => 'public/assets/img/' . $nombre,
                    'es_principal' => 1,
                ]);
            }

            return redirect()->to('/producto');
        }
        $producto = $productoModel->find($id);
        $imagenes = $imagenModel->where('id_producto', $id)->findAll();

        return view('pages/productos/editarProducto', ['producto' => $producto, 'imagenes' => $imagenes]);
    }

    public function eliminarProducto($id)
    {
        $productoModel = new ProductoModel();
        $productoModel->update($id, ['activo' => 0]);
        return redirect()->to('/producto');
    }

    public function productosEliminados()
    {
        $productoModel = new ProductoModel();

        $productos = $productoModel->where('activo', 0)->findAll();

        return view('pages/productos/productosEliminados', ['productos' => $productos]);
    }

    public function restaurarProducto($id)
    {
        $productoModel = new ProductoModel();
        $productoModel->update($id, ['activo' => 1]);
        return redirect()->to('/producto/productosEliminados');
    }
}
