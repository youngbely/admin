<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!doctype html>
<html style="height: auto;">
<head>
<meta charset="utf-8">
<title>中国首席财经</title>
<style type="text/css">
<!--
body {
	
	margin: 0;
	padding: 0;
    background-color: rgb(230,230,230);
	
}
ul, ol, dl { 
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	font-family:微软雅黑;
	margin-top: 0;	 /* 删除上边距可以解决边距会超出其包含的 div 的问题。剩余的下边距可以使 div 与后面的任何元素保持一定距离。 */
	padding-right: 15px;
	padding-left: 15px;
	 /* 向 div 内的元素侧边（而不是 div 自身）添加填充可避免使用任何方框模型数学。此外，也可将具有侧边填充的嵌套 div 用作替代方法。 */
}
p{
	
	line-height:25px;
	
}
a img { /* 此选择器将删除某些浏览器中显示在图像周围的默认蓝色边框（当该图像包含在链接中时） */
	border: none;
}

/* ~~ 站点链接的样式必须保持此顺序，包括用于创建悬停效果的选择器组在内。 ~~ */
a:link {
	color: #414958; /* 除非将链接设置成极为独特的外观样式，否则最好提供下划线，以便可从视觉上快速识别 */
	text-decoration: none;
}
a:visited {
	color: #4E5869;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* 此组选择器将为键盘导航者提供与鼠标使用者相同的悬停体验。 */
	text-decoration: none;
}



/* ~~ 标题未指定宽度。它将扩展到布局的完整宽度。标题包含一个图像占位符，该占位符应替换为您自己的链接徽标 ~~ */
.header {
	
	position:fixed;
	top:0px;
	left:0px;
	width:100%;
}
.header .title1{
	width:100%;
	height:40px;
	background-color: rgb(64,64,64);
	line-height:40px;
	color:#CCC;
	
}

.header .title2{
	width:100%;
	height:80px;
	background-color: rgb(255,254,247);
	padding:5px;
	-moz-box-shadow: 0px 2px 5px #757475;
	-webkit-box-shadow: 0px 2px 5px #757475;
	box-shadow: 0px 2px 5px   #BEBEBE;
}

.body {
  width: 1000px;
  margin: 0 auto;
  background-color: rgb(230,230,230);

}
.left {
	
  width: 710px;
  margin-right: 10px;
  float: left;
  min-height: 500px;	

}
.left .mainitem{
	width:100%;
	background-color:rgb(255,249,232);
	margin-bottom:10px;
	padding-top:30px;
	-moz-box-shadow: 3px 3px 7px #757475;
	-webkit-box-shadow: 3px 3px 7px #757475;
	box-shadow: 3px 3px 7px #757475;
}
.left .mainitem .top{
	height:30px;
	line-height:30px;

}

.left .mainitem .top .block{
	height:100%;
    width:8px; 
	background-color:#F00;
   float:left;
	
	
}


.left .item{
	

	width:100%;
	background-color:rgb(255,254,247);
	margin-bottom:10px;
	padding-top:5px;
	-moz-box-shadow: 3px 3px 7px #757475;
	-webkit-box-shadow: 3px 3px 7px #757475;
	box-shadow: 3px 3px 7px #757475;
	
	
}


.right{
	
	float:left;
	width:280px;



}

.apfix {
  position: fixed;
  top: 120px;
  width: 280px;
  height:400px;
}
.dir{

 width: 280px;
 height:400px;
 margin-top:5px;
 background-color:#FFF;
 -moz-box-shadow: 3px 3px 7px #757475;
 -webkit-box-shadow: 3px 3px 7px #757475;
 box-shadow: 3px 3px 7px #757475;
	
}
.dir ul{
	margin-left:5px;
	
 
	
}
.dir li{
	list-style-position: inside;
	list-style-type: square;
	font-family: 微软雅黑;	
}
.footer {
	background-color: rgb(66,66,66);
	width:100%;
	height:200px;
	clear:both;
	z-index:100;
	
	
}

.clearfloat { 
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
-->
</style></head>

<body>
<!--start header -->
<div class="header">
	<div class="title1" ><h5>*影响中国政策*</h5></div>
        <div class="title2"><img src="<?php echo $rk_assets_url; ?>images/zgsycj.png" width="469" height="70"><img src="<?php echo $rk_assets_url; ?>images/查看往期.png" width="16" height="16"></div>
</div>
<!--end header -->


<div  style="padding-top:150px;background-color: rgb(230,230,230);" >
	<div class="body">
		<div class="left">
			<div class="mainitem" ><div class="top"><div class="block"></div><h2>总编点评</h2></div>
            
            <div><h5 style=" color:#369">本期总编：<?php echo $data["zbdp"]["bqzb"] ?></h5></div>
            
            <div style=" border-bottom:#CCC 1px solid; height:5px; width:98%;margin: 0 auto;"></div>
            <div style="width:100%; padding:10px;"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data["zbdp"]["description"] ?></p>
            
            
            </div>
            
            
            </div>
            
						<div class="item" >
                        <div><h4 style="color:#F00; font-style:italic;">热点聚焦</h4></div>
                        <div style="height:1px; width:98%;margin: 0 auto; background-color:#F00; margin-bottom:25px; margin-top:-15px;"></div>
                        
                        <div style="line-height:30px;">
                        <div style="height:30px; width:8px; background-color:#F00; float:left;"></div><h2>三大运营商困局：前有微信堵截 后有苹果追击</h2></div>
            
            <div><h5 style=" color: #CCC">研究员：天天</h5></div>
            
            <div style=" border-bottom:#CCC 1px solid; height:5px; width:98%;margin: 0 auto;"></div>
            <div style="width:98%;  border:#CCC 1px solid;margin: 0 auto; margin-top:10px; background-color:#E8E8E8"><p>编者按：到南充市西充县人民医院就诊，因急性扁桃体炎需要住院治疗。在住院治疗期间，原本住的3人间病房，却被收取了2人间的费用。孩子输了两次液，留置针冲管却收取了6次的费用，另外，一次输液使用1个一次性空针，结算的清单上取了12个的费用。“没有量过体温，也收取了一支体温表的费用。”李波介绍，还有让他更吃惊的，医用透明胶布就收</p></div>
            <div style="width:100%; padding:10px;"><p>
            4月10日，李波带着一岁多的儿子到南充市西充县人民医院就诊，因急性扁桃体炎需要住院治疗。在住院治疗期间，原本住的3人间病房，却被收取了2人间的费用。孩子输了两次液，留置针冲管却收取了6次的费用，另外，一次输液使用1个一次性空针，结算的清单上取了12个的费用。“没有量过体温，也收取了一支体温表的费用。”李波介绍，还有让他更吃惊的，医用透明胶布就收取了两卷的费用，输个液能用两卷胶布吗？“这个收费清单真的是不看不知道，看了吓一跳，完全是坑人。”

让他不解的是，面对这样的情况，他找到医院，却没有给出一个合理的解释。“不能容忍这样的做法，如果有市民不识字的话，是不是这样就纵容医院欺骗患者呢？”李波说到，希望相关部门可以进行调查。 4月10日，李波带着一岁多的儿子到南充市西充县人民医院就诊，因急性扁桃体炎需要住院治疗。在住院治疗期间，原本住的3人间病房，却被收取了2人间的费用。孩子输了两次液，留置针冲管却收取了6次的费用，另外，一次输液使用1个一次性空针，结算的清单上取了12个的费用。“没有量过体温，也收取了一支体温表的费用。”李波介绍，还有让他更吃惊的，医用透明胶布就收取了两卷的费用，输个液能用两卷胶布吗？“这个收费清单真的是不看不知道，看了吓一跳，完全是坑人。”

让他不解的是，面对这样的情况，他找到医院，却没有给出一个合理的解释。“不能容忍这样的做法，如果有市民不识字的话，是不是这样就纵容医院欺骗患者呢？”李波说到，希望相关部门可以进行调查。 4月10日，李波带着一岁多的儿子到南充市西充县人民医院就诊，因急性扁桃体炎需要住院治疗。在住院治疗期间，原本住的3人间病房，却被收取了2人间的费用。孩子输了两次液，留置针冲管却收取了6次的费用，另外，一次输液使用1个一次性空针，结算的清单上取了12个的费用。“没有量过体温，也收取了一支体温表的费用。”李波介绍，还有让他更吃惊的，医用透明胶布就收取了两卷的费用，输个液能用两卷胶布吗？“这个收费清单真的是不看不知道，看了吓一跳，完全是坑人。”

让他不解的是，面对这样的情况，他找到医院，却没有给出一个合理的解释。“不能容忍这样的做法，如果有市民不识字的话，是不是这样就纵容医院欺骗患者呢？”李波说到，希望相关部门可以进行调查。</p>
            
            
            </div>
            
            
            </div>
            
		</div>
	<!--start right  -->
	<div class="right">
    <div style="position:fixed; top:150px; z-index:0">
		<div><img src="<?php echo $rk_assets_url; ?>images/zbdp.jpg" width="280" height="160"></div>
		<div class="dir">
       
        <div style=" border-bottom:1px #FF0000 solid; width:100%; height:35px; line-height:35px; margin-bottom:5px;"> <h4  style="color:#F00">本期目录</h4></div>
        <div style="overflow-y:scroll; height:350px;">
        <h5>【热点聚焦】</h5>
        <ul>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        </ul>
          <div style=" border-bottom:1px  #CCCCCC solid; width:98%;margin: 0 auto; margin-top:5px; margin-bottom:5px;"> </div>
          <h5>【热点聚焦】</h5>
        <ul>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        <li><a href="#" >还有让他更吃惊的</a></li>
        </ul>
        </div>
        </div>
    </div>
	</div>
	<!-- end right -->
    </div>

</div>


<div class="footer ">
    脚注
</div>
</body>
</html>
