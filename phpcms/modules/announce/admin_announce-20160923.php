<?php
defined('IN_PHPCMS') or exit('No permission resources.');
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
pc_base::load_app_class('admin','admin',0);
pc_base::load_sys_class('format','',0);
class admin_announce extends admin {

    private $db; public $username;
    public function __construct() {
        parent::__construct();
        //if (!module_exists(ROUTE_M)) showmessage(L('module_not_exists'));
        $this->username = param::get_cookie('admin_username');
        $this->db = pc_base::load_model('announce_model');
        $this->db1 = pc_base::load_model('content_model');
    }
    ////日刊列表
    public function init() {
        if(!isset($_GET['type']))
        {
            echo "非法参数！";
            exit;

        }
        $sql = ' `type`='.$_GET['type'];
        $page = max(intval($_GET['page']), 1);
        $data = $this->db->listinfo($sql, '`aid` DESC', $page);
        $big_menu=array();
        $big_menu[0] = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=announce&c=admin_announce&a=add&type='.$_GET['type'].'\', title:\'新增日刊\', width:\'400\', height:\'300\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', '新增');
        include $this->admin_tpl('announce_list');
    }


    /**
     * 复制文章列表
     */
    public function copylist() {
        $session = new session_mysql();
        $ids = unserialize($session->read('copyids'));
        $ids = implode(',', $ids);

        if(empty($ids)){
            include $this->admin_tpl('announce_copylist');
            exit;
        }
        $this->db1->set_model(12);

        $this->db1->query("select * from bl_diurnal where id in (".$ids.") order by id asc");
        $datas = $this->db1->fetch_array();
        include $this->admin_tpl('announce_copylist');

    }

    /**
     * 日刊文章列表
     */
    public function make() {

        $this->db1->set_model(13);
        $zbdp=$this->db1->get_one("rkid=".$_GET["rkid"],'id');
        if($zbdp){
            $zbdpAct="?m=content&c=content&a=edit&menuid=&catid=209&id=".$zbdp['id']."rkid=".$_GET["rkid"];
        }else{
            $zbdpAct="?m=content&c=content&a=add&menuid=&catid=209&rkid=".$_GET["rkid"];
        }
        $this->db1->set_model(12);
        $this->db1-> query("select a.*,b.catid as typeid,b.catname as name,c.createtime as time from bl_diurnal a left join bl_rkcats b on a.typeid=b.catid left join bl_announce c on a.rkid = c.aid where a.rkid= ".$_GET["rkid"]."  order by listorder,id asc");
        $datas =$this->db1->fetch_array();

        $big_menu=array();
        $big_menu[0]=array("javascript:openwinx('?m=content&c=content&a=add&menuid=&catid=29&rkid=".$_GET["rkid"]."&type=".$_GET["type"]."')",'新增文章',);
        $big_menu[1]=array("javascript:openwinx('".$zbdpAct."')",'总编点评',);
        $big_menu[2]=array("?m=announce&c=admin_announce&a=preview&rkid=".$_GET["rkid"]."&type=".$_GET["type"],'预览','_blank');
        $big_menu[3] = $_GET['type'] == '9999' ? NULL : array("javascript:createHtml('".$_GET["type"]."','".$_GET["rkid"]."')","发布");

        //文章剪切板有多条记录
        $session = new session_mysql();
        $ids = $session->read('copyids');
        if(empty($ids)){
            $num = 0;
        }else{
            $num = count(unserialize($ids));
        }
        $big_menu[4]=array("?m=announce&c=admin_announce&a=copylist", "待复制列表($num)", '_blank');
        if($_GET['type'] == '9999') {
            unset($big_menu[3]);
        }

        //列表页选择栏目
        $rkCatAarr = pc_base::load_config('rk', 'rk_conf');
        $classId = $rkCatAarr[intval($_GET['type'])]['classId'];
        $this->db->query("SELECT catid,catname FROM bl_rkcats WHERE parentclassid = '$classId' ORDER BY listorder ASC");
        $cats = $this->db->fetch_array();
        $pc_hash = $_GET['pc_hash'];
        include $this->admin_tpl('announce_make');
    }

    function changeclassid(){
        $id = $_POST['id'];
        $catid = $_POST['catid'];

        if($this->db->query("UPDATE bl_diurnal SET typeid = '$catid' WHERE id = '$id'")){
            echo 1;
        }else{
            echo 0;
        }
    }

    private function getRkData($rkId)
    {

        $data=array();
        /////////日刊基本信息///////
        $rkInfo=$this->db->get_one("aid=".$rkId);
        $data["rkinfo"]=$rkInfo;
        ////////////////总编点评////////////////
        $zbfp=array();
        $this->db1->set_model(13);
        $ret=$this->db1->get_one("rkid=".$rkId,"id");
        if($ret){
            $this->db1->table_name = $this->db1->table_name.'_data';
            $zbfp=$this->db1->get_one("id=".$ret["id"]);
        }

        $data["zbdp"]=$zbfp;
        //////////日刊数据////////////////
        $this->db1->set_model(12);
        $this->db1-> query("select a.*,b.catid as typeid,b.catname as  typename,e.bza,e.content from bl_diurnal a left join  bl_diurnal_data e on a.id = e.id join bl_rkcats b on a.typeid = b.catid where a.rkid= ".$_GET["rkid"]."  order by a.listorder asc");
        $rkList =$this->db1->fetch_array();
        $rkRes=array();
        $currTypeId=-1;
        foreach($rkList as $r) {
            if ($r['typeid'] == 0) {
                $haveToken = 1;
            }
            $rkRes[$r["typename"]][]=$r;
        }
        $data["rkres"]=$rkRes;
        $data['haveToken'] = isset($haveToken) ? $haveToken : 0;
        return $data;

    }
    //生成静态日刊
    public function creathtml() {
        $rk_assets_url = pc_base::load_config('rk','rk_assets_url');
        $rk_url=pc_base::load_config('rk','rk_url');
        $rk_content_url=pc_base::load_config('rk','rk_content_url');
        $rk_js_url=pc_base::load_config('rk','rk_js_url');
        $data=$this->getRkData($_GET["rkid"]);
        if($data['haveToken']){
            showmessage('有未选择类别的文章，无法发布！');
        }
        $rk_map=pc_base::load_config('rk','rk_conf');
        $title = $rk_map[$_GET["type"]]["title"];
        $type = isset($_GET['type']) ? intval($_GET['type']) : '';
        ob_start();
        if(in_array($type, array(0,4,12,14,15))){
            $words = "（与您相约每周一、周三、周五）";
        }if(in_array($type, array(3, 18))){
            $words = "（每周一出刊）";
        }if(in_array($type, array(16, 17))){
            $words = "（每周二出刊）";
        }
        if(in_array($type, array(0,1,3))){
            include template('announce', 'template0');
        }else{
            if($type ==19){
	            include template('announce', 'template19');
	        }else{
	            include template('announce', 'template1');
	        }
        }
        $centent=ob_get_contents();
        ob_end_clean();

        $rkPath = pc_base::load_config('rk','rk_path');
        $fileName = "diurnal_". $data["rkinfo"]["createtime"]."_".$rk_map[$_GET["type"]]["classId"].".html";
        file_put_contents($rkPath.$fileName, $centent);

        //ftp0
        $conn = ftp_connect("172.16.94.240") or die("Could not connect 0");
        if($conn){
            $login_result = ftp_login($conn,"new","123456");
            if($login_result){
                if(ftp_put($conn,$fileName,$rkPath.$fileName,FTP_ASCII)){

                }
                else{
                    echo "221发布失败！";
                    exit;
                }
            }else{
                echo "221ftp服务器登录失败！";
                exit;
            }
            ftp_close($conn);
        }else{
            echo "221ftp服务器连接失败！";
            exit;
        }

        //ftp1
        $conn = ftp_connect("58.49.110.232") or die("Could not connect 1");
        if($conn){
            $login_result=ftp_login($conn,"new","123456");
            if($login_result){
                if(ftp_put($conn, '/'.date('Ym').'/'.$fileName, $rkPath.$fileName, FTP_ASCII)){

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

        //ftp2
        $conn = ftp_connect("172.16.94.233") or die("Could not connect 2");
        if($conn){
            $login_result=ftp_login($conn,"new","123456");
            if($login_result){
                if(ftp_put($conn, '/'.date('Ym').'/'.$fileName, $rkPath.$fileName, FTP_ASCII)){
                    $this->db->update(array('status' => 1), 'aid = '.$_GET['rkid']);
                    echo '发布成功！';
                }
                else{
                    echo "z发布失败！";
                }
            }else{
                echo "zftp服务器登录失败！";
            }
            ftp_close($conn);
        }else{
            echo "zftp服务器连接失败！";
        }
    }

    private function getTypeInfo($typeid){
        $typeinfoarr = array(
            0 => '剖析经济政策 洞察全球趋势',
            1 => '透视股市政策 把握战略方向',
            2 => '洞悉机构资金动向 了解全球投行策略',
            3 => '资政参考 人物历史 焦点背景',
            4 => '角度决定方向',
            5 => '证券市场重大政策消息速递',
            6 => '趋势把握节奏 策略引导方向',
            7 => '热股聚焦 公司调研 个股消息',
            8 => '热点板块 行业研究 行业政策',
            9 => '新兵上阵 妖股观察',
            10 => '预判趋势演绎 精研双融标的',
            11 => '多维度判研香港市场',
            12 => '香港经济 恒指走势 港股评级 个股消息',
            13 => '消息激发波动',
            14 => '关注海外大势 外媒视角看中国',
            15 => '纵横国际风云 品评天下大事',
            16 => '《首席证券内参》一周精华',
            17 => '《中国首席财经》一周精华',
            18 => '聚焦一周精华 展望未来机遇',
        );
        return $typeinfoarr[$typeid];
    }


    //预览日刊
    public function preview() {
        header('Content-type: text/html; charset=utf-8');
        $rk_assets_url = pc_base::load_config('rk','rk_assets_url');
        $rk_url=pc_base::load_config('rk','rk_url');
        $rk_content_url=pc_base::load_config('rk','rk_content_url');
        $rk_js_url=pc_base::load_config('rk','rk_js_url');
        $rk_map=pc_base::load_config('rk','rk_conf');
        $title = $rk_map[$_GET["type"]]["title"];
        $data=$this->getRkData($_GET["rkid"]);
        $type = isset($_GET['type']) ? intval($_GET['type']) : '';
        $typeinfo = $this->getTypeInfo($type);
        $tempplateName = in_array($type, array(0,1,3)) ? 'template0' : 'template1';
        if($type ==19){
            $tempplateName='template19';
        }
        if(in_array($type, array(0,4,12,14,15))){
            $words = "（与您相约每周一、周三、周五）";
        }if(in_array($type, array(3, 18))){
            $words = "（每周一出刊）";
        }if(in_array($type, array(16, 17))){
            $words = "（每周二出刊）";
        }

        if($data['haveToken'] && $_GET['type'] != 9999){
            showmessage('有未选择类别的文章，无法预览,双击未选择可以修改栏目！');
        }
        include template('announce', $tempplateName);
    }




    /**
     * 添加日刊
     */
    public function add() {
        if(isset($_POST['dosubmit'])) {
            if($this->db->insert($_POST['announce'])) showmessage(L('announcement_successful_added'), HTTP_REFERER, '5', 'add');
        } else {
            pc_base::load_sys_class('form', '', 0);
            include $this->admin_tpl('announce_add');
        }
    }


    public function edit() {
        $_GET['aid'] = intval($_GET['aid']);
        if(!$_GET['aid']) showmessage(L('illegal_operation'));
        if(isset($_POST['dosubmit'])) {
            //$_POST['announce'] = $this->check($_POST['announce'], 'edit');
            if($this->db->update($_POST['announce'], array('aid' => $_GET['aid']))) showmessage(L('announced_a'), HTTP_REFERER, '', 'edit');
        } else {
            $where = array('aid' => $_GET['aid']);
            $an_info = $this->db->get_one($where);
            pc_base::load_sys_class('form', '', 0);
            include $this->admin_tpl('announce_edit');
        }
    }

    /**
     * 批量删除
     */
    public function delete($aid = 0) {
        if((!isset($_POST['aid']) || empty($_POST['aid'])) && !$aid) {
            showmessage(L('illegal_operation'));
        } else {
            $subDb= pc_base::load_model('content_model');
            if(is_array($_POST['aid']) && !$aid) {
                array_map(array($this, 'delete'), $_POST['aid']);

                foreach($_POST['aid'] as $val)
                {
                    //1
                    $subDb->set_model(12);
                    $subDb->delete('rkid='.$val);
                    //2
                    $subDb->set_model(13);
                    $subDb->delete('rkid='.$val);
                }
                showmessage('删除成功!', HTTP_REFERER);
            } elseif($aid) {
                $aid = intval($aid);
                $this->db->delete(array('aid' => $aid));
                //1
                $subDb->set_model(12);
                $subDb->delete('rkid='.$aid);
                //2
                $subDb->set_model(13);
                $subDb->delete('rkid='.$aid);
            }
        }
    }
















}
?>