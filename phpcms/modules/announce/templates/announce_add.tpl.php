<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div class="pad-10">
<form method="post" action="?m=announce&c=admin_announce&a=add" name="myform" id="myform">
<input name="announce[type]" id="type"  type="hidden"  value="<?php echo $_GET['type']?>" >
<table class="table_form" width="100%" cellspacing="0">
<tbody>
	<tr>
		<th width="80"><strong>期数：</strong></th>
		<td><input name="announce[term]" id="term" class="input-text" type="text"  ></td>
	</tr>
	<tr>
		<th><strong>日期：</strong></th>
		<td><?php echo form::date('announce[createtime]', date('Y-m-d H:i:s'), 1)?></td>
	</tr>
	
	
	
	

	</tbody>
</table>
<input type="submit" name="dosubmit" id="dosubmit" value=" 确定 " class="dialog">&nbsp;<input type="reset" class="dialog" value=" 取消 ">
</form>
</div>
</body>
</html>
<script type="text/javascript">


$(document).ready(function(){
	
});
</script>