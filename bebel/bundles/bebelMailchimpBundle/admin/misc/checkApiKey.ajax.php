<?php

define('WP_USE_THEMES', false);
include_once '../../../../../../../../wp-load.php';
include_once get_template_directory().'/functions.php';


$api = new BebelMailchimp($_POST['key']);
echo  $api->check();
