<?php 

require_once '../../Principal/Modelo/constante.php';
require_once '../../Principal/Modelo/AutoCargador.php';

AutoCargador::cargarModulos();

session_start();

$controlador  = new ControladorAlta();

$solicitudes = $controlador->

?>