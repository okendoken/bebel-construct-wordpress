<nav class="navigation navigation-top">
    <div class="navbar">
        <a id="menu-toggle" class="pull-right navbar-toggle" href="#" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="text">Menu</span> <i class="icon-reorder icon-large"></i>
        </a>

        <div class="collapse navbar-collapse">
            <?php wp_nav_menu(array(
                'menu_class' => 'nav navbar-nav',
                'menu' => 'header-menu',
                'fallback_cb' => array('bebelThemeUtils', 'bebel_page_menu'),
                'container' => '',
                'walker' => new ConstructMenuWalker())) ?>
        </div>
    </div>
</nav>