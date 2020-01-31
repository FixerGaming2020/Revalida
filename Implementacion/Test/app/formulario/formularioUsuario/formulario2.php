<?php
include_once '../../conf/Constants.php';
include_once '../../conf/Log.php';

session_start();

$legajo = $_SESSION['usuario'];
$apellido = $_SESSION['apellido'];
$nombre = $_SESSION['user'];
$cargo = $_SESSION['cargo'];
$gerencia = $_SESSION['gerencia'];

$resultado =  '
<html>

<head>
  <!-- ARCHIVOS CSS -->
  <link rel="stylesheet" href="../../../lib/css/checkbox.css" />

  <!-- ARCHIVOS JS -->
  <script type="text/javascript" charset="utf8" src="../../../lib/JQuery/modal.js"></script>

</head>

<body>

  <form id="msform">';

$resultado .= '
    <!-- progressbar -->
    <ul id="progressbar">';


$resultado .=  '
    <li class="active">Motivo de Solicitud</li>';

$resultado .= '
    <li >Plataforma</li>';

$resultado .= '
    <li>Servicio</li>';

$resultado .= '
    <li>Aplicacion</li>';

$resultado .= '
    <li>Datos Personales</li>';

$resultado .= '
    <li>Finalizar</li>';

$resultado .= '
  </ul>
  <!-- fieldsets -->
   <div id="field">
';

//PANTALLA DE MOTIVOS DE SOLICITUD.
$resultado .= '
  <fieldset id="1" value="1">
  <h2 value="as"  id="prueba" name="prueba" class="fs-title">MOTIVO DE SOLICITUD</h2>
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
  <input type="button" id="next" name="next" class="next action-button" value="Siguiente" />
</fieldset>';

//PANTALLA DE PLATAFORMA
$resultado .= '
  <fieldset  id="2" value="2">
  <h2 class="fs-title">PLATAFORMA</h2>
  <h3 class="fs-subtitle">Segundo Paso</h3>
  <div class="col-12 ">
      <input class="checkbox-tools" type="radio" name="tools" value="Windows" id="tool-4" checked>
      <label class="for-checkbox-tools" for="tool-4">
          <i class="uil uil-line-alt"></i>
          Windows 
      </label>
  </div>
  <div class="col-12">
    <input class="checkbox-tools" type="radio" name="tools" value="Linux" id="tool-5">
    <label class="for-checkbox-tools " for="tool-5">
      <i class="uil uil-vector-square"></i>
        Linux
    </label>
  </div>
  <div class="col-12">
    <input class="checkbox-tools" type="radio" value="MacOS" name="tools" id="tool-6">
    <label class="for-checkbox-tools" for="tool-6">
      <i class="uil uil-vector-square"></i>
        MacOS
    </label>
  </div>
  <input type="button" name="previous" class="previous action-button" value="Anterior" />
  <input type="button" name="next" class="next action-button" value="Siguiente" />
  </fieldset>';

//PANTALLA DE SERVICIO
$resultado .= '
  <fieldset  id="3">
  <h2 id="servicio" class="fs-title">SERVICIO</h2>
  <h3 class="fs-subtitle">Tercer Paso</h3>
  <div id="servicio" name="servicio" class="col-12 ">
      <input class="checkbox-tools" type="radio" name="tools"  value="Acceso a Internet"  id="tool-7" checked>
      <label class="for-checkbox-tools" for="tool-7">
          <i class="uil uil-line-alt"></i>
          Acceso a Internet 
      </label>
  </div>
  <div class="col-12">
    <input class="checkbox-tools" type="radio" name="tools" value="Correo Interno" id="tool-8">
    <label class="for-checkbox-tools " for="tool-8">
      <i class="uil uil-vector-square"></i>
        Correo Interno
    </label>
  </div>
  <div class="col-12">
    <input class="checkbox-tools" type="radio" name="tools" value="Correo Externo" id="tool-9">
    <label class="for-checkbox-tools" for="tool-9">
      <i class="uil uil-vector-square"></i>
          Correo Externo
    </label>
  </div>
  <input type="button" name="previous" class="previous action-button" value="Anterior" />
  <input type="button" name="next" class="next action-button" value="Siguiente" />
  </fieldset>';

// //PANTALLA DE APLICACION, ANTES DE OBTENER LOS DATOS
$resultado .= '
  <fieldset  id="5" >
  <h2 class="fs-title">APLICACION</h2>
  <h3 class="fs-subtitle">Cuarto Paso</h3>
  <div class="col-12 ">
  <input type="button"  class="button" name="aplicaciones" id="aplicaciones" value="Seleccionar Aplicacion" />

  <table class="table table-borderless display nowrap" id="iddatatable" >
  <tr>
    <th>APLICACIONES</th>
  </tr>
  <tr>
  <td id="tabla" name="prueba"></td>
  </tr>';

$resultado .= '
 </table>
  </div>
  <input type="button" name="previous" class="previous1 action-button" value="Anterior" />
  <input type="button" name="next" class="next action-button" value="Siguiente" />
  </fieldset>';

  //PANTALLA DE DATOS PERSONALES
$resultado .= '
<fieldset  id="6">
<h2  class="fs-title">DATOS PERSONALES</h2>
<h3 class="fs-subtitle">Quinto Paso</h3>
<div class="group">      
  <input id="input1" type="text" value="' . $nombre . '" disabled>
  <span id="span1" class="highlight"></span>
  <span id="span2" class="bar"></span>
  <label id="label1">Nombre</label>
</div>
<div class="group">
  <input id="input1" type="text" value="' . $apellido . '" disabled>
  <span id="span1" class="highlight"></span>
  <span id="span2" class="bar"></span>
  <label id="label1">Apellido</label>
</div>
<div class="group">      
  <input id="input1" type="text" value="' . $cargo . '" disabled>
  <span id="span1" class="highlight"></span>
  <span id="span2" class="bar"></span>
  <label id="label1">Cargo</label>
</div>
<div class="group">      
  <input id="input1" type="text" value="' . $gerencia . '" disabled>
  <span id="span1" class="highlight"></span>
  <span id="span2" class="bar"></span>
  <label id="label1">Gerencia</label>
</div>
<div class="group">      
  <input  id="input1" type="text" value="' . $legajo . '" disabled>
  <span id="span1" class="highlight"></span>
  <span id="span2" class="bar"></span>
  <label id="label1">Legajo</label>
</div>
<input type="button" name="previous" class="previous action-button" value="Anterior" />
<input type="button" name="next" class="next1 action-button" value="Siguiente" />
</fieldset>';

//PANTALLA FINALIZADO
$resultado .= '
<fieldset class="holu" id="6">
<h2  class="fs-title">FINALIZADO</h2>
<h3 class="fs-subtitle">Muchas gracias</h3>
<div id="loader-icon"><img class="img1" src="../../../lib/img/check.gif" alt=""></div>
</fieldset>';

$resultado .= '
      </div>  
    </form>
  </body>
</html>
';


$json[] = array('resultado' => $resultado);
if ($resultado != NULL) {
  echo json_encode($json);
}
