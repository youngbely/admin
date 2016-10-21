<?php
defined('IN_PHPCMS') or exit('No permission resources.');
//define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
pc_base::load_app_class('admin','admin',0);
//pc_base::load_sys_class('format','',0);
class pdf extends admin
{

    private $db;
    public $username;

    public function __construct()
    {
        parent::__construct();
        //if (!module_exists(ROUTE_M)) showmessage(L('module_not_exists'));
        $this->username = param::get_cookie('admin_username');
        $this->db = pc_base::load_model('dhyb_model');
//        $this->db1 = pc_base::load_model('content_model');
    }

    ////列表
    public function init()
    {
//        echo '<pre>';
//        print_r($_REQUEST);die;
//        if (!empty($_REQUEST['lanmu']) && empty($_REQUEST['cjr'])){
//            $sql = "lanmu='{$_REQUEST['lanmu']}'";
//        } elseif (empty($_REQUEST['lanmu']) && !empty($_REQUEST['cjr'])){
//            $sql = "name='{$_REQUEST['cjr']}'";
//        } elseif (!empty($_REQUEST['lanmu']) && !empty($_REQUEST['cjr'])){
//            $sql = "name='{$_REQUEST['cjr']}' and lanmu='{$_REQUEST['lanmu']}'";
//        } else {
//            $sql = "type='sc'";
//        }
        $bt = empty($_REQUEST['bt'])?'1=1':"title like '%{$_REQUEST['bt']}%'";//标题
        $start_time = empty($_REQUEST['start_time'])?'1=1':"CreateTimeID>='{$_REQUEST['start_time']} 00:00:00'";
        $end_time = empty($_REQUEST['end_time'])?'1=1':"CreateTimeID<='{$_REQUEST['end_time']} 23:59:59'";
        $lanmu = empty($_REQUEST['lanmu'])?'1=1':"lanmu='{$_REQUEST['lanmu']}'";
        $cjr = empty($_REQUEST['cjr'])?'1=1':"name='{$_REQUEST['cjr']}'";

        if($bt!='1=1' || $start_time!='1=1' || $end_time!='1=1' || $lanmu!='1=1' || $cjr!='1=1') {
            $sql = "{$cjr} and {$lanmu} and {$bt} and {$start_time} and {$end_time}";
        }else{
            $sql = "type='sc'";
        }
//echo $sql;die;
        $rows = $this->db->select();
//        echo '<pre>';
//        print_r($rows);die;
//        if (!isset($_GET['type'])) {
//            echo "非法参数！";
//            exit;
//
//        }

        $username = $this->username;
//        $sql = ' `type`=' . '\''.$_GET['type']. '\'';
        $page = max(intval($_GET['page']), 1);
        $data = $this->db->listinfo($sql, '`id` DESC', $page);
//        echo '<pre>';print_r($data);die;
        $big_menu = array();
        $hash = $_REQUEST['pc_hash'];
//        echo $hash;
//        $big_menu[0] = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=announce&c=admin_announce&a=add&type=' . $_GET['type'] . '\', title:\'新增日刊\', width:\'400\', height:\'300\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', '新增');
        include $this->admin_tpl('upload');
    }

    /**
     * 批量删除
     */
    public function delete($aid = 0) {
        if((!isset($_POST['id']) || empty($_POST['id'])) && !$aid) {
            showmessage(L('illegal_operation'));
        } else {
            $subDb= pc_base::load_model('content_model');
            if(is_array($_POST['id']) && !$aid) {
                array_map(array($this, 'delete'), $_POST['id']);

                $link = mysql_connect('localhost','root','123456');
                mysql_select_db('bolanadmin',$link);

                foreach($_POST['id'] as $val)
                {
                    //1
                    $subDb->set_model(12);
                    $subDb->delete('rkid='.$val);
                    //2
                    $subDb->set_model(13);
                    $subDb->delete('rkid='.$val);
                //同时删除关键词
                $sql = "delete from Keyword where dhyb_id={$val}";
                mysql_query($sql);
                }

                showmessage('删除成功!', HTTP_REFERER);
            } elseif($aid) {
                $aid = intval($aid);
                $this->db->delete(array('id' => $aid));
                //1
                $subDb->set_model(12);
                $subDb->delete('id='.$aid);
                //2
                $subDb->set_model(13);
                $subDb->delete('id='.$aid);
            }
        }
    }

}
?>