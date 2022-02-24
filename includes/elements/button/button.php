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
        return esc_html__( 'Button', 'easy-addons' );
    }

    public function get_icon() {
        return 'eicon-button ea-addons-icon';
    }

    public function get_categories() {
        return [ 'easy-addons-category' ];
    }

    private function ea_button_content() {
        $this->start_controls_section( 'ea_button',
            [
                'label' => __( 'Button', 'easy-addons' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control( 'button_text',
            [
                'label'       => __( 'Button Text', 'easy-addons' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Button', 'easy-addons' ),
                'placeholder' => __( 'Type your title here', 'easy-addons' ),
            ]
        );

        $this->end_controls_section();

    }

    protected function _register_controls() {
        $this->ea_button_content();
    }


    protected function render( ) {
        $settings = $this->get_settings_for_display();

        ?>

        <a href=""><?php echo $settings['button_text'] ?></a>

    <?php }

}


Plugin::instance()->widgets_manager->register_widget_type( new ea_default_button() );