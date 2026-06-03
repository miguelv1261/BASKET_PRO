<?php

session_start();

require_once 'config/database.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "
        SELECT *
        FROM usuarios
        WHERE email = ?
        AND password = ?
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $email,
        $password
    ]);

    $usuario = $stmt->fetch();

    if ($usuario) {

        $_SESSION['usuario_id'] =
            $usuario['id'];

        $_SESSION['usuario_nombre'] =
            $usuario['nombre'];

        header("Location: dashboard.php");
        exit;

    } else {

        $error =
            "Correo o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Basket SaaS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container">

        <div class="row vh-100 align-items-center justify-content-center">

            <div class="col-md-4">

                <div class="card shadow">

                    <div class="card-body">

                        <h3 class="text-center mb-4">
                            🏀 Basket SaaS
                        </h3>

                        <?php if ($error): ?>

                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>

                        <?php endif; ?>

                        <form method="POST">

                            <div class="mb-3">

                                <label>Email</label>

                                <input type="email" name="email" class="form-control" required>

                            </div>

                            <div class="mb-3">

                                <label>Contraseña</label>

                                <input type="password" name="password" class="form-control" required>

                            </div>

                            <button class="btn btn-primary w-100">

                                Ingresar

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>