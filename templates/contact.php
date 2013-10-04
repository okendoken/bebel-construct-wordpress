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
        <h4 class="page-title">
            <?php the_title() ?>
        </h4>
        <div class="address-info">
            <table>
                <tr>
                    <td>
                        <div class="address-info-entry">
                            <p class="icon">
                                <i class="icon-map-marker"></i>
                            </p>
                            <div class="entry-content">
                                <p class="text">Business Headquarter</p>
                                <p class="text">128 Susanne Street 10927 Melbourne, Australia</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="address-info-entry">
                            <p class="icon">
                                <i class="icon-envelope"></i>
                            </p>
                            <div class="entry-content">
                                <p class="text"><a href="mailto:info@envato.com">info@envato.com</a></p>
                                <p class="text"><a href="mailto:info@envato.com">info@envato.com</a></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="address-info-entry">
                            <p class="icon">
                                <i class="icon-phone"></i>
                            </p>
                            <div class="entry-content">
                                <p class="text">+49 30 4765 2945</p>
                                <p class="text">+49 465 284 59</p>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </section>
<?php
bebelThemeUtils::getPageFooterTemplate();