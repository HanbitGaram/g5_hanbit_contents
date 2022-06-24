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

hanbitgaram_widget_ajax_auth_check($auth[$sub_menu], "r");

$idx = (int)$_POST['idx'];
$fetch = sql_fetch("SELECT * FROM `".G5_TABLE_PREFIX."hanbitgaram_widget` WHERE `fw_id`='{$idx}';");

if($fetch){
    $contents = array(
        'status'=>true,
        'contents'=>array(
            'name'=>$fetch['fw_subject'],
            'type'=>$fetch['fw_type']
        )
    );
}else{
    exit("{\"error\":\"정보 가져오기 실패했습니다.\"}");
}

echo json_encode($contents);