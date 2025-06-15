<?php

namespace App\Controllers;
use App\Models\ConsultaModel;

class Consultas extends BaseController
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
                'nombre' => $this->request->getPost('nombre'),
                'email' => $this->request->getPost('email'),
                'mensaje' => $this->request->getPost('mensaje')
            ];

            if ($this->consultaModel->save($data)) {
                session()->setFlashdata('mensaje', 'Consulta enviada correctamente.');
            } else {
                session()->setFlashdata('mensaje', 'Error al enviar la consulta. Inténtalo de nuevo.');
            }
        }

        return redirect()->to('/consultas');
    }
}