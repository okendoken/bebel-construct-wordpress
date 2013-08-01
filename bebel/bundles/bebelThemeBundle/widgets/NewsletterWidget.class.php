<?php

class NewsletterWidget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_newsletter', 'description' => __( "Newsletter subscription form") );
        parent::__construct('newsletter', __('Newsletter'), $widget_ops);
        $this->alt_option_name = 'widget_newsletter';

        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_newsletter', 'widget');

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

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Newsletter') : $instance['title'], $instance, $this->id_base);
        $description = apply_filters('widget_description', empty($instance['description']) ? __('Get Notifications') : $instance['description'], $instance, $this->id_base);?>

        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        <div class="description"><?php echo $description; ?></div>
        <form class="form-inline newsletter-form" action="#">
            <label>
                <input type="email" class="input-condensed" placeholder="E-Mail"/>
            </label>
            <button type="submit" class="btn btn-danger btn-small">Submit <i class="icon-chevron-right"></i></button>
        </form>
        <?php echo $after_widget; ?>

        <?php
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_newsletter', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['description'] = strip_tags($new_instance['description']);
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_newsletter']) )
            delete_option('widget_newsletter');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_newsletter', 'widget');
    }

    function form( $instance ) {
        $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'Newsletter';
        $description = isset( $instance['description'] ) ? esc_attr( $instance['description'] ) : 'Get Notifications';
        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo $description; ?>" /></p>
    <?php
    }
}
// End Newsletter widget