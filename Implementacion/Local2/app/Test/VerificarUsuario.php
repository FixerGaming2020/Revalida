<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../Conexion/Modelo/Constantes.php';
include_once '../Conexion/Modelo/AutoCargador.php';

AutoCargador::cargarModulos();

$legajo = "07196";
$clave = "07196";


$controlador = new ControladorConexion();

$resultado = $controlador->verificarUsuarioSistema($legajo, $clave);

echo "<br>Resultado:" . $resultado;
