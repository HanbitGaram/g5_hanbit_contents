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

define('NO_REDIRECT', true);

$sub_menu = "412103";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g5['title'] = "한빛 컨텐츠 위젯 디버그";
include_once(G5_ADMIN_PATH.'/admin.head.php');
?>

<h2 class="h2_frm">디버그 정보</h2>

<div class="local_desc02 local_desc">
    <p><del>문제가 발생해서 컨텐츠몰에 질문 남겨주실 때, 아래 정보를 반드시 첨부해주세요!<br>개인적으로 위젯의 상태를 점검할 때 사용하셔도 됩니다.</del></p>
    <p>소스코드 무료화 선언으로 더 이상의 문의 및 버그 수정 요청을 받지 않습니다.</p>
</div>

<!-- 캐시 폴더 존재 확인 -->
<?php
$is_cache = !!is_dir(HANBITGARAM_WIDGET_CACHE_PATH);
$cache_dir_permission = (int)substr(decoct(fileperms('.')), -4);
?>
<div class="local_desc01 local_desc">
<p>
    <h2>현재 사이트 주소</h2>
    결과 : <?php echo G5_URL; ?>
    <br>
    <br>

    <h2>현재 사이트 설치 경로</h2>
    결과 : <?php echo G5_PATH; ?>
    <br>
    <br>

    <h2>캐시폴더 존재 유무</h2>
    결과 : <?php echo ($is_cache) ? '캐시 플더가 존재하고 있습니다.' : '캐시폴더가 존재하지 않습니다.'; ?>
    <br>
    <br>

    <h2>캐시 폴더 퍼미션 확인</h2>
    결과 : <?php echo ($cache_dir_permission===(int)decoct(G5_DIR_PERMISSION))? '캐시 폴더 퍼미션이 그누보드 설정과 동일합니다.' : '캐시폴더 권한이 유효하지 않습니다. 권한1(현재 캐시폴더) : '.$cache_dir_permission.' 권한2(그누보드 폴더 설정) : '.(int)decoct(G5_DIR_PERMISSION); ?>
    <br>
    <br>

    <h2>캐시 폴더 소유자 확인</h2>
    현재 접속 유저 : <?php echo getmyuid(); ?><br>
    캐시 폴더 유저 : <?php echo fileowner(HANBITGARAM_WIDGET_CACHE_PATH); ?><br>
    결과 : <?php echo (getmyuid()===fileowner(HANBITGARAM_WIDGET_CACHE_PATH))? '현재 유저 권한과 폴더 소유자가 일치합니다.' : '현재 유저 권한과 폴더 소유자가 일치하지 않습니다. 소유자가 일치하지 않다면, 캐시 폴더에 캐시 파일 생성이 안될 수 있습니다.'; ?>
    <br>
    <br>

    <h2>한빛 컨텐츠 위젯 설치 확인</h2>
    결과 : <?php echo (HANBITGARAM_WIDGET_INSTALL===true)? '설치된 것으로 표시 됩니다.' : '설치 되지 않았습니다.'; ?>
</p>
</div>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');

