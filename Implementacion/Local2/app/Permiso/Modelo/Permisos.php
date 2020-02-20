<?php

class Permisos {

    private $mensaje;

    public function getMensaje() {
        return $this->mensaje;
    }

    public function listarMenu($idPerfil) {
        $consulta = "SELECT id, nombre FROM permiso PER INNER JOIN rol_permiso "
                . "REL ON REL.id_permiso = PER.id AND REL.id_rol = ? "
                . "WHERE PER.nivel = 1 ORDER BY nombre";
        $resultado = SQLServer::instancia()->seleccionar($consulta, array(&$idPerfil));
        $this->mensaje = SQLServer::instancia()->getMensaje();
        return $resultado;
    }

    public function listarSubMenu($idPerfil, $idPadre) {
        $consulta = "SELECT id, nombre, link FROM permiso PER INNER JOIN rol_permiso "
                . "REL ON REL.id_permiso = PER.id AND REL.id_rol = ? "
                . "WHERE PER.nivel = 2 AND padre = ? ORDER BY nombre";
        $resultado = SQLServer::instancia()->seleccionar($consulta, array(&$idPerfil, &$idPadre));
        $this->mensaje = SQLServer::instancia()->getMensaje();
        return $resultado;
    }

}
