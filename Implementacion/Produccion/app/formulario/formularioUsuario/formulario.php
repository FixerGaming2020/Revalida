<?php
// PRIMERA PARTE DEL FORMULARIO. 
$resultado .= '

<head>
<!-- CODIGO CSS-->
<link rel="stylesheet" href="../../../lib/css/checkbox.css" />

<!-- CODIGO JS-->
<script type="text/javascript" charset="utf8" src="../../../lib/JQuery/modal.js"></script>

</head>

<body>

<form id="msform">';

$resultado .= '
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Motivo de Solicitud</li>';

$resultado .= '
    <li>Plataforma</li>';

$resultado .= '    
    <li>Servicio</li>';

$resultado .= '
    <li>Aplicacion</li>';


$resultado .= '
  </ul>
  <!-- fieldsets -->
  <div id="field">
  <fieldset  class="fieldset1" id="fieldset1">
    <h2  id="motivo" class="fs-title">MOTIVO DE SOLICITUD</h2>
    <h3 class="fs-subtitle">Primer Paso</h3>
    <div class="col-12 ">
        <input class="checkbox-tools" type="radio" name="tools" value="Alta" id="tool-1" />
        <label class="for-checkbox-tools" for="tool-1">
            <i class="uil uil-line-alt"></i>
              Alta
        </label>
    </div>
    <div class="col-12">
      <input class="checkbox-tools" type="radio" name="tools"  value="Modificacion" id="tool-2" />
      <label class="for-checkbox-tools" for="tool-2">
        <i class="uil uil-vector-square"></i>
          Modificacion
      </label>
    </div>
    <div class="col-12">
      <input class="checkbox-tools" type="radio" name="tools" value="Baja" id="tool-3" />
      <label class="for-checkbox-tools" for="tool-3">
        <i class="uil uil-vector-square"></i>
          Baja
      </label>
    </div>
    <input type="submit" id="nextMotivo" name="nextMotivo" class="nextMotivo action-button" value="Next" />
  </fieldset>
</div>

</form>
</body>
';

$json[] = array('resultado' => $resultado);
if ($resultado != NULL) {
  echo json_encode($json);
}
?>
