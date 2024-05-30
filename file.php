<!DOCTYPE html>
<html>
<head>
    <title>Formulaire </title>
</head>
<body>
    <h1>Formulaire de Contact</h1>
    <form method="post" action="">
        <label for="nom">Nom:</label><br>
        <input type="text" id="nom" name="nom" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>
        <button type="submit" name="submit">Envoyer</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
        $data = $nom . "," . $email . "," . $message . "\n";

         
        $file = fopen("messages.txt", "a");
        if ($file) {
            fwrite($file, $data);
            fclose($file);
            echo "<p>Message envoyé avec succès!</p>";
        } else {
            echo "<p>Erreur lors de l'écriture dans le fichier.</p>";
        }
    }

    
    if (file_exists("messages.txt")) {
        $file = fopen("messages.txt", "r");
        if ($file) {
            echo "<h2>Messages Reçus</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Message</th>
                    </tr>";
            while (($line = fgets($file)) !== false) {
                list($nom, $email, $message) = explode(",", trim($line));
                echo "<tr>
                        <td>$nom</td>
                        <td>$email</td>
                        <td>$message</td>
                      </tr>";
            }
            echo "</table>";
            fclose($file);
        } else {
            echo "<p>Erreur lors de la lecture du fichier.</p>";
        }
    }
    ?>
</body>
</html>
