<?php require_once '../../templates/header.php' ?>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>Creación de puestos</h3>
    </div>
    <div class="card-body">
      <form action="">
        <div class="mb-3">
          <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
          <input type="text" class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="">
        </div>
        <a class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
        <button type="submit" class="btn btn-success">Agregar registro</button>
      </form>
    </div>
  </div>
</div>

<?php require_once '../../templates/footer.php' ?>