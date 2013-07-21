<?php
// Begain sidebare register
if ( function_exists('register_sidebar') )
register_sidebar();

function quickchic_widgets_init() {
register_sidebar(array(
'name' => __( 'Sidebar', 'creportal' ),
'id' => 'sidebar-1',
'before_widget' => '<div class="widgetbox">',
'after_widget' => '</div>',
'before_title' => '<h4><p>',
'after_title' => '</p></h4>',
));
}
add_action( 'init', 'quickchic_widgets_init' ); 
// End sidebare register



// Begain Flickr register
add_action( 'widgets_init', 'Flickr' );

function Flickr() {
	register_widget( 'Flickr' );
}

class Flickr extends WP_Widget {

	function Flickr() {
		$widget_ops = array( 'classname' => 'flickr', 'description' => __('Last images from flickr account', 'creportal') );
		
		$control_ops = array( 'id_base' => 'flickr-widget' );
		
		$this->WP_Widget( 'flickr-widget', __('Flickr Widget', 'creportal'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = $instance['title'];
		$user = $instance['user'];
		$number = $instance['number'];
		// Display the widget title
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
	?>
   	 		<div id="flickr_badge_wrapper">
			<script src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=Random&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $user; ?>"></script>
            </div>
            <div class="clear"></div>
    <?php
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['user'] = strip_tags( $new_instance['user'] );
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Flickr', 'creportal'), 'number' => 8);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'creportal'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widperc" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'user' ); ?>"><?php _e('Flickr User:', 'creportal'); ?></label>
			<input id="<?php echo $this->get_field_id( 'user' ); ?>" name="<?php echo $this->get_field_name( 'user' ); ?>" value="<?php echo $instance['user']; ?>" class="widperc" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number Images:', 'creportal'); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" class="widperc" />
		</p>

	<?php
	}
}
// End Flickr register


// Begain Twitter register
add_action( 'widgets_init', 'Twitter' );

function Twitter() {
	register_widget( 'Twitter' );
}

class Twitter extends WP_Widget {

	function Twitter() {
		$widget_ops = array( 'classname' => 'twitter', 'description' => __('Twitter Widget show', 'creportal') );
		
		$control_ops = array( 'id_base' => 'twitter-widget' );
		
		$this->WP_Widget( 'twitter-widget', __('Twitter Widget', 'creportal'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = $instance['title'];
		$user = $instance['user'];
		$number = $instance['number'];
			echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title; ?>
<script type="text/javascript">
jQuery(document).ready(function() {
	var dataa = <?php echo gltweets($user,$number) ?>;
	for(ii=0; ii<<?php echo $number; ?>; ii++){
		var tweeta = dataa[ii].text;
		tweeta = tweeta.parseURLaaa().parseUsernameaaa().parseHashtagaaa();
		jQuery("#twitter_update_list").append('<li>' + tweeta + '</li>');
	}// end for
}); 
 
//Twitter Parsers
String.prototype.parseURLaaa = function() {
    return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&~\?\/.=]+/g, function(url) {
        return url.link(url);
    });
};
String.prototype.parseUsernameaaa = function() {
    return this.replace(/[@]+[A-Za-z0-9-_]+/g, function(u) {
        var username = u.replace("@","")
        return u.link("http://twitter.com/"+username);
    });
};
String.prototype.parseHashtagaaa = function() {
    return this.replace(/[#]+[A-Za-z0-9-_]+/g, function(t) {
        var tag = t.replace("#","%23")
        return t.link("http://search.twitter.com/search?q="+tag);
    });
};
</script>
            <!-- Tweets -->
            <ul id="twitter_update_list"></ul><!--END Tweets-->
    <?php
		echo $after_widget;
	}
	
	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['user'] = strip_tags( $new_instance['user'] );
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Latest Tweets', 'creportal'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'creportal'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widperc" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'user' ); ?>"><?php _e('User Account:', 'creportal'); ?></label>
			<input id="<?php echo $this->get_field_id( 'user' ); ?>" name="<?php echo $this->get_field_name( 'user' ); ?>" value="<?php echo $instance['user']; ?>" class="widperc" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number twitts:', 'creportal'); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" class="widperc" />
		</p>

	<?php
	}
}
// End Twitter register



// Begain FaceBook register
add_action( 'widgets_init', 'Facebook' );

function Facebook() {
	register_widget( 'Facebook' );
}

class Facebook extends WP_Widget {

	function Facebook() {
		$widget_ops = array( 'classname' => 'facebook', 'description' => __('FaceBook Like Box Show', 'creportal') );
		
		$control_ops = array( 'id_base' => 'facebook-widget' );
		
		$this->WP_Widget( 'facebook-widget', __('Facebook Widget', 'creportal'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = $instance['title'];
		$user = $instance['user'];
		// Display the widget title
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
	?>
        	<iframe scrolling="no" frameborder="0" allowtransparency="true" class="widg-fo" src="//www.facebook.com/plugins/likebox.php?href=http://facebook.com/<?php echo $user; ?>&amp;width=300&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23e1e1e1&amp;stream=false&amp;header=false"></iframe>
    <?php
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['user'] = strip_tags( $new_instance['user'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Find us on Facebook', 'creportal'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'creportal'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widperc" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'user' ); ?>"><?php _e('Facebook Page:', 'creportal'); ?></label>
			<input id="<?php echo $this->get_field_id( 'user' ); ?>" name="<?php echo $this->get_field_name( 'user' ); ?>" value="<?php echo $instance['user']; ?>" class="widperc" />
		</p>

	<?php
	}
}
// End FaceBook register



// Begain Google+ register
add_action( 'widgets_init', 'Google' );

function Google() {
	register_widget( 'Google' );
}

class Google extends WP_Widget {

	function Google() {
		$widget_ops = array( 'classname' => 'google', 'description' => __('Google+ Follow Box Show', 'creportal') );
		
		$control_ops = array( 'id_base' => 'google-widget' );
		
		$this->WP_Widget( 'google-widget', __('Google+ Widget', 'creportal'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = $instance['title'];
		$user = $instance['user'];
		// Display the widget title
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
	?>
            <!-- Place this tag where you want the badge to render. -->
            <div class="g-plus" data-href="https://plus.google.com/<?php echo $user; ?>" data-rel="publisher"></div>
            <!-- Place this tag after the last badge tag. -->
            <?php
            function google_get() {
                echo "<script type=\"text/javascript\">
                  (function() {
                    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                    po.src = 'https://apis.google.com/js/plusone.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                  })();
                </script>";
            }
            add_action('wp_footer', 'google_get');
            ?>
    <?php
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['user'] = strip_tags( $new_instance['user'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Follow us on Google+', 'creportal'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'creportal'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widperc" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'user' ); ?>"><?php _e('Google+ Account:', 'creportal'); ?></label>
			<input id="<?php echo $this->get_field_id( 'user' ); ?>" name="<?php echo $this->get_field_name( 'user' ); ?>" value="<?php echo $instance['user']; ?>" class="widperc" />
		</p>

	<?php
	}
}
// End Google+ register


?>