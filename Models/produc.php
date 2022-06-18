<?php
require_once 'modeloBase.php';

class product extends modeloBase
{

    public $id;
    public $nombre;
    public $desc;
    public $unidad;
    public $precio;


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
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of desc
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * Set the value of desc
     *
     * @return  self
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;

        return $this;
    }

    /**
     * Get the value of unidad
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * Set the value of unidad
     *
     * @return  self
     */
    public function setUnidad($unidad)
    {
        $this->unidad = $unidad;

        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    //funcion para guardar
    public function save()
    {
        $sql = "INSERT INTO productos (IDMATERIAL,NOMBREMATERIAl,DESCRIPCION,UNIDADMEDIDA,PRECIO1) VALUES (UUID_SHORT(),'{$this->nombre}','{$this->desc}', '{$this->unidad}','{$this->precio}') ";
        $this->db->exec($sql);
        return $this->db->lastInsertId();
    }
    public function delete()
    {
        //prepara el select
        $query = $this->db->prepare("DELETE FROM productos WHERE IDMATERIAL='{$this->id}'");
        //ejecuta mi consulta
        $query->execute();
        return true;
    }
    public function getOneData(){

        $query=$this->db->prepare("SELECT * FROM productos WHERE IDMATERIAL='{$this->getID()}' ");
        $query->execute();
        return $query->fetchObject();

    }

    public function update(){
        $sql="UPDATE productos SET NOMBREMATERIAl='{$this->getNombre()}',DESCRIPCION='{$this->getDesc()}',UNIDADMEDIDA='{$this->getUnidad()}',PRECIO1='{$this->getPrecio()}' WHERE IDMATERIAL='{$this->getId()}'";
       $this->db->exec($sql);
        return $this->db->lastInsertId();

    }
    //para la busqueda
    public function search(){

        $query=$this->db->prepare("SELECT * FROM productos WHERE NOMBREMATERIAl LIKE '{$this->getNombre()}%';");
        $query->execute();
        return $query->fetchAll();
        
    }
}
