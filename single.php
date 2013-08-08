<?php
get_header();

$page_layout = BebelUtils::getCustomMeta('post_layout', false, get_the_ID());

if(!$page_layout) {
    $page_layout = "with-image";
}
?>
    <!--Start Header-->
    <header>
        <?php bebelThemeUtils::getLogoTemplate(false, $page_layout == 'no-image' ? false : true); ?>
    </header><!--End Header-->
    <!--Start Main Content-->
<div class="content">
<?php

$slug = $page_layout;

// custom css for this page
$css = BebelUtils::getCustomMeta('css', false, get_the_ID());

?>
<?php if($css): ?>
    <style>
        <?php echo $css; ?>
    </style>
<?php endif; ?>

<?php get_template_part( 'templates/single-'.$slug, get_post_format() );?>

<?php get_footer(); ?>