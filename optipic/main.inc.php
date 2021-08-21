<?php
/*
Plugin Name: OptiPic
Version: 1.21.0
Description: OptiPic images optimization and WebP convertion
Plugin URI: https://optipic.io/cdn/
Author: OptiPic.io
Author URI: https://optipic.io/cdn/
*/

/**
 * This is the main file of the plugin, called by Piwigo in "include/common.inc.php" line 137.
 * At this point of the code, Piwigo is not completely initialized, so nothing should be done directly
 * except define constants and event handlers (see http://piwigo.org/doc/doku.php?id=dev:plugins)
 */

defined('PHPWG_ROOT_PATH') or die('Hacking attempt!');


if (basename(dirname(__FILE__)) != 'optipic')
{
  add_event_handler('init', 'optipic_error');
  function optipic_error()
  {
    global $page;
    $page['errors'][] = 'OptiPic folder name is incorrect, uninstall the plugin and rename it to "optipic"';
  }
  return;
}


// +-----------------------------------------------------------------------+
// | Define plugin constants                                               |
// +-----------------------------------------------------------------------+
global $prefixeTable;

define('OPTIPIC_ID',      basename(dirname(__FILE__)));
define('OPTIPIC_PATH' ,   PHPWG_PLUGINS_PATH . OPTIPIC_ID . '/');
define('OPTIPIC_TABLE',   $prefixeTable . 'optipic');
define('OPTIPIC_ADMIN',   get_root_url() . 'admin.php?page=plugin-' . OPTIPIC_ID);
define('OPTIPIC_PUBLIC',  get_absolute_root_url() . make_index_url(array('section' => 'optipic')) . '/');
define('OPTIPIC_DIR',     PHPWG_ROOT_PATH . PWG_LOCAL_DIR . 'optipic/');



// +-----------------------------------------------------------------------+
// | Add event handlers                                                    |
// +-----------------------------------------------------------------------+
// init the plugin
add_event_handler('init', 'optipic_init');

/*
 * this is the common way to define event functions: create a new function for each event you want to handle
 */
if (defined('IN_ADMIN'))
{
  // file containing all admin handlers functions
  $admin_file = OPTIPIC_PATH . 'include/admin_events.inc.php';

  // admin plugins menu link
  add_event_handler('get_admin_plugin_menu_links', 'optipic_admin_plugin_menu_links',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $admin_file);


  // new prefiler in Batch Manager
  /*add_event_handler('get_batch_manager_prefilters', 'optipic_add_batch_manager_prefilters',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $admin_file);
  add_event_handler('perform_batch_manager_prefilters', 'optipic_perform_batch_manager_prefilters',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $admin_file);*/

  // new action in Batch Manager
  /*add_event_handler('loc_end_element_set_global', 'optipic_loc_end_element_set_global',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $admin_file);
  add_event_handler('element_set_global_action', 'optipic_element_set_global_action',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $admin_file);*/
}
else
{
  // file containing all public handlers functions
  $public_file = OPTIPIC_PATH . 'include/public_events.inc.php';

    add_event_handler('loc_begin_index', 'optipic_loc_begin_index', EVENT_HANDLER_PRIORITY_NEUTRAL, $public_file);
}




/**
 * plugin initialization
 *   - check for upgrades
 *   - unserialize configuration
 *   - load language
 */
function optipic_init()
{
  global $conf;

  // load plugin language file
  load_language('plugin.lang', OPTIPIC_PATH);

  // prepare plugin configuration
  $conf['optipic'] = safe_unserialize($conf['optipic']);
}