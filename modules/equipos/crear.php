<?php

require_once '../../includes/auth.php';
require_once '../../config/database.php';

$campeonatos = $pdo->query("
SELECT *
FROM campeonatos
ORDER BY nombre
")->fetchAll();

if ($_POST) {

    $logo = "";

    if (!empty($_FILES['logo']['name'])) {

        $logo = time() . "_" .
            $_FILES['logo']['name'];

        move_uploaded_file(

            $_FILES['logo']['tmp_name'],

            "../../uploads/logos/" . $logo

        );
    }

    $sql = "
    INSERT INTO equipos
    (
        campeonato_id,
        nombre,
        logo,
        color,
        entrenador,
        telefono
    )
    VALUES
    (
        ?,?,?,?,?,?
    )
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([

        $_POST['campeonato_id'],
        $_POST['nombre'],
        $logo,
        $_POST['color'],
        $_POST['entrenador'],
        $_POST['telefono']

    ]);

    header("Location:index.php");
    exit;
}

include '../../includes/header.php';
include '../../includes/sidebar.php';

?>

<div class="content">

    <h2>Nuevo Equipo</h2>

    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">

            <label>Campeonato</label>

            <select name="campeonato_id" class="form-control" required>

                <option value="">
                    Seleccione
                </option>

                <?php foreach ($campeonatos as $c): ?>

                    <option value="<?= $c['id'] ?>">

                        <?= $c['nombre'] ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <div class="mb-3">

            <label>Nombre Equipo</label>

            <input type="text" name="nombre" class="form-control" required>

        </div>

        <div class="mb-3">

            <label>Logo</label>

            <input type="file" name="logo" class="form-control">

        </div>

        <div class="mb-3">

            <label>Color</label>

            <input type="color" name="color" class="form-control form-control-color">

        </div>

        <div class="mb-3">

            <label>Entrenador</label>

            <input type="text" name="entrenador" class="form-control">

        </div>

        <div class="mb-3">

            <label>Teléfono</label>

            <input type="text" name="telefono" class="form-control">

        </div>

        <button class="btn btn-primary">

            Guardar Equipo

        </button>

    </form>

</div>

<?php include '../../includes/footer.php'; ?>