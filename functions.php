<?php

// load autoloader
include_once get_stylesheet_directory().'/bebel/core/class/BebelAutoloader.class.php';
$autoLoader = BebelAutoloader::getInstance();
$autoLoader->register();

$basicSettings = BebelUtils::parseStyleCss();

$settings = new BebelSettings();
$settings->setBaseInfo($basicSettings['base_theme_info']);

$wordpress = new BebelWordpress();
$postTypeGenerator = new BebelPostTypeGenerator($settings->getPrefix());

$activeBundles = array(
    // installation bundle
    //'bebelOneClickInstallationBundle', todo include later

    // our awesome global bundles
    'bebelThemeBundle', // contains all the theme specific things
    //'bebelMailchimpBundle'
);

$bundle = new BebelBundle($settings, $wordpress, $postTypeGenerator);

// now load bundles.
$bundle->registerMultiple($activeBundles);

// extend the autoloader, so we also have access to the classes inside the bundles.
$autoLoader->extend($bundle->loadAutoload());

// continue loading bundles
$bundle->loadSettings()->loadWordpress();

BebelSingleton::addClasses(array(
    'BebelBundle' => $bundle
));

// register all settings into the database, if not yet in it
$settings->loadAll()->init();


$wordpress->run();

BebelSingleton::addClasses(array(
    'BebelSettings' => $settings,
    'BebelWordPress' => $wordPress
));

$bundle->loadPostTypes();
$bundle->loadWidgets();
$bundle->runHooks();

if(is_admin())
{
    $admin = new BebelAdmin($settings, $bundle);
    add_action('admin_menu', array($admin, 'initAdmin'));
}

function bebel_custom_excerpt_length( $length ) {
    return 13;
}

add_filter( 'excerpt_length', 'bebel_custom_excerpt_length', 999 );

function bebel_new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'bebel_new_excerpt_more');

if ( ! isset( $content_width ) ){
    $content_width = 988;
}
// Support post theme setup
add_action( 'after_setup_theme', 'construct_setup' );
function construct_setup() {
	add_theme_support('automatic-feed-links');
    add_theme_support( 'post-thumbnails' );
	load_theme_textdomain( 'construct', get_template_directory() . '/lang' );
	register_nav_menus( array(
      'header-menu' => __( 'Header Menu', 'construct' )
	) );
}

// Load Data
$default_data = array (
    "construct-options" => array (
        "responsive-onoff" => "true",
        "menu-sliding" => "true",
        "site-logo" => get_template_directory_uri()."/images/logo.png",
        "custom-favicon" => get_template_directory_uri()."/favicon.ico",
        "google-analytics" => "UA-xxxxxxxx-x",
        "number_home" => "6",
        "speed_home_fade" => "500",
        "addthis-buttons-portfolio" => "true",
        "portfolio-title" => "Areas of Work",
        "portfolio-title-desc" => "Our latest work",
        "number_of_portfolio" => "3",
        "gallery-title" => "Gallery",
        "gallery-title-desc" => "Our gallery",
        "number_of_gallery" => "8",
        "team-title" => "Meet The Team",
        "team-title-desc" => "We take care of business",
        "number_of_team" => "4",
        "clients-title" => "Our Clients",
        "clients-title-desc" => "They trust us",
        "number_of_clients" => "4",
        "addthis-buttons" => "true",
        "blog-title" => "Blog",
        "blog-title-desc" => "Read what we are up to",
        "date-format" => "j F, Y",
        "error-page-title" => "Error 404! Page Not Found",
        "error-page-msg" => "We are a team of Bebel who put maximum effort to satisfy your requirements in terms of WB Desigin. A particular attention we pay to the graphic style, caracterized by fonts, letters, symbols, allowing us to create an atractive and readable design for your eyes.",
        "contact-page-map" => "https://maps.google.com/maps?saddr=London,+United+Kingdom&hl=en&ll=51.493355,-0.127716&spn=0.508732,1.352692&sll=51.36375,-0.257899&sspn=0.030171,0.084543&mra=ls&t=m&z=10",
        "contact-page-mail" => "me@essam-mohamed.info",
        "contact-page-title" => "Be in contact with us",
        "contact-page-info" => "<strong>ThemeForest HQ Melbourne</strong>'<br>'Marxstr. 26-28'<br>'12083 Melbourne, Australia'<br>''<br>'Phone: 82347 483 23'<br>'Fax: 92374 2349 577",
        "contact-page-msg" => "Thank you for your message, we will replay as soon as possible.",
        "twitter-user-latest" => "thebebel",
        "number_of_twitts" => "5",
        "social-network-tw" => "https://twitter.com/",
        "social-network-fc" => "http://www.facebook.com/",
        "social-network-in" => "http://www.linkedin.com/",
        "social-network-google" => "https://www.google.com/",
        "background-color" => "#FFFFFF",
        "background-sLider" => array(
            "0" => ""
        ),
        "main-color" => "#3d3d3d",
        "url-color" => "#414141",
        "urlh-color" => "#000000",
        "second-color" => "#ffbb03",
        "link-second-color" => "#ffbb03",
        "linkh-second-color" => "#c97900",
        "content-color" => "#FFFFFF",
        "link-menu-color" => "#999999",
        "linkh-menu-color" => "#FFFFFF",
        "background-menu-color" => "#ffbb03",
        "sub-link-menu-color" => "#999999",
        "sub-linkh-menu-color" => "#333333",
        "sub-background-menu-color" => "#ffbb03"
    )
);

function theme_activation_function(){
    global $default_data;
    update_option('construct-options', $default_data);
}

//run when theme gets activated
add_action('after_switch_theme', 'theme_activation_function');

// Start Shortcodes
function fl_shortcode_button() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;

	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "fl_add_shortcode_tinymce_plugin");
		add_filter('mce_buttons', 'fl_register_shortcode_button');
	}
}
/**
 * Register the TinyMCE Shortcode Button
 */
function fl_register_shortcode_button($buttons) {
	array_push($buttons, "|", "flshortcodes");
	return $buttons;
}

/**
 * Load the TinyMCE plugin: shortcode_plugin.js
 */
function fl_add_shortcode_tinymce_plugin($plugin_array) {
   $plugin_array['flshortcodes'] = get_template_directory_uri() . '/js/shortcode_plugin.js';
   return $plugin_array;
}
add_action( 'init', 'fl_shortcode_button' );
// Start Shorcodes

// Load theme scripts
function construct_scripts_method() {
	wp_enqueue_script(
		'bootstrap-transition',
		get_template_directory_uri() . '/js/lib/bootstrap/bootstrap-transition.js',
		array('jquery'), false, true
	);
	wp_enqueue_script(
		'bootstrap-dropdown',
		get_template_directory_uri() . '/js/lib/bootstrap/bootstrap-dropdown.js',
		array('jquery'), false, true
	);
	wp_enqueue_script(
		'bootstrap-collapse',
		get_template_directory_uri() . '/js/lib/bootstrap/bootstrap-collapse.js',
		array('jquery'), false, true
	);
	wp_enqueue_script(
		'app',
		get_template_directory_uri() . '/js/app.js',
        array('jquery'), false, true
	);
	if (is_home() || is_singular()){
        wp_enqueue_script(
            'bootstrap-carousel',
            get_template_directory_uri() . '/js/lib/bootstrap/bootstrap-carousel.js',
            array('jquery'), false, true
        );
		wp_enqueue_script(
			'home',
			get_template_directory_uri() . '/js/home.js',
            array('jquery'), false, true
		);
	}
}
add_action('wp_enqueue_scripts', 'construct_scripts_method');
// Load theme scripts


// Register Theme Styles
function register_styles(){
    if (is_admin()) {
        wp_register_style('typo', get_template_directory_uri() .	'/css/controlpanel.css');
        wp_enqueue_style( 'typo');
    } else {
        wp_register_style('mainstylesheet', get_template_directory_uri() .	'/style.css');
        wp_enqueue_style( 'mainstylesheet');
        wp_register_style('application', get_template_directory_uri() .	'/css/style.css');
        wp_enqueue_style( 'application');
    }
}
add_action('init', 'register_styles');
// Register Theme Styles

// Files Include
require_once( get_template_directory() .'/includes/widgets.php');
require_once( get_template_directory() .'/includes/shortcodes.php');
require_once( get_template_directory() .'/includes/templates.php');
require_once( get_template_directory().'/includes/construct-menu-walker.class.php');
require_once( get_template_directory().'/bebel/core/vendor/mobble/mobble.php');
// Files Include