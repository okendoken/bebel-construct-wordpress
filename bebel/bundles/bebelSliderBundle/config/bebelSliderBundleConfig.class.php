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
        'bebel_slide_set' => ''
        
    );

    return $s;
  }

  public function getWordpress()
  {

    $w = array(
        'image_sizes' => array(
        ),
        'enqueue_scripts' => array(
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


    $slider_sets_obj = BebelUtils::listRevSliders();
    $slider_sets = array();
    foreach($slider_sets_obj as $slider_set)
    {
        $slider_sets[$slider_set['id']] = $slider_set['title'].' ('.$slider_set['alias'].')';
    }
    
    
    $modules = array(
        'slider' => array(
            'title' => 'Slider',
            'submenu' => array(
                'mainpage_slider' => array(
                    'title' => 'Mainpage Content Slider',
                    'description' => 'Settings specific for the main page slider. '
                )
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
                )
            ),
            'bundle' => 'core'
        ),
        
    );

    
    $post_modules = array();

    
                    
                
    $pages = array();
    
    return array('modules' =>$modules, 'pages' => $pages, 'post_modules' => $post_modules);
  }


}