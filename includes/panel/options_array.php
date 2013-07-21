<?php

$blocks[] = array(
	'name' => 	__( 'General Setting', 'CircleLaw' ),
	'id' => 	  'general-setting'
);



	$sections[] =  array(
		'name' => 	  __( 'Responsive On/Off', 'CircleLaw' ),
		'id' => 		'responsive-onoff',
		'block_id' =>  'general-setting',
		'type' => 'normal'
	);


		$fields[] =  array(
			'label' => 		 __( 'Responsive Theme', 'CircleLaw' ),
			'section_id' => 	'responsive-onoff',
			'id' => 			'responsive-onoff',
			'type' => 		  'on-of'
		);


	$sections[] =  array(
		'name' => 	  __( 'Sliding background for menu On/Off', 'CircleLaw' ),
		'id' => 		'menu-sliding',
		'block_id' =>  'general-setting',
		'type' => 'normal'
	);


		$fields[] =  array(
			'label' => 		 __( 'Use sliding background', 'CircleLaw' ),
			'section_id' => 	'menu-sliding',
			'id' => 			'menu-sliding',
			'type' => 		  'on-of'
		);


	$sections[] =  array(
		'name' => 	  __( 'Site Logo', 'CircleLaw' ),
		'id' => 		'site-logo',
		'block_id' =>  'general-setting',
		'type' => 'normal'
	);

		$fields[] =  array(
			'label' => 		 __( 'Site Logo', 'CircleLaw' ),
			'section_id' => 	'site-logo',
			'id' => 			'site-logo',
			'type' => 		  'upload'
		);

	$sections[] =  array(
		'name' => 	  __( 'Custom Favicon', 'CircleLaw' ),
		'id' => 		'custom-favicon',
		'block_id' =>  'general-setting',
		'type' => 'normal'
	);

		$fields[] =  array(
			'label' => 		 __( 'Custom Favicon', 'CircleLaw' ),
			'section_id' => 	'custom-favicon',
			'id' => 			'custom-favicon',
			'type' => 		  'upload'
		);

	$sections[] =  array(
		'name' => 	  __( 'Google Analytics', 'CircleLaw' ),
		'id' => 		'google-analytics',
		'block_id' =>  'general-setting',
		'type' => 'normal'
	);

		$fields[] =  array(
			'section_id' => 	'google-analytics',
			'label' => 		 __( 'Google Analytics', 'CircleLaw' ),
			'id' => 			'google-analytics',
			'type' => 		  'textarea',
			'std' =>	      'UA-xxxxxxxx-x'
		);



$blocks[] = array(
	'name' => 	__( 'Homepage', 'CircleLaw' ),
	'id' => 	  'homepage-items'
);


	$sections[] =  array(
		'name' => 	  __( 'Homepage', 'CircleLaw' ),
		'id' => 		'homepage-item',
		'block_id' =>  'homepage-items',
		'type' => 'normal'
	);

		
		$fields[] =  array( 
			'label' => 		 __( 'Number of displayed items', 'CircleLaw' ),
			'section_id' => 	'homepage-item',
			'id' => 			'number_home',
			'type' => 		  'slider',
			'min' =>		   1,
			'unit' =>		   "item",
			'max' =>		   30
		);

		
		$fields[] =  array( 
			'label' => 		 __( 'Homepage items animate speed', 'CircleLaw' ),
			'section_id' => 	'homepage-item',
			'id' => 			'speed_home_fade',
			'type' => 		  'slider',
			'min' =>		   0,
			'unit' =>		   "milli",
			'max' =>		   2500
		);


$blocks[] = array(
	'name' => 	__( 'Custom Posts', 'CircleLaw' ),
	'id' => 	  'custom-posts'
);


	$sections[] =  array(
		'name' => 	  __( 'Areas of Work', 'CircleLaw' ),
		'id' => 		'portfolio',
		'block_id' =>  'custom-posts',
		'type' => 'normal'
	);


		$fields[] =  array(
			'label' => 		 __( 'Activate AddThis buttons', 'CircleLaw' ),
			'section_id' => 	'portfolio',
			'id' => 			'addthis-buttons-portfolio',
			'type' => 		  'on-of'
		);

		$fields[] =  array(
			'section_id' => 	'portfolio',
			'label' => 		 __( 'Areas of Work Title', 'CircleLaw' ),
			'id' => 			'portfolio-title',
			'type' => 		  'text'
		);

		$fields[] =  array(
			'section_id' => 	'portfolio',
			'label' => 		 __( 'Areas of Work Title Description', 'CircleLaw' ),
			'id' => 			'portfolio-title-desc',
			'type' => 		  'text'
		);
		
		$fields[] =  array( 
			'label' => 		 __( 'Areas of Work items per page', 'CircleLaw' ),
			'section_id' => 	'portfolio',
			'id' => 			'number_of_portfolio',
			'type' => 		  'slider',
			'min' =>		   0,
			'unit' =>		   "items",
			'max' =>		   15
		);

	$sections[] =  array(
		'name' => 	  __( 'Gallery', 'CircleLaw' ),
		'id' => 		'gallery',
		'block_id' =>  'custom-posts',
		'type' => 'normal'
	);



		$fields[] =  array(
			'section_id' => 	'gallery',
			'label' => 		 __( 'Gallery Title', 'CircleLaw' ),
			'id' => 			'gallery-title',
			'type' => 		  'text'
		);

		$fields[] =  array(
			'section_id' => 	'gallery',
			'label' => 		 __( 'Gallery Title Description', 'CircleLaw' ),
			'id' => 			'gallery-title-desc',
			'type' => 		  'text'
		);
		
		$fields[] =  array( 
			'label' => 		 __( 'Gallery items per page', 'CircleLaw' ),
			'section_id' => 	'gallery',
			'id' => 			'number_of_gallery',
			'type' => 		  'slider',
			'min' =>		   0,
			'unit' =>		   "items",
			'max' =>		   20
		);

	$sections[] =  array(
		'name' => 	  __( 'Team', 'CircleLaw' ),
		'id' => 		'team',
		'block_id' =>  'custom-posts',
		'type' => 'normal'
	);

		
		$fields[] =  array(
			'section_id' => 	'team',
			'label' => 		 __( 'Team Title', 'CircleLaw' ),
			'id' => 			'team-title',
			'type' => 		  'text'
		);

		$fields[] =  array(
			'section_id' => 	'team',
			'label' => 		 __( 'Team Title Description', 'CircleLaw' ),
			'id' => 			'team-title-desc',
			'type' => 		  'text'
		);
		
		$fields[] =  array( 
			'label' => 		 __( 'Team items per page', 'CircleLaw' ),
			'section_id' => 	'team',
			'id' => 			'number_of_team',
			'type' => 		  'slider',
			'min' =>		   1,
			'unit' =>		   "items",
			'max' =>		   32
		);

	$sections[] =  array(
		'name' => 	  __( 'Clients', 'CircleLaw' ),
		'id' => 		'clients',
		'block_id' =>  'custom-posts',
		'type' => 'normal'
	);

		
		$fields[] =  array(
			'section_id' => 	'clients',
			'label' => 		 __( 'Clients Title', 'CircleLaw' ),
			'id' => 			'clients-title',
			'type' => 		  'text'
		);

		$fields[] =  array(
			'section_id' => 	'clients',
			'label' => 		 __( 'Clients Title Description', 'CircleLaw' ),
			'id' => 			'clients-title-desc',
			'type' => 		  'text'
		);
		
		$fields[] =  array( 
			'label' => 		 __( 'Clients items per page', 'CircleLaw' ),
			'section_id' => 	'clients',
			'id' => 			'number_of_clients',
			'type' => 		  'slider',
			'min' =>		   1,
			'unit' =>		   "items",
			'max' =>		   32
		);


$blocks[] = array(
	'name' => 	__( 'Blog', 'CircleLaw' ),
	'id' => 	  'blog-option'
);

	$sections[] =  array(
		'name' => 	  __( 'Blog', 'CircleLaw' ),
		'id' => 		'blog-option',
		'block_id' =>  'blog-option',
		'type' => 'normal'
	);

		$fields[] =  array(
			'label' => 		 __( 'Activate AddThis buttons', 'CircleLaw' ),
			'section_id' => 	'blog-option',
			'id' => 			'addthis-buttons',
			'type' => 		  'on-of'
		);

		$fields[] =  array(
			'section_id' => 	'blog-option',
			'label' => 		 __( 'Blog Title', 'CircleLaw' ),
			'id' => 			'blog-title',
			'type' => 		  'text'
		);

		$fields[] =  array(
			'section_id' => 	'blog-option',
			'label' => 		 __( 'Blog Title Description', 'CircleLaw' ),
			'id' => 			'blog-title-desc',
			'type' => 		  'text'
		);

		$fields[] =  array(
			'section_id' => 	'blog-option',
			'label' => 		 __( 'Date Format', 'CircleLaw' ),
			'id' => 			'date-format',
			'type' => 		  'text'
		);


$blocks[] = array(
	'name' => 	__( 'Error 404 Page', 'CircleLaw' ),
	'id' => 	  'error-page'
);

	$sections[] =  array(
		'name' => 	  __( 'Error 404 Page', 'CircleLaw' ),
		'id' => 		'error-page',
		'block_id' =>  'error-page',
		'type' => 'normal'
	);

		$fields[] =  array(
			'section_id' => 	'error-page',
			'label' => 		 __( 'Page Title', 'CircleLaw' ),
			'id' => 			'error-page-title',
			'type' => 		  'text'
		);

		$fields[] =  array(
			'section_id' => 	'error-page',
			'label' => 		 __( 'Error Message', 'CircleLaw' ),
			'id' => 			'error-page-msg',
			'type' => 		  'editor'
		);

$blocks[] = array(
	'name' => 	__( 'Contact Page', 'CircleLaw' ),
	'id' => 	  'contact-page'
);

	$sections[] =  array(
		'name' => 	  __( 'Contact Page', 'CircleLaw' ),
		'id' => 		'contact-page',
		'block_id' =>  'contact-page',
		'type' => 'normal'
	);

		$fields[] =  array(
			'section_id' => 	'contact-page',
			'label' => 		 __( 'Title Description', 'CircleLaw' ),
			'id' => 			'contact-page-title',
			'type' => 		  'text'
		);

		$fields[] =  array(
			'section_id' => 	'contact-page',
			'label' => 		 __( 'Google Map Location', 'CircleLaw' ),
			'id' => 			'contact-page-map',
			'type' => 		  'text',
			'note' => 		  'Enter full url for your google maps location, you can get it easily from <a target="_blank" href="https://maps.google.com/">here</a>'
		);

		$fields[] =  array(
			'section_id' => 	'contact-page',
			'label' => 		 __( 'Contact E-mail', 'CircleLaw' ),
			'id' => 			'contact-page-mail',
			'type' => 		  'text'
		);

		$fields[] =  array(
			'section_id' => 	'contact-page',
			'label' => 		 __( 'Contact Details', 'CircleLaw' ),
			'id' => 			'contact-page-info',
			'type' => 		  'editor'
		);

		$fields[] =  array(
			'section_id' => 	'contact-page',
			'label' => 		 __( 'Message after send', 'CircleLaw' ),
			'id' => 			'contact-page-msg',
			'type' => 		  'textarea'
		);


$blocks[] = array(
	'name' => 	__( 'Social Network', 'CircleLaw' ),
	'id' => 	  'social-network'
);

	$sections[] =  array(
		'name' => 	  __( 'Latest Tweets', 'CircleLaw' ),
		'id' => 		'latest-twitts',
		'block_id' =>  'social-network',
		'type' => 'normal'
	);

		$fields[] =  array(
			'section_id' => 	'latest-twitts',
			'label' => 		 __( 'Twitter Username', 'CircleLaw' ),
			'id' => 			'twitter-user-latest',
			'type' => 		  'text'
		);

		$fields[] =  array( 
			'label' => 		 __( 'Number of Latest Tweets', 'CircleLaw' ),
			'section_id' => 	'latest-twitts',
			'id' => 			'number_of_twitts',
			'type' => 		  'slider',
			'min' =>		   1,
			'unit' =>		   "items",
			'max' =>		   20
		);

	$sections[] =  array(
		'name' => 	  __( 'Social Network', 'CircleLaw' ),
		'id' => 		'social-network',
		'block_id' =>  'social-network',
		'type' => 'normal'
	);

		$fields[] =  array(
			'section_id' => 	'social-network',
			'label' => 		 __( 'Full url for Twitter account', 'CircleLaw' ),
			'id' => 			'social-network-tw',
			'type' => 		  'text'
		);

		$fields[] =  array(
			'section_id' => 	'social-network',
			'label' => 		 __( 'Full url for Facebook account', 'CircleLaw' ),
			'id' => 			'social-network-fc',
			'type' => 		  'text'
		);

		$fields[] =  array(
			'section_id' => 	'social-network',
			'label' => 		 __( 'Full url for Linkedin account', 'CircleLaw' ),
			'id' => 			'social-network-in',
			'type' => 		  'text'
		);

		$fields[] =  array(
			'section_id' => 	'social-network',
			'label' => 		 __( 'Full url for Google account', 'CircleLaw' ),
			'id' => 			'social-network-google',
			'type' => 		  'text'
		);



$blocks[] = array(
	'name' => 	__( 'Styling Options', 'CircleLaw' ),
	'id' => 	  'styling-options'
);

	$sections[] =  array(
		'name' => 	  __( 'Main Options', 'CircleLaw' ),
		'id' => 		'main-options',
		'block_id' =>  'styling-options',
		'type' => 'normal'
	);

		$fields[] =  array( 
			'label' => 		 __( 'Background Color', 'CircleLaw' ),
			'section_id' => 	'main-options',
			'id' => 			'background-color',
			'type' => 		  'colorpicker',
			'default-color' => '#42413C'
		);

		$fields[] =  array(
			'section_id' => 	'main-options',
			'id' => 			'background-sLider',
			'label' => 		 __( 'Background Slider', 'CircleLaw' ),
			'type' => 		  'mu-upload'
		);

		$fields[] =  array( 
			'label' => 		 __( 'Text Color', 'CircleLaw' ),
			'section_id' => 	'main-options',
			'id' => 			'main-color',
			'type' => 		  'colorpicker',
			'default-color' => '#999999'
		);

		$fields[] =  array( 
			'label' => 		 __( 'Link Color', 'CircleLaw' ),
			'section_id' => 	'main-options',
			'id' => 			'url-color',
			'type' => 		  'colorpicker',
			'default-color' => '#414141'
		);

		$fields[] =  array( 
			'label' => 		 __( 'Link on mouseover', 'CircleLaw' ),
			'section_id' => 	'main-options',
			'id' => 			'urlh-color',
			'type' => 		  'colorpicker',
			'default-color' => '#000000'
		);

		$fields[] =  array( 
			'label' => 		 __( 'Second Color', 'CircleLaw' ),
			'section_id' => 	'main-options',
			'id' => 			'second-color',
			'type' => 		  'colorpicker',
			'default-color' => '#FF9900'
		);

		$fields[] =  array( 
			'label' => 		 __( 'Link Second Color', 'CircleLaw' ),
			'section_id' => 	'main-options',
			'id' => 			'link-second-color',
			'type' => 		  'colorpicker',
			'default-color' => '#FF9900'
		);

		$fields[] =  array( 
			'label' => 		 __( 'Link on mouseover Second Color', 'CircleLaw' ),
			'section_id' => 	'main-options',
			'id' => 			'linkh-second-color',
			'type' => 		  'colorpicker',
			'default-color' => '#c97900'
		);

		$fields[] =  array( 
			'label' => 		 __( 'Content Background Color', 'CircleLaw' ),
			'section_id' => 	'main-options',
			'id' => 			'content-color',
			'type' => 		  'colorpicker',
			'default-color' => '#FFFFFF'
		);

	$sections[] =  array(
		'name' => 	  __( 'Navigation', 'CircleLaw' ),
		'id' => 		'menu',
		'block_id' =>  'styling-options',
		'type' => 'normal'
	);

		$fields[] =  array( 
			'label' => 		 __( 'Link color', 'CircleLaw' ),
			'section_id' => 	'menu',
			'id' => 			'link-menu-color',
			'type' => 		  'colorpicker',
			'default-color' => '#999999'
		);

		$fields[] =  array( 
			'label' => 		 __( 'Link on mouseover color', 'CircleLaw' ),
			'section_id' => 	'menu',
			'id' => 			'linkh-menu-color',
			'type' => 		  'colorpicker',
			'default-color' => '#FFFFFF'
		);

		$fields[] =  array( 
			'label' => 		 __( 'link background color', 'CircleLaw' ),
			'section_id' => 	'menu',
			'id' => 			'background-menu-color',
			'type' => 		  'colorpicker',
			'default-color' => '#ffbb03'
		);

		$fields[] =  array( 
			'label' => 		 __( 'Subnavigation link color', 'CircleLaw' ),
			'section_id' => 	'menu',
			'id' => 			'sub-link-menu-color',
			'type' => 		  'colorpicker',
			'default-color' => '#999999'
		);

		$fields[] =  array( 
			'label' => 		 __( 'Subnavigation link on mouseover color', 'CircleLaw' ),
			'section_id' => 	'menu',
			'id' => 			'sub-linkh-menu-color',
			'type' => 		  'colorpicker',
			'default-color' => '#FFFFFF'
		);

		$fields[] =  array( 
			'label' => 		 __( 'Subnavigation border top color', 'CircleLaw' ),
			'section_id' => 	'menu',
			'id' => 			'sub-background-menu-color',
			'type' => 		  'colorpicker',
			'default-color' => '#ffbb03'
		);