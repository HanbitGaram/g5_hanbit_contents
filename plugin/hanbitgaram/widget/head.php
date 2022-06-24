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
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">
<meta name="HandheldFriendly" content="true">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<?php
if (!isset($g5['title'])) {
    $g5['title'] = 'HANBITGARAM WIDGET';
    $g5_head_title = $g5['title'];
}
else {
    $g5_head_title = $g5['title']; // 상태바에 표시될 제목
    $g5_head_title .= " | HANBITGARAM WIDGET";
}

$g5['title'] = strip_tags($g5['title']);
$g5_head_title = strip_tags($g5_head_title);
?>
<title><?php echo $g5_head_title; ?></title>
<link rel="stylesheet" href="<?php echo HANBITGARAM_WIDGET_URL; ?>/reset.css?ver=<?php echo G5_CSS_VER; ?>">
<?php
add_stylesheet('<link rel="stylesheet" href="'.HANBITGARAM_WIDGET_URL.'/hanbitgaram.widget.css">');
?>

<script src="<?php echo G5_JS_URL ?>/html5.js"></script>
<script src="<?php echo HANBITGARAM_WIDGET_URL; ?>/hanbitgaram.widget.js"></script>
<?php
if(file_exists(G5_PATH.'/js/jquery-1.12.4.min.js')) {
    add_javascript('<script src="'.G5_JS_URL.'/jquery-1.12.4.min.js"></script>', 0);
}else if(file_exists(G5_PATH.'/js/jquery-1.8.3.min.js')){
    add_javascript('<script src="'.G5_JS_URL.'/jquery-1.8.3.min.js"></script>', 0);
}else{
    add_javascript('<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>', 0);
}
?>
</head>
<body>
<div id="header"><?php echo $g5['title']; ?></div>
<div id="contents">