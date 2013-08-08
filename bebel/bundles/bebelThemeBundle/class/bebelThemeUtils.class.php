<?php

class bebelThemeUtils
{

    public static function getPageFooterTemplate($mobile = false){ ?>
        <footer class="page-footer <?php echo $mobile ? 'visible-phone' : 'hidden-phone'; ?>">
            <?php echo BebelSingleton::getInstance('BebelSettings')->get("footer_text"); ?>
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

    public static function bebel_page_menu( $args = array() ) {
        $defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
        $args = wp_parse_args( $args, $defaults );
        $args = apply_filters( 'wp_page_menu_args', $args );

        $menu = '';

        $list_args = $args;

        // Show Home in the menu
        if ( ! empty($args['show_home']) ) {
            if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
                $text = __('Home');
            else
                $text = $args['show_home'];
            $class = '';
            if ( is_front_page() && !is_paged() )
                $class = 'class="current_page_item"';
            $menu .= '<li ' . $class . '><a href="' . home_url( '/' ) . '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
            // If the front page is a page, add it to the exclude list
            if (get_option('show_on_front') == 'page') {
                if ( !empty( $list_args['exclude'] ) ) {
                    $list_args['exclude'] .= ',';
                } else {
                    $list_args['exclude'] = '';
                }
                $list_args['exclude'] .= get_option('page_on_front');
            }
        }

        $list_args['echo'] = false;
        $list_args['title_li'] = '';
        $menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );


        $menu = '<ul class="' . esc_attr($args['menu_class']) . '">' . $menu . "</ul>\n";
        $menu = apply_filters( 'wp_page_menu', $menu, $args );
        if ( $args['echo'] )
            echo $menu;
        else
            return $menu;
    }
}