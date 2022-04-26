<?php
namespace Elementor;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
	exit;
}

class ea_flip_card extends Widget_Base {
	public function get_name() {
		return 'flip-card';
	}

	public function get_title() {
		return esc_html__( 'Flip Card', 'easy-addons' );
	}

	public function get_icon() {
		return 'eicon-flip-box ea-addons-icon';
	}

	public function get_categories() {
		return [ 'easy-addons-category' ];
	}

	private function flip_card_front_content() {
		$this->start_controls_section( 'flip_card_front_content',
			[
				'label' => __( 'Front', 'easy-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control( 'flip_card_front_image_show',
            [
                'label'        => __( 'Show Image', 'easy-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'easy-addons' ),
                'label_off'    => __( 'Hide', 'easy-addons' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
		$this->add_control( 'flip_card_front_image',
			[
				'label' => __( 'Choose Image', 'easy-addons' ),
				'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'flip_card_front_image_show' => 'yes'
                ]
			]
		);
		$this->add_control( 'flip_card_front_title',
			[
				'label'       => __( 'Title', 'easy-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Front', 'easy-addons' ),
				'placeholder' => __( 'Type your title here', 'easy-addons' ),
			]
		);
		$this->add_control( 'flip_card_front_stitle',
			[
				'label'       => __( 'Sub Title', 'easy-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Designation', 'easy-addons' ),
				'placeholder' => __( 'Type your sub title here', 'easy-addons' ),
			]
		);
		$this->end_controls_section();
    }
	private function flip_card_back_content() {
		$this->start_controls_section( 'flip_card_back_content',
			[
				'label' => __( 'Back', 'easy-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control( 'flip_card_back_image_show',
            [
                'label'        => __( 'Show Image', 'easy-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'easy-addons' ),
                'label_off'    => __( 'Hide', 'easy-addons' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
		$this->add_control( 'flip_card_back_image',
			[
				'label' => __( 'Choose Image', 'easy-addons' ),
				'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'flip_card_back_image_show' => 'yes'
                ]
			]
		);
        $this->add_control( 'flip_card_back_title',
            [
                'label'       => __( 'Title', 'easy-addons' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Back', 'easy-addons' ),
                'placeholder' => __( 'Type your title here', 'easy-addons' ),
            ]
        );
        $this->add_control( 'flip_card_back_stitle',
            [
                'label'       => __( 'Sub Title', 'easy-addons' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Designation', 'easy-addons' ),
                'placeholder' => __( 'Type your sub title here', 'easy-addons' ),
            ]
        );
		$this->end_controls_section();
	}
	private function flip_card_front_title_style() {
		$this->start_controls_section( 'flip_card_front_title_style',
			[
				'label' => __( 'Front - Title', 'easy-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control( 'flip_card_front_title_clr',
			[
				'label'     => __( 'Color', 'easy-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ea-flip-card-item .front h3' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control( Group_Control_Typography::get_type(),
			[
				'name'     => 'flip_card_front_title_typography',
				'label'    => __( 'Typography', 'easy-addons' ),
				'selector' => '{{WRAPPER}} .ea-flip-card-item .front h3',
			]
		);
		$this->add_responsive_control( 'flip_card_front_title_pd',
			[
				'label'      => __( 'Padding', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-flip-card-item .front h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control( 'flip_card_front_title_mg',
			[
				'label'      => __( 'Margin', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-flip-card-item .front h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}
	private function flip_card_front_stitle_style() {
		$this->start_controls_section( 'flip_card_front_stitle_style',
			[
				'label' => __( 'Front - Sub Title', 'easy-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control( 'flip_card_front_stitle_clr',
			[
				'label'     => __( 'Color', 'easy-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ea-flip-card-item .front p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control( Group_Control_Typography::get_type(),
			[
				'name'     => 'flip_card_front_stitle_typography',
				'label'    => __( 'Typography', 'easy-addons' ),
				'selector' => '{{WRAPPER}} .ea-flip-card-item .front p',
			]
		);
		$this->add_responsive_control( 'flip_card_front_stitle_pd',
			[
				'label'      => __( 'Padding', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-flip-card-item .front p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control( 'flip_card_front_stitle_mg',
			[
				'label'      => __( 'Margin', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-flip-card-item .front p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}
    private function flip_card_front_img_style()
    {
        $this->start_controls_section('flip_card_front_img_style',
            [
                'label' => __('Front - Image', 'easy-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control('flip_card_front_img_opacity',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__( 'Opacity', 'easy-addons' ),
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => 0.1
                    ],
                ],
                'default' => [
                    'size' => 0.4
                ],
                'selectors' => [
                    '{{WRAPPER}} .ea-flip-card-item .front img' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }


    private function flip_card_back_title_style() {
        $this->start_controls_section( 'flip_card_back_title_style',
            [
                'label' => __( 'Back - Title', 'easy-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control( 'flip_card_back_title_clr',
            [
                'label'     => __( 'Color', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ea-flip-card-item .back h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control( Group_Control_Typography::get_type(),
            [
                'name'     => 'flip_card_back_title_typography',
                'label'    => __( 'Typography', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-flip-card-item .back h3',
            ]
        );
        $this->add_responsive_control( 'flip_card_back_title_pd',
            [
                'label'      => __( 'Padding', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-flip-card-item .back h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control( 'flip_card_back_title_mg',
            [
                'label'      => __( 'Margin', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-flip-card-item .back h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    private function flip_card_back_stitle_style() {
        $this->start_controls_section( 'flip_card_back_stitle_style',
            [
                'label' => __( 'Back - Sub Title', 'easy-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control( 'flip_card_back_stitle_clr',
            [
                'label'     => __( 'Color', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f7f7f7',
                'selectors' => [
                    '{{WRAPPER}} .ea-flip-card-item .back p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control( Group_Control_Typography::get_type(),
            [
                'name'     => 'flip_card_back_stitle_typography',
                'label'    => __( 'Typography', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-flip-card-item .back p',
            ]
        );
        $this->add_responsive_control( 'flip_card_back_stitle_pd',
            [
                'label'      => __( 'Padding', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-flip-card-item .back p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control( 'flip_card_back_stitle_mg',
            [
                'label'      => __( 'Margin', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-flip-card-item .back p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    private function flip_card_back_img_style()
    {
        $this->start_controls_section('flip_card_back_img_style',
            [
                'label' => __('Back - Image', 'easy-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control('flip_card_back_img_opacity',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => esc_html__( 'Opacity', 'easy-addons' ),
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => 0.1
                    ],
                ],
                'default' => [
                    'size' => 0.4
                ],
                'selectors' => [
                    '{{WRAPPER}} .ea-flip-card-item .back img' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

	private function flip_card_box_style() {
		$this->start_controls_section( 'flip_card_box_style',
			[
				'label' => __( 'Box', 'easy-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control( 'flip_card_box_width',
			[
				'label'      => __( 'Height', 'easy-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 300,
				],
				'selectors' => [
					'{{WRAPPER}} .ea-flip-card-item' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control( 'flip_card_box_height',
			[
				'label'      => __( 'Height', 'easy-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 300,
				],
				'selectors' => [
					'{{WRAPPER}} .ea-flip-card-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		/* ---------------------------
		    Start Tab
		-----------------------------*/
		$this->start_controls_tabs( 'flip_card_box_tab',
			[
				'separator' => 'before',
			]
		);
        // normal tab
        $this->start_controls_tab( 'flip_card_box_nrml',
            [
                'label'     => __( 'Normal', 'easy-addons' ),
            ]
        );
        $this->add_group_control( Group_Control_Border::get_type(),
            [
                'name'     => 'flip_card_box_border',
                'label'    => __( 'Border', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-flip-card-item .ea-flip-card-inner',
            ]
        );
		$this->add_responsive_control( 'flip_card_box_radius',
			[
				'label'      => __( 'Border Radius', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-flip-card-item .ea-flip-card-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ea-flip-card-item .ea-flip-card-inner .back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ea-flip-card-item .ea-flip-card-inner .front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control( Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'flip_card_box_shadow',
				'label'    => __( 'Box Shadow', 'easy-addons' ),
				'fields_options' => [
					'box_shadow_type' => [
						'default'     =>'yes'
					],
					'box_shadow'  => [
						'default' => [
							'horizontal' => 0,
							'vertical'   => 4,
							'blur'       => 8,
							'spread'     => 0,
							'color'      => 'rgba(0, 0, 0, 0.10)'
						]
					]
				],
				'selector' => '{{WRAPPER}} .ea-flip-card-item .ea-flip-card-inner',
			]
		);
        $this->end_controls_tab();
        // hover tab
        $this->start_controls_tab( 'flip_card_box_hv',
            [
                'label'     => __( 'Hover', 'easy-addons' ),
            ]
        );

        $this->add_group_control( Group_Control_Border::get_type(),
            [
                'name'     => 'flip_card_box_border_hv',
                'label'    => __( 'Border', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-flip-card-item .ea-flip-card-inner:hover',
            ]
        );
        $this->add_responsive_control( 'flip_card_box_radius_hv',
            [
                'label'      => __( 'Border Radius', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-flip-card-item .ea-flip-card-inner:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ea-flip-card-item  .ea-flip-card-inner:hover .back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ea-flip-card-item  .ea-flip-card-inner:hover .front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'flip_card_box_shadow_hv',
                'label'    => __( 'Box Shadow', 'easy-addons' ),
                'fields_options' => [
                    'box_shadow_type' => [
                        'default'     =>'yes'
                    ],
                    'box_shadow'  => [
                        'default' => [
                            'horizontal' => 0,
                            'vertical'   => 4,
                            'blur'       => 8,
                            'spread'     => 0,
                            'color'      => 'rgba(0, 0, 0, 0.10)'
                        ]
                    ]
                ],
                'selector' => '{{WRAPPER}} .ea-flip-card-item .ea-flip-card-inner:hover',
            ]
        );
        $this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}


	protected function _register_controls() {
		$this->flip_card_front_content();
		$this->flip_card_back_content();
		$this->flip_card_front_title_style();
		$this->flip_card_front_stitle_style();
        $this->flip_card_front_img_style();

        $this->flip_card_back_title_style();
        $this->flip_card_back_stitle_style();
        $this->flip_card_back_img_style();

		$this->flip_card_box_style();

	}


	protected function render( ) {
		$settings = $this->get_settings_for_display();


		?>
        <div class="ea-flip-card-item">
            <div class="ea-flip-card-inner">
                <div class="front">
                    <?php if($settings['flip_card_front_image_show'] === 'yes') { ?>
                        <img src="<?php echo esc_url($settings['flip_card_front_image']['url']); ?>" alt="<?php esc_attr_e('Flip Image', 'easy-addons'); ?>">
                    <?php } ?>
                    <div class="ua-flip-card-content text-center position-absolute d-flex align-items-center justify-content-center flex-wrap flex-column">
                        <?php if(!empty($settings['flip_card_front_title'])) { ?>
                            <h3 class="transition-all-3s">
                                <?php echo esc_html($settings['flip_card_front_title']); ?>
                            </h3>
                        <?php } if(!empty($settings['flip_card_front_stitle'])) { ?>
                            <p class="transition-all-3s">
                                <?php echo esc_html($settings['flip_card_front_stitle']); ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>

                <div class="back">
                    <?php if($settings['flip_card_back_image_show'] === 'yes') { ?>
                        <img src="<?php echo esc_url($settings['flip_card_back_image']['url']); ?>" alt="<?php esc_attr_e('Flip Image', 'easy-addons'); ?>">
                    <?php } ?>
                    <div class="ua-flip-card-content text-center position-absolute d-flex align-items-center justify-content-center flex-wrap flex-column">
                        <?php if(!empty($settings['flip_card_back_title'])) { ?>
                            <h3 class="transition-all-3s">
                                <?php echo esc_html($settings['flip_card_back_title']); ?>
                            </h3>
                        <?php } if(!empty($settings['flip_card_back_stitle'])) { ?>
                            <p class="transition-all-3s">
                                <?php echo esc_html($settings['flip_card_back_stitle']); ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}

}
Plugin::instance()->widgets_manager->register_widget_type( new ea_flip_card() );