<?php

/*
	UA Enqueue Assets
*/
function ea_enqueue_assets() {
    $is_component_active = ea_elementor_activated_modules();
    // stylesheet
    wp_enqueue_style(
        'mukta-fonts',
        '//fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap'
    );
    wp_enqueue_style(
        'bootstrap-css',
        EASY_ADDONS_DIR_URL.'assets/frontend/css/bootstrap/css/index.min.css'
    );
    wp_enqueue_style(
        'lib-lineawesome-css',
        '//maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css'
    );
    wp_enqueue_style(
        'theme-main-css',
        EASY_ADDONS_DIR_URL.'assets/css/main.css',
        '',
        EASY_ADDONS_VERSION
    );

    // Script
    wp_enqueue_script(
        'popper-min-js',
        EASY_ADDONS_DIR_URL.'assets/frontend/css/bootstrap/js/popper.min.js',
        array('jquery'),
        '1.0.0'
    );
    wp_enqueue_script(
        'bootstrap-min-js',
        EASY_ADDONS_DIR_URL.'assets/frontend/css/bootstrap/js/index.min.js',
        array('jquery'),
        '1.0.0'
    );
//    wp_enqueue_script(
//        'ea-elementor-js',
//        EASY_ADDONS_DIR_URL.'assets/js/UA-elementor.js',
//        '',
//        EASY_ADDONS_VERSION
//    );

//    $ajax_url = (function_exists('edd_get_ajax_url')) ? edd_get_ajax_url() : admin_url( 'admin-ajax.php' );
//    wp_localize_script(
//        'ea-elementor-js',
//        'ea_main_ajax',
//        array(
//            'ajaxurl' => $ajax_url,
//            'nonce'   => wp_create_nonce('UA_Elementor_js'),
//        )
//    );
}
add_action('wp_enqueue_scripts', 'ea_enqueue_assets');


// register editor stylesheet
function enqueue_editor_styles() {
    wp_enqueue_style(
        'editor_style',
        EASY_ADDONS_DIR_URL . 'assets/css/editor.css',
        false,
        EASY_ADDONS_VERSION
    );
}
add_action('elementor/editor/before_enqueue_scripts', 'enqueue_editor_styles');






