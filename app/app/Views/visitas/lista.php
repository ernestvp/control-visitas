<?= $this->extend('layout/base') ?>
<?= $this->section('contenido') ?>

<div class="card">
    <h2>Registro de Visitas</h2>

    <!-- Filtros de búsqueda -->
    <form method="GET" action="/visitas" style="display:flex; gap:12px; margin-bottom:18px; flex-wrap:wrap; align-items:flex-end;">
        <div class="form-group" style="flex:1; min-width:180px; margin-bottom:0;">
            <label>Buscar por nombre</label>
            <input type="text" name="nombre" value="<?= esc($nombre ?? '') ?>" placeholder="Nombre del visitante">
        </div>
        <div class="form-group" style="flex:1; min-width:160px; margin-bottom:0;">
            <label>Filtrar por fecha</label>
            <input type="date" name="fecha" value="<?= esc($fecha ?? '') ?>" max="<?= date('Y-m-d') ?>">
        </div>
        <div style="display:flex; gap:8px; padding-bottom:1px;">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="/visitas" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    <a href="/visitas/registro" class="btn btn-primary" style="margin-bottom:18px;">+ Nuevo visitante</a>

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
                    <th>Accion</th>
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
                            <a href="/visitas/salida/<?= $v['id'] ?>"
                               class="btn btn-danger"
                               style="padding:5px 12px; font-size:12px;"
                               onclick="return confirm('Registrar salida?')">
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
        <div style="display:flex; justify-content:space-between; align-items:center; margin-top:18px;">

            <!-- Izquierda: Anterior -->
            <div style="flex:1; display:flex; justify-content:flex-start;">
                <?php if ($paginaActual > 1): ?>
                    <a href="/visitas?pagina=<?= $paginaActual - 1 ?>&nombre=<?= esc($nombre ?? '') ?>&fecha=<?= esc($fecha ?? '') ?>"
                       class="btn-pag btn-pag-secondary">Anterior</a>
                <?php else: ?>
                    <span class="btn-pag btn-pag-secondary" style="opacity:0.4; cursor:default;">Anterior</span>
                <?php endif; ?>
            </div>

            <!-- Centro: Números de página -->
            <div style="flex:1; display:flex; justify-content:center; gap:5px;">
                <?php
                $inicio = max(1, $paginaActual - 2);
                $fin    = min($totalPaginas, $paginaActual + 2);
                for ($i = $inicio; $i <= $fin; $i++):
                ?>
                    <a href="/visitas?pagina=<?= $i ?>&nombre=<?= esc($nombre ?? '') ?>&fecha=<?= esc($fecha ?? '') ?>"
                       class="btn-pag <?= $i === $paginaActual ? 'btn-pag-primary' : 'btn-pag-secondary' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>

            <!-- Derecha: Página X de Y + Siguiente -->
            <div style="flex:1; display:flex; justify-content:flex-end; align-items:center; gap:10px;">
                <span style="font-size:12px; color:#999;">Pagina <?= $paginaActual ?> de <?= $totalPaginas ?></span>
                <?php if ($paginaActual < $totalPaginas): ?>
                    <a href="/visitas?pagina=<?= $paginaActual + 1 ?>&nombre=<?= esc($nombre ?? '') ?>&fecha=<?= esc($fecha ?? '') ?>"
                       class="btn-pag btn-pag-secondary">Siguiente</a>
                <?php else: ?>
                    <span class="btn-pag btn-pag-secondary" style="opacity:0.4; cursor:default;">Siguiente</span>
                <?php endif; ?>
            </div>

        </div>
        <?php endif; ?>

    <?php endif; ?>
</div>

<?= $this->endSection() ?>