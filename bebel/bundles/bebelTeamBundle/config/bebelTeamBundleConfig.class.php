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
        'bebelteambundleadminconfig' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/config/bebelTeamBundleAdminConfig.class.php',

    );

    return $a;
  }


  public function getSettings()
  {
    $s = array(
        'team_overview_page' => '',
        'team_per_page' => '8',
        'team_page_description' => 'Our Awesome Staff Is At Your Service',
    );

    return $s;
  }

  public function getWordpress()
  {

    $w = array(
        'image_sizes' => array(
            'team-small'     => array(169, 169, true)
        ),
    );

    return $w;
  }

  // admin stuff
  public function getAdmin()
  {

    $templates = $this->getTemplates();
    unset($templates['categories']['one_column'], $templates['categories']['two_column']);

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
                ),
                'team_page_description' => array(
                    'title' => 'Team Page Description',
                    'description' => 'What text to display next to the logo in the header (empty for none). (eg. Our Awesome Staff Is At Your Service)',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
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
            'member_show_email' => array(
                'menu_item' => 'layout',
                'title' => 'Show User Email',
                'description' => 'If activated, the users will be shown in a drop down list on the contact page, and an<br> "email user" button below the member entry on the team page. The email will not be shown to the user, it will be used to send the contact form email to him.',
                'help' => '',
                'template' => 'select_true_false',
                'permission' => 'edit_post',
                'scope' => array('member'),
                'options' => array()
            ),
            'member_email' => array(
                'menu_item' => 'layout',
                'title' => 'User Email',
                'description' => 'Enter the Email address to be used.',
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

  public function getTemplates()
  {
    $t = array(
        'base_portfolio' => array('left' => 'Sidebar on left side', 'right' => 'Sidebar on right side', 'full' => 'No sidebar (full width)'),
        'header' => 'header-portfolio',
        'portfolio' => array(
            'full' => 'Full Width',
            'sidebar_left' => 'Sidebar Left',
            'sidebar_right' => 'Sidebar Right',
        ),
        'default' => array('portfolio' => 'one_column'),
        'categories' => array('one_column' => 'One Column', 'two_column' => 'Two Columns', 'three_column' => 'Three Columns')
    );

    return $t;
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