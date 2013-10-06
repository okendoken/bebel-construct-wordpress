<?php
class Bebel_Walker_Comment extends Walker_Comment{
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        echo '<ul class="media-list">';
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        echo '</ul>';
    }

    function start_el( &$output, $comment, $depth, $args, $id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;

        $email = $comment->comment_author_email;
        $user_id = -1;
        if ( email_exists($email) )
            $user_id = email_exists($email);
        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class('media'); ?> id="comment-<?php comment_ID(); ?>">
            <span class="pull-left">
                            <?php echo get_avatar($comment,$size='64' ); ?>
                        </span>
            <div class="media-body">
                <span class="pull-right">
                                    <?php echo comment_reply_link(array_merge( array('reply_text' => 'reply') , array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                                </span>
                <h5 class="media-heading comment-title">
                    <?php comment_author(); ?>
                    <time class="text-muted" datetime="">
                        <?php echo get_comment_date("M d \\a\\t G:i"); ?>
                    </time>
                </h5>
                <?php comment_text() ?>
    <?php
    }

    function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
            </div>
        </li>
    <?php
    }
}
?>

<div class="comments">
    <?php $settings = BebelSingleton::getInstance('BebelSettings');?>

    <?php if ( post_password_required() ) : ?>
        <p><?php _e( 'This post is password protected. Enter the password to view any comments.', $settings->getPrefix() ); ?></p>
        <?php
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
        <?php endif; // check for comment navigation ?>

    <?php else : // or, if we don't have comments:

        /* If there are no comments and comments are closed,
         * let's leave a little note, shall we?
         */
        if ( ! comments_open() ) :
            ?>
            <p><?php _e( 'Comments are closed.', $settings->getPrefix() ); ?></p>
        <?php endif; // end ! comments_open() ?>

    <?php endif; // end have_comments() ?>



    <?php
    if(!isset($fields))
        $fields =  array(
            'author' => '<p class="comment-form-author">' .
            '<input id="author" name="author" type="text" placeholder="' . __( 'Name', 'domainreference' ) . ( $req ? '*' : '') . '" size="30" /></p>',
            'email'  => '<p class="comment-form-email">' .
            '<input id="email" name="email" type="text" placeholder="' . __( 'Email', 'domainreference' ) . ( $req ? '*' : '') . '" size="30" /></p>'
        );
    $defaults = array(
        'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_field'        => '<p class="comment-form-comment"><div class="wrap-area"><textarea class="required" name="comment" title="message" cols="45" rows="8" aria-required="true"></textarea></div></p>',
        'must_log_in'          => '<p class="must-log-in">You must be logged in to leave a reply.</p>',
        'title_reply' => 'Leave a comment',
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
    );


    comment_form( $defaults );

    ?>

</div>