document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM chargé");

    // Code pour la gestion des boutons de contrôle
    const controls = document.querySelectorAll(".control");
    if (controls.length > 0) {
        controls.forEach(button => {
            button.addEventListener("click", function () {
                document.querySelector(".active-btn")?.classList.remove("active-btn");
                this.classList.add("active-btn");

                document.querySelector(".active")?.classList.remove("active");
                const sectionToActivate = document.getElementById(this.dataset.id);
                if (sectionToActivate) {
                    sectionToActivate.classList.add("active");
                } else {
                    console.error(`La section avec l'ID ${this.dataset.id} n'existe pas.`);
                }
            });

            // Gestion des événements de clavier
            button.addEventListener("keydown", function (event) {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    this.click();
                }
            });
        });
    } else {
        console.error("Aucun élément avec la classe .control n'a été trouvé.");
    }

    // Gestion des thèmes clair-foncé
    const themeToggleBtn = document.querySelector(".theme-btn");
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener("click", () => {
            document.body.classList.toggle("dark-mode");
            const icon = themeToggleBtn.querySelector("i");
            icon.classList.toggle("rotated");
        });

        // Gestion des événements de clavier pour le bouton de thème
        themeToggleBtn.addEventListener("keydown", function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                this.click();
            }
        });
    } else {
        console.error("L'élément .theme-btn est introuvable.");
    }

    // Gestion du bouton retour en haut
    const retourHaut = document.getElementById("retour-haut");
    if (retourHaut) {
        window.addEventListener("scroll", function () {
            retourHaut.style.display = (window.scrollY > 20) ? "block" : "none";
        });

        retourHaut.addEventListener("click", function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Gestion des événements de clavier pour le bouton retour en haut
        retourHaut.addEventListener("keydown", function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                this.click();
            }
        });
    } else {
        console.error("L'élément #retour-haut est introuvable.");
    }

        // Gestion du formulaire de contact
    const contactForm = document.getElementById('contact-form');
    const alertSuccess = document.getElementById('alert-success');
    const alertError = document.getElementById('alert-error');

    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault(); // Empêche la soumission normale du formulaire
            
            const formData = new FormData(this);

            // Réinitialiser les alertes avant une nouvelle soumission
            alertSuccess.style.display = 'none';
            alertError.style.display = 'none';

            fetch('/pages/contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log("Réponse reçue", response);
                const contentType = response.headers.get("content-type");
                if (contentType && contentType.indexOf("application/json") !== -1) {
                    return response.json();
                } else {
                    return response.text().then(text => {
                        throw new Error("Réponse non-JSON reçue: " + text);
                    });
                }
            })
            .then(data => {
                console.log("Données traitées", data);

                // Afficher l'alerte appropriée en fonction du résultat
               if (data.success) {
    document.getElementById("alert-success").style.display = "block";
    document.getElementById("alert-error").style.display = "none"; // Cache l'erreur
    contactForm.reset(); // Vider le formulaire en cas de succès
} else {
    document.getElementById("alert-error").style.display = "block";
    document.getElementById("alert-success").style.display = "none"; // Cache le succès
}

            })
            .catch(error => {
                console.error('Erreur:', error);
                alertError.textContent = 'Une erreur est survenue. Veuillez réessayer.';
                alertError.classList.add('show');
                alertSuccess.classList.remove('show');
            });
        });
    }

    // Gestion de la fermeture des alertes
    document.querySelectorAll('.close').forEach(function(closeBtn) {
        closeBtn.addEventListener('click', function() {
            this.parentElement.style.display = 'none'; // Cache l'alerte sur fermeture
        });
    });


    // Gestion du bouton de changement de taille de texte
    const textSizeBtn = document.querySelector(".text-size-btn");
    if (textSizeBtn) {
        textSizeBtn.addEventListener("click", () => {
            document.body.classList.toggle("large-text");
            const icon = textSizeBtn.querySelector("i");
            if (icon.classList.contains("fa-plus")) {
                icon.classList.remove("fa-plus");
                icon.classList.add("fa-minus");
                textSizeBtn.setAttribute("aria-label", "Réduire la taille du texte");
            } else {
                icon.classList.remove("fa-minus");
                icon.classList.add("fa-plus");
                textSizeBtn.setAttribute("aria-label", "Agrandir la taille du texte");
            }
        });

        // Gestion des événements de clavier pour le bouton de taille de texte
        textSizeBtn.addEventListener("keydown", function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                this.click();
            }
        });
    } else {
        console.error("L'élément .text-size-btn est introuvable.");
    }

    // Sélectionner tous les éléments avec l'infobulle
    const tooltips = document.querySelectorAll('.tooltip-mobile');

    tooltips.forEach(tooltip => {
        // Lors d'un toucher/clic sur mobile
        tooltip.addEventListener('click', function() {
            // Basculer l'état de l'infobulle
            this.classList.toggle('active');
        });
    });
    //Fin
});

