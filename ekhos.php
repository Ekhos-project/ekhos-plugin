<?php
/*
Plugin Name: Ekhos Sound Design
Description: Sound manager for your website
Version: 1.0
Author: Ekhos
*/

function ekhos_ids_create_sounds_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_sounds';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        title varchar(255) NOT NULL,
        sound_url varchar(255) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

register_activation_hook(__FILE__, 'ekhos_ids_create_sounds_table');


foreach (glob(plugin_dir_path(__FILE__) . 'admin/*.php') as $file) {
    include_once $file;
}
