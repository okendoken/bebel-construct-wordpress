!function($){
    $(function () {
        var filterList = {
            init: function () {

                // MixItUp plugin
                // http://mixitup.io
                $('#portfolio').mixitup({
                    targetSelector: '.portfolio-item',
                    filterSelector: '.filter',
                    effects: ['fade'],
                    easing: 'snap',
                    targetDisplayGrid: 'block',
                    // call the hover effect
                    onMixEnd: filterList.hoverEffect()
                });

            },

            hoverEffect: function () {

                // Simple parallax effect
                $('#portfolio').find('.portfolio-item').hover(
                    function () {
                        $(this).find('.label').stop().animate({bottom: 0}, 200, 'easeOutQuad');
                        $(this).find('img').stop().animate({top: -30}, 500, 'easeOutQuad');
                    },
                    function () {
                        $(this).find('.label').stop().animate({bottom: -40}, 200, 'easeInQuad');
                        $(this).find('img').stop().animate({top: 0}, 300, 'easeOutQuad');
                    }
                );

            }

        };

        // Run the show!
        filterList.init();


    });
}(jQuery);