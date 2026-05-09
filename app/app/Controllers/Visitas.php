<?php

namespace App\Controllers;

use App\Models\VisitaModel;

class Visitas extends BaseController
{
    // Comprobamos en cada método si está logueado
    protected function checkLogin()
{
    if (!session()->get('logueado')) {
        return redirect()->to(base_url('login'));
    }
    return null;
}

    public function index()
    {
        $check = $this->checkLogin();
        if ($check) return $check;

        $model = new VisitaModel();

        // Recogemos filtros del formulario de búsqueda
        $fecha    = $this->request->getGet('fecha');
        $nombre   = $this->request->getGet('nombre');

        $builder = $model->orderBy('entrada', 'DESC');

        if ($fecha) {
            $builder->where('DATE(entrada)', $fecha);
        }
        if ($nombre) {
            $builder->like('nombre', $nombre);
        }

        $data['visitas'] = $builder->findAll();
        return view('visitas/lista', $data);
    }

    public function registro()
    {
        $check = $this->checkLogin();
        if ($check) return $check;

        return view('visitas/registro');
    }

    public function registroPost()
    {
        $check = $this->checkLogin();
        if ($check) return $check;

        $model = new VisitaModel();

        // Guardamos la visita con la hora de entrada actual
        $model->insert([
            'nombre'          => $this->request->getPost('nombre'),
            'apellidos'       => $this->request->getPost('apellidos'),
            'dni'             => $this->request->getPost('dni'),
            'motivo'          => $this->request->getPost('motivo'),
            'persona_visitada'=> $this->request->getPost('persona_visitada'),
            'entrada'         => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/visitas')->with('ok', 'Visitante registrado correctamente');
    }

    public function salida($id)
    {
        $check = $this->checkLogin();
        if ($check) return $check;

        $model = new VisitaModel();

        // Registramos la hora de salida
        $model->update($id, ['salida' => date('Y-m-d H:i:s')]);

        return redirect()->to('/visitas')->with('ok', 'Salida registrada correctamente');
    }
}