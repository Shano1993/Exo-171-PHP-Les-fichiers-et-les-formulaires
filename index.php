<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test Fichier</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <form action="/fichier.php" method="post" enctype="multipart/form-data">
        <label for="id-file"></label>

        <input type="file" name="file" id="id-file">

        <input type="submit" name="submit" id="id-submit">
    </form>

</body>
</html>

<?php

$messages = [
    "Erreur: Le poid de votre fichier ne doit pas dépasser 3Mo",
    "Erreur: Votre fichier doit être au format image",
    "Erreur: Une erreur est survenue lors de l'envoi de votre fichier",
];

if (isset($_GET['error'])) {
    $feedback = (int)$_GET['error'];
    if (in_array($feedback, array_keys($messages))) { ?>
        <div><?= $messages[$feedback] ?></div> <?php
    }
    else { ?>
        <div>N'essaye pas de m'envoyer un fichier malsain !</div> <?php
    }
}

?>


