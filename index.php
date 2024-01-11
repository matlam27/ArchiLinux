<?php

$servername= "192.168.64.8";
$username= "root";
$password = "root";

try {
$bdd = new PDO("mysql:host=$servername;dbname=archilinux", $username, $password);
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "connexion réussie";
}
catch (PDOException $e) {
echo "connexion échouée: " . $e->getMessage();
}
$sql = "SELECT * FROM personnes";
$req = $bdd->query($sql);
while ($rep = $req->fetch()) {
echo $rep['id']."<br>";
}