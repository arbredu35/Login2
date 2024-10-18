<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = htmlspecialchars($_POST['signupName']);
    $email = htmlspecialchars($_POST['signupEmail']);
    $password = htmlspecialchars($_POST['signupPassword']);
    
    // Chemin du fichier où les données seront enregistrées
    $filePath = 'users.txt';

    // Vérifier si le fichier est accessible en écriture
    if (!is_writable($filePath)) {
        echo "Le fichier n'est pas accessible en écriture.";
        exit();
    }

    // Préparer le contenu à enregistrer
    $content = "Nom: $name\nEmail: $email\nMot de passe: $password\n\n";

    // Écrire le contenu dans le fichier
    if (file_put_contents($filePath, $content, FILE_APPEND | LOCK_EX) === false) {
        echo "Erreur lors de l'écriture dans le fichier.";
        exit();
    } else {
        echo "Données enregistrées avec succès.<br>";
    }

    // Rediriger l'utilisateur vers la page d'accueil avec un message de succès
    header('Location: index.html?signup=success');
    flush(); // Forcer l'envoi des en-têtes
    exit();
} else {
    echo "Accès direct non autorisé.";
    exit();
}
?>
