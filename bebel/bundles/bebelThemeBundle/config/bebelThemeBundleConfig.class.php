<?php


class bebelThemeBundleConfig  extends BebelBundleConfig
{

    public function __construct()
    {
        $this->bundleDir = 'bebelThemeBundle';
    }


    public function getAutoload()
    {
        $a = array(
            'bebelthemebundleadminconfig' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/config/bebelThemeBundleAdminConfig.class.php',
            'bebelthemeutils' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelThemeUtils.class.php',
            'newswidget' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/widgets/NewsWidget.class.php',
            'constructmenuwalker' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/ConstructMenuWalker.class.php'
        );

        return $a;
    }


    public function getSettings()
    {

        $s = array(
            'bebel_settings_last_update' => gmdate('D, d M Y H:i:s', time()),
            'css' => '',



            'default_background' => '%IMAGES_PATH%/example/background.jpg',
            'logo_header' => '',

            'mainpage_image' => '%IMAGES_PATH%/example/mainpage_image.jpg',

            'color_text' => '#3d3d3d',
            'color_second' => '#f24108'

        );

        return $s;
    }

    public function getWordpress()
    {

        $w = array(
            'theme_support' => array(
                'post-thumbnails',
                'automatic-feed-links'
            ),
            'nav_menus' => array(
                'header-menu' => __( 'Header Menu', BebelSingleton::getInstance('BebelSettings')->getPrefix() ),
            ),
            'actions' => array(),
            'filters' => array(
                'widget_text' => 'do_shortcode',
                'nav_menu_css_class' => array('bebelThemeUtils', 'activeNavClass')
            ),
            'enqueue_scripts' => array(
                'bootstrap-transition' => array(
                    'path' => get_template_directory_uri() . '/js/lib/bootstrap/bootstrap-transition.js',
                    'dependency' => array('jquery')
                ),
                'bootstrap-dropdown' => array(
                    'path' => get_template_directory_uri() . '/js/lib/bootstrap/bootstrap-dropdown.js',
                    'dependency' => array('jquery')
                ),
                'bootstrap-collapse' => array(
                    'path' => get_template_directory_uri() . '/js/lib/bootstrap/bootstrap-collapse.js',
                    'dependency' => array('jquery')
                ),
                'app' => array(
                    'path' => get_template_directory_uri() . '/js/app.js',
                    'dependency' => array('jquery')
                ),
                //page specific scripts
                'bootstrap-carousel' => array(
                    'path' => get_template_directory_uri() . '/js/lib/bootstrap/bootstrap-carousel.js',
                    'dependency' => array('jquery'),
                    'when' => create_function('', 'return is_home() || is_singular();')
                ),
                'home' => array(
                    'path' => get_template_directory_uri() . '/js/home.js',
                    'dependency' => array('jquery'),
                    'when' => create_function('', 'return is_home() || is_singular();')
                ),
                'comment-reply'
            ),
            'enqueue_styles' => array(
                'application' => array(
                    'path' => get_template_directory_uri() .	'/css/style.css'
                ),
                'main-stylesheet' => array(
                    'path' => get_template_directory_uri() .	'/style.css'
                )
            ),
            'image_sizes' => array(
                'horizontal-medium' => array(800, 400, true),
                'horizontal-large' => array(800, 640, true),
            )
        );

        return $w;
    }

    // admin stuff
    public function getAdmin()
    {
    // get templates
    $templates = $this->getTemplates();
    $templates_main = $templates;
    $templates_misc = $templates;
    unset($templates_main['base']['full']);
    unset($templates_misc['base']['full']);


        $modules = array(
            'general' => array(
                'title' => 'Basic',
                'submenu' => array(
                    'general' => array(
                        'title' => 'General Settings',
                        'description' => 'Change your logo, ...'
                    ),
                    'styling' => array(
                        'title' => 'Styling',
                        'description' => 'All style / css related'
                    ),
                ),
                'widgets' => array(
                    // logos


                    'logo_header' => array(
                        'title' => 'Logo Header',
                        'description' => 'Change your logo in the header. Optimal size: 289x57px',
                        'help' => '',
                        'template' => 'upload',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'general',
                        'options' => array('button_text' => 'Upload Header Logo')
                    ),
                    'default_background' => array(
                        'title' => 'Default Background Image',
                        'description' => 'Set a background image for posts. Make sure the file is big enough, as it gets stretched over the whole background.',
                        'help' => '',
                        'template' => 'upload',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'general',
                        'options' => array('button_text' => 'Upload Background Image')
                    ),

                    'css' => array(
                        'title' => 'Custom CSS',
                        'description' => 'If you have css styling you want to load on every page, put it in here. It is loaded after our css, so you can override our classes. But it is also loaded after the custom.css file, so pay attention not to override your own classes.',
                        'help' => 'It will check once a week for new updates.',
                        'template' => 'textarea',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'styling',
                        'options' => array()
                    ),
                    'color_text' => array(
                        'title' => 'Color of Text',
                        'description' => 'Change the default color of the text.',
                        'template' => 'colorpicker',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'styling',
                        'options' => array()
                    ),
                    'color_second' => array(
                        'title' => 'Second Color',
                        'description' => 'Color of more links, footer, progress bar etc.',
                        'template' => 'colorpicker',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'styling',
                        'options' => array()
                    ),
                    'mainpage_image' => array(
                        'title' => 'Default Image Mainpage',
                        'description' => 'Set the image on the main page.',
                        'help' => '',
                        'template' => 'upload',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'general',
                        'options' => array('button_text' => 'Upload Image')
                    ),
                ),
                'bundle' => 'core'
            )
        );

        $tax_name = BebelUtils::getTaxonomyFullName('slide');

        $args = array('taxonomy' => $tax_name);
        $slider_sets_obj = get_categories( $args );

        $slider_sets = array();
        foreach($slider_sets_obj as $slider_set)
        {
            $slider_sets[$slider_set->term_id] = $slider_set->name;
        }


        $post_modules = array(
            'meta_panel_type' => 'tab',
            'add_scope' => array('post', 'page', 'global'),
            'menu_items' => array(
                'layout' => array(
                    'title' => 'Layout',
                    'scope' => array('global'),
                    'bundle' => 'core'
                ),
                'post_slider' => array(
                    'title' => 'Post Slider',
                    'scope' => array('post', 'page'),
                    'bundle' => 'core',
                ),
                'misc' => array(
                    'title' => 'Misc',
                    'scope' => array('global'),
                    'bundle' => 'core',
                )
            ),
            'widgets' => array(
                'post_layout' => array(
                    'menu_item' => 'layout',
                    'title' => 'Post Layout',
                    'description' => 'Choose a Layout for this Post',
                    'help' => '',
                    'template' => 'select_template',
                    'permission' => 'edit_post',
                    'scope' => array('post'),
                    'options' => array('options' => $templates['post'], 'default' => $templates['default']['post'])
                ),
                'page_layout' => array(
                    'menu_item' => 'layout',
                    'title' => 'Page Layout',
                    'description' => 'Choose a Layout for this Page',
                    'help' => '',
                    'template' => 'select_template',
                    'permission' => 'edit_post',
                    'scope' => array('page'),
                    'options' => array('options' => $templates['page'], 'default' => $templates['default']['page'])
                ),
                'css' => array(
                    'menu_item' => 'misc',
                    'title' => 'CSS',
                    'description' => 'Create some custom CSS',
                    'help' => '',
                    'template' => 'textarea',
                    'permission' => 'edit_post',
                    'scope' => array('global'),
                    'options' => array()
                ),
                'slide_set' => array(
                    'menu_item' => 'post_slider',
                    'title' => 'Post Slide Set',
                    'description' => 'Select slide set to be displayed in the slider',
                    'help' => '',
                    'template' => 'select_template',
                    'permission' => 'edit_post',
                    'scope' => array('post', 'page'),
                    'options' => array('options' => $slider_sets)
                )
            )
        );


        $pages = array(
            'bebelHelp' =>
            array(
                'title' => 'Help & Support',
                'page_title' => 'You can get free support here',
                'parent' => 'bebelAdminTop',
                'permission' => 'edit_theme_options',
                'class' => $this->bundleDir
            )
        );

        return array('modules' =>$modules, 'pages' => $pages, 'post_modules' => $post_modules);
    }

    public function getTemplates()
    {
    $t = array(

        'post' => array(
            'with-image' => 'With Image',
            'no-image' => 'No Image'
        ),
        'page' => array(
            'with-image' => 'With Image',
            'no-image' => 'No Image'
        ),
        'mainpage' => array('no-bottom-posts' => 'No Bottom Posts', 'with-bottom-posts' => 'With Bottom Posts'),
        'default' => array('post' => 'with-image', 'page' => 'with-image')

    );

        return $t;
    }

    public function getBundleSettings()
    {
        $bs = array(
        );

        return $bs;
    }

    public function getWidgets()
    {
        return array(
            array(
                'widget-class' => 'NewsWidget',
                'name' => 'news',
                'autoload' => true
            )
        );
    }

    public function getSidebars()
    {

        return array(array(
            'name' => __( 'Sidebar', BebelSingleton::getInstance('BebelSettings')->getPrefix() ),
            'id' => 'sidebar-1',
            'before_widget' => '<section class="sidebar-item">',
            'after_widget' => '</section>',
            'before_title' => '<h4 class="title">',
            'after_title' => ':</h4>',
        ));
    }
}