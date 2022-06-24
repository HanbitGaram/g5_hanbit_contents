<?php
/***********************************
 *
 *  HANBITGARAM Widget
 *  2020. 06. 23. HANBITGARAM(HanbitGaram)
 *
 *  CHANGE LOG
 *  2020. 06. 23. First production
 *  2022. 06. 24. Declaration of free source code(ソースコード無料化宣言)
 *
 ***********************************/

define('G5_IS_ADMIN', true);
include_once ('../../../common.php');
include_once(G5_ADMIN_PATH.'/admin.lib.php');
define('HANBITGARAM_WIDGET_INSTALL', !!sql_query("SELECT * FROM `".G5_TABLE_PREFIX."hanbitgaram_widget` LIMIT 1"));

if( isset($token) ){
    $token = @htmlspecialchars(strip_tags($token), ENT_QUOTES);
}

/**
 * If the widget is not installed
 */
if(!HANBITGARAM_WIDGET_INSTALL && !defined('NO_REDIRECT')) goto_url(HANBITGARAM_WIDGET_URL.'/install.php');

run_event('admin_common');