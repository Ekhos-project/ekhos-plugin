<?php

function ekhos_sound_add($request)
{
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_sounds';
    $body_params = $request->get_body_params();
    $character = isset($body_params['character']) ? $body_params['character'] : '';
    $name = isset($body_params['name']) ? $body_params['name'] : '';
    $files = $request->get_file_params();
    $upload_overrides = array('test_form' => false);

    $movefile = wp_handle_upload($files['file__audio'], $upload_overrides);

    if ($character == 'null') {
        $character = null;
    }
    if($movefile && !isset($movefile['error'])) {
        $wpdb->insert(
            $table_name,
            array(
                'name' => $name,
                'character_id' => $character,
                'sound_url' => $movefile['url']
            ),
            array(
                '%s',
                '%s',
                '%s'
            )
        );

        return new WP_REST_Response(array(
            'status' => 'success',
        ), 200);
    }


    return new WP_REST_Response(array(
        'status' => 'error',
        'error' => $movefile['error']
    ), 200);
}


function ekhos_sound_update($request) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_sounds';
    $id = $request->get_param('id');

    $body_params = $request->get_body_params();
    $character = isset($body_params['character']) ? $body_params['character'] : '';
    $name = isset($body_params['name']) ? $body_params['name'] : '';
    $files = $request->get_file_params();
    $upload_overrides = array('test_form' => false);

    if ($character == 'null') {
        $character = null;
    }

    if (!empty($files['file__audio'])) {
        $movefile = wp_handle_upload($files['file__audio'], $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            $data = array(
                'name' => $name,
                'character_id' => $character,
                'sound_url' => $movefile['url']
            );
            $data_format = array('%s', '%d', '%s');
        } else {
            return new WP_REST_Response(array(
                'status' => 'error',
                'error' => $movefile['error']
            ), 200);
        }
    } else {
        $data = array(
            'name' => $name,
            'character_id' => $character
        );
        $data_format = array('%s', '%d');
    }

    $wpdb->update($table_name, $data, array('id' => $id), $data_format, array('%d'));

    return new WP_REST_Response(array(
        'status' => 'success',
        'id' => $id
    ), 200);
}


function ekhos_sound_delete($request)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_sounds';
    $body_params = $request->get_body_params();
    $id = isset($body_params['id']) ? $body_params['id'] : '';
    $sound = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id));

    if ($sound) {
        $file_path = str_replace(content_url(), WP_CONTENT_DIR, $sound->sound_url);
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $wpdb->delete($table_name, array('id' => $id), array('%d'));
    }

    return new WP_REST_Response(array(
        'status' => 'success',
        'id'=>$id
    ), 200);
}


function ekhos_sound_character_list($request)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_sounds';
    $body_params = $request->get_body_params();
    $items = $wpdb->get_results("SELECT * FROM {$table_name}");

    return new WP_REST_Response(array(
        'status' => 'success',
        'items' => $items
    ), 200);
}


function ekhos_sound_list($request)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_sounds';
    $body_params = $request->get_body_params();
    $items = $wpdb->get_results("SELECT * FROM {$table_name}");
    $html = "";

    foreach ($items as $item) {
        $character_table_name = $wpdb->prefix . 'ekhos_ids_characters';
        $character_query = $wpdb->prepare("SELECT * FROM $character_table_name WHERE id = %d", $item->character_id);
        $character_row = $wpdb->get_row($character_query);
        $character_name = $character_row->name;
        $html .= "
        <div class='idssound_item' data-name='idssound_item' data-enpoint='sound' data-id='".$item->id."' data-value='".$item->name."' data-character='".$item->character_id."' data-sound='".$item->sound_url."'>
            <div class='idssound_item_id'>
                <span>".$item->id."</span>
            </div>
            <div class='idssound_item_character'>
                <span>".$character_name."</span>
            </div>
            <div class='idssound_item_name'>
                <span>".$item->name."</span>
            </div>
            <div class='idssound_item_audio'>
                <audio controls src='".$item->sound_url."'></audio>
            </div>
            <div class='idssound_item_actions'>
                <button class='starticon idssound_item_edit'></button>
                <button class='starticon idssound_item_delete'></button>
            </div>
        </div>
        ";
    }

    return new WP_REST_Response(array(
        'status' => 'success',
        'html' => $html
    ), 200);
}
