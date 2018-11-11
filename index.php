<?php
$title = "Registrate en Felicitrip - para el viajero que hay en vos";
$mainTitle = "Felicitrip";
require_once('config.php');
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
                  <span><?php echo $errorNombre; ?></span>
                <input type="text" placeholder="Apellido" name="apellido" value="<?php echo $apellido ?>">
                  <span><?php echo $errorApellido; ?></span>
              </div>

              <input type="text" placeholder="Email" name="email" value="<?php echo $email ?>">
                <span><?php echo $errorEmail; ?></span>
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
                <span><?php echo $errorPais; ?></span>

              <input type="text" placeholder="Nombre de usuario" name="userName" value="<?php echo $userName ?>">
                <span><?php echo $errorUserName; ?></span>
                <br>

              <div class="upload">
                <label class="labelAvatar" for="avatar">Sube tu avatar</label>
                <input type="file" id="avatar" name="foto">
                  <span><?php echo $errorImg; ?></span>
              </div>

              <input type="password" placeholder="Ingresa tu contraseña" name="contrasena">
                <span><?php echo $errorContrasena; ?></span>

              <input type="password" placeholder="Repite tu contraseña" name="checkContrasena">
                <span><?php echo $errorCheckContrasena; ?></span>

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
