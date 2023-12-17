<?php

function ekhos_character_add($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_characters';
    $body_params = $request->get_body_params();
    $name = isset($body_params['name']) ? $body_params['name'] : '';
    $sound = isset($body_params['sound']) ? $body_params['sound'] : '';

    if($sound == 'null') {
        $sound = null;
    }

    $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'sound' => $sound
        ),
        array(
            '%s',
            '%s'
        )
    );

    return new WP_REST_Response(array(
        'status' => 'success',
    ), 200);
}

function ekhos_character_update($request) {
    $body_params = $request->get_body_params();

//    return new WP_Error('no_post', 'Article non trouvé', array('status' => 404));
    return new WP_REST_Response(array(
        'status' => 'success',
    ), 200);
}

function ekhos_character_delete($request) {
    $body_params = $request->get_body_params();

//    return new WP_Error('no_post', 'Article non trouvé', array('status' => 404));
    return new WP_REST_Response(array(
        'status' => 'success',
    ), 200);
}

function ekhos_character_list($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_characters';
    $body_params = $request->get_body_params();
    $items = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}$table_name");

    return new WP_REST_Response(array(
        'status' => 'success',
        'items' => $items
    ), 200);
}