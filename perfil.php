
<?php
require_once 'autoload.php';

$title = "Perfil del viajero - para el viajero que hay en vos";
$mainTitle = "Felicitrip";

if (isset($_SESSION["logueado"])) {

  $usuarioLogueado = $auth->usuarioLogueado($db);
}


require_once ('head.php');
?>
  <body>
    <!-- <?php require_once('header.php'); ?> -->
    <section class="contenedorPrincipal">
      <div class="contenedorCover">
        <img class="imagenPerfil"  src="images/fondo_perfil.jpg" alt="imagen ciudad">
      </div>
      <nav class="navPerfil">
        <ul class="listPerfilL">
          <li><a href="#">Presentacion</a></li>
          <li><a href="#">Post</a></li>
          <li><a href="#">Seguidores</a></li>
        </ul>
        <div class="perfil">
          <img class="avatar"  src="images/avatars/<?= $usuarioLogueado->getAvatar() ?>">
          <p><?= $usuarioLogueado->getName() . ' ' . $usuarioLogueado->getLastName()  ?></p>
        </div>
        <ul class="listPerfilR">
          <li><a href="#">Fotos</a></li>
          <li><a href="#">Videos</a></li>
          <li><a href="#">Recomendaciones</a></li>
          <li><a href="logOut.php">Log Out</a></li>
        </ul>
      </nav>
    </section>
    <section class="contenedorSecundario">
      <nav class="datosCuenta">
        <div class="personales">
          <h4>Datos Personales <a href="actualizarPerfil.php"><img class="icon"src="images/modify.png" alt=""></a></h4>
          <ul>
            <li><strong>Nombre de Usuario:</strong> <?= $usuarioLogueado->getUserName() ?></li>
            <li><strong>Nacionalidad:</strong> <?= $usuarioLogueado->getPais() ?></li>

            <!-- <li><strong>Profesion:</strong> Misteriosa</li> -->
            <!-- <li><strong>Fecha de nacimiento:</strong> 10-05-1980</li> -->
          </ul>
        </div>
        <hr>
        <div class="infoContacto">

          <ul>
            <li><strong>Nombre:</strong> <?= $usuarioLogueado->getName() . ' ' . $usuarioLogueado->getLastName()  ?></li>
            <li><strong>Email:</strong> <?= $usuarioLogueado->getEmail() ?></li>
          </ul>
        </div>
        <hr>
        <div class="infoCuenta">
          
          <ul>
            <li><strong>Usuario:</strong> <?= $usuarioLogueado->getUserName() ?></li>
            <li><strong>Password:</strong> ****** </li>
          </ul>
        </div>
        </div>
      </nav>
      <nav class="quiensoy">
        <h3>¿Quien soy?</h3>
          <p ><?= $usuarioLogueado->getDescripcion() ?>
          </p>
      </nav>
    </section>
  </body>
