/*
<?php require_once('../../../../wp-load.php'); ?>
*/

function slideSwitch() {
    var $active = jQuery('#slideshow IMG.active');
    if ( $active.length == 0 ) $active = jQuery('#slideshow IMG:last');
    // use this to pull the images in the order they appear in the markup
    var $next =  $active.next().length ? $active.next()
        : jQuery('#slideshow IMG:first');
    // uncomment the 3 lines below to pull the images in random order
    // var $sibs  = $active.siblings();
    // var rndNum = Math.floor(Math.random() * $sibs.length );
    // var $next  = $( $sibs[ rndNum ] );
    $active.addClass('last-active');
    $next.css({opacity: 0.0})
        .addClass('active')
        .animate({opacity: 1.0}, 1000, function() {
            $active.removeClass('active last-active');
        });
}
jQuery(function() {
    setInterval( "slideSwitch()", 5000 );
});

function lightbox() {
    // Apply PrettyPhoto to find the relation with our portfolio item
    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
        // Parameters for PrettyPhoto styling
        animationSpeed:'fast',
        slideshow:5000,
        theme:'pp_default',
        show_title:false,
        overlay_gallery: false,
        social_tools: false
        
    });
}
if(jQuery().prettyPhoto) {
    lightbox();
}
jQuery(document).ajaxComplete(function() {
    lightbox();
});



<?php if (CircleLaw_option('menu-sliding') == "true"): ?>
    jQuery('#nav ul').spasticNav();
<?php endif; ?>