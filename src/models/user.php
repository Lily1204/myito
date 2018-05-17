<?php

namespace Myito\Models;

class User
{
    private $nombre;
    private $edad;
    private $sexo;
    private $correo;

    public function __construct(){
        $this->nombre="";
        $this->edad= "";
        $this->sexo= "";
        $this->correo= "";
    }
    /**
     * Set the value of user's name
     * 
     * @return string Name of a user 
     */
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * 
     */
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function getEdad(){
        return $this->edad;
    }

    public function setEdad($edad){
        $this->edad=$edad;
    }

    public function getSexo(){
        return $this->sexo;
    }

    public function setSexo($sexo){
        $this->sexo=$sexo;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function setCorreo($correo){
        $this->correo=$correo;
    }
}
