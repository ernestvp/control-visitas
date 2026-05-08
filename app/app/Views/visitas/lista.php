<?= $this->extend('layout/base') ?>
<?= $this->section('contenido') ?>

<div class="card">
    <h2>📊 Registro de Visitas</h2>

    <!-- Filtros de búsqueda -->
    <form method="GET" action="/visitas" style="display:flex; gap:15px; margin-bottom:20px; flex-wrap:wrap;">
        <div class="form-group" style="flex:1; min-width:180px;">
            <label>Buscar por nombre</label>
            <input type="text" name="nombre" value="<?= esc($nombre ?? '') ?>" placeholder="Nombre visitante">
        </div>
        <div class="form-group" style="flex:1; min-width:180px;">
            <label>Filtrar por fecha</label>
            <input type="date" name="fecha" value="<?= esc($fecha ?? '') ?>">
        </div>
        <div style="display:flex; align-items:flex-end; gap:10px;">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="/visitas" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    <a href="/visitas/registro" class="btn btn-primary" style="margin-bottom:20px;">+ Nuevo visitante</a>

    <?php if (empty($visitas)): ?>
        <p style="text-align:center; color:#999; padding:30px;">No hay visitas registradas.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Motivo</th>
                    <th>Visita a</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($visitas as $v): ?>
                <tr>
                    <td><?= $v['id'] ?></td>
                    <td><?= esc($v['nombre']) ?> <?= esc($v['apellidos']) ?></td>
                    <td><?= esc($v['dni']) ?></td>
                    <td><?= esc($v['motivo']) ?></td>
                    <td><?= esc($v['persona_visitada']) ?></td>
                    <td><?= $v['entrada'] ?></td>
                    <td><?= $v['salida'] ?? '-' ?></td>
                    <td>
                        <?php if ($v['salida']): ?>
                            <span class="badge badge-success">Finalizada</span>
                        <?php else: ?>
                            <span class="badge badge-warning">En curso</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!$v['salida']): ?>
                            <a href="/visitas/salida/<?= $v['id'] ?>" class="btn btn-danger"
                               onclick="return confirm('¿Registrar salida?')">
                               Salida
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>