<?php get_header(); ?>

<?php if (have_posts()) {
    while (have_posts()) {
        the_post();
        get_template_part( 'includes/templates/_navigation', get_post_format() );
        get_template_part( 'includes/templates/_carousel', get_post_format() );
        get_template_part( 'includes/templates/_article', get_post_format() );

        bebelThemeUtils::getPageFooterTemplate();
    }
}
?>

<?php get_footer(); ?>