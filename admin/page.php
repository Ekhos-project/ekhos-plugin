<?php

function ekhos_ids_settings_page()
{
    // Vérifiez les droits de l'utilisateur
    if (!current_user_can('manage_options')) {
        wp_die(__('Vous n’avez pas les droits suffisants pour accéder à cette page.'));
    }

    // Contenu de la page de paramètres
    echo '<div class="wrap">';
    echo '<h1>Ekhos IDS Settings</h1>';
    // Ici, ajoutez des formulaires et des options pour les paramètres de votre plugin
    echo '</div>';
    global $wpdb;
    $sounds = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ekhos_ids_sounds");

    foreach ($sounds as $sound) {
        echo "<div>{$sound->title} - <audio controls src='{$sound->sound_url}'></audio> - <a href='?delete_sound={$sound->id}'>Supprimer</a></div>";
    }

    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Titre du son" required>
        <input type="file" name="sound_file" required>
        <input type="submit" name="upload_sound" value="Upload">
    </form>

    <?php

    if (isset($_POST['upload_sound']) && current_user_can('manage_options')) {

        $table_name = $wpdb->prefix . 'ekhos_ids_sounds';

        // Vérifiez le nonce pour la sécurité
        check_admin_referer('ekhos_ids_upload_sound_action', 'ekhos_ids_upload_sound_nonce');

        // Obtenez le titre du son
        $title = sanitize_text_field($_POST['title']);

        // Gérez l'upload du fichier
        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        $uploadedfile = $_FILES['sound_file'];
        $upload_overrides = array('test_form' => false);

        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            // Fichier uploadé avec succès
            $sound_url = $movefile['url'];

            // Enregistrez les données en base de données
            $wpdb->insert(
                $table_name,
                array(
                    'title' => $title,
                    'sound_url' => $sound_url
                ),
                array(
                    '%s',
                    '%s'
                )
            );
            echo "Le son a été uploadé et enregistré avec succès.";
        } else {
            // Erreur lors de l'upload
            echo $movefile['error'];
        }
    }
}
