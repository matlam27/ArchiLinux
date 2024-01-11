<?php
$servername = "192.168.64.8";
$username = "root";
$password = "root";
$database = "archilinux";

// Établir la connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $database);

// Vérifier la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Requête SELECT pour récupérer toutes les informations de la table "personnes"
$sql = "SELECT * FROM personnes";

// Exécuter la requête
$result = mysqli_query($conn, $sql);

// Vérifier si la requête a réussi
if (!$result) {
    die("Erreur lors de l'exécution de la requête : " . mysqli_error($conn));
}

// Afficher les données récupérées
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Âge</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nom"] . "</td>";
        echo "<td>" . $row["prenom"] . "</td>";
        echo "<td>" . $row["age"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Aucun enregistrement trouvé dans la table 'personnes'.";
}

// Fermer la connexion à la base de données lorsque vous avez terminé
mysqli_close($conn);
?>
