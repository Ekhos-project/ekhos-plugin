<?php

add_action('admin_menu', 'ekhos_ids_add_to_menu');

function ekhos_ids_add_to_menu() {
    add_management_page(
        'Ekhos IDS', // Titre de la page
        'Ekhos IDS', // Titre du menu
        'manage_options', // Capacité requise pour voir ce menu
        'ekhos-ids', // Slug du menu
        'ekhos_ids_settings_page' // Fonction pour afficher le contenu de la page de paramètres
    );
}
