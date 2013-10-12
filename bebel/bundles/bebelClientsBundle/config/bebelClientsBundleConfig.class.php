<?php


class bebelClientsBundleConfig  extends BebelBundleConfig
{

  public function __construct()
  {
    $this->bundleDir = 'bebelClientsBundle';
  }


  public function getAutoload()
  {
    $a = array(
        'bebelclientsbundleadminconfig' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/config/bebelClientsBundleAdminConfig.class.php',

    );

    return $a;
  }


  public function getSettings()
  {
    $s = array(
        'clients_page' => ''
    );

    return $s;
  }

  public function getWordpress()
  {

    $w = array(
        'image_sizes' => array(
            'clients-preview'     => array(526, 280, true)
        ),
        'enqueue_scripts' => array(
            'tab' => array(
                'path' => get_template_directory_uri() . '/js/lib/bootstrap/tab.js',
                'dependency' => array('jquery'),
                'when' => array($this, 'includeClientPageScripts')
            ),
            'tab-collapse' => array(
                'path' => get_template_directory_uri() . '/js/lib/bootstrap-tabcollapse.js',
                'dependency' => array('jquery'),
                'when' => array($this, 'includeClientPageScripts')
            ),
            'clients' => array(
                'path' => get_template_directory_uri().BebelUtils::getBundlePath() .'/'. $this->bundleDir. '/assets/js/clients.js',
                'dependency' => array('jquery'),
                'when' => array($this, 'includeClientPageScripts')
            )
        )
    );

    return $w;
  }

    public function includeClientPageScripts(){
        global $post;
        return $post ? BebelSingleton::getInstance("BebelSettings")->get("clients_page") == get_the_ID() : false;
    }

  // admin stuff
  public function getAdmin()
  {

    $modules = array(
        'clients' => array(
            'title' => 'Clients',
            'submenu' => array(
                'general' => array(
                    'title' => 'General',
                    'description' => 'Set up the clients page'
                ),
            ),
            'widgets' => array(
                'clients_page' => array(
                    'title' => 'Clients Overview Page',
                    'description' => 'Select a page where to show the overview over all clients',
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
        'add_scope' => array('client'),
        'menu_items' => array(
        ),
        'widgets' => array(
            'client_website' => array(
                'menu_item' => 'layout',
                'title' => 'Client Website',
                'description' => "Your client's homepage",
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('client'),
                'options' => array()
            )
        )
    );

    $pages = array(
        
      );
    
    return array('modules' =>$modules, 'pages' => $pages, 'post_modules' => $post_modules);
  }

  public function getPostTypes()
  {
      
      
    $pt = array(

        'client' => array(
            'type_name' => 'client',
            'name' => 'Clients',
            'singular_name' => 'Client',
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'menu_position' => 20,
            'query_var' => "bebel_unique_clients",
            'type_hierarchical' => false,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'attachment', 'custom-fields', 'revisions', 'category'),
            'type_rewrite' => array('slug' => 'client', 'with_front' => true),
            'use_taxonomy' => false, // required by our framework
            'menu_icon' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/assets/images/post_type_icon.png',
        ),


    );

    return $pt;
  }

  public function getBundleSettings()
  {
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