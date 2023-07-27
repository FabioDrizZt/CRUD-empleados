<?php require_once '../../bd.php';

if($_POST){
    print_r($_POST);
    //Recolectar los datos del metodo POST
    $nombredelpuesto = $_POST['nombredelpuesto'];
    $id = $_POST['txtID'];
    //preparo la actualización de los datos
    $sentencia = $conexion->prepare("UPDATE `tbl_puestos` SET `nombredelpuesto`=:nombredelpuesto WHERE `id`=:id");
    //Asignar los valores que vienen del meto POST (del formulario)
    $sentencia->bindParam(':nombredelpuesto', $nombredelpuesto);
    $sentencia->bindParam(':id', $id);
    $sentencia->execute();
    header("Location:index.php");
}

$txtID = $_GET['txtID'];
$sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos` WHERE `id`=:id");
$sentencia->bindParam(':id', $txtID);
$sentencia->execute();
$registro = $sentencia->fetch(PDO::FETCH_ASSOC);
?>
<?php require_once '../../templates/header.php' ?>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>Editar puesto</h3>
    </div>
    <div class="card-body">
      <form method="POST">
        <input type="hidden" name="txtID" value=<?= $txtID ?>>
        <div class="mb-3">
          <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
          <input type="text" class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" value="<?= $registro['nombredelpuesto']?>">
        </div>
        <a class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
        <button type="submit" class="btn btn-success">Editar registro</button>
      </form>
    </div>
  </div>
</div>

<?php require_once '../../templates/footer.php' ?>