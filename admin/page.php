<?php

function ekhos_ids_settings_page() {
    // Vérifiez les droits de l'utilisateur
    if (!current_user_can('manage_options')) {
        wp_die(__('Vous n’avez pas les droits suffisants pour accéder à cette page.'));
    }

    // Contenu de la page de paramètres
    echo '<div class="wrap">';
    echo '<h1>Ekhos IDS Settings</h1>';
    // Ici, ajoutez des formulaires et des options pour les paramètres de votre plugin
    echo '</div>';
}
