<div class="wrap">
  <h2><?php _e('Theme Administration Panel', 'bebel') ?></h2>
  <form action="<?php echo $_SERVER['REQUEST_URI'] ?>&save=true" method="post">
    <?php
      $this->admin_panel->loadModules()->createBody();
    ?>
  </form>
</div>