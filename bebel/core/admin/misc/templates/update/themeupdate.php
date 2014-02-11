<div class="wrap">

  <h2><?php _e('New Theme Update for ', 'bebel'); echo $this->settings->getThemename() ?></h2>


  <p><?php _e(sprintf('There is a new version (<span style="color: green">%s</span>) of the theme available on themeforest. Please click <a href="'.$this->update_status->packageUrl.'" target="_blank">this link</a> to get the new version. You are currently running on version <span style="color: red">%s</span>', $this->update_status->currentVersion, $this->settings->getVersion()), $this->settings->getPrefix()) ?></p>
  <p><?php _e('Please update as soon as possible - it might fix some security issues! We provide a changelog for this version, <a href="update.thebebel.com/'.strtolower($this->settings->getThemename()).'-changelog-'.$this->update_status->currentVersion.'.txt" target="_blank">check it out here</a>', 'bebel') ?></p>

  <h2 style="font-size: 14px; padding: 0; margin: 0; line-height: 18px;">Cheers, <br />Bebel</h2>
</div>