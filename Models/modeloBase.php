<?php
require_once './config/database.php';
require_once 'vendor/autoload.php';
class modeloBase
{
    public $db;
   

    public function __construct()
    {
        $this->db = database::conectar();
    }
    
    
    public function getAll($tabla, $dato)
    {

        
        $consulta = $this->db->prepare("SELECT COUNT(*) FROM $tabla");
        $consulta->execute();
        
        //contar el numero de rows
        $numero_elementos = $consulta->fetchColumn();
        //cuantos elementos quiero mostrar
        $numero_elemento_pagina=4;
        $pagination = new Zebra_Pagination();
        //numero total de elementos a paginar
        $pagination->records($numero_elementos);

        //numero de elementos por pagina
        $pagination->records_per_page($numero_elemento_pagina);
        $page=$pagination->get_page();

        $empieza_aqui=(($page - 1)*$numero_elemento_pagina);
        //prepara el select
        $query = $this->db->prepare("SELECT * FROM $tabla ORDER BY $dato ASC LIMIT $empieza_aqui,$numero_elemento_pagina");
        echo "<br>";
        $pagination->render();
        //ejecuta mi consulta
        $query->execute();
       
        // retornamos todos los datos
        return $query->fetchAll();
       
    }
}
