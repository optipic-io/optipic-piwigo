<?php
defined('OPTIPIC_PATH') or die('Hacking attempt!');

// +-----------------------------------------------------------------------+
// | Configuration tab                                                     |
// +-----------------------------------------------------------------------+

// save config
if (isset($_POST['save_config']))
{
  $conf['optipic'] = array(
    'autoreplace_active' => isset($_POST['autoreplace_active']),
    'site_id' => intval($_POST['site_id']),
    'domains' => $_POST['domains'],
    'exclusions_url' => $_POST['exclusions_url'],
    'whitelist_img_urls' => $_POST['whitelist_img_urls'],
    'srcset_attrs' => $_POST['srcset_attrs'],
    'cdn_domain' => $_POST['cdn_domain'],
  );

  conf_update_param('optipic', $conf['optipic']);
  $page['infos'][] = l10n('Information data registered in database');
}

$select_options = array(
  'one' => l10n('One'),
  'two' => l10n('Two'),
  'three' => l10n('Three'),
  );

// send config to template
$template->assign(array(
  'optipic' => $conf['optipic'],
  'select_options' => $select_options,
  'domain' => parse_url(get_absolute_root_url(), PHP_URL_HOST)
  ));

// define template file
$template->set_filename('optipic_content', realpath(OPTIPIC_PATH . 'admin/template/config.tpl'));
