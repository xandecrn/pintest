<?php

add_action('add_meta_boxes', 'fifu_insert_meta_box');

function fifu_insert_meta_box() {
    $post_types = fifu_get_post_types();

    foreach ($post_types as $post_type) {
        if ($post_type == 'product') {
            add_meta_box('urlMetaBox', 'Product Image from URL', 'fifu_show_elements', $post_type, 'side', 'low');
        } else if ($post_type)
            add_meta_box('imageUrlMetaBox', 'Featured Image from URL', 'fifu_show_elements', $post_type, 'side', 'low');
    }
}

add_action('add_meta_boxes', 'fifu_add_css');

function fifu_add_css() {
    wp_register_style('featured-image-from-url', plugins_url('/html/css/editor.css', __FILE__));
    wp_enqueue_style('featured-image-from-url');
}

function fifu_show_elements($post) {
    $margin = 'margin-top:10px;';
    $width = 'width:100%;';
    $height = 'height:200px;';
    $align = 'text-align:left;';
    $show_news = 'display:inline';

    $url = get_post_meta($post->ID, 'fifu_image_url', true);
    $alt = get_post_meta($post->ID, 'fifu_image_alt', true);

    if ($url) {
        $show_button = 'display:none;';
        $show_alt = $show_image = $show_link = '';
    } else {
        $show_alt = $show_image = $show_link = 'display:none;';
        $show_button = '';
    }

    $show_ignore = fifu_is_on('fifu_get_first') || fifu_is_on('fifu_pop_first') || fifu_is_on('fifu_ovw_first') ? '' : 'display:none;';

    include 'html/meta-box.html';
}

add_filter('wp_insert_post_data', 'fifu_remove_first_image', 10, 2);

function fifu_remove_first_image($data, $postarr) {
    /* invalid or external or ignore */
    if (!$_POST || !isset($_POST['fifu_input_url']) || isset($_POST['fifu_ignore_auto_set']))
        return $data;

    $content = $postarr['post_content'];
    if (!$content)
        return $data;

    $contentClean = fifu_show_all_images($content);
    $data = str_replace($content, $contentClean, $data);

    $img = fifu_first_img_in_content($contentClean);
    if (!$img)
        return $data;

    if (fifu_is_off('fifu_pop_first'))
        return str_replace($img, fifu_show_media($img), $data);

    return str_replace($img, fifu_hide_media($img), $data);
}

add_action('save_post', 'fifu_save_properties');

function fifu_save_properties($post_id) {
    if (!$_POST || get_post_type($post_id) == 'nav_menu_item')
        return;

    $ignore = false;
    if (isset($_POST['fifu_ignore_auto_set']))
        $ignore = $_POST['fifu_ignore_auto_set'] == 'on';

    /* image url */
    $url = null;
    if (isset($_POST['fifu_input_url'])) {
        $url = esc_url_raw($_POST['fifu_input_url']);
        if (!$ignore) {
            $first = fifu_first_url_in_content($post_id);
            if ($first && fifu_is_on('fifu_get_first') && (!$url || fifu_is_on('fifu_ovw_first')))
                $url = $first;
        }
        fifu_update_or_delete($post_id, 'fifu_image_url', $url);
    }

    /* image url from wcfm */
    if (!$url && fifu_is_wcfm_activate() && isset($_POST['wcfm_products_manage_form'])) {
        $url = esc_url_raw(fifu_get_wcfm_url($_POST['wcfm_products_manage_form']));
        if ($url)
            fifu_update_or_delete($post_id, 'fifu_image_url', $url);
    }

    /* alt */
    if (isset($_POST['fifu_input_alt'])) {
        $alt = wp_strip_all_tags($_POST['fifu_input_alt']);
        $alt = !$alt && $url && fifu_is_on('fifu_auto_alt') ? get_the_title() : $alt;
        fifu_update_or_delete_value($post_id, 'fifu_image_alt', $alt);
    }

    fifu_save($post_id);
}

function fifu_save($post_id) {
    fifu_update_fake_attach_id($post_id);
}

function fifu_update_or_delete($post_id, $field, $url) {
    if ($url) {
        update_post_meta($post_id, $field, fifu_convert($url));
    } else
        delete_post_meta($post_id, $field, $url);
}

function fifu_update_or_delete_value($post_id, $field, $value) {
    if ($value)
        update_post_meta($post_id, $field, $value);
    else
        delete_post_meta($post_id, $field, $value);
}

add_action('pmxi_saved_post', 'fifu_wai_save');

function fifu_wai_save($post_id) {
    $url = get_post_meta($post_id, 'fifu_image_url', true);
    fifu_update_or_delete($post_id, 'fifu_image_url', $url);
    fifu_save($post_id);
}

function fifu_save_dimensions($post_id, $url) {
    $size = getimagesize($url);
    if ($size) {
        $width = $size[0];
        $height = $size[1];
        if ($width && $height)
            fifu_update_or_delete_value($post_id, 'fifu_image_dimension', $width . ';' . $height);
    }
}

add_action('before_delete_post', 'fifu_db_before_delete_post');

/* regular woocommerce import */

add_action('woocommerce_product_import_inserted_product_object', 'fifu_woocommerce_import');

function fifu_woocommerce_import($object) {
    $post_id = $object->get_id();
    fifu_wai_save($post_id);
    fifu_update_fake_attach_id($post_id);
}

/* wcfm */

function fifu_is_wcfm_activate() {
    return is_plugin_active('wc-frontend-manager/wc_frontend_manager.php');
}

function fifu_get_wcfm_url($content) {
    $url = explode('fifu_image_url=', $content)[1];
    return $url ? urldecode(explode('&', $url)[0]) : null;
}

