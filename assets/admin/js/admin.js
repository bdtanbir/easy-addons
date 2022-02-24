(function($) {
    "use strict";

    /**
     * UA Tabs
     */
    $(".UA-tabs li.UA-tab-list a").on("click", function(e) {
        e.preventDefault();
        $(".UA-tabs li a").removeClass("active");
        $(this).addClass("active");
        var tab = $(this).attr("href");
        $(".UA-settings-tab").removeClass("active");
        $(".UA-settings-tabs")
            .find(tab)
            .addClass("active");
    });

    // Elements global control
    $(document).on("click", ".UA-global-control-enable", function(e) {
        e.preventDefault();

        $(".UA-checkbox-container .UA-checkbox input:enabled").each(
            function(i) {
                $(this)
                    .prop("checked", true)
                    .change();
            }
        );

    });

    $(document).on("click", ".UA-global-control-disable", function(e) {
        e.preventDefault();

        $(".UA-checkbox-container .UA-checkbox input:enabled").each(
            function(i) {
                $(this)
                    .prop("checked", false)
                    .change();
            }
        );

    });

    // Save Button reacting on any changes
    var headerSaveBtn = $( '.ea-header-bar .ea-admin-save-btn' );
    var footerSaveBtn = $( '.UA-save-btn-wrap .ea-admin-save-btn' );
    $('.UA-checkbox input[type="checkbox"], .UA-global-control-enable, .UA-global-control-disable').on( 'click', function( e ) {
        headerSaveBtn.addClass( 'save-now' );
        footerSaveBtn.addClass( 'save-now' );
        headerSaveBtn.removeAttr('disabled').css('cursor', 'pointer');
        footerSaveBtn.removeAttr('disabled').css('cursor', 'pointer');
    } );

    // Saving Data With Ajax Request
    $( '.js-UA-settings-save' ).on( 'click', function(event) {
        event.preventDefault();

        var _this = $(this);

        if( $(this).hasClass('save-now') ) {
            $.ajax( {
                url: js_ea_lite_settings.ajaxurl,
                type: 'post',
                data: {
                    action: 'save_settings_with_ajax',
                    fields: $( 'form#ea_admin_settings_form' ).serialize(),
                },
                beforeSend: function() {
                    _this.html('<svg id="UA-spinner" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48"><circle cx="24" cy="4" r="4" fill="#fff"/><circle cx="12.19" cy="7.86" r="3.7" fill="#fffbf2"/><circle cx="5.02" cy="17.68" r="3.4" fill="#fef7e4"/><circle cx="5.02" cy="30.32" r="3.1" fill="#fef3d7"/><circle cx="12.19" cy="40.14" r="2.8" fill="#feefc9"/><circle cx="24" cy="44" r="2.5" fill="#feebbc"/><circle cx="35.81" cy="40.14" r="2.2" fill="#fde7af"/><circle cx="42.98" cy="30.32" r="1.9" fill="#fde3a1"/><circle cx="42.98" cy="17.68" r="1.6" fill="#fddf94"/><circle cx="35.81" cy="7.86" r="1.3" fill="#fcdb86"/></svg><span>Saving Data..</span>');
                },
                success: function( response ) {
                    setTimeout(function() {
                        _this.html('Save Settings');
                        Swal.fire(
                            'Settings Saved!',
                            'Click OK to continue',
                            'success'
                        );
                        headerSaveBtn.removeClass( 'save-now' );
                        footerSaveBtn.removeClass( 'save-now' );
                    }, 2000);
                },
                error: function() {
                    Swal.fire(
                        'Oops...',
                        'Something went wrong!',
                        'error'
                    );
                }
            } );
        }else {
            $(this).attr('disabled', 'true').css('cursor', 'not-allowed');
        }
    } );

})(jQuery);
