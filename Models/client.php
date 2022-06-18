<?php
require_once 'modeloBase.php';

class client extends modeloBase{

    public $id;
    public $razon;
    public $rfc;
    

    public function __construct()
    {
        parent::__construct();
    }






    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of razon
     */ 
    public function getRazon()
    {
        return $this->razon;
    }

    /**
     * Set the value of razon
     *
     * @return  self
     */ 
    public function setRazon($razon)
    {
        $this->razon = $razon;

        return $this;
    }

    /**
     * Get the value of rfc
     */ 
    public function getRfc()
    {
        return $this->rfc;
    }

    /**
     * Set the value of rfc
     *
     * @return  self
     */ 
    public function setRfc($rfc)
    {
        $this->rfc = $rfc;

        return $this;
    }


    /* agregar  */
    public function save(){

        // exec ejecuta una instrucción SQL en una sola llamada de función 
        // y devuelve el número de filas afectadas por la instrucción.
       $sql="INSERT INTO clientes (RAZON_SOCIAL,RFC) values('{$this->getRazon()}','{$this->getRfc()}')";
       $this->db->exec($sql);
       return $this->db->lastInsertId();
    }

    // eliminar

    public function delete(){

        //execute devuelte true o false
        $query=$this->db->prepare("DELETE FROM clientes WHERE IDCLIENTE='{$this->getId()}';");
        $resultado=$query->execute();
        return $resultado;

    }

    public function getOne(){

        $query=$this->db->prepare("SELECT * FROM clientes WHERE IDCLIENTE='{$this->getId()}';");
       $query->execute();
       //devolvemos objeto por que solo trae uno
        return $query->fetchObject();
        
    }

    public function search(){

        $query=$this->db->prepare("SELECT * FROM clientes WHERE RAZON_SOCIAL LIKE '{$this->getRazon()}%';");
        $query->execute();
        return $query->fetchAll();
        
    }

    public function update(){
        $sql="UPDATE clientes SET RAZON_SOCIAL='{$this->getRazon()}',RFC='{$this->getRfc()}' WHERE IDCLIENTE='{$this->getId()}';";
        $this->db->exec($sql);
        return $this->db->lastInsertId();
    }
}