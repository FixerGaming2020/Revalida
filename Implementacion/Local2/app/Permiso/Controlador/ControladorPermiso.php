<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ControladorPermiso {

    private $mensaje;

    public function getMensaje() {
        return $this->mensaje;
    }

    public function borrar($id) {
        if (SQLServer::instancia()->iniciarTransaccion()) {
            $permiso = new Permiso($id);
            $eliminacion = $permiso->borrar();
            $this->mensaje = $permiso->getMensaje();
            $confirmar = ($eliminacion == 2) ? TRUE : FALSE;
            SQLServer::instancia()->finalizarTransaccion($confirmar);
            return $eliminacion;
        }
        $this->mensaje = "No se pudo inicializar la transacción para operar";
        return 1;
    }
    
    public function modificar($id, $titulo, $nivel, $padre, $link) {
        if (SQLServer::instancia()->iniciarTransaccion()) {
            $permiso = new Permiso($id, $titulo, $nivel, $padre, $link);
            $edicion = $permiso->modificar();
            $this->mensaje = $permiso->getMensaje();
            $confirmar = ($edicion == 2) ? TRUE : FALSE;
            SQLServer::instancia()->finalizarTransaccion($confirmar);
            return $edicion;
        }
        $this->mensaje = "No se pudo inicializar la transacción para operar";
        return 1;
    }

}
