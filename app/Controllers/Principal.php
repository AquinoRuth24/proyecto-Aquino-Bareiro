<?php

namespace App\Controllers;

class Principal extends BaseController
{
    public function index()
    {
        // Proteger la página: solo usuarios logueados pueden verla
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login') ->with('error', 'Por favor, inicie sesión para acceder a esta página.');
        }

        // Si está logueado, mostrar la vista principal
        return view('principal');
    }
}
