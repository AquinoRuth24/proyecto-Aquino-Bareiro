<?php

namespace App\Controllers;

use App\Models\usuarioModel;
use CodeIgniter\Controller;

class UsuarioController extends Controller
{
    public function registrar()
    {
        $request = service('request');

        $nombre = $request->getPost('nombre');
        $apellido = $request->getPost('apellido');
        $telefono = $request->getPost('telefono');
        $email = $request->getPost('email');
        $password = $request->getPost('password');
        $confirmar = $request->getPost('confirmar_password');

        // Validar contraseñas iguales
        if ($password !== $confirmar) {
            return redirect()->back()->withInput()->with('error', 'Las contraseñas no coinciden.');
        }

        // Validar email duplicado
        $usuarioModel = new UsuarioModel();
        if ($usuarioModel->where('email', $email)->first()) {
            return redirect()->back()->withInput()->with('error', 'Este correo ya está registrado.');
        }

        // Guardar usuario
        $usuarioModel->insert([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'telefono' => $telefono,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'id_perfil' => 1, // Asignar perfil cliente por defecto
            'estado' => 1 // Asignar estado activo por defecto
        ]);

        return redirect()->to('/login')->with('success', 'Usuario registrado correctamente.');
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
                return "usuariocorrecto";
            }
            // Verificar la contraseña
            if (!password_verify($password, $usuario['password'])) {
                return "usuariocorrecto";
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
            //var_dump(session()->get());
            return redirect()->to('/usuarioLogeado')->with('message', 'Inicio de sesión exitoso.');
        }
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/principal')->with('message', 'Sesión cerrada correctamente.');
    }

    public function usuarioLogeado()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }
        $db = \Config\Database::connect();

        // Se obtienen los productos de la base de datos
        $query = $db->query('SELECT * FROM producto');
        $productos = $query->getResultArray();

        // Se obtienen las imnagenes de los productos
        $query = $db->query('SELECT * FROM imagen_producto');
        $imagenesBd = $query->getResultArray();

        // Se combinan los productos con sus imágenes
        $imagenes = [];
        foreach ($imagenesBd as $imagen) {
            $imagenes[$imagen['id_producto']][] = $imagen['url_imagen'];
        }

        return view('templates/main-layout', [
            'title' => 'Bienvenido - Yesi Yohi Store',
            'content' => view('pages/usuarioLogeado', [
                'nombre' => session('nombre'),
                'email' => session('email'),
                'telefono' => session('telefono'),
                'productos' => $productos,
                'imagenes' => $imagenes
            ])
        ]);
    }
}
