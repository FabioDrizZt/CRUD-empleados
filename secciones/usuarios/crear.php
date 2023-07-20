<?php require_once '../../templates/header.php' ?>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>Creación de usuarios</h3>
    </div>
    <div class="card-body">
      <form action="">
        <div class="mb-3">
          <label for="nombredelpuesto" class="form-label">Nombre del usuario</label>
          <input type="text" class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="">
        </div>
        <a class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
        <button type="submit" class="btn btn-success">Agregar registro</button>
      </form>
    </div>
  </div>
</div>
<?php require_once '../../templates/footer.php' ?>