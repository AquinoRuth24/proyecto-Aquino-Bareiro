<?php

namespace App\Controllers;

use App\Models\CarritosModel;
use App\Models\Carrito_compraModel;
use App\Models\ProductoModel;
use CodeIgniter\Controller;

class CarritoController extends Controller
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function agregar($id_producto)
    {
        $productoModel = new ProductoModel();
        $producto = $productoModel->find($id_producto);

        if (!$producto || !$producto['activo']) {
            return redirect()->back()->with('error', 'Producto no válido');
        }

        $carrito = $this->session->get('carrito') ?? [];

        $cantidad_actual = isset($carrito[$id_producto]) ? $carrito[$id_producto]['cantidad'] : 0;

        if ($cantidad_actual + 1 > $producto['stock']) {
            return redirect()->back()->with('error', 'Stock insuficiente para agregar este producto');
        }

        if (isset($carrito[$id_producto])) {
            $carrito[$id_producto]['cantidad']++;
        } else {
            $carrito[$id_producto] = [
                'id' => $producto['id_producto'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => 1
            ];
        }

        $this->session->set('carrito', $carrito);
        return redirect()->to('/catalogoProductos')->with('success', 'Producto agregado al carrito');
    }

    public function eliminar($id_producto)
    {
        $carrito = $this->session->get('carrito');
        unset($carrito[$id_producto]);
        $this->session->set('carrito', $carrito);
        return redirect()->back()->with('success', 'Producto eliminado');
    }

    public function vaciar()
    {
        $this->session->remove('carrito');
        return redirect()->to('/catalogoProductos')->with('success', 'Carrito vaciado');
    }

    public function ver()
    {
        $carrito = $this->session->get('carrito') ?? [];
        return view('pages/carrito', [
            'title'   => 'Mi Carrito - Yesi Yohi Store',
            'carrito' => $carrito
        ]);
    }

    public function comprar()
    {
        if (!session()->has('id_usuario')) {
            session()->setFlashdata('redirect_after_login', 'carrito');
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para finalizar la compra');
        }

        $carrito = $this->session->get('carrito');
        if (!$carrito) {
            return redirect()->back()->with('error', 'El carrito está vacío');
        }

        $carritosModel = new CarritosModel();
        $carritoCompraModel = new Carrito_compraModel();
        $productoModel = new ProductoModel();

        $id_usuario = session('id_usuario');

        $id_carrito = $carritosModel->insert([
            'id_usuario' => $id_usuario,
            'fecha_creado' => date('Y-m-d H:i:s')
        ]);

        foreach ($carrito as $item) {
            $producto = $productoModel->find($item['id']);
            if ($producto && $producto['stock'] >= $item['cantidad']) {
                $nuevoStock = $producto['stock'] - $item['cantidad'];
                $productoModel->update($item['id'], ['stock' => $nuevoStock]);

                $carritoCompraModel->insert([
                    'id_carrito' => $id_carrito,
                    'id_producto' => $item['id'],
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio'],
                    'precio_total' => $item['precio'] * $item['cantidad']
                ]);
            }
        }

        $this->session->remove('carrito');

        return view('pages/gracias');
    }

    public function gracias()
    {
        return view('pages/gracias');
    }
    public function historial()
    {
        $id_usuario = session('id_usuario') ?? 1;

        $carritosModel = new CarritosModel();
        $carritoCompraModel = new Carrito_compraModel();
        $productoModel = new ProductoModel();

        $carritos = $carritosModel->where('id_usuario', $id_usuario)->orderBy('fecha_creado', 'DESC')->findAll();
        $historial = [];

        foreach ($carritos as $carrito) {
            $items = $carritoCompraModel->where('id_carrito', $carrito['id_carrito'])->findAll();
            foreach ($items as &$item) {
                $producto = $productoModel->find($item['id_producto']);
                $item['nombre_producto'] = $producto ? $producto['nombre'] : 'Producto eliminado';
            }
            $carrito['items'] = $items;
            $historial[] = $carrito;
        }

        return view('pages/historial', [
            'title' => 'Historial de Compras',
            'historial' => $historial
        ]);
    }
}
