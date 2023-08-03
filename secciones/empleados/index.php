<?php require_once '../../bd.php';

if ($_GET) {
  //Recolectar los datos del metodo GET
  $txtID = $_GET['txtID'];

  //Logica para la eliminación de los archivos foto y CV
  $sentencia = $conexion->prepare("SELECT foto, cv FROM `tbl_empleados` WHERE `id`=:id");
  //Asignar los valores que vienen del meto GET (del formulario)
  $sentencia->bindParam(':id', $txtID);
  $sentencia->execute();
  $registro_recuperado = $sentencia->fetch(PDO::FETCH_ASSOC);
  if( isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!="" ) {
    if(file_exists("./assets/img/" . $registro_recuperado["foto"])){
      unlink('./assets/img/'.  $registro_recuperado["foto"]);
    }
  }
  if( isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!="" ) {
    if(file_exists("./assets/pdf/" . $registro_recuperado["cv"])){
      unlink('./assets/pdf/'.  $registro_recuperado["cv"]);
    }
  }
  //preparo la inserción de los datos
  $sentencia = $conexion->prepare("DELETE FROM `tbl_empleados` WHERE `id`=:id");
  //Asignar los valores que vienen del meto GET (del formulario)
  $sentencia->bindParam(':id', $txtID);
  $sentencia->execute();
  header("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT *, (
  SELECT nombredelpuesto
  FROM tbl_puestos
  WHERE tbl_puestos.id=tbl_empleados.idpuesto
  ) as puesto FROM `tbl_empleados`");
$sentencia->execute();
$lista_tbl_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php require_once '../../templates/header.php' ?>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>
        Listar empleados
      </h3>
      <a class="btn btn-primary" href="./crear.php" role="button">Agregar empleado</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table aria-label="tabla de empleados" class="table ">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Foto</th>
              <th scope="col">CV</th>
              <th scope="col">Puesto</th>
              <th scope="col">Fecha de ingreso</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($lista_tbl_empleados as $registro) { ?>
              <tr class="">
                <td><?= $registro['id'] ?></td>
                <td>
                  <?= $registro['primernombre'] ?>
                  <?= $registro['segundonombre'] ?>
                  <?= $registro['primerapellido'] ?>
                  <?= $registro['segundoapellido'] ?>
                </td>
                <td>
                  <img class="img-fluid rounded-top" src="<?= "./assets/img/" .  $registro['foto'] ?>" alt="foto-perfil" width=100 />
                </td>
                <td>
                  <?php if ($registro['cv'] != "") { ?>
                    <a href="<?= "./assets/pdf/" .  $registro['cv'] ?>" download="<?= "CV-" . $registro['primernombre'] . $registro['primerapellido'] ?>">CV</a>
                  <?php } else { ?>
                    <p>sin CV</p>
                  <?php } ?>
                </td>
                <td><?= $registro['puesto'] ?></td>
                <td><?= $registro['fechadeingreso'] ?></td>
                <td>
                  <a class="btn btn-success" href="#" role="button">Carta</a>
                  <a class="btn btn-info" href="editar.php?txtID=<?= $registro['id'] ?>" role="button">Editar</a>
                  <a class="btn btn-danger" href="index.php?txtID=<?= $registro['id'] ?>" role="button">Eliminar</a>
                </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require_once '../../templates/footer.php' ?>