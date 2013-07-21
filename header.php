<!doctype html>
<html <?php if(isset($doctype)){ language_attributes( $doctype ); } ?>>
<head>
<meta charset="utf-8">
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo CircleLaw_option('custom-favicon'); ?>" />
<link rel="icon" type="image/x-icon" href="<?php echo CircleLaw_option('custom-favicon'); ?>" />
<?php
if ( is_singular() && get_option( 'thread_comments' ) )
wp_enqueue_script( 'comment-reply' );

wp_head();
?>
</head>
<body <?php if (isset($class)){ body_class($class); } ?>>

<div class="container">
  <!--Start Header-->
  <header>
    <div class="logo">
      <a href="<?php echo home_url(); ?>"><img src="<?php echo CircleLaw_option('site-logo'); ?>" alt="<?php bloginfo('name'); ?>" /></a>
    </div><!--End Logo-->
    <div id="nav">
        <?php
        if (!wp_nav_menu( array( 'theme_location' => 'header-menu' ) )){
          wp_link_pages();
        }
        ?>
    </div><!--End Navigation-->
  </header><!--End Header-->
  <!--Start Main Content-->
  <div class="contenttt">