<?php

class Log {

    /**
     * Escribe una linea en el archivo indicado.
     * @param string $text Linea de texto a agregar.
     */
    public function errorConexion($texto) {
        $hour = date("Y-m-d H:i:s");
        $usuario = (isset($_SESSION["usuario"])) ? $_SESSION['usuario']->getId() : "";
        $consulta = "INSERT INTO logsConexionBD VALUES(?,?,?,?)";
        $datos = array(&$usuario,&$hour,&$usuario,&$texto);
        $creacion  = SQLServer::instancia()->insertar($consulta,$datos);
    }

}
