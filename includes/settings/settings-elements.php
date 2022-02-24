

<div id="elements" class="UA-settings-tab UA-elements-list">
    <div class="row">
        <div class="col-full">
            <h2 class="UA-admin-section-header-title">
                <span class="left">
                    <i class="fas fa-cubes"></i> <?php esc_html_e('Elements', 'easy-addons'); ?>
                </span>
            </h2>
            <div class="elements-global-control-wrap">
                <h4>
                    <?php esc_html_e('Global Controls', 'easy-addons') ?>
                </h4>
                <p>
                    <?php esc_html_e('Use the Buttons to Activate or Deactivate all the Elements of Useful Addons at once.', 'easy-addons') ?>
                </p>

                <div class="UA-btn-group">
                    <button type="button" class="UA-btn UA-global-control-enable">
                        <?php esc_html_e('Enable All', 'easy-addons'); ?>
                    </button>
                    <button type="button" class="UA-btn UA-global-control-disable">
                        <?php esc_html_e('Disable All', 'easy-addons'); ?>
                    </button>
                </div>
            </div>

            <h4>
                <?php esc_html_e('Content Elements', 'easy-addons'); ?>
            </h4>
            <div class="UA-checkbox-container">
                <div class="UA-checkbox">
                    <div class="UA-elements-info">
                        <p class="UA-title">
							<?php esc_html_e('Creative Button', 'easy-addons'); ?>
                        </p>
                    </div>
                    <input type="checkbox" id="button" name="button" <?php checked( 1, $this->ea_elementor_get_settings['button'], true ); ?>>
                    <label for="button"></label>
                </div>
            </div>

            <div class="UA-save-btn-wrap">
                <button type="submit" class="button UA-btn js-UA-settings-save">
                    <i class="fas fa-save"></i> <?php esc_html_e('Save settings', 'easy-addons'); ?>
                </button>
            </div>
        </div>
    </div>
</div>