<?php
$settings = BebelSingleton::getInstance('BebelSettings');
query_posts(array(
    'post_type' => 'construct_member'
));
if(have_posts())
{
    $option = '<option value="0">'.__('Select Person to Contact', $settings->getPrefix()).'</option>';
    while(have_posts())
    {
        the_post();
        if(BebelUtils::getCustomMeta('member_show_email', false, get_the_ID()) && BebelUtils::getCustomMeta('member_email', false, get_the_ID()) != "")
        {
            $selected = '';
            if(isset($_GET['send_to']) && $_GET['send_to'] == get_the_ID())
            {
                $selected = ' selected="selected"';
            }

            $option .= '<option value="'.get_the_ID().'"'.$selected.'>'. get_the_title() .'</option>';
        }
    }
}

wp_reset_query();
wp_reset_postdata();

get_template_part( 'templates/_navigation-no-image', get_post_format() );  ?>
    <section id="page-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
        <h1 class="article-title">
            <?php the_title() ?>
        </h1>
        <?php the_content() ?>
        <form class="contact_form" action="">


            <?php if($option != ''): ?>
                <div class="input_left">
                    <select name="to_author" class="uniform_author to_author">
                        <?php echo $option ?>
                    </select>
                </div><br class="clear">
            <?php endif; ?>


            <div class="inputFrame input_left">
                <input type="text" class="contact_name" placeholder="<?php _e(sprintf('Name:'), $settings->getPrefix()) ?>" required="" value="" id="author" name="contact_name">
            </div>

            <div class="inputFrame input_right">
                <input type="email" class="contact_email" placeholder="<?php _e(sprintf('Email:'), $settings->getPrefix()) ?>" required="" value="" id="email" name="contact_email">
            </div>
            <br class="clear">
            <div class="inputFrameBigContact">
                <textarea placeholder="<?php _e(sprintf('Message:'), $settings->getPrefix()) ?>" required="" id="comment" class="contact_message" name="contact_message"></textarea>
            </div>

            <br class="clear">
            <p class="form-submit">
                <input name="submit" class="submit" type="submit" id="post-comment-form-submit" value="<?php _e(sprintf('Send'), $settings->getPrefix()) ?>">
            </p>
            <div id="add_response"></div>

        </form>
    </section>
<?php
bebelThemeUtils::getPageFooterTemplate();