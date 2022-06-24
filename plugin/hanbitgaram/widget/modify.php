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
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

$csrf = sha1(mt_rand(10000,99999).G5_TIME_YMDHIS.'_HANBITGARAM_WIDGET_INNER_'.mt_rand(10000,99999));
set_session('HANBITGARAM_WIDGET_CSRF_INNER', $csrf);

$options = hanbitgaram_widget_options_load();

$idx = (int)$_GET['idx'];
$data = sql_fetch("SELECT * FROM `".G5_TABLE_PREFIX."hanbitgaram_widget` WHERE `fw_id`='{$idx}';");

if(!$data['fw_id']) hanbitgaram_widget_error('위젯이 없습니다.','관리자 페이지에 등록되지 않은 위젯입니다. 등록해주세요.');
$type = $options[$data['fw_type']]['type'];

$contents = '';
if($data['fw_type']==='editor'){
    add_javascript('<script>hanbitgaram_widget_type = "editor";</script>');

    $data['fw_contents_tmp'] = get_text($data['fw_contents'], 0);
    $editor_html = editor_html('fw_contents', $data['fw_contents_tmp'], 1);
    $editor_js = '';
    $editor_js .= get_editor_js('fw_contents', 1);
    $editor_js .= chk_editor_js('fw_contents', 1);
}else{
    add_javascript('<script>hanbitgaram_widget_type = "'.$type.'";</script>');
    $contents = get_text($data['fw_contents']);
}

/**
 * Title setting and including of required files
 */
$g5['title'] = '위젯 수정';
include_once(HANBITGARAM_WIDGET_DIRECTORY.'/head.php');
?>

<form action="<?php echo HANBITGARAM_WIDGET_URL; ?>/modify_update.php" method="post" autocomplete="off" onsubmit="return frm_submit();">
<input type="hidden" name="idx" value="<?php echo $idx; ?>">
<input type="hidden" name="csrf" value="<?php echo $csrf; ?>">
<?php
if($type==='editor'){
echo $editor_html;
}else if($type==='textarea'){
    echo '<textarea id="fw_contents" name="fw_contents" class="fw_contents_textarea">'.$contents.'</textarea>';
}else{
    echo '<h3 id="hanbitgaram_widget_input_title">수정할 값을 입력해주세요.</h3>';
    echo '<input type="'.$type.'" id="fw_contents" class="fw_type_'.$type.' fw_contents_inputs" name="fw_contents" value="'.$contents.'">';
}
?>
<br>
<input type="submit" value="위젯 수정하기" class="btn_submit frm_input_full">
</form>
<script>

    $('.fw_type_tel').on('keyup keydown keypress', function(e){
        var this_val = $(this).val();
        var regex = /[^0-9]/;

        if(regex.test(this_val)){
            e.preventDefault();
        }

        $(this).val(this_val.replace(/[^0-9]/g,""));
    });

    function frm_submit(){
        if(hanbitgaram_widget_type==='editor'){
            <?php echo $editor_js; ?>
        }

        if($('#fw_contents').val().trim()==''){
            alert('aa');
            return false;
        }
    }
</script>
<?php
include_once(HANBITGARAM_WIDGET_DIRECTORY.'/tail.php');