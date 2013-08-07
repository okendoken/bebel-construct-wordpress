<?php
$settings = BebelSingleton::getInstance('BebelSettings');

$postSlider = new BebelPostSlider(get_the_ID(), "horizontal-medium");
$postSlider->getImages();

echo $postSlider->getHtml();