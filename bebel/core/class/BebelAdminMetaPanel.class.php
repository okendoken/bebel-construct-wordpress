<?php


class BebelAdminMetaPanel extends BebelAdmingeneratorBase
{

  public function createMenu() {}

  public function createBody()
  {
    include_once(get_template_directory().BebelUtils::getAdminpath().'/meta_panel/templates/body.php');
    return $this;
  }

  public function getSpecialfields() {}

  public function getOption($key) {}
}