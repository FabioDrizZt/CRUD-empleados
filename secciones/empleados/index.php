<?php require_once '../../bd.php';

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
                  <a href="<?= "./assets/pdf/" .  $registro['cv'] ?>" download="<?= "CV-" . $registro['primernombre'] . $registro['primerapellido'] ?>">CV</a>
                </td>
                <td><?= $registro['puesto'] ?></td>
                <td><?= $registro['fechadeingreso'] ?></td>
                <td>
                  <a class="btn btn-success" href="#" role="button">Carta</a>
                  <a class="btn btn-info" href="./editar.php" role="button">Editar</a>
                  <a class="btn btn-danger" href="#" role="button">Borrar</a>
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