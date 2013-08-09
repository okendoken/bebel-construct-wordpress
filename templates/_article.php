<article id="<?php echo is_page() ? 'page' : 'post'?>-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
    <h1 class="article-title">
        <?php the_title() ?>
        <small class="author">/ by <?php echo ucfirst(get_the_author()); ?></small>
    </h1>
    <?php the_content() ?>
</article>