<?php

class Rol {

    private $id;
    private $nombre;
    private $permisos;
    private $mensaje;

    public function __construct($id = null, $nombre = null, $permisos = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->permisos = $permisos;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getMensaje() {
        return $this->mensaje;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getPermisos() {
        return $this->permisos;
    }

    public function setPermiso($permisos) {
        $this->permisos = $permisos;
    }

    public function crear() {
        if ($this->nombre && $this->permisos) {
            $consulta = "INSERT INTO rol OUTPUT INSERTED.id VALUES (?, ?)";
            $datos = array(&$this->nombre);
            $creacion = SQLServer::instancia()->insertar($consulta, $datos);
            $this->mensaje = utf8_encode($this->nombre) . ": " . SQLServer::instancia()->getMensaje();
            if ($creacion == 2) {
                $this->id = SQLServer::instancia()->getUltimoId();
                $creaRelacion = PerfilPermiso::crear($this->id, $this->permisos);
                $this->mensaje = ($creaRelacion == 2) ? $this->mensaje : PerfilPermiso::getMensaje();
                return $creaRelacion;
            }
            return $creacion;
        }
        $this->mensaje = "No se recibieron los campos obligatorios";
        return 0;
    }

    public function modificar() {
        if ($this->id && $this->nombre && $this->permisos) {
            $consulta = "UPDATE rol SET nombre = ? WHERE id = ?";
            $datos = array(&$this->nombre, &$this->id);
            $modificacion = SQLServer::instancia()->modificar($consulta, $datos);
            $this->mensaje = utf8_encode($this->nombre) . ": " . SQLServer::instancia()->getMensaje();
            if ($modificacion == 2) {
                $sborrar = PerfilPermiso::borrar($this->id);
                $this->mensaje = ($sborrar == 2) ? $this->mensaje : "Permisos: " . RolPermiso::getMensaje();
                $screar = PerfilPermiso::crear($this->id, $this->permisos);
                $this->mensaje = ($screar == 2) ? $this->mensaje : "Permisos: " . RolPermiso::getMensaje();
                return ($sborrar == 2 && $screar == 2) ? 2 : 1;
            }
            return $modificacion;
        }
        $this->mensaje = "No se recibieron los campos obligatorios";
        return 0;
    }

    public function obtener() {
        if ($this->id) {
            $consulta = "SELECT * FROM rol WHERE id = ?";
            $fila = SQLServer::instancia()->obtener($consulta, array(&$this->id));
            if (gettype($fila) == "array") {
                $this->nombre = $fila['nombre'];
                $this->permisos = $this->obtenerPermisos();
                return 2;
            }
            $this->mensaje = "No se obtuvo la información del perfil";
            return 1;
        }
        $this->mensaje = "No se pudo hacer referencia al perfil";
        return 0;
    }

    private function obtenerPermisos() {
        $permisos = new Permisos();
        $resultado = $permisos->listarMenu($this->id);
        $arregloMenu = array();
        if (gettype($resultado) == "resource") {
            while ($menu = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
                $resultadoSM = $permisos->listarSubMenu($this->id, $menu['id']);
                $arregloSubmenu = array();
                if (gettype($resultadoSM) == 'resource') {
                    while ($submenu = sqlsrv_fetch_array($resultadoSM, SQLSRV_FETCH_ASSOC)) {
                        $arregloSubmenu[] = array($submenu['id'], $submenu['titulo'], $submenu['link']);
                    }
                    $arregloMenu[] = array($menu['id'], $menu['titulo'], $arregloSubmenu);
                }
            }
        }
        return $arregloMenu;
    }

}
