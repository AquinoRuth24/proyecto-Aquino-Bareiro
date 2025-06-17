<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Auth extends BaseController
{
    public function loginForm()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/principal');
        }
        return view('templates/main-layout', [
            'title' => 'Inicio Sesion- Yesi Yohi Store',
            'content' => view('pages/login')
        ]);
    }

    public function login()
    {
        $session = session();
        $model = new UsuarioModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $usuario = $model->where('email', $email)->first();

        if ($usuario) {
            if (!$usuario['activo']) {
                $session->setFlashdata('error', 'El usuario está inactivo.');
                return redirect()->to('/login');
            }

            if (password_verify($password, $usuario['contraseña'])) {
                $ses_data = [
                    'id_usuario' => $usuario['id_usuario'],
                    'nombre'     => $usuario['nombre'],
                    'apellido'   => $usuario['apellido'],
                    'email'      => $usuario['email'],
                    'id_perfil'  => $usuario['id_perfil'],
                    'isLoggedIn' => true,
                ];
                $session->set($ses_data);
                return redirect()->to('/principal');
            } else {
                $session->setFlashdata('error', 'Contraseña incorrecta.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'El correo no está registrado.');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login')->with('message', 'Sesión cerrada correctamente.');
    }
}
