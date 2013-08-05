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
        'bebel_slider_set' => '',
        'bebel_slider_auto_rotate' => 'on',
        'bebel_slider_count' => '4',
        'bebel_slider_display_time' => '4',
        'bebel_slider_transition_time' => '1000',
        'main_background_slider_time' => '400',
        
    );

    return $s;
  }

  public function getWordpress()
  {

    $w = array(
        'image_sizes' => array(
        ),
        'enqueue_scripts' => array(
            'jquery-touchSwipe' => array(
                'path' => BebelUtils::replaceToken('%BCP_BUNDLE_PATH%', 'BCP_BUNDLE_PATH').'/'.$this->bundleDir.'/assets/js/jquery.touchSwipe.js',
                'dependency' => array('jquery')
            ),
            'bebel-slider' => array(
                'path' => BebelUtils::replaceToken('%BCP_BUNDLE_PATH%', 'BCP_BUNDLE_PATH').'/'.$this->bundleDir.'/assets/js/bebelTouchSlider.js',
                'dependency' => array('jquery-touchSwipe')
            )
        ),
        'enqueue_styles' => array(
            'bebel-slider' => array(
                'path' => BebelUtils::replaceToken('%BCP_BUNDLE_PATH%', 'BCP_BUNDLE_PATH').'/'.$this->bundleDir.'/assets/css/bebelTouchSlider.css'
            )
        )
    );

    return $w;
  }

  // admin stuff
  public function getAdmin()
  {
    
    

    $tax_name = BebelUtils::getTaxonomyFullName('slider');
    
    $args = array('taxonomy' => $tax_name);
    $slider_sets_obj = get_categories( $args );
    
    $slider_sets = array();
    foreach($slider_sets_obj as $slider_set)
    {
        $slider_sets[$slider_set->term_id] = $slider_set->name;
    }
    
    $post_categories = BebelUtils::getCategorySelect();
    
    
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
                
                // bebel touch slider
                
                
                'bebel_slider_enable' => array(
                    'title' => 'Enable Mainpage Slider',
                    'description' => 'If its turned off, the default mainpage image will be used instead (can be found in "Basic"->"generals" settings.',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mainpage_slider',
                    'options' => array()
                ),
                'bebel_slider_set' => array(
                    'title' => 'Slider Set',
                    'description' => 'Select a custom made slider set to use specific images to link to your posts. You will have to create slides and put them in a set.',
                    'help' => '',
                    'template' => 'select_custom',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mainpage_slider',
                    'options' => array('options' => $slider_sets, 'first' => 'Slider Set')
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
                'bebel_slider_count' => array(
                    'title' => 'Slider Items',
                    'description' => 'How many items do you want to display in the mainpage content slider? (We recommend not to display more than 4 slides)',
                    'help' => '',
                    'template' => 'slider',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'bebel_slider',
                    'options' => array('min' => '2', 'max' => '10')
                ),
                'bebel_slider_display_time' => array(
                    'title' => 'Display Time',
                    'description' => 'How many seconds should a slide be displayed before the next one comes',
                    'help' => '',
                    'template' => 'slider',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'bebel_slider',
                    'options' => array('min' => '3', 'max' => '25')
                ),
                'bebel_slider_transition_time' => array(
                    'title' => 'Transition Time',
                    'description' => 'How fast should the slider move? In milliseconds (1000 ms = 1second)',
                    'help' => '',
                    'template' => 'slider',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'bebel_slider',
                    'options' => array('min' => '200', 'max' => '5000')
                ),
                    
            ),
            'bundle' => 'core'
        ),
        
    );

    
    $post_modules = array(
        'add_scope' => array('slider'),
        'widgets' => array(
            'post_link' => array(
                'menu_item' => 'layout',
                'title' => 'Link To URL',
                'description' => 'If you want to link to a post, enter the posts URL in here. You can also link to pages or other urls in this fields.',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('slider'),
                'options' => array()
            ),            
         )
    );

    
                    
                
    $pages = array();
    
    return array('modules' =>$modules, 'pages' => $pages, 'post_modules' => $post_modules);
  }


  public function getPostTypes()
  {   
    $pt = array(

        'slider' => array(
            'type_name' => 'slider',
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
            'taxonomy_name' => 'Slider Sets',
            'taxonomy_name_singular' => 'Slider Set',
            'taxonomy_rewrite' => true,
            'menu_icon' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/assets/images/post_type_icon.png',
        ),
    );

    return $pt;
  }


}