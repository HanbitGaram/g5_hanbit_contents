<?php
/***********************************
 *
 *  HANBITGARAM Widget
 *  2020. 06. 23. HanbitGaram(https://hanb.jp/ | https://github.com/hanbitgaram)
 *
 *  CHANGE LOG
 *  2020. 06. 23. First production
 *  2022. 06. 24. Declaration of free source code(ソースコード無料化宣言)
 * 
 ***********************************/

/**
 * Required file include
 */
include_once('../../../common.php');
define('HANBITGARAM_WIDGET_INSTALL', !!sql_query("SELECT * FROM `".G5_TABLE_PREFIX."hanbitgaram_widget` LIMIT 1"));

/**
 * Permission check (not accessible unless you are a site administrator)
 *
 * Modifying this area is a security risk.
 * 이 영역을 수정하면 보안상 위험할 수 있습니다.
 */
if($is_admin !== 'super') hanbitgaram_widget_error('Error','Only site administrators can access it.');

if(
    !HANBITGARAM_WIDGET_INSTALL
    && !defined('_INSTALL_')
){
    goto_url('./install.php');
}