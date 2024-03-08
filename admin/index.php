<?php

add_action('admin_menu', 'ekhos_ids_add_to_menu');

function ekhos_ids_add_to_menu() {
    add_management_page(
        'Ekhos IDS',
        'Ekhos IDS',
        'manage_options',
        'ekhos-ids',
        'ekhos_ids_settings_page'
    );
}

add_action('admin_enqueue_scripts', function ($hook_suffix) {
    // Vérifier si nous sommes sur la page spécifique de votre plugin
    if (isset($_GET['page']) && $_GET['page'] === 'ekhos-ids') {
        // Exemple de désenregistrement d'un style spécifique
        wp_deregister_style('le-nom-du-handle-du-style');

        // Vous pourriez également vouloir enregistrer et ajouter vos propres styles ici
        // wp_enqueue_style('mon-style-personnalise', plugins_url('chemin/vers/mon-style.css', __FILE__));
    }
});
