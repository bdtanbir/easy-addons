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

    protected function register_controls() {

    }

    protected function render( ) {
        $settings = $this->get_settings_for_display();


        ?>
            <div class="ea-timeline-container">
                <div class="ea-timeline d-grid w-full flex-wrap">
                    <div class="el-timeline-column position-relative">
                        <div class="el-timeline-inner position-relative">
                            <div class="el-timeline-content">
                                <time>09 Oct, 2022</time>
                                <h2>heading</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem, omnis!</p>
                                <a href="#" class="ea-button">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="el-timeline-column position-relative">
                        <div class="el-timeline-inner position-relative">
                            <div class="el-timeline-content">
                                <time>09 Oct, 2022</time>
                                <h2>heading</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem, omnis!</p>
                                <a href="#" class="ea-button">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="el-timeline-column position-relative">
                        <div class="el-timeline-inner position-relative">
                            <div class="el-timeline-content">
                                <time>09 Oct, 2022</time>
                                <h2>heading</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem, omnis!</p>
                                <a href="#" class="ea-button">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="el-timeline-column position-relative">
                        <div class="el-timeline-inner position-relative">
                            <div class="el-timeline-content">
                                <time>09 Oct, 2022</time>
                                <h2>heading</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem, omnis!</p>
                                <a href="#" class="ea-button">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }

}
Plugin::instance()->widgets_manager->register( new eaTimeline() );