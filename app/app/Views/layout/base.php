<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Visitas</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            color: #333;
            /* Sin scroll vertical en el body */
            overflow-x: hidden;
        }

        nav {
            background: #1a1a2e;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .logo {
            color: #e94560;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            letter-spacing: 0.5px;
        }

        nav .nav-links a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
            font-size: 13px;
            transition: color 0.3s;
        }

        nav .nav-links a:hover { color: #e94560; }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px 10px 20px;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            padding: 25px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 10px;
        }

        .card h2 {
            margin-bottom: 18px;
            color: #1a1a2e;
            border-bottom: 2px solid #e94560;
            padding-bottom: 10px;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .form-group { margin-bottom: 15px; }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 13px;
            color: #444;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 9px 13px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 13px;
            font-family: 'Segoe UI', sans-serif;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #e94560;
        }

        .btn {
            padding: 8px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            font-family: 'Segoe UI', sans-serif;
            text-decoration: none;
            display: inline-block;
            transition: opacity 0.2s;
        }

        .btn:hover { opacity: 0.85; }
        .btn-primary   { background: #e94560; color: #fff; }
        .btn-success   { background: #28a745; color: #fff; }
        .btn-danger    { background: #dc3545; color: #fff; }
        .btn-secondary { background: #6c757d; color: #fff; }

        /* Botones de paginación más pequeños */
        .btn-pag {
            padding: 5px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            font-family: 'Segoe UI', sans-serif;
            text-decoration: none;
            display: inline-block;
            transition: opacity 0.2s;
        }
        .btn-pag:hover { opacity: 0.85; }
        .btn-pag-primary   { background: #e94560; color: #fff; }
        .btn-pag-secondary { background: #6c757d; color: #fff; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        table th {
            background: #1a1a2e;
            color: #fff;
            padding: 10px 14px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
        }

        table td {
            padding: 10px 14px;
            border-bottom: 1px solid #eee;
        }

        table tr:hover { background: #f8f9fa; }

        .alert {
            padding: 11px 18px;
            border-radius: 5px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger  { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        .badge {
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
    </style>
</head>
<body>

<nav>
    <a href="/visitas" class="logo">Control de Visitas</a>
    <div class="nav-links">
        <a href="/visitas">Listado</a>
        <a href="/visitas/registro">Nuevo Registro</a>
        <a href="/logout">Cerrar sesion</a>
    </div>
</nav>

<div class="container">
    <?php if (session()->getFlashdata('ok')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('ok') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?= $this->renderSection('contenido') ?>
</div>

</body>
</html>