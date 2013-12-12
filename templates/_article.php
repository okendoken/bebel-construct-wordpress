<article id="<?php echo is_page() ? 'page' : 'post'?>-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
    <h1 class="article-title">
        <?php the_title() ?>
        <small class="author">/ by <?php the_author_posts_link(); ?></small>
    </h1>
    <?php if (!is_page()){?>
        <div class="description">
            <?php
            $categories = get_the_category();
            $cat_separator = ', ';
            $cat_output = '';
            if($categories){
                foreach($categories as $category) {
                    $cat_output .= '<a href="'.get_category_link( $category->term_id )
                        .'" title="' . esc_attr( sprintf( __( "View all posts in %s", BebelSingleton::getInstance('BebelSettings')->getPrefix() ), $category->name ) ) . '">'
                        .$category->cat_name.'</a>'.$cat_separator;
                }
            }
            ?>
            <?php
            $tags = get_the_tags();
            $tags_separator = ', ';
            $tags_output = '';
            if($tags){
                foreach($tags as $tag) {
                    $tags_output .= '<a href="'.get_tag_link( $tag->term_id )
                        .'" title="' . esc_attr( sprintf( __( "View all posts tagged with %s", BebelSingleton::getInstance('BebelSettings')->getPrefix() ), $tag->name ) ) . '">'
                        .$tag->name.'</a>'.$tags_separator;
                }
            }
            ?>
            <?php if((!empty($cat_output)) || (!empty($tags_output))) { ?>
                <div class="post-preview-info">
                    <div class="row">
                        <div class="col-sm-12 col-xs-10">
                            <?php if (!empty($cat_output)){ ?>
                                <span class="category-link">
                                    <i class="icon-inbox"></i>
                                        <?php echo __('posted in', BebelSingleton::getInstance('BebelSettings')->getPrefix())?>
                                        <?php echo trim($cat_output, $cat_separator);?>
                                </span>
                            <?php } ?>
                            <?php if (!empty($tags_output)){ ?>
                                <span class="tags-link">
                                    <i class="icon-tags"></i>
                                            <?php echo __('tagged with', BebelSingleton::getInstance('BebelSettings')->getPrefix())?>
                                            <?php echo trim($tags_output, $tags_separator);?>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <?php the_content() ?>
    <?php wp_link_pages(array(
        'before'           => '<div class="text-align-center"><div class="pagination">' ,
        'after'            => '</div></div>'
    )) ?>
</article>