<?php

require_once '../../includes/auth.php';
require_once '../../config/database.php';

$sql = "
SELECT
j.*,
e.nombre AS equipo
FROM jugadores j
INNER JOIN equipos e
ON j.equipo_id = e.id
ORDER BY j.apellidos ASC
";

$jugadores = $pdo->query($sql)->fetchAll();

include '../../includes/header.php';
include '../../includes/sidebar.php';
?>

<div class="content">

    <div class="d-flex justify-content-between mb-3">

        <h2>Jugadores</h2>

        <a href="crear.php" class="btn btn-success">

            Nuevo Jugador

        </a>

    </div>

    <table class="table table-hover bg-white">

        <thead>

            <tr>

                <th>Foto</th>
                <th>Jugador</th>
                <th>#</th>
                <th>Equipo</th>
                <th>Posición</th>
                <th>Estado</th>
                <th></th>

            </tr>

        </thead>

        <tbody>

            <?php foreach ($jugadores as $j): ?>

                <tr>

                    <td>

                        <?php if ($j['foto']): ?>

                            <img src="../../uploads/jugadores/<?= $j['foto'] ?>" width="50" height="50"
                                style="object-fit:cover;border-radius:50%;">

                        <?php endif; ?>

                    </td>

                    <td>
                        <?= $j['nombres'] ?>
                        <?= $j['apellidos'] ?>
                    </td>

                    <td><?= $j['numero'] ?></td>

                    <td><?= $j['equipo'] ?></td>

                    <td><?= $j['posicion'] ?></td>

                    <td><?= $j['estado'] ?></td>

                    <td>

                        <a href="editar.php?id=<?= $j['id'] ?>" class="btn btn-warning btn-sm">

                            Editar

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?php include '../../includes/footer.php'; ?>