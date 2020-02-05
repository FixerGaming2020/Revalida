<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SQLServer {

    /** Instancia de la conexion con la BD */
    public static $instancia;

    /** @var Conexion con la base de datos */
    private $conexion;

    /** @var integer Identificador de registro */
    private $id;

    /** @var string Mensaje que describe el resultado de una operacion */
    private $mensaje;

    public function __construct() {
        $configuracion = new ConfiguracionBD();
        $lectura = $configuracion->leerConfiguracion();
        if ($lectura) {
            $host = $configuracion->getHost();
            $usuario = $configuracion->getUsuario();
            $clave = $configuracion->getPassword();
            $baseDatos = $configuracion->getBaseDatos();
            $datosConexion = array("Database" => $baseDatos, "UID" => $usuario, "PWD" => $clave);
            $this->conectar($host, $datosConexion);
        } else {
            Log::errorConexion("Error al leer archivo de configuracion", "__construct()");
        }
    }

    public function getUltimoId() {
        return $this->id;
    }

    /**
     * Devuelve el mensaje sobre el resultado de alguna consulta a la BD.
     * @return string Mensaje que describe el resultado de alguna operacion.
     */
    public function getMensaje() {
        return $this->mensaje;
    }

    private function buscarError($errores, $codigo) {
        if ($errores != null) {
            return (in_array($codigo, array_column($errores, 'code')));
        }
        return false;
    }

    /**
     * Realiza la conexion con la BD. Cuando se establece la conexion se asigna el
     * recurso al objeto conexion, en caso contrario sera nulo. 
     * @param string $host Nombre del host donde realizar la conexion.
     * @param array $datos Arreglo que contiene el nombre de la BD, usuario y clave.
     */
    private function conectar($host, $datos) {
        $this->conexion = sqlsrv_connect($host, $datos);
        if (!$this->conexion) {
            $this->conexion = NULL;
            Log::errorConexion("Error al realizar la conexion a la BD", "conectar($host, {$datos['Database']}, {$datos['UID']}, {$datos['PWD']})");
        }
    }

    /**
     * Finaliza la transaccion con la BD. Cuando se indica que el resultado es true
     * se aplica un commit en la BD, cuando se indica que el resultado es false se
     * aplica un rollback en la BD. 
     * @param boolean $resultado Resultado del conjunto de operaciones realizadas.
     */
    public function finalizarTransaccion($resultado = TRUE) {
        ($resultado) ? sqlsrv_commit($this->conexion) : sqlsrv_rollback($this->conexion);
    }

    private function grabarError($metodo, $consulta, $errores) {
        $cadena = "";
        foreach ($errores as $error) {
            $cadena .= $error['code'] . ": " . $error['message'];
        }
        Log::errorConexion($metodo . " / " . $consulta . " / " . $cadena);
    }

    /**
     * Inicia el proceso de transaccion. El metodo retorna true cuando la inicializacion
     * es correcta y false en caso contrario.
     * @return boolean True si se inicializa, false en caso contrario.
     */
    public function iniciarTransaccion() {
        if (sqlsrv_begin_transaction($this->conexion) === false) {
            $this->mensaje = "No se pudo incializar la transaccion para operar";
            Log::escribirLineaError("Error al inicializar transaccion con la BD");
            return false;
        }
        return true;
    }

    /**
     * Realiza la creacion de una nueva instancia de la conexion a la BD o devuelve
     * la instancia existente.
     */
    public static function instancia() {
        if (!self::$instancia instanceof self) {
            try {
                self::$instancia = new self;
            } catch (Exception $e) {
                Log::escribirError("Error al obtener instancia de la conexion a la BD - {$e->getCode()} - {$e->getMessage()}", "instancia()");
            }
        }
        return self::$instancia;
    }

    public function borrar($consulta, $parametros) {
        $resultado = sqlsrv_prepare($this->conexion, $consulta, $parametros);
        if ($resultado && sqlsrv_execute($resultado)) {
            if (sqlsrv_rows_affected($resultado) > 0) {
                $this->mensaje = "Se eliminó el registro correctamente";
                return 2;
            }
            $this->mensaje = "No se eliminó el registro";
            return 1;
        }
        Log::escribirLineaError("Error al realizar DELETE en la BD - borrar($consulta)");
        $this->mensaje = "No se creó el registro por un error interno (comunicar al administrador)";
        return 0;
    }

    public function ejecutar($consulta) {
        $resultado = sqlsrv_query($this->conexion, $consulta);
        if ($resultado) {
            $this->mensaje = "Se creó el registro correctamente";
            return 2;
        }
        if ($this->buscarError(sqlsrv_errors(), 3621)) {
            $this->mensaje = "No se creó el registro solicitado porque ya existe";
            return 1;
        }
        $this->grabarError("INSERTAR", $consulta, sqlsrv_errors());
        $this->mensaje = "No se creó el registro por un error interno (comunicar al administrador)";
        return 0;
    }

    public function insertar($consulta, $parametros) {
        $resultado = sqlsrv_prepare($this->conexion, $consulta, $parametros);
        if ($resultado && sqlsrv_execute($resultado)) {
            $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC);
            $this->id = $row["id"];
            $this->mensaje = "Se creó el registro correctamente";
            return 2;
        }
        if ($this->buscarError(sqlsrv_errors(), 2627)) {
            $this->mensaje = "No se creó el registro solicitado porque ya existe";
            return 1;
        }
        $this->grabarError("INSERTAR", $consulta, sqlsrv_errors());
        $this->mensaje = "No se creó el registro por un error interno (comunicar al administrador)";
        return 0;
    }

    public function modificar($consulta, $parametros) {
        $resultado = sqlsrv_prepare($this->conexion, $consulta, $parametros);
        if ($resultado && sqlsrv_execute($resultado)) {
            $this->mensaje = "Se modificó el registro correctamente";
            return 2;
        }
        if ($this->buscarError(sqlsrv_errors(), 2627)) {
            $this->mensaje = "No se modificó el registro solicitado porque ya existe";
            return 1;
        }
        $this->grabarError("MODIFICAR", $consulta, sqlsrv_errors());
        $this->mensaje = "No se modificó el registro por un error interno (comunicar al administrador)";
        return 0;
    }

    public function obtener($consulta, $parametros) {
        $resultado = sqlsrv_query($this->conexion, $consulta, $parametros);
        if ($resultado) {
            return (sqlsrv_has_rows($resultado)) ? sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) : 1;
        }
        Log::escribirLineaError("OBTENER: Error al realizar SELECT en la BD (QUERY: $consulta)");
        $this->mensaje = "Ocurrio un error al obtener registro (informe al administrador)";
        return 0;
    }

    public function seleccionar($consulta, $parametros) {
        $opciones = array('Scrollable' => SQLSRV_CURSOR_KEYSET);
        $resultado = sqlsrv_query($this->conexion, $consulta, $parametros, $opciones);
        if ($resultado) {
            $this->mensaje = (sqlsrv_has_rows($resultado)) ? "" : "No se encontraron resultados";
            return (sqlsrv_has_rows($resultado)) ? $resultado : 1;
        }
        Log::escribirLineaError("SELECCIONAR: Error al realizar SELECT en la BD (QUERY: $consulta)");
        $this->mensaje = "Ocurrio un error al realizar la consulta (informe al administrador)";
        return 0;
    }

}
