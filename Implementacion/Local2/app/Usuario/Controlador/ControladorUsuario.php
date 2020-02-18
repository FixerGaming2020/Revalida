<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ControladorUsuario {

    private $mensaje;

    public function getMensaje() {
        return $this->mensaje;
    }

    public function crear($legajo, $nombre, $perfil) {
        if (SQLServer::instancia()->iniciarTransaccion()) {
            $usuario = new Usuario($legajo, $nombre, NULL, $perfil);
            $creacion = $usuario->crear();
            $this->mensaje = $usuario->getMensaje();
            $confirmar = ($creacion == 2) ? TRUE : FALSE;
            SQLServer::instancia()->finalizarTransaccion($confirmar);
            return $creacion;
        }
        $this->mensaje = "No se pudo inicializar la transacción para operar";
        return 1;
    }


    public function modificar($legajoOriginal, $legajo, $nombre, $perfil) {
        if (SQLServer::instancia()->iniciarTransaccion()) {
            $usuario = new Usuario($legajo, $nombre, NULL, $perfil);
            $modificacion = $usuario->modificar($legajoOriginal);
            $this->mensaje = $usuario->getMensaje();
            $confirmar = ($modificacion == 2) ? TRUE : FALSE;
            SQLServer::instancia()->finalizarTransaccion($confirmar);
            return $modificacion;
        }
        $this->mensaje = "No se pudo inicializar la transacción para operar";
        return 1;
    }

}
