<?php
namespace Elementor;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

class eaTimeline extends Widget_Base {
    public function get_name() {
        return 'ea-timeline';
    }

    public function get_title() {
        return esc_html__( 'Timeline', 'easy-addons' );
    }

    public function get_icon() {
        return 'eicon-flow ea-addons-icon';
    }

    public function get_categories() {
        return [ 'easy-addons-category' ];
    }

	public function get_keywords()
	{
        return [
			'timeline',
			'time line',
			'ea timeline',
			'ea time line',
			'diagram',
			'ea',
			'easy addons'
		];
    }

    public static function get_post_types()
    {
        $post_types = get_post_types(['public' => true, 'show_in_nav_menus' => true], 'objects');
        $post_types = wp_list_pluck($post_types, 'label', 'name');
        return array_diff_key($post_types, ['elementor_library', 'attachment']);
    }

    private function getTimelineContent() {
        $this->start_controls_section('getTimelineContent', [
            'label' => __('Timeline Content', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control('content_source',
            [
                'label'   => esc_html__( 'Content Source', 'easy-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'dynamic',
                'options' => [
                    'custom'  => esc_html__( 'Custom', 'easy-addons' ),
                    'dynamic' => esc_html__( 'Dynamic', 'easy-addons' ),
                ],
            ]
        );
        $this->end_controls_section();
    }

    /* Dynamic Content Settings */
    private function dynamicContentSettings() {
        $this->start_controls_section('getDynamicContentSettings', [
            'label'     => __('Dynamic Content Settings', 'easy-addons'),
            'tab'       => Controls_Manager::TAB_CONTENT,
            'condition' => [
                'content_source' => 'dynamic'
            ]
        ]);
        $this->add_control('source',
            [
                'label'   => esc_html__( 'Source', 'easy-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => ['post'],
                'options' => $this->get_post_types(),
            ]
        );
        $this->add_control('post_per_page',
            [
                'label'   => esc_html__( 'Posts Per Page', 'easy-addons' ),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 20,
                'step'    => 1,
                'default' => 4,
            ]
        );
        $this->add_control('excerpt_length',
            [
                'label'   => esc_html__( 'Excerpt Length', 'easy-addons' ),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 200,
                'step'    => 1,
                'default' => 20,
            ]
        );
        $this->add_control( 'orderby',
            [
                'label'             => __( 'Order By', 'easy-addons' ),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'date',
                'options'           => [
                    'ID'            => __('Post ID', 'easy-addons'),
                    'author'        => __('Post Author', 'easy-addons'),
                    'title'         => __('Title', 'easy-addons'),
                    'date'          => __('Date', 'easy-addons'),
                    'modified'      => __('Last Modified Date', 'easy-addons'),
                    'parent'        => __('Parent Id', 'easy-addons'),
                    'rand'          => __('Random', 'easy-addons'),
                    'comment_count' => __('Comment Count', 'easy-addons'),
                    'menu_order'    => __('Menu Order', 'easy-addons'),
                ],
            ]
        );
        $this->add_control( 'order',
            [
                'label'    => __('Order', 'easy-addons'),
                'type'     => Controls_Manager::SELECT,
                'options'  => [
                    'asc'  => 'Ascending',
                    'desc' => 'Descending',
                ],
                'default'  => 'desc',
            ]
        );
        $this->add_control('button_text',
			[
				'label'       => esc_html__( 'Button Text', 'easy-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Learn More', 'easy-addons' ),
				'placeholder' => esc_html__( 'Type your button text here', 'easy-addons' ),
			]
		);
        $this->add_control('excerpt_more',
			[
				'label'       => esc_html__( 'Excerpt More Text', 'easy-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '...', 'easy-addons' ),
				'placeholder' => esc_html__( 'Type excerpt more text here', 'easy-addons' ),
			]
		);
        $this->end_controls_section();
    }

    /* Custom Content Settings */
    private function customContentSettings() {
        $this->start_controls_section('getCustomContentSettings', [
            'label'     => __('Custom Content Settings', 'easy-addons'),
            'tab'       => Controls_Manager::TAB_CONTENT,
            'condition' => [
                'content_source' => 'custom'
            ]
        ]);

        $repeater = new Repeater();

        $repeater->add_control('title', [
                'label'       => esc_html__( 'Title', 'easy-addons' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Easy addons for elementor' , 'easy-addons' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control('content', [
                'label'      => esc_html__( 'Content', 'easy-addons' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => esc_html__( 'A new concept of showing content in your web page with more interactive way.' , 'easy-addons' ),
                'show_label' => false,
            ]
        );
        $repeater->add_control('post_date', [
                'label'       => esc_html__( 'Post Date', 'easy-addons' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( '23 Jan, 2022' , 'easy-addons' ),
                'label_block' => false,
            ]
        );
        $repeater->add_control('button_text', [
                'label'       => esc_html__( 'Button Text', 'easy-addons' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Learn More' , 'easy-addons' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control('button_url',
			[
				'label'       => esc_html__( 'Button URL', 'easy-addons' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'easy-addons' ),
				'options'     => [ 'url', 'is_external', 'nofollow' ],
				'default'     => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'label_block' => true,
			]
		);
        $this->add_control('timelines',
            [
                'label'   => '',
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'title'     => esc_html__( 'Easy addons for elementor', 'easy-addons' ),
                        'content'   => esc_html__( 'A new concept of showing content in your web page with more interactive way.', 'easy-addons' ),
                        'post_date' => esc_html__('23 Jan, 2022')
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }


    /* Style */
    private function getTitleStyle() {
        $this->start_controls_section('getTitleStyle', [
            'label' => __('Title', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('title_color',
			[
				'label'     => esc_html__( 'Color', 'easy-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content h2' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content h2',
			]
		);
        $this->add_responsive_control('title_margin',
			[
				'label'      => esc_html__( 'Margin', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
    }
    private function getContentStyle() {
        $this->start_controls_section('getContentStyle', [
            'label' => __('Content', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('content_color',
            [
                'label'     => esc_html__( 'Color', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#6c727c',
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content p',
            ]
        );
        $this->add_responsive_control('content_margin',
            [
                'label'      => esc_html__( 'Margin', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    private function getButtonStyle()
    {
        $this->start_controls_section('getButtonStyle', [
            'label' => __('Button', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control( 'button_width',
            [
                'label'      => __( 'Width', 'easy-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'  => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control( 'button_height',
            [
                'label'      => __( 'Height', 'easy-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'  => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => __( 'Typography', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button',
            ]
        );

        /* Start Tab */
        $this->start_controls_tabs('button_tab',
            [
                'separator' => 'before'
            ]
        );
        // normal tab
        $this->start_controls_tab('button_normal',
            [
                'label' => __( 'Normal', 'easy-addons' ),
            ]
        );
        $this->add_control('button_color',
            [
                'label'     => __( 'Color', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control('button_bg',
            [
                'label'     => __( 'Background', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#8f42ec',
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'label'    => esc_html__( 'Border', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button',
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
                        'default' => '#8f42ec',
                    ],
                ],
            ]
        );
        $this->add_responsive_control('button_radius',
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
                    '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_shadow',
                'label'    => __( 'Box Shadow', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button'
            ]
        );
        $this->add_responsive_control( 'button_padding',
            [
                'label'      => __( 'Padding', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => '7',
                    'right'  => '18',
                    'bottom' => '7',
                    'left'   => '18',
                    'unit'   => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control( 'button_margin',
            [
                'label'      => __( 'Margin', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // hover tab
        $this->start_controls_tab( 'button_hover',
            [
                'label' => __( 'Hover', 'easy-addons' ),
            ]
        );
        $this->add_control('button_color_hover',
            [
                'label'     => __( 'Color', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#8f42ec',
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control('button_bg_hover',
            [
                'label'     => __( 'Background', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button:hover' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Border::get_type(),
            [
                'name'     => 'button_border_hover',
                'label'    => esc_html__( 'Border', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button:hover',
            ]
        );
        $this->add_responsive_control('button_radius_hv',
            [
                'label'      => __( 'Border Radius', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_shadow_hover',
                'label'    => __( 'Box Shadow', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button:hover'
            ]
        );
        $this->add_responsive_control( 'button_padding_hover',
            [
                'label'      => __( 'Padding', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control( 'button_margin_hover',
            [
                'label'      => __( 'Margin', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-inner .el-timeline-content .ea-button:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        /* end tab */

        $this->end_controls_section();
    }
    private function getDateStyle()
    {
        $this->start_controls_section('getDateStyle', [
            'label' => __('Date', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(),
            [
                'name'     => 'date_typography',
                'selector' => '{{WRAPPER}} .ea-timeline .el-timeline-column .el-timeline-content time',
            ]
        );
        $this->add_control('date_color',
            [
                'label'     => esc_html__( 'Color', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-column .el-timeline-content time' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control('date_bg',
            [
                'label'     => esc_html__( 'Background', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#8f42ec',
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-column .el-timeline-content time' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'date_shadow',
                'label'    => __( 'Box Shadow', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-timeline .el-timeline-column .el-timeline-content time',
                'fields_options' => [
                    'box_shadow_type' => [
                        'default'     =>'yes'
                    ],
                    'box_shadow'  => [
                        'default' => [
                            'horizontal' => 0,
                            'vertical'   => 0,
                            'blur'       => 10,
                            'spread'     => 0,
                            'color'      => 'rgb(143 66 236 / 33%)'
                        ]
                    ]
                ],
            ]
        );
        $this->add_responsive_control('date_padding',
            [
                'label'      => esc_html__( 'Padding', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => '3',
                    'right'  => '8',
                    'bottom' => '3',
                    'left'   => '8',
                    'unit'   => 'px',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-column .el-timeline-content time' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    private function getShapeStyle()
    {
        $this->start_controls_section('getShapeStyle', [
            'label' => __('Shape Circle/Line', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('circle_more_option',
            [
                'label'     => esc_html__( 'Circle', 'easy-addons' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control('circle_bg',
            [
                'label'     => esc_html__( 'Background', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-column:after' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control('circle_bg_hover',
            [
                'label'     => esc_html__( 'Background Hover', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#8f42ec',
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-column:hover:after' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control('line_more_option',
            [
                'label'     => esc_html__( 'Line', 'easy-addons' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control('line_color',
            [
                'label'     => esc_html__( 'Color', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f0e3ff',
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-column:before' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .ea-timeline .el-timeline-column:after' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }
    private function getBoxStyle()
    {
        $this->start_controls_section('getBoxStyle', [
            'label' => __('Box', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        /* Start Tab */
        $this->start_controls_tabs('box_tab',
            [
                'separator' => 'before'
            ]
        );
        // normal tab
        $this->start_controls_tab('box_normal',
            [
                'label' => __( 'Normal', 'easy-addons' ),
            ]
        );
        $this->add_control('box_bg',
            [
                'label'     => __( 'Background', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-column .el-timeline-inner' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .ea-timeline .el-timeline-column .el-timeline-inner:before' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => esc_html__( 'Border', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-timeline .el-timeline-column .el-timeline-inner, {{WRAPPER}} .ea-timeline .el-timeline-column .el-timeline-inner:before',
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
                        'default' => '#eee',
                    ],
                ],
            ]
        );
        $this->add_responsive_control('box_radius',
            [
                'label'      => __( 'Border Radius', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '8',
                    'right'    => '8',
                    'bottom'   => '8',
                    'left'     => '8',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-column .el-timeline-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => __( 'Box Shadow', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-timeline .el-timeline-column .el-timeline-inner',
            ]
        );
        $this->add_responsive_control('box_padding',
            [
                'label'      => esc_html__( 'Padding', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => '25',
                    'right'  => '30',
                    'bottom' => '30',
                    'left'   => '30',
                    'unit'   => 'px',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-column .el-timeline-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        // hover tab
        $this->start_controls_tab( 'box_hover',
            [
                'label' => __( 'Hover', 'easy-addons' ),
            ]
        );
        $this->add_control('box_bg_hover',
            [
                'label'     => __( 'Background', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-column:hover .el-timeline-inner' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .ea-timeline .el-timeline-column:hover .el-timeline-inner:before' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Border::get_type(),
            [
                'name'     => 'box_border_hv',
                'label'    => esc_html__( 'Border', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-timeline .el-timeline-column:hover .el-timeline-inner, {{WRAPPER}} .ea-timeline .el-timeline-column:hover .el-timeline-inner:before',
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
                        'default' => '#8f42ec',
                    ],
                ],
            ]
        );
        $this->add_responsive_control('box_radius_hv',
            [
                'label'      => __( 'Border Radius', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-column:hover .el-timeline-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow_hv',
                'label'    => __( 'Box Shadow', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-timeline .el-timeline-column:hover .el-timeline-inner',
                'fields_options' => [
                    'box_shadow_type' => [
                        'default'     =>'yes'
                    ],
                    'box_shadow'  => [
                        'default' => [
                            'horizontal' => 0,
                            'vertical'   => 0,
                            'blur'       => 30,
                            'spread'     => 0,
                            'color'      => 'rgb(0 0 0 / 8%)'
                        ]
                    ]
                ],
            ]
        );
        $this->add_responsive_control('box_padding_hv',
            [
                'label'      => esc_html__( 'Padding', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-timeline .el-timeline-column:hover .el-timeline-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        /* end tab */

        $this->end_controls_section();
    }




    protected function register_controls() {
        $this->getTimelineContent();
        $this->dynamicContentSettings();
        $this->customContentSettings();


        $this->getTitleStyle();
        $this->getContentStyle();
        $this->getButtonStyle();
        $this->getDateStyle();
        $this->getShapeStyle();
        $this->getBoxStyle();

    }

    protected function render( ) {
        $settings      = $this->get_settings_for_display();
        $source        = $settings['source'];
        $post_per_page = $settings['post_per_page'];
        $orderby       = $settings['orderby'];
        $order         = $settings['order'];

        $default = [
            'posts_per_page' => $post_per_page ? $post_per_page : -1,
            'post_type'      => $source ? $source : 'posts',
            'orderBy'        => $orderby,
            'order'          => $order,
        ];
        $posts = new \WP_Query($default)
        ?>
            <div class="ea-timeline-container">
                <div class="ea-timeline d-grid w-full flex-wrap">

                    <?php
                    if ($settings['content_source'] == 'dynamic') {
                        while ($posts->have_posts()) { $posts->the_post();
                    ?>
                        <div class="el-timeline-column position-relative">
                            <div class="el-timeline-inner position-relative">
                                <div class="el-timeline-content">
                                    <time><?php the_time( get_option( 'date_format' ) ); ?></time>
                                    <?php if(!empty(get_the_title())) { ?>
                                        <h2><?php the_title(); ?></h2>
                                    <?php } if (!empty(get_the_excerpt())) { ?>
                                        <p><?php echo wp_trim_words(get_the_excerpt(), $settings['excerpt_length'], $settings['excerpt_more']); ?></p>
                                    <?php } if ( !empty($settings['button_text'])) { ?>
                                        <a href="<?php the_permalink(); ?>" class="ea-button"><?php echo esc_html($settings['button_text']); ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php }
                    wp_reset_query();
                    } else {
                        foreach ($settings['timelines'] as $timeline) {

                            $target   = $timeline['button_url']['is_external'] ? ' target=_blank' : '';
                            $nofollow = $timeline['button_url']['nofollow'] ? ' rel=nofollow' : '';

                        ?>
                        <div class="el-timeline-column position-relative">
                            <div class="el-timeline-inner position-relative">
                                <div class="el-timeline-content">
                                    <?php if (!empty($timeline['post_date'])) { ?>
                                    <time><?php echo esc_html($timeline['post_date']); ?></time>
                                    <?php } if (!empty($timeline['title'])) { ?>
                                        <h2><?php echo esc_html($timeline['title']); ?></h2>
                                    <?php } if (!empty($timeline['content'])) { ?>
                                        <p><?php echo esc_html($timeline['content']); ?></p>
                                    <?php } if ( !empty($timeline['button_text'] ) ) { ?>
                                        <a href="<?php echo esc_url($timeline['button_url']['url']); ?>" <?php echo esc_attr($target) . ' ' . esc_attr($nofollow); ?> class="ea-button"><?php echo esc_html($timeline['button_text']); ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    }
                    ?>

                </div>
            </div>
        <?php
    }

}
Plugin::instance()->widgets_manager->register( new eaTimeline() );