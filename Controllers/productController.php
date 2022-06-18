<?php

class productController
{

    public function index()
    {
        require_once './Models/produc.php';
        $producto = new product();
        $productos = $producto->getAll('productos', 'IDMATERIAL');

        require_once 'Views/index.php';
    }

    public function add()
    {
        //declaramos un objeto y lo llenamos
        $accion = new stdClass();
        $accion->tipo = "Agregar";
        $accion->clase = "btn-primary";
        $accion->icono = '<i class="fa-solid fa-floppy-disk"></i>';


        require_once './Views/producto/add.php';
    }


    public function save()
    {
        require_once './Models/produc.php';
        if (isset($_POST)) {
            $nombreMaterial = (isset($_POST['nombreProduct'])) ? $_POST['nombreProduct'] : '';
            $descMaterial = (isset($_POST['descProduct'])) ? $_POST['descProduct'] : '';
            $medidaMaterial = (isset($_POST['medidaProduct'])) ? $_POST['medidaProduct'] : '';
            $precioMaterial = (isset($_POST['precioProduct'])) ? $_POST['precioProduct'] : '';
            if ($nombreMaterial && $descMaterial && $medidaMaterial && $precioMaterial) {
                $product = new product();
                $product->setNombre($nombreMaterial);
                $product->setDesc($descMaterial);
                $product->setUnidad($medidaMaterial);
                $product->setPrecio($precioMaterial);


                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $product->setId($id);
                    $product->update();
                }
                //si no viene nada en la url guarda
                if ($_GET['id'] == "") {
                  
                   
                   $product->save();
                   
                   
                }
              
               
            }
        }
         header("location:" . base_url . 'index.php');
    }

    public function delete()
    {
        require_once './Models/produc.php';
        if (isset($_GET['id'])) {
            $producto = new product();
            $producto->setId($_GET['id']);
            $producto->delete();
            header("location:" . base_url . 'index.php');
        }
    }


    public function getOne()
    {
        require_once './Models/produc.php';
        //si no hay id mandar al index
        if ($_GET['id'] == "") {
            header("location:" . base_url . 'index.php');
        }
        if (isset($_GET['id'])) {
            $producto = new product();
            $producto->setId($_GET['id']);
            $datos = $producto->getOneData();
            //declaramos un objeto y lo llenamos
            $accion = new stdClass();
            $accion->tipo = "Editar";
            $accion->clase = "btn-success";
            $accion->icono = '<i class="fa-solid fa-arrows-rotate"></i>';
            // require_once 'Views/producto/'.$_GET['id'].'/add.php';
            require_once './Views/producto/add.php';
        }
    }
}
