<?php
namespace Elementor;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
	exit;
}

class ea_team extends Widget_Base {
	public function get_name() {
		return 'ea-team';
	}

	public function get_title() {
		return esc_html__( 'Team', 'easy-addons' );
	}

	public function get_icon() {
		return 'eicon-person ea-addons-icon';
	}

	public function get_categories() {
		return [ 'easy-addons-category' ];
	}

	public function get_keywords()
	{
        return [
			'team',
			'member',
			'team member',
			'ea team member',
			'ea team members',
			'person',
			'card',
			'meet the team',
			'team builder',
			'our team',
			'ea',
			'easy addons'
		];
    }


    private function getContent() {

        $this->start_controls_section('ea_team_member_content', [
            'label' => __('Content', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_CONTENT
        ]);
		$this->add_control( 'team_member_image',
			[
				'label'   => __( 'Image', 'easy-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);
        $this->add_control( 'team_member_name',
            [
                'label'       => __( 'Name', 'easy-addons' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'John Doe', 'easy-addons' ),
                'placeholder' => __( 'Type your name here', 'easy-addons' ),
            ]
        );
        $this->add_control( 'team_member_designation',
            [
                'label'       => __( 'Designation', 'easy-addons' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Software Engineer', 'easy-addons' ),
                'placeholder' => __( 'Type your designation here', 'easy-addons' ),
            ]
        );

        $repeater = new Repeater();
		$repeater->add_control('team_member_social_icon',
			[
				'label'    => esc_html__( 'Icon', 'easy-addons' ),
				'type'     => Controls_Manager::ICONS,
				'default'  => [
					'value'   => 'fab fa-facebook-f',
					'library' => 'fa-brand',
				],
			]
		);
        $repeater->add_control('team_member_social_icon_url',
			[
				'label' => esc_html__( 'Link', 'easy-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'easy-addons' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true
				],
				'label_block' => true,
			]
		);

        $this->add_control('team_member_social_lists',
			[
				'label'   => esc_html__( 'Social Icons', 'easy-addons' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'team_member_social_icon' => 'fab fa-facebook-f'
					]
				],
				'title_field' => '<i class="{{ team_member_social_icon.value }}"></i>',
			]
		);

        $this->end_controls_section();
    }
    private function getOptions() {

        $this->start_controls_section('ea_team_member_options', [
            'label' => __('Options', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_CONTENT
        ]);
        $this->add_control('ea_team_member_box_style',
			[
				'label'   => esc_html__( 'Style', 'easy-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'simple',
				'options' => [
					'simple'  => esc_html__( 'Simple', 'easy-addons' ),
					'style-2' => esc_html__( 'Style 2', 'easy-addons' ),
				],
			]
		);
		$this->add_control('ea_team_member_alignment',
			[
				'label' => esc_html__( 'Set Alignment', 'easy-addons'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'default' => [
						'title' => __( 'Default', 'easy-addons'),
						'icon' => 'fa fa-ban',
					],
					'left' => [
						'title' => esc_html__( 'Left', 'easy-addons'),
						'icon' => 'eicon-text-align-left',
					],
					'centered' => [
						'title' => esc_html__( 'Center', 'easy-addons'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'easy-addons'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'default'
			]
		);
        
        $this->end_controls_section();
    }

    private function getImageStyle() {
        $this->start_controls_section('ea_team_member_img_style', [
            'label' => __('Image', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_responsive_control('ea_team_member_img_width',
			[
				'label'      => esc_html__( 'Width', 'easy-addons' ),
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
					]
				],
				'selectors' => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control('ea_team_member_img_height',
			[
				'label'      => esc_html__( 'Height', 'easy-addons' ),
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
					]
				],
				'selectors' => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control('ea_team_member_margin',
			[
				'label'      => esc_html__( 'Margin', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control('ea_team_member_padding',
			[
				'label'      => esc_html__( 'Padding', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(Group_Control_Border::get_type(),
			[
				'name'     => 'ea_team_member_border',
				'label'    => esc_html__( 'Border', 'easy-addons' ),
				'selector' => '{{WRAPPER}} .ea-team-item .ea-team-member-image',
			]
		);
        $this->add_responsive_control('ea_team_member_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
    }

    private function getContentBoxStyle() {
        $this->start_controls_section('ea_team_member_content_box_style', [
            'label' => __('Content Box', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_group_control(Group_Control_Background::get_type(),
			[
				'name'     => 'ea_team_member_content_box_bg',
				'label'    => esc_html__( 'Background', 'easy-addons' ),
				'types'    => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .ea-team-item .ea-team-member-content',
			]
		);
        $this->add_responsive_control('ea_team_member_content_box_margin',
			[
				'label'      => esc_html__( 'Margin', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control('ea_team_member_content_box_padding',
			[
				'label'      => esc_html__( 'Padding', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(Group_Control_Border::get_type(),
			[
				'name'     => 'ea_team_member_content_box_border',
				'label'    => esc_html__( 'Border', 'easy-addons' ),
				'selector' => '{{WRAPPER}} .ea-team-item .ea-team-member-content',
			]
		);
        $this->add_responsive_control('ea_team_member_content_box_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
    }
    private function getNameStyle() {
        $this->start_controls_section('ea_team_member_name_style', [
            'label' => __('Name', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_control('ea_team_member_name_clr',
			[
				'label'     => esc_html__( 'Color', 'easy-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-content h1' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control('ea_team_member_name_clr_hv',
			[
				'label'     => esc_html__( 'Hover Color', 'easy-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ea-team-item:hover .ea-team-member-content h1' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(Group_Control_Typography::get_type(),
			[
				'name'     => 'ea_team_member_name_typography',
				'selector' => '{{WRAPPER}} .ea-team-item .ea-team-member-content h1',
			]
		);
        $this->add_responsive_control('ea_team_member_name_margin',
			[
				'label'      => esc_html__( 'Margin', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => '0',
                    'right'  => '0',
                    'bottom' => '2',
                    'left'   => '0',
                    'unit'   => 'px',
                    'isLinked' => false,
                ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-content h1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
    }
    private function getDesignationStyle() {
        $this->start_controls_section('ea_team_member_designation_style', [
            'label' => __('Designation', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_control('ea_team_member_designation_clr',
			[
				'label'     => esc_html__( 'Color', 'easy-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-content p' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control('ea_team_member_designation_clr_hv',
			[
				'label'     => esc_html__( 'Hover Color', 'easy-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ea-team-item:hover .ea-team-member-content p' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(Group_Control_Typography::get_type(),
			[
				'name'     => 'ea_team_member_designation_typography',
				'selector' => '{{WRAPPER}} .ea-team-item .ea-team-member-content p',
			]
		);
        $this->add_responsive_control('ea_team_member_designation_margin',
			[
				'label'      => esc_html__( 'Margin', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
    }
    private function getSocialProfileStyle() {
        $this->start_controls_section('ea_team_member_social_profile_style', [
            'label' => __('Social Profile', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_responsive_control('ea_team_member_social_size',
			[
				'label'      => esc_html__( 'Font size', 'easy-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'  => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'  => [
					'unit' => 'px',
					'size' => 14,
				],
				'selectors' => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-social li a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control('ea_team_member_social_width',
			[
				'label'      => esc_html__( 'Width', 'easy-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'  => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'  => [
					'unit' => 'px',
					'size' => 35,
				],
				'selectors' => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-social li a' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control('ea_team_member_social_height',
			[
				'label'      => esc_html__( 'Height', 'easy-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'  => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'  => [
					'unit' => 'px',
					'size' => 35,
				],
				'selectors' => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-social li a' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control('ea_team_member_social_space_between',
			[
				'label'      => esc_html__( 'Social Icon Space betwen', 'easy-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'  => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					]
				],
				'default'  => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-social' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control('team_member_social_profile_padding',
			[
				'label'      => esc_html__( 'Padding', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-social' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control('team_member_social_profile_margin',
			[
				'label'      => esc_html__( 'Margin', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-social' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        // Start Social Profile Tab
        $this->start_controls_tabs(
			'ea_team_member_social_profile_style_tabs'
		);
		$this->start_controls_tab(
			'ea_team_member_social_profile_style_nrml_tab',
			[
				'label' => esc_html__( 'Normal', 'easy-addons' ),
			]
		);
        $this->add_control('team_member_social_profile_clr',
			[
				'label'     => esc_html__( 'Color', 'easy-addons' ),
				'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-social li a' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(Group_Control_Background::get_type(),
			[
				'name'     => 'team_member_social_profile_bg',
				'label'    => esc_html__( 'Background', 'easy-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ea-team-item .ea-team-member-social li a',
			]
		);
        $this->add_group_control(Group_Control_Border::get_type(),
			[
				'name'     => 'team_member_social_profile_icon_border',
				'label'    => esc_html__( 'Border', 'easy-addons' ),
				'selector' => '{{WRAPPER}} .ea-team-item .ea-team-member-social li a',
			]
		);
        $this->add_responsive_control('team_member_social_profile_icon_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => '50',
                    'right'  => '50',
                    'bottom' => '50',
                    'left'   => '50',
                    'unit'   => 'px',
                    'isLinked' => true
                ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-social li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'team_member_social_profile_icon_shadow',
				'label'    => esc_html__( 'Box Shadow', 'easy-addons' ),
				'selector' => '{{WRAPPER}} .ea-team-item .ea-team-member-social li a',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab('ea_team_member_social_profile_style_hv_tab',
			[
				'label' => esc_html__( 'Hover', 'easy-addons' ),
			]
		);
        $this->add_control('team_member_social_profile_clr_hv',
			[
				'label'     => esc_html__( 'Color', 'easy-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-social li a:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(Group_Control_Background::get_type(),
			[
				'name'     => 'team_member_social_profile_bg_hv',
				'label'    => esc_html__( 'Background', 'easy-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ea-team-item .ea-team-member-social li a:hover',
			]
		);
        $this->add_group_control(Group_Control_Border::get_type(),
			[
				'name'     => 'team_member_social_profile_icon_border_hv',
				'label'    => esc_html__( 'Border', 'easy-addons' ),
				'selector' => '{{WRAPPER}} .ea-team-item .ea-team-member-social li a:hover',
			]
		);
        $this->add_responsive_control('team_member_social_profile_icon_radius_hv',
			[
				'label'      => esc_html__( 'Border Radius', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item .ea-team-member-social li a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'team_member_social_profile_icon_shadow_hv',
				'label'    => esc_html__( 'Box Shadow', 'easy-addons' ),
				'selector' => '{{WRAPPER}} .ea-team-item .ea-team-member-social li a:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
        // End Social Profile Tab

        $this->end_controls_section();
    }
    private function getBackgroundOverlayStyle() {
        $this->start_controls_section('ea_team_box_bg_overlay_style', [
            'label' => __('Background Overlay', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_group_control(Group_Control_Background::get_type(),
			[
				'name'     => 'ea_team_box_bg_overlay_bg',
				'label'    => esc_html__( 'Background', 'easy-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ea-team-item.style-2:before',
			]
		);
        $this->add_control('ea_team_box_bg_overlay_opacity',
			[
				'label'      => esc_html__( 'Opacity', 'easy-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'  => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					]
				],
				'default' => [
					'size' => 0.4,
				],
				'selectors' => [
					'{{WRAPPER}} .ea-team-item.style-2:before' => 'opacity: {{SIZE}};',
				],
			]
		);
        $this->end_controls_section();
    }
    private function getTeamBoxStyle() {
        $this->start_controls_section('ea_team_box_style', [
            'label' => __('Team Member box', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_responsive_control('ea_team_member_box_width',
			[
				'label'      => esc_html__( 'Width', 'easy-addons' ),
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
					'{{WRAPPER}} .ea-team-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control('ea_team_member_box_height',
			[
				'label'      => esc_html__( 'Height', 'easy-addons' ),
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
					'{{WRAPPER}} .ea-team-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        // Start Social Profile Tab
        $this->start_controls_tabs(
			'ea_team_member_box_style_tabs'
		);
		$this->start_controls_tab(
			'ea_team_member_box_style_nrml_tab',
			[
				'label' => esc_html__( 'Normal', 'easy-addons' ),
			]
		);
        $this->add_group_control(Group_Control_Background::get_type(),
            [
                'name'     => 'ea_team_member_box_bg',
                'label'    => esc_html__( 'Background', 'easy-addons' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ea-team-item',
            ]
        );
        $this->add_group_control(Group_Control_Border::get_type(),
			[
				'name'     => 'ea_team_member_box_border',
				'label'    => esc_html__( 'Border', 'easy-addons' ),
				'selector' => '{{WRAPPER}} .ea-team-item',
			]
		);
        $this->add_responsive_control('ea_team_member_box_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ea_team_member_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'easy-addons' ),
				'selector' => '{{WRAPPER}} .ea-team-item',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab('ea_team_member_box_style_hv_tab',
			[
				'label' => esc_html__( 'Hover', 'easy-addons' ),
			]
		);
        $this->add_group_control(Group_Control_Background::get_type(),
            [
                'name'     => 'ea_team_member_box_bg_hv',
                'label'    => esc_html__( 'Background', 'easy-addons' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ea-team-item:hover',
            ]
        );
        $this->add_group_control(Group_Control_Border::get_type(),
			[
				'name'     => 'ea_team_member_box_border_hv',
				'label'    => esc_html__( 'Border', 'easy-addons' ),
				'selector' => '{{WRAPPER}} .ea-team-item:hover',
			]
		);
        $this->add_responsive_control('ea_team_member_box_radius_hv',
			[
				'label'      => esc_html__( 'Border Radius', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ea_team_member_box_shadow_hv',
				'label'    => esc_html__( 'Box Shadow', 'easy-addons' ),
				'selector' => '{{WRAPPER}} .ea-team-item:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
        // End Social Profile Tab


        $this->add_responsive_control('ea_team_member_box_padding',
			[
				'label'      => esc_html__( 'Padding', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control('ea_team_member_box_margin',
			[
				'label'      => esc_html__( 'Margin', 'easy-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ea-team-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
    }
    
    
	protected function register_controls() {
        $this->getContent();
        $this->getOptions();
        $this->getImageStyle();
        $this->getContentBoxStyle();
        $this->getNameStyle();
        $this->getDesignationStyle();
        $this->getSocialProfileStyle();
        $this->getBackgroundOverlayStyle();
        $this->getTeamBoxStyle();
	}


	protected function render( ) {
		$settings = $this->get_settings_for_display();

        $name        = $settings['team_member_name'];
        $designation = $settings['team_member_designation'];
        $img         = $settings['team_member_image']['url'];
        $socialLists = $settings['team_member_social_lists'];

		?>
        <div id="ea-team-member-<?php echo esc_attr($this->get_id()); ?>" class="ea-team-item position-relative transition-all-3s  <?php echo esc_attr($settings['ea_team_member_box_style']); echo esc_attr__(' align-', 'easy-addons') . esc_attr($settings['ea_team_member_alignment']); ?>">
            <div class="ea-team-member-image">
                <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($name); ?>">
            </div>
            <div class="ea-team-member-content">
                <?php if ( !empty($name) ) { ?>
                    <h1 class="transition-all-3s"><?php echo esc_html($name); ?></h1>
                <?php } if ( !empty($designation)) { ?>
                    <p class="transition-all-3s"><?php echo esc_html($designation); ?></p>
                <?php } ?>
            </div>
            <ul class="ea-team-member-social d-flex align-center">
                <?php foreach ($socialLists as $icon) { 

                    $target   = $icon['team_member_social_icon_url']['is_external'] ? ' target=_blank' : '';
                    $nofollow = $icon['team_member_social_icon_url']['nofollow'] ? ' rel=nofollow' : '';
                    ?>
                    <li class="d-block">
                        <a class="d-block transition-all-3s" href="<?php echo esc_url($icon['team_member_social_icon_url']['url']); ?>" <?php echo esc_attr($target). ' ' . esc_attr($nofollow); ?>>
                            <?php Icons_Manager::render_icon( $icon['team_member_social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>

        </div>
		<?php
	}

}
Plugin::instance()->widgets_manager->register( new ea_team() );