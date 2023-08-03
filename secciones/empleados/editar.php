<?php require_once '../../bd.php';

if ($_POST) {
  //Recolectar los datos del metodo POST
  $id = $_POST['txtID'];
  $primernombre = $_POST["primernombre"];
  $segundonombre = $_POST["segundonombre"];
  $primerapellido = $_POST["primerapellido"];
  $segundoapellido = $_POST["segundoapellido"];
  $idpuesto = $_POST["idpuesto"];
  // Lo sacamos de $_FILES
  $foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : "";
  $cv = isset($_FILES["foto"]["cv"]) ? $_FILES["foto"]["cv"] : "";


  //preparo la actualización de los datos
  $sentencia = $conexion->prepare("UPDATE `tbl_empleados` 
  SET `primernombre`=:primernombre,`segundonombre`=:segundonombre,`primerapellido`=:primerapellido,`segundoapellido`=:segundoapellido,`foto`=:foto,`cv`=:cv,`idpuesto`=:idpuesto WHERE `id`=:id");
  //Asignar los valores que vienen del meto POST (del formulario)
  $sentencia->bindParam(':id', $id);
  $sentencia->bindParam(':primernombre', $primernombre);
  $sentencia->bindParam(':segundonombre', $segundonombre);
  $sentencia->bindParam(':primerapellido', $primerapellido);
  $sentencia->bindParam(':segundoapellido', $segundoapellido);
  $sentencia->bindParam(':idpuesto', $idpuesto);

  //Logica para la eliminación de los archivos foto y CV
  $sentencia2 = $conexion->prepare("SELECT foto, cv FROM `tbl_empleados` WHERE `id`=:id");
  //Asignar los valores que vienen del meto GET (del formulario)
  $sentencia2->bindParam(':id', $id);
  $sentencia2->execute();
  $registro_recuperado = $sentencia2->fetch(PDO::FETCH_ASSOC);

  $nombreArchivo_foto = "";
  $fecha = new DateTime();
  if ($foto != '') {
    if( isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!="" ) {
      if(file_exists("./assets/img/" . $registro_recuperado["foto"])){
        unlink('./assets/img/'.  $registro_recuperado["foto"]);
      }
    }
    //le creo un nombre unico a la foto adjuntandole la fecha y hora actual
    $nombreArchivo_foto = $fecha->getTimestamp() . "_" . $_FILES["foto"]["name"];
    // busco la ruta en la que se aloja temporalmente la foto
    $tmp_foto = $_FILES["foto"]["tmp_name"];
    // muevo la foto desde la ruta temporal hasta mi carpeta de imagenes
    move_uploaded_file($tmp_foto, "./assets/img/" . $nombreArchivo_foto);
  }
  $nombreArchivo_cv = "";
  if ($cv != '') {
    if( isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!="" ) {
      if(file_exists("./assets/pdf/" . $registro_recuperado["cv"])){
        unlink('./assets/pdf/'.  $registro_recuperado["cv"]);
      }
    }
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

//traigo todos los campos del empleado especifico de la BD
$txtID = $_GET['txtID'];
$sentencia = $conexion->prepare("SELECT * FROM `tbl_empleados` WHERE `id`=:id");
$sentencia->bindParam(':id', $txtID);
$sentencia->execute();
$registro = $sentencia->fetch(PDO::FETCH_ASSOC);
//traigo todos los puestos de la BD
$sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos`");
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require_once '../../templates/header.php' ?>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>Modificación de empleado</h3>
    </div>
    <div class="card-body">
      <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="txtID" value=<?= $txtID ?>>
        <div class="mb-3">
          <label for="primernombre" class="form-label">Primer Nombre</label>
          <input type="text" class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" value="<?= $registro["primernombre"] ?>">
        </div>
        <div class="mb-3">
          <label for="segundonombre" class="form-label">Segundo Nombre</label>
          <input type="text" class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" value="<?= $registro["segundonombre"] ?>">
        </div>
        <div class="mb-3">
          <label for="primerapellido" class="form-label">Primer Apellido</label>
          <input type="text" class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" value="<?= $registro["primerapellido"] ?>">
        </div>
        <div class="mb-3">
          <label for="segundoapellido" class="form-label">Segundo Apellido</label>
          <input type="text" class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" value="<?= $registro["segundoapellido"] ?>">
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Foto:</label>
          <img class="img-fluid rounded-top" src="<?= "./assets/img/" .  $registro['foto'] ?>" alt="foto-perfil" width=100 />
          <input type="file" class="form-control" name="foto" id="foto" aria-describedby="fileHelpId">
        </div>
        <div class="mb-3">
          <label for="cv" class="form-label">CV(PDF):</label>
          <?php if ($registro['cv'] != "") { ?>
            <a href="<?= "./assets/pdf/" .  $registro['cv'] ?>" download="<?= "CV-" . $registro['primernombre'] . $registro['primerapellido'] ?>">CV</a>
          <?php } else { ?>
            <p>sin CV</p>
          <?php } ?>
          <input type="file" class="form-control" name="cv" id="cv" aria-describedby="fileHelpId">
        </div>
        <label for="puesto" class="form-label">Puesto:</label>
        <select name="idpuesto" class="form-select" aria-label="Default select example">
          <?php foreach ($lista_tbl_puestos as $puesto) {
            if ($puesto["id"] == $registro["idpuesto"]) { ?>
              <option selected value=<?= $puesto['id'] ?>><?= $puesto['nombredelpuesto'] ?></option>
            <?php } else { ?>
              <option value=<?= $puesto['id'] ?>><?= $puesto['nombredelpuesto'] ?></option>
          <?php }
          } ?>

        </select>
        <br>
        <a class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
        <button type="submit" class="btn btn-success">Modificar registro</button>
      </form>
    </div>
  </div>
</div>
<?php require_once '../../templates/footer.php' ?>