<?= $this->extend('layout/base') ?>
<?= $this->section('contenido') ?>

<div class="card">
    <h2>Registro de Visitante</h2>

    <form action="/visitas/registro" method="POST">
        <?= csrf_field() ?>

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" placeholder="Nombre del visitante" required>
        </div>

        <div class="form-group">
            <label>Apellidos</label>
            <input type="text" name="apellidos" placeholder="Apellidos del visitante" required>
        </div>

        <div class="form-group">
            <label>DNI / Documento</label>
            <input type="text" name="dni" placeholder="12345678A" required>
        </div>

        <div class="form-group">
            <label>Motivo de la visita</label>
            <textarea name="motivo" rows="3" placeholder="Describe el motivo de la visita" required></textarea>
        </div>

        <div class="form-group">
            <label>Persona visitada</label>
            <input type="text" name="persona_visitada" placeholder="¿A quién viene a ver?" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar entrada</button>
        <a href="/visitas" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?= $this->endSection() ?>