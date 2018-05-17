<?php
require_once '../vendor/autoload.php';
require_once '../config/generated-conf/config.php';
use User as user;

$user = new user();

$user->setNombre("Maria");
$user->setEdad(35);
$user->setSexo('F');
$user->setCorreo('maria_la@hotmail.com');
echo "Hola mundo ". $user->getNombre();
$user->save();
echo "Adios Hola mundo insertado". $user->getNombre();
echo $user->getCorreo();
echo $user->getNombre();
echo $user->getSexo();
echo $user->getEdad();




