
<?php

class ActiveDirectory
{
    private $conexion;
    private $host;
    private $puerto;
    private $dominio;
    private $mensaje;






    public function __construct($conexion= null, $host = null, $puerto = null, $dominio = null, $mensaje = null)
    {
        $this->conexion = $conexion;
        $this->host  = $host;
        $this->puerto  = $puerto;
        $this->dominio = $dominio;
        $this->mensaje = $mensaje;
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


    public function conectar()
    {
        $this->conexion = ldap_connect($this->host,$this->puerto);
        if($this->conexion){
            ldap_set_option($this->conexion, LDAP_OPT_PROTOCOL_VERSION, 3);
            return true;
        }

        $this->mensaje = "No se pudo establecer la conexion con LDAP(Verifique la configuracion)";
        Log::escribirError("Error al establecer conexion con LDAP ( HOST: {$this->host}, PORT: {$this->puerto})");
    }








}

?>