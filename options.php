<?php
function add_options_generated_styles() {
    $settings = BebelSingleton::getInstance('BebelSettings');
    $backgroundImage = $settings->get('default_background');
    $textColor = $settings->get('color_text');
    $secondColor = $settings->get('color_second');
    $navItemDescriptionColor = $settings->get('color_navigation_description');
    $custom_css = "
                body{
                  background-image: url({$backgroundImage});
                }

                body,
                .logo .logo-content,
                .latest-posts-carousel .carousel-control,
                .social-icons a,
                .navigation .nav > li > a,
                .navigation .dropdown-menu > li > a,
                .post-preview .title a,
                .pagination > li > a,
                .pagination > li > span
                {
                  color: {$textColor};
                }

                .btn-danger,
                .btn-danger:hover,
                .btn-danger:focus,
                .btn-danger:active,
                .btn-danger.active,
                .btn-danger.disabled,
                .btn-danger[disabled]{
                   background-color: {$secondColor};
                }
                .btn-danger,
                .progress-danger .bar,
                .progress .bar-danger{
                   background-image: linear-gradient(to bottom, {$secondColor}, {$secondColor});
                }
                .btn-group.open .btn-danger.dropdown-toggle,
                .progress-danger .bar,
                .progress .bar-danger,
                .progress-danger.progress-striped .bar,
                .progress-striped .bar-danger,
                .navigation .nav li.dropdown:hover > .dropdown-toggle,
                .navigation .nav li.dropdown.active:hover > .dropdown-toggle,
                .portfolio-filters > li > .label.active{
                  background-color: {$secondColor};
                }
                .pagination > li > a:hover,
                .pagination > li > a:focus,
                .pagination > .active > a,
                .pagination > .active > span,
                .navigation .btn-navbar:hover,
                .navigation .dropdown-menu > li > a:hover,
                .navigation .dropdown-menu > li > a:focus,
                .navigation .dropdown-submenu:hover > a,
                .navigation .dropdown-submenu:focus > a,
                .navigation .dropdown-menu > .active > a,
                .navigation .dropdown-menu > .active > a:hover,
                .navigation .dropdown-menu > .active > a:focus,
                .clients .nav > li > a:hover,
                .clients .nav > li > a:focus,
                .navigation .navbar-toggle:hover,
                .comment-title > a:hover,
                .pagination > a:hover,
                .pagination{
                   color: {$secondColor};
                }
                .logo .square{
                   border: 5px solid {$secondColor};
                }
                .page-footer,
                .tp-bannertimer{
                   background: {$secondColor};
                }
                .latest-posts-carousel .carousel-control:hover,
                .more-link,
                .social-icons a:hover,
                .navigation .nav > .active > a .nav-item-title,
                .navigation .nav > .active > a:hover .nav-item-title,
                .navigation .nav > .active > a:focus .nav-item-title,
                .post-preview .title a:hover,
                .clients > .nav-tabs > .active > a,
                .clients > .nav-tabs > .active > a:hover,
                .clients > .nav-tabs > .active > a:focus,
                .clients-website,
                .clients-website:hover,
                .team-member .social-icons a:hover,
                .address-info-entry a:hover{
                  color: {$secondColor};
                }
                .navigation .nav > li > a:hover{
                  background: {$secondColor};
                }

                .navigation .nav li.dropdown:hover > .dropdown-toggle .nav-item-description,
                .navigation .nav li.dropdown.active:hover > .dropdown-toggle .nav-item-description,
                .navigation .nav > li > a:hover .nav-item-description {
                  color: {$navItemDescriptionColor};
                }
                .newsletter-input:focus,
                .sidebar-item .search-query:focus{
                  border-color: {$secondColor};
                }
                ";
    $custom_css .= $settings->get('css');
    wp_add_inline_style( 'main-stylesheet', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'add_options_generated_styles' );