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
            password)
         VALUES(
            :nombre,
            :apellido,
            :email,
            :pais,
            :nombre_usuario,
            :password)
         ");

      $stmt->bindvalue(":nombre",$usuario->getName());
      $stmt->bindvalue(":apellido",$usuario->getLastName());
      $stmt->bindvalue(":email",$usuario->getEmail());
      $stmt->bindvalue(":pais",$usuario->getPais());
      $stmt->bindvalue(":nombre_usuario",$usuario->getUserName());
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
            $oneUser->id,
            $oneUser->nombre,
            $oneUser->apellido,
            $oneUser->email,
            $oneUser->pais,
            $oneUser->nombre_usuario,
            $oneUser->password
         );
      }

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
         return new Usuario(
            $userByEmail->id,
            $userByEmail->nombre,
            $userByEmail->apellido,
            $userByEmail->email,
            $userByEmail->pais,
            $userByEmail->nombre_usuario,
            $userByEmail->password
         );
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
            $userByUserName->id,
            $userByUserName->nombre,
            $userByUserName->apellido,
            $userByUserName->email,
            $userByUserName->pais,
            $userByUserName->nombre_usuario,
            $userByUserName->password
         );
      }else {
         return NULL;
      }
   }




}
