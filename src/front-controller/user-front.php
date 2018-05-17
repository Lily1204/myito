<?php

require_once './../../vendor/autoload.php';
require_once './../../config/generated-conf/config.php';
use Myito\Controllers\UserCtrl;
use Myito\Models\User;

$statusCreated= false;
$userCtrl = null;
$user2= null;

if(isset($_POST['correo'],$_POST['nombre'],$_POST['edad'], $_POST['sexo'])){
    // Guardar
    $user2 = new User();
    $user2->setCorreo($_POST['correo']);
    $user2->setNombre($_POST['nombre']);
    $user2->setSexo($_POST['sexo']);
    $user2->setEdad($_POST['edad']);
    $userCtrl = new UserCtrl();

    $statusCreated= $userCtrl->createUser(UserCtrl::parseToUserEntity($user2));
}else{
    // Error no se pudo guardar;
    $errorMessage= "Error en la conexion";
    echo $errorMessage;
}

if($statusCreated){
    echo "Usuario creado:". $user2->getNombre();
}

