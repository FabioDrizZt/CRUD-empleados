<?php

session_start();
if ($_POST) {
  require_once './bd.php';

  $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE usuario=:usuario AND password=:password");

  $usuario = $_POST["usuario"];
  $password = $_POST["password"];
  $sentencia->bindParam(":usuario", $usuario);
  $sentencia->bindParam(":password", $password);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);

  if (isset($registro["usuario"])) {
    $_SESSION["usuario"] = $registro["usuario"];
    $_SESSION["logueado"] = true;
    header("Location:index.php");
  } else {
    $mensaje = "Error el usuario o contraseña son incorrectos.";
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <title>Inicio de Sesión</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

  <main>
    <h1 align="center">Inicio de sesión</h1>
    <div class="card container">
      <div class="card-header">
        Login
      </div>
      <div class="card-body ">
        <?php if (isset($mensaje)) { ?>
          <div class="alert alert-danger" role="alert">
            <strong><?= $mensaje ?></strong>
          </div>

        <?php } ?>


        <form action="" method="post">

          <div class="mb-3">
            <div class="mb-3">
              <label for="usuario" class="form-label">usuario</label>
              <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="">
            </div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">contraseña</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
          </div>

          <button type="submit" class="btn btn-primary">Entrar al sistema</button>

        </form>

      </div>

    </div>
  </main>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>