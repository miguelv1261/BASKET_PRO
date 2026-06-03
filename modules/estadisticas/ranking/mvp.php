<?php

require_once '../../includes/auth.php';
require_once '../../config/database.php';

include 'consultas.php';

include '../../includes/header.php';
include '../../includes/sidebar.php';

?>

<div class="content">

    <div class="card shadow">

        <div class="card-body text-center">

            <h1>
                🏆 MVP DEL CAMPEONATO
            </h1>

            <h2>

                <?= $mvp['nombres'] ?>

                <?= $mvp['apellidos'] ?>

            </h2>

            <h1>

                <?= number_format($mvp['rating'], 1) ?>

            </h1>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>