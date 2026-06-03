<?php

require_once '../../includes/auth.php';
require_once '../../config/database.php';

$sql = "
SELECT
e.*,
c.nombre AS campeonato
FROM equipos e
INNER JOIN campeonatos c
ON e.campeonato_id = c.id
ORDER BY e.id DESC
";

$equipos = $pdo->query($sql)->fetchAll();

include '../../includes/header.php';
include '../../includes/sidebar.php';

?>

<div class="content">

    <div class="d-flex justify-content-between mb-3">

        <h2>Equipos</h2>

        <a href="crear.php" class="btn btn-success">

            Nuevo Equipo

        </a>

    </div>

    <table class="table table-hover bg-white">

        <thead>

            <tr>

                <th>Logo</th>
                <th>Equipo</th>
                <th>Campeonato</th>
                <th>Entrenador</th>
                <th>Color</th>
                <th>Acciones</th>

            </tr>

        </thead>

        <tbody>

            <?php foreach ($equipos as $equipo): ?>

                <tr>

                    <td>

                        <?php if ($equipo['logo']): ?>

                            <img src="../../uploads/logos/<?= $equipo['logo'] ?>" width="50">

                        <?php endif; ?>

                    </td>

                    <td><?= $equipo['nombre'] ?></td>

                    <td><?= $equipo['campeonato'] ?></td>

                    <td><?= $equipo['entrenador'] ?></td>

                    <td>

                        <span class="badge" style="
background:<?= $equipo['color'] ?>;
">

                            <?= $equipo['color'] ?>

                        </span>

                    </td>

                    <td>
                        <a href="ver.php?id=<?= $equipo['id'] ?>" class="btn btn-info btn-sm">

                            Ver

                        </a>
                        <a href="editar.php?id=<?= $equipo['id'] ?>" class="btn btn-warning btn-sm">

                            Editar

                        </a>

                        <a href="eliminar.php?id=<?= $equipo['id'] ?>" class="btn btn-danger btn-sm">

                            Eliminar

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?php include '../../includes/footer.php'; ?>