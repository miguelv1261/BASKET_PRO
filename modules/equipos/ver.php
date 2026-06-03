<?php

require_once '../../includes/auth.php';
require_once '../../config/database.php';

$id = $_GET['id'];

$sql = "

SELECT *

FROM equipos

WHERE id=?

";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$equipo = $stmt->fetch();

$sql = "

SELECT *

FROM jugadores

WHERE equipo_id=?

ORDER BY numero

";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$jugadores = $stmt->fetchAll();

$sql = "

SELECT *

FROM partidos

WHERE

equipo_local=?

OR

equipo_visitante=?

ORDER BY fecha DESC

LIMIT 5

";

$stmt = $pdo->prepare($sql);

$stmt->execute([$id, $id]);

$partidos = $stmt->fetchAll();

$sql = "

SELECT

COUNT(*) pj,

SUM(

CASE

WHEN

(

equipo_local=? AND puntos_local>puntos_visitante

)

OR

(

equipo_visitante=? AND puntos_visitante>puntos_local

)

THEN 1

ELSE 0

END

) pg

FROM partidos

WHERE estado='finalizado'

AND

(

equipo_local=?

OR

equipo_visitante=?

)

";

$stmt = $pdo->prepare($sql);

$stmt->execute([

    $id,
    $id,
    $id,
    $id

]);

$resumen = $stmt->fetch();
?>
<div class="card shadow mb-4">

    <div class="card-body">

        <div class="row">

            <div class="col-md-3 text-center">

                <?php if ($equipo['logo']): ?>

                    <img src="../../uploads/logos/<?= $equipo['logo'] ?>" class="img-fluid">

                <?php endif; ?>

            </div>

            <div class="col-md-9">

                <h2>

                    <?= $equipo['nombre'] ?>

                </h2>

                <p>

                    Entrenador:
                    <strong>

                        <?= $equipo['entrenador'] ?>

                    </strong>

                </p>

                <p>

                    Teléfono:
                    <?= $equipo['telefono'] ?>

                </p>

            </div>

        </div>

    </div>

</div>

<div class="card shadow mb-4">

    <div class="card-header">

        👥 Plantilla

    </div>

    <div class="card-body">

        <table class="table">

            <thead>

                <tr>

                    <th>#</th>
                    <th>Jugador</th>
                    <th>Posición</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($jugadores as $j): ?>

                    <tr>

                        <td>

                            <?= $j['numero'] ?>

                        </td>

                        <td>

                            <?= $j['nombres'] ?>

                            <?= $j['apellidos'] ?>

                        </td>

                        <td>

                            <?= $j['posicion'] ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>
<div class="card shadow">

    <div class="card-header">

        📅 Últimos partidos

    </div>

    <div class="card-body">

        <table class="table">

            <thead>

                <tr>

                    <th>Fecha</th>
                    <th>Resultado</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($partidos as $p): ?>

                    <tr>

                        <td>

                            <?= $p['fecha'] ?>

                        </td>

                        <td>

                            <?= $p['puntos_local'] ?>

                            -

                            <?= $p['puntos_visitante'] ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>