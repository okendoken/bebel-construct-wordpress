<?php
if ( ! isset( $content_width ) ) $content_width = 1000;
// Support post theme setup
add_action( 'after_setup_theme', 'CircleLaw_setup' );
function CircleLaw_setup() {
	global $default_data;
	add_theme_support('automatic-feed-links');
	load_theme_textdomain( 'CircleLaw', get_template_directory() . '/lang' );
	register_nav_menus( array(
      'header-menu' => __( 'Header Menu', 'CircleLaw' )
	) );
}
// Language
load_theme_textdomain( 'CircleLaw', get_template_directory_uri().'/lang' );
$locale = get_locale();
$locale_file = get_template_directory_uri()."/lang/$locale.php";
if ( is_readable($locale_file) )
require_once($locale_file);

// Load Data
$default_data = array(
"koption" =>
array
(
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
    "background-sLider" => array
        (
            "0" => ""
        ),
    "main-color" => "#999999",
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
));
if (CircleLaw_option('responsive-onoff') != "true" AND CircleLaw_option('responsive-onoff') != "false") {
	update_option('koption', $default_data);
}
// Load Data

// Support post thumbnails
add_theme_support( 'post-thumbnails' );

// Start Shorcodes
require_once ('includes/shortcodes.php');
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
add_filter( 'tiny_mce_version', 'fl_refresh_mce');
add_action( 'init', 'fl_shortcode_button' );
// Start Shorcodes

// Get Options
function CircleLaw_option ($optinid){
	$get_options = get_option('koption');
	$get_option = $get_options['koption'];
	return $get_option[$optinid];
}
// Get Opyions

// Latest Twits
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
function gltweets($twitteruser,$notweets){
	require_once(get_template_directory().'/includes/twitteroauth.php');
	$twitteruser = $twitteruser;
	$notweets = $notweets;
	$consumerkey = "41Jq4oPFy6X8GPZZN67jA";
	$consumersecret = "XPe9tRPRIMzSoUnfOjKFmqrVDmuTY0GIh6AZTSRDGX0";
	$accesstoken = "133687166-mPDkp6LxK4EAw9HJL6SITg16qMDZA64sen7BMYsD";
	$accesstokensecret = "1D1lJEnfUIaBzeddlaCXqk3vlpGwXwyJ6xNqguUyGss";
	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
	$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
	$gtweets = json_encode($tweets);
	return $gtweets;
}
// Latest Twits

// Load theme scripts
function CircleLaw_scripts_method() {
	wp_enqueue_script(
		'jquery.easing',
		get_template_directory_uri() . '/js/jquery.easing.1.3.js',
		array('jquery'), false, true
	);
	wp_enqueue_script(
		'jquery-ui.min',
		'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js',
		array('jquery'), false, true
	);
	wp_enqueue_script(
		'Navigation',
		get_template_directory_uri() . '/js/Navigation.js',
		array('jquery'), false, true
	);
	wp_enqueue_script(
		'help-tabs.min',
		get_template_directory_uri() . '/js/help-tabs.min.js',
		array('jquery'), false, true
	);
	wp_enqueue_script(
		'jquery.tools.min',
		get_template_directory_uri() . '/js/jquery.tools.min.js',
		array('jquery'), false, true
	);
	wp_enqueue_script(
		'mCustomScrollbar',
		get_template_directory_uri() . '/js/jquery.mCustomScrollbar.concat.min.js',
		array('jquery')
	);
	wp_enqueue_script(
		'script',
		get_template_directory_uri() . '/js/script.js.php',
		array('jquery'), false, true
	);
	wp_enqueue_script(
		'tinynav',
		get_template_directory_uri() . '/js/tinynav.js',
		array('jquery'), false, true
	);
	wp_enqueue_script(
		'jquery.innerfade',
		get_template_directory_uri() . '/js/jquery.innerfade.js',
		array('jquery'), false, true
	);
	if (is_home() AND CircleLaw_option('number_home') > 2){
		wp_enqueue_script(
			'carouFredSel',
			get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.0-packed.js',
			array('jquery')
		);
	}
	if (is_single() AND CircleLaw_option('addthis-buttons') == "true"){
		wp_enqueue_script(
			'addthis',
			'http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f78c1b40f2aa5d2',
			array('jquery')
		);
	}
	if (is_singular('portfolio') AND CircleLaw_option('addthis-buttons-portfolio') == "true"){
		wp_enqueue_script(
			'addthis',
			'http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f78c1b40f2aa5d2',
			array('jquery')
		);
	}
	if (is_singular('portfolio')){
		wp_enqueue_script(
			'bjqs-1.3.min',
			get_template_directory_uri() . '/js/bjqs-1.3.min.js',
			array('jquery')
		);
		$yesitsingle = true;
	}
	if (is_page_template('gallery.php') or is_page_template('portfolio.php') or is_singular('gallery') or is_singular('portfolio')){
		wp_enqueue_script(
			'jquery.prettyPhoto',
			get_template_directory_uri() . '/js/jquery.prettyPhoto.js',
			array('jquery')
		);
	}
	if (is_page_template('contact.php')){
		wp_enqueue_script(
			'page script',
			get_template_directory_uri() . '/js/contact.js.php',
			array('jquery')
		);
	}
}
add_action('wp_enqueue_scripts', 'CircleLaw_scripts_method');
// Load theme scripts


// Register Theme Styles
function register_styles()
{
	if (is_admin()) {
		wp_register_style('typo', get_template_directory_uri() .	'/css/controlpanel.css');
		wp_enqueue_style( 'typo');
	}
	if (!is_admin()) {
		wp_register_style('mainstylesheet', get_template_directory_uri() .	'/style.css');
		wp_enqueue_style( 'mainstylesheet');
		wp_register_style('mCustomScrollbar', get_template_directory_uri() .	'/css/jquery.mCustomScrollbar.css
');
		wp_enqueue_style( 'mCustomScrollbar');
		wp_register_style('bjqs', get_template_directory_uri() .	'/css/bjqs.css');
		wp_enqueue_style( 'bjqs');

		wp_register_style('prettyPhoto', get_template_directory_uri() .	'/css/prettyPhoto.css');
		wp_enqueue_style( 'prettyPhoto');

		if (CircleLaw_option('responsive-onoff') == "true") {
			wp_register_style('responsive', get_template_directory_uri() .	'/css/responsive.css');
			wp_enqueue_style( 'responsive');
		}
	}	
}
add_action('init', 'register_styles');
// Register Theme Styles

// Start Custom CSS
function add_custom_css() {
?>
<style type="text/css" media="screen">
body {
	background-color: <?php echo CircleLaw_option('background-color'); ?>;
	color: <?php echo CircleLaw_option('main-color'); ?>;
}
a:link, a:visited, h2, blockquote, .dropcap {
	color: <?php echo CircleLaw_option('url-color'); ?>;
}
a:hover, a:active, a:focus {
    color: <?php echo CircleLaw_option('urlh-color'); ?>;
}
.date, #gallery .single-gallery .number {
    color: <?php echo CircleLaw_option('second-color'); ?> !important;
}
.date a {
    color: <?php echo CircleLaw_option('link-second-color'); ?> !important;
}
.date a:hover {
    color: <?php echo CircleLaw_option('linkh-second-color'); ?> !important;
}
#team .single-team:hover .e-mail, #team .single-team:hover .e-mail, #portfolio .single-portfolio:hover, #gallery .single-gallery:hover {
    background-color: <?php echo CircleLaw_option('second-color'); ?>;
}
#page, #blog, #contact, #portfolio .single-portfolio, #gallery .single-gallery {
	background-color: <?php echo CircleLaw_option('content-color'); ?>;
}
#blob {
    background-color: <?php echo CircleLaw_option('background-menu-color'); ?> !important;
}
#nav > div > ul > li.notcurrent > a {
    transition: all 0.4s ease 0s;
    height: 22px;
}
#nav > div > ul > li.notcurrent:hover > a {
    background-color: <?php echo CircleLaw_option('background-menu-color'); ?>;
    border-radius: 3px 3px 3px 3px;
}
#nav > div > ul > li > a {
    color: <?php echo CircleLaw_option('link-menu-color'); ?>;
}
#nav > div > ul > li:hover > a, #nav > div > ul > li.current-menu-item > a, #nav > div > ul > li.current-menu-parent > a {
    color: <?php echo CircleLaw_option('linkh-menu-color'); ?>;
}
#nav > div > ul > li.afterslide > a {
    color: <?php echo CircleLaw_option('link-menu-color'); ?>;
}
#nav ul li ul .firstsub {
    border-bottom: 6px solid <?php echo CircleLaw_option('sub-background-menu-color'); ?>;
    display: block;
    margin: -39px 0 8px;
    padding-top: 22px;
}
#nav ul li ul .arrow-up {
    border-color: transparent transparent <?php echo CircleLaw_option('sub-background-menu-color'); ?>;
}
#nav ul li ul li a {
    color: <?php echo CircleLaw_option('sub-link-menu-color'); ?>;
}
#nav ul li ul li a:hover {
    color: <?php echo CircleLaw_option('sub-linkh-menu-color'); ?>;
}
<?php if (CircleLaw_option('menu-sliding') != "true"): ?>
#nav > div > ul > li > a {
    transition: all 0.4s ease 0s;
    height: 22px;
}
#nav > div > ul > li:hover > a {
    background-color: <?php echo CircleLaw_option('background-menu-color'); ?>;
    border-radius: 3px 3px 3px 3px;
}
#nav > div > ul > li.current-menu-item > a {
    background-color: <?php echo CircleLaw_option('background-menu-color'); ?>;
    border-radius: 3px 3px 3px 3px;
}
#nav > div > ul > li.current-menu-parent > a {
    background-color: <?php echo CircleLaw_option('background-menu-color'); ?>;
    border-radius: 3px 3px 3px 3px;
}
<?php endif; ?>
</style>
<!--[if lt IE 11]>
<style type="text/css">
	#nav ul li ul {
		margin-top: 15px;
	}
	#clients .single-clients:hover .main-c {
		display: none;
	}
</style>
<![endif]-->
<!--[if IE 8]>
<style type="text/css">
	.logo {
	    margin-bottom: 38px;
	    margin-right: auto;
	    margin-left: auto;
	    margin-top: 78px;
	    text-align: center;
	}
	#nav {
	    margin-right: auto;
	    margin-left: auto;
	    text-align: center;
	}
</style>
<![endif]-->
<?php
}
add_action('wp_head', 'add_custom_css');
// End Custom CSS



// Custom Java Script
function add_custom_script() {
?>
<?php if (CircleLaw_option('twitter-user-latest') != ""): ?>
<script type="text/javascript">
jQuery(document).ready(function() {
    loadLatestTweet();
}); 
//Twitter Parsers
String.prototype.parseURL = function() {
    return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&~\?\/.=]+/g, function(url) {
        return url.link(url);
    });
};
String.prototype.parseUsername = function() {
    return this.replace(/[@]+[A-Za-z0-9-_]+/g, function(u) {
        var username = u.replace("@","")
        return u.link("http://twitter.com/"+username);
    });
};
String.prototype.parseHashtag = function() {
    return this.replace(/[#]+[A-Za-z0-9-_]+/g, function(t) {
        var tag = t.replace("#","%23")
        return t.link("http://search.twitter.com/search?q="+tag);
    });
};
function loadLatestTweet(){
	var data = <?php echo gltweets(CircleLaw_option('twitter-user-latest'),CircleLaw_option('number_of_twitts')) ?>;
	for(i=0; i<<?php echo CircleLaw_option('number_of_twitts'); ?>; i++){
		var tweet = data[i].text;
		tweet = tweet.parseURL().parseUsername().parseHashtag();
		jQuery(".latest-twitts").append('<li>' + tweet + '</li>');
	}// end for
	jQuery(".latest-twitts").append('<li>' + tweet + '</li>')
	.innerfade({
		animationtype: 'slide',
		speed: 750,
		timeout: 4000,
		type: 'sequence',
		containerheight: 'auto'
	});
}
</script>
<?php endif ?>
<?php
if (is_page_template('gallery.php')): ?>
<script type="text/javascript">
var max = Math.max.apply( null, jQuery('#gallery').children('.single-gallery')
   .map(function(){
       return jQuery(this).height();
   }).get()
);
jQuery('.single-gallery').height(max);
</script>
<?php endif;

if (is_page_template('team.php')): ?>
<script type="text/javascript">
jQuery(document).ready(function() {
	var speedvar = 500;

	jQuery('.single-team').hover(function(){
		jQuery(this).find('img').stop().animate({
			"margin-top":"-5%",
			"margin-left":"-5%",
			"width":"110%",
			"height":"110%"
		} , speedvar);
	},function(){
		jQuery(this).find('img').stop().animate({
			"margin-top":"0",
			"margin-left":"0",
			"width":"100%",
			"height":"100%"
		} , speedvar);
	});
});
</script>
<?php endif;
if (is_home()): ?>
<script type="text/javascript">
jQuery(document).ready(function() {

	<?php if (CircleLaw_option('number_home') > 2){ ?>
		jQuery("#circles").carouFredSel({
			circular: false,
			infinite: false,
			auto 	: false,
			prev	: {	
				button	: "#prev2",
				key		: "left"
			},
			next	: { 
				button	: "#next2",
				key		: "right"
			},
			items: {
				visible: {
					min: 1,
					max: 3
				}
			}
		});
	<?php } ?>

	var speedvar = <?php echo CircleLaw_option('speed_home_fade'); ?>;
	jQuery('.circle').hover(function(){
		jQuery(this).find('.c-img').stop().animate({"top":"-30px"} , speedvar);
		jQuery(this).find('div.c-details').stop().animate({
			"background-color":"<?php echo CircleLaw_option('second-color'); ?>",
			"bottom":"30px"
		} , speedvar);
		jQuery(this).find('div.c-details h2').stop().animate({"color":"#FFFFFF"} , speedvar);
		jQuery(this).find('div.c-details .det').stop().animate({"color":"#FFFFFF"} , speedvar);
		jQuery(this).find('img').stop().animate({
			"margin-top":"-5%",
			"margin-left":"-5%",
			"width":"110%",
			"height":"110%"
		} , speedvar);
	},function(){
		jQuery(this).find('.c-img').stop().animate({"top":"0px"} , speedvar);
		jQuery(this).find('div.c-details').stop().animate({
			"background-color":"#ffffff",
			"bottom":"0px"
		} , speedvar);
		jQuery(this).find('div.c-details h2').stop().animate({"color":"#414141"} , speedvar);
		jQuery(this).find('div.c-details .det').stop().animate({"color":"#666666"} , speedvar);
		jQuery(this).find('img').stop().animate({
			"margin-top":"0",
			"margin-left":"0",
			"width":"100%",
			"height":"100%"
		} , speedvar);
	});
});
</script>
<?php endif;

    echo "<script type=\"text/javascript\">var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '".CircleLaw_option('google-analytics')."']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })(); jQuery(\"#footer .most\").last().css({'margin-right':'0px'});
		(function($){
        $(window).load(function(){
            $('#scroll').mCustomScrollbar({
                autoHideScrollbar:true,
                theme:'light-thin'
            });
        });
    })(jQuery);
jQuery(document).ready(function() { jQuery(\".toggle_container\").hide(); jQuery(\"h2.trigger\").click(function(){ jQuery(this).toggleClass(\"active\").next().slideToggle(\"slow\"); }); }); jQuery(document).ready(function(){ jQuery(function() { jQuery( \".accordion\" ).accordion({ autoHeight: false, navigation: true }); }); jQuery(function() { jQuery( \".progressbar\" ).progressbar(); }); }); jQuery(document).ready(function(){ jQuery(function() { jQuery(\".tabs\").tabs(\".panes > div\"); }); }); jQuery(function () {
jQuery('#nav ul').tinyNav({ active: 'selected', label: 'Menu' }); });</script>";
if (is_singular('portfolio')): ?>
<script type="text/javascript">
jQuery(document).ready(function($) {
  $('#portfolio-slider').bjqs({
    animtype : 'slide',
    height      : 507,
    width       : 344,
    responsive  : true
  });
});

</script>
<?php endif;
}
add_action('wp_footer', 'add_custom_script');
// Custom Java Script

// Files Include
require_once( get_template_directory()  .'/includes/post_type.php');
require_once( get_template_directory() .'/includes/panel/option_func.php');
require_once( get_template_directory() .'/includes/resize-class.php');
require_once( get_template_directory() .'/includes/widget.php');
// Files Include

// Resize Image
function img_resize ($img_target,$img_width,$img_height){
	// Get Image Name
	$img_name = pathinfo($img_target);
	$img_ext = pathinfo($img_target, PATHINFO_EXTENSION);
	$img_name = $img_name['filename'];
	$img_name = $img_name."-".$img_width."x".$img_height.'.'.$img_ext;
	// New Image Url
	$uploaddir = wp_upload_dir();
	$newimageurl = $uploaddir['url'].'/'.$img_name;
	$newimagedir = $uploaddir['path'].'/'.$img_name;
	// Original Image Dir
	$img_target = str_replace($uploaddir['baseurl'], $uploaddir['basedir'], $img_target);
	// Save Thumb Image
	if (file_exists($newimagedir)) {
		echo $newimageurl;
	}else{
		$resize_img = new resize($img_target);
		$resize_img -> resizeImage($img_width, $img_height, 'crop');
		$resize_img -> saveImage($newimagedir, 100);
		echo $newimageurl;
	}
}
// Resize Image

// Get Single Gallery
function get_single_gallery ($pages,$postidd){
?>
	<script type="text/javascript">
	jQuery(document).ready(function()
	{
	  var nextp = 2;
	  var maxpages = <?php echo $pages ?>;
	  jQuery('.next').attr("href", nextp);
	  jQuery('.nowpage').html('1');

	  var pid = <?php echo $postidd ?>;
	  function loading_show()
	  {
	  jQuery('#loading').html('<div id="floatingBarsG"><div class="blockG" id="rotateG_01"></div><div class="blockG" id="rotateG_02"></div><div class="blockG" id="rotateG_03"></div><div class="blockG" id="rotateG_04"></div><div class="blockG" id="rotateG_05"></div><div class="blockG" id="rotateG_06"></div><div class="blockG" id="rotateG_07"></div><div class="blockG" id="rotateG_08"></div></div>').fadeIn('fast');
	  }
	  function loading_hide()
	  {
	  jQuery('#loading').fadeOut();
	  }
	  function loadData(page)
	  {
	  loading_show();
	  jQuery.ajax
	  ({
	    type: "POST",
	    url: "<?php echo get_template_directory_uri(); ?>/ajax.php",
	    data: "page="+page+"&postid="+pid,
	    success: function(msg)
	    {
	      jQuery("#result").html(msg);
	      loading_hide();
	    }
	  });
	  }
	  loadData(1); // For first time page load default results

	  jQuery('.next').live('click',function(e){
	    e.preventDefault();
	    var page =  jQuery(this).attr("href");
	    jQuery('.nowpage').html(page);
	    
	    var prevpageid = parseInt( jQuery(".prev").attr("href") )+1;
	    jQuery('.prev').attr("href", prevpageid);

	    var thisvalue = parseInt( jQuery(this).attr("href") );
	    if(thisvalue == maxpages){
	      jQuery(this).parent().prepend('<div class="no-next"></div>');
	      jQuery(this).remove();
	    }else{
	      var nextpageid = parseInt( jQuery(this).attr("href") )+1;
	      jQuery(this).attr("href", nextpageid);
	    }

	    if (thisvalue == 2){
	      jQuery('.no-prev').parent().prepend('<a href="1" class="prev"></a>');
	      jQuery('.no-prev').remove();
	    }

	    loadData(page);
	  });

	  jQuery('.prev').live('click',function(e){
	    e.preventDefault();
	    var page =  jQuery(this).attr("href");
	    jQuery('.nowpage').html(page);

	    var nextpageid = parseInt( jQuery(".next").attr("href") )-1;
	    jQuery('.next').attr("href", nextpageid);

	    var thisvalue = parseInt( jQuery(this).attr("href") );
	    if(thisvalue == 1){
	      jQuery(this).parent().prepend('<div class="no-prev"></div>');
	      jQuery(this).remove();
	    }else{
	      var prevpageid = parseInt( jQuery(this).attr("href") )-1;
	      jQuery(this).attr("href", prevpageid);
	    }

	    var replacenext = parseInt(maxpages)-1;

	    if (thisvalue == replacenext){
	      jQuery('.no-next').parent().prepend('<a href="1" class="next"></a>');
	      jQuery('.no-next').remove();
	      jQuery('.next').attr("href", maxpages);
	    }

	    loadData(page);
	  });

	});
	</script>
<?php
}
// Get Single Gallery

//Length
function CircleLaw_excerpt($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		$excerpt = str_replace("[...]","...",$excerpt);
		echo $excerpt;
	}
}

//Pagination
function CircleLaw_right_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;
     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }
     if(1 != $pages)
     {
        echo "<div id='pages'>";
                 
	    if ($paged == 1){
	    	echo '<a href="'.get_pagenum_link(2).'" class="next"></a>';
	    	echo '<a class="no-prev"></a>';
	    }elseif ($paged == $pages) {
	    	$nowback = $paged-1;
	    	echo '<a class="no-next"></a>';
	    	echo '<a href="'.get_pagenum_link($nowback).'" class="prev"></a>';
	    }else{
	    	$gonext = $paged+1;
	    	$goback = $paged-1;
	    	echo '<a href="'.get_pagenum_link($gonext).'" class="next"></a>';
	    	echo '<a href="'.get_pagenum_link($goback).'" class="prev"></a>';
	    }

         echo "<div class='clear'></div><span>".$paged."/".$pages." ".__( 'Pages', 'CircleLaw' )."</span></div>\n";
     }
}

// Page Url
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

//Pagination
function CircleLaw_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='paginations'>";
         previous_posts_link();
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         next_posts_link();
         echo "</div>\n";
     }
}

function stripText($string) 
{ 
    return str_replace("\\",'',$string);
}

?>