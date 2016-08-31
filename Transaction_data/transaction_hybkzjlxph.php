<?php
/*
 * 交易数据机器化
 * author lh
 * Date: 2016/7/26
 * Time: 14:52
 * <p style="text-align: center;"><img src="http://221.232.160.243/bolanadmin/admin/uploadfile/2016/0530/20160530034622323.jpg"/></p>
 */
//FIXME：测试环境
//require_once 'functiondev.php';
//$img_pre_path = "/bolanadmin/admind/admin/uploadfile/transaction/";
//FIXME：正式环境
require_once 'function.php';
$img_pre_path = "http://221.232.160.243/bolanadmin/admin/uploadfile/transaction/";

$pre_path = "../uploadfile/transaction/";
//header('content-type:text/html;charset=utf-8');
ini_set("display_errors", "On");
error_reporting(E_ALL);

require_once "./index.php";

$hostname = "221.232.160.242:1433";
$dbuser = "uts"; //用户名
$dbpasswd = "123456"; //密码

$data = array();//入库数据

//连接数据库
$db_id = mssql_connect($hostname,$dbuser,$dbpasswd) or die("无法连接数据库服务器！");
$db = mssql_select_db("Bolan",$db_id) or die("无法连接数据库！");

/**
 * trans
 * 交易数据
 *
 * @access public
 * @param int $top 查询数据量
 * @param string $filed1 字段1 日期
 * @param string $filed3 字段3 X轴标注
 * @param string $filed4 字段4 柱形图数据
 * @param string $table 表名
 * @param string $where 条件
 * @param string $order 排序条件
 * @param string $pre_path 文件前缀
 * @param string $img_pre_path 目录前缀
 * @param int $catid 分类id
 * @param string $suffix_title 标题后缀
 * @param string $text 图例文字
 * @param string $colors 柱状图颜色
 * @param string $mode 排序方式
 * @param string $filed4s $filed4-$filed4s
 * @since 1.0
 * @return
 */
function trans($top, $filed1, $filed3, $filed4, $table, $where, $order, $pre_path, $img_pre_path, $catid, $suffix_title, $text, $colors, $mode, $filed4s='')
{
    if (empty($filed4s)) {
        $sql = "select top {$top} CONVERT(VARCHAR(10),$filed1,120) as {$filed1},{$filed3},{$filed4}
        from {$table} where {$where}
         order by
         cast({$order} as float)
         {$mode}";
    } else {
        $sql = "select top {$top} CONVERT(VARCHAR(10),$filed1,120) as {$filed1},{$filed3},(fundflowz16-fundflowz20) as {$filed4}
        from {$table} where {$where}
         order by
         {$order}
         {$mode}";
    }
    $res = mssql_query($sql);

    while ($row = mssql_fetch_assoc($res)) {
//        /*
//         * $row['zjlxlsb0201'] 日期
//         * $row['zjlxlsb0203'] 股票名称
//         * $row['zjlxlsb0204'] 大单流入（流通盘比）
//         * */
//        echo '<pre>';
//        print_r($row);
//        echo '</pre>';
        $date = date('m月d日', strtotime($row[$filed1]));
        $day = date('d日', time());
        if(date('m月d日',time())==$date) {
//        if (date('7月28日', time()) == '7月28日') {
            //柱形图数据
            $data[] = $row[$filed4];
            //x轴标注
            $xdata[] = iconv('gbk', 'utf-8', $row[$filed3]);
        }
    }
//    echo '<pre>';
//    print_r($data);
//die;
    if(!empty($data)) {
        //打乱数组
        $datas = array_keys($data);
//        shuffle($datas);
        foreach ($datas as $v) {
            $new_data[] = abs($data[$v]);
            $new_xdata[] = $xdata[$v];
        }
        $count = count($data);
    } else {
        echo '今日目前无数据';
//        die;
    }
    if (isset($count) && $count >= 3) {
        //准备柱状图数据
        //bar($data, $xdata,'我是标题','博览数据（单位：万元）','#037000',$angle,$path);
        $title = "{$day}{$suffix_title}";

        //生成文件路径
        $year = date('Y', time());
        $month_day = date('md', time());
        $time = date('His', time());
        $filename = $year . $month_day . $time . rand(100, 999) . '.png';
        $suffix_path = $year . '/' . $month_day . '/' . $filename;
        $path = $pre_path.$suffix_path;
        //获取角度
        if ($count <= 10) {
            $angle = 0;
        } else {
            $angle = 65;
        }
        //创建文件夹
        if (!is_dir("{$pre_path}{$year}")) {
            mkdir("{$pre_path}{$year}");
        }
        if (!is_dir("{$pre_path}{$year}/{$month_day}")) {
            mkdir("{$pre_path}{$year}/{$month_day}");
        }
        if(count($new_data)!=0) {
            //生成柱状图
            bar($new_data, $new_xdata, $title, $text, $colors, $angle, $path);
            $img_path = "{$img_pre_path}{$year}/{$month_day}/{$filename}";
            //准备入库数据
            $newData[] = array('title' => $title, 'content' => "<p style=\"text-align: center;\"><img src={$img_path}></p>", 'catid' => $catid);

//            echo '<pre>';
            insert($newData);
        }
    }
}


/*
 * 行业主力资金流向排行 XX日收盘行业主力资金流入排行(标题) 表：hybkzjlxph
 * hybkzjlxph01 日期
 * hybkzjlxph02 行业名称
 * hybkzjlxph03 今日主力资金净流入净额
 * */
$where = "hybkzjlxph01 = (select max(hybkzjlxph01) from hybkzjlxph) and hybkzjlxph03>0";
trans(10, 'hybkzjlxph01', 'hybkzjlxph02', 'hybkzjlxph03', 'hybkzjlxph', $where, 'hybkzjlxph03', $pre_path, $img_pre_path, 3691, '收盘行业主力资金流入排行', '行业流入（单位：万元）', 'red', 'desc');

/*
 * 行业主力资金流向排行 XX日收盘行业主力资金流出排行(标题) 表：hybkzjlxph
 * hybkzjlxph01 日期
 * hybkzjlxph02 行业名称
 * hybkzjlxph03 今日主力资金净流入净额
 * */
$where = "hybkzjlxph01 = (select max(hybkzjlxph01) from hybkzjlxph) and hybkzjlxph03<0";
trans(10, 'hybkzjlxph01', 'hybkzjlxph02', 'hybkzjlxph03', 'hybkzjlxph', $where, 'hybkzjlxph03', $pre_path, $img_pre_path, 3691, '收盘行业主力资金流出排行', '行业流入（单位：万元）', '#037000', 'asc');

