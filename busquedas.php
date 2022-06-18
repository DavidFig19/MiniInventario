<?php
require_once 'config/database.php';
require_once 'Models/client.php';
require_once 'Models/produc.php';
require_once 'Models//venta.php';
require_once('vendor/autoload.php');

// $_SERVER['REQUEST_METHOD'] == 'POST'
if (isset($_POST['razonSocial'])) {

    $cliente = new client();
    $cliente->setRazon($_POST['razonSocial']);
    $datos = $cliente->search();
    $json = json_encode($datos, JSON_UNESCAPED_UNICODE);
    echo $json;
}

//para materiales
if (isset($_POST['materialSearch'])) {

    $material = new product();
    $material->setNombre($_POST['materialSearch']);
    $datos = $material->search();
    $json = json_encode($datos, JSON_UNESCAPED_UNICODE);
    echo $json;
}


// if (isset($_POST['idcliente'])) {
//     $doc=new venta();
//     $doc->setIdCliente($_POST['idcliente']);
//     $doc->setRAZON($_POST['razonsocial']);
//     $doc->setFrc($_POST['rfcCliente']);
//     $doc->setSubtotal($_POST['subtotal']);
//     $doc->setIva($_POST['iva']);
//     $doc->setTotal($_POST['total']);
//     $doc->saveDoc();
//     header("location:" . base_url . 'cliente/search/');

//     // for ($i = 0; $i < $_POST['contador']; $i++) {
        
//     // }
    

// }
