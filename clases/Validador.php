<?php

class Validador{

   public static function validarRegistro($post, MySql $db){

      //Si el validador encuentra algun error lo mete en el array $errors.
       $errors = [];

      //****************************************************************
      //******************IF $_POST RECIBE DATOS O NO*******************
      //****************************************************************

      if($_POST){
         //****************CONFIGURACION DE VARIABLES***********
         $nombre = trim($_POST['nombre']);
         $apellido = trim($_POST['apellido']);
         $email = trim($_POST['email']);
         $userName = trim($_POST['userName']);
         $contrasena = trim($_POST['contrasena']);
         $checkcontrasena = trim($_POST['checkContrasena']);
         $paisElegido = $_POST['paisUsuario'];

         //****************ERRORES Nombre***********************
      if(empty($nombre)){
            $errors["errorNombre"] = "El nombre es obligatiorio.<br>";
         }else if (!((strlen($nombre) >= $min = 3) & (strlen($nombre) <= $max = 15))) {
            $errors["errorNombre"] = "El nombre debe tener entre " . $min . " y " . $max . " caracteres.";
         }else if (!ctype_alpha($nombre)){
            $errors["errorNombre"] = "El nombre solo puede contener letras";
         }

      //****************ERRORES Apellido***********************
      if(empty($apellido)){
            $errors["errorApellido"] = "El apellido es obligatiorio.<br>";
         }else if (!((strlen($apellido) > $min = 1) & (strlen($apellido) <= $max = 30))) {
            $errors["errorApellido"] = "El nombre debe tener entre " . $min . " y " . $max . " caracteres.";
         }else if (!ctype_alpha($apellido)){
            $errors["errorApellido"] = "El apellido solo puede contener letras";
         }

      //****************ERRORES Email************************
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
         $errors["errorEmail"] = "Ingresa un email valido.";
      }else if ($db->getUserByEmail($email) !== NULL) {
         $errors["errorEmail"] = "El email ya existe.";
      }


      //****************ERRORES PAIS********************
      if($_POST['paisUsuario'] == "0"){
         $errors["errorPais"] = "Selecciona un País";
         }

      //****************ERRORES UserName************************
      if(empty($userName)){
            $errors["errorUserName"] = "El nombre de usuario es obligatorio.";
         }else if (!((strlen($userName) >= $min = 4) & (strlen($userName) <= $max = 25))) {
            $errors["errorUserName"] = "El nombre debe tener entre " . $min . " y " . $max . " caracteres.";
         }else if(is_numeric(substr($userName, 0, 1))){
            $errors["errorUserName"] = "El nombre de usuario no puede comenzar con un número.";
         }else if ($db->getUserByUserName($userName) !== NULL){
            $errors["errorUserName"] = "El nombre de usuario ya existe.";
         }

      //****************ERRORES Contrasena********************
      if(empty($contrasena) || strlen($contrasena) < 6){
         $errors["errorContrasena"] = "La contraseña debe tener 6 caracteres minimo.";
         }

      //****************ERRORES checkContrasena********************
      if($checkcontrasena !== $contrasena){
         $errors["errorCheckContrasena"] = "Las contraseñas no coinciden.";
         }

      if(count($errors) == 0){
         //var_dump($_FILES['foto']); exit;
         if($_FILES['foto']['error'] == UPLOAD_ERR_OK){
            $ext = pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION);
            if($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png'){
               $errors["errorImg"] = "Formato no valido";
               }
            }
         }
      return $errors;
      }
   }


   public static function validarLogIn($post, MySql $db){
      $errors = [];

      if($_POST){
         //****************CONFIGURACION DE VARIABLES***********
         $email = trim($_POST['email']);
         $contrasena = trim($_POST['contrasena']);

         //var_dump(!filter_var($email, FILTER_VALIDATE_EMAIL));exit;

         if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors["errorEmail"] = "Ingresa un email valido.";
         } else if ($db->getUserByEmail($email) == "") {
            $errors["errorEmail"] = "El email no existe.";
         }

         $usuario = $db->getUserByEmail($email);

         if ($usuario !== NULL) {
            if (!password_verify($contrasena, $usuario->getPassword())) {
               $errors["errorContrasena"] = "La contraseña no es correcta";
            }
         }
      }
      return $errors;
   }
}
