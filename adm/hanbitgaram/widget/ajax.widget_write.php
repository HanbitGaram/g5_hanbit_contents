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

hanbitgaram_widget_ajax_auth_check($auth[$sub_menu], "w");

if(get_session('HANBITGARAM_WIDGET_CSRF')!==$_POST['csrf'] || !trim($_POST['csrf'])) exit("{\"error\":\"CSRF 토큰이 일치하지 않습니다.\"}");

$idx = (int)$_POST['idx'];

$contents = array('status'=>true);

if($_POST['mode']==='w'){
    $sql = "
    INSERT 
        INTO 
            `".G5_TABLE_PREFIX."hanbitgaram_widget`
            (`fw_id`, `fw_subject`, `fw_contents`, `fw_type`, `fw_datetime`)
            VALUES
            (NULL, '".sql_escape_string($_POST['name'])."', '', '".sql_escape_string($_POST['type'])."', '".G5_TIME_YMDHIS."');
    ";

    //echo $sql;

    $result = sql_query($sql);
    if($result){
        echo json_encode($contents);
    }else{
        exit("{\"error\":\"SQL에 정보 업로드 실패했습니다.\"}");
    }
}else if($_POST['mode']==='m'){
    $sql = "
    UPDATE 
        `".G5_TABLE_PREFIX."hanbitgaram_widget`
    SET
        `fw_subject` = '".sql_escape_string($_POST['name'])."',
        `fw_type` = '".sql_escape_string($_POST['type'])."'
    WHERE 
    `fw_id` = {$idx};
    ";

    $result = sql_query($sql);
    if($result){
        echo json_encode($contents);
    }else{
        exit("{\"error\":\"정보 수정 실패했습니다.\"}");
    }
}