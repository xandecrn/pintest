<?php

function fifu_enable_fake_api(WP_REST_Request $request) {
    update_option('fifu_data_generation', 'toggleoff');
    fifu_enable_fake2();
}

function fifu_disable_fake_api(WP_REST_Request $request) {
    fifu_disable_fake2();
}

function fifu_none_fake_api(WP_REST_Request $request) {
    update_option('fifu_fake_created', null, 'no');
}

function fifu_data_clean_api(WP_REST_Request $request) {
    fifu_db_enable_clean();
    update_option('fifu_data_clean', 'toggleoff', 'no');

    fifu_disable_fake(); // fake1
    update_option('fifu_data_generation', 'toggleoff', 'no');
}

function fifu_save_dimensions_all_api(WP_REST_Request $request) {
    update_option('fifu_save_dimensions_all', 'toggleoff', 'no');

    if (fifu_is_off('fifu_save_dimensions'))
        return;

    fifu_db_save_dimensions_all();
}

function fifu_test_execution_time() {
    for ($i = 0; $i <= 120; $i++) {
        error_log($i);
        sleep(1);
    }
}

add_action('rest_api_init', function () {
    register_rest_route('featured-image-from-url/v2', '/enable_fake_api/', array(
        'methods' => 'POST',
        'callback' => 'fifu_enable_fake_api'
    ));
    register_rest_route('featured-image-from-url/v2', '/disable_fake_api/', array(
        'methods' => 'POST',
        'callback' => 'fifu_disable_fake_api'
    ));
    register_rest_route('featured-image-from-url/v2', '/none_fake_api/', array(
        'methods' => 'POST',
        'callback' => 'fifu_none_fake_api'
    ));
    register_rest_route('featured-image-from-url/v2', '/data_clean_api/', array(
        'methods' => 'POST',
        'callback' => 'fifu_data_clean_api'
    ));
    register_rest_route('featured-image-from-url/v2', '/save_dimensions_all_api/', array(
        'methods' => 'POST',
        'callback' => 'fifu_save_dimensions_all_api'
    ));
});

