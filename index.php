<?php

$server = 'localhost';
$user = 'root';
$password = '';
$db = 'exo198';

try {
    $bdd = new PDO("mysql:host=$this->server;dbname=$this->db;charset=utf8", $this->user, $this->pwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  function ajoutEleve ($nom, $prenom, $age) {
      $sql = "
        INSERT INTO eleves VALUES (null, '$nom', '$prenom', '$age')
    ";
  }

}
catch (PDOException $e) {
    echo $e->getMessage();
}
