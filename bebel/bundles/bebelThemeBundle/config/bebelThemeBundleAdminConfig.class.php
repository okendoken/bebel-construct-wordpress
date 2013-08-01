<?php


class bebelThemeBundleAdminConfig extends BebelAdminConfig
{
  public function getBebelHelp() {

    include_once(get_template_directory().BebelUtils::getBundlePath().'/'.$this->bundleDir.'/help/index.php');

  }
}