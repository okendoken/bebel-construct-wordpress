<?php
$settings = BebelSingleton::getInstance('BebelSettings');

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
        <form id="contact-form" action="<?php echo site_url()."/wp-admin/admin-ajax.php"; ?>" class="contact-form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="<?php _e(sprintf('Name'), $settings->getPrefix()) ?>" required="required">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="<?php _e(sprintf('Email'), $settings->getPrefix()) ?>" required="required">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="<?php _e(sprintf('Subject'), $settings->getPrefix()) ?>" required="required">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea id="message" class="form-control contact-form-message" name="message" placeholder="<?php _e(sprintf('Message'), $settings->getPrefix()) ?>" required="required"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="clearfix">
                    <button type="submit" class="contact-form-submit btn btn-danger btn-lg pull-right">
                        <?php _e(sprintf('Send'), $settings->getPrefix()) ?> <i class="icon-angle-right icon-large"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-6 col-md-offset-6 contact-messages" id="messages" >
            </div>
        </div>
    </section>
<?php
bebelThemeUtils::getPageFooterTemplate();