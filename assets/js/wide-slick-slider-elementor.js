(function($) {
    $(document).ready(function() {

        /**
         * Make the container as high as its parent's parent.
         */
        var parent          = $('.elementor-widget-wide-slick-slider-elementor').parent().parent();
        var parentHeight    = parent.height();
        $('.elementor-widget-wide-slick-slider-elementor, .wide-slick-slider-elementor, .bgslider-image').css({'height': parentHeight + 'px'});

        /**
         * Slick launching
         */
        $('.wide-slick-slider-elementor').slick({
            // autoplay: true,
            // arrows: false,
            // fade: true,
            // speed: 2000,
            pauseOnFocus: false,
            pauseOnHover: false,
            swipeToSlide: true,
            prevArrow: '<button type="button" class="slick-prev slick-arrow"><i class="fa fa-angle-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next slick-arrow"><i class="fa fa-angle-right"></i></button">',
        });
        
    });
})(jQuery);