<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('templates/main-layout', [
            'title' => 'Principal-Yesi Yohi Store',
            'content' => view('pages/principal')
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
    public function consultas(): string
    {
        return view('templates/main-layout', [
            'title' => 'Consultas-Yesi Yohi Store',
            'content' => view('pages/consultas')
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
        'title' => 'Inicio Secion- Yesi Yohi Store',
        'content' => view('pages/login')
    ]);
}
    public function enviarConsulta()
    {
        $nombre = $this->request->getPost('nombre');
        $email = $this->request->getPost('email');
        $telefono = $this->request->getPost('telefono');
        $mensaje = $this->request->getPost('mensaje');

        /* Aca hay que configurar el envío de la consulta a la base de datos o a un servicio de correo */
        return redirect()->back()->with('mensaje', '¡Gracias por tu consulta! Te responderemos pronto.');
    }
}