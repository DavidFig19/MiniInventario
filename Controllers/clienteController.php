<?php

class clienteController
{

    public function search()
    {
       
      
        require_once './Views/cliente/search.php';
        
    }
    
    
   
    public function add()
    {
        $accion = new stdClass();
            $accion->tipo="Guardar";
            $accion->icono='<i class="fa-solid fa-floppy-disk"></i>';
            $accion->clase="btn-primary";
        require_once './Views/cliente/add.php';
    }

    public function getOne(){
        require_once './Models/client.php';
        if(isset($_GET['id'])){
            $cliente= new client();
            $cliente->setId($_GET['id']);
            $datos=$cliente->getOne();

            //creamos ub objeto para validar si es actualizacion
            $accion = new stdClass();
            $accion->tipo="Actualizar";
            $accion->icono='<i class="fa-solid fa-arrows-rotate"></i>';
            $accion->clase="btn-success";
        
            require_once './Views/cliente/add.php';
        }

    }

    public function save()
    {
        require_once './Models/client.php';
      
        if (isset($_POST)) {
            $razonSocial = (isset($_POST['razon'])) ? $_POST['razon'] : null;
            $rfc = (isset($_POST['rfc'])) ? $_POST['rfc'] : null;
            if ($razonSocial && $rfc) {
                $cliente = new  client();
                $cliente->setRazon($razonSocial);
                $cliente->setRfc(strtoupper($rfc));
                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    $cliente->setId($id);
                    $cliente->update();
                }

                //si no viene nada en el id guarda
                if($_GET['id']==''){
                    $cliente->save();
                }
              
            }
        }
        header("location:" . base_url . 'cliente/search/');
    }
    public function delete()
    {
        require_once './Models/client.php';
        $cliente = new  client();
        if (isset($_GET['id'])) {
            $cliente->setId($_GET['id']);
            $cliente->delete();
        }
    }
}
