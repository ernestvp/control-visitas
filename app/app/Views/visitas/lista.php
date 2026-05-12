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
            <!-- max evita seleccionar fechas futuras -->
            <input type="date" name="fecha" value="<?= esc($fecha ?? '') ?>" max="<?= date('Y-m-d') ?>">
        </div>
        <div style="display:flex; align-items:flex-end; gap:10px;">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="/visitas" class="btn btn-secondary">Limpiar filtros</a>
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

        <!-- Paginación -->
        <?php if ($totalPaginas > 1): ?>
        <div style="display:flex; justify-content:center; gap:6px; margin-top:20px; flex-wrap:wrap;">

            <?php if ($paginaActual > 1): ?>
                <a href="/visitas?pagina=1&nombre=<?= esc($nombre ?? '') ?>&fecha=<?= esc($fecha ?? '') ?>"
                   class="btn btn-secondary">« Primera</a>
                <a href="/visitas?pagina=<?= $paginaActual - 1 ?>&nombre=<?= esc($nombre ?? '') ?>&fecha=<?= esc($fecha ?? '') ?>"
                   class="btn btn-secondary">‹ Anterior</a>
            <?php endif; ?>

            <?php
            $inicio = max(1, $paginaActual - 2);
            $fin    = min($totalPaginas, $paginaActual + 2);
            for ($i = $inicio; $i <= $fin; $i++):
            ?>
                <a href="/visitas?pagina=<?= $i ?>&nombre=<?= esc($nombre ?? '') ?>&fecha=<?= esc($fecha ?? '') ?>"
                   class="btn <?= $i === $paginaActual ? 'btn-primary' : 'btn-secondary' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($paginaActual < $totalPaginas): ?>
                <a href="/visitas?pagina=<?= $paginaActual + 1 ?>&nombre=<?= esc($nombre ?? '') ?>&fecha=<?= esc($fecha ?? '') ?>"
                   class="btn btn-secondary">Siguiente ›</a>
                <a href="/visitas?pagina=<?= $totalPaginas ?>&nombre=<?= esc($nombre ?? '') ?>&fecha=<?= esc($fecha ?? '') ?>"
                   class="btn btn-secondary">Última »</a>
            <?php endif; ?>

            <span style="display:flex; align-items:center; font-size:13px; color:#999; margin-left:10px;">
                Página <?= $paginaActual ?> de <?= $totalPaginas ?>
            </span>

        </div>
        <?php endif; ?>

    <?php endif; ?>
</div>

<?= $this->endSection() ?>