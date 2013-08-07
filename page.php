<?php
$page_layout = BebelUtils::getCustomMeta('page_layout', false, get_the_ID());

if(!$page_layout) {
    $page_layout = "with-image";
}
$custom_header = get_stylesheet_directory()."/header-{$page_layout}.php";
if (file_exists($custom_header)){
    get_header($page_layout);
} else {
    get_header();
}


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