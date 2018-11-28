<?php
require_once ('autoload.php');

$title = "Felicitrip Login - para el viajero que hay en vos";
$mainTitle = "Felicitrip";

if ($auth->estaLogueado()) {
  header("Location:perfil.php?$email");exit;
}

$email = "";


$errors = [];
//****************************************************************
//******************IF $_POST RECIBE DATOS O NO*******************
//****************************************************************
if($_POST){
   $email = $_POST["email"];

   $errors = Validador::validarLogIn($_POST, $db);
   if (count($errors) == 0) {
      $email = trim($_POST['email']);
      $auth->loguear($email);

      if (isset($_POST["recordarme"])) {
         $auth->recordarme($_POST["email"]);
      }
      header("Location:perfil.php?$email");exit;
   }
}


require_once ('head.php');

?>


<body>
  <?php require_once('header.php'); ?>
    <main class="main-ini">
      <div class="col-1">
          <article class="formulario">
            <form class="login" action="" method="post" enctype="multipart/form-data">
              <h2>Ingresa a tu cuenta</h2>
              <input type="text" placeholder="Email" name="email" value="<?php echo $email; ?>">
              <span><?= $errors["errorEmail"] ?? "";?></span>
              <input type="password" placeholder="Contraseña" name="contrasena">
              <span><?= $errors["errorContrasena"] ?? "" ?><br></span>
              <input id="recordarme"type="checkbox" name="recordarme" value=""><p>Recordarme</p>
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
              <li><span class="special">vive experiencias que nunca imaginarias.</span></li>
              <li><span class="special">comparti tus consejos para otros viajeros.</span></li>
              <li><span class="special">Mostrale a todo el mundo tu viaje, quien sabe con quien te cruzaras mañana...</span></li>
              <li><span class="special">Viaja sin eras!!</span></li>
             </ul>

          </div>
        </div>
    </main>





   <?php require_once('footer.php'); ?>
 </body>
