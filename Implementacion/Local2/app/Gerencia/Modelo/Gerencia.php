<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Gerencia {

    private $id;
    private $nombre;
    private $delegado;
    private $subDelegado;
    private $estado;
    private $mensaje;

    public function __construct($id = NULL, $nombre = NULL, $delegado = NULL, $subDelegado = NULL, $estado = NULL) {
        $this->id = $id;
        $this->nombre = utf8_decode($nombre);
        $this->delegado = $delegado;
        $this->subDelegado = $subDelegado;
        $this->estado = $estado;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return utf8_encode($$this->nombre);
    }

    public function getDelegado() {
        return $this->delegado;
    }

    public function getSubDelegado() {
        return $this->subDelegado;
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
        $this->nombre = utf8_decode($nombre);
    }

    public function setDelegado($delegado) {
        $this->delegado = $delegado;
    }

    public function setSubDelegado($subDelegado) {
        $this->subDelegado = $subDelegado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    /**
     * Realiza la creacion de la gerencia en la base de datos. Se requiere del nombre
     * y descripcion para llevar a cabo la operacion.
     * @return integer 0 cuando faltan datos o falla, 1 cuando no se creo o 2 para exito.
     */
    public function crear() {
        if ($this->nombre) {
            $consulta = "INSERT INTO gerencia OUTPUT INSERTED.id VALUES (?, ?, ?, 1)";
            $datos = array(&$this->nombre, &$this->delegado, &$this->subDelegado, &$this->estado);
            $creacion = SQLServer::instancia()->insertar($consulta, $datos);
            $this->mensaje = utf8_encode($this->nombre) . ": " . SQLServer::instancia()->getMensaje();
            return $creacion;
        }
        $this->mensaje = "No se recibieron los campos obligatorios";
        return 0;
    }

    /**
     * Realiza la modificacion de la gerencia en la base de datos. Se puede modificar
     * el nombre, delegado, subdelegado y estado de una gerencia referenciada a partir del id.
     * @return integer 0 cuando faltan datos o falla, 1 cuando no se modifico o 2 para exito.
     */
    public function modificar() {
        if ($this->id && $this->nombre && $this->delegado && $this->subDelegado) {
            $consulta = "UPDATE gerencia SET nombre = ?, delegado = ?, subDelegado = ?, estado = ? WHERE id = ?";
            $datos = array(&$this->nombre, &$this->delegado, &$this->subDelegado, &$this->estado, &$this->id);
            $modificacion = SQLServer::instancia()->modificar($consulta, $datos);
            $this->mensaje = utf8_encode($this->nombre) . ": " . SQLServer::instancia()->getMensaje();
            return $modificacion;
        }
        $this->mensaje = "No se recibieron los campos obligatorios";
        return 0;
    }

    /**
     * Obtiene un estado a partir de su id. Se asocia al objeto la informacion que
     * se obtiene desde la base de datos.
     * @return integer 0 cuando faltan datos, 1 cuando no hay resultados o 2 para exito.
     */
    public function obtener() {
        if ($this->id) {
            $consulta = "SELECT * FROM gerencia WHERE id = ?";
            $fila = SQLServer::instancia()->obtener($consulta, array($this->id));
            if (gettype($fila) == 'array') {
                $this->nombre = $fila['nombre'];
                $this->delegado = isset($fila['delegado']) ? $this->obtenerDelegado($fila['delegado']) : NULL;
                $this->subDelegado = isset($fila['subDelegado']) ? $this->obtenerSubDelegado($fila['subDelegado']) : NULL;
                $this->estado = $fila['estado'];
                return 2;
            }
            $this->mensaje = "No se obtuvo la información del estado";
            return 1;
        }
        $this->mensaje = "No se pudo hacer referencia al estado";
        return 0;
    }

    private function obtenerDelegado($idUsuario) {
        $deelegado = new Usuario($idUsuario);
        $resultado = $deelegado->obtener();
        $this->subDelegado = ($resultado == 2) ? $deelegado : NULL;
        $this->mensaje = ($resultado == 2) ? $this->mensaje : "No se pudo obtener el delegado";
        return $resultado;
    }

    private function obtenerSubDelegado($idUsuario) {
        $subDelegado = new Usuario($idUsuario);
        $resultado = $subDelegado->obtener();
        $this->subDelegado = ($resultado == 2) ? $subDelegado : NULL;
        $this->mensaje = ($resultado == 2) ? $this->mensaje : "No se pudo obtener el sub-delegado";
        return $resultado;
    }

}
