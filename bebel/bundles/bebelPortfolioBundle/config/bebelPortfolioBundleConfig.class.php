<?php


class bebelportfolioBundleConfig  extends BebelBundleConfig
{

  public function __construct()
  {
    $this->bundleDir = 'bebelportfolioBundle';
  }


  public function getAutoload()
  {
    $a = array(
        'bebelportfoliobundleadminconfig' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/config/bebelClientsBundleAdminConfigfig.class.php',

    );

    return $a;
  }


  public function getSettings()
  {
    $s = array(
        'portfolio_overview_page' => '',
        'portfolio_per_page' => '8'
    );

    return $s;
  }

  public function getWordpress()
  {

    $w = array(
        'enqueue_scripts' => array(
            'ajax-retina-team' => array(
                'path' => get_template_directory_uri() . '/js/ajax-retina.js',
                'dependency' => array('jquery'),
                'when' => create_function('', 'global $post; return $post ? BebelSingleton::getInstance("BebelSettings")->get("portfolio_overview_page") == get_the_ID() : false;')
            ),
        )
    );

    return $w;
  }

  // admin stuff
  public function getAdmin()
  {

    $modules = array(
        'portfolio' => array(
            'title' => 'Portfolio',
            'submenu' => array(
                'general' => array(
                    'title' => 'General',
                    'description' => 'Set up the portfolio page'
                ),
            ),
            'widgets' => array(
                'portfolio_overview_page' => array(
                    'title' => 'Portfolio Overview Page',
                    'description' => 'Select a page where to show the overview over all of your completed works',
                    'help' => '',
                    'template' => 'select_page',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                'portfolio_per_page' => array(
                    'title' => 'Items Per Page',
                    'description' => 'How many portfolio items should be displayed on one page before the pagination begins?',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                )
            ),
            'bundle' => $this->bundleDir
          ),
      );

    

    $post_modules = array(
        'add_scope' => array('portfolio'),
        'menu_items' => array(
        ),
        'widgets' => array(
            'portfolio_website' => array(
                'menu_item' => 'layout',
                'title' => 'Website',
                'description' => 'Enter Website to be displayed',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('portfolio'),
                'options' => array()
            ),
        )
    );

    $pages = array(
        
      );
    
    return array('modules' =>$modules, 'pages' => $pages, 'post_modules' => $post_modules);
  }

  public function getPostTypes()
  {
      
      
    $pt = array(

        'portfolio' => array(
            'type_name' => 'portfolio',
            'name' => 'Portfolio Items',
            'singular_name' => 'Portfolio Item',
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'menu_position' => 20,
            'query_var' => "bebel_unique_portfolio",
            'type_hierarchical' => false,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'attachment', 'custom-fields', 'revisions', 'category'),
            'type_rewrite' => array('slug' => 'portfolio', 'with_front' => true),
            'use_taxonomy' => false, // required by our framework
            'menu_icon' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/assets/images/post_type_icon.png',
        ),


    );

    return $pt;
  }

  public function getBundleSettings()
  {
    $templates = $this->getTemplates();
    $bs = array();

    return $bs;
  }

  
  public function getWidgets()
  {
    $w = array(
    );

    return $w;
  }

}