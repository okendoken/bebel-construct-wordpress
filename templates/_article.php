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
            $cat_names_length = 0;
            if($categories){
                foreach($categories as $category) {
                    $cat_output .= '<a href="'.get_category_link( $category->term_id )
                        .'" title="' . esc_attr( sprintf( __( "View all posts in %s", BebelSingleton::getInstance('BebelSettings')->getPrefix() ), $category->name ) ) . '">'
                        .$category->cat_name.'</a>'.$cat_separator;
                    $cat_names_length += strlen($category->cat_name) + 2;
                }
            }
            $cat_names_length -= 2;
            ?>
            <?php
            $tags = get_the_tags();
            $tags_separator = ', ';
            $tags_output = '';
            $tags_names_length = 0;
            if($tags){
                foreach($tags as $tag) {
                    $tags_output .= '<a href="'.get_tag_link( $tag->term_id )
                        .'" title="' . esc_attr( sprintf( __( "View all posts tagged with %s", BebelSingleton::getInstance('BebelSettings')->getPrefix() ), $tag->name ) ) . '">'
                        .$tag->name.'</a>'.$tags_separator;
                    $tags_names_length += strlen($tag->name) + 2;
                }
            }
            $tags_names_length -= 2;
            //grid size control system. should be done by css
            if ($tags_names_length == -2){
                $cell_sizes = array(12, 0);
            } elseif ($cat_names_length == -2){
                $cell_sizes = array(0, 12);
            } elseif ($tags_names_length >= 80 && $cat_names_length < 48){
                $cell_sizes = array(4, 6);
            } elseif ($tags_names_length < 38){
                $cell_sizes = array(6, 4);
            } else {
                $cell_sizes = array(5, 5);
            }
            ?>
            <div class="post-preview-info">
                <div class="row">
                    <?php if (!empty($cat_output)){ ?>
                        <div class="col-sm-<?php echo $cell_sizes[0] == 12 ? '12' : $cell_sizes[0].' col-sm-offset-2'?> col-xs-10">
                            <span class="category-link">
                                <i class="icon-inbox"></i>
                                <?php echo __('posted in', BebelSingleton::getInstance('BebelSettings')->getPrefix())?>
                                <?php echo trim($cat_output, $cat_separator);?>
                            </span>
                        </div>
                    <?php } ?>
                    <?php if (!empty($tags_output)){ ?>
                        <div class="col-sm-<?php echo $cell_sizes[1]?> col-xs-10">
                        <span class="tags-link">
                            <i class="icon-tags"></i>
                            <?php echo __('tagged with', BebelSingleton::getInstance('BebelSettings')->getPrefix())?>
                            <?php echo trim($tags_output, $tags_separator);?>
                        </span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php the_content() ?>
    <?php wp_link_pages(array(
        'before'           => '<div class="text-align-center"><div class="pagination">' ,
        'after'            => '</div></div>'
    )) ?>
</article>