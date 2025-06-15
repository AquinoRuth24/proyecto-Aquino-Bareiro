<?php

namespace App\Controllers;

use App\Models\usuarioModel;
use CodeIgniter\Controller;

class usuarioController extends Controller
{
    public function registrar()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            $password = $this->request->getPost('password');
            $confirmar = $this->request->getPost('confirmar_password');

            // Verificar que las contraseñas coincidan
            if ($password !== $confirmar) {
                return redirect()->back()->withInput()->with('error', 'Las contraseñas no coinciden.');
            }

            $usuarioModel = new usuarioModel();

            // Verificar que el email no esté registrado
            if ($usuarioModel->where('email', $this->request->getPost('email'))->first()) {
                return redirect()->back()->withInput()->with('error', 'Este correo ya está registrado.');
            }

            $data = [
                'nombre'   => $this->request->getPost('nombre'),
                'telefono' => $this->request->getPost('telefono'),
                'email'    => $this->request->getPost('email'),
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];

            $usuarioModel->insert($data);

            return redirect()->to('/login')->with('message', '¡Registro exitoso!');
        }

        return view('registro');
    }

    public function login()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $usuarioModel = new usuarioModel();
            $usuario = $usuarioModel->where('email', $email)->first();

            if ($usuario && password_verify($password, $usuario['password'])) {
                session()->set('logged_in', true);
                session()->set('user_id', $usuario['id-usuario']);
                session()->set('user_name', $usuario['nombre']);

                return redirect()->to('/principal')->with('message', '¡Inicio de sesión exitoso!');
            } else {
                return redirect()->back()->withInput()->with('error', 'Credenciales incorrectas.');
            }
        }

        return view('templates/main-layout', [
            'title' => 'Inicio Sesion- Yesi Yohi Store',
            'content' => view('pages/login')
        ]);
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login')->with('message', 'Sesión cerrada correctamente.');
    }
}
