<?php

// load autoloader
require_once get_stylesheet_directory().'/bebel/core/class/BebelAutoloader.class.php';
$autoLoader = BebelAutoloader::getInstance();
$autoLoader->register();

$basicSettings = BebelUtils::parseStyleCss();

$settings = new BebelSettings();
$settings->setBaseInfo($basicSettings['base_theme_info']);

$wordpress = new BebelWordpress();
$postTypeGenerator = new BebelPostTypeGenerator($settings->getPrefix());

$activeBundles = array(
    'bebelThemeBundle',
    'bebelMailchimpBundle',
    'bebelSliderBundle',
    'bebelTeamBundle',
    'bebelClientsBundle',
    'bebelPortfolioBundle'
);

$bundle = new BebelBundle($settings, $wordpress, $postTypeGenerator);

BebelSingleton::addClasses(array(
    'BebelSettings' => $settings,
    'BebelWordPress' => $wordpress,
    'BebelBundle' => $bundle
));

// now load bundles.
$bundle->registerMultiple($activeBundles);

// extend the autoloader, so we also have access to the classes inside the bundles.
$autoLoader->extend($bundle->loadAutoload());

// continue loading bundles
$bundle->loadSettings()->loadWordpress();

// register all settings into the database, if not yet in it
$settings->loadAll()->init();

$wordpress->run();

$bundle->loadPostTypes();
add_action( 'widgets_init', array($bundle, 'loadWidgets'));
$bundle->loadSidebars();
$bundle->runHooks();

if(is_admin())
{
    $admin = new BebelAdmin($settings, $bundle);
    $adminPostMeta = new BebelAdminPostMetaPanel($settings, $bundle);
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
	load_theme_textdomain( 'construct', get_template_directory() . '/lang' );
}

// Files Include
require_once( get_template_directory().'/install_plugins.php');
require_once( get_template_directory().'/bebel/core/vendor/mobble/mobble.php');
require_once( get_template_directory().'/ajax.php');
require_once( get_template_directory().'/options.php');
include_once( get_template_directory().'/myFunctions.php');
// Files Include

//please stupid theme-check plugin as it thinks that
//$feature = 'automatic-feed-links';
//add_theme_support( $feature );
//is not the same as
add_theme_support( 'automatic-feed-links' );