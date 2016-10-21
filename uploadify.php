<?php
header("Content-type: text/html; charset=utf-8");
define('ROOT',dirname(__FILE__).'/');
//echo ROOT;die;
//设置上传目录
$path = ROOT."uploads/";
//$path = ROOT."uploads/{$_POST['type']}/";
//$type = $_POST['type'];
//$path = ROOT."/uploads/{$type}/";
//echo $_POST['type'];die;
if (!empty($_FILES)) {

	//得到上传的临时文件流
	$tempFile = $_FILES['Filedata']['tmp_name'];
//	print_r($_FILES);die;
	//允许的文件后缀
//	$fileTypes = array('pdf');

	//得到文件原名
	$fileName = $_FILES["Filedata"]["name"];
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	//获取后缀名
	$pos = strrpos($fileName,'.');
	$shuffix = substr($fileName,$pos);
	$fileNames = substr($fileName,0,$pos);

	//接受动态传值
	$files=$_POST['typeCode'];
//	echo $tempFile;die;
	//最后保存服务器地址
	if(!is_dir($path))
	   mkdir($path);
	if (move_uploaded_file($tempFile, $path.$fileName)){
//		echo $filename;
//		echo iconv("GB2312","UTF-8",$fileName);
		echo $fileName."上传成功！";
//		echo $_FILE['Filedata']['name'];
//		echo $fileName;

		//将数据插入数据库
		$url =  $_SERVER['HTTP_HOST'].'/bolanadmin/admin/uploads/'.$fileName;
		$types = $_POST['type'];
		$username = $_POST['username'];
		$link = mysql_connect('localhost','root','123456');
		mysql_select_db('bolanadmin',$link);

		$time = date('Y-m-d H:i:s');//上传日期
		$sql = "insert into bl_dhyb (title_rel,title,url,shuffix,type,name,CreateTimeID) values ('{$fileName}','{$fileNames}','{$url}','{$shuffix}','{$types}','{$username}','{$time}')";
//echo $sql;die;
		$result = mysql_query($sql);
		$id =  mysql_insert_id();
		$sql1 = "insert into Keyword (dhyb_id) values ({$id})";
//		mysql_query($sql1);
	}else{
		echo $fileName."上传失败！";
	}
}
?>