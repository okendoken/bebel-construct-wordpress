<?php get_header(); ?>

<?php if (have_posts()) {
    while (have_posts()) {
        the_post();
        get_template_part( 'includes/_navigation', get_post_format() );
        get_template_part( 'includes/_carousel', get_post_format() );
        get_template_part( 'includes/_article', get_post_format() );

        get_page_footer_template();
    }
}
?>

<?php get_footer(); ?>