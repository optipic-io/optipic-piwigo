<?php
defined('OPTIPIC_PATH') or die('Hacking attempt!');

/**
 * admin plugins menu link
 */
function optipic_admin_plugin_menu_links($menu)
{
  $menu[] = array(
    'NAME' => l10n('Skeleton'),
    'URL' => OPTIPIC_ADMIN,
    );

  return $menu;
}