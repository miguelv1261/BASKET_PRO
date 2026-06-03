<?php

require_once '../../includes/auth.php';
require_once '../../config/database.php';

$equipos = $pdo->query("
SELECT *
FROM equipos
ORDER BY nombre
")->fetchAll();

if ($_POST) {

    $foto = '';

    if (!empty($_FILES['foto']['name'])) {

        $foto =
            time() . "_" .
            $_FILES['foto']['name'];

        move_uploaded_file(

            $_FILES['foto']['tmp_name'],

            "../../uploads/jugadores/" . $foto

        );
    }

    $sql = "
    INSERT INTO jugadores
    (
        equipo_id,
        foto,
        cedula,
        nombres,
        apellidos,
        numero,
        posicion,
        fecha_nacimiento,
        estatura,
        peso,
        telefono,
        email
    )
    VALUES
    (
        ?,?,?,?,?,?,?,?,?,?,?,?
    )
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([

        $_POST['equipo_id'],
        $foto,
        $_POST['cedula'],
        $_POST['nombres'],
        $_POST['apellidos'],
        $_POST['numero'],
        $_POST['posicion'],
        $_POST['fecha_nacimiento'],
        $_POST['estatura'],
        $_POST['peso'],
        $_POST['telefono'],
        $_POST['email']

    ]);

    header("Location:index.php");
    exit;
}

include '../../includes/header.php';
include '../../includes/sidebar.php';
?>

<div class="content">

    <h2>Nuevo Jugador</h2>

    <form method="POST" enctype="multipart/form-data">

        <div class="row">

            <div class="col-md-4">

                <label>Foto</label>

                <input type="file" name="foto" class="form-control">

            </div>

            <div class="col-md-4">

                <label>Equipo</label>

                <select name="equipo_id" class="form-control" required>

                    <option value="">
                        Seleccione
                    </option>

                    <?php foreach ($equipos as $e): ?>

                        <option value="<?= $e['id'] ?>">

                            <?= $e['nombre'] ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="col-md-4">

                <label>Número</label>

                <input type="number" name="numero" class="form-control">

            </div>

        </div>

        <br>

        <div class="row">

            <div class="col-md-6">

                <label>Nombres</label>

                <input type="text" name="nombres" class="form-control" required>

            </div>

            <div class="col-md-6">

                <label>Apellidos</label>

                <input type="text" name="apellidos" class="form-control" required>

            </div>

        </div>

        <br>

        <div class="row">

            <div class="col-md-4">

                <label>Cédula</label>

                <input type="text" name="cedula" class="form-control">

            </div>

            <div class="col-md-4">

                <label>Posición</label>

                <select name="posicion" class="form-control">

                    <option>Base</option>
                    <option>Escolta</option>
                    <option>Alero</option>
                    <option>Ala-Pivot</option>
                    <option>Pivot</option>

                </select>

            </div>

            <div class="col-md-4">

                <label>Fecha Nacimiento</label>

                <input type="date" name="fecha_nacimiento" class="form-control">

            </div>

        </div>

        <br>

        <div class="row">

            <div class="col-md-3">

                <label>Estatura</label>

                <input type="number" step="0.01" name="estatura" class="form-control">

            </div>

            <div class="col-md-3">

                <label>Peso</label>

                <input type="number" step="0.01" name="peso" class="form-control">

            </div>

            <div class="col-md-3">

                <label>Teléfono</label>

                <input type="text" name="telefono" class="form-control">

            </div>

            <div class="col-md-3">

                <label>Email</label>

                <input type="email" name="email" class="form-control">

            </div>

        </div>

        <br>

        <button class="btn btn-primary">

            Guardar Jugador

        </button>

    </form>

</div>

<?php include '../../includes/footer.php'; ?>