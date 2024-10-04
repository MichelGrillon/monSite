<div class="controls">
    <!-- Boutons de contrôle avec des icônes et des attributs ARIA pour l'accessibilité -->
    <div class="control active-btn" data-id="home" aria-label="Accueil" tabindex="0" role="button">
        <i class="fas fa-home" role="img"></i>
    </div>
    <div class="control" data-id="about" aria-label="À propos" tabindex="0" role="button">
        <i class="fas fa-user" role="img"></i>
    </div>
    <div class="control" data-id="portfolio" aria-label="Portfolio" tabindex="0" role="button">
        <i class="fas fa-briefcase" role="img"></i>
    </div>
    <div class="control" data-id="contact" aria-label="Contact" tabindex="0" role="button">
        <i class="fas fa-envelope-open" role="img"></i>
    </div>
    <div class="control" data-id="confidentialite" aria-label="Confidentialité" tabindex="0" role="button">
        <i class="fa-solid fa-shield-halved" role="img"></i>
    </div>
    <div class="control" data-id="mentions" aria-label="Mentions légales" tabindex="0" role="button">
        <i class="fa-solid fa-gavel" role="img"></i>
    </div>

    <!-- Liens vers les réseaux sociaux avec des attributs ARIA pour l'accessibilité -->
    <div class="logos-reseaux" id="reseauxLink">
        <a href="https://www.linkedin.com/in/grillon-michel-7311b286/" target="_blank" aria-label="LinkedIn">
            <i class="fab fa-linkedin" role="img"></i>
        </a>
    </div>
    <div class="logos-reseaux" id="reseauxGit">
        <a href="https://github.com/MichelGrillon" target="_blank" aria-label="GitHub">
            <i class="fab fa-github" role="img"></i>
        </a>
    </div>
</div>
<div id="accessibilite">
    <!-- Bouton de changement de thème avec un attribut ARIA pour l'accessibilité -->
    <div class="theme-btn" aria-label="Changer de thème" tabindex="0" role="button">
        <i class="fas fa-adjust" role="img"></i>
    </div>
    <!-- Bouton de changement de taille de texte avec un attribut ARIA pour l'accessibilité -->
    <div class="text-size-btn" aria-label="Changer la taille du texte" tabindex="0" role="button">
        <i class="fa-solid fa-plus" role="img"></i>
    </div>
</div>

<footer>
    <!-- Script pour les fonctionnalités du site -->
    <script src="../scripts/scripts.js"></script>
    <script src="../scripts/updateTime.js" defer></script>
    <!-- Bouton de retour en haut de la page avec un attribut ARIA pour l'accessibilité -->
    <div class="fleche-hdpage" id="retour-haut" aria-label="Retour en haut de la page" tabindex="0" role="button">
        <i class="fas fa-arrow-up" role="img"></i>
    </div>
</footer>

</body>

</html>