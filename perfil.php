
<?php
$title = "Perfil del viajero - para el viajero que hay en vos";
$mainTitle = "Felicitrip";

require_once ('head.php');
?>
  <body>
    <?php require_once('header.php'); ?>  
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
          <img class="avatar"  src="images/profile.png">
          <p>Bruce Wayne</p>
        </div>
        <ul class="listPerfilR">
          <li><a href="#">Fotos</a></li>
          <li><a href="#">Videos</a></li>
          <li><a href="#">Recomendaciones</a></li>
        </ul>
      </nav>
    </section>
    <section class="contenedorSecundario">
      <nav class="datosCuenta">
        <div class="personales">
          <h4>Datos Personales <a href="#"><img class="icon"src="images/modify.png" alt=""></a></h4>
          <ul>
            <li><strong>Nombre:</strong> Bruce Wayne</li>
            <li><strong>Nacionalidad:</strong> Argentino</li>
            <li><strong>País de residencia:</strong> Russia</li>
            <li><strong>Profesion:</strong> Misteriosa</li>
            <li><strong>Fecha de nacimiento:</strong> 10-05-1980</li>
          </ul>
        </div>
        <hr>
        <div class="infoContacto">
          <h4>Datos Personales <a href="#"><img class="icon"src="images/modify.png" alt=""></a></h4>
          <ul>
            <li><strong>Email:</strong> brucewayne@imbatman.com</li>
            <li><strong>Movil:</strong> 11-3-123-4567</li>
          </ul>
        </div>
        <hr>
        <div class="infoCuenta">
          <h4>Datos de cuenta <a href="#"><img class="icon"src="images/modify.png" alt=""></a></h4>
          <ul>
            <li><strong>Usuario:</strong> Batman</li>
            <li><strong>Password:</strong> ****** </li>
          </ul>
        </div>
        </div>
      </nav>
      <nav class="quiensoy">
        <h3>¿Quien soy?</h3>
          <p >Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
            ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
            in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
            occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            quis nostrud exercitation ullamco laboris nisi
          </p>
      </nav>
    </section>
  </body>
