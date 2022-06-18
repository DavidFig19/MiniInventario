<?php
require_once 'modeloBase.php';
class venta extends modeloBase{
    //para el documento

    public $idCliente;
    public $RAZON;
    public $frc;
    public $subtotal;
    public $iva;
    public $total;
    //para el documento renglon
    public $idCodigo;
    public $datos;
    public $idMaterial;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the value of idCliente
     */ 
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * Set the value of idCliente
     *
     * @return  self
     */ 
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;

        return $this;
    }

    /**
     * Get the value of RAZON
     */ 
    public function getRAZON()
    {
        return $this->RAZON;
    }

    /**
     * Set the value of RAZON
     *
     * @return  self
     */ 
    public function setRAZON($RAZON)
    {
        $this->RAZON = $RAZON;

        return $this;
    }

    /**
     * Get the value of frc
     */ 
    public function getFrc()
    {
        return $this->frc;
    }

    /**
     * Set the value of frc
     *
     * @return  self
     */ 
    public function setFrc($frc)
    {
        $this->frc = $frc;

        return $this;
    }

    /**
     * Get the value of subtotal
     */ 
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set the value of subtotal
     *
     * @return  self
     */ 
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * Get the value of iva
     */ 
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set the value of iva
     *
     * @return  self
     */ 
    public function setIva($iva)
    {
        $this->iva = $iva;

        return $this;
    }

    /**
     * Get the value of total
     */ 
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     *
     * @return  self
     */ 
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    // para el documento
    /**
     * Get the value of idCodigo
     */ 
    public function getIdCodigo()
    {
        return $this->idCodigo;
    }

    /**
     * Set the value of idCodigo
     *
     * @return  self
     */ 
    public function setIdCodigo($idCodigo)
    {
        $this->idCodigo = $idCodigo;

        return $this;
    }

    /**
     * Get the value of datos
     */ 
    public function getDatos()
    {
        return $this->datos;
    }

    /**
     * Set the value of datos
     *
     * @return  self
     */ 
    public function setDatos($datos)
    {
        $this->datos = $datos;

        return $this;
    }

   /**
     * Get the value of idMaterial
     */ 
    public function getIdMaterial()
    {
        return $this->idMaterial;
    }

    /**
     * Set the value of idMaterial
     *
     * @return  self
     */ 
    public function setIdMaterial($idMaterial)
    {
        $this->idMaterial = $idMaterial;

        return $this;
    }
   
    // public function saveDoc(){
        
    //     $sql="START TRANSACTION; INSERT INTO documento (IDCLIENTE,RAZON_SOCIAL,RFC,SUBTOTAL,IVA,TOTAL) VALUES('{$this->getIdCliente()}','{$this->getRAZON()}','{$this->getFrc()}','{$this->getSubtotal()}','{$this->getIva()}','{$this->getTotal()}'); INSERT INTO documentorenglon (IDCODIGO,DATOS) VALUES (@IDCODIGO:= LAST_INSERT_ID(),'{$this->getDatos()}'); COMMIT;";
    //     $this->db->exec($sql);
    //     return $this->db->lastInsertId();
    // }

    public function saveDoc(){
        $sql="INSERT INTO documento (IDCLIENTE,RAZON_SOCIAL,RFC,SUBTOTAL,IVA,TOTAL) VALUES('{$this->getIdCliente()}','{$this->getRAZON()}','{$this->getFrc()}','{$this->getSubtotal()}','{$this->getIva()}','{$this->getTotal()}'); ";
        $this->db->exec($sql);
        $ultimoDoc=$this->db->lastInsertId();
        return $ultimoDoc;

    }
    public function saveDocRenglon(){
        $array=json_decode($this->getDatos(),true);
        foreach ($array  as $value) {
            $this->db->exec("INSERT INTO documentorenglon (IDCODIGO,IDMATERIAL,UNIDAD_MEDIDA,CANTIDAD,PRECIO1) VALUES(@IDCODIGO:= LAST_INSERT_ID(),'{$value['IDMATERIAL']}','{$value['UNIDADMEDIDA']}','{$value['CANTIDAD']}','{$value['PRECIO1']}'); ");

        }
        return $this->db->lastInsertId();

    }

    public function getSalesClient(){
        $query=$this->db->prepare("SELECT * FROM documento WHERE IDCLIENTE='{$this->getIdCliente()}'");
        $query->execute();
        return $query->fetchAll();
    }
    public function getSalesProduct(){
        $query=$this->db->prepare("SELECT documentorenglon.IDMATERIAL,productos.NOMBREMATERIAL,productos.DESCRIPCION,IDCODIGO,UNIDADMEDIDA,SUM(CANTIDAD) as total,documentorenglon.PRECIO1,SUM(CANTIDAD*documentorenglon.PRECIO1) as subtotal from documentorenglon  INNER JOIN productos ON productos.IDMATERIAL=documentorenglon.IDMATERIAL WHERE productos.IDMATERIAL='{$this->getIdMaterial()}'; ");
        $query->execute();
        return $query->fetchObject();
    }

    
}