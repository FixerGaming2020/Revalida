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

    /** @var Encriptador Encriptador/Desencriptador de datos. */
    private $encriptador;

    /** @var string URL del archivo de configuracion XML */
    private $url;

    public function __construct() {
        $this->url = CON . "\\config.xml";
        $this->encriptador = new Encriptador();
    }

    public function getHost() {
        return ($this->host) ? $this->encriptador->desencriptar($this->host, $this->clave) : NULL;
    }

    public function getBaseDatos() {
        return ($this->baseDatos) ? $this->encriptador->desencriptar($this->baseDatos, $this->clave) : NULL;
    }

    public function getUsuario() {
        return ($this->usuario) ? $this->encriptador->desencriptar($this->usuario, $this->clave) : NULL;
    }

    public function getPassword() {
        return ($this->password) ? $this->encriptador->desencriptar($this->password, $this->clave) : NULL;
    }

    public function leerConfiguracion() {
        if (file($this->url)) {
            $configuracion = simplexml_load_file($this->url);
            $this->host = $configuracion->conf[0]->host;
            $this->baseDatos = $configuracion->conf[0]->base;
            $this->usuario = $configuracion->conf[0]->user;
            $this->password = $configuracion->conf[0]->pass;
            $this->clave = $configuracion->conf[0]->key;
            return true;
        }
        Log::escribirError("Error al leer archivo de configuracion en $this->url", "leerConfiguracion()");
        return false;
    }

}
