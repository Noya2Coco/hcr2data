function updateCountdown() {
    const now = new Date();
    const target = new Date();
    
    // Définir l'heure cible à 01:00:00
    target.setHours(1, 0, 0, 0);
    
    if (now >= target) {
        // Si l'heure actuelle est après 01:00:00, définir la cible pour le lendemain
        target.setDate(target.getDate() + 1);
    }
    
    const timeRemaining = target - now;
    
    const hours = Math.floor((timeRemaining / (1000 * 60 * 60)) % 24);
    const minutes = Math.floor((timeRemaining / 1000 / 60) % 60);
    const seconds = Math.floor((timeRemaining / 1000) % 60);
    
    const countdown = document.querySelector('.yellow-text');
    countdown.textContent = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    countdown.classList.add("yellow-text");
}

// Mettre à jour le compteur chaque seconde
setInterval(updateCountdown, 1000);

// Mettre à jour le compteur dès le chargement de la page
updateCountdown();
