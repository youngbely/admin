<?php
/*
 * 生成交易数据柱状图
 * author lh
 * Date: 2016/7/26
 * Time: 14:52
 * <p style="text-align: center;"><img src="http://221.232.160.243/bolanadmin/admin/uploadfile/2016/0530/20160530034622323.jpg"/></p>
 */

//引入类库
require_once "./jpgraph/jpgraph.php";
require_once "./jpgraph/jpgraph_bar.php";


/**
 * bar
 * 生成交易数据柱状图
 *
 * @access public
 * @param array $data  柱形图数据
 * @param array $xdata  x轴标注
 * @param string $title 标题
 * @param string $text 图例文字  eg:"机构流出（单位：万元）"
 * @param string $color 柱状图颜色 red #037000
 * @param int $angle 文字倾斜角度
 * @param string $path 图片保存路径
 * @since 1.0
 * @return
 */
function bar($data, $xdata, $title, $text, $color, $angle, $path='')
{
    //柱形图模拟数据
//    $data = array(0.0121, 0.0546, 0.0546, 0.0546, 0.0546, 0.0546, 0.0246, 0.0546, 0.0546, 0.0546, 0.0546);

    //x 轴标注
//    $xdata = array('第斯蒂芬', '方斯蒂芬', '方斯蒂芬', '方斯蒂芬', '方斯蒂芬', '方斯蒂芬', '方斯蒂芬', '方斯蒂芬', '方斯蒂芬', '第三芬斯', '第三芬斯', '第斯蒂芬', '第三方芬', '蒂蒂芬', '蒂芬蒂芬');

    //创建背景图
    $graph = new Graph(700, 450);
    //设置刻度样式
    $graph->SetScale("textlin");
    //设置边界范围
    $graph->img->SetMargin(70, 10, 80, 150);
    //设置标题
    $graph->title->Set($title);
    $graph->title->SetFont(FF_CHINESE, FS_NORMAL, 12);

    //得到柱形图对象
    $barPlot = new BarPlot($data);

    $barPlot->SetWidth('18px');//柱状的宽度
    //设置柱形图图例
    $barPlot->SetLegend($text);
    $graph->legend->Pos( 0.025, 0.08, "right","center" );


    //显示柱形图代表数据的值
    $barPlot->value->show();
    //将柱形图加入到背景图
    $graph->Add($barPlot);
    //设置柱形图填充颜色
    $barPlot->setfillcolor($color);

    // 加入 x 轴标注
    $graph->xaxis->SetTickLabels($xdata);
    // 定位 x 轴标注垂直位置应在最下方
    $graph->xaxis->SetPos("min");
    // 设置 x 轴标注文字为斜体，粗体，6号小字
    $graph->xaxis->SetFont(FF_CHINESE, FS_NORMAL, 8);
    // 设置 x 轴标注文字 45 度倾斜。注：前面 SetFont 必须为 FF_ARIAL
    $graph->xaxis->SetLabelAngle($angle);

    //设置边框颜色
    $barPlot->Setcolor($color);
    $graph->xaxis->title->SetFont(FF_CHINESE);
    $graph->xaxis->title->Set("[博览财经数据提供]");
    $graph->xaxis->title->SetColor('gray@0.3:1.2');
    $graph->xaxis->title->SetMargin(-310);
    //将柱形图保存
    $graph->Stroke($path);
}
//柱形图模拟数据
//    $data = array(0.0121, 0.0546, 0.0546, 0.0546, 0.0546, 0.0546, 0.0246);

//x 轴标注
//    $xdata = array('第斯蒂芬', '方斯蒂芬', '方斯蒂芬', '方斯蒂芬', '方斯蒂芬', '方斯蒂芬', '方斯蒂芬', '方斯蒂芬', '方斯蒂芬', '第三芬斯', '第三芬斯', '第斯蒂芬', '第三方芬', '蒂蒂芬', '蒂芬蒂芬');
//bar($data, $xdata,'我是标题','博览数据（单位：万元）','#037000');