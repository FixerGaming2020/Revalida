<?php

class Log {

    /**
     * Escribe una nueva linea de error en un archivo de texto.
     * @param string $texto Descripcion del mensaje a guardar.
     */
    public static function escribirLineaError($texto) {
        $date = date("H:i:s");
        $url = LOG . "\\" . date("Y_m_d") . ".txt";
        $file = file_exists($url) ? fopen($url, 'a') : fopen($url, 'w');
        $ip = $_SERVER["REMOTE_ADDR"];
        $script = $_SERVER["SCRIPT_NAME"];
        $user = (isset($_SESSION['usuario'])) ? $_SESSION['usuario']->getId() : "";
        $data = "[HORA: {$date}][USUARIO: {$user}][IP: {$ip}][SCRIPT: {$script}][{$texto}]" . PHP_EOL;
        fwrite($file, $data);
    }

    /**
     * Guarda en la base de datos la accion del usuario en sesion. Este metodo guarda un
     * nuevo registro en la tabla logsAccion.
     * @param string $accion Accion que se realizo.
     * @param string $mensaje Mensaje o descripcion asociada a la accion.
     * @return int Cero si falla, uno si faltan datos, dos si se registra la accion.
     */
    public static function guardarAccion($accion, $mensaje) {
        if ($accion && $mensaje) {
            $usuario = (isset($_SESSION['usuario'])) ? $_SESSION['usuario']->getId() : "DESC";
            $consulta = "INSERT INTO logsAccion VALUES (?, ?, ?, GETDATE())";
            $datos = array(&$usuario, &$accion, &$mensaje);
            $creacion = SQLServer::instancia()->insertar($consulta, $datos);
            ($creacion == 2) ?: Log::escribirLineaError(SQLServer::instancia()->getMensaje() . " - " . $accion . " - " . $mensaje);
            return $creacion;
        }
        Log::escribirLineaError("No se pudo guardar actividad por falta de datos");
        return 1;
    }

    /**
     * Guarda en la base de datos la conexion o acciones del usuario en sesion. Este metodo
     * guarda un nuevo registro en la tabla logsConexionBD.
     * @param string $accion Accion que se realizo.
     * @param string $mensaje Mensaje o descripcion asociada a la accion.
     * @return int Cero si falla, uno si faltan datos, dos si se registra la accion.
     */
    public static function guardarConexion($accion, $mensaje) {
        if ($accion && $mensaje) {
            $usuario = (isset($_SESSION['usuario'])) ? $_SESSION['usuario']->getLegajo() : "DESC";
            $consulta = "INSERT INTO logsConexionBD VALUES (?, ?, ?, GETDATE())";
            $datos = array(&$usuario, &$accion, &$mensaje);
            $creacion = SQLServer::instancia()->insertar($consulta, $datos);
            ($creacion == 2) ?: Log::escribirLineaError(SQLServer::instancia()->getMensaje() . " - " . $accion . " - " . $mensaje);
            return $creacion;
        }
        Log::escribirLineaError("No se pudo guardar actividad por falta de datos");
        return 1;
    }

    public static function guardarError($accion, $mensaje) {
        if ($accion && $mensaje) {
            $usuario = (isset($_SESSION['usuario'])) ? $_SESSION['usuario']->getId() : "DESC";
            $consulta = "INSERT INTO logsError VALUES (?, ?, ?, GETDATE())";
            $datos = array(&$usuario, &$accion, &$mensaje);
            $creacion = SQLServer::instancia()->insertar($consulta, $datos);
            ($creacion == 2) ?: Log::escribirLineaError(SQLServer::instancia()->getMensaje() . " - " . $accion . " - " . $mensaje);
            return $creacion;
        }
        Log::escribirLineaError("No se pudo guardar actividad por falta de datos");
        return 1;
    }

}
