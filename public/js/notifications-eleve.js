// Gestion des notifications pour les élèves
document.addEventListener('DOMContentLoaded', function() {
    const notificationLink = document.getElementById('notification-link');
    
    if (notificationLink) {
        notificationLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Afficher un indicateur de chargement
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi...';
            this.style.pointerEvents = 'none';
            
            // Envoyer la notification via AJAX
            fetch('/notifier-eleve-ajax', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Afficher un message de succès
                    showNotificationMessage('success', data.message);
                    
                    // Animation de succès sur le lien
                    this.innerHTML = '<i class="fas fa-check"></i> Envoyé !';
                    this.style.background = 'rgba(76, 175, 80, 0.2)';
                    
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.style.background = '';
                        this.style.pointerEvents = 'auto';
                    }, 2000);
                } else {
                    throw new Error(data.error || 'Erreur lors de l\'envoi');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                
                // Afficher un message d'erreur
                showNotificationMessage('error', error.message || 'Erreur lors de l\'envoi des notifications');
                
                // Restaurer le lien
                this.innerHTML = originalText;
                this.style.pointerEvents = 'auto';
            });
        });
    }
});

// Fonction pour afficher les messages de notification
function showNotificationMessage(type, message) {
    // Créer un élément de message temporaire
    const messageDiv = document.createElement('div');
    messageDiv.className = `notification-message ${type}`;
    messageDiv.style.position = 'fixed';
    messageDiv.style.top = '100px';
    messageDiv.style.right = '20px';
    messageDiv.style.zIndex = '10000';
    messageDiv.style.minWidth = '300px';
    messageDiv.style.padding = '15px';
    messageDiv.style.borderRadius = '10px';
    messageDiv.style.color = 'white';
    messageDiv.style.fontWeight = 'bold';
    messageDiv.style.animation = 'slideInRight 0.3s ease-out';
    
    if (type === 'success') {
        messageDiv.style.background = 'linear-gradient(135deg, #4caf50, #45a049)';
        messageDiv.style.boxShadow = '0 4px 15px rgba(76, 175, 80, 0.3)';
    } else {
        messageDiv.style.background = 'linear-gradient(135deg, #f44336, #d32f2f)';
        messageDiv.style.boxShadow = '0 4px 15px rgba(244, 67, 54, 0.3)';
    }
    
    const icon = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
    messageDiv.innerHTML = `<i class="${icon}"></i> ${message}`;
    
    document.body.appendChild(messageDiv);
    
    // Supprimer le message après 5 secondes
    setTimeout(() => {
        messageDiv.style.animation = 'slideOutRight 0.3s ease-out';
        setTimeout(() => {
            if (messageDiv.parentNode) {
                messageDiv.parentNode.removeChild(messageDiv);
            }
        }, 300);
    }, 5000);
}

// Ajouter les styles CSS pour les animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .notification-message i {
        margin-right: 10px;
    }
`;
document.head.appendChild(style); 