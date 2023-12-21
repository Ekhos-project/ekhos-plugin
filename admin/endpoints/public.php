<?php

function find_post_by_url_public($url)
{
    $post_id = url_to_postid($url);

    if ($post_id) {
        $post = get_post($post_id);
        return $post;
    } else {
        return null;
    }
}

function ekhos_audio_list($request)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_linkeds';
    $params = $request->get_body();
    $params = json_decode($params, true);
    $page_url = isset($params['page']) ? $params['page'] : '';
    $items = $wpdb->get_results("SELECT * FROM {$table_name}");

    foreach ($items as $item) {
        $sound_table_name = $wpdb->prefix . 'ekhos_ids_sounds';
        $sound_query = $wpdb->prepare("SELECT * FROM $sound_table_name WHERE id = %d", $item->sound_id);
        $sound_row = $wpdb->get_row($sound_query);
        $sound_name = isset($sound_row->name) ? $sound_row->name : '';
        $sound_character_id = isset($sound_row->character_id) ? $sound_row->character_id : '';
        $sound_sound_url = isset($sound_row->sound_url) ? $sound_row->sound_url : '';
        $item_page = find_post_by_url_public($item->page_url);
        $current_page = find_post_by_url_public($page_url);
        $item->sound = $sound_sound_url;
        if ($item_page and $current_page and $item_page->ID == $current_page->ID) {
            $item->current = true;
        } else {
            $item->current = false;
        }
    }

    return new WP_REST_Response(array(
        'status' => 'success',
        'items' => $items,
        'page' => $page_url,
    ), 200);
}
