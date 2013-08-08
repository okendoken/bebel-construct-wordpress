<?php
function add_options_generated_styles() {
    $settings = BebelSingleton::getInstance('BebelSettings');
    $backgroundImage = $settings->get('default_background');
    $textColor = $settings->get('color_text');
    $secondColor = $settings->get('color_second');
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
                .pagination ul > li > a,
                .pagination ul > li > span
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
                .navigation .nav li.dropdown.open > .dropdown-toggle,
                .navigation .nav li.dropdown.open.active > .dropdown-toggle{
                  background-color: {$secondColor};
                }
                .pagination ul > li > a:hover,
                .pagination ul > li > a:focus,
                .pagination ul > .active > a,
                .pagination ul > .active > span,
                .navigation .btn-navbar:hover,
                .navigation .dropdown-menu > li > a:hover,
                .navigation .dropdown-menu > li > a:focus,
                .navigation .dropdown-submenu:hover > a,
                .navigation .dropdown-submenu:focus > a,
                .clients .nav > li > a:hover,
                .clients .nav > li > a:focus{
                   color: {$secondColor};
                }
                .logo .square{
                   border: 5px solid {$secondColor};
                }
                .page-footer{
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
                .team-member .social-icons a:hover{
                  color: {$secondColor};
                }
                .navigation .nav > li > a:hover{
                  background: {$secondColor};
                }

                ";
    $custom_css .= $settings->get('css');
    wp_add_inline_style( 'main-stylesheet', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'add_options_generated_styles' );