<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\ProductoModel;
use App\Models\ImagenModel;
use CodeIgniter\Controller;
use App\Models\CabeceraModel;
use App\Models\Carrito_compraModel;

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
        $request = service('request');
        // Verificar si el usuario ya está logueado
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/')->with('message', 'Ya estás logueado.');
        }
        // Datos cargados desde el formulario de inicio de sesión
        if ($request->getMethod() === 'POST') {
            $email = $request->getPost('email');
            $password = $request->getPost('password');

            $usuarioModel = new usuarioModel();
            $usuario = $usuarioModel->where('email', $email)->first();
            // Verificar si el usuario existe y la contraseña es correcta

            if (!$usuario) {
                return redirect()->back()->withInput()->with('error', 'Usuario no encontrado.');
            }
            // Verificar la contraseña
            if (!password_verify($password, $usuario['password'])) {
                return redirect()->back()->withInput()->with('error', 'Contraseña incorrecta.');
            }
            // Iniciar sesión
            $session = session();
            $session->set([
                'user_id' => $usuario['id_usuario'],
                'id_perfil' => $usuario['id_perfil'],
                'nombre' => $usuario['nombre'],
                'email' => $usuario['email'],
                'telefono' => $usuario['telefono'],
                'isLoggedIn' => true,
            ]);
            if ($usuario['id_perfil'] == 3) {
                return redirect()->to('/administrador')->with('message', 'Bienvenido al panel administrador.');
            } else {
                return redirect()->to('/')->with('message', 'Inicio de sesión exitoso.');
            }
        }
        // Si no es una solicitud POST, mostrar el formulario de inicio de sesión
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
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
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
    public function index()
    {
        $usuarioModel = new UsuarioModel();
        $cabeceraModel = new CabeceraModel();

        $usuarios = $usuarioModel->findAll();

        foreach ($usuarios as &$usuario) {
            $usuario['compras'] = $cabeceraModel
                ->where('id_usuario', $usuario['id_usuario'])
                ->countAllResults();
        }

        return view('pages/admin/usuarios', ['usuarios' => $usuarios]);
    }

    public function facturas()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para ver tus compras');
        }

        $id_usuario = session()->get('id_usuario');

        $carritoModel = new \App\Models\CarritosModel();
        $carritos = $carritoModel->where('id_usuario', $id_usuario)->findAll();

        $idsCarrito = array_column($carritos, 'id_carrito');

        $model = new Carrito_compraModel();

        $facturas = [];

        if (!empty($idsCarrito)) {
            $facturas = $model
                ->whereIn('id_carrito', $idsCarrito)
                ->findAll();
        }

        return view('pages/mis-facturas', [
            'title' => 'Mis Compras',
            'facturas' => $facturas
        ]);
    }
}
