<?php

$title = "Felicitrip - para el viajero que hay en vos";
$mainTitle = "Felicitrip";
$logo = "images/logo.png";

//****************ASIGNACION DE VARIABES ANTES DE $_POST********************
$errorNombre = "";
$errorApellido = "";
$errorEmail = "";
$errorPais = "";
$errorUserName = "";
$errorImg = "";
$errorContrasena = "";
$errorCheckContrasena = "";


$nombre = "";
$apellido = "";
$email = "";
$paises = ["Argentina", "Brasil", "Bolivia", "Colombia", "Chile", "Peru"];
$userName = "";
$paisElegido = "";

//****************************************************************
//******************IF $_POST RECIBE DATOS O NO*******************
//****************************************************************

if($_POST){
  //var_dump($_POST);
  //var_dump($_FILES);
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
    $errorNombre = "El nombre es obligatiorio.<br>";
    }else if (strlen($nombre) < 3 || strlen($nombre) > 15){
    $errorNombre = "El nombre debe tener entre 3 y 15 caracteres.";
    }elseif (!ctype_alpha($nombre)){
    $errorNombre = "El nombre solo puede contener letras";
      }

  //****************ERRORES Apellido***********************
  if(empty($apellido)){
    $errorApellido = "El apellido es obligatiorio.<br>";
  }else if (strlen($apellido) < 1 || strlen($apellido) > 30){
    $errorApellido = "El apellido debe tener entre 1 y 30 caracteres.";
    }//elseif (!ctype_alpha($apellido)){
  //   $errorApellido = "El nombre solo puede contener letras";
  //     }

  //****************ERRORES Email************************
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errorEmail = "Ingresa un email valido";
    }

  //****************ERRORES PAIS********************
  if($_POST['paisUsuario'] == "0"){
    $errorPais = "Selecciona un País";
    }

  //****************ERRORES UserName************************
  if(empty($userName)){
    $errorUserName = "El nombre de usuario es obligatorio.";
  }elseif(strlen($userName) < 4 || strlen($userName) > 20){
    $errorUserName = "El nombre de usuario debe tener entre 4 y 20 caracteres.";
  }elseif(is_numeric(substr($userName, 0, 1))){
    $errorUserName = "El nombre de usuario no puede comenzar con un número.";
  }

  //****************ERRORES Contrasena********************
  if(empty($contrasena) || strlen($contrasena) < 6){
    $errorContrasena = "La contraseña debe tener 6 caracteres minimo.";
    }

    //****************ERRORES checkContrasena********************
  if($checkcontrasena !== $contrasena){
    $errorCheckContrasena = "Las contraseñas no coinciden.";
  }

    if(
      empty($errorNombre) &&
      empty($errorApellido) &&
      empty($errorEmail) &&
      empty($errorUserName) &&
      empty($errorPais) &&
      empty($errorContrasena) &&
      empty($errorCheckContrasena)
    ){
      //var_dump($_FILES['foto']); exit;
      if($_FILES['foto']['error'] == UPLOAD_ERR_OK){
        $desde = $_FILES['foto']['tmp_name'];
        $archivo = $_POST['userName'];
        $ext = pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION);
        if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png'){
          $hasta =  dirname(__FILE__)."/images/avatars/" . $archivo . "." . $ext;
          move_uploaded_file($desde, $hasta);
          header('location:perfil.php');
        }else{
          $errorImg = "Formato no valido";
        }
      }else{
        $errorImg = "La foto tuvo un error";
      }
    }






}

?>
