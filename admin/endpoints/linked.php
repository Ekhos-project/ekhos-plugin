<?php

function ekhos_get_post($request) {
    $body_params = $request->get_body_params();
    $page = isset($body_params['page']) ? $body_params['page'] : '';
    $section = isset($body_params['section']) ? $body_params['section'] : '';
    $sound = isset($body_params['sound']) ? $body_params['sound'] : '';

//    return new WP_Error('no_post', 'Article non trouvé', array('status' => 404));
    return new WP_REST_Response(array(
        'status' => 'success',
    ), 200);
}
