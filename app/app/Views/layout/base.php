<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Visitas</title>
    <style>
        /* Reset y estilos generales */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            color: #333;
        }

        /* Barra de navegación */
        nav {
            background: #1a1a2e;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .logo {
            color: #e94560;
            font-size: 20px;
            font-weight: bold;
            text-decoration: none;
        }

        nav .nav-links a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
            font-size: 14px;
            transition: color 0.3s;
        }

        nav .nav-links a:hover { color: #e94560; }

        /* Contenedor principal */
        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Tarjetas */
        .card {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        .card h2 {
            margin-bottom: 20px;
            color: #1a1a2e;
            border-bottom: 2px solid #e94560;
            padding-bottom: 10px;
        }

        /* Formularios */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #e94560;
        }

        /* Botones */
        .btn {
            padding: 10px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: opacity 0.3s;
        }

        .btn:hover { opacity: 0.85; }
        .btn-primary { background: #e94560; color: #fff; }
        .btn-success { background: #28a745; color: #fff; }
        .btn-danger  { background: #dc3545; color: #fff; }
        .btn-secondary { background: #6c757d; color: #fff; }

        /* Tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        table th {
            background: #1a1a2e;
            color: #fff;
            padding: 12px 15px;
            text-align: left;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }

        table tr:hover { background: #f8f9fa; }

        /* Alertas */
        .alert {
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger  { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        /* Badge estado */
        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
    </style>
</head>
<body>

<!-- Barra de navegación -->
<nav>
    <a href="/visitas" class="logo">🏢 Control de Visitas</a>
    <div class="nav-links">
        <a href="/visitas">Listado</a>
        <a href="/visitas/registro">Nuevo Registro</a>
        <a href="/logout">Cerrar sesión</a>
    </div>
</nav>

<div class="container">
    <!-- Mensajes de éxito o error -->
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