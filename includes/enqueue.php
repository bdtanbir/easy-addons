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
        'bootstrap-min-css',
        EASY_ADDONS_DIR_URL.'assets/frontend/css/bootstrap/css/bootstrap.min.css'
    );
    
    wp_enqueue_style(
        'ea-main-css',
        EASY_ADDONS_DIR_URL.'assets/css/main.css'
    );

    // Script
    wp_enqueue_script(
        'bootstrap-min-js',
        EASY_ADDONS_DIR_URL.'assets/frontend/css/bootstrap/js/index.min.js',
        array('jquery'),
        EASY_ADDONS_VERSION,
        true
    );
}
add_action('wp_enqueue_scripts', 'ea_enqueue_assets');


// register editor stylesheet
function enqueue_editor_styles() {
    wp_enqueue_style(
        'editor_style',
        EASY_ADDONS_DIR_URL . 'assets/css/editor.css'
    );
}
add_action('elementor/editor/before_enqueue_scripts', 'enqueue_editor_styles');






