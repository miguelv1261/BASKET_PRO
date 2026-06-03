<?php

require_once '../../../includes/auth.php';
require_once '../../../config/database.php';

include 'consultas.php';

include '../../../includes/header.php';
include '../../../includes/sidebar.php';
?>

<div class="content">

    <h2 class="mb-4">
        🏆 Rankings
    </h2>

    <div class="row">

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h6>MVP</h6>

                    <h3>

                        <?= $mvp['nombres'] ?>
                        <?= $mvp['apellidos'] ?>

                    </h3>

                    <h1>

                        <?= number_format($mvp['rating'], 1) ?>

                    </h1>

                </div>

            </div>

        </div>

    </div>

    <div class="mt-4">

        <a href="anotadores.php" class="btn btn-primary">
            Top Anotadores
        </a>

        <a href="rebotes.php" class="btn btn-success">
            Top Rebotes
        </a>

        <a href="asistencias.php" class="btn btn-warning">
            Top Asistencias
        </a>

        <a href="robos.php" class="btn btn-danger">
            Top Robos
        </a>

        <a href="bloqueos.php" class="btn btn-dark">
            Top Bloqueos
        </a>

    </div>

</div>

<?php include '../../../includes/footer.php'; ?>