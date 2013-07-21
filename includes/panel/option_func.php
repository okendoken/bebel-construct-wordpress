<?php

$menu_title 	 =   "CircleLaw Settings";
$page_slug 		 =   "CircleLaw-setting";
$do_panel_folder =   get_template_directory_uri() . '/includes/panel';
$do_img_folder	 =   get_template_directory_uri() . '/includes/panel/images/';
$do_js_folder	 =   get_template_directory_uri() . '/includes/panel/js';
$do_cs_folder 	 =   get_template_directory_uri() . '/includes/panel/css';


function add_doanha_setting_page(){
	global $page_slug , $menu_title;
	add_theme_page( $menu_title, $menu_title, 'edit_themes', $page_slug, 'doanha_setting_page_callback' );
}
add_action('admin_menu', 'add_doanha_setting_page');


require_once('options_array.php');


// callback function to show page html
function doanha_setting_page_callback(){
	require('option_ui.php');
}

if ( isset( $_GET['page'] ) && $_GET['page'] == $page_slug )
	add_action('admin_head', 'doanha_admin_page_head');

function doanha_admin_page_head(){
	global $fields;

	foreach ($fields as $field)
		$field_type[] = $field['type'];
	
	?>
    <script type="text/javascript">

	jQuery(document).ready(function($) {

		function doanha_save_form(form_object){
			//if there is editor field type
			<?php if ( in_array('editor', $field_type) ) : ?>
				tinyMCE.triggerSave(false, true);
			<?php endif; ?>
			
			var data = $(form_object).serialize();
			$.post(ajaxurl, data, function(response) {
				if (response == 1) {
					show_message(1);
					var t = setTimeout(fade_message(), 1000);
				} else if (response == 2){
					alert("<?php _e('No Changes To Be Saved !', 'CircleLaw') ?>");
				}
			});
		}

		window.onbeforeunload = function() {
		    //return 'Are you sure you want to navigate away from this page?';
		};

		$('form#kadoo_form').submit(function() {
			doanha_save_form($(this));
			return false;
		});

		shortcut.add("Ctrl+s",function() {
			$('form#kadoo_form').submit();
		});

		var t = 1000;

		function show_message(n) {
			if(n == 1) {
				jQuery('#saved').html('\
				<div id="message" class="updated fade"><p>\
				<strong><?php _e('Option updated', 'CircleLaw'); ?></strong>\
				</p></div>').show();
			} else {
				jQuery('#saved').html('\
				<div id="message" class="error fade"><p>\
				<strong><?php _e('Nothing Happened', 'CircleLaw'); ?></strong>\
				</p></div>').show();
			}
			if(n == 1) {
				jQuery('#savedd').html('\
				<div id="message" class="updated fade"><p>\
				<strong><?php _e('Option updated', 'CircleLaw'); ?></strong>\
				</p></div>').show();
			} else {
				jQuery('#savedd').html('\
				<div id="message" class="error fade"><p>\
				<strong><?php _e('Nothing Happened', 'CircleLaw'); ?></strong>\
				</p></div>').show();
			}
		}
		
		function fade_message() {
			jQuery('#saved').fadeOut(700);	
			jQuery('#savedd').fadeOut(700);	
			clearTimeout(t);
		}	

	});//end jQuery(document).ready(function($) {

	</script>

<?php
}


function doanha_save_theme_data_ajax() {
	
	//security
	check_ajax_referer('doanha_theme_nonce', 'security');

	//recieved from the form submission
	$data = $_POST;
	
	//remove un wanted fields
	unset($data['security'], $data['action']);
	
	//check if there is option in database
  	if( is_array(get_option('koption')) )
        $options = get_option('koption');
    else 
        $options = array();

    //if recieved data Equal To Stored Data 
    if($options === $data){
    	die('2');
    }

    // if There Is Differnt Save New Data
    else{
		if( update_option('koption', $data) )  
			die('1');
		else 
			die('0');
	}
}
add_action('wp_ajax_doanha_save_theme_data_ajax', 'doanha_save_theme_data_ajax');


function doanha_register_styles_scripts() {

	global $page_slug , $do_js_folder , $do_cs_folder ;

	if ( isset( $_GET['page'] ) && $_GET['page'] == $page_slug ) :

    wp_register_script( 'doanha-admin-slider', $do_js_folder.'/jquery.ui.slider.js', array( 'jquery') , false , false );  

	wp_register_script( 'jquery.easing', $do_js_folder.'/jquery.easing.1.3.js', array( 'jquery' ) , false , false );  

	wp_register_script( 'shortcut', $do_js_folder.'/shortcut.js', "" , false , false );  

	wp_register_script( 'panel-custom-script', $do_js_folder.'/custom.js', array( 'jquery' ) , false , false ); 

	wp_register_style( 'panelcss', $do_cs_folder.'/panel.css', array(), '300000', 'all' ); 

	wp_enqueue_script( 'thickbox' );

	wp_enqueue_script( 'media-upload' );

	wp_enqueue_script( 'wptuts-upload', $do_js_folder.'/doanha-upload.js', array( 'thickbox', 'media-upload' ) );

	wp_enqueue_script( 'jquery.easing'); 

	wp_enqueue_script( 'shortcut'); 

	wp_enqueue_script( 'doanha-admin-slider' ); 

	wp_enqueue_script( 'wp-color-picker');

	wp_enqueue_script( 'panel-custom-script'); 

    wp_enqueue_style( 'thickbox' ); // Stylesheet used by Thickbox

	wp_enqueue_style( 'panelcss' );
	
	endif;
}

add_action( 'admin_enqueue_scripts', 'doanha_register_styles_scripts' ); 


