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

if (!defined('_GNUBOARD_')) exit; // Single page access restrictions

/**
 * Directory constant declaration (디렉토리 상수 선언)
 *
 * PHP <= 5.2 cannot use __DIR__.
 * PHP 5.2 이하는 __DIR__ (을)를 사용할 수 없습니다.
 */
//define('HANBITGARAM_WIDGET_DIRECTORY', dirname(__FILE__));
define('HANBITGARAM_WIDGET_DIRECTORY', G5_PLUGIN_PATH.'/hanbitgaram/widget');
define('HANBITGARAM_WIDGET_URL', G5_PLUGIN_URL.'/hanbitgaram/widget');
define('HANBITGARAM_WIDGET_CACHE_PATH', G5_DATA_PATH.'/hanbitgaram/widget');

/**
 * Widget library file include
 */
include_once(HANBITGARAM_WIDGET_DIRECTORY.'/hanbitgaram.widget.lib.php');