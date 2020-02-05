<?php

class Usuario
{
    private $id;
    private $nombre;
    private $apellido;
    private $legajo;
    private $contraseña;
    private $cargo;
    private $gerencia;
    private $firma;
    private $rol;
    private $estado;


    
    public function __construct($id =null, $nombre = null, $apellido = null, $legajo =null, $contraseña=null,$cargo=null,$gerencia=null
    ,$firma=null, $rol=null,$estado=null )
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido=$apellido;
        $this->legajo = $legajo;
        $this->contraseña =$contraseña;
        $this->cargo = $cargo;
        $this->gerencia = $gerencia;
        $this->firma = $firma;
        $this->rol  =$rol;
        $this->estado = $estado;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    
    public function getApellido()
    {
        return $this->apellido;
    }
    
    public function getLegajo()
    {
        return $this->legajo;
    }

    public function getContraseña()
    {
        return $this->contraseña;
    }

    public function getCargo()
    {
        return $this->cargo;
    }
    
    public function getGerencia()
    {
        return $this->gerencia;
    }
    
    public function getFirma()
    {
        return $this->firma;
    }
    
    public function getRol()
    {
        return $this->rol;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function setLegajo($legajo)
    {
        $this->legajo = $legajo;
    }

    public function setContraseña($contraseña)
    {
        $this->contraseña = $contraseña;
    }

    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }

    public function setGerencia($gerencia)
    {
        $this->gerencia = $gerencia;
    }

    public function setFirma($firma)
    {
        $this->firma = $firma;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }


    public function obtener(){
        if($this->id){
            $consulta = "SELECT * FROM usuario WHERE id = ?";
            $fila = SQLServer:: instancia()->obtener($consulta, array($this->id));
            if(gettype($fila) == "array"){
                $this->nombre = $fila['']
            }


        }
    }

}


?>