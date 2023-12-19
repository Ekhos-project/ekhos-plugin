<?php

function ekhos_linked_add($request)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_linkeds';
    $body_params = $request->get_body_params();
    $page = isset($body_params['page']) ? $body_params['page'] : '';
    $sound = isset($body_params['sound']) ? $body_params['sound'] : '';
    $selector = isset($body_params['selector']) ? $body_params['selector'] : '';

    if ($sound == 'null') {
        $sound = null;
    }
    if ($page == 'null') {
        $page = null;
    }

    $wpdb->insert(
        $table_name,
        array(
            'selector' => $selector,
            'page_url' => $page,
            'sound_id' => $sound
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


function ekhos_linked_sound_list($request)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_sounds';
    $body_params = $request->get_body_params();
    $items = $wpdb->get_results("SELECT * FROM {$table_name}");

    foreach ($items as $item)
    {
        $character_table_name = $wpdb->prefix . 'ekhos_ids_characters';
        $character_query = $wpdb->prepare("SELECT * FROM $character_table_name WHERE id = %d", $item->character_id);
        $character_row = $wpdb->get_row($character_query);
        $character_name = isset($character_row->name) ? $character_row->name : '';
        $item->character_name = $character_name;
    }

    return new WP_REST_Response(array(
        'status' => 'success',
        'items' => $items
    ), 200);
}


function ekhos_linked_page_list($request) {
    $post_types = get_post_types(array('public' => true), 'names');
    $args = array(
        'post_type' => $post_types,
        'posts_per_page' => -1,
    );
    $query = new WP_Query($args);
    $items = array();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $items[] = array(
                'name' => get_the_title(),
                'url' => get_permalink()
            );
        }
    }

    wp_reset_postdata();

    return new WP_REST_Response(array(
        'status' => 'success',
        'items' => $items
    ), 200);
}


function find_post_by_url($url) {
    $post_id = url_to_postid($url);

    if ($post_id) {
        $post = get_post($post_id);
        return $post;
    } else {
        return null;
    }
}


function ekhos_linked_list($request)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ekhos_ids_linkeds';
    $body_params = $request->get_body_params();
    $items = $wpdb->get_results("SELECT * FROM {$table_name}");
    $html = "";

    foreach ($items as $item) {
        $sound_table_name = $wpdb->prefix . 'ekhos_ids_sounds';
        $sound_query = $wpdb->prepare("SELECT * FROM $sound_table_name WHERE id = %d", $item->sound_id);
        $sound_row = $wpdb->get_row($sound_query);
        $sound_name = isset($sound_row->name) ? $sound_row->name : '';
        $sound_character_id = isset($sound_row->character_id) ? $sound_row->character_id : '';
        $sound_sound_url = isset($sound_row->sound_url) ? $sound_row->sound_url : '';
        $character_table_name = $wpdb->prefix . 'ekhos_ids_characters';
        $character_query = $wpdb->prepare("SELECT * FROM $character_table_name WHERE id = %d", $sound_character_id);
        $character_row = $wpdb->get_row($character_query);
        $character_name = isset($character_row->name) ? $character_row->name : '';
        $page = find_post_by_url($item->page_url);
        $page_name = $page ? $page->post_title : '';
        $html .= "
        <div class='idslinked_item' data-name='idslinked_item' data-enpoint='linked' data-id='".$item->id."' data-sound='".$item->sound_id."' data-page='".$item->page_url."' data-selector='".$item->selector."'>
             <a href='".$item->page_url."' target='_blank' class='idslinked_item_section'>
                <small>".$page_name."</small>
                <span>".$item->selector."</span>
            </a>
            <div class='idslinked_item_character'>
                <small>".$character_name."</small>
                <span>".$sound_name."</span>

            </div>
            <div class='idslinked_item_audio'>
                <audio controls src='".$sound_sound_url."'></audio>
            </div>
            <div class='idslinked_item_actions'>
                <button class='starticon idslinked_item_edit'></button>
                <button class='starticon idslinked_item_delete'></button>
            </div>
        </div>
        ";
    }

    return new WP_REST_Response(array(
        'status' => 'success',
        'html' => $html
    ), 200);
}
