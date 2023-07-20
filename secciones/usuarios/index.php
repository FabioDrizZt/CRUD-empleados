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
              <th scope="col">Contraseña:</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr class="">
              <td>1</td>
              <td>fabiodrizzt</td>
              <td>********</td>
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