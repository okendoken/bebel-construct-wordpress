<?php
class Bebel_Walker_Comment extends Walker_Comment{
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        echo '<ul class="media-list">';
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        echo '</ul>';
    }

    function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 )  {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;

        $email = $comment->comment_author_email;
        $user_id = -1;
        if ( email_exists($email) )
            $user_id = email_exists($email);
        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class('media discussion-item'); ?> id="comment-<?php comment_ID(); ?>">
            <span class="pull-left">
                            <?php echo get_avatar($comment,$size='64' ); ?>
                        </span>
            <div class="media-body">
                <div class="comment-inner">
                    <span class="pull-right">
                        <?php echo comment_reply_link(array_merge( array('reply_text' => 'reply') , array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    </span>
                    <h5 class="media-heading comment-title">
                        <?php comment_author_link(); ?>
                        <time class="text-muted" datetime="">
                            <?php echo get_comment_date("M d \\a\\t G:i"); ?>
                        </time>
                    </h5>
                    <?php if($comment->comment_approved == 0): ?>
                            <em><?php _e('Your comment is awaiting approval.', BebelSingleton::getInstance('BebelSettings')->getPrefix()) ?></em>
                    <?php else: ?>
                            <?php comment_text() ?>
                    <?php endif; ?>
                </div>
    <?php
    }

    function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
            </div>
        </li>
    <?php
    }
}
?>

<div id="comments" class="comments">
    <?php $settings = BebelSingleton::getInstance('BebelSettings');?>

    <?php if ( post_password_required() ) : ?>
        <p><?php _e( 'This post is password protected. Enter the password to view any comments.', $settings->getPrefix() ); ?></p>
        <?php
        echo '</div>';
        return;
    endif;
    ?>

    <?php if ( have_comments() ) : ?>
        <h5 class="comments-title">
            <?php echo __('Comments', $settings->getPrefix()); ?>
        </h5>
        <ul class="media-list">
            <?php
            wp_list_comments(array(
                'walker' => new Bebel_Walker_Comment()
            ));
            ?>
        </ul>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <?php previous_comments_link( __( '&larr; Older Comments', $settings->getPrefix() ) ); ?>
            <?php next_comments_link( __( 'Newer Comments &rarr;', $settings->getPrefix() ) ); ?>
        <?php endif;  ?>

    <?php else :
        if ( ! comments_open() ) :
            ?>
            <p><?php _e( 'Comments are closed.', $settings->getPrefix() ); ?></p>
        <?php endif; ?>

    <?php endif;  ?>



    <?php
    if(!isset($fields))
        $fields =  array(
            'author' => '<div class="form-group"> <div class="col-md-6">' .
            '<input id="author" name="author" type="text" class="form-control" placeholder="' . __( 'Name:', $settings->getPrefix() )  . '"/></div></div>',
            'email'  => '<div class="form-group"> <div class="col-md-6">' .
            '<input id="email" name="email" type="text" class="form-control" placeholder="' . __( 'Email:', $settings->getPrefix() ) . '"/></div></div>'
        );
    $defaults = array(
        'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_field'        => '<div class="form-group"> <div class="col-md-12"><textarea class="form-control" name="comment" title="message" aria-required="true" rows="8" placeholder="'.__( 'Message:', $settings->getPrefix() ).'"></textarea></div></div>',
        'must_log_in'          => '<p class="must-log-in">You must be logged in to leave a reply.</p>',
        'title_reply' => 'Leave a comment',
        'comment_notes_before'  => '<p><small>Your email address will not be published.</small></p>',
        'comment_notes_after'  => '<div class="form-group form-actions no-margin"><div class="col-md-12"><button type="submit"
         id="comment-submit" class="btn btn-danger pull-right">'.__( 'Submit', $settings->getPrefix() ).' <i class="icon-angle-right icon-large"></i></button></div></div>'
    );
    ?>
    <?php comment_form( $defaults );?>

</div>