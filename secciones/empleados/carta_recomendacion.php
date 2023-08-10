<?php
require_once '../../bd.php';
if ($_GET["txtID"]) {
  //traigo todos los campos del empleado especifico de la BD
  $txtID = $_GET['txtID'];
  $sentencia = $conexion->prepare("SELECT *, (
    SELECT nombredelpuesto
    FROM tbl_puestos
    WHERE tbl_puestos.id=tbl_empleados.idpuesto
    ) as puesto FROM `tbl_empleados` WHERE id=:id");
  $sentencia->bindParam(':id', $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_ASSOC);
  //cargo variables desde 
  $primernombre = $registro["primernombre"];
  $segundonombre = $registro["segundonombre"];
  $primerapellido = $registro["primerapellido"];
  $segundoapellido = $registro["segundoapellido"];

  $nombreCompleto = "$primernombre $segundonombre $primerapellido $segundoapellido";
  $foto = $registro["foto"];
  $cv = $registro["cv"];
  $idpuesto = $registro["idpuesto"];
  $puesto = $registro["puesto"];
  $fechadeingreso = $registro["fechadeingreso"];

  //Calculo de antigüedad
  $fechaInicio = new DateTime($fechadeingreso);
  $fechaFin = new DateTime(date('Y-m-d'));
  $diferencia = date_diff($fechaInicio, $fechaFin);
}
ob_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carta de recomendación</title>
</head>

<body>
  <h1>Carta de recomendación laboral</h1>
  <p align="right">Buenos Aires, Argentina a <strong><?= date('d-m-Y') ?></strong></p>
  <p>A quien pueda interesar</p>
  <p>Reciba un cordial y respetuoso saludo.</p>
  <p>A traves de estas lineas deseo hacer de su conocimiento que el/la Sr(a) <strong><?= $nombreCompleto ?></strong>
    quien trabajo en nuestra organización durante <strong> <?= $diferencia->y ?> años y <?= $diferencia->m ?> meses </strong>.
  </p>
  <p>Durante estos años se ha desempeñado como: <strong><?= $puesto ?></strong>.
    Es por ello le sugiero considere esta recomendación, con la confianza de que estara siempre a la altura de las circunstancias</p>
  <p>Sin mas nada a que referirme y, esperando que esta carta sea tomada en cuenta, dejo mi nro de contacto: +5411123456</p>
  <br>
  <p align="right">Atentamente,</p>
  <br>
  <p align="right">Mark Zuckerberg</p>

</body>

</html>

<?php
$HTML = ob_get_clean();
require_once '../../libs/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$opciones = $dompdf->getOptions();
$opciones->set(array("isRemoteEnabled" => true));

$dompdf->setOptions($opciones);

$dompdf->loadHtml($HTML);
$dompdf->setPaper("letter");
$dompdf->render();
$dompdf->stream("Carta-recomendacion.pdf", array("Attachment" => false));
