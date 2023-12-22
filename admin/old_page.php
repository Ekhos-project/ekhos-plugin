<?php

function ekhos_ids_settings_page()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('Vous n’avez pas les droits suffisants pour accéder à cette page.'));
    }

    echo '<div class="wrap">';
    echo '<h1>Ekhos IDS Settings</h1>';
    echo '</div>';
    global $wpdb;
    $sounds = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ekhos_ids_sounds");

    foreach ($sounds as $sound) {
        $delete_url = wp_nonce_url(admin_url('tools.php?page=ekhos-ids&delete_sound=' . $sound->id), 'ekhos_ids_delete_sound_' . $sound->id);
        echo "<div>{$sound->title} - <audio controls src='{$sound->sound_url}'></audio> - <a href='{$delete_url}'>Supprimer</a></div>";
    }

    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <?php wp_nonce_field('ekhos_ids_upload_sound_action', 'ekhos_ids_upload_sound_nonce'); ?>
        <input type="text" name="title" placeholder="Titre du son" required>
        <input type="file" name="sound_file" required>
        <input type="submit" name="upload_sound" value="Upload">
    </form>

    <?php

    if (isset($_GET['delete_sound']) && current_user_can('manage_options')) {
        $sound_id = intval($_GET['delete_sound']);
        $table_name = $wpdb->prefix . 'ekhos_ids_sounds';
        $sound = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $sound_id));
        if ($sound) {
            $file_path = str_replace(content_url(), WP_CONTENT_DIR, $sound->sound_url);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $wpdb->delete($table_name, array('id' => $sound_id), array('%d'));
        }

        wp_redirect(admin_url('tools.php?page=ekhos-ids'));
        exit;
    }

    if (isset($_POST['upload_sound']) && current_user_can('manage_options')) {

        $table_name = $wpdb->prefix . 'ekhos_ids_sounds';
        check_admin_referer('ekhos_ids_upload_sound_action', 'ekhos_ids_upload_sound_nonce');
        $title = sanitize_text_field($_POST['title']);
        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        $uploadedfile = $_FILES['sound_file'];
        $upload_overrides = array('test_form' => false);

        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            $sound_url = $movefile['url'];
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
            echo $movefile['error'];
        }
    }
}
