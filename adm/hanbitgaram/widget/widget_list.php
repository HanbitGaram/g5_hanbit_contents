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
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = "한빛 컨텐츠 위젯 리스트";
include_once(G5_ADMIN_PATH.'/admin.head.php');

add_stylesheet('<link rel="stylesheet" href="'.HANBITGARAM_WIDGET_URL.'/jquery.modal.min.css">');
add_javascript('<script src="'.HANBITGARAM_WIDGET_URL.'/jquery.modal.min.js"></script>');

add_stylesheet('<link rel="stylesheet" href="'.HANBITGARAM_WIDGET_URL.'/androidstudio.css">');
add_javascript('<script src="'.HANBITGARAM_WIDGET_URL.'/highlight.pack.js"></script>');
//add_javascript('<script>hljs.initHighlightingOnLoad();</script>');

// CSRF 공격 방어
$csrf = sha1(mt_rand(10000,99999).G5_TIME_YMDHIS.'_HANBITGARAM_WIDGET_'.mt_rand(10000,99999));
set_session('HANBITGARAM_WIDGET_CSRF', $csrf);
add_javascript('<script>var hanbitgaram_widget_csrf="'.$csrf.'";</script>');

$total_count = sql_fetch("SELECT count(`fw_id`) as 'tot_cnt' FROM `".G5_TABLE_PREFIX."hanbitgaram_widget` ")['tot_cnt'];
?>
<div class="btn_fixed_top btn_confirm">
    <a href="#modal_add" rel="modal:open" class="btn btn_submit btn_02 act_widget_add" accesskey="a" onclick="hanbitgaram_widget_action('add');">위젯 추가</a>
</div>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">생성된 위젯갯수</span><span class="ov_num"> <?php echo number_format($total_count) ?>개</span></span>
</div>

<div class="tbl_head01 tbl_wrap">
    <table id="widget_list">
        <caption><?php echo $g5['title']; ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col" width="50">No</th>
            <th scope="col">위젯 제목</th>
            <th scope="col" width="150">속성</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


<!--
WIDGET LAYER
-->
<div id="modal_add" class="modal">
    <h1>{WIDGET TITLE}</h1>

    <label for="modal_name">위젯 이름</label>
    <input type="text" id="widget_name" placeholder="위젯 이름" class="frm_input_full frm_input">

    <label for="modal_name">위젯 타입</label>
    <?php
        $widget_list = hanbitgaram_widget_options_load();
    ?>
    <select id="widget_type" class="frm_input_full frm_input">
    <option value="">== 타입 선택해주세요 ==</option>
    <?php foreach($widget_list as $key => $val){ ?>
    <option value="<?php echo $key; ?>"><?php echo $val['name']; ?></option>
    <?php } ?>
    </select>

    <button class="btn btn_02 frm_input_full act_btn_submit" onclick="hanbitgaram_widget_action_submit();">{WIDGET SUBMIT}</button>
</div>

<div id="modal_code" class="modal">
    <h1>코드복사</h1>
    <div id="code_copy">aa</div>
    <!--<textarea class="frm_input frm_input_full">aaa</textarea>-->
</div>

<script>
    var hanbitgaram_widget_mode = null;
    var hanbitgaram_widget_num = 0;
    /*$('.act_widget_add').click(function(){
        widget_action('add');
    });*/

    $(document).on('click', '.act_make_code', function(){
        $("#modal_code").modal();
        var code = $(this).data('idx');

            //$(this).data('idx');
        //$("#modal_code textarea").val("<!-- 위젯 "+code+"번 -->\n<"+"?"+"php\n// 위젯 "+code+"번\necho hanbitgaram_widget_template_view("+code+");\n?"+">");
        $('#code_copy').html("<pre><code class=\"php html\" style=\"font-size:1.3em;\">&lt;!-- 위젯 "+code+"번 --&gt;\n&lt;?php\n// 수정버튼 노출해야하는 경우\necho hanbitgaram_widget_template_view("+code+");\n\n// 수정버튼 노출 안해도 되는 경우(bo_table 등 변경할 때)\necho hanbitgaram_widget_template_view("+code+", false);\n?&gt;</code></pre>");

        document.querySelectorAll('pre code').forEach((block) => {
            hljs.highlightBlock(block);
        });
    });

    $(document).on('click', '.act_modify', function(){
        $("#modal_add").modal();
        hanbitgaram_widget_action('modify', $(this).data('idx'));

        $.post('./ajax.widget_info.php',{
            idx: $(this).data('idx')
        })
        .done(function(e){
            if(e.error){
                alert(e.error);
            }

            if(e.status===true){
                $("#modal_add input").val(e.contents.name);
                $("#widget_type").val(e.contents.type);
            }
        });
    });

    $(document).on('click', '.act_delete', function() {
        if(confirm('정밀 이 위젯을 삭제하시겠습니까?')){
            $.post('./ajax.widget_delete.php',{
                idx: $(this).data('idx'),
                csrf: hanbitgaram_widget_csrf
            }).done(function(e){
                if(e.error){
                    alert(e.error);
                }

                if(e.status===true){
                    alert('삭제하였습니다.');
                    $('.close-modal').click();
                    hanbitgaram_widget_list_refresh();
                }
            });
        }
    });

    function hanbitgaram_widget_action(type='', num=0){
        if(type==='add'){
            hanbitgaram_widget_mode = 'w';
            hanbitgaram_widget_num = 0;
            $("#modal_add input").val('');
            $("#widget_type").val('');
            $("#modal_add h1").text('위젯 추가');
            $(".act_btn_submit").text('위젯추가하기');
        }else if(type=='modify'){
            hanbitgaram_widget_mode = 'm';
            hanbitgaram_widget_num = num;
            $("#modal_add input").val('');
            $("#widget_type").val('');
            $("#modal_add h1").text('위젯 수정');
            $(".act_btn_submit").text('위젯수정하기');
        }
    }

    function hanbitgaram_widget_action_submit(){
        if($('#widget_name').val().trim()==''){
            alert('위젯 이름을 입력해주세요.');
            $('#widget_name').focus();
            return false;
        }

        if($('#widget_type').val().trim()==''){
            alert('위젯 타입을 선택해주세요.');
            $('#widget_type').focus();
            return false;
        }

        if(hanbitgaram_widget_mode=='w'){
            $.post('./ajax.widget_write.php',
                {
                    csrf: hanbitgaram_widget_csrf,
                    mode: hanbitgaram_widget_mode,
                    name: $('#widget_name').val().trim(),
                    type: $('#widget_type').val().trim(),
                    cache: false
                }
            )
            .done(function(e){
                if(e.error){
                    alert(e.error);
                }

                if(e.status===true){
                    alert('등록하였습니다.');
                    $('.close-modal').click();
                    hanbitgaram_widget_list_refresh();
                }
            });
        }

        if(hanbitgaram_widget_mode=='m'){
            $.post('./ajax.widget_write.php',
                {
                    csrf: hanbitgaram_widget_csrf,
                    idx: hanbitgaram_widget_num,
                    mode: hanbitgaram_widget_mode,
                    name: $('#widget_name').val().trim(),
                    type: $('#widget_type').val().trim(),
                    cache: false
                }
            )
                .done(function(e){
                    if(e.error){
                        alert(e.error);
                    }

                    if(e.status===true){
                        alert('수정되었습니다.');
                        $('.close-modal').click();
                        hanbitgaram_widget_list_refresh();
                    }
                });
        }
    }

    function hanbitgaram_widget_list_refresh(){
        $.get('./ajax.widget_list.php',{
            cache: false
        })
            .done(function(e){
                if(e.error){
                    alert(e.error);
                }

                if(e.status===true){
                    $("#widget_list tbody").html(e.contents);
                    $("div.local_ov01.local_ov > span > span.ov_num").text($("#widget_list tbody tr").length+'개');

                    //alert(e.contents);
                }
            });
    }

    hanbitgaram_widget_list_refresh();
</script>
<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
?>
