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
        return view('templates/main-layout', [
            'title' => 'Consultas - Yesi Yohi Store',
            'content' => view('pages/consultas')
        ]);
    }

    public function enviar()
    {
        if ($this->request->getMethod() === 'post') {
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
        $consultaModel = new ConsultaModel();
        $usuarioModel = new UsuarioModel();

        $consultas = $consultaModel
            ->select('consultas.*, usuarios.nombre as usuario_nombre, usuarios.email as usuario_email')
            ->join('usuarios', 'usuarios.id_usuario = consultas.id_usuario', 'left')
            ->orderBy('fecha_envio', 'DESC')
            ->findAll();


        return view('admin/consultas', [
            'title' => 'Consultas de usuarios',
            'consultas' => $consultas
        ]);
    }
    public function marcarContestado($id)
    {
        $this->consultaModel->update($id, ['contestado' => 1]);

        return redirect()->to(site_url('admin/consultas'))->with('mensaje', 'Consulta marcada como contestada.');
    }
    public function responder($id)
    {
        if ($this->request->getMethod() === 'post') {
            $respuesta = $this->request->getPost('respuesta');

            $this->consultaModel->update($id, [
                'respuesta' => $respuesta,
                'contestado' => 1
            ]);

            return redirect()->to(site_url('admin/consultas'))->with('mensaje', 'Consulta respondida correctamente.');
        }

        $consulta = $this->consultaModel->find($id);

        return view('admin/responder_consulta', [
            'title' => 'Responder Consulta',
            'consulta' => $consulta
        ]);
    }
}
