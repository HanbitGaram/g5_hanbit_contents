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

$sub_menu = "412100";
include_once('./_common.php');
@header('Content-Type: application/json; charset=utf-8');

hanbitgaram_widget_ajax_auth_check($auth[$sub_menu], "d");

if(get_session('HANBITGARAM_WIDGET_CSRF')!==$_POST['csrf'] || !trim($_POST['csrf'])) exit("{\"error\":\"CSRF 토큰이 일치하지 않습니다.\"}");

$idx = (int)$_POST['idx'];
$fetch = sql_query("DELETE FROM `".G5_TABLE_PREFIX."hanbitgaram_widget` WHERE `fw_id`='{$idx}';");

if($fetch){
    $contents = array('status'=>true);
}else{
    exit("{\"error\":\"삭제 작업을 실패했습니다.\"}");
}

echo json_encode($contents);