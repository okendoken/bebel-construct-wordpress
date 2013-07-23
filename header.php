<!DOCTYPE html>
<html <?php if(isset($doctype)){ language_attributes( $doctype ); } ?>>
<head>
    <meta charset="utf-8">
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo CircleLaw_option('custom-favicon'); ?>" />
    <link rel="icon" type="image/x-icon" href="<?php echo CircleLaw_option('custom-favicon'); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php if (isset($class)){ body_class($class); } ?>>

<div class="wrapper container">
  <!--Start Header-->
  <header>
      <div class="logo home">
          <div class="shadow"></div>
          <a class="logo-content" href="<?php echo home_url(); ?>">
              <!-- todo LOGO image -->
              <span class="square"></span>
              <span class="name">Construct</span>
              <span class="slogan">We Build Things</span>
          </a>
<!--          <a href="--><?php //echo home_url(); ?><!--"><img src="--><?php //echo CircleLaw_option('site-logo'); ?><!--" alt="--><?php //bloginfo('name'); ?><!--" /></a>-->
      </div><!--End Logo-->
  </header><!--End Header-->
  <!--Start Main Content-->
  <div class="content">