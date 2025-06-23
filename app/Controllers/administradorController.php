<?php

namespace App\Controllers;

use App\Models\CabeceraModel;
use App\Models\FacturaModel;
use App\Models\ProductoModel;
use App\Models\VentaModel;
use App\Models\DetalleVentaModel;
use App\Models\UsuarioModel;
use App\Models\ImagenModel;


class AdministradorController extends BaseController
{
    public function administrador()
    {
        if (!session()->get('isLoggedIn') || session()->get('id_perfil') !== '3') {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado.');
        }
        $productoModel = new ProductoModel();
        $imagenModel = new ImagenModel();
        // Se obtienen los productos de la base de datos
        $productos = $productoModel->findAll();
        // Se obtienen las imágenes de los productos
        $imagenesBd = $imagenModel->findAll();
        // Se combinan los productos con sus imágenes
        $imagenes = [];
        foreach ($imagenesBd as $imagen) {
            $imagenes[$imagen['id_producto']][] = $imagen['url_imagen'];
        }

        return view('pages/administrador', ['productos' => $productos]);
    }

    public function ventas()
    {
        $ventaModel = new VentaModel();
        $detalleVentaModel = new DetalleVentaModel();
        $productoModel = new ProductoModel();

        $ventas = $ventaModel->findAll();

        foreach ($ventas as &$venta) {
            $venta['detalles'] = $detalleVentaModel->where('id_venta', $venta['id'])->findAll();

            foreach ($venta['detalles'] as &$detalle) {
                $producto = $productoModel->find($detalle['id_producto']);
                $detalle['producto'] = $producto ? $producto['nombre'] : 'Producto no encontrado';
            }
        }

        return view('pages/admin/ventas', ['ventas' => $ventas]);
    }
    public function facturas()
    {
        $cabeceraModel = new CabeceraModel();
        $facturaModel = new FacturaModel();
        $productoModel = new ProductoModel();
        $usuarioModel = new UsuarioModel();

        // Obtener filtros del formulario
        $fecha = $this->request->getGet('fecha');
        $cliente = $this->request->getGet('cliente');

        $builder = $cabeceraModel;

        // Filtro por fecha (yyyy-mm-dd)
        if (!empty($fecha)) {
            $builder = $builder->where('DATE(fecha_creacion)', $fecha);
        } else {
            // Por defecto: solo las de hoy
            $builder = $builder->where('DATE(fecha_creacion)', date('Y-m-d'));
        }

        // Filtro por cliente
        if (!empty($cliente)) {
            $builder = $builder->where('id_usuario', $cliente);
        }

        $cabeceras = $builder->findAll();

        foreach ($cabeceras as &$cabecera) {
            $cabecera['usuario'] = $usuarioModel->find($cabecera['id_usuario']);

            $facturas = $facturaModel->where('id_cabecera', $cabecera['id_cabecera'])->findAll();
            foreach ($facturas as &$factura) {
                $producto = $productoModel->find($factura['id_producto']);
                $factura['producto'] = $producto ? $producto['nombre'] : 'Producto eliminado';
            }

            $cabecera['facturas'] = $facturas;
        }

        // Pasamos los usuarios para el filtro por cliente
        $usuarios = $usuarioModel->findAll();

        return view('pages/admin/facturas', [
            'cabeceras' => $cabeceras,
            'usuarios' => $usuarios,
            'fecha' => $fecha,
            'clienteSeleccionado' => $cliente
        ]);
    }
}
