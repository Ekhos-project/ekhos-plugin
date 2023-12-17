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
            'sound' => $sound
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

function ekhos_character_list($request)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_characters';
    $body_params = $request->get_body_params();
    $items = $wpdb->get_results("SELECT * FROM {$table_name}");
    $html = "";

    foreach ($items as $item) {
        $sound = "<button class='starticon idscharacter_item_sound_add'></button>";
        if(isset($item->sound)) {
            $sound = "<audio controls src=''></audio><button class='starticon idscharacter_item_sound_delete'></button>";
        }
        $html .= "
        <div class='idscharacter_item' data-name='idscharacter_item' data-enpoint='character' data-id='".$item->id."' data-name='".$item->name."' data-sound='".$item->sound."'>
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