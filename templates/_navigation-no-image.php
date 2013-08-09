<nav class="navigation navigation-top">
    <div class="navbar">
        <div class="navbar-inner">
            <a id="menu-toggle" class="pull-right btn-navbar" href="#" data-toggle="collapse" data-target=".nav-collapse">
                <span class="text">Menu</span> <i class="icon-reorder icon-large"></i>
            </a>

            <?php wp_nav_menu(array(
                'menu_class' => 'nav nav-collapse collapse',
                'menu' => 'header-menu',
                'fallback_cb' => array('bebelThemeUtils', 'bebel_page_menu'),
                'container' => '',
                'walker' => new ConstructMenuWalker())) ?>
        </div>
    </div>
</nav>