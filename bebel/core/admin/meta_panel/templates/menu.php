<div class="bebel_admin_meta_panel_tabs_nav_container">
  <img src="<?php echo get_stylesheet_directory_uri() ?>/bebelCp2/core/assets/images/bebelui/meta_panel_left.png" style="float: left;" />
  <ul class="bebel_admin_meta_panel_tabs_nav">
    <?php echo $tabs; ?>
  </ul>
  <img src="<?php echo get_stylesheet_directory_uri() ?>/bebelCp2/core/assets/images/bebelui/meta_panel_right.png" style="position: absolute; right: 0px; top:0px;" />
</div>
<br class="clear" />
<script tyle="text/javascript">
  <!--
    jQuery(document).ready(function() {
      jQuery('#bebel_admin_meta_panel_tabs').btabs({"debug": true, "effect": "fade", "count": <?php echo $this->getMenuCount() ?>,"linkActiveStateClass": "nav-tab-active", "tabNavigationClass" : "bebel_admin_meta_panel_tabs_nav"});

    });
  -->
</script>
