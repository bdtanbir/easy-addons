<?php
function ea_elementor_add_elements() {

    $is_component_active = ea_elementor_activated_modules();

    // load elements
    if( $is_component_active['button'] ) {
        require_once EASY_ADDONS_DIR_PATH . 'includes/elements/button/button.php';
    }
    if( $is_component_active['flip-card'] ) {
        require_once EASY_ADDONS_DIR_PATH . 'includes/elements/flip-card/flip-card.php';
    }
}
add_action('elementor/widgets/widgets_registered','ea_elementor_add_elements');