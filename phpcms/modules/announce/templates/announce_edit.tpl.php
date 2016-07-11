<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div class="pad-10">
<form method="post" action="?m=announce&c=admin_announce&a=edit&aid=<?php echo $_GET['aid']?>" name="myform" id="myform">
<table class="table_form" width="100%">
<tbody>


<tr>
		<th width="80"><strong>期数：</strong></th>
		<td><input name="announce[term]" id="term"  value="<?php echo $an_info['term']?>"  class="input-text" type="text"  ></td>
	</tr>
	<tr>
		<th><strong>日期：</strong></th>
		<td><?php echo form::date('announce[createtime]', $an_info['createtime'], 1)?></td>
	</tr>


	
    </tbody>
</table>
<input type="submit" name="dosubmit" id="dosubmit" value=" <?php echo L('ok')?> " class="dialog">&nbsp;<input type="reset" class="dialog" value=" <?php echo L('clear')?> ">
</form>
</div>
</body>
</html>
<script type="text/javascript">


$(document).ready(function(){
	
});
</script>