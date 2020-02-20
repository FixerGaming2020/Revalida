<?php

class Usuario {

    private $id;
    private $nombre;
    private $apellido;
    private $legajo;
    private $contraseña;
    private $cargo;
    private $gerencia;
    private $firma;
    private $rol;
    private $estado;
    private $mensaje;

    public function __construct($id = null, $nombre = null, $apellido = null, $legajo = null, $contraseña = null, $cargo = null, $gerencia = null, $firma = null, $rol = null, $estado = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->legajo = $legajo;
        $this->contraseña = $contraseña;
        $this->cargo = $cargo;
        $this->gerencia = $gerencia;
        $this->firma = $firma;
        $this->rol = $rol;
        $this->estado = $estado;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getLegajo() {
        return $this->legajo;
    }

    public function getContraseña() {
        return $this->contraseña;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function getGerencia() {
        return $this->gerencia;
    }

    public function getFirma() {
        return $this->firma;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getMensaje() {
        return $this->mensaje;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setLegajo($legajo) {
        $this->legajo = $legajo;
    }

    public function setContraseña($contraseña) {
        $this->contraseña = $contraseña;
    }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    public function setGerencia($gerencia) {
        $this->gerencia = $gerencia;
    }

    public function setFirma($firma) {
        $this->firma = $firma;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function crear() {
        if ($this->id && $this->nombre && $this->rol) {
            $consulta = "INSERT INTO usuario VALUES (?, ?, ?, 'Activo')";
            $datos = array($this->id, $this->nombre, $this->rol);
            $creacion = SQLServer::instancia()->insertar($consulta, $datos);
            $this->mensaje = utf8_encode($this->nombre) . ": " . SQLServer::instancia()->getMensaje();
            return $creacion;
        }
        return 0;
    }

    public function modificar($legajoOriginal) {
        if ($this->id && $this->nombre && $this->rol) {
            $consulta = "UPDATE usuario SET id = ?, nombre = ?, id_rol = ? WHERE id = ?";
            $datos = array($this->id, $this->nombre, $this->rol, $legajoOriginal);
            $modificacion = SQLServer::instancia()->modificar($consulta, $datos);
            $this->mensaje = utf8_encode($this->nombre) . ": " . SQLServer::instancia()->getMensaje();
            if ($modificacion == 2) {
                $modificacion = $this->registrarActividad("MODIFICACION", $this->id);
            }
            return $modificacion;
        }
        return 0;
    }

    public function obtener() {
        if ($this->legajo) {
            $consulta = "SELECT * FROM usuario WHERE legajo = ?";
            $fila = SQLServer::instancia()->obtener($consulta, array(&$this->legajo));
            if (gettype($fila) == "array") {
                $this->nombre = $fila['nombre'];
                $this->estado = $fila['estado'];
                return $this->obtenerPerfil($fila['id_rol']);
            }
            $this->mensaje = "No se obtuvo la información del usuario";
            Log::guardarError("INGRESO", $this->mensaje);
            return 1;
        }
        $this->mensaje = "No se pudo hacer referencia al usuario";
        return 0;
    }

    private function obtenerPerfil($idRol) {
        $perfil = new Rol($idRol);
        $resultado = $perfil->obtener();
        $this->rol = ($resultado == 2) ? $perfil : NULL;
        $this->mensaje = ($resultado == 2) ? $this->mensaje : "No se pudo obtener el rol";
        if($this->mensaje == "No se pudo obtener el rol"){
            Log::guardarError("Error",$this->mensaje);
        }
        return $resultado;
    }

}
