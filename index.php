<?php
$servername = "192.168.64.9";
$username = "admin";
$password = "1234";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=archilinux", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie";
} catch (PDOException $e) {
    echo "Connexion échouée : " . $e->getMessage();
}

$message = ""; // Variable pour stocker le message de confirmation

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $age = $_POST["age"];

    // Insérer les données dans la table "personnes"
    $sql = "INSERT INTO personnes (nom, prenom, age) VALUES (:nom, :prenom, :age)";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':age', $age);

    try {
        $stmt->execute();
        $message = "Données insérées avec succès !";
    } catch (PDOException $e) {
        $message = "Erreur lors de l'insertion des données : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 20px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        div {
            margin-top: 20px;
            margin-left: 600px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 8px;
        }

        h2 {
            color: #333;
        }
    </style>
<head>
    <title>Formulaire d'insertion</title>
</head>
<body>
    <form method="post" action="">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required><br>

        <label for="age">Âge :</label>
        <input type="number" name="age"><br>

        <input type="submit" name="submit" value="Insérer">
    </form>

    <!-- Div pour afficher le message de confirmation -->
    <div><?php echo $message; ?></div>

    <!-- Div pour afficher les données de la table "personnes" -->
    <div>
        <h2>Liste des personnes :</h2>
        <?php
        $sql = "SELECT nom, prenom, age FROM personnes";
        $result = $bdd->query($sql);

        if ($result->rowCount() > 0) {
            echo "<ul>";
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>{$row['nom']} {$row['prenom']} (Âge : {$row['age']})</li>";
            }
            echo "</ul>";
        } else {
            echo "Aucune personne trouvée dans la table.";
        }
        ?>
    </div>
</body>
</html>