<?php

require_once '../../includes/auth.php';
require_once '../../config/database.php';

$idPartido = $_GET['id'] ?? 0;

/*
|--------------------------------------------------------------------------
| Obtener partido
|--------------------------------------------------------------------------
*/

$sql = "

SELECT

p.*,

el.nombre AS equipo_local_nombre,

ev.nombre AS equipo_visitante_nombre

FROM partidos p

INNER JOIN equipos el
ON p.equipo_local = el.id

INNER JOIN equipos ev
ON p.equipo_visitante = ev.id

WHERE p.id = ?

";

$stmt = $pdo->prepare($sql);
$stmt->execute([$idPartido]);

$partido = $stmt->fetch();

if (!$partido) {
    die("Partido no encontrado");
}

/*
|--------------------------------------------------------------------------
| Guardar estadísticas
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    foreach ($_POST['jugador'] as $i => $jugador) {

        $sqlInsert = "

        INSERT INTO estadisticas_jugador(

            partido_id,
            jugador_id,
            puntos,
            rebotes,
            asistencias,
            robos,
            bloqueos

        )

        VALUES(

            ?,?,?,?,?,?,?

        )

        ";

        $stmtInsert = $pdo->prepare($sqlInsert);

        $stmtInsert->execute([

            $idPartido,

            $jugador,

            $_POST['puntos'][$i],

            $_POST['rebotes'][$i],

            $_POST['asistencias'][$i],

            $_POST['robos'][$i],

            $_POST['bloqueos'][$i]

        ]);
    }

    header("Location: ../partidos/index.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| Obtener jugadores del partido
|--------------------------------------------------------------------------
*/

$sqlJugadores = "

SELECT

j.*,
e.nombre AS equipo_nombre

FROM jugadores j

INNER JOIN equipos e
ON j.equipo_id = e.id

WHERE j.equipo_id IN (?,?)

ORDER BY e.nombre, j.nombres

";

$stmt = $pdo->prepare($sqlJugadores);

$stmt->execute([

    $partido['equipo_local'],
    $partido['equipo_visitante']

]);

$jugadores = $stmt->fetchAll();

include '../../includes/header.php';
include '../../includes/sidebar.php';

?>

<div class="content">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>📊 Estadísticas del Partido</h2>

        <a href="../partidos/index.php" class="btn btn-secondary">

            Volver

        </a>

    </div>

    <div class="card shadow-sm mb-4">

        <div class="card-body text-center">

            <h3>

                <?= $partido['equipo_local_nombre']; ?>

                VS

                <?= $partido['equipo_visitante_nombre']; ?>

            </h3>

            <p class="text-muted mb-0">

                Fecha:
                <?= date('d/m/Y', strtotime($partido['fecha'])); ?>

                |

                Hora:
                <?= date('H:i', strtotime($partido['hora'])); ?>

            </p>

        </div>

    </div>

    <form method="POST">

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>Equipo</th>

                                <th>Jugador</th>

                                <th>#</th>

                                <th>PTS</th>

                                <th>REB</th>

                                <th>AST</th>

                                <th>ROB</th>

                                <th>BLQ</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($jugadores as $j): ?>

                                <tr>

                                    <td>

                                        <?= $j['equipo_nombre']; ?>

                                    </td>

                                    <td>

                                        <?= $j['nombres']; ?>
                                        <?= $j['apellidos']; ?>

                                        <input type="hidden" name="jugador[]" value="<?= $j['id']; ?>">

                                    </td>

                                    <td>

                                        <?= $j['numero']; ?>

                                    </td>

                                    <td>

                                        <input type="number" name="puntos[]" class="form-control text-center" min="0"
                                            value="0">

                                    </td>

                                    <td>

                                        <input type="number" name="rebotes[]" class="form-control text-center" min="0"
                                            value="0">

                                    </td>

                                    <td>

                                        <input type="number" name="asistencias[]" class="form-control text-center" min="0"
                                            value="0">

                                    </td>

                                    <td>

                                        <input type="number" name="robos[]" class="form-control text-center" min="0"
                                            value="0">

                                    </td>

                                    <td>

                                        <input type="number" name="bloqueos[]" class="form-control text-center" min="0"
                                            value="0">

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

                <div class="text-end mt-3">

                    <button type="submit" class="btn btn-success btn-lg">

                        Guardar Estadísticas

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

<?php include '../../includes/footer.php'; ?>