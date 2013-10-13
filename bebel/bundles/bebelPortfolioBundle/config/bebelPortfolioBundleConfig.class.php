<?php


class bebelportfolioBundleConfig  extends BebelBundleConfig
{

  public function __construct()
  {
    $this->bundleDir = 'bebelPortfolioBundle';
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
        'portfolio_overview_page' => ''
    );

    return $s;
  }

  public function getWordpress()
  {

    $w = array(
        'image_sizes' => array(
            'portfolio-small'     => array(227, 227, true),
            'portfolio-large'    => array(687, 200, true)
        ),
        'enqueue_scripts' => array(
            'jquery.easing' => array(
                'path' => get_template_directory_uri().BebelUtils::getBundlePath() .'/'. $this->bundleDir. '/assets/js/lib/jquery.easing.1.3.js',
                'dependency' => array('jquery'),
                'when' => array($this, 'includeClientPageScripts')
            ),
            'jquery.mixitup' => array(
                'path' => get_template_directory_uri().BebelUtils::getBundlePath() .'/'. $this->bundleDir. '/assets/js/lib/jquery.mixitup.js',
                'dependency' => array('jquery'),
                'when' => array($this, 'includeClientPageScripts')
            ),
            'ajax-retina-team' => array(
                'path' => get_template_directory_uri() . '/js/ajax-retina.js',
                'dependency' => array('jquery'),
                'when' => array($this, 'includeClientPageScripts')
            ),
            'portfolio' => array(
                'path' => get_template_directory_uri().BebelUtils::getBundlePath() .'/'. $this->bundleDir. '/assets/js/portfolio.js',
                'dependency' => array('jquery'),
                'when' => array($this, 'includeClientPageScripts')
            )
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
            'use_taxonomy' => true,
            'taxonomy_hierarchical' => false,
            'taxonomy_name' => 'Portfolio Categories',
            'taxonomy_name_singular' => 'Portfolio Category',
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

    public function includeClientPageScripts(){
        global $post;
        return $post ? BebelSingleton::getInstance("BebelSettings")->get("portfolio_overview_page") == get_the_ID() : false;
    }

}