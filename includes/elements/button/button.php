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
                'label' => __( 'Button Content', 'easy-addons' ),
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

    // EA Button style
    private function ea_button_style() {
        $this->start_controls_section( 'ea_button_style',
            [
                'label' => __( 'Button Style', 'easy-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        /* Start Tab */
        $this->start_controls_tabs('ea_btn_tab',
            [
                'separator' => 'before'
            ]
        );
        // normal tab
        $this->start_controls_tab('ea_btn_normal',
            [
                'label' => __( 'Normal', 'easy-addons' ),
            ]
        );
        $this->add_control('ea_btn_clr',
            [
                'label'     => __( 'Color', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ea-button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'ea_btn_bg',
                'label'    => __( 'Background', 'easy-addons' ),
                'types'    => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .ea-button',
            ]
        );
        $this->end_controls_tab();

        // hover tab
        $this->start_controls_tab( 'ea_btn_hover',
            [
                'label' => __( 'Hover', 'easy-addons' ),
            ]
        );
        $this->add_control('ea_btn_clr_hv',
            [
                'label'     => __( 'Color', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000',
                'selectors' => [
                    '{{WRAPPER}} .ea-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'ea_btn_bg_hv',
                'label'    => __( 'Background', 'easy-addons' ),
                'types'    => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .ea-button:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        // end tab

        $this->end_controls_section();
    }

    protected function _register_controls() {
        $this->ea_button_content();
        $this->ea_button_style();
    }


    protected function render( ) {
        $settings = $this->get_settings_for_display();

        ?>

        <a href="" class="ea-button"><?php echo $settings['button_text'] ?></a>

    <?php }

}


Plugin::instance()->widgets_manager->register_widget_type( new ea_default_button() );