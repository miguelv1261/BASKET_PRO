<?php

require_once '../../includes/auth.php';
require_once '../../config/database.php';

if ($_POST) {

    $sql = "
    INSERT INTO campeonatos
    (
        usuario_id,
        nombre,
        temporada,
        fecha_inicio,
        fecha_fin
    )
    VALUES
    (
        ?,
        ?,
        ?,
        ?,
        ?
    )
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([

        $_SESSION['usuario_id'],
        $_POST['nombre'],
        $_POST['temporada'],
        $_POST['fecha_inicio'],
        $_POST['fecha_fin']

    ]);

    header("Location:index.php");
    exit;
}

include '../../includes/header.php';
include '../../includes/sidebar.php';

?>

<div class="content">

    <h2>Nuevo Campeonato</h2>

    <form method="POST">

        <div class="mb-3">

            <label>Nombre</label>

            <input type="text" name="nombre" class="form-control" required>

        </div>

        <div class="mb-3">

            <label>Temporada</label>

            <input type="text" name="temporada" class="form-control" required>

        </div>

        <div class="mb-3">

            <label>Fecha Inicio</label>

            <input type="date" name="fecha_inicio" class="form-control">

        </div>

        <div class="mb-3">

            <label>Fecha Fin</label>

            <input type="date" name="fecha_fin" class="form-control">

        </div>

        <button class="btn btn-primary">

            Guardar

        </button>

    </form>

</div>

<?php include '../../includes/footer.php'; ?>