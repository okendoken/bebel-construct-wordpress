<?php

class bebelThemeUtils
{

    public static function getPageFooterTemplate($mobile = false){ ?>
        <footer class="page-footer <?php echo $mobile ? 'visible-phone' : 'hidden-phone'; ?>">
            This site was handcrafted by Bebel
            <a href="#" class="to-top-link">top <i class="icon-caret-up"></i></a>
        </footer><!-- end footer -->
    <?php }

    public static function getLogoTemplate($bottom = false){
        $with_offset = is_singular() || is_home();?>
        <div class="logo <?php echo $bottom ? 'bottom' : ''; echo $with_offset ? ' offset' : ''; ?>">
            <div class="shadow"></div>
            <a class="logo-content" href="<?php echo home_url(); ?>">
                <span class="square"></span>
                <span class="name">Construct</span>
                <span class="slogan">We Build Things</span>
            </a>
        </div><!--end .logo-->
    <?php }
}