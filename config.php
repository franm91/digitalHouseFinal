<?php
require_once('autoload.php');



$title = "Felicitrip - para el viajero que hay en vos";
$mainTitle = "Felicitrip";
$logo = "images/logo.png";



$nombre = "";
$apellido = "";
$email = "";
$paises = ["Argentina", "Brasil", "Bolivia", "Colombia", "Chile", "Peru"];
$userName = "";
$paisElegido = "";

$errors = [];
//****************************************************************
//******************IF $_POST RECIBE DATOS O NO*******************
//****************************************************************

if($_POST){
// var_dump($_POST);
// var_dump($_FILES);
   $errors = Validador::validarRegistro($_POST, $db);

   if (!isset($errores["errorNombre"])) {
      $nombre = $_POST["nombre"];
   }

   if (!isset($errores["errorApellido"])) {
      $apellido = $_POST["apellido"];
   }

   if (!isset($errores["errorEmail"])) {
      $email = $_POST["email"];
   }

   if (!isset($errores["errorPais"])) {
      $paisElegido = $_POST["paisUsuario"];
   }

   if (!isset($errores["errorUserName"])) {
      $userName = $_POST["userName"];
   }

   if (!isset($errores["errorImg"])) {
      $avatar = $_FILES["foto"];
   }


   if (count($errors) == 0) {
      $usuario = new Usuario($_POST["nombre"], $_POST["apellido"], $_POST["email"], $_POST["paisUsuario"], $_POST["userName"], $_POST["contrasena"]);



      //el metodo saveAvatar recibe un usuario y guarda el avatar y me devuelve el nombre del avatar en una variable
      $avatarName = $usuario->saveAvatar($usuario);

      //le asigno al nuevo usuario su avatar con el nombre correspondiente.
      $usuario->setAvatar($avatarName);

      //guardo en la base de datos el nuevo usuario
      $db->saveUser($usuario);

      header("Location:perfil.php?$email");exit;
   }
}













?>
