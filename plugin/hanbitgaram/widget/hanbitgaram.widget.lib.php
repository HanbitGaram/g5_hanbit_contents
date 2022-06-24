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
 * Error page creation function
 *
 * @param string $title        Error Title
 * @param string $contents     Error Content
 */
function hanbitgaram_widget_error($title='', $contents=''){
    global $g5;
    $g5['title'] = $title;
    include_once(HANBITGARAM_WIDGET_DIRECTORY.'/head.php');
    echo $contents;
    include_once(HANBITGARAM_WIDGET_DIRECTORY.'/tail.php');
    exit;
}

/**
 * @param int $template_id
 * @param bool $btn_view
 * @return bool
 */
function hanbitgaram_widget_template_view($template_id=0, $btn_view=true){
    global $is_admin;
    $options = hanbitgaram_widget_options_load();

    $template_id = (int)$template_id;

    if($is_admin) $config_btn = '<a href="'.HANBITGARAM_WIDGET_URL.'/modify.php?idx='.$template_id.'" target="_blank" onclick="window.open(\''.HANBITGARAM_WIDGET_URL.'/modify.php?idx='.$template_id.'\', \'widget_modify\', \'width=800,height=700\'); return false;" class="btn02">위젯 '.$template_id.'번 수정</a>';
    else $config_btn = '';

    if(!hanbitgaram_widget_cache_control($template_id,0.2)){
        try {
            $data = sql_fetch("SELECT * FROM `".G5_TABLE_PREFIX."hanbitgaram_widget` WHERE `fw_id`='{$template_id}';");
            $fp = fopen(HANBITGARAM_WIDGET_CACHE_PATH . '/' . $template_id . '.json', 'w');
            fwrite($fp, json_encode($data));
            fclose($fp);
        }catch(Exception $e){
            return false;
        }
    }else{
        try {
            $fp = fopen(HANBITGARAM_WIDGET_CACHE_PATH . '/' . $template_id . '.json', "r");
            $data = fread($fp, filesize(HANBITGARAM_WIDGET_CACHE_PATH . '/' . $template_id . '.json'));
            $data = json_decode($data, true);
            fclose($fp);
        }catch(Exception $e){
            return false;
        }
    }

    $opt = $options[$data['fw_type']];
    $tmp = html_purifier($data['fw_contents']);
    if($opt['html']===false) $tmp = htmlspecialchars($tmp);
    if($opt['autobr']===true) $tmp = nl2br($tmp);

    return trim($tmp.$config_btn);
}

//echo hanbitgaram_widget_template_view(1);

/**
 * @param int $template_id
 * @param int $minute
 */
function hanbitgaram_widget_cache_control($template_id=0, $minute=0){
    // return true => cache file only read but return false => cache file make
    if(!file_exists(HANBITGARAM_WIDGET_CACHE_PATH.'/'.$template_id.'.json')){
        return false;
    }else if(time()-filemtime(HANBITGARAM_WIDGET_CACHE_PATH.'/'.$template_id.'.json')>=($minute*60)){
        return false;
    }else{
        return true;
    }
}

function hanbitgaram_widget_options_load(){
    try{
        $fp = fopen(HANBITGARAM_WIDGET_DIRECTORY.'/options.json', 'r');
        $data = fread($fp, filesize(HANBITGARAM_WIDGET_DIRECTORY.'/options.json'));
        fclose($fp);

        return json_decode($data, true);
    }catch(Exception $e){
        return false;
    }
}

function hanbitgaram_widget_ajax_auth_check($auth, $attr)
{
    global $is_admin;

    if ($is_admin == 'super') return;

    if (!trim($auth))
        die("{\"error\":\"이 메뉴에는 접근 권한이 없습니다.\\n\\n접근 권한은 최고관리자만 부여할 수 있습니다.\"}");

    $attr = strtolower($attr);

    if (!strstr($auth, $attr)) {
        if ($attr == 'r')
            die("{\"error\":\"읽을 권한이 없습니다.\"}");
        else if ($attr == 'w')
            die("{\"error\":\"입력, 추가, 생성, 수정 권한이 없습니다.\"}");
        else if ($attr == 'd')
            die("{\"error\":\"삭제 권한이 없습니다.\"}");
        else
            die("{\"error\":\"속성이 잘못 되었습니다.\"}");
    }
}