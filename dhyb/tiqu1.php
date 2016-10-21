<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/30
 * Time: 10:00
 */
//20160919-天风证券-骅威文化-002502.SZ-创新机制消化激励风险，协同共推IP运营
$arr = array();
$title = json_encode($_POST['tiqu1']);
$reg = '/-(\d{6}).S/';
preg_match_all($reg, $title, $arr);
$data = $arr[1][0];
echo json_decode($data);
//echo $title;