<?php
$settings = BebelSingleton::getInstance('BebelSettings');

$postSlider = new BebelPostSlider(get_the_ID(), "horizontal-medium");
$postSlider->getImages();

BebelSingleton::addClass('postSlider', $postSlider);

if (have_posts()) {
    while (have_posts()) {
        the_post();
        get_template_part( 'templates/_navigation', get_post_format() );
        get_template_part( 'templates/_carousel', get_post_format() );
        get_template_part( 'templates/_article', get_post_format() );

        bebelThemeUtils::getPageFooterTemplate();
    }
}


