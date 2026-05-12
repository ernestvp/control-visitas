<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->request->getCookie('logueado') === 'si') {
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
    setcookie('logueado', 'si', time() + 7200, '/', '', false, false);
    setcookie('usuario', $user['usuario'], time() + 7200, '/', '', false, false);
    return redirect()->to('/visitas');
}

        return redirect()->back()->with('error', 'Usuario o contraseña incorrectos');
    }

    public function logout()
    {
        $this->response->deleteCookie('logueado');
        $this->response->deleteCookie('usuario');
        return redirect()->to('/login');
    }
    public function setup()
{
    $model = new UsuarioModel();
    $model->where('usuario', 'admin')->delete();
    $hash = password_hash('admin123', PASSWORD_DEFAULT);
    $model->insert(['usuario' => 'admin', 'password' => $hash]);
    echo 'Listo: admin / admin123 - Hash: ' . $hash;
}
}