<?php

class BebelSocialWidget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_bebel_social', 'description' => __( "Your social platforms") );
        parent::__construct('bebel_social', __('Social Icons'), $widget_ops);
        $this->alt_option_name = 'widget_bebel_social';

        add_action('update_option_'.BebelSingleton::getInstance('BebelSettings')->getPrefix().'-settings', array($this, 'flush_widget_cache'));
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_bebel_social', 'widget');


        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        $settings = BebelSingleton::getInstance('BebelSettings');
        ob_start();
        extract($args);


        $twitter = isset($instance['twitter']) ? $instance['twitter'] : true;
        $facebook = isset($instance['facebook']) ? $instance['facebook'] : true;
        $linkedin = isset($instance['linkedin']) ? $instance['linkedin'] : true;
        $google_plus = isset($instance['google_plus']) ? $instance['google_plus'] : true;


        echo $before_widget; ?>
        <div class="social-icons">
            <?php if ($twitter or $facebook or $linkedin or $google_plus){ ?>
                <?php if ($twitter) { ?>
                    <a href="<?php echo $settings->get("twitter_url") ?>"><i class="icon-twitter icon-large"></i></a>
                <?php } ?>
                <?php if ($facebook) { ?>
                    <a href="<?php echo $settings->get("facebook_url") ?>"><i class="icon-facebook icon-large"></i></a>
                <?php } ?>
                <?php if ($linkedin) { ?>
                    <a href="<?php echo $settings->get("linkedin_url") ?>"><i class="icon-linkedin icon-large"></i></a>
                <?php } ?>
                <?php if ($google_plus) { ?>
                    <a href="<?php echo $settings->get("google_plus_url") ?>"><i class="icon-google-plus icon-large"></i></a>
                <?php } ?>
            <?php } else { ?>
                Select at least one social page in widget options
            <?php } ?>
        </div>
        <?php echo $after_widget;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_bebel_social', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['twitter'] = $new_instance['twitter'] == 'on';
        $instance['facebook'] = $new_instance['facebook'] == 'on';
        $instance['linkedin'] = $new_instance['linkedin'] == 'on';
        $instance['google_plus'] = $new_instance['google_plus'] == 'on';
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_bebel_social']) )
            delete_option('widget_bebel_social');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_bebel_social', 'widget');
    }

    function form( $instance ) {
        $twitter     = isset( $instance['twitter'] ) ? $instance['twitter'] : true;
        $facebook     = isset( $instance['facebook'] ) ? $instance['facebook'] : true;
        $linkedin     = isset( $instance['linkedin'] ) ? $instance['linkedin'] : true;
        $google_plus     = isset( $instance['google_plus'] ) ? $instance['google_plus'] : true;
        ?>
        <p><label for="<?php echo $this->get_field_id( 'twitter' ); ?>">
                <input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>"
                       type="checkbox" <?php echo $twitter ? 'checked="checked"' : '' ?>/>
                &nbsp;&nbsp;&nbsp;<?php _e( 'Twitter' ); ?>
            </label></p>
        <p><label for="<?php echo $this->get_field_id( 'facebook' ); ?>">
                <input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>"
                       type="checkbox" <?php echo $facebook ? 'checked="checked"' : '' ?>/>
                &nbsp;&nbsp;&nbsp;<?php _e( 'Facebook' ); ?>
            </label></p>
        <p><label for="<?php echo $this->get_field_id( 'linkedin' ); ?>">
                <input id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>"
                       type="checkbox" <?php echo $linkedin ? 'checked="checked"' : '' ?>/>
                &nbsp;&nbsp;&nbsp;<?php _e( 'LinkedIn' ); ?>
            </label></p>
        <p><label for="<?php echo $this->get_field_id( 'google_plus' ); ?>">
                <input id="<?php echo $this->get_field_id( 'google_plus' ); ?>" name="<?php echo $this->get_field_name( 'google_plus' ); ?>"
                       type="checkbox" <?php echo $google_plus ? 'checked="checked"' : '' ?>/>
                &nbsp;&nbsp;&nbsp;<?php _e( 'Google Plus' ); ?>
            </label></p>
    <?php
    }
}
// End News widget