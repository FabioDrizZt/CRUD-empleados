<?php require_once '../../templates/header.php' ?>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>Creación de empleado</h3>
    </div>
    <div class="card-body">
      <form>
        <div class="mb-3">
          <label for="primernombre" class="form-label">Primer Nombre</label>
          <input type="text" class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="segundonombre" class="form-label">Segundo Nombre</label>
          <input type="text" class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="primerapellido" class="form-label">Primer Apellido</label>
          <input type="text" class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="segundoapellido" class="form-label">Segundo Apellido</label>
          <input type="text" class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Foto:</label>
          <input type="file" class="form-control" name="foto" id="foto" placeholder="" aria-describedby="fileHelpId">
        </div>
        <div class="mb-3">
          <label for="cv" class="form-label">CV(PDF):</label>
          <input type="file" class="form-control" name="cv" id="cv" placeholder="" aria-describedby="fileHelpId">
        </div>
        <label for="puesto" class="form-label">Puesto:</label>
        <select class="form-select" aria-label="Default select example">
          <option disabled selected>Seleccione su puesto</option>
          <option value="1">Uno</option>
          <option value="2">Dos</option>
          <option value="3">Tres</option>
        </select>
        <br>
        <a class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
        <button type="submit" class="btn btn-success">Agregar registro</button>
      </form>
    </div>
  </div>
</div>



<?php require_once '../../templates/footer.php' ?>