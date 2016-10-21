<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>

<html>
<head>
    <meta charset='utf-8'>
    <title></title>
<!--    <script src="jquery.min.js" type="text/javascript"></script>-->
    <script type="text/javascript" src="jquery.uploadify-3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="uploadify.css"/>
<!--    <script type="text/javascript">-->
<!--        var img_id_upload=new Array();//初始化数组，存储已经上传的图片名-->
<!--        var i=0;//初始化数组下标-->
<!--        $(function() {-->
<!--            $('#file_upload').uploadify({-->
<!--                'auto'     : false,//关闭自动上传-->
<!--                'removeTimeout' : 1,//文件队列上传完成1秒后删除-->
<!--                'swf'      : 'uploadify.swf',-->
<!--                'uploader' : 'uploadify.php',-->
<!--                'method'   : 'post',//方法，服务端可以用$_POST数组获取数据-->
<!--                'path'-->
<!--                'buttonText' : '选择机构策略pdf文件',//设置按钮文本-->
<!--                'multi'    : true,//允许同时上传多张图片-->
<!--                'uploadLimit' : 50,//一次最多只允许上传10张图片-->
<!--                'fileTypeDesc' : 'PDF only!',//只允许上传图像-->
<!--                'fileTypeExts' : '*.pdf',//限制允许上传的图片后缀-->
<!--                'fileSizeLimit' : '20000KB',//限制上传的图片不得超过20000KB-->
<!--                'onUploadSuccess' : function(file, data, response) {//每次成功上传后执行的回调函数，从服务端返回数据到前端-->
<!--                    img_id_upload[i]=data;-->
<!--                    i++;-->
<!--//			   alert(data);-->
<!--                },-->
<!--                'onQueueComplete' : function(queueData) {//上传队列全部完成后执行的回调函数-->
<!--                    // if(img_id_upload.length>0)-->
<!--//            alert('成功上传的文件有：'+encodeURIComponent(img_id_upload));-->
<!--                    alert('上传成功！');-->
<!--//                    location.replace(location.href);-->
<!--                }-->
<!--                // Put your options here-->
<!--            });-->
<!--        });-->
<!--    </script>-->
    <style>
        .subnav {
            display:none;
        }
        .uploadify{
            margin-top:10px;
        }
        .aa {
            line-height:30px;
            height:30px;
            width:120px;
            color:#777777;
            background-color:#ededed;
            font-size:12px;
            font-weight:normal;
            font-family:Arial;
            background:-webkit-gradient(linear, left top, left bottom, color-start(0.05, #ededed), color-stop(1, #ededed));
            background:-moz-linear-gradient(top, #ededed 5%, #ededed 100%);
            background:-o-linear-gradient(top, #ededed 5%, #ededed 100%);
            background:-ms-linear-gradient(top, #ededed 5%, #ededed 100%);
            background:linear-gradient(to bottom, #ededed 5%, #ededed 100%);
            background:-webkit-linear-gradient(top, #ededed 5%, #ededed 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#ededed',GradientType=0);
            border:0px solid #333029;
            -webkit-border-top-left-radius:15px;
            -moz-border-radius-topleft:15px;
            border-top-left-radius:15px;
            -webkit-border-top-right-radius:15px;
            -moz-border-radius-topright:15px;
            border-top-right-radius:15px;
            -webkit-border-bottom-left-radius:15px;
            -moz-border-radius-bottomleft:15px;
            border-bottom-left-radius:15px;
            -webkit-border-bottom-right-radius:15px;
            -moz-border-radius-bottomright:15px;
            border-bottom-right-radius:15px;
            -moz-box-shadow: inset 0px 0px 0px 0px #1c1b18;
            -webkit-box-shadow: inset 0px 0px 0px 0px #1c1b18;
            box-shadow: inset 0px 0px 0px 0px #1c1b18;
            text-align:center;
            display:inline-block;
            text-decoration:none;
        }
        .aa:hover{
            background-color:#f5f5f5;
            background:-webkit-gradient(linear, left top, left bottom, color-start(0.05, #ededed), color-stop(1, #ededed));
            background:-moz-linear-gradient(top, #ededed 5%, #ededed 100%);
            background:-o-linear-gradient(top, #ededed 5%, #ededed 100%);
            background:-ms-linear-gradient(top, #ededed 5%, #ededed 100%);
            background:linear-gradient(to bottom, #ededed 5%, #ededed 100%);
            background:-webkit-linear-gradient(top, #ededed 5%, #ededed 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#ededed',GradientType=0);
        }
    </style>
</head>
<body>
<input type="file" name="file_upload" id="file_upload" />
<!--<p><a href="javascript:$('#file_upload').uploadify('upload','*');">上传</a> -->
<!--动态传值  $('#file_upload').uploadify('settings', 'formData', {'typeCode':document.getElementById('id_file').value}); -->
<p style="margin-bottom: 10px;"><a href="javascript:$('#file_upload').uploadify('settings', 'formData', {'typeCode':document.getElementById('id_file').value});$('#file_upload').uploadify('upload','*')" class="aa" style="text-decoration: none";>上传</a>
    <a href="javascript:$('#file_upload').uploadify('cancel','*')" class="aa" style="text-decoration: none;">重置上传队列</a>
</p>
<input type="hidden" value="1215154" name="tmpdir" id="id_file">
<input type="hidden" value="<?php echo $_GET['pc_hash']?>" name="hash" id="hash">


<?php
//print_r($_REQUEST);die;
$type = $_GET['type'];
switch ($type) {
    case 'qhyj':
        $button = '期货研究';
        break;
    case 'ggyb':
        $button = '港股研报';
        break;
    case 'wwyb':
        $button = '外文研报';
        break;
    case 'zqyb':
        $button = '债券研报';
        break;
    case 'qzsc':
        $button = '权证市场';
        break;
    case 'rzrq':
        $button = '融资融券';
        break;
    case 'zcpx':
        $button = '政策评析';
        break;
    case 'hwsc':
        $button = '海外市场';
        break;
    case 'hgjj':
        $button = '宏观经济';
        break;
    case 'qqyj':
        $button = '期权研究';
        break;
    case 'xgscbg':
        $button = '香港市场报告';
        break;
    case 'jjbg':
        $button = '基金报告';
        break;
    case 'jgch':
        $button = '机构晨会';
        break;
    case 'jgdy':
        $button = '机构调研';
        break;
    case 'xgyb':
        $button = '新股研报';
        break;
    case 'cyb':
        $button = '创业板';
        break;
    case 'ggpj':
        $button = '个股评级';
        break;
    case 'hybg':
        $button = '行业报告';
        break;
    case 'gzqh':
        $button = '股指期货';
        break;
    case 'xsb':
        $button = '新三板';
        break;
    case 'jgcl':
        $button = '机构策略';
        break;
}
//$dir = "/home/wwwroot/default/bolanadmin/admindev/uploads/{$_GET['type']}";
//
//if (is_dir($dir))
//{
//    if ($dh = opendir($dir))
//    {
//        while (($file = readdir($dh)) !== false )
//        {
//            if(($file!=".") && ($file!="..")){
//                echo $file.'<br>' ;
//            }
//
//        }
//        closedir($dh);
//    }
//}
?>

<script type="text/javascript">
    var img_id_upload=new Array();//初始化数组，存储已经上传的图片名
    var i=0;//初始化数组下标
    $(function() {
        $('#file_upload').uploadify({
            'auto'     : false,//关闭自动上传
            'removeTimeout' : 1,//文件队列上传完成1秒后删除
            'swf'      : 'uploadify.swf',
            'uploader' : 'uploadify.php',
            'method'   : 'post',//方法，服务端可以用$_POST数组获取数据

            'buttonText' : '选择<?php echo $button;?>文件',//设置按钮文本
            'multi'    : true,//允许同时上传多张图片
            'uploadLimit' : 20,//一次最多只允许上传20张图片
            'fileTypeDesc' : '不被允许上传的格式文件!',//只允许上传图像
            'fileTypeExts' : '*.pdf;*.doc;*.xls;*.ppt;*.docx;*.xlsx;*.pptx;',//限制允许上传的图片后缀
            'fileSizeLimit' : '20000KB',//限制上传的图片不得超过20000KB
            'onUploadSuccess' : function(file, data, response) {//每次成功上传后执行的回调函数，从服务端返回数据到前端
            img_id_upload[i]=data;
            i++;
//			   alert(data);
        },
        'onQueueComplete' : function(queueData) {//上传队列全部完成后执行的回调函数
            // if(img_id_upload.length>0)
//            alert('成功上传的文件有：'+encodeURIComponent(img_id_upload));
            alert('上传成功！');
                    location.replace(location.href);
        },
        // Put your options here
            'onUploadStart': function (file) {
                $("#file_upload").uploadify("settings", "formData", { 'type': <?php echo "'".$type."'"?>,'username':<?php echo "'".$username."'"?> });
                //在onUploadStart事件中，也就是上传之前，把参数写好传递到后台。
            }
        });
    });
</script>


<div class="pad-lr-10">
    <form name="myform" action="dhyb/edit.php" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <div style="margin-bottom: 3px;float:right;width:100%">
                    <div class="explain-col">
                        标题：<input type="text" name="bt" style="width:300px;">&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;
                        发布日期：
                        <link rel="stylesheet" type="text/css" href="http://221.232.160.243/bolanadmin/admin/statics/js/calendar/jscal2.css">
                        <link rel="stylesheet" type="text/css" href="http://221.232.160.243/bolanadmin/admin/statics/js/calendar/border-radius.css">
                        <link rel="stylesheet" type="text/css" href="http://221.232.160.243/bolanadmin/admin/statics/js/calendar/win2k.css">
                        <script type="text/javascript" src="http://221.232.160.243/bolanadmin/admin/statics/js/calendar/calendar.js"></script>
                        <script type="text/javascript" src="http://221.232.160.243/bolanadmin/admin/statics/js/calendar/lang/en.js"></script><input type="text" name="start_time" id="start_time" value="" size="10" class="date input-text" readonly="">&nbsp;<script type="text/javascript">
                            Calendar.setup({
                                weekNumbers: false,
                                inputField : "start_time",
                                trigger    : "start_time",
                                dateFormat: "%Y-%m-%d",
                                showTime: false,
                                minuteStep: 1,
                                onSelect   : function() {this.hide();}
                            });
                        </script>- &nbsp;<input type="text" name="end_time" id="end_time" value="" size="10" class="date input-text" readonly="">&nbsp;<script type="text/javascript">
                            Calendar.setup({
                                weekNumbers: false,
                                inputField : "end_time",
                                trigger    : "end_time",
                                dateFormat: "%Y-%m-%d",
                                showTime: false,
                                minuteStep: 1,
                                onSelect   : function() {this.hide();}
                            });
                        </script>
                        &nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;
                        栏目：<select  class="form-control" name="lanmu" id="lanmu">
                            <option value="" ></option>
                            <option value="机构策略" <?php echo $_REQUEST['lanmu']=='机构策略'?'selected':''?>>机构策略</option>
                            <option value="港股研报" <?php echo $_REQUEST['lanmu']=='港股研报'?'selected':''?>>港股研报</option>
                            <option value="外文研报" <?php echo $_REQUEST['lanmu']=='外文研报'?'selected':''?>>外文研报</option>
                            <option value="债券研报" <?php echo $_REQUEST['lanmu']=='债券研报'?'selected':''?>>债券研报</option>
                            <option value="权证市场" <?php echo $_REQUEST['lanmu']=='权证市场'?'selected':''?>>权证市场</option>
                            <option value="融资融券" <?php echo $_REQUEST['lanmu']=='融资融券'?'selected':''?>>融资融券</option>
                            <option value="政策评析" <?php echo $_REQUEST['lanmu']=='政策评析'?'selected':''?>>政策评析</option>
                            <option value="海外市场" <?php echo $_REQUEST['lanmu']=='海外市场'?'selected':''?>>海外市场</option>
                            <option value="宏观经济" <?php echo $_REQUEST['lanmu']=='宏观经济'?'selected':''?>>宏观经济</option>
                            <option value="期权研究" <?php echo $_REQUEST['lanmu']=='期权研究'?'selected':''?>>期权研究</option>
                            <option value="香港市场报告" <?php echo $_REQUEST['lanmu']=='香港市场报告'?'selected':''?>>香港市场报告</option>
                            <option value="基金报告" <?php echo $_REQUEST['lanmu']=='基金报告'?'selected':''?>>基金报告</option>
                            <option value="机构晨报" <?php echo $_REQUEST['lanmu']=='机构晨报'?'selected':''?>>机构晨报</option>
                            <option value="新股研报" <?php echo $_REQUEST['lanmu']=='新股研报'?'selected':''?>>新股研报</option>
                            <option value="创业板" <?php echo $_REQUEST['lanmu']=='创业板'?'selected':''?>>创业板</option>
                            <option value="个股评级" <?php echo $_REQUEST['lanmu']=='个股评级'?'selected':''?>>个股评级</option>
                            <option value="股指期货" <?php echo $_REQUEST['lanmu']=='股指期货'?'selected':''?>>股指期货</option>
                            <option value="新三板" <?php echo $_REQUEST['lanmu']=='新三板'?'selected':''?>>新三板</option>
                            <option value="期货研究" <?php echo $_REQUEST['lanmu']=='期货研究(衍生工具)'?'selected':''?>>期货研究(衍生工具)</option><!--19-->
                            <option disabled></option>
                            <option value="" disabled>---行业报告---</option>
                            <option disabled></option>
                            <option value="煤炭开采" <?php echo $_REQUEST['lanmu']=='煤炭开采'?'selected':''?>>煤炭开采</option>
                            <option value="电力行业" <?php echo $_REQUEST['lanmu']=='电力行业'?'selected':''?>>电力行业</option>
                            <option value="航空工业" <?php echo $_REQUEST['lanmu']=='航空工业'?'selected':''?>>航空工业</option>
                            <option value="家电行业" <?php echo $_REQUEST['lanmu']=='家电行业'?'selected':''?>>家电行业</option>
                            <option value="钢铁行业" <?php echo $_REQUEST['lanmu']=='钢铁行业'?'selected':''?>>钢铁行业</option>
                            <option value="化工行业" <?php echo $_REQUEST['lanmu']=='化工行业'?'selected':''?>>化工行业</option>
                            <option value="食品饮料" <?php echo $_REQUEST['lanmu']=='食品饮料'?'selected':''?>>食品饮料</option>
                            <option value="酿酒行业" <?php echo $_REQUEST['lanmu']=='酿酒行业'?'selected':''?>>酿酒行业</option>
                            <option value="农药化肥" <?php echo $_REQUEST['lanmu']=='农药化肥'?'selected':''?>>农药化肥</option>
                            <option value="家具行业" <?php echo $_REQUEST['lanmu']=='家具行业'?'selected':''?>>家具行业</option>
                            <option value="化纤行业" <?php echo $_REQUEST['lanmu']=='化纤行业'?'selected':''?>>化纤行业</option>
                            <option value="水泥行业" <?php echo $_REQUEST['lanmu']=='水泥行业'?'selected':''?>>水泥行业</option>
                            <option value="玻璃陶瓷" <?php echo $_REQUEST['lanmu']=='玻璃陶瓷'?'selected':''?>>玻璃陶瓷</option>
                            <option value="造纸行业" <?php echo $_REQUEST['lanmu']=='造纸行业'?'selected':''?>>造纸行业</option>
                            <option value="印刷包装" <?php echo $_REQUEST['lanmu']=='印刷包装'?'selected':''?>>印刷包装</option><!--15-->

                            <option value="" disabled>|--金融行业</option>
                            <option value="银行业" <?php echo $_REQUEST['lanmu']=='银行业'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;银行业</option>
                            <option value="证券期货" <?php echo $_REQUEST['lanmu']=='证券期货'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;证券期货</option>
                            <option value="保险业" <?php echo $_REQUEST['lanmu']=='保险业'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;保险业</option>
                            <option value="多元金融" <?php echo $_REQUEST['lanmu']=='多元金融'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;多元金融</option>
                            <option value="" disabled>|--石油行业</option>
                            <option value="石油开采" <?php echo $_REQUEST['lanmu']=='石油开采'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;石油开采</option>
                            <option value="石油加工" <?php echo $_REQUEST['lanmu']=='石油加工'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;石油加工</option>
                            <option value="" disabled>|--交通运输</option>
                            <option value="运输设备" <?php echo $_REQUEST['lanmu']=='运输设备'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;运输设备</option>
                            <option value="铁路运输" <?php echo $_REQUEST['lanmu']=='铁路运输'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;铁路运输</option>
                            <option value="高速公路" <?php echo $_REQUEST['lanmu']=='高速公路'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;高速公路</option>
                            <option value="水上运输" <?php echo $_REQUEST['lanmu']=='水上运输'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;水上运输</option>
                            <option value="港口" <?php echo $_REQUEST['lanmu']=='港口'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;港口</option>
                            <option value="航空运输" <?php echo $_REQUEST['lanmu']=='航空运输'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;航空运输</option>
                            <option value="物流管理" <?php echo $_REQUEST['lanmu']=='物流管理'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;物流管理</option>
                            <option value="" disabled>|--供水供气</option>
                            <option value="供水" <?php echo $_REQUEST['lanmu']=='供水'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;供水</option>
                            <option value="供气" <?php echo $_REQUEST['lanmu']=='供气'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;供气</option>
                            <option value="" disabled>|--电子信息</option>
                            <option value="通信服务" <?php echo $_REQUEST['lanmu']=='通信服务'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;通信服务</option>
                            <option value="通信设备" <?php echo $_REQUEST['lanmu']=='通信设备'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;通信设备</option>
                            <option value="计算机" <?php echo $_REQUEST['lanmu']=='计算机'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计算机</option>
                            <option value="电子器件" <?php echo $_REQUEST['lanmu']=='电子器件'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电子器件</option>
                            <option value="软件业" <?php echo $_REQUEST['lanmu']=='软件业'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;软件业</option>
                            <option value="" disabled>|--商业贸易</option>
                            <option value="零售业" <?php echo $_REQUEST['lanmu']=='零售业'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;零售业</option>
                            <option value="贸易综合" <?php echo $_REQUEST['lanmu']=='贸易综合'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;贸易综合</option>
                            <option value="" disabled>|--房地产业</option>
                            <option value="房产开发" <?php echo $_REQUEST['lanmu']=='房产开发'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;房产开发</option>
                            <option value="" disabled>|--有色行业</option>
                            <option value="有色冶炼" <?php echo $_REQUEST['lanmu']=='有色冶炼'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;有色冶炼</option>
                            <option value="有色矿采" <?php echo $_REQUEST['lanmu']=='有色矿采'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;有色矿采</option>
                            <option value="" disabled>|--机械行业</option>
                            <option value="船舶业" <?php echo $_REQUEST['lanmu']=='船舶业'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;船舶业</option>
                            <option value="通用机械" <?php echo $_REQUEST['lanmu']=='通用机械'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;通用机械</option>
                            <option value="专用机械" <?php echo $_REQUEST['lanmu']=='专用机械'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;专用机械</option>
                            <option value="电气机械" <?php echo $_REQUEST['lanmu']=='电气机械'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电气机械</option>
                            <option value="" disabled>|--酒店旅游</option>
                            <option value="旅游饭店" <?php echo $_REQUEST['lanmu']=='旅游饭店'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;旅游饭店</option>
                            <option value="旅游景区" <?php echo $_REQUEST['lanmu']=='旅游景区'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;旅游景区</option>
                            <option value="" disabled>|--农林牧渔</option>
                            <option value="种植" <?php echo $_REQUEST['lanmu']=='种植'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;种植</option>
                            <option value="畜牧" <?php echo $_REQUEST['lanmu']=='畜牧'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;畜牧</option>
                            <option value="" disabled>|--纺织行业</option>
                            <option value="纺织印染" <?php echo $_REQUEST['lanmu']=='纺织印染'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;纺织印染</option>
                            <option value="服装鞋类" <?php echo $_REQUEST['lanmu']=='服装鞋类'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;服装鞋类</option>
                            <option value="纺织机械" <?php echo $_REQUEST['lanmu']=='纺织机械'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;纺织机械</option>
                            <option value="" disabled>|--生物医药</option>
                            <option value="医药制造" <?php echo $_REQUEST['lanmu']=='医药制造'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;医药制造</option>
                            <option value="医疗器械" <?php echo $_REQUEST['lanmu']=='医疗器械'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;医疗器械</option>
                            <option value="" disabled>|--建筑建材</option>
                            <option value="建材产品" <?php echo $_REQUEST['lanmu']=='建材产品'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;建材产品</option>
                            <option value="土木工程" <?php echo $_REQUEST['lanmu']=='土木工程'?'selected':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;土木工程</option><!--40-->

                        </select>&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;
                        创建人：<input type="text" name="cjr" id="cjr" value="<?php
                        if(!empty($_REQUEST['cjr'])){
                            echo $_REQUEST['cjr'];
                        }else{
                            echo $username;
                        }
                        ?>">
                        &nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;
                        <!--                    创建人：<input type="text" name="cjr" id="cjr" value="luohao">-->
                        <input type="submit" value="搜索" onClick="document.myform.action='?m=dhyb&c=pdf&a=init&pc_hash=<?php echo $_REQUEST['pc_hash']?>';" style="width:60px;height:24px;">
                    </div>

                </div>
                <thead>
                <tr>
                    <th width="5" align="left"><input type="checkbox" value="" id="check_box" onclick="selectall('id[]');"></th>
                    <th width="3%">ID</th>
                    <th width="38%" >标题</th>
                    <th width="10%" align="center">栏目</th>
                    <th width="9%" align="center">研究机构</th>
                    <th width="8%" align="center">作者</th>
                    <th width="8%" align="center">创建人</th>
                    <th width='9%' align="center">上传日期</th>
                    <th width='9%' align="center">撰写日期</th>

                    <th width="" align="center">管理操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
//                    $statusArr = array(0 => '未发布', 1 => '已发布');
                ?>
                <?php
//                echo '<pre>';
//                print_r($data);die;
                if(is_array($data)){
                    foreach($data as $announce){
//                        echo '<pre>';
//                        print_r($announce);die;
                        ?>
                        <tr>
                            <td align="left">
                                <input type="checkbox" name="id[]" value="<?php echo $announce['id']?>">
                            </td>
                            <td align="left">
                                <?php echo $announce['id']+5000000;?>
                            </td>


                            <td ><?php echo $announce['title']?></td>

                            <td align="center"><?php echo $announce['lanmu']?></td><!--栏目-->
<!--                            <td align="center">--><?php //echo $announce['OrganID']?><!--</td><!--研究机构-->
                            <td align="center">
                                <?php
                                    $OrganID = $announce['OrganID'];
                                    $link = mysql_connect('localhost','root','123456');
                                    mysql_select_db('bolanadmin_dev',$link);
                                    $sql ="select * from TOrgan where OrganID='{$OrganID}'";
                                    $res = mysql_query($sql);
                                    $arr = mysql_fetch_row($res);
                                    echo $arr[2];
                                ?>
                            </td><!--研究机构-->
                            <td align="center"><?php echo $announce['Author'];?></td>
                            <td align="center"><?php echo $announce['name'];?></td><!--创建人-->
                            <td align="center"><?php echo $announce['CreateTimeID'];?></td>
                            <td align="center"><?php
                                echo $announce['ReportTime'];
                                ?></td>



                            <td align="center">
<!--                                <a href="?m=announce&c=admin_announce&a=make&rkid=--><?php //echo $announce['id']?><!--&type=--><?php //echo $_GET['type']; ?><!--">文章录入</a> |-->
<!--                                <a href="dhyb/edit.php?id=--><?php //echo $announce['id']?><!--" id="bianji">编辑</a>-->
                                <a href="" class="bianji" tid="<?php echo $announce['id']?>">编辑</a>
<!--编辑-->
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>

            <div class="btn"><label for="check_box"><?php echo L('selected_all')?>/<?php echo L('cancel')?></label>
                <?php if($_GET['s']==1) {?><input name='submit' type='submit' class="button" value='<?php echo L('cancel_all_selected')?>' onClick="document.myform.action='?m=announce&c=admin_announce&a=public_approval&passed=0'"><?php } elseif($_GET['s']==2) {?><input name='submit' type='submit' class="button" value='<?php echo L('pass_all_selected')?>' onClick="document.myform.action='?m=announce&c=admin_announce&a=public_approval&passed=1'"><?php }?>&nbsp;&nbsp;
                <input name="submit" type="submit" class="button" value="删除选定" onClick="document.myform.action='?m=dhyb&c=pdf&a=delete';return confirm('确定删除？')">&nbsp;&nbsp;</div>  </div>
        <div id="pages"><?php echo $this->db->pages;?></div>
    </form>
</div>
<script type="text/javascript">
    $('.bianji').click(function(){
        var lanmu = $('#lanmu').val();
        var cjr = $('#cjr').val();
        var tid = $(this).attr('tid');
        var hash = $('#hash').val();
//        alert(hash);return;
        window.location="dhyb/edit.php?id="+tid+"&lanmu="+lanmu+"&cjr="+cjr+"&pc_hash="+hash;
        return false;
    });
</script>

</body>
</html>