<?php
require_once ('autoload.php');

$title = "Registrate en Felicitrip - para el viajero que hay en vos";
$mainTitle = "Felicitrip";
if ($auth->estaLogueado()) {
  header("Location:perfil.php?$email");exit;
}

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
   $errors = Validador::validarRegistro($_POST, $db);

   if (count($errors) == 0) {

      $nombre = trim($_POST['nombre']);
      $apellido = trim($_POST['apellido']);
      $email = trim($_POST['email']);
      $userName = trim($_POST['userName']);
      $contrasena = trim($_POST['contrasena']);
      $paisElegido = $_POST['paisUsuario'];

      $usuario = new Usuario($nombre, $apellido, $email, $paisElegido, $userName, $contrasena);

      //el metodo saveAvatar recibe un usuario y guarda el avatar y me devuelve el nombre del avatar en una variable
      $avatarName = $usuario->saveAvatar($usuario);

      //le asigno al nuevo usuario su avatar con el nombre correspondiente.
      $usuario->setAvatar($avatarName);

      //guardo en la base de datos el nuevo usuario
      $db->saveUser($usuario);
      $auth->loguear($usuario->getEmail());
      header("Location:perfil.php?$email");exit;
   }
}



require_once('head.php');

 ?>


<body>
  <?php require_once('header.php'); ?>
    <main class="main-ini">
        <div class="col-1">
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
        <div class="col-2">
          <article class="formulario">
            <form class="registro" action="" method="post" enctype="multipart/form-data">
              <h2>Crea tu cuenta</h2>
              <p>Conectate con otr@s viajer@s para vivir nuevas experiencias sin fronteras.</p>
              <div class="fullname">
                <input type="text" placeholder="Nombre" name="nombre" value="<?php echo $nombre ?>">
                  <span><?= $errors["errorNombre"] ?? ""; ?></span>
                <input type="text" placeholder="Apellido" name="apellido" value="<?php echo $apellido ?>">
                  <span><?= $errors["errorApellido"] ?? ""; ?></span>
              </div>

              <input type="text" placeholder="Email" name="email" value="<?php echo $email ?>">
                <span><?= $errors["errorEmail"] ?? "" ; ?></span>
              <select class="paisUsuario" name="paisUsuario">
                <option value=0>Seleccione un País</option>
                <?php
                  foreach ($paises as $pais) {?>
                    <option
                      value="<?php echo $pais;?>"
                      <?php echo ($paisElegido == $pais) ? "selected" : ""?>>
                        <?php echo $pais;?>
                    </option>
                <?php } ?>
              </select>
                <span><?= $errors["errorPais"] ?? "" ; ?></span>

              <input type="text" placeholder="Nombre de usuario" name="userName" value="<?= $userName ?>">
                <span><?= $errors["errorUserName"] ?? "" ; ?></span>
                <br>

              <div class="upload">
                <label class="labelAvatar" for="avatar">Sube tu avatar</label>
                <input type="file" id="avatar" name="foto">
                <span><?= $errors["errorImg"] ?? "" ; ?></span>
              </div>

              <input type="password" placeholder="Ingresa tu contraseña" name="contrasena">
                <span><?= $errors["errorContrasena"] ?? "" ; ?></span>
              <input type="password" placeholder="Repite tu contraseña" name="checkContrasena">
                <span><?= $errors["errorCheckContrasena"] ?? "" ; ?></span>

              <button type="submit" name="">Registrate</button>
            </form>
          </article>

          <article class="etiqueta">
            <p>¿Tienes una cuenta? <a href="login.php">Entrar</a></p>
          </article>
        </div>
    </main>





   <?php require_once('footer.php'); ?>
 </body>
