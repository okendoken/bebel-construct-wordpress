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
        'bebelthemebundlelayoutfiles' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/config/bebelThemeBundleLayoutFiles.class.php',
        'bebelthemeutils' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelThemeUtils.class.php',
        'bebelthememailing' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelThemeMailing.class.php',
        
        
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
        
        // mainpage image
        'mainpage_image' => '%IMAGES_PATH%/example/mainpage_image.jpg',
        'mainpage_text_logo' => '+people',
        'mainpage_text_logo_load' => 'off',
        'mainpage_text_introduction_title' => 'We Are The Social Firm',
        'mainpage_text_introduction' => 'For more than a decade we are in the business of marketing and communication. See for yourself how we are able to help you make the most out of your business.',
        
        // blog page
        'blog_overview_page' => '',
        'blog_overview_page_text' => '',
        
        
        // contact page
        'contact_overview_page' => '',
        'contact_email' => '',
        'contact_address' => '',
        'contact_address_html' => '',
        'contact_text' => '',
        
        /// mail settings
        'mailer_type' => 'mail',
        'mailer_smtp_host' => '',
        'mailer_smtp_port' => '',
        'mailer_smtp_ssl' => 'off',
        'mailer_smtp_username' => '',
        'mailer_smtp_password' => '',
        'mailer_sendmail' => '/usr/sbin/sendmail -bs',
        'mailer_send_from' => 'YourNameHere',
        'mailer_send_from_mail' => '',
        
        // google
        'googlefont' => '',
        'google_analytics_name' => '',
        
        // update notifications
        'update_notifications' => 'off',
        
        // social media
        'twitter_username' => 'TheBebel',
        'facebook_url' => '',
        'feedburner_url' => '',
        
        
        // color chooser
        'color_logo' => '#7e725b',
        'color_logo_hover' => '#7e7299',
        'color_text' => '#666666',
        'color_more' => '#333333',
        'color_submit' => '#333333',
        'color_scrollbar' => '#7e725b',
        'color_scrollbar_hover' => '#a39376',
        
    );

    return $s;
  }

  public function getWordpress()
  {
    
    $w = array(
        'theme_support' => array(
            'menus',
            'post-thumbnails',
            'automatic-feed-links'
         ),
        'nav_menus' => array(
            'top_menu' => 'Main Menu',
        ),
        'actions' => array(),
        'filters' => array(
            'widget_text' => 'do_shortcode',
            'get_search_form' => array('bebelThemeUtils', 'getSearchForm'),
        ),
        'enqueue_scripts' => array(
            'comment-reply' => array(
                'environment' => 'frontend'
            ),
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
                    'title' => 'Twitter, RSS, Facebook',
                    'description' => 'Set up your twitter, facebook and feedburner accounts'
                ),
                /*
                'mail' => array(
                    'title' => 'Mail',
                    'description' => 'All settings related to sending mails'
                ),*/
                'updates' => array(
                    'title' => 'Updates',
                    'description' => 'Manage the theme updates'
                ),
                'styling' => array(
                    'title' => 'Styling',
                    'description' => 'All style / css related'
                ),
            ),
            'widgets' => array(
                'twitter_username' => array(
                    'title' => 'Twitter Username',
                    'description' => 'Insert your twitter username (accountname) (will also be used for social count widget, if dragged in sidebar)',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'social',
                    'options' => array()
                ),
                'facebook_url' => array(
                    'title' => 'Facebook Page URL',
                    'description' => 'Insert the URL to your facebook page in here.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'social',
                    'options' => array()
                ),
                'feedburner_url' => array(
                    'title' => 'Feedburner RSS URL',
                    'description' => 'Insert the URL for the feedburner RSS feature. If you enter the url in here, the default feed url will replaced.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'social',
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
                'blog_overview_page_text' => array(
                    'title' => 'Blog Page Text',
                    'description' => 'Insert a text that will be shown next to the logo. ',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'blog',
                    'options' => array()
                ),
                // contact page
                
                'contact_overview_page' => array(
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
                'contact_address' => array(
                    'title' => 'Address',
                    'description' => 'Enter your address in one line (seperate facts by a comma). Will be used for google maps. Example: Mystreet 32, 12345 New York, NY, USA',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'contact',
                    'options' => array()
                ),
                'contact_address_html' => array(
                    'title' => 'Address (formatted)',
                    'description' => 'Enter your address as you would naturally enter it (with line breaks). This will be shown if google maps is not available. You can use HTML, though. For example for highlighting your company name.',
                    'help' => '',
                    'template' => 'textarea',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'contact',
                    'options' => array()
                ),
                'contact_text' => array(
                    'title' => 'Contact Text',
                    'description' => 'Enter the text you want to show on the contact page directly into the page\'s content field. Should not be longer than 80-100 words.',
                    'help' => '',
                    'template' => 'help',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'contact',
                    'options' => array()
                ),
                
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
                'mainpage_text_logo' => array(
                    'title' => 'OR: Text Logo',
                    'description' => 'Insert some text and it will get a cool html5 animation',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                'mainpage_text_logo_load' => array(
                    'title' => 'Logo Animation on Subpages',
                    'description' => 'Animate logo (text version only) on sub pages (all pages except main page)',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                'mainpage_text_introduction_title' => array(
                    'title' => 'Introduction Text Title',
                    'description' => 'If you want to display some introduction text title on the main page, you can do it here.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                'mainpage_text_introduction' => array(
                    'title' => 'Introduction Text',
                    'description' => 'If you want to display some introduction text on the main page, you can do it here.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
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
                'default_background' => array(
                    'title' => 'Default Background Image',
                    'description' => 'Set a background image for posts without custom background image and every other page that does not use a custom one. Make sure the file is big enough, as it gets streched over the whole background.',
                    'help' => '',
                    'template' => 'upload',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array('button_text' => 'Upload Background Image')
                ),
                'google_analytics_name' => array(
                    'title' => 'Google Adsense Username',
                    'description' => 'After setting up the form as instructed in the help file, paste in here the form code.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                // mail settings
                
                'mailer_send_from' => array(
                    'title' => 'Send From (Name)',
                    'description' => 'Enter the name you want the user to read in the "from" row (YourCompanyNameHere)',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                'mailer_send_from_mail' => array(
                    'title' => 'Send From (Email)',
                    'description' => 'Enter the email address you want the user to get the mail from. If you use smtp, make sure it is the same email address as the username.<br><b>IMPORTANT</b>If the smtp username is not a valid email address (eg your host only requries the name of the address without @domain.com), enter the full email address here (user@domain.com). If you do not follow this step an error will occur while sending the email.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                'mailer_type' => array(
                    'title' => 'Mailer Type',
                    'description' => 'Choose between mail(), sendmail and smtp for sending your mails. If you have absolutely no clue what these things mean, just leave it as it is (default is mail()). But we strongly recommend to use smtp, as it is the most secure way to send your mails.',
                    'help' => '',
                    'template' => 'select_custom',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array('options' => array('mail' => "mail()", 'sendmail' => "sendmail", 'smtp' => "SMTP"), 'first' => 'Template')
                ),
                'mailer_smtp_host' => array(
                    'title' => 'SMTP Host Name',
                    'description' => 'If you chose SMTP (good choice), enter here the host name. (e.g. smtp.example.org)',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                'mailer_smtp_port' => array(
                    'title' => 'SMTP Port',
                    'description' => 'Enter the port number (usually web hosts give a declaration like this: smtp.example.org:25 - we want these two things in two forms. above the host name, here the port number , in this case 25)',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                'mailer_smtp_ssl' => array(
                    'title' => 'Enable SSL Support',
                    'description' => 'If your host requires ssl encryption, select here',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                'mailer_smtp_username' => array(
                    'title' => 'SMTP Username',
                    'description' => 'Enter the username. This will also be the "sent from" address in the mail.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                'mailer_smtp_password' => array(
                    'title' => 'SMTP Password',
                    'description' => 'Enter the password',
                    'help' => '',
                    'template' => 'password',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                'mailer_sendmail' => array(
                    'title' => 'Sendmail Path',
                    'description' => 'If you chose sendmail and have to adapt the path to sendmail, please enter it here including all parameters. Default is /usr/sbin/sendmail -bs',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                
                // MISC
                'update_notifications' => array(
                    'title' => 'Update Notifications',
                    'description' => 'Do you want to get notifications if there is an update available?',
                    'help' => 'It will check once a week for new updates.',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'updates',
                    'options' => array()
                ),
                
                // styling
                'googlefont' => array(
                    'title' => 'Google Font',
                    'description' => 'We have an complete list of all google fonts (last update: march 20th 2012) here. Feel free to use whichever you would like to. You can get a preview here: <a href="http://www.google.com/webfonts/">Click Me</a>',
                    'help' => 'It will check once a week for new updates.',
                    'template' => 'select_custom',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'styling',
                    'options' => array('options' => listgooglefontoptions(), 'first' => 'Font')
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
                // colors
                'color_logo' => array(
                    'title' => 'Color of Logo',
                    'description' => 'If you have a text logo, decide what color it should be of.',
                    'template' => 'colorpicker',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'styling',
                    'options' => array()
                ),
                'color_logo_hover' => array(
                    'title' => 'Color of Logo on Mouse Over',
                    'description' => 'Define the mouse over color for your logo.',
                    'template' => 'colorpicker',
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
                ),
                'color_more' => array(
                    'title' => 'Color of More Button',
                    'description' => 'Change the color of the more button.',
                    'template' => 'colorpicker',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'styling',
                    'options' => array()
                ),
                'color_submit' => array(
                    'title' => 'Color of Newsletter / Contact Button',
                    'description' => 'Change the color of the submit buttons',
                    'template' => 'colorpicker',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'styling',
                    'options' => array()
                ),
                'color_scrollbar' => array(
                    'title' => 'Color of Scroll Bar',
                    'description' => 'Change the color of the scroll bars',
                    'template' => 'colorpicker',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'styling',
                    'options' => array()
                ),
                'color_scrollbar_hover' => array(
                    'title' => 'Color of Scroll Bar on Hover',
                    'description' => 'Change the color of the scroll bar hover color',
                    'template' => 'colorpicker',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'styling',
                    'options' => array()
                ),
                
            ),
            'bundle' => 'core'
          ),
        
      );

    $images = array();
    for($i=0;$i<4;$i++)
    {
      $images['slider_image_'.$i] = array(
          'menu_item' => 'slider',
          'title' => 'Background Slider Image '.($i+1),
          'description' => 'Upload an image to display in the background slider. Insert the file url in here',
          'help' => '',
          'template' => 'upload',
          'permission' => 'edit_post',
          'scope' => array('post', 'page', 'gallery', 'portfolio'),
          'options' => array()
      );
    }
    $slider_images = array();
    for($i=0;$i<4;$i++)
    {
      $slider_images['slider_foreground_image_'.$i] = array(
          'menu_item' => 'post_slider',
          'title' => 'Post Slider Image '.($i+1),
          'description' => 'Upload an image to display in the slider. Insert the file url in here',
          'help' => '',
          'template' => 'upload',
          'permission' => 'edit_post',
          'scope' => array('post', 'page'),
          'options' => array()
      );
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
          'slider' => array(
              'title' => 'Background Slider',
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
        )
    );

    $post_modules['widgets'] = array_merge_recursive($post_modules['widgets'], $images);
    $post_modules['widgets'] = array_merge_recursive($post_modules['widgets'], $slider_images);

    $pages = array(
        /*
        'bebelSidebars' =>
          array(
              'title' => 'Sidebar Generator',
              'page_title' => 'Generate your sidebars here!',
              'parent' => 'bebelAdminTop',
              'permission' => 'edit_theme_options',
              'class' => $this->bundleDir

          ),
        
        'import' =>
          array(
              'title' => 'Im- / Export Settings',
              'page_title' => 'Import or export the settings you set up!',
              'parent' => 'bebelAdminTop',
              'permission' => 'edit_theme_options',
              'class' => $this->bundleDir
          ), */
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
            'sidebar_left' => 'Image Left', 
            'sidebar_right' => 'Image Right', 
            'full_small' => 'Full Width (small image)', 
            'full' => 'Full Width (no image)'
        ),
        'page' => array(
            'sidebar_left' => 'Image Left', 
            'sidebar_right' => 'Image Right', 
            'full' => 'Full Width (no image)'
        ),
        'mainpage' => array('main_left' => 'Image on left side', 'main_right' => 'Image on right side'),
        'team' => array(
            'sidebar_left' => 'Image Left', 
            'sidebar_right' => 'Image Right', 
        ),
        'contact' => array(
            'sidebar_left' => 'Sidebar Left', 
            'sidebar_right' => 'Sidebar Right', 
        ),
        'default' => array('post' => 'sidebar_right', 'page' => 'sidebar_right', 'sidebar' => 'mainpage-sidebar')

    );

    return $t;
  }

  public function getBundleSettings()
  {

    $templates = $this->getTemplates();
    $templates_main = $templates;
    unset($templates_main['base']['full']);
    $bs = array(
    );

    return $bs;
  }
  
  public function runHook()
  {
      if(!is_admin())
      {
            $override_layout_files = new bebelThemeBundleLayoutFiles();
            add_action('wp_enqueue_scripts', array($override_layout_files, 'override_css_files'));
            add_action('wp_enqueue_scripts', array($override_layout_files, 'override_js_files'));
      }
      include dirname(__FILE__).'/../misc/google_font_list.php';
  }

}