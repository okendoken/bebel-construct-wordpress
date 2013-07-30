<div id="bebel_admin_panel_tabs-1" class="grid_24">

  <h3><?php _e('Default Sidebars for each Content Type', $this->settings->getPrefix()) ?></h3>

  <input type="submit" name="submit" class="button-primary" style="float: right; margin-bottom: 15px;" value="<?php _e('Save your changes!', $this->settings->getPrefix()) ?>" />
  <table class="sidebars_table">
    <thead>
      <tr>
        <th><?php _e('Content Type', $this->settings->getPrefix()) ?></th>
        <th><?php _e('Sidebar', $this->settings->getPrefix()) ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach($sidebars['defaults'] as $sidebar => $value):
      ?>
      <tr>
        <td><?php echo ucfirst($sidebar) ?></td>
        <td>
          <select name="defaults[<?php echo $sidebar ?>]">
            <?php echo BebelUtils::createListByOptions($value, $bSidebarsAdmin->getSimpleArray($sidebars)); ?>
          </select>
        </td>
      </tr>
      <?php
      endforeach;
      ?>
    </tbody>
  </table>


</div>