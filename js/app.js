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
    var transitionIsRunning = false, //check if transition takes place
        transitionDuration = parseFloat($('.logo').css('transition-duration')) * 1000;
    $("#menu-toggle").click(function(){
        var $this = $(this);
        if ($(window).width() < 768){
            if (transitionIsRunning){
                return;
            }
            var $logo = $('.logo'),
                $menu = $this.find('+ .nav-collapse'),
                $menuItems = $menu.find('> li'),
                lastChildMargin = parseInt($menu.find('> li:last-child').css('margin-bottom')),
                menuHeight = $menuItems.height() * $menuItems.length + lastChildMargin;
            if (!$menu.is(".in")){
                $logo.css("top", parseInt($logo.css('top')) + menuHeight);
            } else {
                $logo.css("top", '');
            }
            transitionIsRunning = true;
            setTimeout(function(){
                transitionIsRunning = false;
            }, transitionDuration);
        }
    });
});