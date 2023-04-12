

<div id="elements" class="ea-settings-tab UA-elements-list">
    <div class="row">
        <div class="col-full">
            <h2 class="ea-admin-section-header-title">
                <span class="left">
                    <i class="fas fa-cubes"></i> <?php esc_html_e('Elements', 'easy-addons'); ?>
                </span>
            </h2>
            <div class="elements-global-control-wrap">
                <h4>
                    <?php esc_html_e('Global Controls', 'easy-addons') ?>
                </h4>
                <p>
                    <?php esc_html_e('Use the Buttons to Activate or Deactivate all the Elements of Easy Addons at once.', 'easy-addons') ?>
                </p>

                <div class="ea-btn-group">
                    <button type="button" class="ea-admin-save-btn ea-global-control-enable">
                        <?php esc_html_e('Enable All', 'easy-addons'); ?>
                    </button>
                    <button type="button" class="ea-admin-save-btn ea-global-control-disable">
                        <?php esc_html_e('Disable All', 'easy-addons'); ?>
                    </button>
                </div>
            </div>

            <div class="ea-checkbox-wrap">
                <h4>
                    <?php esc_html_e('Content Elements', 'easy-addons'); ?>
                </h4>
                <div class="ea-checkbox-container">
                    <div class="ea-checkbox">
                        <div class="ea-elements-info">
                            <p class="ea-title">
                                <?php esc_html_e('Creative Button', 'easy-addons'); ?>
                            </p>
                        </div>
                        <input type="checkbox" id="ea-button" name="ea-button" <?php checked( 1, $this->ea_elementor_get_settings['ea-button'], true ); ?>>
                        <label for="ea-button"></label>
                    </div>
                    <div class="ea-checkbox">
                        <div class="ea-elements-info">
                            <p class="ea-title">
                                <?php esc_html_e('Flip Card', 'easy-addons'); ?>
                            </p>
                        </div>
                        <input type="checkbox" id="ea-flip-card" name="ea-flip-card" <?php checked( 1, $this->ea_elementor_get_settings['ea-flip-card'], true ); ?>>
                        <label for="ea-flip-card"></label>
                    </div>
                    <div class="ea-checkbox">
                        <div class="ea-elements-info">
                            <p class="ea-title">
                                <?php esc_html_e('Team', 'easy-addons'); ?>
                            </p>
                        </div>
                        <input type="checkbox" id="ea-team" name="ea-team" <?php checked( 1, $this->ea_elementor_get_settings['ea-team'], true ); ?>>
                        <label for="ea-team"></label>
                    </div>
                    
                </div>
            </div>

            <div class="ea-checkbox-wrap">
                <h4>
                    <?php esc_html_e('Dynamic Elements', 'easy-addons'); ?>
                </h4>
                <div class="ea-checkbox-container">
                    <div class="ea-checkbox">
                        <div class="ea-elements-info">
                            <p class="ea-title">
                                <?php esc_html_e('Timeline', 'easy-addons'); ?>
                            </p>
                        </div>
                        <input type="checkbox" id="ea-timeline" name="ea-timeline" <?php checked( 1, $this->ea_elementor_get_settings['ea-timeline'], true ); ?>>
                        <label for="ea-timeline"></label>
                    </div>
                </div>
            </div>
                    

            <div class="ea-save-btn-wrap">
                <button type="submit" class="button ea-admin-save-btn js-ea-settings-save">
                    <i class="fas fa-save"></i> <?php esc_html_e('Save settings', 'easy-addons'); ?>
                </button>
            </div>
        </div>
    </div>
</div>


<?php if ( !defined('EASY_ADDONS_PRO') ) { ?>
    <div class="ea-modal-wrapper">
        <div class="ea-modal">
            <span class="ea-close-modal">+</span>
            <img src="<?php echo esc_attr(EASY_ADDONS_ASSETS . 'admin/images/upgrade.svg'); ?>" alt="<?php esc_attr_e('Upgrade', 'easy-addons'); ?>">
            <h1><?php esc_html_e('Go PRO', 'easy-addons'); ?></h1>
            <p><?php esc_html_e('Upgrade amazing widgets to build awesome websites.', 'easy-addons'); ?></p>
            <a href="#" class="ea-admin-save-btn button"><?php esc_html_e('Upgrade Now', 'easy-addons'); ?></a>
        </div>
    </div>
<?php } ?>