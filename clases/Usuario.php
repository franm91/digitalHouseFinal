<?php

class Usuario
{
   private $id;
   private $name;
   private $lastName;
   private $email;
   private $pais;
   private $userName;
   private $password;

   function __construct($name, $lastName, $email, $pais, $userName, $password, $id = NULL){
      if ($id === NULL) {
         $this->setPassword($password);
      }else {
         $this->password = $password;
      }

      $this->setId($id);
      $this->setName($name);
      $this->setLastName($lastName);
      $this->setEmail($email);
      $this->setPais($pais);
      $this->setUserName($userName);
   }

   public function getId(){
      return $this->id;
   }
   public function setId($id){
      $this->id = $id;
   }


   public function getName(){
      return $this->name;
   }
   public function setName($name){
      $this->name = $name;
   }


   public function getLastName(){
      return $this->lastName;
   }
   public function setLastName($lastName){
      $this->lastName = $lastName;
   }


   public function getEmail(){
      return $this->email;
   }
   public function setEmail($email){
      $this->email = $email;
   }

   public function getPais() {
      return $this->pais;
   }
   public function setPais($pais) {
      $this->pais = $pais;
   }


   public function getUserName(){
      return $this->userName;
   }
   public function setUserName($userName){
      $this->userName = $userName;
   }


   // public function getAvatar() {
   //    return $this->avatar;
   // }
   // public function setAvatar($avatar) {
   //    $this->avatr = $avatar;
   // }


   public function getPassword(){
      return $this->password;
   }
   public function setPassword($password){
      $this->password = password_hash($password, PASSWORD_DEFAULT);
   }


   public function saveAvatar(){
      if($_FILES['foto']['error'] == UPLOAD_ERR_OK){
         $desde = $_FILES['foto']['tmp_name'];
         $archivo = $_POST['email'];
         $ext = pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION);
         if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png'){
            $hasta =  dirname(__DIR__) . "/images/avatars/" . $archivo . "." . $ext;
            move_uploaded_file($desde, $hasta);
            return $hasta;
            //header('location:perfil.php');
         }
      }
   }


}
