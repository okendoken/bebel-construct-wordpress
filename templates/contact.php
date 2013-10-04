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
                    <?php if ($settings->get('contact_business_name') !== '' or $settings->get('contact_address') !== ''){ ?>
                        <td>
                            <div class="address-info-entry">
                                <p class="icon">
                                    <i class="icon-map-marker"></i>
                                </p>
                                <div class="entry-content">
                                    <p class="text"><?php echo $settings->get('contact_business_name')?></p>
                                    <p class="text"><?php echo $settings->get('contact_address')?></p>
                                </div>
                            </div>
                        </td>
                    <?php }
                    if ($settings->get("contact_email") !== ''){
                        ?>
                        <td>
                            <div class="address-info-entry">
                                <p class="icon">
                                    <i class="icon-envelope"></i>
                                </p>
                                <div class="entry-content">
                                    <p class="text">
                                        <a href="mailto:<?php echo $settings->get('contact_email')?>">
                                            <?php echo $settings->get('contact_email')?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </td>
                    <?php }
                    if ($settings->get("contact_phone") !== '') { ?>
                        <td>
                            <div class="address-info-entry">
                                <p class="icon">
                                    <i class="icon-phone"></i>
                                </p>
                                <div class="entry-content">
                                    <p class="text"><?php echo $settings->get("contact_phone") ?></p>
                                </div>
                            </div>
                        </td>
                    <?php } ?>
                </tr>
            </table>
        </div>
        <?php if ($settings->get("contact_display_google_maps") == 'on' and $settings->get('contact_address') !== ''): ?>
            <script type="text/javascript">
                window.contactFormAddress = '<?php echo $settings->get('contact_address')?>';
            </script>
            <div class="contact-map" id="contact-map"></div>
        <?php endif ?>
    </section>
<?php
bebelThemeUtils::getPageFooterTemplate();