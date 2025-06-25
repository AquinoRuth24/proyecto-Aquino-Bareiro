<?php

namespace App\Controllers;

use App\Models\ConsultaModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller as BaseController;

class ConsultaController extends BaseController
{
    protected $consultaModel;

    public function __construct()
    {
        $this->consultaModel = new ConsultaModel();
    }

    public function index()
    {
        $datosUsuario = [];

        if (session()->has('usuario')) {
            $datosUsuario['nombre'] = session('nombre') ?? '';
            $datosUsuario['email']  = session('email') ?? '';
        }
        return view('templates/main-layout', [
            'title'   => 'Consultas - Yesi Yohi Store',
            'content' => view('pages/consultas', ['datosUsuario' => $datosUsuario])
        ]);
    }


    public function enviar()
    {
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'mensaje' => $this->request->getPost('mensaje'),
                'fecha_envio' => date('Y-m-d H:i:s'),
                'contestado' => 0
            ];

            if (session()->has('usuario')) {
                $data['id_usuario'] = session('usuario')['id_usuario'];
            } else {
                // Guardamos nombre y email como datos extra si el usuario no está logueado
                $data['nombre'] = $this->request->getPost('nombre');
                $data['email'] = $this->request->getPost('email');
            }

            if ($this->consultaModel->insert($data)) {
                session()->setFlashdata('mensaje', 'Consulta enviada correctamente.');
            } else {
                session()->setFlashdata('mensaje', 'Error al enviar la consulta. Inténtalo de nuevo.');
            }
        }

        return redirect()->to('/consultas');
    }
    public function misConsultas()
    {
        $usuarioId = session()->get('id_usuario');
        if (!$usuarioId) {
            return redirect()->to('/login')->with('mensaje', 'Debes iniciar sesión para ver tus consultas.');
        }

        $consultas = $this->consultaModel
            ->where('id_usuario', $usuarioId)
            ->orderBy('fecha_envio', 'DESC')
            ->findAll();

        return view('pages/mis_consultas', [
            'title' => 'Mis Consultas',
            'consultas' => $consultas
        ]);
    }

    public function admin()
    {
        if (!session()->get('isLoggedIn') || session()->get('id_perfil') !== '3') {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado.');
        }
        $consultaModel = new ConsultaModel();
        $usuarioModel = new UsuarioModel();

        $consultas = $consultaModel
            ->select('consulta.*, usuario.nombre as usuario_nombre, usuario.email as usuario_email')
            ->join('usuario', 'usuario.id_usuario = consulta.id_usuario', 'left')
            ->orderBy('fecha_envio', 'DESC')
            ->findAll();


        return view('pages/admin/consultas', [
            'title' => 'Consultas de usuarios',
            'consultas' => $consultas
        ]);
    }
    public function marcarContestado($id)
    {
        $this->consultaModel->update($id, ['contestado' => 1]);

        return redirect()->to(site_url('pages/admin/consultas'))->with('mensaje', 'Consulta marcada como contestada.');
    }
    public function responder($id)
    {
        if ($this->request->getMethod() === 'POST') {
            $respuesta = $this->request->getPost('respuesta');

            $this->consultaModel->update($id, [
                'respuesta' => $respuesta,
                'contestado' => 1
            ]);

            return redirect()->to(site_url('pages/admin/consultas'))->with('mensaje', 'Consulta respondida correctamente.');
        }

        $consultas = $this->consultaModel->find($id);

        return view('pages/admin/responder_consulta', [
            'title' => 'Responder Consulta',
            'consultas' => $consultas
        ]);
    }
}
