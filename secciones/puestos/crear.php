<?php
if ($_POST) {
  require_once '../../bd.php';
  //Recolectar los datos del metodo POST
  $nombredelpuesto = $_POST['nombredelpuesto'];
  //preparo la inserción de los datos
  $sentencia = $conexion->prepare("INSERT INTO `tbl_puestos`(`nombredelpuesto`) VALUES (:nombredelpuesto)");
  //Asignar los valores que vienen del meto POST (del formulario)
  $sentencia->bindParam(':nombredelpuesto', $nombredelpuesto);
  $sentencia->execute();
  header("Location:index.php");
}
?>

<?php require_once '../../templates/header.php' ?>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>Creación de puestos</h3>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
          <input type="text" class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="">
        </div>
        <a class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
        <button type="submit" class="btn btn-success">Agregar registro</button>
      </form>
    </div>
  </div>
</div>

<?php require_once '../../templates/footer.php' ?>