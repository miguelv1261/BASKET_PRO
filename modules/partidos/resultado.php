<?php

require_once '../../includes/auth.php';
require_once '../../config/database.php';

$id = $_GET['id'] ?? 0;

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
$stmt->execute([$id]);

$partido = $stmt->fetch();

if (!$partido) {

    die("Partido no encontrado");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $puntosLocal = $_POST['puntos_local'];
    $puntosVisitante = $_POST['puntos_visitante'];

    $sql = "

    UPDATE partidos

    SET

        puntos_local = ?,
        puntos_visitante = ?,
        estado = 'finalizado'

    WHERE id = ?

    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([

        $puntosLocal,
        $puntosVisitante,
        $id

    ]);

    header("Location:index.php");
    exit;
}

include '../../includes/header.php';
include '../../includes/sidebar.php';

?>

<div class="content">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Registrar Resultado</h2>

        <a href="index.php" class="btn btn-secondary">
            Volver
        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <div class="text-center mb-4">

                <h3>

                    <?= $partido['equipo_local_nombre'] ?>

                    VS

                    <?= $partido['equipo_visitante_nombre'] ?>

                </h3>

                <p class="text-muted">

                    Fecha:
                    <?= date('d/m/Y', strtotime($partido['fecha'])) ?>

                    |

                    Hora:
                    <?= date('H:i', strtotime($partido['hora'])) ?>

                </p>

            </div>

            <form method="POST">

                <div class="row text-center">

                    <div class="col-md-5">

                        <label class="form-label fw-bold">

                            <?= $partido['equipo_local_nombre'] ?>

                        </label>

                        <input type="number" name="puntos_local" class="form-control form-control-lg text-center"
                            min="0" value="<?= $partido['puntos_local'] ?>" required>

                    </div>

                    <div class="col-md-2 d-flex align-items-center justify-content-center">

                        <h1>-</h1>

                    </div>

                    <div class="col-md-5">

                        <label class="form-label fw-bold">

                            <?= $partido['equipo_visitante_nombre'] ?>

                        </label>

                        <input type="number" name="puntos_visitante" class="form-control form-control-lg text-center"
                            min="0" value="<?= $partido['puntos_visitante'] ?>" required>

                    </div>

                </div>

                <hr>

                <div class="text-end">

                    <button type="submit" class="btn btn-success">

                        Guardar Resultado

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>