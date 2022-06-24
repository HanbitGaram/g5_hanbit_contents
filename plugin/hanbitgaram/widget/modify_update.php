<?php
/***********************************
 *
 *  HANBITGARAM Widget
 *  2020. 06. 23. HanbitGaram(https://hanb.jp/ | https://github.com/hanbitgaram)
 *
 *  CHANGE LOG
 *  2020. 06. 23. First production
 *
 ***********************************/

/**
 * Required file include
 */
include_once('./_common.php');

if(get_session('HANBITGARAM_WIDGET_CSRF_INNER')!==$_POST['csrf'] || !trim($_POST['csrf'])){
    hanbitgaram_widget_error('토쿤 불일치', 'CSRF 토큰이 일치하지 않습니다.');
}

set_session('HANBITGARAM_WIDGET_CSRF_INNER', sha1(time().microtime().'_HANBITGARAM_'.mt_rand(10000,9999999)) );

$idx = (int)$_POST['idx'];
if(!$idx) hanbitgaram_widget_error('값이 빠졌습니다', '필수 값이 빠졌습니다.');

$contents = substr(trim($_POST['fw_contents']),0,100000);
$contents = preg_replace("#[\\\]+$#", "", $contents);
$sql = "
        UPDATE `".G5_TABLE_PREFIX."hanbitgaram_widget` SET
        `fw_contents` = '{$contents}'
        WHERE `fw_id`='{$idx}';
";

$execute = sql_query($sql);

if($execute){
    @unlink(HANBITGARAM_WIDGET_CACHE_PATH.'/'.$idx.'.json');
    hanbitgaram_widget_error('정상적으로 수정되었습니다.', '<script>opener.location.reload();</script><div class="txt_center">정상적으로 수정되었습니다.<br><a href="./modify.php?idx='.$idx.'" class="btn_submit">이전화면으로 이동</a></div>');
}else{
    hanbitgaram_widget_error('위젯 수정을 실패하였습니다.', '<div class="txt_center">위젯 수정을 실패하였습니다.<br><a href="./modify.php?idx='.$idx.'" class="btn_submit">이전화면으로 이동</a></div>');
}