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

    public function gracias()
    {
        return view('pages/gracias', [
            'title' => 'Gracias por su compra',
        ]);
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
    public function terminarCompra()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Debés iniciar sesión para finalizar la compra.');
        }

        $carrito = $this->session->get('carrito');

        if (empty($carrito)) {
            return redirect()->to('/carrito')->with('error', 'El carrito está vacío.');
        }

        $idUsuario = session()->get('user_id');
        $cabeceraModel = new \App\Models\CabeceraModel();
        $facturaModel = new \App\Models\FacturaModel();
        $productoModel = new \App\Models\ProductoModel();

        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        // Insertar cabecera
        $idCabecera = $cabeceraModel->insert([
            'id_usuario' => $idUsuario,
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'precio_total' => $total
        ], true); // true para retornar el ID

        // Insertar detalle de la factura por producto
        foreach ($carrito as $item) {
            $facturaModel->insert([
                'id_producto' => $item['id'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
                'descuento' => 0,
                'subtotal' => $item['precio'] * $item['cantidad'],
                'id_cabecera' => $idCabecera
            ]);

            $producto = $productoModel->find($item['id']);
            if ($producto) {
                $nuevoStock = $producto['stock'] - $item['cantidad'];
                $productoModel->update($item['id'], ['stock' => $nuevoStock]);
            }
        }

        $this->session->remove('carrito');

        return view('pages/gracias', [
            'title' => 'Gracias por su compra',
        ]);
    }
}
