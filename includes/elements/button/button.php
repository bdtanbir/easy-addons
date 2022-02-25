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
        $this->add_control( 'ea_button_url',
            [
                'label'         => __( 'Button URl', 'easy-addons' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => __( 'https://your-link.com', 'easy-addons' ),
                'show_external' => true,
                'default'       => [
                    'url'         => '',
                    'is_external' => true,
                    'nofollow'    => true,
                ],
            ]
        );
        $this->add_control( 'ea_button_icon_show',
            [
                'label'        => __( 'Show Button\'s Icon', 'easy-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'easy-addons' ),
                'label_off'    => __( 'Hide', 'easy-addons' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $this->add_control('ea_button_icon',
            [
                'label'            => __( 'Button Icon', 'easy-addons' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block'      => true,
                'default'          => [
                    'value'   => 'fa fa-arrow-right',
                    'library' => 'recommended',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'play',
                        'angle-right',
                        'angle-left',
                        'arrow-alt-circle-down',
                        'arrow-alt-circle-up',
                        'arrow-alt-circle-left',
                        'arrow-alt-circle-right',
                        'arrow-circle-down',
                        'arrow-circle-up',
                        'arrow-circle-left',
                        'arrow-circle-right',
                        'arrow-down',
                        'arrow-up',
                        'arrow-left',
                        'arrow-right',
                        'arrows-alt',
                        'arrows-alt-h',
                        'arrows-alt-v',
                        'cart-arrow-down',
                        'compress-arrows-alt',
                        'expand-rows-alt',
                        'location-arrow',
                        'long-arrow-alt-down',
                        'long-arrow-alt-up',
                        'long-arrow-alt-left',
                        'long-arrow-alt-right',
                    ],
                ],
                'condition' => [
                    'ea_button_icon_show' => 'yes',
                ]
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
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'ea_btn_border',
                'label'    => esc_html__( 'Border', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-button',
                'fields_options'  => [
                    'border'      => [
                        'default' => 'solid',
                    ],
                    'width'       => [
                        'default' => [
                            'top'      => '1',
                            'right'    => '1',
                            'bottom'   => '1',
                            'left'     => '1',
                            'isLinked' => true,
                        ],
                    ],
                    'color' => [
                        'default' => '#F66B5D',
                    ],
                ],
            ]
        );
        $this->add_responsive_control('ea_button_radius',
            [
                'label'      => __( 'Border Radius', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '4',
                    'right'    => '4',
                    'bottom'   => '4',
                    'left'     => '4',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ea-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'ea_button_shadow',
                'label'    => __( 'Box Shadow', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-button'
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
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'ea_btn_border_hv',
                'label'    => esc_html__( 'Border', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-button:hover'
            ]
        );
        $this->add_responsive_control('ea_button_radius_hv',
            [
                'label'      => __( 'Border Radius', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '4',
                    'right'    => '4',
                    'bottom'   => '4',
                    'left'     => '4',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ea-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'ea_button_shadow_hv',
                'label'    => __( 'Box Shadow', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-button:hover',
                'fields_options' => [
                    'box_shadow_type' => [
                        'default'     =>'yes'
                    ],
                    'box_shadow'  => [
                        'default' => [
                            'horizontal' => 0,
                            'vertical'   => 0,
                            'blur'       => 10.53,
                            'spread'     => 2.47,
                            'color'      => 'rgba(0, 0, 0, 0.05)'
                        ]
                    ]
                ],
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

        $target   = $settings['ea_button_url']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['ea_button_url']['nofollow'] ? ' rel="nofollow"' : '';
        ?>

        <a href="<?php echo esc_url($settings['ea_button_url']['url']) ?>" <?php echo $target . ' ' . $nofollow; ?> class="ea-button">
            <?php
            if ($settings['ea_button_icon_show'] == 'yes') {
                Icons_Manager::render_icon($settings['ea_button_icon'], ['class' => 'ea-button-icon', ' aria-hidden' => 'true']);
            }
            echo esc_html($settings['button_text']); ?>
        </a>

    <?php }

}


Plugin::instance()->widgets_manager->register_widget_type( new ea_default_button() );