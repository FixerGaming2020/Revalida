<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../Conexion/Modelo/Constantes.php';
include_once '../Conexion/Modelo/Encriptador.php';
include_once '../Conexion/Modelo/Log.php';
include_once '../Conexion/Modelo/ConfiguracionBD.php';
include_once '../Conexion/Modelo/SQLServer.php';

$consulta = "SELECT * FROM usuario";
$resultado = SQLServer::instancia()->seleccionar($consulta, array());
echo gettype($resultado);

