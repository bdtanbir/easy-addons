<?php
class eaProWidgetsRegister {

    public function __construct() {
        $this->register_hooks();
    }
    

    public function register_hooks() {
        // add_filter('elementor/editor/localize_settings', [$this, 'promote_pro_elements']);
        add_action('elementor/widgets/widgets_registered', [$this, 'eaElementorAddElements']);
        
    }
    public function eaElementorAddElements() {

        $is_component_active = ea_elementor_activated_modules();
    
        // load elements
        if( $is_component_active['ea-button'] ) {
            require_once EASY_ADDONS_DIR_PATH . 'includes/elements/button/button.php';
        }
        if( $is_component_active['ea-flip-card'] ) {
            require_once EASY_ADDONS_DIR_PATH . 'includes/elements/flip-card/flip-card.php';
        }
        if( $is_component_active['ea-team'] ) {
            require_once EASY_ADDONS_DIR_PATH . 'includes/elements/team/team.php';
        }
        if( $is_component_active['ea-timeline'] ) {
            require_once EASY_ADDONS_DIR_PATH . 'includes/elements/timeline/timeline.php';
        }
    
        do_action('ea_register_elements', $is_component_active);
    }
    
    
    // public function promote_pro_elements($config) {
    //     if (defined('EASY_ADDONS_PRO')) {
    //         return $config;
    //     }

    //     $promotion_widgets = [];

    //     if (isset($config['promotionWidgets'])) {
    //         $promotion_widgets = $config['promotionWidgets'];
    //     }

    //     $combine_array = array_merge($promotion_widgets, [
    //         [
	//             'name' => 'ea-toggle',
	//             'title' => __('Toggle', 'easy-addons'),
	//             'icon' => 'eicon-toggle',
	//             'categories' => '["easy-addons-category"]',
    //         ]
    //     ]);

    //     $config['promotionWidgets'] = $combine_array;
    
    //     return $config;
    // }
}
new eaProWidgetsRegister();