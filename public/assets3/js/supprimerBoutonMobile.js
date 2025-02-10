document.addEventListener('DOMContentLoaded', function() {
    // Essayer de cibler le bouton avec sa classe ou un autre sélecteur unique.
    // Ajuste le sélecteur si nécessaire pour qu'il corresponde à ton bouton.
    const mobileMenuButton = document.querySelector('.navbar-toggler.navbar-toggler-right.d-lg-none.align-self-center');
  
    // Vérifier si le bouton a été trouvé.
    if (mobileMenuButton) {
      // Supprimer le bouton.
      mobileMenuButton.remove();
  
      console.log('Bouton de menu mobile supprimé.');
    } else {
      console.log('Bouton de menu mobile non trouvé.');
    }
  });