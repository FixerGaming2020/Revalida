<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ControladorEstado {

    private $mensaje;

    /**
     * Retorna el mensaje asociado a la ultima operacion realizada.
     * @return string Mensaje de la operacion realizada.
     */
    public function getMensaje() {
        return $this->mensaje;
    }

    /**
     * Devuelve el resultado de la busqueda de estados a taves del nombre.
     * @param string $nombre Nombre (o parte del nombre) a buscar.
     * @return resource Retorna el recurso, 0 para error, 1 cuando no hay resultados.
     */
    public function buscar($nombre) {
        $resultado = Estados::buscar($nombre);
        $this->mensaje = Estados::getMensaje();
        return $resultado;
    }

    /**
     * Realiza la eliminacion del estado en la base de datos. Se realiza el commit de
     * la operacion si no hay fallas.
     * @param integer $id Identificador del estado.
     * @return integer 0 cuando faltan datos o falla, 1 cuando no se elimino o 2 para exito.
     */
    public function borrar($id) {
        if (SQLServer::instancia()->iniciarTransaccion()) {
            $estado = new Estado($id);
            $eliminacion = $estado->borrar();
            $this->mensaje = $estado->getMensaje();
            $confirmar = ($eliminacion == 2) ? TRUE : FALSE;
            SQLServer::instancia()->finalizarTransaccion($confirmar);
            return $eliminacion;
        }
        $this->mensaje = "No se pudo inicializar la transacción para operar";
        return 1;
    }

    /**
     * Realiza la creacion del estado en la base de datos. Se requiere del nombre
     * y descripcion para llevar a cabo la operacion.
     * @param string $nombre Nombre del estado.
     * @param string $descripcion Descripcion del estado.
     * @return integer 0 cuando faltan datos o falla, 1 cuando no se creo o 2 para exito.
     */
    public function crear($nombre, $descripcion) {
        if (SQLServer::instancia()->iniciarTransaccion()) {
            $estado = new Estado(NULL, $nombre, $descripcion);
            $creacion = $estado->crear();
            $this->mensaje = $estado->getMensaje();
            $confirmar = ($creacion == 2) ? TRUE : FALSE;
            SQLServer::instancia()->finalizarTransaccion($confirmar);
            return $creacion;
        }
        $this->mensaje = "No se pudo inicializar la transacción para operar";
        return 1;
    }

    /**
     * Devuelve un listado de todos los estados ordenados por nombre.
     * @return resource Retorna el recurso, 0 para error, 1 cuando no hay resultados.
     */
    public function listar() {
        $resultado = Estados::listar();
        $this->mensaje = Estados::getMensaje();
        return $resultado;
    }

    /**
     * Realiza la modificacion del estado en la base de datos. Se puede modificar
     * el nombre y/o descripcion de un estado referenciado a partir del id.
     * @param integer $id Identificador del estado.
     * @param string $nombre Nombre del estado.
     * @param string $descripcion Descripcion del estado.
     * @return integer 0 cuando faltan datos o falla, 1 cuando no se modifico o 2 para exito.
     */
    public function modificar($id, $nombre, $descripcion) {
        if (SQLServer::instancia()->iniciarTransaccion()) {
            $estado = new Estado($id, $nombre, $descripcion);
            $creacion = $estado->modificar();
            $this->mensaje = $estado->getMensaje();
            $confirmar = ($creacion == 2) ? TRUE : FALSE;
            SQLServer::instancia()->finalizarTransaccion($confirmar);
            return $creacion;
        }
        $this->mensaje = "No se pudo inicializar la transacción para operar";
        return 1;
    }

}
