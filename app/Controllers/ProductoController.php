<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\ImagenModel;
use App\Models\CategoriaModel;
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
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll();

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'nombre'        => 'required|min_length[3]',
                'descripcion'   => 'required|min_length[3]',
                'precio'        => 'required|decimal',
                'stock'         => 'required|integer',
                'id_categoria'  => 'required|integer',
                'imagen'        => 'uploaded[imagen]|is_image[imagen]|mime_in[imagen,image/jpg,image/jpeg,image/png]'
            ];

            if (!$this->validate($validationRules)) {
                return view('pages/productos/crearProducto', [
                    'validation' => $this->validator,
                    'categorias' => $categorias
                ]);
            }

            $productoModel = new ProductoModel();
            $imagenModel = new ImagenModel();

            $datos = [
                'nombre'        => $this->request->getPost('nombre'),
                'descripcion'   => $this->request->getPost('descripcion'),
                'precio'        => $this->request->getPost('precio'),
                'stock'         => $this->request->getPost('stock'),
                'activo'        => 1,
                'id_categoria'  => $this->request->getPost('id_categoria'),
            ];

            if (!$productoModel->insert($datos)) {
                dd('Error al insertar producto', $productoModel->errors());
            }

            $idProducto = $productoModel->insertID();
            $imagen = $this->request->getFile('imagen');

            if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
                $nombreImagen = $imagen->getRandomName();

                if (!$imagen->move(FCPATH . 'assets/img/', $nombreImagen)) {
                    dd('Error al mover la imagen');
                }

                $imagenModel->insert([
                    'id_producto'  => $idProducto,
                    'url_imagen'   => $nombreImagen,
                    'es_principal' => 1
                ]);
            }

            session()->setFlashdata('success', 'Producto creado exitosamente.');
            return redirect()->to('/producto');
        }

        return view('pages/productos/crearProducto', ['categorias' => $categorias]);
    }

    public function editarProducto($id)
    {
        helper(['form', 'url']);
        $productoModel = new ProductoModel();
        $imagenModel = new ImagenModel();
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll();

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'nombre'        => 'required|min_length[3]',
                'descripcion'   => 'required|min_length[3]',
                'precio'        => 'required|decimal',
                'stock'         => 'required|integer',
                'id_categoria'  => 'required|integer',
            ];

            if (!$this->validate($validationRules)) {
                $producto = $productoModel->find($id);
                $imagenes = $imagenModel->where('id_producto', $id)->findAll();
                return view('pages/productos/editarProducto', [
                    'producto'   => $producto,
                    'imagenes'   => $imagenes,
                    'categorias' => $categorias,
                    'validation' => $this->validator
                ]);
            }

            $productoModel->update($id, [
                'nombre'        => $this->request->getPost('nombre'),
                'descripcion'   => $this->request->getPost('descripcion'),
                'precio'        => $this->request->getPost('precio'),
                'stock'         => $this->request->getPost('stock'),
                'id_categoria'  => $this->request->getPost('id_categoria'),
            ]);

            $imagenArchivo = $this->request->getFile('imagen');
            if ($imagenArchivo && $imagenArchivo->isValid() && !$imagenArchivo->hasMoved()) {
                $imagenModel->where('id_producto', $id)
                    ->set(['es_principal' => 0])
                    ->update();

                $nombre = $imagenArchivo->getRandomName();
                $imagenArchivo->move(FCPATH . 'assets/img/', $nombre);

                $imagenModel->insert([
                    'id_producto'  => $id,
                    'url_imagen'   => $nombre,
                    'es_principal' => 1,
                ]);
            }

            return redirect()->to('/producto');
        }

        $producto = $productoModel->find($id);
        $imagenes = $imagenModel->where('id_producto', $id)->findAll();

        return view('pages/productos/editarProducto', [
            'producto'   => $producto,
            'imagenes'   => $imagenes,
            'categorias' => $categorias
        ]);
    }
    public function eliminarProducto($id)
    {
        $productoModel = new ProductoModel();

        $productoModel->update($id, ['activo' => 0]);

        return redirect()->to('producto')->with('success', 'Producto eliminado lógicamente');
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

        return redirect()->to('producto')->with('success', 'Producto restaurado');
    }
}

/*

namespace App\Controllers;

use App\Models\productoModel;
use App\Models\categoriaModel;
use CodeIgniter\Controller;

class ProductoController extends Controller
{
    public function crearProducto()
    {
        helper(['form']);

        $categoriaModel = new categoriaModel();
        $data['categorias'] = $categoriaModel->findAll();

        $dato = ['titulo' => 'Alta de Producto'];

        return view('front/head_view', $dato)
            . view('front/nav_view')
            . view('back/alta_producto_view', $data)
            . view('front/footer_view');
    }

    public function store()
    {
        $input = $this->validate([
            'nombre_prod'   => 'required|min_length[3]',
            'marca'         => 'required|min_length[1]',
            'imagen'        => 'uploaded[imagen]|is_image[imagen]|mime_in[imagen,image/jpg,image/jpeg,image/png]',
            'categoria_id'  => 'is_not_unique[categorias.id]',
            'precio'        => 'required|numeric',
            'precio_vta'    => 'required|numeric',
            'stock'         => 'required|integer',
            'stock_min'     => 'required|integer',
        ]);

        if (!$input) {
            $categoriaModel = new categoriaModel();
            $data['categorias'] = $categoriaModel->findAll();
            $data['validation'] = $this->validator;

            $dato = ['titulo' => 'Alta de Producto'];

            return view('front/head_view', $dato)
                . view('front/nav_view')
                . view('back/alta_producto_view', $data)
                . view('front/footer_view');
        }

        $img = $this->request->getFile('imagen');
        $nombre_aleatorio = $img->getRandomName();
        $img->move(ROOTPATH . 'public/assets/uploads', $nombre_aleatorio);

        $data = [
            'nombre_prod'   => $this->request->getVar('nombre_prod'),
            'marca'         => $this->request->getVar('marca'),
            'imagen'        => $nombre_aleatorio,
            'categoria_id'  => $this->request->getVar('categoria_id'),
            'precio'        => $this->request->getVar('precio'),
            'precio_vta'    => $this->request->getVar('precio_vta'),
            'stock'         => $this->request->getVar('stock'),
            'stock_min'     => $this->request->getVar('stock_min'),
        ];

        $productoModel = new productoModel();
        $productoModel->insert($data);

        session()->setFlashdata('success', 'Alta Exitosa...');
        return redirect()->to('/producto');
    }
}
*/