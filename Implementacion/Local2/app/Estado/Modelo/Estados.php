<?php

class Estados {

    private static $mensaje;

    /**
     * Retorna el mensaje asociado a la ultima operacion realizada.
     * @return string Mensaje de la operacion realizada.
     */
    public static function getMensaje() {
        return self::$mensaje;
    }

    /**
     * Devuelve el resultado de la busqueda de estados a taves del nombre.
     * @param string $nombre Nombre (o parte del nombre) a buscar.
     * @return resource Retorna el recurso, 0 para error, 1 cuando no hay resultados.
     */
    public static function buscar($nombre) {
        $consulta = "SELECT * FROM estado WHERE nombre LIKE ? ORDER BY nombre";
        $resultado = SQLServer::instancia()->seleccionar($consulta, array('%' . $nombre . '%'));
        self::$mensaje = SQLServer::instancia()->getMensaje();
        return $resultado;
    }

    /**
     * Devuelve un listado de todos los estados ordenados por nombre.
     * @return resource Retorna el recurso, 0 para error, 1 cuando no hay resultados.
     */
    public static function listar() {
        $consulta = "SELECT * FROM estado ORDER BY nombre";
        $resultado = SQLServer::instancia()->seleccionar($consulta, array());
        self::$mensaje = SQLServer::instancia()->getMensaje();
        return $resultado;
    }

}
