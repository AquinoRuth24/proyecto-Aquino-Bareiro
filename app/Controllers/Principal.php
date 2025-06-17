<?php

namespace App\Controllers;

class Principal extends BaseController
{
    public function index()
    {
        // Proteger la página: solo usuarios logueados pueden verla
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Por favor, inicie sesión para acceder a esta página.');
        }

        return view('templates/main-layout', [
            'title' => 'Bienvenido - Yesi Yohi Store',
            'content' => view('pages/usuarioLogeado', [
                'nombre' => session('nombre'),
                'email' => session('email'),
                'telefono' => session('telefono')
            ])
        ]);
    }
    
}
