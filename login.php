<?php
$errorEmail = "";
$errorContrasena = "";
$email = "";

//****************Log In***********
if($_POST){
  //var_dump($_POST);
  //var_dump($_FILES);
  //****************CONFIGURACION DE VARIABLES***********
  $email = trim($_POST['email']);
  $contrasena = trim($_POST['contrasena']);

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errorEmail = "Ingresa un email valido";
    }elseif(empty ($email)){
      $errorEmail = "El email es obligatorio";
    }
  if(empty($contrasena) || strlen($contrasena) < 6){
    $errorContrasena = "La contraseña debe tener 6 caracteres minimo.";
    }
  if(empty($errorEmail) && empty($errorContrasena)){
    header('location:perfil.php');
  }
}

$title = "Felicitrip Login - para el viajero que hay en vos";
$mainTitle = "Felicitrip";

require_once ('head.php');

?>


<body>
  <?php require_once('header.php'); ?>
    <main class="main-ini">
      <div class="col-1">
          <article class="formulario">
            <form class="login" action="" method="post" enctype="multipart/form-data">
              <h2>Ingresa a tu cuenta</h2>
              <input type="text" placeholder="Email" name="email" value="<?php echo $email ?>">
              <span><?php echo $errorEmail; ?></span>
              <input type="password" placeholder="Contraseña" name="contrasena">
              <span><?php echo $errorContrasena; ?></span>
              <button type="submit" name="">Ingresar</button>
              <a href="#">¿Has olvidado la contraseña?</a>
            </form>
          </article>
          <article class="etiqueta">
            <p>¿Nuev@ viajer@? <a href="index.php">Registrate</a></p>
          </article>
        </div>
        <div class="col-2">
          <div class="ini-h3">
            <ul>
              <li><span class="special">Conecta con miles de viajeros por el mundo.</span></li>
              <li><span class="special">vive experiencias que nunca imaginarias.</span></li>
              <li><span class="special">comparti tus consejos para otros viajeros.</span></li>
              <li><span class="special">Mostrale a todo el mundo tu viaje, quien sabe con quien te cruzaras mañana...</span></li>
              <li><span class="special">Viaja sin fronteras!!</span></li>
             </ul>

          </div>
        </div>
    </main>





   <?php require_once('footer.php'); ?>
 </body>
