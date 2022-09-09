<?php
/**
 * Admin Settings Page
 */

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

class ea_admin_menu_setting_class {

	/**
	 * Contains Default Component keys
	 * @var array
	 * @since 2.3.0
	 */
	public $ea_elementor_default_keys = [ 'button', 'flip-card' ];

	/**
	 * Will Contain All Components Default Values
	 * @var array
	 * @since 2.3.0
	 */
	private $ea_elementor_default_settings;

	/**
	 * Will Contain User End Settings Value
	 * @var array
	 * @since 2.3.0
	 */
	private $ea_elementor_settings;

	/**
	 * Will Contains Settings Values Fetched From DB
	 * @var array
	 * @since 2.3.0
	 */
	private $ea_elementor_get_settings;

	/**
	 * Initializing all default hooks and functions
	 * @param
	 * @return void
	 * @since 1.1.2
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'create_ea_elementor_admin_menu' ), 5 );

		add_action( 'admin_enqueue_scripts', array( $this, 'ea_enqueue_admin_scripts' ) );

		add_action( 'wp_ajax_save_settings_with_ajax', array( $this, 'ea_save_settings_with_ajax' ) );

	}

	/**
	 * Easy Addons Create an admin menu.
	 */
	public function create_ea_elementor_admin_menu() {

		add_menu_page(
			__('EasyAddons', 'easy-addons'),
			__('EasyAddons', 'easy-addons'),
			'manage_options',
			'ea_settings',
			array( $this, 'ea_elementor_admin_settings_page' ),
			EASY_ADDONS_ASSETS . '/admin/images/ea-logo-icon.png',
			5
		);

	}

    /*
     * Enqueue UA Admin Scripts Files
     * */
	public function ea_enqueue_admin_scripts(){
		
		wp_register_style(
			'fontawesome-min-css',
			'//pro.fontawesome.com/releases/v5.10.0/css/all.css'
		);
		wp_enqueue_style(
			'ea-animate-css',
			EASY_ADDONS_ASSETS . 'css/animate.css'
		);
		wp_register_style(
			'ea-admin-settings-css',
			EASY_ADDONS_ASSETS. 'admin/css/admin.css'
		);
		wp_register_style(
			'sweetalert2-min-css',
			EASY_ADDONS_ASSETS . 'admin/vendor/sweetalert2/css/sweetalert2.min.css'
		);
		wp_register_style(
			'ea-global-css-admin',
			EASY_ADDONS_ASSETS . 'css/admin-global.css'
		);


		wp_register_script(
			'ea-admin-settings-js',
			EASY_ADDONS_ASSETS . 'admin/js/admin.js',
			array('jquery'),
			EASY_ADDONS_VERSION,
			true
		);

		wp_register_script(
			'sweetalert2-core-js',
			EASY_ADDONS_ASSETS.( 'admin/vendor/sweetalert2/js/core.js' ),
			array('jquery'),
			EASY_ADDONS_VERSION,
			true
		);
		wp_register_script(
			'sweetalert2-min-js',
			EASY_ADDONS_ASSETS.( 'admin/vendor/sweetalert2/js/sweetalert2.min.js' ),
			array('jquery', 'sweetalert2-core-js'),
			EASY_ADDONS_VERSION,
			true
		);



		wp_enqueue_style( 'fontawesome-min-css' );
		wp_enqueue_style( 'sweetalert2-min-css' );
		wp_enqueue_style( 'ea-global-css-admin' );
		wp_enqueue_style( 'ea-admin-settings-css' );
		wp_enqueue_script( 'ea-admin-settings-js' );
		wp_enqueue_script( 'sweetalert2-core-js' );
		wp_enqueue_script( 'sweetalert2-min-js' );
	}

	/**
	 * Easy Addons Create settings page.
	 */
	public function ea_elementor_admin_settings_page() {

		$ea_js_info = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		);
		wp_localize_script( 'ea-admin-settings-js', 'js_ea_lite_settings', $ea_js_info );

		/**
		 * This section will handle the "ea_elementor_save_settings" array. If any new settings options is added
		 * then it will match with the older array and then if it founds anything new then it will update the entire array.
		 */
		$this->ea_elementor_default_settings = array_fill_keys( $this->ea_elementor_default_keys, true );
		$this->ea_elementor_get_settings     = get_option( 'ea_elementor_save_settings', $this->ea_elementor_default_settings );
		$ea_elementor_new_settings           = array_diff_key( $this->ea_elementor_default_settings, $this->ea_elementor_get_settings );

		if( ! empty( $ea_elementor_new_settings ) ) {
			$ea_elementor_updated_settings = array_merge( $this->ea_elementor_get_settings, $ea_elementor_new_settings );
			update_option( 'ea_elementor_save_settings', $ea_elementor_updated_settings );
		}
		$this->ea_elementor_get_settings = get_option( 'ea_elementor_save_settings', $this->ea_elementor_default_settings );
        ?>
        <div class="ea-settings-wrap">
            <form action="" method="POST" id="ea_admin_settings_form" name="ea_admin_settings_form">
                <div class="ea-header-bar">
                    <div class="ea-header-left">
                        <div class="ea-admin-logo-inline">
                            <h1><?php esc_html_e('Easy', 'easy-addons'); ?><span><?php esc_html_e('Addons', 'easy-addons'); ?></span></h1>
                        </div>
                        <h2 class="title">
				            <?php esc_html_e('Easy Addons Settings', 'easy-addons'); ?>
                        </h2>
                    </div>
                    <div class="ea-header-right">
                        <button type="submit" class="button ea-admin-save-btn js-UA-settings-save">
                            <i class="fas fa-save"></i> <?php esc_html_e('Save settings', 'easy-addons'); ?>
                        </button>
                    </div>
                </div>
                <div class="ea-settings-tabs">
                    <div class="col-lg-4">
                        <ul class="ea-tabs">
                            <li class="ea-tab-list">
                                <a href="#dashboard" class="active">
                                    <i class="fas fa-cogs"></i>
                                    <span><?php esc_html_e('Dashboard', 'easy-addons'); ?></span>
                                </a>
                            </li>
                            <li class="ea-tab-list">
                                <a href="#elements">
                                    <i class="fas fa-cubes"></i>
                                    <span><?php esc_html_e('Elements', 'easy-addons'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-8">
			            <?php
                            include_once EASY_ADDONS_DIR_PATH . 'includes/settings/settings-general.php';
                            include_once EASY_ADDONS_DIR_PATH . 'includes/settings/settings-elements.php';
			            ?>
                    </div>
                </div>
            </form>
        </div>
        <?php
	}

	/**
	 * Saving data with ajax request
	 * @param
	 * @return  array
	 * @since 1.1.2
	 */
	public function ea_save_settings_with_ajax() {

		if( isset( $_POST['fields'] ) ) {
			parse_str( sanitize_text_field($_POST['fields']), $settings );
		} else {
			return;
		}

		$this->ea_elementor_settings = [];

		foreach( $this->ea_elementor_default_keys as $key ){
			if( isset( $settings[ $key ] ) ) {
				$this->ea_elementor_settings[ $key ] = 1;
			} else {
				$this->ea_elementor_settings[ $key ] = 0;
			}
		}
		update_option( 'ea_elementor_save_settings', $this->ea_elementor_settings );
		return true;
		die();

	}

}

new ea_admin_menu_setting_class();