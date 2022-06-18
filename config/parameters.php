<?php

$host= $_SERVER["HTTP_HOST"];

$url= '/prueba-tecnica/';

define("base_url", "http://".$host.$url);
define("controller_default", "productController");
define("action_default", "index");
