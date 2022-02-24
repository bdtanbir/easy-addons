

if ( jQuery(".skillbar").length ) {
    jQuery(window).scroll(function () {
        // skillbar
        jQuery('.skillbar').each(function () {
            jQuery(this).find('.skillbar-bar').animate( {
                width: jQuery(this).attr('data-percent')
            }, 6000);
        });
    });
}

jQuery(window).load(function($){


    if( jQuery(".ua-portfolio-filter").length ) {
        jQuery('.portfolioFilter a').click(function () {
            jQuery('.portfolioFilter .current').removeClass('current');
            jQuery(this).addClass('current');

            var selector = jQuery(this).attr('data-filter');
            $container.isotope({
                filter: selector,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
            return false;
        });
        var $container2 = jQuery('.portfolio-list');
        $container2.isotope({
            filter: '*',
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });

        jQuery('.ua-portfolio-filter li').click(function () {
            jQuery('.ua-portfolio-filter li').removeClass('active');
            jQuery(this).addClass('active');

            var selector = jQuery(this).attr('data-filter');
            $container2.isotope({
                filter: selector,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
            return false;
        });
    }


    if ( jQuery(".ua-counter").length ) {
        jQuery('.ua-counter').counterUp({
            delay: 20,
            time: 2000
        });
    }

    /*==== Card preview tooltipster =====*/
    if(jQuery(".ua-card-preview").length) {
        jQuery('.ua-card-preview').tooltipster({
            contentCloning: true,
            interactive: true,
            side: 'right',
            delay: 100,
            animation: 'swing',
            //trigger: 'click'
        });
    }
});


