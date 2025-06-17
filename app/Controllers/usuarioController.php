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
        return view('templates/main-layout', [
            'title' => 'Inicio Sesion- Yesi Yohi Store',
            'content' => view('pages/login')
        ]);
    }

    public function login()
    {
        helper(['form']);
        // Verificar si el usuario ya está logueado
        if (session()->get('logged_in')) {
            return redirect()->to('/usuarioLogeado')->with('message', 'Ya estás logueado.');
        }
        // Si no está logueado, mostrar el formulario de inicio de sesión
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $usuarioModel = new usuarioModel();
            $usuario = $usuarioModel->where('email', $email)->first();
            // Verificar si el usuario existe y la contraseña es correcta

            if (!$usuario) {
                return redirect()->back()->withInput()->with('error', 'Usuario no encontrado.');
            }
            // Verificar la contraseña
            if (!password_verify($password, $usuario['password'])) {
                return redirect()->back()->withInput()->with('error', 'Contraseña no válida.');
            }
            // Iniciar sesión
            $session = session();
            $session->set([
                'user_id' => $usuario['id_usuario'],
                'nombre' => $usuario['nombre'],
                'email' => $usuario['email'],
                'telefono' => $usuario['telefono'],
                'logged_in' => true
            ]);
            var_dump(session()->get());
            return redirect()->to('/usuarioLogeado')->with('message', 'Inicio de sesión exitoso.');
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
        return redirect()->to('/principal')->with('message', 'Sesión cerrada correctamente.');
    }

    public function usuarioLogeado()
{
    return view('templates/main-layout', [
        'title' => 'Usuario Logeado',
        'content' => view('pages/usuarioLogeado')
    ]);
}

}
