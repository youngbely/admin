<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');?>
<div class="pad-10">

<div class="content-menu ib-a blue line-x"><a href="javascript:;" class=on><em><?php echo L('remove');?></em></a> 
</div>
<div class="bk10"></div>
<form action="?m=content&c=content&a=remove&catid=<?php echo $_GET['catid']; ?>" method="post" name="myform">
<div class="table-list">
<table width="100%" cellspacing="0">
<thead>
<tr>
<th align="center" width="50%"><?php echo L('from_where');?></th>
<th align="center" width="50%"><?php echo L('move_to_categorys');?></th>
</tr>
</thead>
<tbody  height="200" class="nHover td-line">
	<tr> 
      <td align="center" rowspan="6">
		
	
		<textarea name="ids"  style="height:280px;width:350px;" readonly="readonly"><?php echo $ids;?></textarea>

	
      
	</td>
    </tr>
	<tr> 
      <td align="center" rowspan="6">
      <select name="tocatid" id="tocatid"  size="2"  style="height:300px;width:350px;">
<option value='0' style="background:#F1F3F5;color:blue;"><?php echo L('move_to_categorys');?></option>
<?php echo $string;?>
</select>
	</td>
    </tr>
	</tbody>

</table>

</div>
<div class="btn">
<input type="submit" class="button" value="<?php echo L('submit');?>" name="dosubmit"/>
</div>
</form>
</div>