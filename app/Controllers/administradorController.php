<?php

namespace App\Controllers;

use App\Models\CabeceraModel;
use App\Models\FacturaModel;
use App\Models\ProductoModel;
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
        // Verifica que sea administrador (perfil 3)
        if (!session()->get('isLoggedIn') || session()->get('id_perfil') !== '3') {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado.');
        }

        $cabeceraModel = new \App\Models\CabeceraModel();
        $facturaModel = new \App\Models\FacturaModel();
        $productoModel = new \App\Models\ProductoModel();
        $usuarioModel = new \App\Models\UsuarioModel();

        // Trae todas las ventas (cabeceras de factura)
        $ventas = $cabeceraModel->orderBy('fecha_creacion', 'DESC')->findAll();

        // Por cada cabecera, busca el usuario y los productos facturados
        foreach ($ventas as &$venta) {
            $venta['usuario'] = $usuarioModel->find($venta['id_usuario']);

            $facturas = $facturaModel->where('id_cabecera', $venta['id_cabecera'])->findAll();

            foreach ($facturas as &$factura) {
                $producto = $productoModel->find($factura['id_producto']);
                $factura['producto'] = $producto ? $producto['nombre'] : 'Producto eliminado';
            }

            $venta['facturas'] = $facturas;
        }

        return view('pages/admin/ventas', ['ventas' => $ventas]);
    }
    public function facturas()
    {
        // Verificación de acceso solo para administradores (perfil 3)
        if (!session()->get('isLoggedIn') || session()->get('id_perfil') !== '3') {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado.');
        }

        $cabeceraModel = new CabeceraModel();
        $facturaModel = new FacturaModel();
        $productoModel = new ProductoModel();
        $usuarioModel = new UsuarioModel();

        // Filtros GET desde el formulario
        $fecha = $this->request->getGet('fecha');
        $cliente = $this->request->getGet('cliente');

        $builder = $cabeceraModel;


        if (!empty($fecha)) {
            $builder = $builder->where('DATE(fecha_creacion)', $fecha);
        }


        if (!empty($cliente)) {
            $builder = $builder->where('id_usuario', $cliente);
        }


        $cabeceras = $builder->orderBy('fecha_creacion', 'DESC')->findAll();

        foreach ($cabeceras as &$cabecera) {

            $cabecera['usuario'] = $usuarioModel->find($cabecera['id_usuario']);

            $facturas = $facturaModel->where('id_cabecera', $cabecera['id_cabecera'])->findAll();

            foreach ($facturas as &$factura) {
                $producto = $productoModel->find($factura['id_producto']);
                $factura['producto'] = $producto ? $producto['nombre'] : 'Producto eliminado';
            }

            $cabecera['facturas'] = $facturas;
        }
        $usuarios = $usuarioModel->findAll();

        return view('pages/admin/facturas', [
            'cabeceras' => $cabeceras,
            'usuarios' => $usuarios,
            'fecha' => $fecha,
            'clienteSeleccionado' => $cliente
        ]);
    }
    private function verificarAcceso()
    {
        if (!session()->get('isLoggedIn') || session()->get('id_perfil') !== '3') {
            redirect()->to('/login')->with('error', 'Acceso no autorizado.')->send();
            exit;
        }
    }
    public function registrarVenta()
    {
        $this->verificarAcceso();

        $cabeceraModel = new \App\Models\CabeceraModel();
        $facturaModel = new \App\Models\FacturaModel();

        $id_usuario = 1;
        $fecha = date('Y-m-d H:i:s');

        $cabeceraModel->insert([
            'id_usuario' => $id_usuario,
            'fecha_creacion' => $fecha,
            'precio_total' => 15000
        ]);

        $id_cabecera = $cabeceraModel->insertID();

        $facturaModel->insert([
            'id_cabecera' => $id_cabecera,
            'id_producto' => 1,
            'cantidad' => 1,
            'precio_unitario' => 15000.00,
            'descuento' => 0,
            'subtotal' => 15000.00
        ]);

        return redirect()->to('/admin/facturas')->with('mensaje', 'Venta registrada correctamente.');
    }

}
