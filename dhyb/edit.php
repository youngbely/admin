<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?php
ini_set("display_errors", "On");
error_reporting(E_ALL);

//echo '<pre>';
//print_r($_REQUEST);die;
/*$hostname = "221.232.160.242:1433";
$dbuser = "uts"; //用户名
$dbpasswd = "123456"; //密码

$data = array();//入库数据

//连接数据库
$db_id = mssql_connect($hostname,$dbuser,$dbpasswd) or die("无法连接数据库服务器！");
$db = mssql_select_db("stockinfo",$db_id) or die("无法连接数据库！");
$sql ="select * from [stockinfo].[dbo].[TOriginGrade] where StandardGrade='A'";
$res = mssql_query($sql);
while($row = mssql_fetch_assoc($res)){
    echo '<pre>';
    print_r($row);
}
die;*/

if($_GET['id']){
    $link = mysql_connect('localhost','root','123456');
    mysql_select_db('bolanadmin',$link);
    $sql = "select * from bl_dhyb where id={$_GET['id']}";
    $result = mysql_query($sql);
    $row=mysql_fetch_assoc($result);
    $title= $row['title'];//修改后的标题
    $title_rel= $row['title_rel'];//标题
    $shuffix = $row['shuffix'];//后缀
    $date1 = substr($title_rel,0,4);
    $date2 = substr($title_rel,4,2);
    $date3 = substr($title_rel,6,2);
    $date = $date1.'-'.$date2.'-'.$date3;
    $lanmu = $row['lanmu'];
    $OrganID = $row['OrganID'];
//    $types = $row['types'];
//    echo '<pre>';
//    print_r($row);die;

}else{
    echo '非法操作！';
    die;
}

 ?>

<title>Online View PDF</title>
<script type="text/javascript" src="http://sources.ikeepstudying.com/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="jquery.media.js"></script>
<script type="text/javascript">
    $(function() {
        $('a.media').media({width:886, height:800,});
    });
</script>
<!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
<style>
    body{
      background-color: #F9F9F9;
    }
    .all{
      font-family:微软雅黑;
    }
    .control-label{
      height:50px;
    }
    #sub{
        margin-top:-24px;
    }

</style>
</head>

<body>
<a class="media" href="../uploads/<?php echo $title_rel;?>" style="width:600px;"></a>
<div style="border: 1px solid #ccc;width:850px;height:800px;position: absolute;right: 10px;top:0px;padding: 20px 20px 0px 10px;" class="all">
    <!-- <form class="form-horizontal" role="form" id="form" action="www.baidu.com" method="post"> -->
    <form class="form-horizontal" role="form" action="function.php" method="post">


                    <fieldset>

<!--                      <legend>机构策略</legend>-->
                        <div class="form-group">
                           <label class="col-sm-2 control-label" >标题</label>
                           <div class="col-sm-10">
                              <input class="form-control" name="title" type="text" value="<?php echo $title;?>"/>
                           </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" >栏目</label>
                            <div class="col-sm-10">
                                <select  class="form-control" name="menu" id="menu">
                                    <option value="">---大行报告---</option>
                                    <option value="000_C556_C559_" <?php echo $lanmu=='机构策略'?'selected':'';?>>机构策略</option>
                                    <option value="000_C556_C560_" <?php echo $lanmu=='港股研报'?'selected':'';?>>港股研报</option>
                                    <option value="000_C556_C739_" <?php echo $lanmu=='外文研报'?'selected':'';?>>外文研报</option>
                                    <option value="000_C556_C738_" <?php echo $lanmu=='债券研报'?'selected':'';?>>债券研报</option>
                                    <option value="000_C556_C984_" <?php echo $lanmu=='权证市场'?'selected':'';?>>权证市场</option>
                                    <option value="000_C556_C4515_" <?php echo $lanmu=='融资融券'?'selected':'';?>>融资融券</option>
                                    <option value="000_C556_C558_" <?php echo $lanmu=='政策评析'?'selected':'';?>>政策评析</option>
                                    <option value="000_C556_C810_" <?php echo $lanmu=='海外市场'?'selected':'';?>>海外市场</option>
                                    <option value="000_C556_C557_" <?php echo $lanmu=='宏观经济'?'selected':'';?>>宏观经济</option>
                                    <option value="000_C556_C5488_" <?php echo $lanmu=='期权研究'?'selected':'';?>>期权研究</option>
                                    <option value="000_C556_C5481_" <?php echo $lanmu=='香港市场报告'?'selected':'';?>>香港市场报告</option>
                                    <option value="000_C556_C734_" <?php echo $lanmu=='基金报告'?'selected':'';?>>基金报告</option>
                                    <option value="000_C556_C735_" <?php echo $lanmu=='机构晨报'?'selected':'';?>>机构晨报</option>
                                    <option value="000_C556_C945_" <?php echo $lanmu=='新股研报'?'selected':'';?>>新股研报</option>
                                    <option value="000_C556_C3954_" <?php echo $lanmu=='创业板'?'selected':'';?>>创业板</option>
                                    <option value="000_C556_C731_" <?php echo $lanmu=='个股评级'?'selected':'';?>>个股评级</option>
                                    <option value="000_C556_C737_" <?php echo $lanmu=='股指期货'?'selected':'';?>>股指期货</option>
                                    <option value="000_C556_C5489_" <?php echo $lanmu=='新三板'?'selected':'';?>>新三板</option>
                                    <option value="000_C556_C1000_" <?php echo $lanmu=='期货研究(衍生工具)'?'selected':'';?>>期货研究(衍生工具)</option><!--19-->
                                    <option disabled></option>
                                    <option value="" disabled>---行业报告---</option>
                                    <option disabled></option>
                                    <option value="001_C58_" <?php echo $lanmu=='煤炭开采'?'selected':'';?>>煤炭开采</option>
                                    <option value="001_C105_" <?php echo $lanmu=='电力行业'?'selected':'';?>>电力行业</option>
                                    <option value="001_C102_" <?php echo $lanmu=='航空工业'?'selected':'';?>>航空工业</option>
                                    <option value="001_C1146_" <?php echo $lanmu=='家电行业'?'selected':'';?>>家电行业</option>
                                    <option value="001_C59_" <?php echo $lanmu=='钢铁行业'?'selected':'';?>>钢铁行业</option>
                                    <option value="001_C72_" <?php echo $lanmu=='化工行业'?'selected':'';?>>化工行业</option>
                                    <option value="001_C63_" <?php echo $lanmu=='食品饮料'?'selected':'';?>>食品饮料</option>
                                    <option value="001_C64_" <?php echo $lanmu=='酿酒行业'?'selected':'';?>>酿酒行业</option>
                                    <option value="001_C73_" <?php echo $lanmu=='农药化肥'?'selected':'';?>>农药化肥</option>
                                    <option value="001_C68_" <?php echo $lanmu=='家具行业'?'selected':'';?>>家具行业</option>
                                    <option value="001_C74_" <?php echo $lanmu=='化纤行业'?'selected':'';?>>化纤行业</option>
                                    <option value="001_C77_" <?php echo $lanmu=='水泥行业'?'selected':'';?>>水泥行业</option>
                                    <option value="001_C78_" <?php echo $lanmu=='玻璃陶瓷'?'selected':'';?>>玻璃陶瓷</option>
                                    <option value="001_C69_" <?php echo $lanmu=='造纸行业'?'selected':'';?>>造纸行业</option>
                                    <option value="001_C70_" <?php echo $lanmu=='印刷包装'?'selected':'';?>>印刷包装</option><!--15-->
<!--                                    001_C58_ 001_C105_ 001_C102_ 001_C1146_ 001_C59_ 001_C72_ 001_C63_ 001_C64_ 001_C73_ 001_C68_ 001_C74_ 001_C77_ 001_C78_ 001_C69_ 001_C70_  -->
                                    <option value="" disabled>|--金融行业</option>
                                    <option value="001_C134_C135_" <?php echo $lanmu=='银行业'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;银行业</option>
                                    <option value="001_C134_C136_" <?php echo $lanmu=='证券期货'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;证券期货</option>
                                    <option value="001_C134_C137_" <?php echo $lanmu=='保险业'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;保险业</option>
                                    <option value="001_C134_C138_" <?php echo $lanmu=='多元金融'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;多元金融</option>
<!--                                    001_C134_C135_ 001_C134_C136_ 001_C134_C137_ 001_C134_C138_-->
                                    <option value="" disabled>|--石油行业</option>
                                    <option value="001_C71_C1142_" <?php echo $lanmu=='石油开采'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;石油开采</option>
                                    <option value="001_C71_C1141_" <?php echo $lanmu=='石油加工'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;石油加工</option>
<!--                                    001_C71_C1142_ 001_C71_C1141_-->
                                    <option value="" disabled>|--交通运输</option>
                                    <option value="001_C103_C104_" <?php echo $lanmu=='运输设备'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;运输设备</option>
                                    <option value="001_C103_C116_" <?php echo $lanmu=='铁路运输'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;铁路运输</option>
                                    <option value="001_C103_C117_" <?php echo $lanmu=='高速公路'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;高速公路</option>
                                    <option value="001_C103_C119_" <?php echo $lanmu=='水上运输'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;水上运输</option>
                                    <option value="001_C103_C120_" <?php echo $lanmu=='港口'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;港口</option>
                                    <option value="001_C103_C121_" <?php echo $lanmu=='航空运输'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;航空运输</option>
                                    <option value="001_C103_C122_" <?php echo $lanmu=='物流管理'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;物流管理</option>
<!--                                    001_C103_C104_ 001_C103_C116_ 001_C103_C117_ 001_C103_C119_ 001_C103_C120_ 001_C103_C121_ 001_C103_C122_-->
                                    <option value="" disabled>|--供水供气</option>
                                    <option value="001_C107_C109_" <?php echo $lanmu=='供水'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;供水</option>
                                    <option value="001_C107_C108_" <?php echo $lanmu=='供气'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;供气</option>
<!--                                    001_C107_C109_ 001_C107_C108_-->
                                    <option value="" disabled>|--电子信息</option>
                                    <option value="001_C123_C1151_" <?php echo $lanmu=='通信服务'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;通信服务</option>
                                    <option value="001_C123_C124_" <?php echo $lanmu=='通信设备'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;通信设备</option>
                                    <option value="001_C123_C125_" <?php echo $lanmu=='计算机'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计算机</option>
                                    <option value="001_C123_C126_" <?php echo $lanmu=='电子器件'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电子器件</option>
                                    <option value="001_C123_C128_" <?php echo $lanmu=='软件业'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;软件业</option>
<!--                                    001_C123_C1151_ 001_C123_C124_ 001_C123_C125_ 001_C123_C126_ 001_C123_C128_-->
                                    <option value="" disabled>|--商业贸易</option>
                                    <option value="001_C129_C131_" <?php echo $lanmu=='零售业'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;零售业</option>
                                    <option value="001_C129_C132_" <?php echo $lanmu=='贸易综合'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;贸易综合</option>
<!--                                    001_C129_C131_ 001_C129_C132_-->
                                    <option value="" disabled>|--房地产业</option>
                                    <option value="001_C139_C1143_" <?php echo $lanmu=='房产开发'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;房产开发</option>
<!--                                    001_C139_C1143_-->
                                    <option value="" disabled>|--有色行业</option>
                                    <option value="001_C61_C719_" <?php echo $lanmu=='有色冶炼'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;有色冶炼</option>
                                    <option value="001_C61_C62_" <?php echo $lanmu=='有色矿采'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;有色矿采</option>
<!--                                    001_C61_C719_ 001_C61_C62_-->
                                    <option value="" disabled>|--机械行业</option>
                                    <option value="001_C91_C1030_" <?php echo $lanmu=='船舶业'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;船舶业</option>
                                    <option value="001_C91_C713_" <?php echo $lanmu=='通用机械'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;通用机械</option>
                                    <option value="001_C91_C92_" <?php echo $lanmu=='专用机械'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;专用机械</option>
                                    <option value="001_C91_C93_" <?php echo $lanmu=='电气机械'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电气机械</option>
<!--                                    001_C91_C1030_ 001_C91_C713_ 001_C91_C92_ 001_C91_C93_-->
                                    <option value="" disabled>|--酒店旅游</option>
                                    <option value="001_C141_C142_" <?php echo $lanmu=='旅游饭店'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;旅游饭店</option>
                                    <option value="001_C141_C144_" <?php echo $lanmu=='旅游景区'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;旅游景区</option>
<!--                                    001_C141_C142_ 001_C141_C144_-->
                                    <option value="" disabled>|--农林牧渔</option>
                                    <option value="001_C53_C54_" <?php echo $lanmu=='种植'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;种植</option>
                                    <option value="001_C53_C56_" <?php echo $lanmu=='畜牧'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;畜牧</option>
<!--                                    001_C53_C54_ 001_C53_C56_-->
                                    <option value="" disabled>|--纺织行业</option>
                                    <option value="001_C65_C66_" <?php echo $lanmu=='纺织印染'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;纺织印染</option>
                                    <option value="001_C65_C67_" <?php echo $lanmu=='服装鞋类'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;服装鞋类</option>
                                    <option value="001_C65_C716_" <?php echo $lanmu=='纺织机械'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;纺织机械</option>
<!--                                    001_C65_C66_ 001_C65_C67_ 001_C65_C716_-->
                                    <option value="" disabled>|--生物医药</option>
                                    <option value="001_C87_C1147_" <?php echo $lanmu=='医药制造'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;医药制造</option>
                                    <option value="001_C87_C88_" <?php echo $lanmu=='医疗器械'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;医疗器械</option>
<!--                                    001_C87_C1147_ 001_C87_C88_-->
                                    <option value="" disabled>|--建筑建材</option>
                                    <option value="001_C113_C1149_" <?php echo $lanmu=='建材产品'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;建材产品</option>
                                    <option value="001_C113_C751_" <?php echo $lanmu=='土木工程'?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;土木工程</option><!--40-->
<!--                                    001_C113_C1149_ 001_C113_C751_-->

                                </select>
                            </div>
                        </div>

                        <input  name="CreateTimeID" type="hidden" value="<?php echo date('Y-m-d H:i:s')?>"/>
                        <input  name="id" type="hidden" value="<?php echo $row['id']?>"/>
                        <input  name="hash" type="hidden" value="<?php echo $_GET['pc_hash']?>"/>
                        <input  name="lanmu" type="hidden" value="<?php echo $_GET['lanmu']?>"/>
                        <input  name="cjr" type="hidden" value="<?php echo $_GET['cjr']?>"/>
                        <input  name="title_rel" type="hidden" value="<?php echo $title_rel?>"/>
                        <input  name="shuffix" type="hidden" value="<?php echo $shuffix?>"/>


                       <div class="form-group">
                          <label class="col-sm-2 control-label" for="ds_name">撰写日期</label>
                          <div class="col-sm-4">
                             <input class="form-control" name="date" type="date" value="<?php echo $date;?>"/>
                          </div>

                          <label class="col-sm-2 control-label" for="ds_name">撰写时间</label>
                          <div class="col-sm-4">
                             <input class="form-control" name="time" type="time" value="<?php echo date('Y-m-d H:i:s')?>"/>
                          </div>
                       </div>

                       <div class="form-group">
                          <label class="col-sm-2 control-label" for="ds_host">原文作者</label>
                          <div class="col-sm-4">
                             <input class="form-control" name="Author"  type="text" value="<?php echo $row['Author']?>"/>
                          </div>

                          <label class="col-sm-2 control-label" for="ds_name">执业证号</label>
                          <div class="col-sm-4">
                             <input class="form-control" name="Authorzhiyehao" type="text" value="<?php echo $row['Authorzhiyehao']?>"/>
                          </div>
                       </div>


                       <div class="form-group">
                           <label class="col-sm-2 control-label">最低目标</label>
                           <div class="col-sm-4">
                              <input class="form-control" name="AimPrice1" type="text" value="<?php echo $row['AimPrice1']=='0.00'?'':$row['AimPrice1'];?>"/>
                           </div>

                           <label class="col-sm-2 control-label">最高目标</label>
                           <div class="col-sm-4">
                              <input class="form-control" name="AimPrice2" type="text" value="<?php echo $row['AimPrice2']=='0.00'?'':$row['AimPrice2'];?>"/>
                           </div>

                        </div>
                    </fieldset>


                    <fieldset style="padding-bottom:15px;">

                        <div class="form-group">
                           <label class="col-sm-2 control-label">摘要</label>
                           <div class="col-sm-10">
                              <textarea class="form-control" rows="3" name="Intro" id="Intro"><?php echo $row['Intro']?></textarea>
                           </div>
                        </div>
                    </fieldset>


                    <fieldset>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">研究机构</label>
                            <div class="col-sm-10">
                                <!--<select  class="form-control" name="OrganID" id="OrganID">
                                            <?php
                                /*//                                $hostname = "221.232.160.242:1433";
                                //                                $dbuser = "uts"; //用户名
                                //                                $dbpasswd = "123456"; //密码
                                //
                                //                                $data = array();//入库数据
                                //
                                //                                //连接数据库
                                //                                $db_id = mssql_connect($hostname,$dbuser,$dbpasswd) or die("无法连接数据库服务器！");
                                //                                $db = mssql_select_db("stockinfo",$db_id) or die("无法连接数据库！");
                                                                //$sql ="select * from TOrgan where Type='A' order by organname  desc";
                                                                $sql ="SELECT OrganID,OrganName FROM TOrgan WHERE Type ='A' order by convert(`OrganName` using gbk) desc";
                                                                $res = mysql_query($sql);
                                                                while($rows = mysql_fetch_assoc($res)){
                                                                    $OrganName = $rows['OrganName'];
                                                                    if ($OrganID==$rows['OrganID']) {
                                                                        echo "<option value='{$rows['OrganID']}' selected>&nbsp;&nbsp;&nbsp;&nbsp;{$OrganName}</option>";
                                                                    } else {
                                                                        echo "<option value='{$rows['OrganID']}' >&nbsp;&nbsp;&nbsp;&nbsp;{$OrganName}</option>";
                                                                    }
                                                                }

                                                                */?>

                                        </select>-->
                                <?php
                                $sql_l ="select OrganName from TOrgan where OrganID='{$OrganID}'";
                                $res_l = mysql_query($sql_l);
                                $row_l = mysql_fetch_assoc($res_l);
                                $OrganName = $row_l['OrganName'];

                                ?>
                                <input type="text" class="form-control" name="OrganID" value="<?php echo $OrganName;?>">
                            </div>
                        </div>
                    </fieldset>

                    <fieldset style="height:64px;">
                        <div class="form-group">
                           <label class="col-sm-2 control-label">证券代码</label>
                           <div class="col-sm-10">

                                <!-- <a><span class="form-control-feedback">提取</span></a> -->
                                <input type="text" class="form-control" id="StockCode" name="StockCode" value="<?php echo $row['StockCode']?>">

　　<span id='tiqu1' style="display:inline-block;border:0px solid red;position:absolute;right:20px;top:8px;z-index:100;cursor: pointer;color:#888;">| 提取</span>
                           </div>
                        </div>
                    </fieldset>

        <script type="text/javascript">
//            $('#tiqu1').click(function(){
//                var tiqu1 = $('input[name=title]').val();
//                $.ajax({
//                    url:'tiqu1.php',
//                    type:'post',
//                    dataType:'json',
//                    async:true,
//                    data:{tiqu1:tiqu1},
//                    success:function(data){
//                        $('input[name=StockCode]').val(data);
//                    },
//                    error:function(){
//                        alert('提取失败，请手动填写');
//                    },
//                    timeout:2000,
//                })
//            });
            $('#tiqu1').click(function() {
                var reg = /-(\d{6}).S/;
                var str = $('input[name=title]').val();
//                var str = "20160919-天风证券-骅威文化-002502.SZ-创新机制消化激励风险，协同共推IP运营";
                            if(reg.test(str)){
                $('input[name=StockCode]').val(RegExp.$1);
//                                alert(RegExp.$1);
//                                return;
                            }
            });

        </script>


                    <fieldset style="height:64px;">
                        <div class="form-group">
                           <label class="col-sm-2 control-label">关键词</label>
                           <div class="col-sm-10">

                                <!-- <a><span class="form-control-feedback">提取</span></a> -->
                                <input type="text" class="form-control" id="keyword" name="keyword" value="<?php echo $row['keyword']?>" placeholder='多个关键词请用中文逗号隔开'>

<!--　　<span id='tiqu2' style="display:inline-block;border:0px solid red;position:absolute;right:20px;top:8px;z-index:100;cursor: pointer;color:#888;">| 提取</span>-->
                           </div>
                        </div>
                    </fieldset>




                    <fieldset>

                        <div class="form-group">
                           <label class="col-sm-2 control-label">评级</label>
                           <div class="col-sm-10">
                              <select  class="form-control" name="IDGrade">
                                  <?php
                                  $sql = "select OriginGradeID from bl_dhyb where id={$_GET['id']}";
                                  $res = mysql_query($sql);
                                  while($row = mysql_fetch_assoc($res)){
                                      $pj = $row['OriginGradeID'];
                                  }

                                  ?>
                                  <option value="999" <?php echo empty($pj)?'selected':''?>></option>
                                  <option value="29_0" <?php echo $pj==29?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;无评级</option>
                                  <option value="" disabled>|--推荐</option>
                                  <?php
                                      $sql ="select * from TOriginGrade where StandardGrade='A'";
                                      $res = mysql_query($sql);
                                      while($row = mysql_fetch_assoc($res)){
                                          $GradeName = $row['GradeName'];
                                          if($pj == $row['OriginGradeID']) {
                                              echo "<option value='{$row['OriginGradeID']}_{$row['StandardGrade']}' selected>&nbsp;&nbsp;&nbsp;&nbsp;{$GradeName}</option>";
                                          }else{
                                              echo "<option value='{$row['OriginGradeID']}_{$row['StandardGrade']}' >&nbsp;&nbsp;&nbsp;&nbsp;{$GradeName}</option>";
                                          }
                                      }
                                  ?>

                                  <option value="" disabled>|--增持</option>
                                  <?php
                                  $sql ="select * from TOriginGrade where StandardGrade='B'";
                                  $res = mysql_query($sql);
                                  while($row = mysql_fetch_assoc($res)){
                                      $GradeName = $row['GradeName'];
                                      if($pj == $row['OriginGradeID']) {
                                          echo "<option value='{$row['OriginGradeID']}_{$row['StandardGrade']}' selected>&nbsp;&nbsp;&nbsp;&nbsp;{$GradeName}</option>";
                                      }else{
                                          echo "<option value='{$row['OriginGradeID']}_{$row['StandardGrade']}' >&nbsp;&nbsp;&nbsp;&nbsp;{$GradeName}</option>";
                                      }
                                  }
                                  ?>

                                  <option value="" disabled>|--持有</option>
                                  <?php
                                  $sql ="select * from TOriginGrade where StandardGrade='C'";
                                  $res = mysql_query($sql);
                                  while($row = mysql_fetch_assoc($res)){
                                      $GradeName = $row['GradeName'];
                                      if($pj == $row['OriginGradeID']) {
                                          echo "<option value='{$row['OriginGradeID']}_{$row['StandardGrade']}' selected>&nbsp;&nbsp;&nbsp;&nbsp;{$GradeName}</option>";
                                      }else{
                                          echo "<option value='{$row['OriginGradeID']}_{$row['StandardGrade']}' >&nbsp;&nbsp;&nbsp;&nbsp;{$GradeName}</option>";
                                      }
                                  }
                                  ?>

                                  <option value="" disabled>|--买入</option>
                                  <?php
                                  $sql ="select * from TOriginGrade where StandardGrade='E'";
                                  $res = mysql_query($sql);
                                  while($row = mysql_fetch_assoc($res)){
                                      $GradeName = $row['GradeName'];
                                      if($pj == $row['OriginGradeID']) {
                                          echo "<option value='{$row['OriginGradeID']}_{$row['StandardGrade']}' selected>&nbsp;&nbsp;&nbsp;&nbsp;{$GradeName}</option>";
                                      }else{
                                          echo "<option value='{$row['OriginGradeID']}_{$row['StandardGrade']}' >&nbsp;&nbsp;&nbsp;&nbsp;{$GradeName}</option>";
                                      }
                                  }
                                  ?>

                                  <option value="" disabled>|--中性</option>
                                  <?php
                                  $sql ="select * from TOriginGrade where StandardGrade='G'";
                                  $res = mysql_query($sql);
                                  while($row = mysql_fetch_assoc($res)){
                                      $GradeName = $row['GradeName'];
                                      if($pj == $row['OriginGradeID']) {
                                          echo "<option value='{$row['OriginGradeID']}_{$row['StandardGrade']}' selected>&nbsp;&nbsp;&nbsp;&nbsp;{$GradeName}</option>";
                                      }else{
                                          echo "<option value='{$row['OriginGradeID']}_{$row['StandardGrade']}' >&nbsp;&nbsp;&nbsp;&nbsp;{$GradeName}</option>";
                                      }
                                  }
                                  ?>

                                  <option value="" disabled>|--减持</option>
                                  <?php
                                  $sql ="select * from TOriginGrade where StandardGrade='H'";
                                  $res = mysql_query($sql);
                                  while($row = mysql_fetch_assoc($res)){
                                      $GradeName = $row['GradeName'];
                                      if($pj == $row['OriginGradeID']) {
                                          echo "<option value='{$row['OriginGradeID']}_{$row['StandardGrade']}' selected>&nbsp;&nbsp;&nbsp;&nbsp;{$GradeName}</option>";
                                      }else{
                                          echo "<option value='{$row['OriginGradeID']}_{$row['StandardGrade']}' >&nbsp;&nbsp;&nbsp;&nbsp;{$GradeName}</option>";
                                      }
                                  }
                                  ?>
                                  <!--<option value="3">&nbsp;&nbsp;&nbsp;&nbsp;长期推荐</option>
                                  <option value="11">&nbsp;&nbsp;&nbsp;&nbsp;谨慎推荐</option>
                                  <option value="18">&nbsp;&nbsp;&nbsp;&nbsp;跑赢大市</option>
                                  <option value="20">&nbsp;&nbsp;&nbsp;&nbsp;强烈推荐</option>
                                  <option value="22">&nbsp;&nbsp;&nbsp;&nbsp;强烈推荐A</option>
                                  <option value="23">&nbsp;&nbsp;&nbsp;&nbsp;强烈推荐-B</option>
                                  <option value="30">&nbsp;&nbsp;&nbsp;&nbsp;一般推荐</option>
                                  <option value="3">&nbsp;&nbsp;&nbsp;&nbsp;长期推荐</option>
                                  <option value="28">&nbsp;&nbsp;&nbsp;&nbsp;推荐投资</option>
                                  <option value="1">&nbsp;&nbsp;&nbsp;&nbsp;长期竞争力</option>
                                  <option value="18">&nbsp;&nbsp;&nbsp;&nbsp;跑赢大市</option>
                                  <option value="38">&nbsp;&nbsp;&nbsp;&nbsp;收集</option>
                                  <option value="4">&nbsp;&nbsp;&nbsp;&nbsp;超强大市</option>
                                  <option value="44">&nbsp;&nbsp;&nbsp;&nbsp;领先大市</option>
<!--                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;超配评级</option>
<!--                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;优异</option>
                                  <option value="" disabled>|--增持</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;增持</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;增持-A</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;增持-B</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;谨慎增持</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;优于大市</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;强于大市</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;看好</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;审慎推荐</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;审慎推荐-A</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;谨慎推荐</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;审慎推荐-B</option>
                                  <option value="" disabled>|--买入</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;买入</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;买入-A</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;买入-B</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;强力买入</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;强烈买入</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;谨慎买入</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;有吸引力</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;确信买入</option>
                                  <option value="" disabled>|--减持</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;减持</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;落后大市</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;看淡</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;弱于大市</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;跑输大市</option>
                                  <option value="" disabled>|--中性</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;中性-A</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;中性</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;同步大市</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;大市同步</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;观望</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;中立</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;中性-B</option>
                                  <option value="" disabled>|--持有</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;持有</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;谨慎持有</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;跟随大市</option>
                                  <option value="" disabled>|--卖出</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;卖出</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;回避</option>
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;强烈卖出</option>-->
                              </select>
                           </div>
                        </div>
                    </fieldset>

                    <fieldset>

                        <div class="form-group">
                           <label class="col-sm-2 control-label">评级变动</label>
                           <div class="col-sm-10">
                              <select  class="form-control" name="Vary">
                                  <?php
                                    $sql = "select Vary from bl_dhyb where id={$_GET['id']}";
                                    $res = mysql_query($sql);
                                    while($row = mysql_fetch_assoc($res)){
                                        $bd = $row['Vary'];
                                    }

                                  ?>
                                  <option value="5" <?php /*echo empty($bd)?'selected':''*/?>></option>
                                  <option value="0" <?php echo $bd===0?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;首次</option>
                                  <option value="1" <?php echo $bd===1?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;维持</option>
                                  <option value="2" <?php echo $bd===2?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;调升</option>
                                  <option value="3" <?php echo $bd===3?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;调降</option>
                              </select>
                           </div>
                        </div>
                    </fieldset>
                    <!-- <input type="submit" class="btn btn-default btn-block btn-lg" style="float:right;width:30%;" id="sub"> -->
                    <!-- <input type="submit" value="提交" class="btn btn-default btn-block btn-lg" style="float:right;width:30%;"> -->
                     <button type="submit" class="btn btn-default btn-block btn-lg"  id="sub" style="float:right;width:30%;">保存</button>
                </form>
</div>

<script type="text/javascript">
    $('#sub').click(function(){
        var menu = $('#menu').val();
        if( menu.length <= 0){
            alert('请选择栏目！');
            return false;
        }

        var StockCode = $('#StockCode').val();
        var keyword = $('#keyword').val();
        if(StockCode.length>0 && keyword.length<=0){
            alert('请请填写关键词！');
            return false;
        }


        /*     分析师名单 必填摘要过滤     */
         //宏观经济 政策评析 海外市场
        var Author = $('input[name=Author]').val();//作者
        var lm = $('#menu').val();//栏目
        var jigou = $('#OrganID').val();//研究机构
        var zy =  $('#Intro').val();//摘要
        var arrA_1=["曹阳","陈勇","陆玲玲","陈勇","董利","高群山","顾潇啸","管清友","郭磊","华中炜","姜超","李慧勇","李一民","卢燕津","孟祥娟","牛播坤","任泽平","孙稳存","王涵","韦志超","谢伟玉","余芽芳","袁丽淇","张媛","钟正生","诸建芳"];
        var arrA_2=["000_C556_C557_","000_C556_C558_","000_C556_C810_"];
        if($.inArray(Author, arrA_1)!==-1 && $.inArray(lm, arrA_2)!==-1 && zy.length==0){
            alert('请填写摘要');
            return false;
        }

         //机构策略
        var arrB_1=["程定华","戴康","邓二勇","范妍","胡瑞丽","江金凤","蒋仕卿","林丽梅","刘名斌","乔永远","王德伦","王胜","王旭","吴邦栋","吴峰","谢伟玉","徐彪","荀玉根","姚卫巍","张忆东","诸海滨","白洋","陈虎","陈筱","顾佳","李竹君","刘华峰","刘佳宁","孟玮","孙金霞","王京乐","王禹媚","文浩","许彬","薛婷婷","杨琳琳","杨仁文","杨文硕","张杰伟","张洁","张良卫","赵宇杰","曾朵红","方重寅","房青","谷琦彬","胡毅","黄守宏","李大军","刘波","刘俊廷","刘骁","马军","牛品","沈成","苏旺兴","王静","王帅","邬博华","武雯","武夏","邢达","杨培龙","游家训","张俊","张文博","张垚","周旭辉","车玺","崔霖","冯大军","谷风","郭丽丽","侯鹏","刘晓宁","彭全刚","王海旭","王威","吴非","肖扬","徐闯","叶旭晨","张赫黎","邹序元","陈平","董瑞斌","段迎晟","韩林","郝蕾","黄瑜","蒯剑","林照天","刘亮","刘翔","卢山","卢文汉","马鹏清","秦媛媛","邵洁","孙远峰","王国勋","王少勃","文仲阳","许兴军","鄢凡","张帆","张振","赵晓光","郑震湘","陈聪","陈慎","丁明","付瑜","郭镇","侯丽科","贾亚童","金山","乐加栋","李品科","刘璐","潘玮","申思聪","苏雪晶","孙建平","涂力磊","谢盐","阎常铭","赵强","顾柔刚","花小伟","鞠兴海","李婕","刘义","马莉","孙妤","唐爽爽","汪蓉","王立平","王薇","谢宁铃","薛缘","杨岚","鲍雁辛","曾豪","邓云程","范超","范佳瓅","黄诗涛","黄涛","李华丰","刘彬","邱友锋","田东红","王晶晶","王丽妍","王愫","谢璐","邹戈","曹恒乾","陈莹","丁文韬","郭晓露","洪锦屏","李聪","李欣","刘义","罗毅","彭玉龙","孙婷","王宇航","魏涛","吴绪越","吴续越","熊林","张黎","张龙","赵湘怀","陈文敏","笃慧","冯刚勇","郭皓","兰杰","李莎","刘彦奇","刘元瑞","邱祖学","任志强","王鹤涛","王招华","曾凡","车玺","陈青青","陈子坤","崔霖","郭鹏","侯鹏","彭全刚","邵琳琳","沈涛","汪洋","王海旭","王威","吴非","肖扬","徐强","张晨","朱纯阳","陈显帆","高嵩","胡宇飞","李佳","刘海博","刘军","龙华","吕娟","秦瑞","邱世梁","王帆","王浩","王华君","王书伟","吴凯","肖群稀","熊哲颖","徐志国","薛小波","张宇","张仲杰","章诚","周栎伟","邹润芳","曹令","曹小飞","陈鹏","程磊","邓建","郭敏","李明刚","刘刚","刘威","刘曦","毛伟","孙琦祥","王剑雨","王席鑫","吴锡雄","吴钊华","向禹辰","徐留明","袁善宸","张瑞","郑方镳","周南","周小波","周铮","陈美风","段迎晟","冯达","符健","高宏博","郭雅丽","胡又文","黄焜","惠毓伦","蒋佳霖","蒋科","康健","李晶","刘雪峰","刘洋","刘智","马先文","沈海兵","汤旸玚","王伟","王喆","易欢欢","尹沿技","张晓薇","赵国栋","郑宏达","蔡雯娟","曾婵","范杨","郝雪梅","胡雅丽","纪敏","金星","林寰宇","刘军","阮玮仕","王念春","徐春","袁浩然","张立聪","周海晨"];
        var arrB_2=["000_C556_C559_"];
        if($.inArray(Author, arrB_1)!==-1 && $.inArray(lm, arrB_2)!==-1 && zy.length==0){
            alert('请填写摘要');
            return false;
        }

        //行业报告 个股评级 创业板 新股研报
        var arrC_1=["鲍荣富","傅盈","陆玲玲","唐笑","王建","夏天","杨涛","张琎","张琨","张显宁","赵健","曾旭","龚里","姜明","凌军","刘攀","刘正","糜怀清","瞿永忠","苏宝亮","王品辉","王滔","谢平","杨志清","虞楠","岳鑫","张亮","张晓云","郑武","周俊","朱峰","冯福章","傅楚雄","高嵩","高晓春","鞠厚林","李良","梁铮","王天一","肖婵","原丁","原瑞政","张润毅","周栎伟","安鹏","陈超","郭鹏","韩振国","孔微微","李俊松","刘建刚","刘晓宁","卢平","沈涛","史江辉","万炜","王祎佳","吴杰","张顺","郑思恩","陈娇","丁频","宫衍海","蒋卫华","蒋小东","林隽婕","刘洋","刘哲铭","盛夏","施亮","吴立","夏木","谢刚","张婧","张俊宇","赵金厚","樊俊豪","郭海燕","洪涛","李宏科","林浩然","刘章明","路颖","欧亚菲","钱炳","孙洋","唐佳睿","童兰","汪立亭","赵雪芹","周羽","訾猛","蔡麟琳","陈建翔","陈俊斌","陈政","崔书田","戴卡娜","邓学","杜中明","方小坚","高登","廖瀚博","唐楠","汪刘胜","王炎学","许宏图","许英博","杨华超","张乐","赵晨曦","丁智艳","花小伟","李宏鹏","李音临","雒雅梅","穆方舟","濮冬燕","申烨","屠亦婷","王峰","王婉婷","吴冉劼","郑恺","周海晨","曾光","陈冬龙","陈均峰","姜娅","旷实","李跃博","刘璐丹","王玥","许娟娟","钟潇","郭荆璞","胡昂","黄莉莉","麦土荣","裘孝锋","荣沉","王强","王晓林","肖洁","张樨樨","陈梦瑶","董广阳","董俊峰","胡春霞","黄付生","黄巍","柯海东","李琰","林园远","刘洁铭","刘鹏","龙隽","卢文琳","吕昌","马浩博","童驯","王永锋","闻宏伟","薛玉虎","杨勇胜","于杰","张萍","周雅洁","周颖","陈剑","陈志坚","程成","戴春荣","樊鹏","胡路","李伟","李亚军","刘博生","马军","束海峰","王浩冰","王念春","吴友文","武超则","郑帮强","周军","朱劲松","曹阳","崔文亮","邓晓倩","邓周宇","丁丹","董凯","贺菊颖","贺平鸽","胡博新","黄春逢","黄挺","李晗","李敬雷","李珊珊","李少思","林柏川","邱冠华","屠炜颖","吴斌","吴雅春","项军","徐佳熹","徐列海","燕智","余方升","余文心","张明芳","张其立","张同","周锐","戴志锋","黄春逢","黄耀锋","李晗","励雅敏","刘瑞","罗毅","马鲲鹏","邱冠华","王一峰","王宇轩","肖斐斐","肖立强","朱琰","蔡鼎尧","葛军","衡昆","巨国贤","刘博","彭波","齐丁","桑永亮","施毅","宋小庆","孙亮","王一川","吴怡平","谢鸿鹤","熊文静","徐若旭","徐张红","杨诚笑","叶培培","钟奇"];
        var arrC_2=["000_C556_C945_","000_C556_C3954_","000_C556_C731_","001_C58_", "001_C105_", "001_C102_", "001_C1146_", "001_C59_", "001_C72_", "001_C63_", "001_C64_", "001_C73_", "001_C68_", "001_C74_", "001_C77_", "001_C78_", "001_C69_", "001_C70_","001_C134_C135_", "001_C134_C136_", "001_C134_C137_", "001_C134_C138_","001_C71_C1142_", "001_C71_C1141_","001_C103_C104_", "001_C103_C116_", "001_C103_C117_", "001_C103_C119_", "001_C103_C120_", "001_C103_C121_", "001_C103_C122_", "001_C107_C109_", "001_C107_C108_","001_C123_C1151_", "001_C123_C124_", "001_C123_C125_", "001_C123_C126_", "001_C123_C128_","001_C129_C131_", "001_C129_C132_","001_C139_C1143_","001_C61_C719_", "001_C61_C62_","001_C91_C1030_", "001_C91_C713_", "001_C91_C92_", "001_C91_C93_","001_C141_C142_", "001_C141_C144_","001_C53_C54_", "001_C53_C56_","001_C65_C66_", "001_C65_C67_", "001_C65_C716_","001_C87_C1147_", "001_C87_C88_","001_C113_C1149_", "001_C113_C751_"];
        if($.inArray(Author, arrC_1)!==-1 && $.inArray(lm, arrC_2)!==-1 && zy.length==0){
            alert('请填写摘要');
            return false;
        }

        //衍生工具 股指期货 权证市场 期权研究 融资融券     华泰期货 南华期货
        var arrD_1=["吴先兴","任瞳","高子剑","于明明","覃川桃","丁一","陶勤英","叶涛"];
        var arrD_2=["000_C556_C1000_","000_C556_C737_","000_C556_C984_","000_C556_C5488_","000_C556_C4515_"];
        var arrD_3=["O00020869","O00020338"];
        if($.inArray(Author, arrD_1)!==-1 && $.inArray(lm, arrD_2)!==-1 && zy.length==0){
            alert('请填写摘要');
            return false;
        }

        if($.inArray(lm, arrD_2)!==-1 && $.inArray(jigou, arrD_3)!==-1 && zy.length==0){
            alert('请填写摘要');
            return false;
        }

        //基金报告 债券研报     海通证券
        var arrE_2=["000_C556_C734_","000_C556_C738_"];
        var arrE_3=["O00020101"];
        if($.inArray(lm, arrE_2)!==-1 && $.inArray(jigou, arrE_3)!==-1 && zy.length==0){
            alert('请填写摘要');
            return false;
        }
    });
</script>
</body>
</html>






<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" dir="ltr">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Online View PDF</title>
<script type="text/javascript" src="http://sources.ikeepstudying.com/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="jquery.media.js"></script>
<script type="text/javascript">
    $(function() {
        $('a.media').media({width:800, height:600});
    });
</script>
</head>

<body>
<a class="media" href="guice.pdf">PDF File</a>
</body>
</html>   -->