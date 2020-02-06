<?php

class ConfiguracionBD {

    /** @var string Host de la base de datos. */
    private $host;

    /** @var string Nombre de la base de datos. */
    private $baseDatos;

    /** @var string Usuario de acceso a la base de datos. */
    private $usuario;

    /** @var string Clave de acceso a la base de datos. */
    private $password;

    /** @var string Clave de encriptacion. */
    private $clave;

    /** @var string URL del archivo de configuracion XML */
    private $url;

    public function __construct() {
        $this->url = CON . "\\config.xml";
    }

    public function getHost() {
        return ($this->host);
    }

    public function getBaseDatos() {
        return ($this->baseDatos) ;
    }

    public function getUsuario() {
        return ($this->usuario);
    }

    public function getPassword() {
        return ($this->password);
    }

    public function leerConfiguracion() {
        if (file($this->url)) {
            $configuracion = simplexml_load_file($this->url);
            $this->host = $configuracion->conexion[0]->serverName;
            $this->baseDatos = $configuracion->conexion[0]->dataBase;
            $this->usuario = $configuracion->conexion[0]->uid;
            $this->password = $configuracion->conexion[0]->pwd;
            return true;
        }
        Log::errorConexion("Error al leer archivo de configuracion en $this->url", "leerConfiguracion()");
        return false;
    }

}
