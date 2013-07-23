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
      <?php get_logo_template(); ?>
  </header><!--End Header-->
  <!--Start Main Content-->
  <div class="content">