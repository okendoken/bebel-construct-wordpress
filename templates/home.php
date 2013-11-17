<?php

$postSlider = new BebelPostSlider(false, "horizontal-large");
$postSlider->getImages();

BebelSingleton::addClass('postSlider', $postSlider);

get_template_part( 'templates/_navigation', get_post_format() );
get_template_part( 'templates/_carousel', get_post_format() );