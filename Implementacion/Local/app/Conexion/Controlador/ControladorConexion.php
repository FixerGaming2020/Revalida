<?php


class ControladorConexion
{
    /**
     * Realiza la verificacion del usuario consultando sus datos en el servidor
     * de Active Directory y en la base de datos del sistema. Se deniega el acceso
     * cuando en alguno de estos puntos no coincide la informacion con la dada.
     * @param string $legajo Legajo del usuario.
     * @param string $clave Clave personal del usuario.
     * @return boolean True para acceder, false en caso contrario.
     */
    public function verificarUsuarioSistema($legajo, $clave) {
        $autorizadoAD = $this->verificarActiveDirectory($legajo, $clave);
        if ($autorizadoAD) {
            $usuario = new Usuario();
            $usuario->setId($legajo);
            $resultado = $usuario->obtener();
            if ($resultado == 2) {
                $_SESSION['usuario'] = $usuario;
                return true;
            }
            $this->mensaje = "Usuario no autorizado por Revalida";
            return false;
        }
        return $autorizadoAD;
    }

    /**
     * Verifica el usuario en active directory segun su legajo y clave. El acceso
     * se deniega si no se puede establecer la conexion con el servidor a partir de
     * los datos definidos en CONSTANTES o porque no se encontro el usuario.
     * @param string $legajo Numero de legajo del usuario.
     * @param string $clave Clave personal del usuario.
     * @return boolean True para acceder, false en caso contrario.
     */
    private function verificarActiveDirectory($legajo, $clave) {
        $ad = new ActiveDirectory(HOST_LDAP, PORT_LDAP, DOMINIO_LDAP);
        if ($ad->conectar()) {
            if ($ad->buscar($legajo, $clave)) {
                return true;
            }
            $this->mensaje = "Usuario no autorizado por Active Directory";
            Log::errorConexion("Usuario No autorizado por Active Directory");
            return false;
        }
        $this->mensaje = "Sin conexión a Active Directory";
        Log::errorConexion("Sin Conexion a Active Directory");
        return false;
    }


   
    


}




?>