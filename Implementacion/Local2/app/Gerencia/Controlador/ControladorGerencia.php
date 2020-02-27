<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ControladorGerencia {

    private $mensaje;

    /**
     * Retorna el mensaje asociado a la ultima operacion realizada.
     * @return string Mensaje de la operacion realizada.
     */
    public function getMensaje() {
        return $this->mensaje;
    }

    /**
     * Devuelve el resultado de la busqueda de gerencias a taves del nombre.
     * @param string $nombre Nombre (o parte del nombre) a buscar.
     * @return resource Retorna el recurso, 0 para error, 1 cuando no hay resultados.
     */
    public function buscar($nombre) {
        $resultado = Gerencias::buscar($nombre);
        $this->mensaje = Gerencias::getMensaje();
        return $resultado;
    }

    /**
     * Realiza la creacion de la gerencia en la base de datos. Se requiere del nombre,
     * delegado, subdelegado y estado para llevar a cabo la operacion.
     * @param string $nombre Nombre del estado.
     * @param string $descripcion Descripcion del estado.
     * @return integer 0 cuando faltan datos o falla, 1 cuando no se creo o 2 para exito.
     */
    public function crear($nombre, $delegado, $subDelegado) {
        if (SQLServer::instancia()->iniciarTransaccion()) {
            $gerencia = new Gerencia(NULL, $nombre, $delegado, $subDelegado);
            $creacion = $gerencia->crear();
            $this->mensaje = $gerencia->getMensaje();
            $confirmar = ($creacion == 2) ? TRUE : FALSE;
            SQLServer::instancia()->finalizarTransaccion($confirmar);
            return $creacion;
        }
        $this->mensaje = "No se pudo inicializar la transacción para operar";
        return 1;
    }

    /**
     * Devuelve un listado de todos las gerencias ordenadas por nombre.
     * @return resource Retorna el recurso, 0 para error, 1 cuando no hay resultados.
     */
    public function listar() {
        $resultado = Gerencias::listar();
        $this->mensaje = Gerencias::getMensaje();
        return $resultado;
    }

    /**
     * Realiza la modificacion de la gerencia en la base de datos. Se puede modificar
     * el nombre, delegado, subdelegado y estado de una gerencia referenciado a partir del id.
     * @param integer $id Identificador del estado.
     * @param string $nombre Nombre del estado.
     * @param integer $delegado Id del usuario delegado.
     * @param integer $subDelegado Id del usuario sub-delegado
     * @param integer $estado Estado de la gerencia.
     * @return integer 0 cuando faltan datos o falla, 1 cuando no se modifico o 2 para exito.
     */
    public function modificar($id, $nombre, $delegado, $subDelegado, $estado) {
        if (SQLServer::instancia()->iniciarTransaccion()) {
            $gerencia = new Gerencia($id, $nombre, $delegado, $subDelegado, $estado);
            $creacion = $gerencia->modificar();
            $this->mensaje = $gerencia->getMensaje();
            $confirmar = ($creacion == 2) ? TRUE : FALSE;
            SQLServer::instancia()->finalizarTransaccion($confirmar);
            return $creacion;
        }
        $this->mensaje = "No se pudo inicializar la transacción para operar";
        return 1;
    }

}
