<?php require_once '../../bd.php';

if($_POST){
    //Recolectar los datos del metodo POST
    $id = $_POST['txtID'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $correo = $_POST['correo'];
    //preparo la actualización de los datos
    $sentencia = $conexion->prepare("UPDATE `tbl_usuarios` SET `usuario`=:usuario,`password`=:password,`correo`=:correo WHERE `id`=:id");
    //Asignar los valores que vienen del meto POST (del formulario)
    $sentencia->bindParam(':usuario', $usuario);
    $sentencia->bindParam(':password', $password);
    $sentencia->bindParam(':correo', $correo);
    $sentencia->bindParam(':id', $id);
    $sentencia->execute();
    header("Location:index.php");
}

$txtID = $_GET['txtID'];
$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios` WHERE `id`=:id");
$sentencia->bindParam(':id', $txtID);
$sentencia->execute();
$registro = $sentencia->fetch(PDO::FETCH_ASSOC);
?>

<?php require_once '../../templates/header.php' ?>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>Edición de usuarios</h3>
    </div>
    <div class="card-body">
      <form method="POST">
      <input type="hidden" name="txtID" value=<?= $txtID ?>>
        <div class="mb-3">
          <label for="usuario" class="form-label">Nombre del usuario</label>
          <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" value="<?= $registro['usuario']?>">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" name="password" id="password" value="<?= $registro['password']?>">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Correo electronico</label>
          <input type="email" class="form-control" name="correo" id="email" value="<?= $registro['correo']?>">
        </div>
        <a class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
        <button type="submit" class="btn btn-success">Editar registro</button>
      </form>
    </div>
  </div>
</div>

<?php require_once '../../templates/footer.php' ?>