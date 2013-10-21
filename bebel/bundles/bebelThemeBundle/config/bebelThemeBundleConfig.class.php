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
            'bebelretinahelper' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelRetinaHelper.class.php',
            'bebelnewswidget' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/widgets/BebelNewsWidget.class.php',
            'bebelsocialwidget' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/widgets/BebelSocialWidget.class.php',
            'constructmenuwalker' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/ConstructMenuWalker.class.php',
            'bebelthememailing' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelThemeMailing.class.php'
        );

        return $a;
    }


    public function getSettings()
    {

        $s = array(
            'bebel_settings_last_update' => gmdate('D, d M Y H:i:s', time()),



            'default_background' => '',
            'logo_header' => '',

            'mainpage_image' => '',
            'footer_text' => 'This site was handcrafted by Bebel',
            'generate_2x_images' => 'on',

            'twitter_url' => '',
            'facebook_url' => '',
            'linkedin_url' => '',
            'google_plus_url' => '',

            // contact page
            'contact_page' => '',
            'contact_email' => '',
            'contact_phone' => '',
            'contact_business_name' => '',
            'contact_display_google_maps' => 'on',
            'contact_address' => '',

            // blog page
            'blog_overview_page' => '',

            'css' => '',
            'color_text' => '#3d3d3d',
            'color_second' => '#f24108',
            'color_navigation_description' => '#f3cb85'

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
                'nav_menu_css_class' => array('bebelThemeUtils', 'activeNavClass'),
                'wp_generate_attachment_metadata' => array('bebelRetinaHelper', 'generateAttachmentMetaData')
            ),
            'enqueue_scripts' => array(
                'bootstrap-transition' => array(
                    'path' => get_template_directory_uri() . '/js/lib/bootstrap/transition.js',
                    'dependency' => array('jquery')
                ),
                'bootstrap-dropdown' => array(
                    'path' => get_template_directory_uri() . '/js/lib/bootstrap/dropdown.js',
                    'dependency' => array('jquery')
                ),
                'bootstrap-collapse' => array(
                    'path' => get_template_directory_uri() . '/js/lib/bootstrap/collapse.js',
                    'dependency' => array('jquery')
                ),
                'bootstrap-alert' => array(
                    'path' => get_template_directory_uri() . '/js/lib/bootstrap/alert.js',
                    'dependency' => array('jquery')
                ),
                'app' => array(
                    'path' => get_template_directory_uri() . '/js/app.js',
                    'dependency' => array('jquery')
                ),
                //picturefill.js. Responsive images on demand
                'picturefill' => array(
                    'path' => get_template_directory_uri() . '/js/lib/picturefill.js',
                    'dependency' => array()
                ),
                //retina
                'retina' => array(
                    'path' => get_template_directory_uri() . '/js/lib/retina.js',
                    'dependency' => array(),
                    'when' => create_function('', 'return BebelSingleton::getInstance("BebelSettings")->get("generate_2x_images") == "on";')
                ),
                'ajax-retina' => array(
                    'path' => get_template_directory_uri() . '/js/ajax-retina.js',
                    'dependency' => array('jquery'),
                    'when' => create_function('', 'return is_archive();')
                ),
                //gmap3
                'gmaps-api' => array(
                    'path' => 'http://maps.google.com/maps/api/js?sensor=false&language=en',
                    'dependency' => array(),
                    'when' => create_function('', 'global $post; return $post ? BebelSingleton::getInstance("BebelSettings")->get("contact_page") == get_the_ID() : false;')
                ),
                'gmap3' => array(
                    'path' => get_template_directory_uri() . '/js/lib/gmap3.min.js',
                    'dependency' => array(),
                    'when' => create_function('', 'global $post; return $post ? BebelSingleton::getInstance("BebelSettings")->get("contact_page") == get_the_ID() : false;')
                ),
                'contact' => array(
                    'path' => get_template_directory_uri().BebelUtils::getBundlePath() .'/'. $this->bundleDir. '/assets/js/contact.js',
                    'dependency' => array(),
                    'when' => create_function('', 'global $post; return $post ? BebelSingleton::getInstance("BebelSettings")->get("contact_page") == get_the_ID() : false;')
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
                'blog-preview-small' => array(134, 134, true),
                'blog-preview-large' => array(685, 350, true)
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
                    'contact' => array(
                        'title' => 'Contact Page',
                        'description' => 'Setup the contact page'
                    ),
                    'blog' => array(
                        'title' => 'Blog',
                        'description' => 'Have a blog? Set up the blog page!'
                    ),
                    'social' => array(
                        'title' => 'Twitter, Facebook, LinkedIn',
                        'description' => 'Set up your twitter, facebook and linkedIn accounts'
                    ),
                    'retina' => array(
                        'title' => 'Retina',
                        'description' => 'Your high ppi options'
                    ),
                    'styling' => array(
                        'title' => 'Styling',
                        'description' => 'All style / css related'
                    ),
                ),
                'widgets' => array(

                    //general
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
                    'mainpage_image' => array(
                        'title' => 'Default Image Mainpage',
                        'description' => 'Set the image on the main page.',
                        'help' => '',
                        'template' => 'upload',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'general',
                        'options' => array('button_text' => 'Upload Image')
                    ),
                    'footer_text' => array(
                        'title' => 'Footer Text',
                        'description' => 'Copyright text in footer. Put copyright or whatever here.',
                        'template' => 'textarea',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'general',
                        'options' => array()
                    ),

                    //social

                    'twitter_url' => array(
                        'title' => 'Twitter Page URL',
                        'description' => 'Insert your Twitter page URL',
                        'help' => '',
                        'template' => 'input',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'social',
                        'options' => array()
                    ),
                    'facebook_url' => array(
                        'title' => 'Facebook Page URL',
                        'description' => 'Insert your Facebook page URL',
                        'help' => '',
                        'template' => 'input',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'social',
                        'options' => array()
                    ),
                    'linkedin_url' => array(
                        'title' => 'LinkedIn Page URL',
                        'description' => 'Insert your LinkedIn page URL',
                        'help' => '',
                        'template' => 'input',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'social',
                        'options' => array()
                    ),
                    'google_plus_url' => array(
                        'title' => 'Google Plus Page URL',
                        'description' => 'Insert your Google Plus page URL',
                        'help' => '',
                        'template' => 'input',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'social',
                        'options' => array()
                    ),

                    //retina
                    'generate_2x_images' => array(
                        'title' => 'Retina Ready Images',
                        'description' => 'Whether to generate images for high ppi devices (iPad, MacBook, etc.)',
                        'template' => 'select_true_false',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'retina',
                        'options' => array()
                    ),
                    'generate_2x_images_action' => array(
                        'title' => 'All Images',
                        'description' => 'Press this button if you want to regenerate retina images for all attachments',
                        'help' => "Note: this may take much time, so don't leave page when generating.",
                        'template' => 'generate_2x_images',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'retina',
                        'options' => array()
                    ),

                    // contact page

                    'contact_page' => array(
                        'title' => 'Contact Page',
                        'description' => 'Choose a page for the contact page layout.',
                        'help' => '',
                        'template' => 'select_page',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'contact',
                        'options' => array()
                    ),
                    'contact_email' => array(
                        'title' => 'Email for Form',
                        'description' => 'Enter the email address the contact requests should be sent to if no person is selected.<strong>Warning:</strong> If empty, the default admin email address will be used.',
                        'help' => '',
                        'template' => 'input',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'contact',
                        'options' => array()
                    ),
                    'contact_phone' => array(
                        'title' => 'Phone Number',
                        'description' => "Leave blank if you don't want to show it",
                        'help' => '',
                        'template' => 'input',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'contact',
                        'options' => array()
                    ),
                    'contact_business_name' => array(
                        'title' => 'Business Name',
                        'description' => 'The legal name of your business',
                        'help' => '',
                        'template' => 'input',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'contact',
                        'options' => array()
                    ),
                    'contact_address' => array(
                        'title' => 'Address',
                        'description' => 'Enter your address in one line (seperate facts by a comma). Will be used for google maps. Example: Mystreet 32, 12345 New York, NY, USA',
                        'help' => '',
                        'template' => 'input',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'contact',
                        'options' => array()
                    ),
                    'contact_display_google_maps' => array(
                        'title' => 'Google Maps',
                        'description' => 'Whether to display google maps.',
                        'help' => '',
                        'template' => 'select_true_false',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'contact',
                        'options' => array()
                    ),
                    // blog page

                    'blog_overview_page' => array(
                        'title' => 'Blog Page',
                        'description' => 'Choose a page for the blog page layout. This is where all your blog categories will be displayed.',
                        'help' => '',
                        'template' => 'select_page',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'blog',
                        'options' => array()
                    ),

                    //styling
                    'css' => array(
                        'title' => 'Custom CSS',
                        'description' => 'If you have css styling you want to load on every page, put it in here. It is loaded after our css, so you can override our classes. But it is also loaded after the custom.css file, so pay attention not to override your own classes.',
                        'template' => 'textarea',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'styling',
                        'options' => array()
                    ),
                    'color_text' => array(
                        'title' => 'Text Color',
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
                    'color_navigation_description' => array(
                        'title' => 'Navigation Description Color',
                        'description' => 'Navigation item description color. A bit lighter than second color.',
                        'template' => 'colorpicker',
                        'permission' => 'edit_theme_options',
                        'submenu' => 'styling',
                        'options' => array()
                    )
                ),
                'bundle' => $this->bundleDir
            )
        );

        $slider_sets_obj = BebelUtils::listRevSliders();
        $slider_sets = array();
        foreach($slider_sets_obj as $slider_set)
        {
            $slider_sets[$slider_set['id']] = $slider_set['title'].' ('.$slider_set['alias'].')';
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
                'widget-class' => 'BebelNewsWidget',
                'name' => 'bebel_news',
                'autoload' => true
            ),
            array(
                'widget-class' => 'BebelSocialWidget',
                'name' => 'bebel_social',
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