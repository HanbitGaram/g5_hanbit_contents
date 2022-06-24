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

define('_INSTALL_', true);

/**
 * Required file include
 */
include_once('./_common.php');

/**
 * If already installed
 */
if(HANBITGARAM_WIDGET_INSTALL){
    hanbitgaram_widget_error('이미 설치되어 있습니다.','한빛 컨텐츠 위젯이 이미 설치되어 있습니다.<br>설치가 되어 있기 때문에 더 이상 진행할 수 없습니다.');
}

if($_GET['mode'] === 'install'){

    /**
     * Directory creating
     *
     * 캐시를 저장하기 위한 디렉토리를 생성합니다.
     */
    @mkdir(G5_DATA_PATH.'/hanbitgaram/', G5_DIR_PERMISSION);
    @mkdir(G5_DATA_PATH.'/hanbitgaram/widget', G5_DIR_PERMISSION);

    /**
     * Directory access block
     *
     * Install .htaccess files to block directory access.
     * 캐시 내용을 열람하는 상황을 방지하기 위하여, 디렉토리 접근 불가 설정을 걸어둡니다.
     */
    try{
        $fw = fopen(HANBITGARAM_WIDGET_CACHE_PATH . '/.htaccess', 'w');
        if(!$fw) throw new Exception ("디렉토리에 .htaccess 파일을 설치할 수 없습니다.<br>파일에 접근할 권한이 없습니다.");
        fwrite($fw,"php_admin_flag engine off\nphp_flag engine off\nDeny From All");
        fclose($fw);
    }catch(Exception $e){
        hanbitgaram_widget_error('오류', $e->getMessage());
    }

    /**
     * File open error handling
     *
     * If an error occurs in fopen, it is thrown immediately.
     * 파일 오픈시, 오류가 발샐하면 죽시 오류를 내보냅니다.
     */
    try {
        $fp = fopen(HANBITGARAM_WIDGET_DIRECTORY . '/install.sql', 'r');
        if(!$fp) throw new Exception ("설치에 필요한 SQL 파일이 존재하지 않거나, 파일에 접근할 권한이 부족합니다.");
        $sql = fread($fp, filesize(HANBITGARAM_WIDGET_DIRECTORY . '/install.sql'));
        fclose($fp);
    }catch(Exception $e){
        hanbitgaram_widget_error('오류', $e->getMessage());
    }

    $sql = str_replace('[[G5_TABLE_PREFIX]]', G5_TABLE_PREFIX, $sql);

    $result = sql_query($sql);

    /**
     * If it succeeds, it moves to the main page. If it fails, it prints an error.
     */
    if($result){
        goto_url(G5_ADMIN_URL.'/hanbitgaram/widget/widget_list.php');
    }else{
        hanbitgaram_widget_error("SQL 설치 실패", htmlspecialchars(sql_error_info()));
    }
}

/**
 * Title setting and including of required files
 */
$g5['title'] = '한빛 컨텐츠 위젯 설치';
include_once(HANBITGARAM_WIDGET_DIRECTORY.'/head.php');
?>
<div id="install_title">한빛 컨텐츠 위젯을 설치합니다.</div>
<div id="install_description">
한빛 컨텐츠 위젯을 사용하면, 편하게 위젯을 개발하고 관리할 수 있습니다.<br>
한빛 컨텐츠 위젯을 설치하고 편하고 빠른 위젯관리를 만나보세요.<br>
<br>
제작 : 한빛가람(<a href="https://hanb.jp" target="_blank">https://hanb.jp</a>)
<br>
<br>
<a href="<?php echo G5_ADMIN_URL; ?>/hanbitgaram/widget/widget_license.php">[오픈소스 / 소프트웨어 라이센스 열람]</a>
<br>
<br>
<a href="<?php echo HANBITGARAM_WIDGET_URL; ?>/install.php?mode=install" class="btn_submit">라이센스를 열람했으며, 위젯을 설치합니다.</a>
</div>
<?php
include_once(HANBITGARAM_WIDGET_DIRECTORY.'/tail.php');