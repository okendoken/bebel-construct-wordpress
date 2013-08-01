<?php

//Sidebar
function construct_add_sidebar() {
    register_sidebar(array(
        'name' => __( 'Sidebar', 'construct' ),
        'id' => 'sidebar-1',
        'before_widget' => '<section class="sidebar-item">',
        'after_widget' => '</section>',
        'before_title' => '<h4 class="title">',
        'after_title' => ':</h4>',
    ));
}
add_action( 'init', 'construct_add_sidebar' );