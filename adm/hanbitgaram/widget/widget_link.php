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

$sub_menu = "412102";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g5['title'] = "한빛 컨텐츠 위젯 프로그램 정보";
include_once(G5_ADMIN_PATH.'/admin.head.php');
?>

<h2 class="h2_frm">제작자 정보</h2>
<div class="local_desc01 local_desc">
<p>
제작자명 : 한빛가람 (<a href="https://hanb.jp" target="_blank">https://hanb.jp</a>)<br>
사업자명 : 야금야금<br>
컨텐츠몰 : <a href="https://sir.kr/cmall/shop.php?cp=fb_mrtucely" target="_blank">https://sir.kr/cmall/shop.php?cp=fb_mrtucely</a>
<br><br>
문의 올려주실 땐, 디버그 메뉴를 눌러서 정보를 복사 붙여넣기 부탁드립니다.
</p>
</div>
<br>
<h2 class="h2_frm">기반 소프트웨어 정보</h2>
<div class="local_desc01 local_desc">
    <p>
        그누보드 5.4.2
    </p>
</div>
<br>
<h2 class="h2_frm">버그 등 수정 내역</h2>
<div class="local_desc01 local_desc">
    <p>
        2020년 06월 23일 - 첫 제작
    </p>
</div>
<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
