<?php require_once '../../bd.php';

if($_GET){
  //Recolectar los datos del metodo GET
  $txtID = $_GET['txtID'];
  //preparo la inserción de los datos
  $sentencia = $conexion->prepare("DELETE FROM `tbl_usuarios` WHERE `id`=:id");
  //Asignar los valores que vienen del meto POST (del formulario)
  $sentencia->bindParam(':id', $txtID);
  $sentencia->execute();
  header("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`");
$sentencia->execute();
$lista_tbl_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php require_once '../../templates/header.php' ?>

<div class="container">

  <div class="card">
    <div class="card-header">
      <h2>Listar usuarios</h2>
      <a class="btn btn-primary" href="./crear.php" role="button">Crear Usuario</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table aria-label="tabla de usuarios" class="table ">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre del usuario:</th>
              <th scope="col">Correo:</th>
              <th scope="col">Contraseña:</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($lista_tbl_usuarios as $registro) { ?>
              <tr class="">
                <td><?= $registro['id'] ?></td>
                <td><?= $registro['usuario'] ?></td>
                <td><?= $registro['correo'] ?></td>
                <td>********</td>
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