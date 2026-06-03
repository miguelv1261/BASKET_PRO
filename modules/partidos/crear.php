<?php

require_once '../../includes/auth.php';
require_once '../../config/database.php';

$campeonatos = $pdo->query("
    SELECT *
    FROM campeonatos
    ORDER BY nombre
")->fetchAll();

$equipos = $pdo->query("
    SELECT *
    FROM equipos
    ORDER BY nombre
")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Evitar que se seleccione el mismo equipo
    if ($_POST['equipo_local'] == $_POST['equipo_visitante']) {

        $error = "El equipo local y visitante no pueden ser iguales.";

    } else {

        $sql = "

        INSERT INTO partidos(

            campeonato_id,
            equipo_local,
            equipo_visitante,
            fecha,
            hora,
            cancha,
            jornada

        )

        VALUES(

            ?,?,?,?,?,?,?

        )

        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([

            $_POST['campeonato_id'],
            $_POST['equipo_local'],
            $_POST['equipo_visitante'],
            $_POST['fecha'],
            $_POST['hora'],
            $_POST['cancha'],
            $_POST['jornada']

        ]);

        header("Location:index.php");
        exit;
    }
}

include '../../includes/header.php';
include '../../includes/sidebar.php';

?>

<div class="content">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>🏀 Programar Partido</h2>

        <a href="index.php" class="btn btn-secondary">
            Volver
        </a>

    </div>

    <?php if (isset($error)): ?>

        <div class="alert alert-danger">
            <?= $error ?>
        </div>

    <?php endif; ?>

    <div class="card shadow-sm">

        <div class="card-body">

            <form method="POST">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Campeonato
                        </label>

                        <select name="campeonato_id" class="form-select" required>

                            <option value="">
                                Seleccione un campeonato
                            </option>

                            <?php foreach ($campeonatos as $c): ?>

                                <option value="<?= $c['id'] ?>">
                                    <?= $c['nombre'] ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Jornada
                        </label>

                        <input type="number" name="jornada" class="form-control" min="1" value="1" required>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Equipo Local
                        </label>

                        <select name="equipo_local" class="form-select" required>

                            <option value="">
                                Seleccione equipo
                            </option>

                            <?php foreach ($equipos as $e): ?>

                                <option value="<?= $e['id'] ?>">
                                    <?= $e['nombre'] ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Equipo Visitante
                        </label>

                        <select name="equipo_visitante" class="form-select" required>

                            <option value="">
                                Seleccione equipo
                            </option>

                            <?php foreach ($equipos as $e): ?>

                                <option value="<?= $e['id'] ?>">
                                    <?= $e['nombre'] ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Fecha
                        </label>

                        <input type="date" name="fecha" class="form-control" required>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Hora
                        </label>

                        <input type="time" name="hora" class="form-control" required>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Cancha
                        </label>

                        <input type="text" name="cancha" class="form-control" placeholder="Ej: Coliseo Central">

                    </div>

                </div>

                <hr>

                <button type="submit" class="btn btn-primary">

                    Guardar Partido

                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>