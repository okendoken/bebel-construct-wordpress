<?php


class bebelTeamBundleConfig  extends BebelBundleConfig
{

  public function __construct()
  {
    $this->bundleDir = 'bebelTeamBundle';
  }


  public function getAutoload()
  {
    $a = array(
        'bebelteambundleadminconfig' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/config/bebelClientsBundleAdminConfigfig.class.php',

    );

    return $a;
  }


  public function getSettings()
  {
    $s = array(
        'team_overview_page' => '',
        'team_per_page' => '8'
    );

    return $s;
  }

  public function getWordpress()
  {

    $w = array(
        'image_sizes' => array(
            'team-small'     => array(169, 169, true),
            'team-large'    => array(687, 200, true)
        ),
        'enqueue_scripts' => array(
            'ajax-retina-team' => array(
                'path' => get_template_directory_uri() . '/js/ajax-retina.js',
                'dependency' => array('jquery'),
                'when' => create_function('', 'global $post; return $post ? BebelSingleton::getInstance("BebelSettings")->get("team_overview_page") == get_the_ID() : false;')
            ),
        )
    );

    return $w;
  }

  // admin stuff
  public function getAdmin()
  {

    $modules = array(
        'team' => array(
            'title' => 'Team',
            'submenu' => array(
                'general' => array(
                    'title' => 'General',
                    'description' => 'Set up the team page'
                ),
            ),
            'widgets' => array(
                'team_overview_page' => array(
                    'title' => 'Team Overview Page',
                    'description' => 'Select a page where to show the overview over all team members',
                    'help' => '',
                    'template' => 'select_page',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                'team_per_page' => array(
                    'title' => 'Items Per Page',
                    'description' => 'How many team members should be displayed on one page before the pagination begins?',
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
        'add_scope' => array('member'),
        'menu_items' => array(
        ),
        'widgets' => array(
            'member_position' => array(
                'menu_item' => 'layout',
                'title' => 'Team Member Position',
                'description' => 'What Position does the user have? CEO, Product Manager, etc..',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('member'),
                'options' => array()
            ),
            'member_twitter' => array(
                'menu_item' => 'layout',
                'title' => 'User Twitter',
                'description' => 'Enter Twitter Page address to be displayed',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('member'),
                'options' => array()
            ),
            'member_facebook' => array(
                'menu_item' => 'layout',
                'title' => 'User Facebook Page',
                'description' => 'Enter Facebook Page address to be displayed',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('member'),
                'options' => array()
            ),
            'member_linkedin' => array(
                'menu_item' => 'layout',
                'title' => 'User Linked In Page',
                'description' => 'Enter LinkedIn Page address to be displayed',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('member'),
                'options' => array()
            ),
            'member_googple_plus' => array(
                'menu_item' => 'layout',
                'title' => 'User Google Plus Page',
                'description' => 'Enter Google Plus Page address to be displayed.',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('member'),
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

        'member' => array(
            'type_name' => 'member',
            'name' => 'Team Members',
            'singular_name' => 'Team Member',
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'menu_position' => 20,
            'query_var' => "bebel_unique_team",
            'type_hierarchical' => false,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'attachment', 'custom-fields', 'revisions', 'category'),
            'type_rewrite' => array('slug' => 'member', 'with_front' => true),
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