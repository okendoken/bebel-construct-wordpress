<?php

class BebelNewsWidget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_bebel_news', 'description' => __( "The most recent news from your site") );
        parent::__construct('bebel_news', __('News'), $widget_ops);
        $this->alt_option_name = 'widget_bebel_news';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_bebel_news', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? __('News') : $instance['title'], $instance, $this->id_base);
        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ){
            $number = 2;
        }

        $q = new WP_Query( apply_filters( 'widget_bebel_news_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if ($q->have_posts()) :
            ?>
            <?php echo $before_widget; ?>
            <?php if ( $title ) echo $before_title . $title . $after_title; ?>
            <ul>
                <?php while ( $q->have_posts() ) : $q->the_post(); ?>
                    <div class="post">
                        <?php get_the_excerpt() == '' ? the_title() : the_excerpt()?>
                        <a href="<?php the_permalink() ?>"  title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>" class="more-link">more...</a>
                    </div>
                <?php endwhile; ?>
            </ul>
            <?php echo $after_widget; ?>
<?php
// Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_bebel_news', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_bebel_news']) )
            delete_option('widget_bebel_news');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_bebel_news', 'widget');
    }

    function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2;
        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of news (posts) to show:' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
    <?php
    }
}
// End News widget