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

$sub_menu = "412104";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g5['title'] = "한빛 컨텐츠 위젯 사용방법";
include_once(G5_ADMIN_PATH.'/admin.head.php');
add_stylesheet('<style>#hanbit_how img{max-width:100%;} .hanbit_howto{font-size:1.2em; margin-top:5px; margin-bottom:50px;}</style>',0);
add_stylesheet('<link rel="stylesheet" href="'.HANBITGARAM_WIDGET_URL.'/androidstudio.css">');
add_javascript('<script src="'.HANBITGARAM_WIDGET_URL.'/highlight.pack.js"></script>');
?>

<h2 class="h2_frm">위젯 사용방법</h2>

<div class="local_desc02 local_desc">
    <p>위젯 사용방법은 아래와 같습니다.</p>
</div>

<div id="hanbit_how">
<img src="./how/1.png" alt="폴더를 FTP 내지 폴더에 복사합니다."><br>
<div class="hanbit_howto">1. 파일 압축을 풀고, 각 폴더를 사이트에 업로드합니다.</div>

<img src="./how/2.png" alt="관리자 페이지 접속해서 폴더모양 아이콘 누르고 설치합니다."><br>
<div class="hanbit_howto">2. 설치 페이지(http://도메인/adm/hanbitgaram/widget/widget_list.php)에 접속하거나, 관리자 페이지에서 폴더모양 아이콘 -&gt; 한빛 컨텐츠 위젯을 클릭합니다.</div>

<img src="./how/3.png" alt="라이센스 확인 후 설치합니다."><br>
<div class="hanbit_howto">3. 라이센스 확인 후 설치합니다.</div>

<img src="./how/2.png" alt="다시 돌아옵니다."><br>
<div class="hanbit_howto">4. 다시 관리자 페이지에서 폴더모양 아이콘 -&gt; 한빛 컨텐츠 위젯을 클릭합니다.</div>

<img src="./how/4.png" alt="추가 누릅니다."><br>
<div class="hanbit_howto">5. 우측 상단 위젯추가를 누르면 이름과 타입을 정할 수 있습니다.<br>이름은 단순한 구분자로 작용합니다. 최대한 인식하기 쉽게 작성해주세요.<br>위젯타입은 다양하게 준비되어 있습니다. 이외에 추가를 원하시는 경우, /plugin/hanbitgaeram/widget/options.json 파일을 수정하면 됩니다.</div>

<img src="./how/5.png" alt="위젯 생성 버튼 누릅니다."><br>
<div class="hanbit_howto">6. 위젯 생성 버튼을 누르면, 소스코드가 나옵니다.<br>소스코드는 아래와 같이 활용 가능합니다.</div>

<pre><code class="php html">&lt;?php
    // 최신글 위젯의 게시판을 바꿀 때
    // 사용한 타입 : 텍스트 박스 (NON HTML)
    $bo_table = hanbitgaram_widget_template_view(3, false);
    latest( 'theme/basic', $bo_table, 5 );
?&gt;
</code>
</pre>

<br><br>
<pre><code class="php html">&lt;?php
    // 푸터의 정보를 변경할 때
    // 사용한 타입 : 다중입력박스(NO HTML, AUTO BR)

    echo hanbitgaram_widget_template_view(4);
    // 상호 : 한빛가람 | 대표자명 : 홍길동
    // 주소 : 서울시 대한구 민국로 만세길 우리나라빌딩 3층 (만세동)
    // 사업자등록번호 : 123-12-12345
    // 통신판매업번호 : 2020-서울대한-1029
    // 전화번호 : 010-1234-5678
?&gt;
</code>
</pre>

<div class="hanbit_howto">7. 위젯 리스트 혹은 적용 페이지에서 위젯을 간단하게 수정할 수 있습니다.</div>


</div>
<script>
    document.querySelectorAll('pre code').forEach((block) => {
        hljs.highlightBlock(block);
    });
</script>
<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');