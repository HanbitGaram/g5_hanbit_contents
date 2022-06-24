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

$sql = sql_query("SELECT * FROM `".G5_TABLE_PREFIX."hanbitgaram_widget` ORDER BY `fw_datetime` DESC");

$contents = array('status'=>true);
$tmp_data = '';
for($i=0; $row=sql_fetch_array($sql); $i++){
$title = htmlspecialchars($row['fw_subject']);
$link = HANBITGARAM_WIDGET_URL;
$tmp_data .= <<<TMP
<tr>
<td>{$row['fw_id']}</td>
<td><a href="" onclick="window.open('{$link}/modify.php?idx={$row['fw_id']}', 'widget_modify', 'width=800,height=700'); return false;">{$title}</a></td>
<td>
<a href="#" class="btn btn_03 act_modify" data-idx="{$row['fw_id']}">수정</a>
<a href="#" class="btn btn_01 act_delete" data-idx="{$row['fw_id']}">삭제</a>
<a href="#" class="btn btn_02 act_make_code" data-idx="{$row['fw_id']}">위젯코드생성</a>
</td>
</tr>
TMP;
}
$contents['contents'] = $tmp_data;
echo json_encode($contents);