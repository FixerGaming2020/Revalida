<?php

/**
 * Description of Permiso
 *
 * @author 07489
 */
class Permiso {

    private $id;
    private $nombre;
    private $nivel;
    private $padre;
    private $link;
    private $mensaje;

    public function __construct($id = NULL, $nombre = NULL, $nivel = NULL, $padre = NULL, $link = NULL) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->nivel = $nivel;
        $this->padre = $padre;
        $this->link = $link;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return utf8_encode($this->nombre);
    }

    public function getNivel() {
        return $this->nivel;
    }

    public function getPadre() {
        return $this->padre;
    }

    public function getLink() {
        return $this->link;
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

    public function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    public function setPadre($padre) {
        $this->padre = $padre;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function borrar() {
        if ($this->id) {
            $consulta = "DELETE FROM permiso WHERE id = ?";
            $eliminacion = SQLServer::instancia()->borrar($consulta, array($this->id));
            $this->mensaje = SQLServer::instancia()->getMensaje();
            if ($eliminacion == 2) {
                $eliminacion = $this->registrarActividad("ELIMINACION", $this->id);
            }
            return $eliminacion;
        }
        $this->mensaje = "No se pudo hacer referencia al permiso";
        return 0;
    }

    public function modificar() {
        if ($this->id && $this->nombre && $this->nivel) {
            $consulta = "UPDATE permiso SET nombre = ?, nivel = ?, padre = ?, link = ? WHERE id = ?";
            $datos = array($this->nombre, $this->nivel, $this->padre, $this->link, $this->id);
            $modificacion = SQLServer::instancia()->modificar($consulta, $datos);
            $this->mensaje = utf8_encode($this->nombre) . ": " . SQLServer::instancia()->getMensaje();
            if ($modificacion == 2) {
                $modificacion = $this->registrarActividad("MODIFICACION", $this->id);
            }
            return $modificacion;
        }
        $this->mensaje = "No se recibieron los campos obligatorios";
        return 0;
    }

    public function obtener() {
        if ($this->id) {
            $consulta = "SELECT * FROM permiso WHERE id = ?";
            $fila = SQLServer::instancia()->obtener($consulta, array($this->id));
            if (gettype($fila) == 'array') {
                $this->nombre = $fila['nombre'];
                $this->nivel = $fila['nivel'];
                $this->padre = $fila['padre'];
                $this->link = $fila['link'];
                return $this->obtenerPadre($fila['nivel'], $fila['padre']);
            }
            $this->mensaje = "No se obtuvo la información del permiso";
            return 1;
        }
        $this->mensaje = "No se pudo hacer referencia al permiso";
        return 0;
    }

    private function obtenerPadre($nivel, $idPadre) {
        if ($nivel > 1) {
            $padre = new Permiso($idPadre);
            $resultado = $padre->obtener();
            $this->padre = ($resultado == 2) ? $padre : NULL;
            $this->mensaje = ($resultado == 2) ? $this->mensaje : "No se pudo obtener el padre";
            return $resultado;
        }
        return 2;
    }

    private function registrarActividad($operacion, $id) {
        $creacion = Log::guardarActividad("permiso", $operacion, $id);
        $this->mensaje = ($creacion == 2) ? $this->mensaje : "No se pudo registrar actividad";
        return $creacion;
    }

}
