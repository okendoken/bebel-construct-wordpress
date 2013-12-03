<article id="<?php echo is_page() ? 'page' : 'post'?>-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
    <h1 class="article-title">
        <?php the_title() ?>
        <small class="author">/ by <?php the_author_posts_link(); ?></small>
    </h1>
    <?php the_content() ?>
    <?php wp_link_pages(array(
        'before'           => '<div class="text-align-center"><div class="pagination">' ,
        'after'            => '</div></div>'
    )) ?>
</article>