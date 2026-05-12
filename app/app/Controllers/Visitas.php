<?php

namespace App\Controllers;

use App\Models\VisitaModel;

class Visitas extends BaseController
{
    // Comprobamos en cada método si está logueado
    protected function checkLogin()
{
    if (!$this->request->getCookie('logueado')) {
        return redirect()->to('/login');
    }
    return null;
}

    public function index()
{
    $check = $this->checkLogin();
    if ($check) return $check;

    $model = new VisitaModel();
    $fecha  = $this->request->getGet('fecha');
    $nombre = $this->request->getGet('nombre');
    $pagina = (int)($this->request->getGet('pagina') ?? 1);
    $porPagina = 10;

    $builder = $model->orderBy('entrada', 'DESC');

    if ($fecha) {
        $builder->where('DATE(entrada)', $fecha);
    }
    if ($nombre) {
        $builder->like('nombre', $nombre);
    }

    // Total para calcular páginas
    $total = $builder->countAllResults(false);
    $totalPaginas = ceil($total / $porPagina);
    $offset = ($pagina - 1) * $porPagina;

    $data['visitas']      = $builder->findAll($porPagina, $offset);
    $data['totalPaginas'] = $totalPaginas;
    $data['paginaActual'] = $pagina;
    $data['nombre']       = $nombre;
    $data['fecha']        = $fecha;

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