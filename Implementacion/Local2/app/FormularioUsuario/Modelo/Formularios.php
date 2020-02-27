<?php


class formulario {
    
    private static $mensaje;


    public static function getMensaje() {
        return self::$mensaje;
    }


    public static function listarUltimasAltas() {
        $consulta = "SELECT * FROM formulario WHERE estado = '1' ORDER BY aid DESC";
        $resultado = SQLServer::instancia()->seleccionar($consulta, array());
        self::$mensaje = SQLServer::instancia()->getMensaje();
        return $resultado;
    }

}

?>