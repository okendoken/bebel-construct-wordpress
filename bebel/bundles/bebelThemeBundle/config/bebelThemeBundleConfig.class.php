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
        'newswidget' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/widgets/NewsWidget.class.php',
        'newsletterwidget' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/widgets/NewsletterWidget.class.php',
        
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

        'color_text' => '#666666',
        
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
            'widget_text' => 'do_shortcode'
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
            'main-stylesheet' => array(
                'path' => get_template_directory_uri() .	'/style.css'
            ),
            'application' => array(
                'path' => get_template_directory_uri() .	'/css/style.css'
            )
        ),
        'image_sizes' => array(
            'post-single-wide'   => array(685, 280, true),
            'vertical-big' => array(371, 738, true),
            'blog-thumb' => array(124, 124, true),
            'full-small' => array(850, 298, true),
            'full-big' => array(850, 483, true),
            'full-tablet' => array(768, 480, true)
        )
    );

    return $w;
  }

  // admin stuff
  public function getAdmin()
  {
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
                    'description' => 'Change your logo in the header. Optimal size: 150x43px',
                    'help' => '',
                    'template' => 'upload',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array('button_text' => 'Upload Header Logo')
                ),
                'default_background' => array(
                    'title' => 'Default Background Image',
                    'description' => 'Set a background image for posts without custom background image and every other page that does not use a custom one. Make sure the file is big enough, as it gets streched over the whole background.',
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
                )
            ),
            'bundle' => 'core'
          )
      );
    $post_modules['widgets'] = array();

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
    $t = array();

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
            'NewsWidget',
            'NewsletterWidget',
        );
    }

}