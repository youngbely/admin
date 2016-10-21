<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/29
 * Time: 13:49
 */
header("Content-type: text/html; charset=utf-8");
ini_set("display_errors", "On");
date_default_timezone_set('Asia/Shanghai');
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';die;
$shuffix = $_POST['shuffix'];
//获取中文栏目
$menu = $_POST['menu'];
switch ($menu) {
    case '000_C556_C559_':
        $lanmu = '机构策略';
        break;
    case '000_C556_C560_':
        $lanmu = '港股研报';
        break;
    case '000_C556_C739_':
        $lanmu = '外文研报';
        break;
    case '000_C556_C738_':
        $lanmu = '债券研报';
        break;
    case '000_C556_C984_':
        $lanmu = '权证市场';
        break;
    case '000_C556_C4515_':
        $lanmu = '融资融券';
        break;
    case '000_C556_C558_':
        $lanmu = '政策评析';
        break;
    case '000_C556_C810_':
        $lanmu = '海外市场';
        break;
    case '000_C556_C557_':
        $lanmu = '宏观经济';
        break;
    case '000_C556_C5488_':
        $lanmu = '期权研究';
        break;
    case '000_C556_C5481_':
        $lanmu = '香港市场报告';
        break;
    case '000_C556_C734_':
        $lanmu = '基金报告';
        break;
    case '000_C556_C735_':
        $lanmu = '机构晨报';
        break;
    case '000_C556_C945_':
        $lanmu = '新股研报';
        break;
    case '000_C556_C3954_':
        $lanmu = '创业板';
        break;
    case '000_C556_C731_':
        $lanmu = '个股评级';
        break;
    case '000_C556_C737_':
        $lanmu = '股指期货';
        break;
    case '000_C556_C5489_':
        $lanmu = '新三板';
        break;
    case '000_C556_C1000_':
        $lanmu = '期货研究(衍生工具)';
        break;
    case '001_C58_':
        $lanmu = '煤炭开采';
        break;
    case '001_C105_':
        $lanmu = '电力行业';
        break;
    case '001_C102_':
        $lanmu = '航空工业';
        break;
    case '001_C1146_':
        $lanmu = '家电行业';
        break;
    case '001_C59_':
        $lanmu = '钢铁行业';
        break;
    case '001_C72_':
        $lanmu = '化工行业';
        break;
    case '001_C63_':
        $lanmu = '食品饮料';
        break;
    case '001_C64_':
        $lanmu = '酿酒行业';
        break;
    case '001_C73_':
        $lanmu = '农药化肥';
        break;
    case '001_C68_':
        $lanmu = '家具行业';
        break;
    case '001_C74_':
        $lanmu = '化纤行业';
        break;
    case '001_C77_':
        $lanmu = '水泥行业';
        break;
    case '001_C78_':
        $lanmu = '玻璃陶瓷';
        break;
    case '001_C69_':
        $lanmu = '造纸行业';
        break;
    case '001_C70_':
        $lanmu = '印刷包装';
        break;
    case '001_C134_C135_':
        $lanmu = '银行业';
        break;
    case '001_C134_C136_':
        $lanmu = '证券期货';
        break;
    case '001_C134_C137_':
        $lanmu = '保险业';
        break;
    case '001_C134_C138_':
        $lanmu = '多元金融';
        break;
    case '001_C71_C1142_':
        $lanmu = '石油开采';
        break;
    case '001_C71_C1141_':
        $lanmu = '石油加工';
        break;
    case '001_C103_C104_':
        $lanmu = '运输设备';
        break;
    case '001_C103_C116_':
        $lanmu = '铁路运输';
        break;
    case '001_C103_C117_':
        $lanmu = '高速公路';
        break;
    case '001_C103_C119_':
        $lanmu = '水上运输';
        break;
    case '001_C103_C120_':
        $lanmu = '港口';
        break;
    case '001_C103_C121_':
        $lanmu = '航空运输';
        break;
    case '001_C103_C122_':
        $lanmu = '物流管理';
        break;
    case '001_C107_C109_':
        $lanmu = '供水';
        break;
    case '001_C107_C108_':
        $lanmu = '供气';
        break;
    case '001_C123_C1151_':
        $lanmu = '通信服务';
        break;
    case '001_C123_C124_':
        $lanmu = '通信设备';
        break;
    case '001_C123_C125_':
        $lanmu = '计算机';
        break;
    case '001_C123_C126_':
        $lanmu = '电子器件';
        break;
    case '001_C123_C128_':
        $lanmu = '软件业';
        break;
    case '001_C129_C131_':
        $lanmu = '零售业';
        break;
    case '001_C129_C132_':
        $lanmu = '贸易综合';
        break;
    case '001_C139_C1143_':
        $lanmu = '房产开发';
        break;
    case '001_C61_C719_':
        $lanmu = '有色冶炼';
        break;
    case '001_C61_C62_':
        $lanmu = '有色矿采';
        break;
    case '001_C91_C1030_':
        $lanmu = '船舶业';
        break;
    case '001_C91_C713_':
        $lanmu = '通用机械';
        break;
    case '001_C91_C92_':
        $lanmu = '专用机械';
        break;
    case '001_C91_C93_':
        $lanmu = '电气机械';
        break;
    case '001_C141_C142_':
        $lanmu = '旅游饭店';
        break;
    case '001_C141_C144_':
        $lanmu = '旅游景区';
        break;
    case '001_C53_C54_':
        $lanmu = '种植';
        break;
    case '001_C53_C56_':
        $lanmu = '畜牧';
        break;
    case '001_C65_C66_':
        $lanmu = '纺织印染';
        break;
    case '001_C65_C67_':
        $lanmu = '服装鞋类';
        break;
    case '001_C65_C716_':
        $lanmu = '纺织机械';
        break;
    case '001_C87_C1147_':
        $lanmu = '医药制造';
        break;
    case '001_C87_C88_':
        $lanmu = '医疗器械';
        break;
    case '001_C113_C1149_':
        $lanmu = '建材产品';
        break;
    case '001_C113_C751_':
        $lanmu = '土木工程';
        break;

}

$arr_menu = explode('_',$menu);
array_pop($arr_menu);
$type = end($arr_menu);// ClassID 英文栏目
//echo $type;



//日期
$date = date('Ym',time());
//echo $date;die;

//C3954 C945 C560 C731  创业板、新股研报、港股研报、个股评级 用的TStockGrade表
$TStockGrade_arr = array('C3954','C945','C560','C731');

//数据库操作
$link = mysql_connect('localhost','root','123456');
mysql_select_db('bolanadmin',$link);
$sql = "select * from bl_dhyb where id={$_POST['id']}";
$result = mysql_query($sql);
$row=mysql_fetch_assoc($result);
//echo '<pre>';
//print_r($row);

//获取研究机构的值
$sql_l = "select OrganID from TOrgan where OrganName='{$_POST['OrganID']}'";
$res_l = mysql_query($sql_l);
//var_dump($res_l);die;
if($row_l=mysql_fetch_assoc($res_l)){
    $OrganID = $row_l['OrganID'];
}else{
    echo "<script type='text/javascript'>alert('无此研究机构！')</script>";
    exit;
}

//var_dump($row_l);die;
//if (in_array($type,$TStockGrade_arr)) {

    if($_POST['IDGrade']!=999) {
        $Grade_arr = explode('_', $_POST['IDGrade']);
        $Grade = $Grade_arr[1];
        $OriginGradeID = $Grade_arr[0];
    }else{
        $Grade = null;
        $OriginGradeID = '';
    }

    $ReportTime = $_POST['date'].' '.$_POST['time'];
    $ClosePrice = '';//收盘价
//echo $Grade.'---'.$OriginGradeID; A---37


    //Vary为5
    if($_POST['Vary']==5){
        $_POST['Vary'] = null;
    }

    /*计算预期空间*/
    if(!empty($_POST['StockCode'])){
        //获取收盘价
        if ($type=='C560') {
//            $fullname='hk'.'00005';
            $output=iconv("GBK", "UTF-8", file_get_contents("http://221.232.160.238/stockcode.php?id=hk{$_POST['StockCode']}"));//http://221.232.160.238/stockcode.php?id=hk00005   http://hq.sinajs.cn/list={$fullname}
            $find = array('var hq_str_'.$fullname.'="','";');
            $output = str_replace($find, '', $output);
            if (strstr($output,",")) {
                $array = explode(",", $output);
                $ClosePrice = $array[3];//港股收盘价
            }
        } else {
            $sql = "select * from Aghqjtsj where Aghqjtsj02='{$_POST['StockCode']}' and Aghqjtsj01=(select max(Aghqjtsj01) from  Aghqjtsj where Aghqjtsj02='{$_POST['StockCode']}')";
            $result = mysql_query($sql);
            while ($row = mysql_fetch_assoc($result)) {
                $ClosePrice = $row['Aghqjtsj07'];//收盘价
            }
        }

        //获取预期空间
        if (!empty($ClosePrice)) {
            if($_POST['AimPrice1']!='' && $_POST['AimPrice2']!=''){
                $ExpectRise = ($_POST['AimPrice2']-$ClosePrice)/$ClosePrice*100;
            }elseif($_POST['AimPrice1']!='' && $_POST['AimPrice2']==''){
                $ExpectRise = ($_POST['AimPrice1']-$ClosePrice)/$ClosePrice*100;
            }elseif($_POST['AimPrice1']=='' && $_POST['AimPrice2']!=''){
                $ExpectRise = ($_POST['AimPrice2']-$ClosePrice)/$ClosePrice*100;
            }else{
                $ExpectRise = '';
            }
        } else {
            $ExpectRise = '';
        }
    }else{
        $ExpectRise = '';
    }

    //生成随机ftp上传文件名
    $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randString = '';
    $len = strlen($str)-1;
    for($i = 0;$i < $len;$i ++){
        $num = mt_rand(0, $len);
        $randString .= $str[$num];
    }
    //去除摘要空格
    $qian=array(" ","　","\t","\n","\r");
    $hou=array("","","","","");
    $intro =  str_replace($qian,$hou,$_POST['Intro']);

$sql = "update bl_dhyb set types='{$type}',title='{$_POST['title']}',Grade='{$Grade}',StockCode='{$_POST['StockCode']}',OrganID='{$OrganID}',Author='{$_POST['Author']}',CreateTimeID='{$_POST['CreateTimeID']}',AimPrice1='{$_POST['AimPrice1']}',AimPrice2='{$_POST['AimPrice2']}',HtmlPath='/StockInfo/Attachment/{$date}/{$randString}-{$menu}{$shuffix}',Intro='{$intro}',ReportTime='{$ReportTime}',OriginGradeID='{$OriginGradeID}',Vary='{$_POST['Vary']}',
Authorzhiyehao='{$_POST['Authorzhiyehao']}',keyword='{$_POST['keyword']}' ,lanmu='{$lanmu}',menu='{$menu}',ClosePrice='{$ClosePrice}',ExpectRise='{$ExpectRise}',isPass=1 where
 id={$_POST['id']}";
$result = mysql_query($sql);
//echo $sql;die;
//}

//关键词操作
    $id = $_POST['id'];//pdf id
    $keywords = $_POST['keyword'];
//$keywords = '300156,浦发银行';

//    if(!empty($keywords)){
        //更新操作 先删除旧的关键词
        $sql = "delete from Keyword where dhyb_id={$id}";
        mysql_query($sql);

        if (strpos($keywords,',') || strpos($keywords,'，')) {
            if (strpos($keywords, ',')) {
                $keywords_arr = explode(',', $keywords);
                foreach ($keywords_arr as $keyword) {
                    //初始化
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "http://221.232.160.243/bolanadmin/insertKey.php?keyword={$keyword}");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    $keyword_id = $output;

                    //插入Keyword表
                    $sql = "insert into Keyword (dhyb_id,keyword_id,keyword) values ({$id},{$keyword_id},'{$keyword}')";
//                    $sql = "update Keyword set keyword_id={$keyword_id},keyword='{$keyword}' where dhyb_id={$id}";
                    $result = mysql_query($sql);
                }
            } elseif (strpos($keywords, '，')) {
                $keywords_arr = explode('，', $keywords);
                foreach ($keywords_arr as $keyword) {
                    //初始化
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "http://221.232.160.243/bolanadmin/insertKey.php?keyword={$keyword}");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    $keyword_id = $output;

                    //插入Keyword表
                    $sql = "insert into Keyword (dhyb_id,keyword_id,keyword) values ({$id},{$keyword_id},'{$keyword}')";
//                    $sql = "update Keyword set keyword_id={$keyword_id},keyword='{$keyword}' where dhyb_id={$id}";
                    $result = mysql_query($sql);
                }
            }
        }else{
            //初始化
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://221.232.160.243/bolanadmin/insertKey.php?keyword={$keywords}");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $output = curl_exec($ch);
            curl_close($ch);
            $keyword_id = $output;
            //插入Keyword表
            $sql = "insert into Keyword (dhyb_id,keyword_id,keyword) values ({$id},{$keyword_id},'{$keywords}')";
//                    $sql = "update Keyword set keyword_id={$keyword_id},keyword='{$keyword}' where dhyb_id={$id}";
            $result = mysql_query($sql);
        }
//    }else{
//        $sql = "delete from Keyword where dhyb_id={$id}";
//        mysql_query($sql);
//    }
//echo '<pre>';
//print_r($_REQUEST);
//die;
//echo "http://221.232.160.243/bolanadmin/admindev/index.php?m=dhyb&c=pdf&a=init&pc_hash={$_POST['hash']}&lanmu={$_REQUEST['lanmu']}&cjr={$_REQUEST['cjr']}";die;

//ftp1
$conn = ftp_connect("58.49.110.232") or die("Could not connect 1");
$fileName = "{$randString}-{$menu}{$shuffix}";
$dhybPath = '/home/wwwroot/default/bolanadmin/admin/uploads/';
if($conn){
    $login_result=ftp_login($conn,"newpdf","bolan`12");
    if($login_result){
        $ftp_dir = @ftp_mkdir($conn,'/'.date('Ym'));
        if(@ftp_put($conn, '/'.date('Ym').'/'.$fileName, $dhybPath.$_POST['title_rel'], FTP_BINARY)){
            //$this->db->update(array('status' => 1), 'aid = '.$_GET['rkid']);
        }
        else{
            echo "x发布失败！";
            exit;
        }
    }else{
        echo "xftp服务器登录失败！";
        exit;
    }
    ftp_close($conn);
}else{
    echo "xftp服务器连接失败！";
    exit;
}
//die;
header("Location: http://221.232.160.243/bolanadmin/admin/index.php?m=dhyb&c=pdf&a=init&pc_hash={$_POST['hash']}&lanmu={$_REQUEST['lanmu']}&cjr={$_REQUEST['cjr']}");
exit;


?>




