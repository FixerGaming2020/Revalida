<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Estado {

    private $id;
    private $nombre;
    private $descripcion;
    private $mensaje;

    public function __construct($id = NULL, $nombre = NULL, $descripcion = NULL) {
        $this->id = $id;
        $this->nombre = utf8_decode($nombre);
        $this->descripcion = utf8_decode($descripcion);
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return utf8_encode($this->nombre);
    }

    public function getDescripcion() {
        return utf8_encode($this->descripcion);
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

    public function setDescripcion($descripcion) {
        $this->descripcion = utf8_decode($descripcion);
    }

    /**
     * Realiza la eliminacion del estado en la base de datos.
     * @return integer 0 cuando faltan datos o falla, 1 cuando no se elimino o 2 para exito.
     */
    public function borrar() {
        if ($this->id) {
            $consulta = "DELETE FROM estado WHERE id = ?";
            $eliminacion = SQLServer::instancia()->borrar($consulta, array($this->id));
            $this->mensaje = SQLServer::instancia()->getMensaje();
            return $eliminacion;
        }
        $this->mensaje = "No se pudo hacer referencia al permiso";
        return 0;
    }

    /**
     * Realiza la creacion del estado en la base de datos. Se requiere del nombre
     * y descripcion para llevar a cabo la operacion.
     * @return integer 0 cuando faltan datos o falla, 1 cuando no se creo o 2 para exito.
     */
    public function crear() {
        if ($this->nombre && $this->descripcion) {
            $consulta = "INSERT INTO estado OUTPUT INSERTED.id VALUES (?, ?)";
            $datos = array(&$this->nombre, &$this->descripcion);
            $creacion = SQLServer::instancia()->insertar($consulta, $datos);
            $this->mensaje = utf8_encode($this->nombre) . ": " . SQLServer::instancia()->getMensaje();
            return $creacion;
        }
        $this->mensaje = "No se recibieron los campos obligatorios";
        return 0;
    }

    /**
     * Realiza la modificacion del estado en la base de datos. Se puede modificar
     * el nombre y/o descripcion de un estado referenciado a partir del id.
     * @return integer 0 cuando faltan datos o falla, 1 cuando no se modifico o 2 para exito.
     */
    public function modificar() {
        if ($this->id && $this->nombre && $this->descripcion) {
            $consulta = "UPDATE estado SET nombre = ?, descripcion = ? WHERE id = ?";
            $datos = array($this->nombre, $this->descripcion, $this->id);
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
            $consulta = "SELECT * FROM estado WHERE id = ?";
            $fila = SQLServer::instancia()->obtener($consulta, array($this->id));
            if (gettype($fila) == 'array') {
                $this->nombre = $fila['nombre'];
                $this->descripcion = $fila['descripcion'];
                return 2;
            }
            $this->mensaje = "No se obtuvo la información del estado";
            return 1;
        }
        $this->mensaje = "No se pudo hacer referencia al estado";
        return 0;
    }

}
