<?php
require_once ('autoload.php');

$title = "Actualiza tu perfil.";
$mainTitle = "Felicitrip";

if (isset($_SESSION["logueado"])) {
  $usuarioLogueado = $auth->usuarioLogueado($db);
}else {
    header("Location:index.php");exit;
}

// $nombre = $usuarioLogueado->getName();
// $apellido = $usuarioLogueado->getLastName();
$paises = ["Argentina", "Brasil", "Bolivia", "Colombia", "Chile", "Peru"];
 $paisElegido = $usuarioLogueado->getPais();
// $desc = $usuarioLogueado;

$errors = [];
// ****************************************************************
// ******************IF $_POST RECIBE DATOS O NO*******************
// ****************************************************************
if($_POST){

   $errors = Validador::validarActualizacion($_POST, $db);

   if (count($errors) == 0) {
      $nombre = trim($_POST['nombre']);
      $apellido = trim($_POST['apellido']);
      $usuarioLogueado->setName($nombre);
      $usuarioLogueado->setLastName($apellido);
      $usuarioLogueado->setPais($_POST['paisUsuario']);
      $usuarioLogueado->setDescripcion($_POST['descripcionUsuario']);


      if ($_FILES['foto']['name'] !== "") {
         //el metodo saveAvatar recibe un usuario y guarda el avatar y me devuelve el nombre del avatar en una variable
         $avatarName = $usuarioLogueado->saveAvatar($usuarioLogueado);
         //le asigno al nuevo usuario su avatar con el nombre correspondiente.
         $usuarioLogueado->setAvatar($avatarName);
      }


      //guardo en la base de datos el nuevo usuario
      $ok = $db->updateUser($usuarioLogueado);
      if ($ok == TRUE) {
         $usuarioActualizado = $db->getUserByEmail($usuarioLogueado->getEmail());
         $auth->loguear($usuarioActualizado->getEmail());
         header("Location:perfil.php");exit;
      }
   }
}



require_once('head.php');

 ?>
<body>

   <header class="header">
     <div class="header-content">
         <img class="mainLogo" src="images/avatars/<?= $usuarioLogueado->getAvatar() ?>" alt="<?= $usuarioLogueado->getName()?>  avatar" >
         <h1 class="mainTitle"><?= $usuarioLogueado->getName() . " " . $usuarioLogueado->getLastName() ?></h1>

     </div>
   </header>

    <main class="main-ini" style="background-image: url('images/fondo_perfil.jpg')">

     <div class="col-2" style="width: 75%">
       <article class="formulario" style="justify-content: 'center'">
         <form class="actualizar" action="" method="post" enctype="multipart/form-data">
           <h2>Actualiza tus datos</h2>
           <div class="fullname">
             <input type="text" placeholder="Nombre" name="nombre" value="<?= $usuarioLogueado->getName() ?>">
               <span><?= $errors["errorNombre"] ?? ""; ?></span>
             <input type="text" placeholder="Apellido" name="apellido" value="<?= $usuarioLogueado->getLastName() ?>">
               <span><?= $errors["errorApellido"] ?? ""; ?></span>
           </div>
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

           <div class="upload">
             <label class="labelAvatar" for="avatar">Sube tu nuevo avatar</label>
             <input type="file" id="avatar" name="foto">
             <span><?= $errors["errorImg"] ?? "" ; ?></span>
           </div>

          <textarea name="descripcionUsuario" placeholder="Describe un poco de tí aqui..."rows="8" cols="50"></textarea>

           <button type="submit" name="">Actualizar</button>
         </form>
       </article>

       <article class="etiqueta">
          <!-- <button type="submit" name="">Cancelar</button> -->
          <a href="perfil.php">cancelar</a>
       </article>
     </div>
    </main>





   <?php require_once('footer.php'); ?>
 </body>
