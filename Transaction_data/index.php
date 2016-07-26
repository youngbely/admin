<?php
//引入类库
require_once "./jpgraph/jpgraph.php";
require_once "./jpgraph/jpgraph_bar.php";
//柱形图模拟数据
$data=array(0.0121,0.0546,0.0546,0.0546,0.0546,0.0546,0.0246,0.0546,0.0546,0.0546,0.0546);

$xdata = array('第斯蒂芬','方斯蒂芬','方斯蒂芬','方斯蒂芬','方斯蒂芬','方斯蒂芬','方斯蒂芬','方斯蒂芬','方斯蒂芬','第三芬斯','第三芬斯','第斯蒂芬','第三方芬','蒂蒂芬','蒂芬蒂芬');

//创建背景图
$graph=new Graph(600,450);
//设置刻度样式
$graph->SetScale("textlin");
//设置边界范围
$graph->img->SetMargin(70,10,80,150);
//设置标题
$graph->title->Set("网志博客信息统计表");
$graph->title->SetFont(FF_CHINESE,FS_NORMAL,12);

//得到柱形图对象
$barPlot=new BarPlot($data);

$barPlot->SetWidth('18px');//柱状的宽度
//设置柱形图图例
$barPlot->SetLegend("机构流出（单位：万元）");


//显示柱形图代表数据的值
$barPlot->value->show();
//将柱形图加入到背景图
$graph->Add($barPlot);
//设置柱形图填充颜色
$barPlot->setfillcolor("blue");

// 加入 x 轴标注
$graph->xaxis->SetTickLabels($xdata);
// 定位 x 轴标注垂直位置应在最下方
$graph->xaxis->SetPos("min");
// 设置 x 轴标注文字为斜体，粗体，6号小字
$graph->xaxis->SetFont(FF_CHINESE,FS_NORMAL,8);
// 设置 x 轴标注文字 45 度倾斜。注：前面 SetFont 必须为 FF_ARIAL
$graph->xaxis->SetLabelAngle(0);



//设置边框颜色
$barPlot->Setcolor("blue");
$graph->xaxis->title->SetFont(FF_CHINESE);
$graph->xaxis->title->Set("[博览财经数据提供]");
$graph->xaxis->title->SetColor('gray@0.3:1.2');
$graph->xaxis->title->SetMargin(-310);
//将柱形图输出到浏览器
$graph->Stroke();