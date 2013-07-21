<link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/css/comments.css' type='text/css' media='all' />
<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__( 'Please do not load this page directly. Thanks!', 'CircleLaw' ));

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.', 'CircleLaw' ) ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	
    <h2><?php comments_number( __( 'no comments', 'CircleLaw' ), __( '1 comment', 'CircleLaw' ), __( '% comments', 'CircleLaw' ) );?></h2>
	

        <div class="navigation displaynone">
            <div class="alignleft"><?php previous_comments_link() ?></div>
            <div class="alignright"><?php next_comments_link() ?></div>
        </div>
    
        <ol class="commentlist">
        <?php wp_list_comments(); ?>
        </ol>
    	<div class="clear"></div>
        <div class="navigation displaynone">
            <div class="alignleft"><?php previous_comments_link() ?></div>
            <div class="alignright"><?php next_comments_link() ?></div>
        </div>
    	<div class="clear"></div>
    
        <?php else : // this is displayed if there are no comments so far ?>
    
        <?php if ('open' == $post->comment_status) : ?>
            <!-- If comments are open, but there are no comments. -->
    
         <?php else : // comments are closed ?>
            <!-- If comments are closed.
            <p class="nocomments"><?php //_e( 'Comments closed.', 'CircleLaw' ) ?></p>-->
    
    	<div class="clear"></div>
        <?php endif; ?>
    
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>


    <h2 class="leave"><?php comment_form_title( __( 'Leave a Reply', 'CircleLaw' ), __( 'Leave a Reply on %s', 'CircleLaw' ) ); ?></h2>
    
    	<div class="clear"></div>
<div id="respond">

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e( 'please', 'CircleLaw' ) ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e( 'logged in first', 'CircleLaw' ) ?></a> <?php _e( 'to can add comment.', 'CircleLaw' ) ?></p>
<?php else : ?>

<div class="posrela">
<?php
$comments_args = array(
        // redefine your own textarea (the comment body)
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _e( 'Comment', 'CircleLaw' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true" rows="8"></textarea></p>',
);

comment_form($comments_args);
?>
<div class="clear"></div>
</div>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>

<div class="clear"></div>