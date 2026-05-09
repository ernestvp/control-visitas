<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Auth extends BaseController
{
    public function login()
    {
        // Si ya está logueado, redirige al inicio
        if (session()->get('logueado')) {
            return redirect()->to('/visitas');
        }
        return view('auth/login');
    }

    public function loginPost()
{
    $usuario = $this->request->getPost('usuario');
    $password = $this->request->getPost('password');

    $model = new UsuarioModel();
    $user = $model->where('usuario', $usuario)->first();

    if ($user && password_verify($password, $user['password'])) {
        session()->set('logueado', true);
        session()->set('usuario', $user['usuario']);
        session()->markAsTempdata('logueado', 3600);
        return redirect()->to(base_url('visitas'));
    }

    return redirect()->back()->with('error', 'Usuario o contraseña incorrectos');
}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
    public function setup()
{
    $model = new UsuarioModel();
    $hash = password_hash('admin123', PASSWORD_DEFAULT);
    $model->insert(['usuario' => 'admin', 'password' => $hash]);
    echo 'Usuario creado: admin / admin123';
}
}