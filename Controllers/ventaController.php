<?php

class ventaController{

    //para vender por cliente
    public function add(){
        require_once './Models/client.php';
        if (isset($_GET['id'])) {
            $cliente=new client();
            $cliente->setId($_GET['id']);
            $datos=$cliente->getOne();
            require_once './Views/ventas/index.php';
        }

        //si esta vaio no dejar pasar
        if($_GET['id']==''){
            header("location:" . base_url . 'cliente/search/');
        }
    }

  
    public function save(){
        require_once './Models/venta.php';
        if (isset($_POST['idcliente'])) {
            
            $doc=new venta();
            $doc->setIdCliente($_POST['idcliente']);
            $doc->setRAZON($_POST['razonsocial']);
            $doc->setFrc($_POST['rfcCliente']);
            $doc->setSubtotal($_POST['subtotal']);
            $doc->setIva($_POST['iva']);
            $doc->setTotal($_POST['total']);
           
           
             
            
           
           //como los nombres de las propiedadas
           //vienen en nombre-nunmero
           //hacemos un for para que automaticamente tome su valor
            for ($i = 0; $i < $_POST['contador']; $i++) {
                $objeto[$i]= new stdClass();
                $objeto[$i]->IDMATERIAL=$_POST['idMaterial-'.$i];
                $objeto[$i]->UNIDADMEDIDA=$_POST['unidadMaterial-'.$i];
                $objeto[$i]->CANTIDAD=$_POST['cantidadMaterial-'.$i];
                $objeto[$i]->PRECIO1=$_POST['precioMaterial-'.$i];
            }
            $doc->setDatos(json_encode($objeto));
            $doc->saveDoc();
            $doc->saveDocRenglon();
           
      
        }
        header("location:" . base_url . 'cliente/search/');
        
    }

    public function ventasCliente(){
        require_once './Models/venta.php';
        if(isset($_GET['id'])){
            $client=new venta();
            $client->setIdCliente($_GET['id']);
            $datos=$client->getSalesClient();
        }
        require_once './Views/ventas/ventasCliente.php';
    }

    public function ventasProduct(){
        require_once './Models/venta.php';
        if($_GET['id']==''){
            header("location:" . base_url . 'cliente/search/');
        }
        if(isset($_GET['id'])){
            $material=new venta();
            $material->setIdMaterial($_GET['id']);
            $datos=$material->getSalesProduct();
        }
        require_once './Views/ventas/ventasMaterial.php';

    }
   
    
    
}