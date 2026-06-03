<?php

require_once 'includes\auth.php';
require_once 'config\database.php';

$totalCampeonatos = $pdo->query("
SELECT COUNT(*) FROM campeonatos
")->fetchColumn();

$totalEquipos = $pdo->query("
SELECT COUNT(*) FROM equipos
")->fetchColumn();

$totalPartidos = $pdo->query("
SELECT COUNT(*) FROM partidos
")->fetchColumn();

include 'includes\header.php';
include 'includes\sidebar.php';

?>

<div class="content">

    <h2 class="mb-4">
        Dashboard
    </h2>

    <div class="row">

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body text-center">

                    <h6>Campeonatos</h6>

                    <h1>
                        <?= $totalCampeonatos ?>
                    </h1>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body text-center">

                    <h6>Equipos</h6>

                    <h1>
                        <?= $totalEquipos ?>
                    </h1>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body text-center">

                    <h6>Partidos</h6>

                    <h1>
                        <?= $totalPartidos ?>
                    </h1>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include 'includes\footer.php'; ?>