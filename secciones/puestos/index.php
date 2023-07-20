<?php require_once '../../bd.php' ?>
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
            <tr class="">
              <td>1</td>
              <td>Profesor</td>
              <td>
                <a class="btn btn-info" href="./editar.php" role="button">Editar</a>
                <a class="btn btn-danger" href="#" role="button">Eliminar</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>

  </div>
</div>

<?php require_once '../../templates/footer.php' ?>
