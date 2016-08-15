<?php
function insert($data){
    $db = new PDO("mysql:dbname=bolanadmin_dev;host=172.16.94.35;", 'root', '123456');
    $time = time();
    //������ݵ�¼���̨
    foreach($data as $v){
        if(!empty($v['title']) && !empty($v['content'])) {
            $sql = "SELECT count(*) FROM bl_news WHERE title = '" . $v['title'] . "'";
            $stmt = $db->query($sql);
            $num = $stmt->fetchColumn();
            $content=trim($v['content']);
            if($num == 0) {
                if(gettype($v['catid']) == 'integer'){
                    $db->exec("INSERT INTO `bl_news` (`id`, `catid`, `typeid`, `title`, `style`, `thumb`, `keywords`, `description`, `posids`, `url`, `listorder`, `status`, `sysadd`, `islink`, `username`, `inputtime`, `updatetime`, `uuid`, `updatestemp`, `glgg`, `sfzd`, `cw`, `yjjg`, `yjzz`, `glzt`, `classid`, `ggpj`, `titlefront`, `titleback`, `rrr`, `ispass`) VALUES (NULL, '$v[catid]', '0', '$v[title]', '', '', '', '', '0', '', '0', '', '1', '0', '', '$time', '$time', '', CURRENT_TIMESTAMP, '', '0', '0', '', '', '', '', '', '', '', '', '0')");
                    $id = $db->lastInsertId();
                    $db->exec("INSERT INTO `bl_news_data` (`id`, `content`, `groupids_view`, `paginationtype`, `maxcharperpage`, `template`, `paytype`, `relation`, `allow_comment`, `copyfrom`, `glzt`) VALUES ('$id', '$content', '', '', '', '', '0', '', '1', '', '')");
                    //echo "INSERT INTO `bl_news_data` (`id`, `content`, `groupids_view`, `paginationtype`, `maxcharperpage`, `template`, `paytype`, `relation`, `allow_comment`, `copyfrom`, `glzt`) VALUES ('$id', '$content', '', '', '', '', '0', '', '1', '', '')";
                    $db->exec("INSERT INTO `bl_catandat` (`catid`, `atid`, `modid`, `tstemp`) VALUES ('$v[catid]', '$id', '1', CURRENT_TIMESTAMP)");
                }else{
                    $catArr = explode(',', $v['catid']);
                    foreach($catArr as $k => $catid){
                        if($k == 0){
                            $db->exec("INSERT INTO `bl_news` (`id`, `catid`, `typeid`, `title`, `style`, `thumb`, `keywords`, `description`, `posids`, `url`, `listorder`, `status`, `sysadd`, `islink`, `username`, `inputtime`, `updatetime`, `uuid`, `updatestemp`, `glgg`, `sfzd`, `cw`, `yjjg`, `yjzz`, `glzt`, `classid`, `ggpj`, `titlefront`, `titleback`, `rrr`, `ispass`) VALUES (NULL, '$catid', '0', '$v[title]', '', '', '', '', '0', '', '0', '', '1', '0', '', '$time', '$time', '', CURRENT_TIMESTAMP, '', '0', '0', '', '', '', '', '', '', '', '', '0')");
                            $id = $db->lastInsertId();
                            $db->exec("INSERT INTO `bl_news_data` (`id`, `content`, `groupids_view`, `paginationtype`, `maxcharperpage`, `template`, `paytype`, `relation`, `allow_comment`, `copyfrom`, `glzt`) VALUES ('$id', '$content', '', '', '', '', '0', '', '1', '', '')");
                            $db->exec("INSERT INTO `bl_catandat` (`catid`, `atid`, `modid`, `tstemp`) VALUES ('$catid', '$id', '1', CURRENT_TIMESTAMP)");
                        }else{
                            $db->exec("INSERT INTO `bl_catandat` (`catid`, `atid`, `modid`, `tstemp`) VALUES ('$catid', '$id', '1', CURRENT_TIMESTAMP)");
                        }
                    }
                }
            }
        }
    }
}

function viewArr($data){
    echo '<pre>';
    print_r($data);
    echo '</pre1>';
}

function getData($url){
    return iconv('GBK', 'UTF-8//IGNORE', curl_get_contents($url));
}

/**
 *
 * @desc   ת��
 */
function detect($url)
{
    $con = curl_get_contents($url);
    $encode = strtolower(mb_detect_encoding($con,"ascii,utf-8,cp936,euc-cn,big-5,euc-tw,gb2312"));
    return iconv($encode, 'utf-8', $con);
}

/*
 * ͨ���޳��б�����Ĵ��룬���ж������Ƿ����õ������µĵ�ַ����
 */
function getList($data, $reg1, $reg2, $reg3, $date){
    $urls = array();
    preg_match($reg1, $data, $matches); //�޳��б����ⲿ��

    preg_match_all($reg2, $matches[0], $matches); //�޳��б����ⲿ��
    foreach($matches[1] as $v){
        if(strpos($v, $date) !== false){
            preg_match($reg3, $v, $matches);
            $urls[] = $matches[1];
        }
    }
    return $urls;
}

function delHtml($data){
    $data = trim($data);
    $data = preg_replace_callback("/<(\/?)a(.*?)>/is", function(){}, $data); //ȥ��a��ǩ
    $data = preg_replace_callback("/<(\/?)iframe(.*?)>/is", function(){}, $data); //ȥ��iframe��ǩ
    $data = preg_replace_callback('/<p style="text-align:right; font-size:12px; color:#666;">.*<\/p>/is', function(){}, $data);
    $data = preg_replace_callback('/<script(.*?)<\/script>/is', function(){}, $data); //ȥ��JavaScript
    $data = preg_replace_callback('/\n/is', function(){}, $data); //ȥ��JavaScript
    $data = preg_replace_callback('/<img(.*?)>/is', function(){}, $data); //ȥ��img
    $data = preg_replace_callback('/<!--(.*?)-->/is', function () {}, $data);
    $data = preg_replace_callback('/&nsbp;/is', function () {}, $data);
    //$data = strip_tags($data);
    return $data;
}

function curl_get_contents($url,$timeout=10) {
    $curlHandle = curl_init();
    curl_setopt( $curlHandle , CURLOPT_URL, $url );
    curl_setopt( $curlHandle , CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $curlHandle , CURLOPT_TIMEOUT, $timeout );
    $result = curl_exec( $curlHandle );
    curl_close( $curlHandle );
    return $result;
}
?>