<?php

/*-----------------------------------------------------------------------------------*/
/* Slider */
/*-----------------------------------------------------------------------------------*/
function homepage() {
	register_post_type( 'homepage',
                array( 
				 'labels' => array (
					  'name' => __( 'Homepage Items', 'CircleLaw' ),
					  'all_items' => __('All Items', 'CircleLaw'),
					  'add_new' => __( 'Add New Item', 'CircleLaw' ),
					  'add_new_item' => __( 'Add New Item', 'CircleLaw' ),
					  'edit' => __( 'Edit Item', 'CircleLaw' ),
					  'edit_item' => __( 'Edit Item', 'CircleLaw' ),
					  'new_item' => __( 'Add New Item', 'CircleLaw' ),
					  'view' => __( 'View Item', 'CircleLaw' ),
					  'view_item' => __( 'View Item', 'CircleLaw' ),
					  'search_items' => __( 'Search In Items', 'CircleLaw' ),
					  'not_found' => __( 'No Items Found', 'CircleLaw' ),
					  'not_found_in_trash' => __( 'No Items Found In Trash', 'CircleLaw' )
					),
				'_builtin' => false,
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'menu_position' => 20 ,
				'hierarchical' => false,
				'has_archive' => false,
				'capability_type' => 'page',
				'supports' => array(
						'title',
						'thumbnail',
						)
					) 
				);
}
add_action('init', 'homepage');

/* Define the custom box */

add_action( 'add_meta_boxes', 'homepage_info' );

/* Do something with the data entered */
add_action( 'save_post', 'homepage_info_save' );

/* Adds a box to the main column on the Post and Page edit screens */
function homepage_info() {
    add_meta_box( 
        'homepage_info_box',
        __( 'Item Info', 'CircleLaw' ),
        'homepage_info_fields',
        'homepage' 
    );
}

/* Prints the box content */
function homepage_info_fields( $post ) {

  global $post;
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'homepage_info_box_inp' );

  $item_order = get_post_meta($post->ID, 'item_order', true);
  $item_description = get_post_meta($post->ID, 'item_description', true);
  $item_url = get_post_meta($post->ID, 'item_url', true);

  // The actual fields for data entry
  echo '<label for="item_order" class="pos-fo">';
       _e("Item Order", 'CircleLaw' );
  echo '</label> ';
  echo '<input type="text" id="item_order" name="item_order" value="'.$item_order.'" class="pos-fo2" /><div class="pos-fo3"></div><div class="clear"></div>';

  // The actual fields for data entry
  echo '<label for="item_description" class="pos-fo" style="margin-top:-200px;">';
       _e("Item Description", 'CircleLaw' );
  echo '</label> ';
  echo '<textarea id="item_description" name="item_description" class="pos-fo2-msg">'.$item_description.'</textarea><div class="pos-fo3"></div><div class="clear"></div>';

  // The actual fields for data entry
  echo '<label for="item_url" class="pos-fo">';
       _e("Item URL", 'CircleLaw' );
  echo '</label> ';
  echo '<input type="text" id="item_url" name="item_url" value="'.$item_url.'" class="pos-fo2" />';
  
}

/* When the post is saved, saves our custom data */
function homepage_info_save( $post_id ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if (!isset($_POST['homepage_info_box_inp'])){
	$_POST['homepage_info_box_inp'] = true;  
  }
  if ( !wp_verify_nonce( $_POST['homepage_info_box_inp'], plugin_basename( __FILE__ ) ) )
      return;

  
  // Check permissions
  if (!isset($_POST['post_type'])){
	  $_POST['post_type'] = true;
  }
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // OK, we're authenticated: we need to find and save the data
  if (!isset($_POST['item_order'])){
    $_POST['item_order'] = "";  
    }
  if (!isset($_POST['item_description'])){
    $_POST['item_description'] = "";  
    }
	if (!isset($_POST['item_url'])){
		$_POST['item_url'] = "";  
  	}
  if (!update_post_meta($post_id, 'item_order', $_POST['item_order'])){
    add_post_meta($post_id, 'item_order', $_POST['item_order']);
  }
  if (!update_post_meta($post_id, 'item_description', $_POST['item_description'])){
    add_post_meta($post_id, 'item_description', $_POST['item_description']);
  }
  if (!update_post_meta($post_id, 'item_url', $_POST['item_url'])){
	  add_post_meta($post_id, 'item_url', $_POST['item_url']);
  }

  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
}

/*-----------------------------------------------------------------------------------*/
/* Team */
/*-----------------------------------------------------------------------------------*/
function team() {
	register_post_type( 'team',
                array( 
				 'labels' => array (
					  'name' => __( 'Team', 'CircleLaw' ),
					  'all_items' => __('All Persons', 'CircleLaw'),
					  'add_new' => __( 'Add New Person', 'CircleLaw' ),
					  'add_new_item' => __( 'Add New Person', 'CircleLaw' ),
					  'edit' => __( 'Edit Person', 'CircleLaw' ),
					  'edit_item' => __( 'Edit Person', 'CircleLaw' ),
					  'new_item' => __( 'Add New Person', 'CircleLaw' ),
					  'view' => __( 'View Person', 'CircleLaw' ),
					  'view_item' => __( 'View Person', 'CircleLaw' ),
					  'search_items' => __( 'Search In Team', 'CircleLaw' ),
					  'not_found' => __( 'No Persons Found', 'CircleLaw' ),
					  'not_found_in_trash' => __( 'No Persons Found In Trash', 'CircleLaw' )
					),
				'_builtin' => false,
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'menu_position' => 20 ,
				'hierarchical' => false,
				'has_archive' => false,
				'capability_type' => 'page',
				'supports' => array(
						'title',
						'thumbnail',
						)
					) 
				);
}
add_action('init', 'team');

/* Define the custom box */

add_action( 'add_meta_boxes', 'team_info' );

/* Do something with the data entered */
add_action( 'save_post', 'team_info_save' );

/* Adds a box to the main column on the Post and Page edit screens */
function team_info() {
    add_meta_box( 
        'team_info_box',
        __( 'Person Info', 'CircleLaw' ),
        'team_info_fields',
        'team' 
    );
}

/* Prints the box content */
function team_info_fields( $post ) {

  global $post;
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'team_info_box_inp' );

  $person_order = get_post_meta($post->ID, 'person_order', true);
  $person_description = get_post_meta($post->ID, 'person_description', true);
  $person_email = get_post_meta($post->ID, 'person_email', true);

  // The actual fields for data entry
  echo '<label for="person_order" class="pos-fo">';
       _e("Order", 'CircleLaw' );
  echo '</label> ';
  echo '<input type="text" id="person_order" name="person_order" value="'.$person_order.'" class="pos-fo2" /><div class="pos-fo3"></div><div class="clear"></div>';

  // The actual fields for data entry
  echo '<label for="person_description" class="pos-fo" style="margin-top:-200px;">';
       _e("Description:", 'CircleLaw' );
  echo '</label> ';
  echo '<textarea id="person_description" name="person_description" class="pos-fo2-msg">'.$person_description.'</textarea><div class="pos-fo3"></div><div class="clear"></div>';

  // The actual fields for data entry
  echo '<label for="person_email" class="pos-fo">';
       _e("E-mail", 'CircleLaw' );
  echo '</label> ';
  echo '<input type="text" id="person_email" name="person_email" value="'.$person_email.'" class="pos-fo2" />';
  
}

/* When the post is saved, saves our custom data */
function team_info_save( $post_id ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if (!isset($_POST['team_info_box_inp'])){
	$_POST['team_info_box_inp'] = true;  
  }
  if ( !wp_verify_nonce( $_POST['team_info_box_inp'], plugin_basename( __FILE__ ) ) )
      return;

  
  // Check permissions
  if (!isset($_POST['post_type'])){
	  $_POST['post_type'] = true;
  }
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // OK, we're authenticated: we need to find and save the data
  if (!isset($_POST['person_order'])){
    $_POST['person_order'] = "";  
    }
  if (!isset($_POST['person_description'])){
    $_POST['person_description'] = "";  
    }
	if (!isset($_POST['person_email'])){
		$_POST['person_email'] = "";  
  	}
  if (!update_post_meta($post_id, 'person_order', $_POST['person_order'])){
    add_post_meta($post_id, 'person_order', $_POST['person_order']);
  }
  if (!update_post_meta($post_id, 'person_description', $_POST['person_description'])){
    add_post_meta($post_id, 'person_description', $_POST['person_description']);
  }
  if (!update_post_meta($post_id, 'person_email', $_POST['person_email'])){
	  add_post_meta($post_id, 'person_email', $_POST['person_email']);
  }

  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
}

/*-----------------------------------------------------------------------------------*/
/* Clients */
/*-----------------------------------------------------------------------------------*/
function clients() {
	register_post_type( 'clients',
                array( 
				 'labels' => array (
					  'name' => __( 'Clients', 'CircleLaw' ),
					  'all_items' => __('All Clients', 'CircleLaw'),
					  'add_new' => __( 'Add New Client', 'CircleLaw' ),
					  'add_new_item' => __( 'Add New Client', 'CircleLaw' ),
					  'edit' => __( 'Edit Client', 'CircleLaw' ),
					  'edit_item' => __( 'Edit Client', 'CircleLaw' ),
					  'new_item' => __( 'Add New Client', 'CircleLaw' ),
					  'view' => __( 'View Client', 'CircleLaw' ),
					  'view_item' => __( 'View Client', 'CircleLaw' ),
					  'search_items' => __( 'Search In Clients', 'CircleLaw' ),
					  'not_found' => __( 'No Clients Found', 'CircleLaw' ),
					  'not_found_in_trash' => __( 'No Clients Found In Trash', 'CircleLaw' )
					),
				'_builtin' => false,
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'menu_position' => 20 ,
				'hierarchical' => false,
				'has_archive' => false,
				'capability_type' => 'page',
				'supports' => array(
						'title',
						'thumbnail',
						)
					) 
				);
}
add_action('init', 'clients');

/* Define the custom box */

add_action( 'add_meta_boxes', 'clients_info' );

/* Do something with the data entered */
add_action( 'save_post', 'clients_info_save' );

/* Adds a box to the main column on the Post and Page edit screens */
function clients_info() {
    add_meta_box( 
        'clients_info_box',
        __( 'Client Info', 'CircleLaw' ),
        'clients_info_fields',
        'clients' 
    );
}

/* Prints the box content */
function clients_info_fields( $post ) {

  global $post;
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'clients_info_box_inp' );

  $client_order = get_post_meta($post->ID, 'client_order', true);
  $client_description = get_post_meta($post->ID, 'client_description', true);
  $client_url = get_post_meta($post->ID, 'client_url', true);

  // The actual fields for data entry
  echo '<label for="client_order" class="pos-fo">';
       _e("Order", 'CircleLaw' );
  echo '</label> ';
  echo '<input type="text" id="client_order" name="client_order" value="'.$client_order.'" class="pos-fo2" /><div class="pos-fo3"></div><div class="clear"></div>';

  // The actual fields for data entry
  echo '<label for="client_description" class="pos-fo" style="margin-top:-200px;">';
       _e("Description:", 'CircleLaw' );
  echo '</label> ';
  echo '<textarea id="client_description" name="client_description" class="pos-fo2-msg">'.$client_description.'</textarea><div class="pos-fo3"></div><div class="clear"></div>';

  // The actual fields for data entry
  echo '<label for="client_url" class="pos-fo">';
       _e("URL", 'CircleLaw' );
  echo '</label> ';
  echo '<input type="text" id="client_url" name="client_url" value="'.$client_url.'" class="pos-fo2" />';
  
}

/* When the post is saved, saves our custom data */
function clients_info_save( $post_id ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if (!isset($_POST['clients_info_box_inp'])){
	$_POST['clients_info_box_inp'] = true;  
  }
  if ( !wp_verify_nonce( $_POST['clients_info_box_inp'], plugin_basename( __FILE__ ) ) )
      return;

  
  // Check permissions
  if (!isset($_POST['post_type'])){
	  $_POST['post_type'] = true;
  }
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // OK, we're authenticated: we need to find and save the data
  if (!isset($_POST['client_order'])){
    $_POST['client_order'] = "";  
    }
  if (!isset($_POST['client_description'])){
    $_POST['client_description'] = "";  
    }
	if (!isset($_POST['client_url'])){
		$_POST['client_url'] = "";  
  	}
  if (!update_post_meta($post_id, 'client_order', $_POST['client_order'])){
    add_post_meta($post_id, 'client_order', $_POST['client_order']);
  }
  if (!update_post_meta($post_id, 'client_description', $_POST['client_description'])){
    add_post_meta($post_id, 'client_description', $_POST['client_description']);
  }
  if (!update_post_meta($post_id, 'client_url', $_POST['client_url'])){
	  add_post_meta($post_id, 'client_url', $_POST['client_url']);
  }

  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
}


/*-----------------------------------------------------------------------------------*/
/* Gallery */
/*-----------------------------------------------------------------------------------*/
function gallery() {
	register_post_type( 'gallery',
                array( 
				 'labels' => array (
					  'name' => __( 'Gallery', 'CircleLaw' ),
					  'all_items' => __('View All', 'CircleLaw'),
					  'add_new' => __( 'Add New Gallery', 'CircleLaw' ),
					  'add_new_item' => __( 'Add New Gallery', 'CircleLaw' ),
					  'edit' => __( 'Edit Gallery', 'CircleLaw' ),
					  'edit_item' => __( 'Edit Gallery', 'CircleLaw' ),
					  'new_item' => __( 'Add New Gallery', 'CircleLaw' ),
					  'view' => __( 'View Gallery', 'CircleLaw' ),
					  'view_item' => __( 'View Gallery', 'CircleLaw' ),
					  'search_items' => __( 'Search In Galleries', 'CircleLaw' ),
					  'not_found' => __( 'No Galleries Found', 'CircleLaw' ),
					  'not_found_in_trash' => __( 'No Galleries Found In Trash', 'CircleLaw' )
					),
				'_builtin' => false,
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'menu_position' => 20 ,
				'hierarchical' => false,
				'has_archive' => false,
				'capability_type' => 'page',
				'menu_icon' => get_template_directory_uri() . '/images/slider.png',
				'supports' => array(
						'title',
						'thumbnail',
						)
					) 
				);
}
add_action('init', 'gallery');

/* Define the custom box */

add_action( 'add_meta_boxes', 'gallery_info' );

/* Do something with the data entered */
add_action( 'save_post', 'gallery_info_save' );

/* Adds a box to the main column on the Post and Page edit screens */
function gallery_info() {
    add_meta_box( 
        'gallery_info_box',
        __( 'Gallery Content', 'CircleLaw' ),
        'gallery_info_fields',
        'gallery' 
    );
}

/* Prints the box content */
function gallery_info_fields( $post ) {

  global $post;
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'gallery_info_box_inp' );

  $gallery_order = get_post_meta($post->ID, 'gallery_order', true);
  $gallery_description = get_post_meta($post->ID, 'gallery_description', true);
  $gallery_layout = get_post_meta($post->ID, 'gallery_layout', true);
  	if ($gallery_layout == "gallery_layout_square"){
	  	$r_check = "";
	  	$s_check = ' checked="checked"';
	}else{
		$r_check = ' checked="checked"';
		$s_check = "";
	}

  // The actual fields for data entry
  echo '<label for="gallery_order" class="pos-fo">';
       _e("Gallery Order", 'CircleLaw' );
  echo '</label> ';
  echo '<input type="text" id="gallery_order" name="gallery_order" value="'.$gallery_order.'" class="pos-fo2" /><div class="pos-fo3"></div><div class="clear"></div>';
  
  // The actual fields for data entry
  echo '<label for="gallery_description" class="pos-fo" style="margin-top:-200px;">';
       _e("Gallery Description", 'CircleLaw' );
  echo '</label> ';
  echo '<textarea id="gallery_description" name="gallery_description" class="pos-fo2-msg">'.$gallery_description.'</textarea><div class="pos-fo3"></div><div class="clear"></div>';
  
  // The actual fields for data entry
  echo '<label for="gallery_layout" class="pos-fo" style="margin-bottom: 9px; margin-top: 27px;"">';
       _e("Gallery Layout", 'CircleLaw' );
  echo '</label> ';
  echo '<label class="pos-fo5">
  		<input type="radio" name="gallery_layout" value="gallery_layout_random" id="gallery_layout_0"'.$r_check.' />
		'.__("Random", 'CircleLaw' ).
		'</label>';
		
  echo '<label class="pos-fo5">
  		<input type="radio" name="gallery_layout" value="gallery_layout_square" id="gallery_layout_1"'.$s_check.' />
		'.__("Square", 'CircleLaw' ).
		'</label><div class="pos-fo3"></div><div class="clear"></div>';


  // Gallery
  echo '<label for="gallery" class="pos-fo9">';
       _e("Gallery Images", 'CircleLaw' );
  echo '</label>';

	
	$custom = get_post_custom($post->ID);
	if (!isset($custom["kboxgallery"])){
		$custom["kboxgallery"] = true;
	}
	$kgallery = @unserialize( $custom["kboxgallery"][0] );

	wp_print_scripts('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
  ?>
	<style type="text/css">
	.kthumb_c{
		margin-left:10px;
		margin-bottom:10px;
		width:150px;
		float:right;
		position:relative;
	}
	.kthumb_del{
		position:absolute;
		padding:1px 10px;
		background:#222;
		color:#fff;
		right:0;bottom:0;
		cursor:pointer;
	}
	</style>

	<script> 
	jQuery(document).ready(function() {
		
		var i = 1;
		
		jQuery('#add_new_slide').click(function() {
			//uploadID =  this.parentNode.id;
			//uploadID =  jQuery(this).parent().attr("id");
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=1', true);
			return false;
		});
			
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
				
			jQuery("#galleryview .kadoo").append(
			'<div id="kthumb_c_' + i + '" class="kthumb_c"> \
			<div  class="kthumb_del">Delete</div> \
			<img src="' + imgurl + '" width="150" height="130"  /> \
			<input type="hidden" name="kboxgallery[]" value="' + imgurl + '" /></div>\
			');
			i++;
			tb_remove();
			//window.send_to_editor = window.restore_send_to_editor;	
		};
	
		jQuery(".kthumb_del").live("click" , function() {
			jQuery(this).parent().addClass('removered').fadeOut(function() {
				jQuery(this).remove();
			});
		});
	
	}); 
    </script>
    
    <input id="add_new_slide" type="button" class="mpanel-save" value="<?php _e("Add New Image", 'CircleLaw' ); ?>">
    
    <div class="pos-fo1"></div>
    
    <div id="galleryview">
    <div class="kadoo">
    
		<?php if( $kgallery ): foreach( $kgallery as $galimg ): ?> 
        <div class="kthumb_c">
        <div  class="kthumb_del"><?php _e("Delete", 'CircleLaw' ); ?></div>
        <img src="<?php echo $galimg ?>" width="150" height="130"  />
        <input type="hidden" name="kboxgallery[]" value="<?php echo $galimg ?>" /></div>
        <?php endforeach; endif; ?>
    
    </div><!--end of kadoo-->
    <div class="pos-fo1"></div>    
    </div><!--end of galleryview#-->
    
    <?php
  
  // Gallery
  
}

/* When the post is saved, saves our custom data */
function gallery_info_save( $post_id ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if (!isset($_POST['slider_info_box_inp'])){
	$_POST['slider_info_box_inp'] = true;  
  }
  if ( !wp_verify_nonce( $_POST['slider_info_box_inp'], plugin_basename( __FILE__ ) ) )
      return;

  
  // Check permissions
  if (!isset($_POST['post_type'])){
	  $_POST['post_type'] = true;
  }
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // OK, we're authenticated: we need to find and save the data
  if (!isset($_POST['gallery_order'])){
    $_POST['gallery_order'] = "";  
    }
  if (!isset($_POST['gallery_description'])){
    $_POST['gallery_description'] = "";  
    }
	if (!isset($_POST['gallery_layout'])){
		$_POST['gallery_layout'] = "";  
  	}
	if (!isset($_POST['kboxgallery'])){
		$_POST['kboxgallery'] = "";  
  	}
  if (!update_post_meta($post_id, 'gallery_order', $_POST['gallery_order'])){
    add_post_meta($post_id, 'gallery_order', $_POST['gallery_order']);
  }
  if (!update_post_meta($post_id, 'gallery_description', $_POST['gallery_description'])){
    add_post_meta($post_id, 'gallery_description', $_POST['gallery_description']);
  }
	if (!update_post_meta($post_id, 'gallery_layout', $_POST['gallery_layout'])){
	  add_post_meta($post_id, 'gallery_layout', $_POST['gallery_layout']);
	}
	if( $_POST['kboxgallery'] && $_POST['kboxgallery'] != "" ){
	  update_post_meta($post_id, 'kboxgallery' , $_POST['kboxgallery']);		
	}
  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
}


/*-----------------------------------------------------------------------------------*/
/* Areas of Work */
/*-----------------------------------------------------------------------------------*/
function portfolio() {
	register_post_type( 'portfolio',
                array( 
				 'labels' => array (
					  'name' => __( 'Areas of Work', 'CircleLaw' ),
					  'all_items' => __('View All', 'CircleLaw'),
					  'add_new' => __( 'Add New Area', 'CircleLaw' ),
					  'add_new_item' => __( 'Add New Area', 'CircleLaw' ),
					  'edit' => __( 'Edit Area', 'CircleLaw' ),
					  'edit_item' => __( 'Edit Area', 'CircleLaw' ),
					  'new_item' => __( 'Add New Area', 'CircleLaw' ),
					  'view' => __( 'View Area', 'CircleLaw' ),
					  'view_item' => __( 'View Area', 'CircleLaw' ),
					  'search_items' => __( 'Search In Areas', 'CircleLaw' ),
					  'not_found' => __( 'No Areas Found', 'CircleLaw' ),
					  'not_found_in_trash' => __( 'No Areas Found In Trash', 'CircleLaw' )
					),
				'_builtin' => false,
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'menu_position' => 20 ,
				'hierarchical' => false,
				'has_archive' => false,
				'capability_type' => 'page',
				'menu_icon' => get_template_directory_uri() . '/images/slider.png',
				'supports' => array(
						'title',
						'editor',
						'thumbnail',
						'comments',
						)
					) 
				);
}
add_action('init', 'portfolio');

/* Define the custom box */

add_action( 'add_meta_boxes', 'portfolio_info' );

/* Do something with the data entered */
add_action( 'save_post', 'portfolio_info_save' );

/* Adds a box to the main column on the Post and Page edit screens */
function portfolio_info() {
    add_meta_box( 
        'portfolio_info_box',
        __( 'Area Gallery', 'CircleLaw' ),
        'portfolio_info_fields',
        'portfolio' 
    );
}

/* Prints the box content */
function portfolio_info_fields( $post ) {

  global $post;
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'portfolio_info_box_inp' );

  $area_order = get_post_meta($post->ID, 'area_order', true);

  // The actual fields for data entry
  echo '<label for="area_order" class="pos-fo">';
       _e("Area Order", 'CircleLaw' );
  echo '</label> ';
  echo '<input type="text" id="area_order" name="area_order" value="'.$area_order.'" class="pos-fo2" /><div class="pos-fo3"></div><div class="clear"></div>';
	
	$custom = get_post_custom($post->ID);
	if (!isset($custom["kboxgalleryp"])){
		$custom["kboxgalleryp"] = true;
	}
	$kgalleryp = @unserialize( $custom["kboxgalleryp"][0] );

	wp_print_scripts('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
  ?>
	<style type="text/css">
	.kthumb_c{
		margin-left:10px;
		margin-bottom:10px;
		width:150px;
		float:right;
		position:relative;
	}
	.kthumb_del{
		position:absolute;
		padding:1px 10px;
		background:#222;
		color:#fff;
		right:0;bottom:0;
		cursor:pointer;
	}
	</style>

	<script> 
	jQuery(document).ready(function() {
		
		var i = 1;
		
		jQuery('#add_new_slide').click(function() {
			//uploadID =  this.parentNode.id;
			//uploadID =  jQuery(this).parent().attr("id");
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=1', true);
			return false;
		});
			
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
				
			jQuery("#galleryview .kadoo").append(
			'<div id="kthumb_c_' + i + '" class="kthumb_c"> \
			<div  class="kthumb_del">Delete</div> \
			<img src="' + imgurl + '" width="150" height="130"  /> \
			<input type="hidden" name="kboxgalleryp[]" value="' + imgurl + '" /></div>\
			');
			i++;
			tb_remove();
			//window.send_to_editor = window.restore_send_to_editor;	
		};
	
		jQuery(".kthumb_del").live("click" , function() {
			jQuery(this).parent().addClass('removered').fadeOut(function() {
				jQuery(this).remove();
			});
		});
	
	}); 
    </script>
    
    <input id="add_new_slide" type="button" class="mpanel-save" value="<?php _e("Add New Image", 'CircleLaw' ); ?>">
    
    <div class="pos-fo1"></div>
    
    <div id="galleryview">
    <div class="kadoo">
    
		<?php if( $kgalleryp ): foreach( $kgalleryp as $galimg ): ?> 
        <div class="kthumb_c">
        <div  class="kthumb_del"><?php _e("Delete", 'CircleLaw' ); ?></div>
        <img src="<?php echo $galimg ?>" width="150" height="130"  />
        <input type="hidden" name="kboxgalleryp[]" value="<?php echo $galimg ?>" /></div>
        <?php endforeach; endif; ?>
    
    </div><!--end of kadoo-->
    <div class="pos-fo1"></div>    
    </div><!--end of galleryview#-->
    
    <?php
  
  // Gallery
  
}

/* When the post is saved, saves our custom data */
function portfolio_info_save( $post_id ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if (!isset($_POST['portfolio_info_box_inp'])){
	$_POST['portfolio_info_box_inp'] = true;  
  }
  if ( !wp_verify_nonce( $_POST['portfolio_info_box_inp'], plugin_basename( __FILE__ ) ) )
      return;

  
  // Check permissions
  if (!isset($_POST['post_type'])){
	  $_POST['post_type'] = true;
  }
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }
  
  if (!isset($_POST['area_order'])){
    $_POST['area_order'] = "";  
    }
  if (!update_post_meta($post_id, 'area_order', $_POST['area_order'])){
    add_post_meta($post_id, 'area_order', $_POST['area_order']);
  }

  // OK, we're authenticated: we need to find and save the data
	if (!isset($_POST['kboxgalleryp'])){
		$_POST['kboxgalleryp'] = "";  
  	}
	if( $_POST['kboxgalleryp'] && $_POST['kboxgalleryp'] != "" ){
	  update_post_meta($post_id, 'kboxgalleryp' , $_POST['kboxgalleryp']);		
	}
  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
}

?>