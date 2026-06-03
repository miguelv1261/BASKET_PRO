<?php

require_once '../../includes/auth.php';
require_once '../../config/database.php';

$campeonatos = $pdo->query("
SELECT *
FROM campeonatos
ORDER BY id DESC
")->fetchAll();

include '../../includes/header.php';
include '../../includes/sidebar.php';

?>

<div class="content">

    <div class="d-flex justify-content-between mb-4">

        <h2>Campeonatos</h2>

        <a href="crear.php" class="btn btn-success">

            Nuevo Campeonato

        </a>

    </div>

    <table class="table table-bordered bg-white">

        <thead>

            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Temporada</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($campeonatos as $c): ?>

                <tr>

                    <td><?= $c['id'] ?></td>

                    <td><?= $c['nombre'] ?></td>

                    <td><?= $c['temporada'] ?></td>

                    <td><?= $c['estado'] ?></td>

                    <td>

                        <a href="editar.php?id=<?= $c['id'] ?>" class="btn btn-warning btn-sm">

                            Editar

                        </a>

                        <a href="eliminar.php?id=<?= $c['id'] ?>" class="btn btn-danger btn-sm">

                            Eliminar

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?php include '../../includes/footer.php'; ?>