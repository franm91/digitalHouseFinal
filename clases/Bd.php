<?php

abstract class Bd
{
   protected $dbName;
   protected $user;
   protected $pass;

   function __construct($dbName, $user, $pass)
   {
      $this->dbName = $dbName;
      $this->user = $user;
      $this->pass = $pass;
   }
//crear funciones abstracatas para guardar usuario, recibir usuario por mail y traer usuario.
//de esta manera todos los hijos que extiendan de Bd tienne que tenes esos metodos !!

   public abstract function saveUser(Usuario $usuario);
	public abstract function getUserByEmail($email);
   public abstract function getUserByUserName($userName);
	public abstract function getAllUsers();
}
