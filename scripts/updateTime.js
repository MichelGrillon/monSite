function updateTime() {
    const now = new Date();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    document.getElementById('heure').textContent = `${hours}h${minutes}m${seconds}s`;
}

// Mettre à jour l'heure toutes les secondes
setInterval(updateTime, 1000);

// Mettre à jour l'heure immédiatement lors du chargement de la page
updateTime();