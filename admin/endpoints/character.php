<?php

function ekhos_character_add($request) {
    $body_params = $request->get_body_params();

//    return new WP_Error('no_post', 'Article non trouvé', array('status' => 404));
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
    $body_params = $request->get_body_params();

//    return new WP_Error('no_post', 'Article non trouvé', array('status' => 404));
    return new WP_REST_Response(array(
        'status' => 'success',
    ), 200);
}