<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');?>
<style type="text/css">
html,body{ background:#e2e9ea}
</style>
<script type="text/javascript">
<!--
	var charset = '<?php echo CHARSET;?>';
	var uploadurl = '<?php echo pc_base::load_config('system','upload_url')?>';
//-->
</script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>content_addtop.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>colorpicker.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>hotkeys.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>cookie.js"></script>
<script type="text/javascript">var catid=<?php echo $catid;?></script>
<form name="myform" id="myform" action="?m=content&c=content&a=edit" method="post" enctype="multipart/form-data" onsubmit="return checkForm()">
<div class="addContent">
<div class="crumbs"><?php echo L('edit_content_position');?></div>
<div class="col-right">
    	<div class="col-1">
        	<div class="content pad-6">
<?php
if(is_array($forminfos['senior'])) {
 foreach($forminfos['senior'] as $field=>$info) {
	if($info['isomnipotent']) continue;
	if($info['formtype']=='omnipotent') {
		foreach($forminfos['base'] as $_fm=>$_fm_value) {
			if($_fm_value['isomnipotent']) {
				$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
			}
		}
		foreach($forminfos['senior'] as $_fm=>$_fm_value) {
			if($_fm_value['isomnipotent']) {
				$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
			}
		}
	}
 ?>
	<h6><?php if($info['star']){ ?> <font color="red">*</font><?php } ?> <?php echo $info['name']?></h6>
	 <?php echo $info['form']?><?php echo $info['tips']?> 
<?php
} }
?>
          </div>
        </div>
    </div>
    <a title="展开与关闭" class="r-close" hidefocus="hidefocus" style="outline-style: none; outline-width: medium;" id="RopenClose" href="javascript:;"><span class="hidden">展开</span></a>
    <div class="col-auto">
    	<div class="col-1">
        	<div class="content pad-6">
<table width="100%" cellspacing="0" class="table_form">
	<tbody>	
<?php
if(is_array($forminfos['base'])) {
 foreach($forminfos['base'] as $field=>$info) {
	if($info['isomnipotent']) continue;
	if($info['formtype']=='omnipotent') {
		foreach($forminfos['base'] as $_fm=>$_fm_value) {
			if($_fm_value['isomnipotent']) {
				$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
			}
		}
		foreach($forminfos['senior'] as $_fm=>$_fm_value) {
			if($_fm_value['isomnipotent']) {
				$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
			}
		}
	}
 ?>
	<tr>
      <th width="80"><?php if($info['star']){ ?> <font color="red">*</font><?php } ?> <?php echo $info['name']?>
	  </th>
      <td><?php echo $info['form']?>  <?php echo $info['tips']?></td>
    </tr>
<?php
} }
?>

    </tbody></table>
                </div>
        	</div>
        </div>
        
    </div>
</div>
<div class="fixed-bottom">
	<div class="fixed-but text-c">
    <div class="button">
	<input value="<?php if($r['upgrade']) echo $r['url'];?>" type="hidden" name="upgrade">
	<input value="<?php echo $id;?>" type="hidden" name="id"><input value="<?php echo L('save_close');?>" type="submit" name="dosubmit" style="width:145px;" class="cu" onclick="refersh_window()"></div>

    <div class="button"><input value="<?php echo L('c_close');?>" type="button" name="close" onclick="refersh_window();close_window();" class="cu" title="Alt+X"></div>
      </div>
</div>
</form>

</body>
</html>
<script type="text/javascript"> 
<!--
//只能放到最下面
var openClose = $("#RopenClose"), rh = $(".addContent .col-auto").height(),colRight = $(".addContent .col-right"),valClose = getcookie('openClose');
$(function(){
	if(valClose==1){
		colRight.hide();
		openClose.addClass("r-open");
		openClose.removeClass("r-close");
	}else{
		colRight.show();
	}
	openClose.height(rh);
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, 	function(){$(obj).focus();
	boxid = $(obj).attr('id');
	if($('#'+boxid).attr('boxid')!=undefined) {
		check_content(boxid);
	}
	})}});
	<?php echo $formValidator;?>
	
/*
 * 加载禁用外边链接
 */
	jQuery(document).bind('keydown', 'Alt+x', function (){close_window();});
})
document.title='<?php echo L('edit_content').addslashes($data['title']);?>';
self.moveTo(0, 0);
function refersh_window() {
	setcookie('refersh_time', 1);
}
openClose.click(
	  function (){
		if(colRight.css("display")=="none"){
			setcookie('openClose',0,1);
			openClose.addClass("r-close");
			openClose.removeClass("r-open");
			colRight.show();
		}else{
			openClose.addClass("r-open");
			openClose.removeClass("r-close");
			colRight.hide();
			setcookie('openClose',1,1);
		}
	}
)


function getStockCode()
{
	var stockname ;
		$.ajax({ 
			url:"http://221.232.160.243/bolanadmin/getStockName.txt", 
			async: false,
			datatype:"json", 
			type:"get", 
			success:function(data) 
			{ 
				 stockname = JSON.parse(data);
			} 
			
		}); 
	var content=editor.getPlainTxt()+document.getElementById("title").value;
	if(content=="")
	{
		//alert("内容为空，无法提取股票代码");
		return;
	}
	  
	var re = new RegExp("(60[0-9]{4})|(00[0-9]{4})|(300[0-9]{3})|" + stockname[0],"gim"); 

	var m=content.match(re);
	if(!m) return;
	var stockCodes='';
	var len=m.length;
	if (len<=0)
	{
		//alert("没有找到股票代码");
		return;
		
	}
	for(i=0;i<len;i++)
	{
		if(isChinese(m[i])){
			$.ajax({ 
				url:"http://221.232.160.243/bolanadmin/getCodeByName.php?type=1&name="+m[i], 
				async: false,
				datatype:"json", 
				type:"get", 
				success:function(data) 
				{ 
					var stockcode = JSON.parse(data);
					stockCodes+=stockcode[0];
				} 

			}); 
		}else{
		    stockCodes+=m[i];
		}
		if(i<len-1)
		{
			stockCodes+=",";
		}
	}	
	var ss = stockCodes.split(",");

	var n = []; //一个新的临时数组
	for(var i = 0; i < ss.length; i++) //遍历当前数组
	{
		//如果当前数组的第i已经保存进了临时数组，那么跳过，
		//否则把当前项push到临时数组里面
		if (n.indexOf(ss[i]) == -1) n.push(ss[i]);
	}
	$("#glgg").val(n.join(","));
}

function getKey()
{	
	var key = $("#glgg").val();
	key+=',';
	$.ajax({ 
		url:"http://221.232.160.243/bolanadmin/getCodeByName.php?type=0&name="+key, 
		async: false,
		datatype:"json", 
		type:"get", 
		success:function(data) 
		{ 
			var stockcode = JSON.parse(data);
			key+=stockcode[0];
		} 
	})
	$("#keywords").val(key);
}




//判断是否为中文
function isChinese(temp)
{
    var re=/^([\x81-\xfe][\x40-\xfe])+$/;
    if (escape(temp).indexOf( "%u" )<0) return false ;
    return true ;
}

//删除股票代码
function clearStockCodes()
{
	$("#glgg").val('');
	
}
//删除关键词
function clearKey()
{
	$("#keywords").val('');
	
}
function checkForm()
{
	var typeid=$("#typeid");
	if(typeid)
	{
		if(typeid.val()=='')
		{
			alert("请选择类别");
			return false;
		}
	}
	var title=$("#title");
	if(title)
	{
		if(title.val().trim()=='')
		{
			alert("标题不能为空");
			return false;
		}
	}
	
	if(!editor.hasContents())
	{
		alert("内容不能为空");
			return false;
		
		
	}
		
	return true;
	
}

 String.prototype.trim=function(){
　　    return this.replace(/(^\s*)|(\s*$)/g, "");
　　 }
 String.prototype.ltrim=function(){
　　    return this.replace(/(^\s*)/g,"");
　　 }
String.prototype.rtrim=function(){
　　    return this.replace(/(\s*$)/g,"");
　　 }

//-->
</script>