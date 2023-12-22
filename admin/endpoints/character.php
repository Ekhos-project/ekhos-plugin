<?php

function ekhos_character_add($request)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_characters';
    $body_params = $request->get_body_params();
    $name = isset($body_params['name']) ? $body_params['name'] : '';
    $sound = isset($body_params['sound']) ? $body_params['sound'] : '';

    if ($sound == 'null') {
        $sound = null;
    }

    $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'sound_id' => $sound
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

function ekhos_character_update($request)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_characters';
    $id = $request->get_param('id');
    $body_params = $request->get_body_params();
    $name = isset($body_params['name']) ? $body_params['name'] : '';
    $sound = isset($body_params['sound']) ? $body_params['sound'] : '';

    if ($sound == 'null') {
        $sound = null;
    }

    $wpdb->update(
        $table_name,
        array(
            'name' => $name,
            'sound_id' => $sound
        ),
        array('id' => $id),
        array(
            '%s',
            '%s'
        ),
        array('%d')
    );

    return new WP_REST_Response(array(
        'status' => 'success',
        'id' => $id
    ), 200);
}

function ekhos_character_delete($request)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_characters';
    $body_params = $request->get_body_params();
    $id = isset($body_params['id']) ? $body_params['id'] : '';
    $wpdb->delete($table_name, array('id' => $id), array('%d'));

    return new WP_REST_Response(array(
        'status' => 'success',
        'id'=>$id
    ), 200);
}


function ekhos_character_sound_list($request)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_characters';
    $body_params = $request->get_body_params();
    $items = $wpdb->get_results("SELECT * FROM {$table_name}");

    return new WP_REST_Response(array(
        'status' => 'success',
        'items' => $items
    ), 200);
}


function ekhos_character_list($request)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_characters';
    $body_params = $request->get_body_params();
    $items = $wpdb->get_results("SELECT * FROM {$table_name}");
    $html = "";

    foreach ($items as $item) {
        $sound = "<button class='starticon idscharacter_item_sound_add'></button>";
        if(isset($item->sound_id)) {
            $sound_table_name = $wpdb->prefix . 'ekhos_ids_sounds';
            $sound_query = $wpdb->prepare("SELECT * FROM $sound_table_name WHERE id = %d", $item->sound_id);
            $sound_row = $wpdb->get_row($sound_query);
            $sound = "<audio controls src='".$sound_row->sound_url."'></audio><button class='starticon idscharacter_item_sound_delete'></button>";
        }
        $html .= "
        <div class='idscharacter_item' data-name='idscharacter_item' data-enpoint='character' data-id='".$item->id."' data-value='".$item->name."' data-sound='".$item->sound_id."'>
            <div class='idscharacter_item_id'>
                <span>".$item->id."</span>
            </div>
            <div class='idscharacter_item_name'>
                <span>".$item->name."</span>
            </div>
            <div class='idscharacter_item_sound'>"
            .$sound.
            "</div>
            <div class='idscharacter_item_actions'>
                <button class='starticon idscharacter_item_edit'></button>
                <button class='starticon idscharacter_item_delete'></button>
            </div>
        </div>
        ";
    }

    return new WP_REST_Response(array(
        'status' => 'success',
        'html' => $html
    ), 200);
}