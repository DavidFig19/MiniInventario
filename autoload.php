<?php

function autocargar($classname){
    include './Controllers/' . $classname . '.php';
}

spl_autoload_register('autocargar');