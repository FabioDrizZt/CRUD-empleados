<?php
if ($_POST) {
  require_once '../../bd.php';
  //Recolectar los datos del metodo POST
  $usuario = $_POST['usuario'];
  $password = $_POST['password'];
  $correo = $_POST['correo'];
  //preparo la inserción de los datos
  $sentencia = $conexion->prepare("INSERT INTO `tbl_usuarios`(`usuario`, `password`, `correo`) VALUES (:usuario,:password,:correo)");
  //Asignar los valores que vienen del meto POST (del formulario)
  $sentencia->bindParam(':usuario', $usuario);
  $sentencia->bindParam(':password', $password);
  $sentencia->bindParam(':correo', $correo);
  $sentencia->execute();
  header("Location:index.php");
}
?>
<?php require_once '../../templates/header.php' ?>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>Creación de usuarios</h3>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label for="usuario" class="form-label">Nombre del usuario</label>
          <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Correo electronico</label>
          <input type="email" class="form-control" name="correo" id="email" placeholder="">
        </div>
        <a class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
        <button type="submit" class="btn btn-success">Agregar registro</button>
      </form>
    </div>
  </div>
</div>
<?php require_once '../../templates/footer.php' ?>