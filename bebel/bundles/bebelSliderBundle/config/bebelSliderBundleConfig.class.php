<?php


class bebelSliderBundleConfig  extends BebelBundleConfig
{

  public function __construct()
  {
    $this->bundleDir = 'bebelSliderBundle';
  }


  public function getAutoload()
  {
    $a = array(
        'bebelsliderbundleadminconfig' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/config/bebelSliderBundleAdminConfig.class.php',
        'bebelsliderbase' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelSliderBase.class.php',

        'bebelpostslider' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelPostSlider.class.php',

    );

    return $a;
  }


  public function getSettings()
  {
    $s = array(
        
        // bebel touch slider
        'bebel_slider_enable' => 'off',
        'bebel_slide_set' => '',
        'bebel_slider_auto_rotate' => 'on',
        'bebel_slide_display_time' => '10'
        
    );

    return $s;
  }

  public function getWordpress()
  {

    $w = array(
        'image_sizes' => array(
        ),
        'enqueue_scripts' => array(
            'bootstrap-carousel' => array(
                'path' => get_template_directory_uri() . '/js/lib/bootstrap/bootstrap-carousel.js',
                'dependency' => array('jquery'),
                'when' => create_function('', 'return is_home() || is_singular();')
            ),
            'slider' => array(
                'path' => get_template_directory_uri().BebelUtils::getBundlePath() .'/'. $this->bundleDir. '/assets/js/slider.js',
                'dependency' => array('jquery'),
                'when' => create_function('', 'return is_home() || is_singular();')
            )
        )
    );

    return $w;
  }

  // admin stuff
  public function getAdmin()
  {
    
    

    $tax_name = BebelUtils::getTaxonomyFullName('slide');

    $args = array('taxonomy' => $tax_name);
    $slider_sets_obj = get_categories( $args );
    
    $slider_sets = array();
    foreach($slider_sets_obj as $slider_set)
    {
        $slider_sets[$slider_set->term_id] = $slider_set->name;
    }
    
    
    $modules = array(
        'slider' => array(
            'title' => 'Slider',
            'submenu' => array(
                'mainpage_slider' => array(
                    'title' => 'Mainpage Content Slider',
                    'description' => 'Settings specific for the main page slider. '
                ),
                'bebel_slider' => array(
                    'title' => 'Content Slider',
                    'description' => 'Settings for Content Slider (these settings also apply for the main page content slider)'
                ),
            ),
            'widgets' => array(
                
                'bebel_slider_enable' => array(
                    'title' => 'Enable Mainpage Slider',
                    'description' => 'If its turned off, the default mainpage image will be used instead (can be found in "Basic"->"generals" settings.',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mainpage_slider',
                    'options' => array()
                ),
                'bebel_slide_set' => array(
                    'title' => 'Slide Set',
                    'description' => 'Select a custom made slide set to use specific images to link to your posts. You will have to create slides and put them in a set.',
                    'help' => '',
                    'template' => 'select_custom',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mainpage_slider',
                    'options' => array('options' => $slider_sets, 'first' => 'Slide Set')
                ),
                'bebel_slider_auto_rotate' => array(
                    'title' => 'Auto Rotation',
                    'description' => 'Should the slides scroll automatically?',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'bebel_slider',
                    'options' => array()
                ),
                'bebel_slide_display_time' => array(
                    'title' => 'Display Time',
                    'description' => 'How many seconds should a slide be displayed before the next one comes',
                    'help' => '',
                    'template' => 'slider',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'bebel_slider',
                    'options' => array('min' => '3', 'max' => '25')
                )
                    
            ),
            'bundle' => 'core'
        ),
        
    );

    
    $post_modules = array();

    
                    
                
    $pages = array();
    
    return array('modules' =>$modules, 'pages' => $pages, 'post_modules' => $post_modules);
  }


  public function getPostTypes()
  {   
    $pt = array(

        'slider' => array(
            'type_name' => 'slide',
            'name' => 'Slides',
            'singular_name' => 'Slide',
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'menu_position' => 20,
            'query_var' => true,
            'type_hierarchical' => false,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'attachment', 'revisions', 'category'),
            'type_rewrite' => array('slug' => 'slide', 'with_front' => false),
            'use_taxonomy' => true, // required by our framework
            'taxonomy_hierarchical' => true,
            'taxonomy_name' => 'Slide Sets',
            'taxonomy_name_singular' => 'Slide Set',
            'taxonomy_rewrite' => true,
            'menu_icon' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/assets/images/post_type_icon.png',
        ),
    );

    return $pt;
  }


}