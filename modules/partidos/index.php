<?php

require_once '../../includes/auth.php';
require_once '../../config/database.php';

$sql = "

SELECT

p.*,

cl.nombre AS local_nombre,

cv.nombre AS visitante_nombre,

c.nombre AS campeonato

FROM partidos p

INNER JOIN equipos cl
ON p.equipo_local = cl.id

INNER JOIN equipos cv
ON p.equipo_visitante = cv.id

INNER JOIN campeonatos c
ON p.campeonato_id = c.id

ORDER BY fecha DESC

";

$partidos = $pdo->query($sql)->fetchAll();

include '../../includes/header.php';
include '../../includes/sidebar.php';

?>

<div class="content">

    <div class="d-flex justify-content-between">

        <h2>Partidos</h2>

        <a href="crear.php" class="btn btn-success">

            Nuevo Partido

        </a>

    </div>

    <br>

    <table class="table table-bordered bg-white">

        <thead>

            <tr>

                <th>Fecha</th>
                <th>Campeonato</th>
                <th>Local</th>
                <th></th>
                <th>Visitante</th>
                <th>Estado</th>
                <th>Acciones</th>

            </tr>

        </thead>

        <tbody>

            <?php foreach ($partidos as $p): ?>

                <tr>

                    <td>
                        <?= $p['fecha'] ?>
                    </td>

                    <td>
                        <?= $p['campeonato'] ?>
                    </td>

                    <td>
                        <?= $p['local_nombre'] ?>
                    </td>

                    <td>

                        <strong>

                            <?= $p['puntos_local'] ?>

                            -

                            <?= $p['puntos_visitante'] ?>

                        </strong>

                    </td>

                    <td>
                        <?= $p['visitante_nombre'] ?>
                    </td>

                    <td>
                        <?= $p['estado'] ?>
                    </td>

                    <td>

                        <a href="resultado.php?id=<?= $p['id'] ?>" class="btn btn-primary btn-sm">

                            Resultado

                        </a>
                        <a href="../estadisticas/partido.php?id=<?= $p['id'] ?>" class="btn btn-info btn-sm">

                            Estadísticas

                        </a>
                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?php include '../../includes/footer.php'; ?>