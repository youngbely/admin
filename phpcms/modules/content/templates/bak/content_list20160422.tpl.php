<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');?>
<div id="closeParentTime" style="display:none"></div>
<SCRIPT LANGUAGE="JavaScript">
    <!--
    if(window.top.$("#current_pos").data('clicknum')==1 || window.top.$("#current_pos").data('clicknum')==null) {
        parent.document.getElementById('display_center_id').style.display='';
        parent.document.getElementById('center_frame').src = '?m=content&c=content&a=public_categorys&type=add&menuid=<?php echo $_GET['menuid'];?>&pc_hash=<?php echo $_SESSION['pc_hash'];?>';
        window.top.$("#current_pos").data('clicknum',0);
    }
    //-->
</SCRIPT>
<div class="pad-10">
    <div class="content-menu ib-a blue line-x">
        <a class="add fb" href="javascript:;" onclick=javascript:openwinx('?m=content&c=content&a=add&menuid=&catid=<?php echo $catid;?>&pc_hash=<?php echo $_SESSION['pc_hash'];?>','')><em>添加资讯</em></a>　

    </div>
    <div id="searchid" style="display:">
        <form name="searchform" action="" method="get" >
            <input type="hidden" value="content" name="m">
            <input type="hidden" value="content" name="c">
            <input type="hidden" value="init" name="a">
            <input type="hidden" value="<?php echo $catid;?>" name="catid">
            <input type="hidden" value="<?php echo $steps;?>" name="steps">
            <input type="hidden" value="1" name="search">
            <input type="hidden" value="<?php echo $pc_hash;?>" name="pc_hash">
            <table width="100%" cellspacing="0" class="search-form">
                <tbody>
                <tr>
                    <td>
                        <div class="explain-col">
                            发布日期：
                            <?php echo form::date('start_time',$_GET['start_time'],0,0,'false');?>- &nbsp;<?php echo form::date('end_time',$_GET['end_time'],0,0,'false');?>
                            <?php if($_GET['menuid'] == 1532 || isset($_GET['ispass'])){echo '<input type="hidden" name="ispass" value="0">';}?>

                            标题：
                            <input name="keyword" type="text" value="<?php if(isset($_GET['keyword'])) echo $_GET['keyword'];?>" class="input-text" />
                            <input type="submit" name="search" class="button" value="搜索" />
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    <form name="myform" id="myform" action="" method="post" >
        <div class="table-list">
            <table width="100%">
                <thead>
                <tr>
                    <th width="10"><input type="checkbox" value="" id="check_box" onclick="selectall('ids[]');"></th>

                    <th width="20">ID</th>
                    <th>标题</th>
                    <th width="50">已审核</th>
                    <th width="50">关联个股</th>
                    <th width="80">关键字</th>
                    <th width="100">所属栏目</th>
                    <th width="60">发布人</th>
                    <th width="118">发布日期</th>
                    <th width="72">管理操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(is_array($datas)) {

                    foreach ($datas as $r) {

                        ?>
                        <tr>
                            <td align="center"><input class="inputcheckbox " name="ids[]" value="<?php echo $r['id'];?>" type="checkbox"></td>

                            <td align='center' ><?php echo $r['id'];?></td>
                            <td>
                                <?php
                                echo '<a href="javascript:;" title="点击预览" onclick=\'window.open("?m=content&c=content&a=public_preview&steps='.$steps.'&catid='.$catid.'&id='.$r['id'].'","manage")\'>';
                                ?><span<?php echo title_style($r['style'])?>><?php echo $r['title'];?></span></a> <?php if($r['thumb']!='') {echo '<img src="'.IMG_PATH.'icon/small_img.gif" title="'.L('thumb').'">'; } if($r['posids']) {echo '<img src="'.IMG_PATH.'icon/small_elite.gif" title="'.L('elite').'">';} ?>
                                <?php if($r['sfzd']==1) {?><span style="color:#F00"> [置顶]</span> <?php }?><?php if($r['cw']==1) {?> <span style="color: #03F;">[传闻]</span> <?php }?></td>
                            <td><?php echo $ispassArr[$r['ispass']];?></td>
                            <td><?php echo $r['glgg'];?></td>
                            <td><?php echo $r['keywords'];?></td>
                            <td><?php echo $r['catnames'];

                                ?></td>
                            <td align='center'>
                                <?php echo $r['username'];

                                ?></td>
                            <td align='center'><?php echo format::date($r['inputtime'],1);?></td>
                            <td align='center'><a href="javascript:;" onclick="javascript:openwinx('?m=content&c=content&a=edit&catid=<?php echo $catid;?>&id=<?php echo $r['id']?>','')"><img src="<?php echo IMG_PATH?>admin_img/edit.png" /></a> </td>
                        </tr>
                    <?php }
                }
                ?>
                </tbody>
            </table>
            <div class="btn"><label for="check_box"><?php echo L('selected_all');?>/<?php echo L('cancel');?></label>
                <input type="hidden" value="<?php echo $pc_hash;?>" name="pc_hash">


                <input type="button" class="button" value="批量删除" onclick="myform.action='?m=content&c=content&a=delete&dosubmit=1&catid=<?php echo $catid;?>&steps=<?php echo $steps;?>';return confirm_delete()"/>
                <input type="button" class="button" value="批量复制到其他栏目" onclick="pushBacth();"/>


                <input type="button" class="button" value="批量移动到其他栏目" onclick="removeBacth()"/>
                <?php echo runhook('admin_content_init')?>
            </div>
            <div id="pages"><?php echo $pages;?></div>
        </div>
    </form>
</div>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>cookie.js"></script>
<script type="text/javascript">
    <!--

    //http://221.232.160.243/bolanadmin/admin/index.php?m=content&c=push&a=init&module=content&classname=push_api&action=category_list&order=3&tpl=push_to_category&modelid=1&catid=3862&id=16|15&pc_hash=AdWth9

    function pushBacth() {
        var str = 0;
        var id = tag = '';
        $("input[name='ids[]']").each(function() {
            if($(this).attr('checked')=='checked') {
                str = 1;
                id += tag+$(this).val();
                tag = '|';
            }
        });
        if(str==0) {
            alert('<?php echo L('you_do_not_check');?>');
            return false;
        }
        window.top.art.dialog({id:'push'}).close();
        window.top.art.dialog({title:'批量复制到其他栏目',id:'push',iframe:'?m=content&c=push&action=0&catid=<?php echo $catid?>&modelid=<?php echo $modelid?>&id='+id,width:'650',height:'500'}, function(){var d = window.top.art.dialog({id:'push'}).data.iframe;// 使用内置接口获取iframe对象
            var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'push'}).close()});
    }

    function removeBacth()
    {
        var str = 0;
        var id = tag = '';
        $("input[name='ids[]']").each(function() {
            if($(this).attr('checked')=='checked') {
                str = 1;
                id += tag+$(this).val();
                tag = '|';
            }
        });
        if(str==0) {
            alert('<?php echo L('you_do_not_check');?>');
            return false;
        }
        window.top.art.dialog({id:'remove'}).close();
        window.top.art.dialog({title:'批量移动到其他栏目',id:'remove',iframe:'?m=content&c=push&action=1&catid=<?php echo $catid?>&modelid=<?php echo $modelid?>&id='+id,width:'650',height:'500'}, function(){var d = window.top.art.dialog({id:'remove'}).data.iframe;// 使用内置接口获取iframe对象
            var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'remove'}).close()});

    }
    function confirm_delete(){
        if(confirm('<?php echo L('confirm_delete', array('message' => L('selected')));?>')) $('#myform').submit();
    }
    function view_comment(id, name) {
        window.top.art.dialog({id:'view_comment'}).close();
        window.top.art.dialog({yesText:'<?php echo L('dialog_close');?>',title:'<?php echo L('view_comment');?>：'+name,id:'view_comment',iframe:'index.php?m=comment&c=comment_admin&a=lists&show_center_id=1&commentid='+id,width:'800',height:'500'}, function(){window.top.art.dialog({id:'edit'}).close()});
    }
    function reject_check(type) {
        if(type==1) {
            var str = 0;
            $("input[name='ids[]']").each(function() {
                if($(this).attr('checked')=='checked') {
                    str = 1;
                }
            });
            if(str==0) {
                alert('<?php echo L('you_do_not_check');?>');
                return false;
            }
            document.getElementById('myform').action='?m=content&c=content&a=pass&catid=<?php echo $catid;?>&steps=<?php echo $steps;?>&reject=1';
            document.getElementById('myform').submit();
        } else {
            $('#reject_content').css('display','');
            return false;
        }
    }
    setcookie('refersh_time', 0);
    function refersh_window() {
        var refersh_time = getcookie('refersh_time');
        if(refersh_time==1) {
            window.location.reload();
        }
    }
    setInterval("refersh_window()", 3000);
    //-->
</script>
</body>
</html>