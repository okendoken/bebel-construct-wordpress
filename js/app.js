/**
 * Cross-browser wrapper for jQuery css method
 * @param $element
 * @param property
 * @param value
 */
function css($element, property, value){
    $element.css('-webkit-' + property, value);
    $element.css('-moz-' + property, value);
    $element.css('-o-' + property, value);
    $element.css(property, value);
}

!function ($){
    $(function(){
        /***********************************/
        /*       Smooth scroll to top      */
        /***********************************/

        $(".to-top-link").click(function() {
            $("html, body").animate({ scrollTop: 0 }, "fast");
            return false;
        });

        /***********************************/
        /*           Menu toggle           */
        /***********************************/

        /*   Move logo down when menu opened */
        var $menu = $(".navbar-main");
        $menu.on('show.bs.collapse', function(){
            var $this = $(this);
            if ($(window).width() < 768){
                var $logo = $('.logo'),
                    $menuItems = $menu.find('ul > li'),
                    lastChildMargin = parseInt($menu.find('ul > li:last-child').css('margin-bottom')),
                    menuHeight = 0;
                $menuItems.each(function(){
                    menuHeight += $(this).height()
                });
                menuHeight += lastChildMargin;
                $logo.css("top", parseInt($logo.css('top')) + menuHeight);
            }
        });

        $menu.on('hide.bs.collapse', function(){
            if ($(window).width() < 768){
                $('.logo').css("top", '');
            }
        });

        function adjustCarouselHeight(){
            if ($(window).width() > 767 && $(window).width() < 992){
                var $navigation = $('.navigation'),
                    $sliderWrap = $('.rev_slider_wrapper');
                $('.page-carousel').height(
                    $navigation.height()
                        + parseInt($navigation.css('top'))
                        - parseInt($sliderWrap.length > 0 ? $sliderWrap.css('margin-top') : 0)
                );
            }
            if ($(window).width() <= 767 || $(window).width() >= 992){
                $('.page-carousel').height('');
            }
        }

        adjustCarouselHeight();
        $(window).resize(function(){
            $menu.collapse('hide');
            $('.logo').css("top", '');
            adjustCarouselHeight();
        });
    });
}(window.jQuery);