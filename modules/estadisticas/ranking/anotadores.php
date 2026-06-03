<?php

require_once '../../includes/auth.php';
require_once '../../config/database.php';

include 'consultas.php';

include '../../includes/header.php';
include '../../includes/sidebar.php';

?>

<div class="content">

    <h2>
        🏀 Top Anotadores
    </h2>

    <table class="table table-striped">

        <thead>

            <tr>

                <th>#</th>
                <th>Jugador</th>
                <th>Equipo</th>
                <th>Puntos</th>

            </tr>

        </thead>

        <tbody>

            <?php foreach ($anotadores as $i => $j): ?>

                <tr>

                    <td>
                        <?= $i + 1 ?>
                    </td>

                    <td>

                        <?= $j['nombres'] ?>

                        <?= $j['apellidos'] ?>

                    </td>

                    <td>

                        <?= $j['equipo'] ?>

                    </td>

                    <td>

                        <strong>

                            <?= $j['total'] ?>

                        </strong>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?php include '../../includes/footer.php'; ?>