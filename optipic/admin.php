<?php
/**
 * This is the main administration page, if you have only one admin page you can put
 * directly its code here or using the tabsheet system like bellow
 */

defined('OPTIPIC_PATH') or die('Hacking attempt!');

global $template, $page, $conf;


// get current tab
$page['tab'] = isset($_GET['tab']) ? $_GET['tab'] : $page['tab'] = 'config';

// plugin tabsheet is not present on photo page
if ($page['tab'] != 'photo')
{
  // tabsheet
  include_once(PHPWG_ROOT_PATH.'admin/include/tabsheet.class.php');
  $tabsheet = new tabsheet();
  $tabsheet->set_id('optipic');

  //$tabsheet->add('home', l10n('Welcome'), OPTIPIC_ADMIN . '-home');
  $tabsheet->add('config', l10n('Configuration'), OPTIPIC_ADMIN . '-config');
  $tabsheet->select($page['tab']);
  $tabsheet->assign();
}

// include page
include(OPTIPIC_PATH . 'admin/' . $page['tab'] . '.php');

// template vars
$template->assign(array(
  'OPTIPIC_PATH'=> OPTIPIC_PATH, // used for images, scripts, ... access
  'OPTIPIC_ABS_PATH'=> realpath(OPTIPIC_PATH), // used for template inclusion (Smarty needs a real path)
  'OPTIPIC_ADMIN' => OPTIPIC_ADMIN,
  ));

// send page content
$template->assign_var_from_handle('ADMIN_CONTENT', 'optipic_content');
