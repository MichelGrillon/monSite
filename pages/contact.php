<?php

include_once 'init.php'; // Inclure le fichier de configuration pour démarrer la session

// Vérifier si un message a été envoyé
$message_sent = $_SESSION['message_sent'] ?? null;
unset($_SESSION['message_sent']); // Effacer le message de la session après l'avoir lu


// Générer un jeton CSRF si non existant
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier le jeton CSRF
    if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        // En-tête pour indiquer que la réponse est au format JSON
        header('Content-Type: application/json');

        ini_set('display_errors', 1);
        error_reporting(E_ALL);

         // Nettoyage et validation des données
        $nom = htmlspecialchars(strip_tags(trim($_POST['nom'])));
        $prenom = htmlspecialchars(strip_tags(trim($_POST['prenom'])));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $sujet = htmlspecialchars(strip_tags(trim($_POST['sujet'])));
        $commentaire = htmlspecialchars(strip_tags(trim($_POST['commentaire'])));

        // Validation de l'adresse email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Adresse email invalide']);
            exit;
        }

        $from = "###@###.fr";
        $to = "###@###.fr";
        $subject = "Nouveau message de $nom $prenom";
        $message = "Nom: $nom\nPrenom: $prenom\nEmail: $email\n\nSujet: $sujet\n\nCommentaire:\n$commentaire";
        $headers = "From: $from\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Assigner le résultat de l'envoi de l'email à $success
        $success = mail($to, $subject, $message, $headers);

        // Vérifier la variable $success
        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Email envoyé avec succès !']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'envoi de l\'email.']);
        }
        exit; // Important pour stopper l'exécution après avoir renvoyé la réponse
    } else {
        echo json_encode(['success' => false, 'message' => 'Jeton CSRF invalide']);
        exit;
    }
}
?>

<!-- HTML commence ici -->
<section class="container contact" id="contact">
    <div class="contact-container">
        <div class="main-title">
            <h2>Contactez <span>Moi</span><span class="bg-text">Contact</span></h2>
        </div>
        <div class="mobile-main-title">
            <h2>Écrivez <span>Moi</span><span class="bg-text">Contact</span></h2>
        </div>
        <div class="contact-content-con">
            <div class="left-contact">
                <h3>Prendre contact</h3>
                <p>Actuellement à la recherche de nouvelles opportunités, ma boîte de réception est toujours ouverte. </p>
                <p>Que vous ayez une question ou que vous souhaitiez simplement me dire bonjour, je ferai de mon mieux pour vous répondre !</p>
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="icon">
                            <i class="fas fa-map-marker-alt" role="img"></i>
                            <span>Location :</span>
                        </div>
                        <p>Anjou, France</p>
                    </div>
                    <div class="contact-item">
                        <div class="icon">
                            <i class="fas fa-envelope" role="img"></i>
                            <span>Email :</span>
                        </div>
                        <p><span>contact@michel-grillon.fr</span></p>
                    </div>
                </div>
                <div class="contact-icon">
                    <a href="#/" target="_blank" aria-label="Lien vers LinkedIn">
                        <i class="fab fa-linkedin" role="img"></i>
                    </a>
                    <a href="#" target="_blank" aria-label="Lien vers GitHub">
                        <i class="fab fa-github" role="img"></i>
                    </a>
                </div>
            </div>
            <div class="right-contact">
                <form id="contact-form" action="#" method="post" class="contact-form">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div>
                        <p><small>* Champ obligatoire</small></p>
                    </div>
                    <div class="input-control">
                        <input type="text" id="nom" name="nom" class="form-control" required placeholder="VOTRE NOM*" autocomplete="family-name" aria-required="true">
                    </div>
                    <div class="input-control">
                        <input type="text" id="prenom" name="prenom" class="form-control" required placeholder="VOTRE PRENOM*" autocomplete="given-name" aria-required="true">
                    </div>
                    <div class="input-control">
                        <input type="email" id="email" name="email" class="form-control" required placeholder="VOTRE EMAIL*" autocomplete="email" aria-required="true">
                    </div>
                    <div class="input-control">
                        <input type="text" id="sujet" name="sujet" class="form-control" required placeholder="SUJET DU MAIL*" autocomplete="on" aria-required="true">
                    </div>
                    <div class="input-control">
                        <textarea id="commentaire" name="commentaire" class="form-control" cols="15" rows="8" placeholder="Votre message ici...*" autocomplete="off" aria-required="true"></textarea>
                    </div>
                    <div class="submit-btn">
                        <label>
                            <span><small>
                                    <input type="checkbox" name="accepter" value="1" aria-invalid="false" required>
                                    En soumettant ce formulaire, j'accepte l'utilisation de mes données personnelles pour être recontacté. &nbsp;
                                </small></span>

                            <br>
                            <span><small>Pour plus d'informations sur vos droits, consultez la <a href="/pages/confidentialite.php"><u>Politique de confidentialité.</u></a></small></span>
                            <br>
                        </label>
                        <input type="submit" name="submit" value="Envoyer" class="main-btn-contact" id="submit-btn">
                    </div>
                </form>
                <div id="alert-success" class="alert alert-success" style="display: none;" role="alert">
                    Email bien envoyé !
                    <span class="close" role="button" aria-label="Fermer">&times;</span>
                </div>
                <div id="alert-error" class="alert alert-error" style="display: none;" role="alert">
                    Erreur lors de l'envoi de l'email.
                    <span class="close" role="button" aria-label="Fermer">&times;</span>
                </div>
            </div>
        </div>
    </div>
</section>
