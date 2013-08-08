<?php

class bebelThemeUtils
{

    public static function getPageFooterTemplate($mobile = false){ ?>
        <footer class="page-footer <?php echo $mobile ? 'visible-phone' : 'hidden-phone'; ?>">
            This site was handcrafted by Bebel
            <a href="#" class="to-top-link">top <i class="icon-caret-up"></i></a>
        </footer><!-- end footer -->
    <?php }

    public static function getLogoTemplate($bottom = false, $with_offset = true){?>
        <div class="logo <?php echo $bottom ? 'bottom' : ''; echo $with_offset ? ' offset' : ''; ?>">
            <div class="shadow"></div>
            <a class="logo-content" href="<?php echo home_url(); ?>">
                <?php if($logo = BebelSingleton::getInstance('BebelSettings')->get('logo_header')): ?>
                    <img src="<?php echo $logo ?>" alt="Logo" />
                <?php else: ?>
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/images/example/logo.png" alt="Logo" />
                <?php endif ?>
        </div><!--end .logo-->
    <?php }

    public static function activeNavClass($classes){
        if( in_array('current-menu-item', $classes) ){
            $classes[] = 'active ';
        }
        return $classes;
    }
}