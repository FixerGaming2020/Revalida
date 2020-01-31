<?php
/* 
 * Descripcion de BDConfiguracion
 * 
 * Esta clase lee los datos necesarios para la conexion a la base de datos leyendo
 * la informacion del archivo xml de configuracion
 * 
 */
class BDConfiguracion {
    
    private $servidor;
    private $baseDatos;
    private $usuario;
    private $contrasenia;
    
    function __construct() {
        $url = $_SERVER['DOCUMENT_ROOT']."\Revalida\app\conf\config.xml";
        $conexiones = simplexml_load_file($url);
        $this->servidor = $conexiones->conexion[0]->serverName;
        $this->baseDatos = $conexiones->conexion[0]->dataBase;
        $this->usuario = $conexiones->conexion[0]->uid;
        $this->contrasenia = $conexiones->conexion[0]->pwd;
    }
    
    function getServidor(){
        return "".$this->servidor;
    }
    
    function getBaseDatos(){
        return "".$this->baseDatos;
    }
    
    function getUsuario(){
        return "".$this->usuario;
    }
    
    function getContrasenia(){
        return "".$this->contrasenia;
    }
}

