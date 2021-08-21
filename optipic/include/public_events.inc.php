<?php
defined('OPTIPIC_PATH') or die('Hacking attempt!');

function optipic_loc_begin_index() {
    //var_dump("zzzzzzzzzzzzzzz");
    //die("zzzz");
    //file_put_contents(__DIR__ . 'log.txt', date("H:i:s"));
    
    include_once OPTIPIC_PATH.'/lib/ImgUrlConverter.php';
    
    $settings = conf_get_param('optipic');
    //var_dump($settings);
    if(!empty($settings['autoreplace_active'])) {
        \optipic\cdn\ImgUrlConverter::loadConfig($settings);
        ob_start(array('\optipic\cdn\ImgUrlConverter', 'convertHtml'));
    }
}