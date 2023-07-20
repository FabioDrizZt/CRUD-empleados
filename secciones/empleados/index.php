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
              <th scope="col">Nombre</th>
              <th scope="col">Foto</th>
              <th scope="col">CV</th>
              <th scope="col">Puesto</th>
              <th scope="col">Fecha de ingreso</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr class="">
              <td>Fabio D. Argañaraz</td>
              <td>imagen.jpg</td>
              <td>CV.pdf</td>
              <td>Profesor</td>
              <td>12/12/2019</td>
              <td>
                <a class="btn btn-success" href="#" role="button">Carta</a>
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
