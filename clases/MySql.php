<?php


class MySql extends Bd{

   private $connection;

   function __construct($dbName, $user, $pass)
   {
      parent::__construct($dbName, $user, $pass);

      $host = "mysql:host=localhost; dbname={$dbName}; charset=utf8mb4";

      try{
         $this->connection = new PDO(
            $host,
            $user,
            $pass,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
      }catch (PDOException $Exception) {
         echo $Exception->getMessage();
      }
   }

   public function getConnection(){
      return $this->connection;
   }

   public function saveUser(Usuario $usuario){

      $stmt = $this->connection->prepare(
         "INSERT INTO usuarios(
            nombre,
            apellido,
            email,
            pais,
            nombre_usuario,
            descripcion,
            avatar,
            password)
         VALUES(
            :nombre,
            :apellido,
            :email,
            :pais,
            :nombre_usuario,
            :descripcion,
            :avatar,
            :password)
         ");

      $stmt->bindvalue(":nombre",$usuario->getName());
      $stmt->bindvalue(":apellido",$usuario->getLastName());
      $stmt->bindvalue(":email",$usuario->getEmail());
      $stmt->bindvalue(":pais",$usuario->getPais());
      $stmt->bindvalue(":nombre_usuario",$usuario->getUserName());
      $stmt->bindvalue(":descripcion",$usuario->getDescripcion());
      $stmt->bindvalue(":avatar",$usuario->getAvatar());
      $stmt->bindvalue(":password",$usuario->getPassword());

      $stmt->execute();
      $idUser = $this->connection->lastInsertId();
      $usuario->setId($idUser);

      return $usuario;
   }


   public function getAllUsers(){
      $stmt = $this->connection->prepare(
         "SELECT *
         FROM usuarios");

      $stmt->execute();

      $allUsers = $stmt->fetchAll(PDO::FETCH_OBJ);

      foreach ($allUsers as $oneUser) {
         $users[] = new Usuario(
            $oneUser->nombre,
            $oneUser->apellido,
            $oneUser->email,
            $oneUser->pais,
            $oneUser->nombre_usuario,
            $oneUser->password,
            $oneUser->id,
            $oneUser->descripcion
         );
      }
      $users->setAvatar($oneUser->avatar);
      return $users;

   }

   public function getUserByEmail($email){
      $stmt = $this->connection->prepare(
         "SELECT *
         FROM usuarios
         WHERE email = :email");

      $stmt->bindvalue(":email", $email);

      $stmt->execute();

      $userByEmail = $stmt->fetch(PDO::FETCH_OBJ);


      if ($userByEmail){
         $user = new Usuario(
            $userByEmail->nombre,
            $userByEmail->apellido,
            $userByEmail->email,
            $userByEmail->pais,
            $userByEmail->nombre_usuario,
            $userByEmail->password,
            $userByEmail->id,
            $userByEmail->descripcion
         );
         $user->setAvatar($userByEmail->avatar);
         return $user;
      }else {
         return NULL;
      }
   }


   public function getUserByUserName($userName){
      $stmt = $this->connection->prepare(
         "SELECT *
         FROM usuarios
         WHERE nombre_usuario = :nombre_usuario");

      $stmt->bindvalue(":nombre_usuario", $userName);

      $stmt->execute();

      $userByUserName = $stmt->fetch(PDO::FETCH_OBJ);

      if ($userByUserName){
         return new Usuario(
            $userByUserName->nombre,
            $userByUserName->apellido,
            $userByUserName->email,
            $userByUserName->pais,
            $userByUserName->nombre_usuario,
            $userByUserName->password,
            $userByUserName->id,
            $userByUserName->descripcion
         );
         $user->setAvatar($userByUserName->avatar);
         return $user;
      }else {
         return NULL;
      }
   }

   public function updateUser(Usuario $usuario){
      $nombre = $usuario->getName();
      $apellido = $usuario->getLastName();
      $pais = $usuario->getPais();
      $desc = $usuario->getDescripcion();
      $avatar = $usuario->getAvatar();
      $userId = $usuario->getId();

      $stmt = $this->connection->prepare(
         "UPDATE usuarios
         SET
            nombre = '$nombre',
            apellido = '$apellido',
            pais = '$pais',
            descripcion = '$desc',
            avatar = '$avatar'
         WHERE ID = $userId
         ");
         //var_dump($stmt);exit;
      // $stmt->bindvalue(":nombre", $nombre);
      // $stmt->bindvalue(":apellido", $apellido);
      // $stmt->bindvalue(":pais", $pais);
      // $stmt->bindvalue(":descripcion", $desc);
      // $stmt->bindvalue(":avatar", $avatar);
      // $stmt->bindvalue(":userID", $userId);
      $stmt->execute();


      return TRUE;
   }




}
