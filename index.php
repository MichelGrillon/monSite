<?php

if (session_status() === PHP_SESSION_NONE) {
    include_once 'pages/init.php'; // Inclure le fichier de configuration pour démarrer la session // Démarrer la session seulement si elle n'est pas déjà active
}
// Régénérer l'ID de session pour éviter le détournement de session
session_regenerate_id(true);

// Vérifier si un message a été envoyé
$message_sent = $_SESSION['message_sent'] ?? null;
unset($_SESSION['message_sent']); // Effacer le message de la session après l'avoir lu

// Régénérer l'ID de session pour éviter le détournement de session
session_regenerate_id(true);
// Début du document HTML
include 'pages/header.php';
?>
<div id="copyright">
    <small>&copy; 2024 - Michel Grillon.</small>
</div>
<header class="container header active" id="home">
    <div class="header-content">
        <div class="left-header">
            <div class="h-shape"></div>
            <div class="image">
                <!-- Utiliser l'attribut alt pour améliorer l'accessibilité -->
                <img src="/../images/legos-original-small.webp" alt="Photo de Michel Grillon">
            </div>
        </div>
        <div class="right-header">
            <h1 class="name">
                    Bonjour, je suis <br>
                        <span>Michel Grillon</span><br>
                    Développeur web junior
                </h1>
                <hr>
                <br>
            <div id="dateHeure">
                <span id="date">
                    <?php
                    setlocale(LC_TIME, 'fr_FR.UTF-8');
                    $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                    $mois = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
                    $date = new DateTime();
                    echo $jours[$date->format('w')] . ' ' . $date->format('d') . ' ' . $mois[$date->format('n') - 1] . ' ' . $date->format('Y');
                    ?>
                </span>-<span id="heure"><?php echo date('H\hi\ms\s'); ?></span>
            </div>
            <br>
            <hr>
            <p>Ouverture : début octobre 2024. Merci pour votre patiance !</p>
            <hr>
        </div>
    </div>
</header>
<main>
    <div class="main-content">
        <?php
        // Contenu principal
        include 'pages/about.php';
        include 'pages/portfolio.php';
        include 'pages/contact.php';
        include 'pages/confidentialite.php';
        include 'pages/mentions.php';
        ?>
    </div>
</main>

<?php include 'pages/footer.php'; ?>
