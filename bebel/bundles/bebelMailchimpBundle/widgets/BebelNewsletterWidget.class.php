<?php

class BebelNewsletterWidget extends WP_Widget {
    private $bundleDir = 'bebelMailchimpBundle';

    function __construct() {
        $widget_ops = array('classname' => 'widget_bebel_newsletter', 'description' => __( "Newsletter subscription form") );
        parent::__construct('bebel_newsletter', __('Newsletter'), $widget_ops);
        $this->alt_option_name = 'widget_bebel_newsletter';

        add_action('update_option_'.BebelSingleton::getInstance('BebelSettings')->getPrefix().'-settings', array($this, 'flush_widget_cache'));
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_bebel_newsletter', 'widget');

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
        $description = apply_filters('widget_description', empty($instance['description']) ? __('Get Notifications') : $instance['description'], $instance, $this->id_base);
        $url = site_url()."/wp-admin/admin-ajax.php";?>

        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        <div class="description"><?php echo $description; ?></div>
        <?php if(BebelSingleton::getInstance('BebelSettings')->get('mailchimp_apikey') == ''){?>
            <strong>No mailchimp API key defined.</strong> Please, define mailchimp API key in your backend.
        <?php } else { ?>
        <form id="mailchimp-newsletter-form" class="form-inline newsletter-form" action="<?php echo $url; ?>">
            <label>
                <input type="email" class="newsletter-input" name="email" id="email" placeholder="<?php echo __('E-Mail', BebelSingleton::getInstance('BebelSettings')->getPrefix()); ?>" required />
            </label>
            <button type="submit" class="btn btn-danger btn-small"><i class="icon-chevron-right"></i></button>
        </form>
        <?php }?>
        <?php echo $after_widget; ?>

        <?php
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_bebel_newsletter', $cache, 'widget');

        //widget specific js
        wp_enqueue_script(
            'newsletter',
            get_template_directory_uri().BebelUtils::getBundlePath().'/'.$this->bundleDir.'/widgets/assets/newsletter.js',
            array('jquery'),
            false,
            true
        );
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['description'] = strip_tags($new_instance['description']);
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_bebel_newsletter']) )
            delete_option('widget_bebel_newsletter');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_bebel_newsletter', 'widget');
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
        $settings = BebelSingleton::getInstance('BebelSettings');
        $api_key = $settings->get('mailchimp_apikey');

        if($api_key == '') {
            echo '<span style="color: #ff0000"><b>Error:</b> You have to insert a valid api key!</span>';
        }else {
            $mcapi = new BebelMailchimp($api_key);
            if($mcapi->check() == "invalid") {
                echo '<span style="color: #ff0000"><b>Error:</b> You have to insert a valid api key!</span>';
            } else {
                echo '<p class="help">Displays a newsletter signup form that directly sends the email addresses to mailchimp.</p>';
            }
        }
    }
}
// End Newsletter widget