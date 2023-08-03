<?php
require_once '../../bd.php';

if ($_POST) {
/*   echo "<pre>";
  print_r($_POST);
  print_r($_FILES); */

  // Lo sacamos de $_POST
  $primernombre = $_POST["primernombre"];
  $segundonombre = $_POST["segundonombre"];
  $primerapellido = $_POST["primerapellido"];
  $segundoapellido = $_POST["segundoapellido"];
  $idpuesto = $_POST["idpuesto"];
  // Lo sacamos de $_FILES
  $foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : "";
  $cv = isset($_FILES["foto"]["cv"]) ? $_FILES["foto"]["cv"] : "";

  $sentencia = $conexion->prepare("INSERT INTO `tbl_empleados`
         (`primernombre`, `segundonombre`, `primerapellido`, `segundoapellido`, `foto`, `cv`, `idpuesto`) 
  VALUES (:primernombre, :segundonombre, :primerapellido, :segundoapellido, :foto, :cv, :idpuesto)");

  $sentencia->bindParam(':primernombre', $primernombre);
  $sentencia->bindParam(':segundonombre', $segundonombre);
  $sentencia->bindParam(':primerapellido', $primerapellido);
  $sentencia->bindParam(':segundoapellido', $segundoapellido);
  $sentencia->bindParam(':idpuesto', $idpuesto);

  $nombreArchivo_foto = "";
  $fecha = new DateTime();
  if ($foto != '') {
    //le creo un nombre unico a la foto adjuntandole la fecha y hora actual
    $nombreArchivo_foto = $fecha->getTimestamp() . "_" . $_FILES["foto"]["name"];
    // busco la ruta en la que se aloja temporalmente la foto
    $tmp_foto = $_FILES["foto"]["tmp_name"];
    // muevo la foto desde la ruta temporal hasta mi carpeta de imagenes
    move_uploaded_file($tmp_foto, "./assets/img/" . $nombreArchivo_foto);
  }
  $nombreArchivo_cv = "";
  if ($cv != '') {
    //le creo un nombre unico al cv adjuntandole la fecha y hora actual
    $nombreArchivo_cv = $fecha->getTimestamp() . "_" . $_FILES["cv"]["name"];
    // busco la ruta en la que se aloja temporalmente el cv
    $tmp_cv = $_FILES["cv"]["tmp_name"];
    // muevo la cv desde la ruta temporal hasta mi carpeta de pdfs
    move_uploaded_file($tmp_cv, "./assets/pdf/" . $nombreArchivo_cv);
  }
  $sentencia->bindParam(':foto', $nombreArchivo_foto);
  $sentencia->bindParam(':cv', $nombreArchivo_cv);

  $sentencia->execute();

  header("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos`");
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<?php require_once '../../templates/header.php' ?>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>Creación de empleado</h3>
    </div>
    <div class="card-body">
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="primernombre" class="form-label">Primer Nombre</label>
          <input type="text" class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="segundonombre" class="form-label">Segundo Nombre</label>
          <input type="text" class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="primerapellido" class="form-label">Primer Apellido</label>
          <input type="text" class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="segundoapellido" class="form-label">Segundo Apellido</label>
          <input type="text" class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Foto:</label>
          <input type="file" class="form-control" name="foto" id="foto" placeholder="" aria-describedby="fileHelpId">
        </div>
        <div class="mb-3">
          <label for="cv" class="form-label">CV(PDF):</label>
          <input type="file" class="form-control" name="cv" id="cv" placeholder="" aria-describedby="fileHelpId">
        </div>
        <label for="puesto" class="form-label">Puesto:</label>
        <select name="idpuesto" class="form-select" aria-label="Default select example">
          <option disabled selected>Seleccione su puesto</option>
          <?php foreach ($lista_tbl_puestos as $registro) { ?>
            <option value=<?= $registro['id'] ?>><?= $registro['nombredelpuesto'] ?></option>
          <?php } ?>

        </select>
        <br>
        <a class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
        <button type="submit" class="btn btn-success">Agregar registro</button>
      </form>
    </div>
  </div>
</div>

<?php require_once '../../templates/footer.php' ?>