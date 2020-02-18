<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ControladorRol {

    private $mensaje;

    public function getMensaje() {
        return $this->mensaje;
    }

    public function crear($nombre, $descripcion, $permisos) {
        if (SQLServer::instancia()->iniciarTransaccion()) {
            $perfil = new Perfil(NULL, $nombre, $descripcion, NULL, $permisos);
            $creacion = $perfil->crear();
            $this->mensaje = $perfil->getMensaje();
            $confirmar = ($creacion == 2) ? TRUE : FALSE;
            SQLServer::instancia()->finalizarTransaccion($confirmar);
            return $creacion;
        }
        $this->mensaje = "No se pudo inicializar la transacción para operar";
        return 1;
    }

    public function modificar($id, $nombre, $descripcion, $permisos) {
        if (SQLServer::instancia()->iniciarTransaccion()) {
            $perfil = new Perfil($id, $nombre, $descripcion, NULL, $permisos);
            $modificacion = $perfil->modificar();
            $this->mensaje = $perfil->getMensaje();
            $confirmar = ($modificacion == 2) ? TRUE : FALSE;
            SQLServer::instancia()->finalizarTransaccion($confirmar);
            return $modificacion;
        }
        $this->mensaje = "No se pudo inicializar la transacción para operar";
        return 1;
    }

}
