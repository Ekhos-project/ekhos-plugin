<?php

include_once "character.php";
include_once "sound.php";
include_once "linked.php";

function ekhos_register_endpoints() {
    /* Character */
    register_rest_route('ekhos', '/character/add', array(
        'methods' => 'POST',
        'callback' => 'ekhos_character_add'
    ));
    register_rest_route('ekhos', '/character/update/(?P<id>\d+)', array(
        'methods' => 'POST',
        'callback' => 'ekhos_character_update'
    ));
    register_rest_route('ekhos', '/character/delete', array(
        'methods' => 'POST',
        'callback' => 'ekhos_character_delete'
    ));
    register_rest_route('ekhos', '/character/sound-list', array(
        'methods' => 'POST',
        'callback' => 'ekhos_character_sound_list'
    ));
    register_rest_route('ekhos', '/character/list', array(
        'methods' => 'POST',
        'callback' => 'ekhos_character_list'
    ));

    /* Sound */
    register_rest_route('ekhos', '/sound/add', array(
        'methods' => 'POST',
        'callback' => 'ekhos_sound_add'
    ));
    register_rest_route('ekhos', '/sound/update/(?P<id>\d+)', array(
        'methods' => 'POST',
        'callback' => 'ekhos_sound_update'
    ));
    register_rest_route('ekhos', '/sound/delete', array(
        'methods' => 'POST',
        'callback' => 'ekhos_sound_delete'
    ));
    register_rest_route('ekhos', '/sound/character-list', array(
        'methods' => 'POST',
        'callback' => 'ekhos_sound_character_list'
    ));
    register_rest_route('ekhos', '/sound/list', array(
        'methods' => 'POST',
        'callback' => 'ekhos_sound_list'
    ));

    /* Linked */

    /* Settings */
}

add_action('rest_api_init', 'ekhos_register_endpoints');