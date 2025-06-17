<?php

namespace App\Controllers;

use App\Models\FacturaModel;
use App\Models\CabeceraModel;
use CodeIgniter\Controller; 
class FacturaController extends Controller
{
    protected $facturaModel;
    protected $cabeceraModel;

    public function __construct()
    {
        $this->facturaModel = new FacturaModel();
        $this->cabeceraModel = new CabeceraModel();
    }

    public function index()
    {
        return view('templates/main-layout', [
            'title' => 'Facturas - Yesi Yohi Store',
            'content' => view('pages/facturas')
        ]);
    }

    public function crearFactura()
    {
        if ($this->request->getMethod() === 'post') {
            $dataCabecera = [
                'id_usuario' => session()->get('user_id'),
                'precio_total' => $this->request->getPost('precio_total'),
                'fecha_creacion' => date('Y-m-d H:i:s')
            ];

            if ($this->cabeceraModel->save($dataCabecera)) {
                $idCabecera = $this->cabeceraModel->insertID();

                $dataFactura = [
                    'id_producto' => $this->request->getPost('id_producto'),
                    'cantidad' => $this->request->getPost('cantidad'),
                    'precio_unitario' => $this->request->getPost('precio_unitario'),
                    'descuento' => $this->request->getPost('descuento'),
                    'subtotal' => $this->request->getPost('subtotal'),
                    'id_cabecera' => $idCabecera
                ];

                if ($this->facturaModel->save($dataFactura)) {
                    session()->setFlashdata('mensaje', 'Factura creada correctamente.');
                } else {
                    session()->setFlashdata('mensaje', 'Error al crear la factura. Inténtalo de nuevo.');
                }
            } else {
                session()->setFlashdata('mensaje', 'Error al crear la cabecera. Inténtalo de nuevo.');
            }
        }

        return redirect()->to('/facturas');
    }
}   
