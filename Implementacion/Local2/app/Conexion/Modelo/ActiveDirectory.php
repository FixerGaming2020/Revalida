<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ActiveDirectory {

    private $conexion;
    private $host;
    private $puerto;
    private $dominio;
    private $mensaje;

    public function __construct($host = NULL, $puerto = NULL, $dominio = NULL) {
        $this->host = $host;
        $this->puerto = $puerto;
        $this->dominio = $dominio;
    }

    public function getHost() {
        return $this->host;
    }

    public function getPuerto() {
        return $this->puerto;
    }

    public function getDominio() {
        return $this->dominio;
    }

    public function getMensaje() {
        return $this->mensaje;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function setPuerto($puerto) {
        $this->puerto = $puerto;
    }

    public function setDominio($dominio) {
        $this->dominio = $dominio;
    }

    public function conectar() {
        $this->conexion = ldap_connect($this->host, $this->puerto);
        if ($this->conexion) {
            ldap_set_option($this->conexion, LDAP_OPT_PROTOCOL_VERSION, 3);
            return true;
        }
        $this->mensaje = "No se pudo establecer la conexion con LDAP (verifique la configuración)";
        Log::escribirLineaError("Error al realizar la conexion con LDAP (HOST: {$this->host}, PORT: {$this->puerto})");
        return false;
    }

    public function buscar($usuario, $clave) {
        $user = $this->dominio . $usuario;
        if (@ldap_bind($this->conexion, $user, $clave)) {
            return true;
        }
        $this->mensaje = "Usuario no autenticado (verifique los datos)";
        Log::escribirLineaError("Usuario no autenticado en LDAP (USUARIO: {$user})");
        return false;
    }

}
