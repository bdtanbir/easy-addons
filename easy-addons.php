<?php
/**
 * Plugin Name: Easy Addons
 * Plugin URI: https://github.com/bdtanbir/easy-addons
 * Description: Easy Addons for Elementor Is the Best Elementor Addons. Including Button and Flip Card. More is coming soon.
 * Version: 1.0.0
 * Author: Tanbir Ahmod
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: easy-addons
 * Domain Path: /languages/
 */


defined('ABSPATH') || die();

define('EASY_ADDONS_VERSION', '1.0.0');
define('EASY_ADDONS__FILE__', __FILE__);
define('EASY_ADDONS_DIR_PATH', plugin_dir_path(EASY_ADDONS__FILE__));
define('EASY_ADDONS_DIR_URL', plugin_dir_url(EASY_ADDONS__FILE__));
define('EASY_ADDONS_ASSETS', trailingslashit(EASY_ADDONS_DIR_URL . 'assets'));

require_once EASY_ADDONS_DIR_PATH . 'autoloader.php';
// setting dashboard
require_once EASY_ADDONS_DIR_PATH.'includes/settings/admin.php';
require_once EASY_ADDONS_DIR_PATH . 'includes/enqueue.php';


/**
 * This function will return true for all activated modules
 * @since   v1.0.0
 */
function ea_elementor_activated_modules() {
    $ea_elementor_default_keys = [
        'button',
        'flip-card'
    ];

    $ea_elementor_default_settings  = array_fill_keys( $ea_elementor_default_keys, true );
    $ea_elementor_get_settings      = get_option( 'ea_elementor_save_settings', $ea_elementor_default_settings );
    $ea_elementor_new_settings      = array_diff_key( $ea_elementor_default_settings, $ea_elementor_get_settings );

    if( ! empty( $ea_elementor_new_settings ) ) {
        $ea_elementor_updated_settings = array_merge( $ea_elementor_get_settings, $ea_elementor_new_settings );
        update_option( 'ea_elementor_save_settings', $ea_elementor_updated_settings );
    }
    return $ea_elementor_get_settings = get_option( 'ea_elementor_save_settings', $ea_elementor_default_settings );
}

/**
 * Activate or Deactivate Modules
 * @since v1.0.0
 */
require_once EASY_ADDONS_DIR_PATH . 'includes/widgets-register.php';


// missing elementor
function is_plugin_installed($basename) {
    if (!function_exists('get_plugins')) {
        include_once ABSPATH . '/wp-admin/includes/plugin.php';
    }

    $installed_plugins = get_plugins();

    return isset($installed_plugins[$basename]);
}
function ea_admin_notice_missing_elementor() {
    $elementor = 'elementor/elementor.php';
    if (!current_user_can('activate_plugins') || is_plugin_active( $elementor)) {
        return;
    }

    if (is_plugin_installed( $elementor)) {
        $activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor);
        $message = sprintf( __('%1$s Easy Addons for Elementor %2$s requires %1$s Elementor %2$s to be installed and activated.', 'easy-addons'), '<strong>', '</strong>' );
        $button_text = __('Activate Elementor', 'easy-addons');
    } else {
        $activation_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');
        $message = sprintf(__('%1$s Easy Addons for Elementor %2$s requires %1$s Elementor %2$s to be installed and activated.', 'easy-addons'), '<strong>', '</strong>');
        $button_text = __('Install Elementor', 'easy-addons');
    }

    $button = '<p><a href="' . $activation_url . '" class="button-primary">' . $button_text . '</a></p>';

    printf('<div class="error ea-missing-elementor"><p>%1$s</p>%2$s</div>', $message, $button);
}

add_action( 'admin_notices', 'ea_admin_notice_missing_elementor' );



/* Category Register */
function add_ea_widget_categories( $elements_manager ) {
    $elements_manager->add_category( 'easy-addons-category',
        [
            'title' => __( 'Easy Addons', 'easy-addons' ),
            'icon'  => 'la la-user',
        ]
    );
}
add_action( 'elementor/elements/categories_registered', 'add_ea_widget_categories' );