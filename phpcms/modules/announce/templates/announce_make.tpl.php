<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div class="pad-lr-10">
<form name="myform" id="myform"  method="post">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="20" align="left"><input type="checkbox" value="" id="check_box" onclick="selectall('ids[]');"></th>
            <th width="30">排序</th>
	    <th width="10" align="center">id</th>
            <th width="100" align="center">类别</th>
	    <th  align="center">标题</th>
	    <th width="69" align="center">发布人</th>
            <th width="200" align="center">更新日期</th>
            <th width="69" align="center">管理操作</th>
            </tr>
        </thead>
    <tbody>
 <?php 
if(is_array($datas)){
	foreach($datas as $announce){
?>
	<tr>
	<td align="left">
	<input type="checkbox" name="ids[]" value="<?php echo $announce['id']?>">
	</td>
       
        <td align='center'><input name='listorders[<?php echo $announce['id'];?>]' type='text' size='3' value='<?php echo $announce['listorder'];?>' class='input-text-c'></td>
        <td align="center"><?php echo $announce['id']?></td>
        <td align="center"><?php echo $announce['name']?></td>
	<td align="left"><?php echo $announce['title']?></td>
	<td align="center"><?php echo $announce['username']?></td>
        <td align="center"><?php echo$announce['time']; ?></td>
	<td align="center">
	<a href="javascript:;" onclick="javascript:openwinx('?m=content&c=content&a=edit&catid=29&dosubmit=1&id=<?php echo  $announce['id']?>&type=<?php echo $_GET["type"]?>','')"><?php echo L('edit');?></a> 
	</td>
	</tr>
<?php 
	}
}
?>
</tbody>
    </table>
  
    <div class="btn"><label for="check_box"><?php echo L('selected_all')?>/<?php echo L('cancel')?></label>
       <input type="button" class="button" value="删除选定" onclick="myform.action='?m=content&c=content&a=delete&dosubmit=1&catid=29';return confirm_delete()"/>
       <input type="button" class="button" value="排序" onclick="myform.action='?m=content&c=content&a=listorder&dosubmit=1&catid=29';myform.submit();"/>
    </div>
 <div id="pages"><?php echo $this->db->pages;?></div>
</form>
</div>
</body>
</html>
<script type="text/javascript">
    
function confirm_delete(){
	if(confirm('确认删除吗?')) $('#myform').submit();
}


function showLoading()
{
	window.top.art.dialog({id:'loading'}).close();

	window.top.art.dialog({id:'loading',esc:false,drag:false,resize:false,width:60,height:60});
	window.top.document.getElementById('titleBar').style.display="none";


}
function closeLoading()
{
	window.top.art.dialog({id:'loading'}).close();

}

function createHtml(typeId,rkId) {
    if (confirm('确认发布?')) {
        //alert(1);return;
        showLoading();
        $.ajax({
            url: '?m=announce&c=admin_announce&a=creathtml&rkid=' + rkId + '&type=' + typeId + '&pc_hash=<?php echo $_GET["pc_hash"] ?>',
            type: 'get',
            error: function () {
                closeLoading();
                alert('失败');
            },
            success: function (data) {
                closeLoading();
                alert(data);
            }
        });
    }
}
</script>