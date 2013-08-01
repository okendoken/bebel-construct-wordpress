<!DOCTYPE html>
<html <?php if(isset($doctype)){ language_attributes( $doctype ); } ?>>
<head>
    <meta charset="utf-8">
    <title><?php BebelUtils::getPageTitle(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="http://localhost/projects/wordpress/clean/wp-content/themes/Construct/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="http://localhost/projects/wordpress/clean/wp-content/themes/Construct/favicon.ico" />
    <?php wp_head(); ?>
</head>
<body <?php if (isset($class)){ body_class($class); } ?>>

<div class="wrapper container">
  <!--Start Header-->
  <header>
      <?php bebelThemeUtils::getLogoTemplate(); ?>
  </header><!--End Header-->
  <!--Start Main Content-->
  <div class="content">