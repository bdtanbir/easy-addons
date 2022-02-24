<?php
namespace Elementor;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

class ea_default_button extends Widget_Base {
    public function get_name() {
        return 'button';
    }

    public function get_title() {
        return esc_html__( 'Button', 'easy-addonsf' );
    }

    public function get_icon() {
        return 'eicon-button ea-addons-icon';
    }

    public function get_categories() {
        return [ 'easy-addons-category' ];
    }


    protected function _register_controls() {

    }


    protected function render( ) {
//        $settings = $this->get_settings_for_display();

        ?>

        <a href="">EasyAddons Button</a>

    <?php }

}


Plugin::instance()->widgets_manager->register_widget_type( new ea_default_button() );