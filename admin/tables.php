<?php

function ekhos_characters_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_characters';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name tinytext NOT NULL,
        sound mediumint(9) DEFAULT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(EKHOS_DIR, 'ekhos_characters_table');