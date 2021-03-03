<?php

$server = "localhost";
$db = "exo198";
$user = "root";
$psw = "";

try {
    $bdd = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $psw);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION).
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    create("Ard", "Chloé", 18, $bdd);
    create("Fraise", "Gertrude", 42, $bdd);
    reade($bdd);
    update("Gertrude", "Fraise", 32, 2, $bdd);
    delete(1, $bdd);



}
catch (PDOException $e) {
    echo $e->getMessage();
}


function create($nom, $prenom, $age, $bdd) {
    $sql = ("INSERT INTO eleves VALUES (null, $nom, $prenom, $age)");
    $bdd->exec($sql);
}

function reade($bdd) {
    $stmt = $bdd->prepare("SELECT * from eleves");

    $state = $stmt->execute();

    if ($state) {
        foreach ($stmt -> fetchAll() as $user) {
            echo "Eleves " . $user['id'] . ": " . $user['nom'] . " " . $user['prenom'] . ", " . $user['age'] . " ans.";
        }
    }
}

function update($prenom, $nom, $age, $idEleve, $bdd) {
    $stm = $bdd->prepare("UPDATE eleves SET prenom = :prenom, nom = :nom, age = :age WHERE id = :id");

    $stm->bindParam(':prenom', $prenom);
    $stm->bindParam(':nom', $nom);
    $stm->bindParam(':age', $age);
    $stm->bindParam(':id', $idEleve);

    $stm->execute();
}

function delete($idEleve, $bdd) {
    $sql = "DELETE FROM eleves WHERE id = $idEleve";
    if ($bdd->exec($sql) !== false) {
        echo "L'élève ayant l'id" . $idEleve . " a bien été supprimé !";
    }

}
