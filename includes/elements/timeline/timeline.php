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
            'label' => __('Dynamic Content Settings', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_CONTENT,
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
        $this->add_control( 'orderby',
            [
                'label'             => __( 'Order By', 'easy-addons' ),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'date',
                'options'           => [
                    'ID'            => 'Post ID',
                    'author'        => 'Post Author',
                    'title'         => 'Title',
                    'date'          => 'Date',
                    'modified'      => 'Last Modified Date',
                    'parent'        => 'Parent Id',
                    'rand'          => 'Random',
                    'comment_count' => 'Comment Count',
                    'menu_order'    => 'Menu Order',
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
        $this->end_controls_section();
    }

    /* Custom Content Settings */
    private function customContentSettings() {
        $this->start_controls_section('getCustomContentSettings', [
            'label' => __('Custom Content Settings', 'easy-addons'),
            'tab'   => Controls_Manager::TAB_CONTENT,
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
        $this->add_control('timelines',
            [
                'label'   => '',
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => esc_html__( 'Easy addons for elementor', 'easy-addons' ),
                        'content' => esc_html__( 'A new concept of showing content in your web page with more interactive way.', 'easy-addons' ),
                        'post_date' => esc_html__('23 Jan, 2022')
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_controls() {
        $this->getTimelineContent();
        $this->dynamicContentSettings();
        $this->customContentSettings();

    }

    protected function render( ) {
        $settings      = $this->get_settings_for_display();
        $source        = $settings['source'];
        $post_per_page = $settings['post_per_page'];
        $orderby = $settings['orderby'];
        $order = $settings['order'];

        $default = [
            'posts_per_page' => $post_per_page ? $post_per_page : -1,
            'post_type'      => $source ? $source : 'posts',
            'orderby'        => $orderby,
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
                                        <p><?php echo wp_trim_excerpt(get_the_excerpt(), 11); ?></p>
                                    <?php } ?>
                                    <a href="#" class="ea-button">Learn More</a>
                                </div>
                            </div>
                        </div>
                    <?php }
                    wp_reset_query();
                    } else {
                        foreach ($settings['timelines'] as $timeline) {
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
                                    <?php } ?>
                                    <a href="#" class="ea-button">Learn More</a>
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