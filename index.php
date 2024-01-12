<?php
$servername = "localhost"; 
$username = "root";
$password = "root";
$dbname = "archilinux";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie";


    $sql = "SELECT * FROM personnes";
    $req = $bdd->query($sql);

    while ($rep = $req->fetch()) {
        echo $rep['id']."<br>";
    }
} catch (PDOException $e) {
    echo "mange mes pieds : " . $e->getMessage();
}
?>
