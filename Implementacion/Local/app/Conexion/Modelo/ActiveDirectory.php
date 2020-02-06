
<?php

class ActiveDirectory
{
    private $conexion;
    private $host;
    private $puerto;
    private $dominio;
    private $mensaje;


    public function __construct( $host = NULL, $puerto = NULL, $dominio = NULL)
    {
        $this->host  = $host;
        $this->puerto  = $puerto;
        $this->dominio = $dominio;
    }

    public function getConexion()
    {
        return $this->conexion;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getPuerto()
    {
        return $this->puerto;
    }

    public function getDominio()
    {
        return $this->dominio;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function setConexion($conexion)
    {
        $this->conexion = $conexion;
    }
    
    public function setHost($host)
    {
        $this->host = $host;
    }

    public function setPuerto($puerto)
    {
        $this->puerto = $puerto;
    }

    public function setDominio($dominio)
    {
        $this->dominio = $dominio;
    }

    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    //LA FUNCION CONECTAR VA A HACER LA CONEXION CON LDAP  DONDE MANDA POR PARAMETRO EL HOST Y EL PUERTO 
    public function conectar()
    {
        $this->conexion = ldap_connect($this->host,$this->puerto);
        if($this->conexion){
            ldap_set_option($this->conexion, LDAP_OPT_PROTOCOL_VERSION, 3);
            return true;
        }
        $this->mensaje = "No se pudo establecer la conexion con LDAP(Verifique la configuracion)";
        Log::errorConexion("Error al establecer conexion con LDAP ( HOST: {$this->host}, PORT: {$this->puerto})");
    }


    public function buscar($usuario, $clave) {
        $user = $this->dominio . $usuario;
        if (@ldap_bind($this->conexion, $user, $clave)) {
            return true;
        }
        $this->mensaje = "Usuario no autenticado (verifique los datos)";
         Log::errorConexion("Usuario no autenticado en LDAP (USUARIO: {$user})");
        return false;
    }




}

?>