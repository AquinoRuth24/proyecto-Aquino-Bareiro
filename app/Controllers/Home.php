<?php

namespace App\Controllers;
use App\Models\ProductoModel;
use App\Models\ImagenModel; 

class Home extends BaseController
{
    public function index(): string
    {
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

        return view('templates/main-layout', [
            'title' => 'Principal-Yesi Yohi Store',
            'content' => view('pages/principal', ['productos' => $productos, 'imagenes' => $imagenes])
        ]);
    }
    public function quienesSomos(): string
    {
        return view('templates/main-layout', [
            'title' => '¿Quienes Somos? - Yesi Yohi Store',
            'content' => view('pages/quienesSomos')
        ]);
    }
    public function comercializacion(): string
    {
        return view('templates/main-layout', [
            'title' => 'Comercializacion - Yesi Yohi Store',
            'content' => view('pages/comercializacion')
        ]);
    }
    public function informacionContacto(): string
    {
        return view('templates/main-layout', [
            'title' => 'Informacion de Contacto - Yesi Yohi Store',
            'content' => view('pages/informacionContacto')
        ]);
    }
    public function terminosYUsos(): string
    {
        return view('templates/main-layout', [
            'title' => 'Terminos y Usos - Yesi Yohi Store',
            'content' => view('pages/terminosYUsos')
        ]);
    }

    public function catalogoProductos(): string
    {
        return view('templates/main-layout', [
            'title' => 'Catalogo de Productos - Yesi Yohi Store',
            'content' => view('pages/catalogoProductos')
        ]);
    }
    public function consultas()
    {
        return view('templates/main-layout', [
            'title' => 'Consultas-Yesi Yohi Store',
            'content' => view('pages/consultas')
        ]);
    }

    public function administrador(): string
    {
        return view('templates/main-layout', [
            'title' => 'administrador - Yesi Yohi Store',
            'content' => view('pages/administrador')
        ]);
    }


    public function carrito(): string
    {
        return view('templates/main-layout', [
            'title' => 'Mi Carrito - Yesi Yohi Store',
            'content' => view('pages/carrito')
        ]);
    }
    public function login(): string
    {
        return view('templates/main-layout', [
            'title' => 'Inicio Sesion- Yesi Yohi Store',
            'content' => view('pages/login')
        ]);
    }
    public function registrar(): string
    {
        return view('templates/main-layout', [
            'title' => 'Registro de Usuario - Yesi Yohi Store',
            'content' => view('pages/registrar')
        ]);
    }

    public function guardarUsuario()
    {
        $nombre = $this->request->getPost('nombre');
        $email = $this->request->getPost('email');
        $telefono = $this->request->getPost('telefono');
        $password = $this->request->getPost('password');
    }



    public function enviarMensaje()
    {
        $nombre = $this->request->getPost('nombre');
        $email = $this->request->getPost('email');
        $telefono = $this->request->getPost('telefono');
        $mensaje = $this->request->getPost('mensaje');

        // Acá podrías guardar el mensaje en la base de datos o enviarlo por email
        // Ejemplo de guardar en la tabla 'mensajes':
        /*
    $contactoModel = new \App\Models\ContactoModel();
    $contactoModel->save([
        'nombre' => $nombre,
        'email' => $email,
        'telefono' => $telefono,
        'mensaje' => $mensaje,
    ]);
    */

        return redirect()->back()->with('mensaje', '¡Gracias por tu consulta! Te responderemos pronto.');
    }
}
