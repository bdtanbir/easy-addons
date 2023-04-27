<?php
namespace Elementor;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

class ea_testimonial extends Widget_Base {
    public function get_name() {
        return 'ea-testimonial';
    }

    public function get_title() {
        return esc_html__( 'Testimonial', 'easy-addons' );
    }

    public function get_icon() {
        return 'eicon-testimonial ea-addons-icon';
    }

    public function get_categories() {
        return [ 'easy-addons-category' ];
    }

    public function get_keywords()
    {
        return [
            'team',
            'testimonial',
            'member',
            'team member',
            'card',
            'testimonial builder',
            'our team',
            'ea',
            'easy addons'
        ];
    }


    private function getContent() {
        $this->start_controls_section('ea_testimonial_member_content', [
            'label' => __('Content', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control('image',
            [
                'label'   => esc_html__( 'Choose Image', 'easy-addons' ),
                'type'    => Controls_Manager::MEDIA,
                'condition' => [
                    'show_image' => 'yes'
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control('name',
            [
                'label'       => esc_html__( 'Name', 'easy-addons' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Jhon Doe', 'easy-addons' ),
                'placeholder' => esc_html__( 'Type name here here', 'easy-addons' ),
            ]
        );
        $this->add_control('designation',
            [
                'label'       => esc_html__( 'Designation', 'easy-addons' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'CMO, Blue Finance', 'easy-addons' ),
                'placeholder' => esc_html__( 'Type designation here here', 'easy-addons' ),
            ]
        );
        $this->add_control('description',
            [
                'label'       => esc_html__( 'Description', 'easy-addons' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'default'     => esc_html__( 'I’ve been using gcal for the past few years. Since then, generating the listings for my weekly newsletter has been a snap! Now, I can’t imagine doing without it.', 'easy-addons' ),
                'placeholder' => esc_html__( 'Type your description here', 'easy-addons' ),
            ]
        );
        $this->add_control('testimonial_rating_scale',
            [
                'label'   => __( 'Rating Scale', 'easy-addons' ),
                'type'    => Controls_Manager::SELECT,
                'condition' => [
                    'show_rating' => 'yes'
                ],
                'options' => [
                    '5'   => '0-5',
                    '10'  => '0-10',
                ],
                'default' => '5',
            ]
        );
        $this->add_control('testimonial_rating',
            [
                'label'   => __( 'Rating', 'easy-addons' ),
                'type'    => Controls_Manager::NUMBER,
                'condition' => [
                    'show_rating' => 'yes'
                ],
                'min'     => 0,
                'max'     => 10,
                'step'    => 0.1,
                'default' => 5,
            ]
        );

        $this->end_controls_section();
    }
    private function getOptions()
    {
        $this->start_controls_section('getOptions', [
            'label' => __('Options', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_CONTENT
        ]);
        $this->add_control('testimonial_style',
            [
                'label'   => esc_html__( 'Style', 'easy-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default', 'easy-addons' ),
                    'style-2' => esc_html__( 'Style 2', 'easy-addons' ),
                    'style-3' => esc_html__( 'Style 3', 'easy-addons' ),
                ],
            ]
        );
        $this->add_control( 'alignment',
            [
                'label'     => __('Alignment', 'easy-addons'),
                'type'      => Controls_Manager::CHOOSE,
                'condition' => [
                    'testimonial_style' => 'default'
                ],
                'options' => [
                    'text-left' => [
                        'title' => __('Left', 'easy-addons'),
                        'icon'  => 'las la-align-left',
                    ],
                    'text-center' => [
                        'title'  => __('Center', 'easy-addons'),
                        'icon'   => 'las la-align-center',
                    ],
                    'text-right' => [
                        'title'  => __('Right', 'easy-addons'),
                        'icon'   => 'las la-align-right',
                    ],
                ],
                'default' => 'text-center'
            ]
        );
        $this->add_control('show_rating',
            [
                'label'        => esc_html__( 'Show Rating', 'easy-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'easy-addons' ),
                'label_off'    => esc_html__( 'Hide', 'easy-addons' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control('show_image',
            [
                'label'        => esc_html__( 'Show Image', 'easy-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'easy-addons' ),
                'label_off'    => esc_html__( 'Hide', 'easy-addons' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();
    }
    private function getImageStyle()
    {
        $this->start_controls_section('getImageStyle', [
            'label' => __('Image', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_responsive_control('img_gap',
            [
                'label'      => esc_html__( 'Gap Between Img - Name', 'easy-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'condition' => [
                    'testimonial_style' => 'style-3'
                ],
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
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ea-testimonial-box.style-3 .ea-testimonial-box-inner .ea-testimonial-author-info' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control('img_width',
            [
                'label'      => esc_html__( 'Width', 'easy-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range'  => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 400,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'  => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-author-info img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control('img_height',
            [
                'label'      => esc_html__( 'Height', 'easy-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range'  => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 400,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-author-info img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Border::get_type(),
            [
                'name'     => 'img_border',
                'selector' => '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-author-info img',
            ]
        );
        $this->add_control('img_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-author-info img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'img_shadow',
                'label'    => __( 'Box Shadow', 'easy-addons' ),
                'selector' => '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-author-info img',
            ]
        );
        $this->add_responsive_control('img_padding',
            [
                'label'      => esc_html__( 'Padding', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-author-info img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control('img_margin',
            [
                'label'      => esc_html__( 'Margin', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-author-info img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    private function getNameStyle()
    {
        $this->start_controls_section('getNameStyle', [
            'label' => __('Name', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_control('name_color',
            [
                'label'     => esc_html__( 'Color', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-author-info .name' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-author-info .name',
            ]
        );
        $this->add_responsive_control('name_margin',
            [
                'label'      => esc_html__( 'Margin', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-author-info .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    private function getDesignationStyle()
    {
        $this->start_controls_section('getDesignationStyle', [
            'label' => __('Designation', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_control('designation_color',
            [
                'label'     => esc_html__( 'Color', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#8c8c8c',
                'selectors' => [
                    '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-author-info .designation' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Typography::get_type(),
            [
                'name'     => 'designation_typography',
                'selector' => '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-author-info .designation',
            ]
        );
        $this->add_responsive_control('designation_margin',
            [
                'label'      => esc_html__( 'Margin', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-author-info .designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    private function getContentStyle()
    {
        $this->start_controls_section('getContentStyle', [
            'label' => __('Content', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_control('content_color',
            [
                'label'     => esc_html__( 'Color', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#5F77A7',
                'selectors' => [
                    '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-content p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control('content_bg',
            [
                'label'     => esc_html__( 'Background', 'easy-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-content' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-content p',
            ]
        );
        $this->add_group_control(Group_Control_Border::get_type(),
            [
                'name'     => 'content_border',
                'selector' => '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-content',
            ]
        );
        $this->add_responsive_control('content_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_shadow',
                'selector' => '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-content',
            ]
        );
        $this->add_responsive_control('content_margin',
            [
                'label'      => esc_html__( 'Margin', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control('content_padding',
            [
                'label'      => esc_html__( 'Padding', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-testimonial-box .ea-testimonial-box-inner .ea-testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    private function getBoxStyle()
    {
        $this->start_controls_section('getBoxStyle', [
            'label' => __('Box', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_group_control(Group_Control_Background::get_type(),
            [
                'name'     => 'box_bg',
                'types'    => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .ea-testimonial-box',
            ]
        );
        $this->add_group_control(Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'selector' => '{{WRAPPER}} .ea-testimonial-box',
            ]
        );
        $this->add_control('box_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-testimonial-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'selector' => '{{WRAPPER}} .ea-testimonial-box, {{WRAPPER}} .ea-testimonial-box.default:before',
            ]
        );
        $this->add_responsive_control('box_padding',
            [
                'label'      => esc_html__( 'Padding', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-testimonial-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control('box_margin',
            [
                'label'      => esc_html__( 'Margin', 'easy-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .ea-testimonial-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('box_before_shape',
            [
                'label'     => esc_html__( 'Shape', 'easy-addons' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'testimonial_style' => 'default'
                ]
            ]
        );
        $this->add_control('box_before_shape_opacity',
            [
                'label'      => esc_html__( 'Opacity', 'easy-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .ea-testimonial-box.default:before' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    'testimonial_style' => 'default'
                ]
            ]
        );
        $this->end_controls_section();
    }

    protected function render_stars( $rating_data, $icon ) {
        $rating = $rating_data[0];
        $scale  = $rating_data[1];
        $floored_rating = (int) $rating; // full number
        $stars_html = '';

        for ( $stars = 1; $stars <= $scale; $stars++ ) { // loop will run 5|10 times
            if ( $stars <= $floored_rating ) { // full stars
                $stars_html .= '<li><i class="elementor-star-full">' . $icon . '</i></li>';
            } elseif ( $floored_rating + 1 === $stars && $rating !== $floored_rating ) {
                $stars_html .= '<li><i class="elementor-star-' . ( $rating - $floored_rating ) * 10 . '">' . $icon . '</i></li>';
            } else {
                $stars_html .= '<li><i class="elementor-star-empty">' . $icon . '</i></li>';
            }
        }

        return $stars_html;
    }

    protected function register_controls() {
        $this->getContent();
        $this->getOptions();
        $this->getImageStyle();
        $this->getNameStyle();
        $this->getDesignationStyle();
        $this->getContentStyle();
        $this->getBoxStyle();
    }


    protected function render( ) {
        $settings = $this->get_settings_for_display();

        $icon             = '&#xE934;';
        $rating = isset( $settings['testimonial_rating'] ) ? (float) $settings['testimonial_rating'] : 0;
        $scale  = isset( $settings['testimonial_rating_scale'] ) ? (float) $settings['testimonial_rating_scale'] : 5;

        $stars_element = '<ul class="elementor-star-rating rating">' . $this->render_stars( [
                $rating,
                $scale
            ], $icon ) . ' </ul>';
        ?>


        <div class="ea-testimonial-box <?php echo esc_attr($settings['testimonial_style']); echo ' '.esc_attr($settings['alignment']); ?>">

            <div class="ea-testimonial-box-inner">
                <div class="ea-testimonial-content">
                    <p><?php echo wp_kses_post($settings['description']); ?></p>
                </div>
                <div class="ea-testimonial-author-info">
                    <?php if ( !empty($settings['image']['url']) && $settings['show_image'] == 'yes' ) { ?>
                        <img src="<?php echo esc_url($settings['image']['url']) ?>" alt="<?php echo esc_attr($settings['name']) ?>">
                    <?php } ?>
                    <div class="ea-testimonial-author-inner">
                        <?php if ( !empty($settings['name']) ) { ?>
                            <h2 class="name"><?php echo esc_html($settings['name']); ?></h2>
                        <?php }
                        if ( !empty($settings['designation']) ) { ?>
                            <p class="designation"><?php echo esc_html($settings['designation']); ?></p>
                        <?php }
                        if ( $settings['show_rating'] == 'yes' ) {
                            echo wp_kses_post($stars_element);
                        } ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

}
Plugin::instance()->widgets_manager->register( new ea_testimonial() );