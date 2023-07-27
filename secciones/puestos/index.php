<?php require_once '../../bd.php';

if($_GET){
    //Recolectar los datos del metodo GET
    $txtID = $_GET['txtID'];
    //preparo la inserción de los datos
    $sentencia = $conexion->prepare("DELETE FROM `tbl_puestos` WHERE `id`=:id");
    //Asignar los valores que vienen del meto POST (del formulario)
    $sentencia->bindParam(':id', $txtID);
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
      <h2>Listar puestos</h2>
      <a class="btn btn-primary" href="./crear.php" role="button">Crear Puesto</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table aria-label="tabla de puestos" class="table ">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre del puesto:</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($lista_tbl_puestos as $registro) { ?>
              <tr class="">
                <td><?= $registro['id'] ?></td>
                <td><?= $registro['nombredelpuesto'] ?></td>
                <td>
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