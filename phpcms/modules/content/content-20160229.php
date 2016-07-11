<?php
set_time_limit(300);
defined('IN_PHPCMS') or exit('No permission resources.');
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
define('RELATION_HTML',true);
pc_base::load_app_class('admin','admin',0);
pc_base::load_sys_class('form','',0);
pc_base::load_app_func('util');
pc_base::load_sys_class('format','',0);

class content extends admin {
    private $db,$priv_db;
    public $siteid,$categorys;
    public function __construct() {
        parent::__construct();
        $this->db = pc_base::load_model('content_model');
        $this->siteid = $this->get_siteid();
        $this->categorys = getcache('category_content_'.$this->siteid,'commons');
        if(isset($_GET['catid']) && $_SESSION['roleid'] != 1 && ROUTE_A !='pass' && strpos(ROUTE_A,'public_')===false) {
            $catid = intval($_GET['catid']);
            $this->priv_db = pc_base::load_model('category_priv_model');
            $action = $this->categorys[$catid]['type']==0 ? ROUTE_A : 'init';
            $priv_datas = $this->priv_db->get_one(array('catid'=>$catid,'is_admin'=>1,'action'=>$action));
            if(!$priv_datas) showmessage(L('permission_to_operate'),'blank');
        }
    }

    public function init() {
        $show_header = $show_dialog  = $show_pc_hash = '';
        if(isset($_GET['catid']) && $_GET['catid'] && $this->categorys[$_GET['catid']]['siteid']==$this->siteid) {
            $catid = $_GET['catid'] = intval($_GET['catid']);
            $category = $this->categorys[$catid];
            $modelid = $category['modelid'];
            $this->db->set_model($modelid);
            $this->db->table_name="bl_news_view";
            if($this->db->table_name==$this->db->db_tablepre) showmessage(L('model_table_not_exists'));

            if($catid==5584){//草稿箱
                $userName=param::get_cookie('admin_username');
                $where = " cid=".$catid."  and TRIM(username)='".$userName."'";
            }else{
                $time = strtotime(date('Y-m-d', time()));
                if($_GET['menuid'] == 1532){
                    $where = "cid=" . $catid." AND ispass = 0";
                }else{
                    $where = "cid=" . $catid." AND ispass = 1";
                }
            }

            //搜索
            if(isset($_GET['ispass'])) {
                $where = "cid=" . $catid." AND ispass = 0";
            }
            if(isset($_GET['start_time']) && $_GET['start_time']) {
                $start_time = strtotime($_GET['start_time'].' 00:00:00');
                $where .= " AND `inputtime` >='$start_time'";
            }
            if(isset($_GET['end_time']) && $_GET['end_time']) {
                $end_time = strtotime($_GET['end_time'].' 23:59:59');
                $where .= " AND `inputtime`<='$end_time'";
            }
            //if($start_time>$end_time) showmessage(L('starttime_than_endtime'));
            //echo $_GET['keyword'];
            if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
                $keyword=$_GET['keyword'];
                $where .= " AND `title` like '%$keyword%'";

            }
            //$pagesize = 20, $key='', $setpages = 10,$urlrule = '',$array = array(), $data = '*'
            //echo $category['parentid'].'<br>';
            //echo $where;exit;
            $datas = $this->db->listinfo($where,'id desc',$_GET['page'],20,'',10,'', array(),'*');
            $pages = $this->db->pages;
            $pc_hash = $_SESSION['pc_hash'];
            //$model_fields = getcache('model_field_'.$modelid, 'model');
            //$setting = string2array($model_fields['thumb']['setting']);
            //$args = '1,'.$setting['upload_allowext'].','.$setting['isselectimage'].','.$setting['images_width'].','.$setting['images_height'].','.$setting['watermark'];
            //$authkey = upload_key($args);
            //$template = $MODEL['admin_list_template'] ? $MODEL['admin_list_template'] : 'content_list';
            $template = 'content_list';
            $ispassArr = array('否', '是');
            include $this->admin_tpl($template);
        } else {
            include $this->admin_tpl('content_quick');
        }
    }

    private function createGuid() {
        $charid = strtoupper(md5(uniqid(mt_rand(), true)));
        $hyphen = "";// "-"
        $uuid = substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
        return $uuid;
    }
    public function add() {
        if(isset($_POST['dosubmit']) || isset($_POST['dosubmit_continue'])) {
            $catid = $_POST['info']['catid'] = intval($_POST['info']['catid']);
            $_POST['info']['content'] = $catid == 29 ? preg_replace("/<a(.*)>(.*)<\/a>/iU", '${2}', $_POST['info']['content']) : $_POST['info']['content']; //如果是日刊，则去掉a标签
            $category = $this->categorys[$catid];
            $modelid = $category['modelid'];
            $classId=$category['classid'];
            $this->db->set_model($modelid);
            $_POST['info']['uuid'] = $this->createGuid();
            $_POST['info']['classid'] = $classId;
            $_POST['info']['description'] = preg_replace_callback('/\x{200b}/u', function($maches){return '';}, $_POST['info']['description']);
            $_POST['info']['title'] = preg_replace_callback('/\x{200b}/u', function($maches){return '';}, $_POST['info']['title']);
            $_POST['info']['keywords'] = preg_replace_callback('/\x{200b}/u', function($maches){return '';}, $_POST['info']['keywords']);
            //var_dump($_POST['info']['title']);exit;
            $this->db->add_content($_POST['info']);//保存内容
            showmessage(L('add_success').L('2s_close'),'blank','','','function set_time() {$("#secondid").html(1);window.opener.location.reload();}setTimeout("set_time()", 500);setTimeout("window.close()", 1200);');
        } else {
            $show_header = $show_dialog = $show_validator = '';
            //设置cookie 在附件添加处调用
            param::set_cookie('module', 'content');

            if(isset($_GET['catid']) && $_GET['catid']) {
                $catid = $_GET['catid'] = intval($_GET['catid']);

                param::set_cookie('catid', $catid);
                $category = $this->categorys[$catid];

                $modelid = $category['modelid'];
                //取模型ID，依模型ID来生成对应的表单
                require CACHE_MODEL_PATH.'content_form.class.php';
                $content_form = new content_form($modelid,$catid,$this->categorys);
                $forminfos = $content_form->get();

                unset( $forminfos["senior"]["template"]);
                unset( $forminfos["base"]["uuid"]);
                unset( $forminfos["base"]["classid"]);
                //var_dump($forminfos);exit;
                if(isset( $forminfos["base"]["rkid"]))
                {
                    unset($forminfos["base"]["catid"]);
                    unset($forminfos["base"]["rkid"]);
                    $forminfos["senior"]["inputtime"]["name"].='<input type="hidden" name="info[catid]" value="'.$catid.'">';
                    $forminfos["senior"]["inputtime"]["name"].="<input type='hidden'  name='info[rkid]' value='".$_GET["rkid"]."'>";

                }

                if($catid==209)
                {

                    unset( $forminfos["base"]["title"]);

                }


                //$formValidator = $content_form->formValidator;
                if( isset ( $forminfos["base"]["glgg"]))
                {
                    $forminfos["base"]["glgg"]["form"].='&nbsp;&nbsp;&nbsp;&nbsp;<input value="提取股票代码" type="button" name="close" onclick="getStockCode()" class="cu" style="width:120px; height:30px;">&nbsp;&nbsp;<input value="清除股票代码" type="button" name="close" onclick="clearStockCodes()" class="cu" style="width:120px; height:30px;">';

                }

                //print_r($forminfos);exit;
                $admin_username = param::get_cookie('admin_username');
                unset($forminfos['base']['bza']);  //去掉编者按
                include $this->admin_tpl('content_add');
            }

        }
    }

    public function edit() {
        //设置cookie 在附件添加处调用
        param::set_cookie('module', 'content');
        if(isset($_POST['dosubmit']) || isset($_POST['dosubmit_continue'])) {
            $id = $_POST['info']['id'] = intval($_POST['id']);
            $catid = $_POST['info']['catid'] = intval($_POST['info']['catid']);
            $_POST['info']['content'] = $catid == 29 ? preg_replace("/<a(.*)>(.*)<\/a>/iU", '${2}', $_POST['info']['content']) : $_POST['info']['content']; //如果是日刊，则去掉a标签
            $modelid = $this->categorys[$catid]['modelid'];
            $this->db->set_model($modelid);
            $_POST['info']['description'] = preg_replace_callback('/\x{200b}/u', function($maches){return '';}, $_POST['info']['description']);
            $_POST['info']['title'] = preg_replace_callback('/\x{200b}/u', function($maches){return '';}, $_POST['info']['title']);
            $_POST['info']['keywords'] = preg_replace_callback('/\x{200b}/u', function($maches){return '';}, $_POST['info']['keywords']);
            $this->db->edit_content($_POST['info'],$id);
            showmessage(L('add_success').L('2s_close'),'blank','','','function set_time() {$("#secondid").html(1);window.opener.location.reload();}setTimeout("set_time()", 500);setTimeout("window.close()", 1200);');
        } else {
            $show_header = $show_dialog = $show_validator = '';
            //从数据库获取内容
            $id = intval($_GET['id']);
            if(!isset($_GET['catid']) || !$_GET['catid']) showmessage(L('missing_part_parameters'));
            $catid = $_GET['catid'] = intval($_GET['catid']);
            $this->model = getcache('model', 'commons');
            param::set_cookie('catid', $catid);
            $category = $this->categorys[$catid];
            $modelid = $category['modelid'];
            $this->db->table_name = $this->db->db_tablepre.$this->model[$modelid]['tablename'];
            $r = $this->db->get_one(array('id'=>$id));
            $this->db->table_name = $this->db->table_name.'_data';
            $r2 = $this->db->get_one(array('id'=>$id));
            if(!$r2) showmessage(L('subsidiary_table_datalost'),'blank');
            $data = array_merge($r,$r2);
            $data = array_map('htmlspecialchars_decode',$data);
            require CACHE_MODEL_PATH.'content_form.class.php';
            $content_form = new content_form($modelid,$catid,$this->categorys);
            $forminfos = $content_form->get($data);
            unset( $forminfos["senior"]["template"]);
            unset( $forminfos["base"]["uuid"]);
            unset( $forminfos["base"]["classid"]);
            if(isset( $forminfos["base"]["rkid"])){
                unset($forminfos["base"]["catid"]);
                unset($forminfos["base"]["rkid"]);
                $forminfos["senior"]["inputtime"]["name"].='<input type="hidden" name="info[catid]" value="'.$data['catid'].'">';
                $forminfos["senior"]["inputtime"]["name"].="<input type='hidden'  name='info[rkid]' value='".$data["rkid"]."'>";
            }
            if($catid==209)
            {
                unset( $forminfos["base"]["title"]);
            }
            //$formValidator =$content_form->formValidator;
            if( isset ( $forminfos["base"]["glgg"]))
            {
                $forminfos["base"]["glgg"]["form"].='&nbsp;&nbsp;&nbsp;&nbsp;<input value="提取股票代码" type="button" name="close" onclick="getStockCode()" class="cu" style="width:120px; height:30px;">&nbsp;&nbsp;<input value="清除股票代码" type="button" name="close" onclick="clearStockCodes()" class="cu" style="width:120px; height:30px;">';

            }
            unset($forminfos['base']['bza']);  //去掉编者按
            include $this->admin_tpl('content_edit');
        }

    }

    /*
     * 复制文章
     */
    public function copy(){
        if(isset($_GET['dosubmit'])){
            $session = new session_mysql();
            $ids = $_POST['ids'];
            if(empty($ids)) {
                showmessage('请选择要复制的文章！', HTTP_REFERER, '1000');
            }
            $data = $session->read('copyids');
            if(!empty($data)){
                $cookie = unserialize($data);
                $newdata = array_merge($ids, $cookie);
                $newdata = array_flip(array_flip($newdata));
                $session->write('copyids', serialize($newdata));
                $session->close();
                showmessage('复制成功！', HTTP_REFERER, '1000');
            }else {
                if(!empty($ids)) {
                    $session->write('copyids', serialize($ids));
                    $session->close();
                    showmessage('复制成功！', HTTP_REFERER, '1000');
                }else{
                    showmessage('请选择要复制的文章！', HTTP_REFERER, '1000');
                }
            }

        }
    }

    /*
     * 粘贴文章
     */
    public function paste(){
        if(isset($_GET['dosubmit'])){
            $typeid = intval($_POST['typeid']);
            $rkid = intval($_POST['rkid']);

            $session = new session_mysql();
            $ids = $session->read('copyids');
            if(empty($ids)){
                showmessage('复制文章列表为空，粘贴失败！', HTTP_REFERER, '1000');
            }else{
                $ids = unserialize($ids);

                foreach($ids as $v){
                    $this->db->query("SELECT * FROM bl_diurnal a left join bl_diurnal_data b on a.id = b.id WHERE a.id = ".$v);
                    $art = $this->db->fetch_array();
                    $art = $art[0];
                    $data0 = array(
                        'catid' => 29,
                        'typeid' => 0, //'未选择类别'
                        'title' => $art['title'],
                        'style' => $art['style'],
                        'thumb' => $art['thumb'],
                        'keywords' => $art['keywords'],
                        'description' => $art['description'],
                        'posids' => $art['posids'],
                        'url' => $art['url'],
                        'listorder' => 0,
                        'status' => 0,
                        'sysadd' => $art['sysadd'],
                        'username' => $art['username'],
                        'inputtime' => $art['inputtime'],
                        'updatetime' => $art['updatetime'],
                        'rkid' => $rkid,
                        'yjy' => $art['yjy'],
                        'updatestemp' => $art['updatestemp'],
                        'uuid' => $art['uuid'],
                        'classid' => '0',
                    );

                    $this->db->table_name = 'bl_diurnal';
                    $this->db->insert($data0);
                    $id = $this->db->insert_id();

                    $data1 = array(
                        'id' => $id,
                        'content' => $art['content'],
                        'groupids_view' => $art['groupids_view'],
                        'paginationtype' => $art['paginationtype'],
                        'maxcharperpage' => $art['maxcharperpage'],
                        'template' => $art['template'],
                        'paytype' => $art['paytype'],
                        'relation' => $art['relation'],
                        'bza' => $art['bza']
                    );
                    $this->db->table_name = 'bl_diurnal_data';
                    $this->db->insert($data1);
                }
                $pc_hash = htmlspecialchars($_GET['pc_hash']);
                showmessage("粘贴成功！");
            }
        }
    }

    /*
    * 清空复制文章
    */
    public function delcopylist(){
        if(isset($_GET['dosubmit'])){
            $session = new session_mysql();
            $data = $session->write('copyids', '');
            $session->close();
            showmessage('复制列表已清空！', HTTP_REFERER, '1000');
        }
    }

    /**
     * 删除
     */
    public function delete() {
        if(isset($_GET['dosubmit'])) {
            $catid = intval($_GET['catid']);
            if(!$catid) showmessage(L('missing_part_parameters'));
            $modelid = $this->categorys[$catid]['modelid'];
            $this->db->set_model($modelid);

            // print_r($_POST['ids']);exit;
            /*if(isset($_GET['ajax_preview'])) {
                $ids = intval($_GET['id']);
                $_POST['ids'] = array(0=>$ids);
            }*/
            if(empty($_POST['ids'])) showmessage(L('you_do_not_check'));

            foreach($_POST['ids'] as $id) {

                $this->db->delete_content($id,$fileurl,$catid);
            }
            showmessage(L('operation_success'),HTTP_REFERER);
        } else {
            showmessage(L('operation_failure'));
        }
    }

    /**
     * 排序
     */
    public function listorder() {
        if(isset($_GET['dosubmit'])) {


            $catid = intval($_GET['catid']);
            if(!$catid) showmessage(L('missing_part_parameters'));
            $modelid = $this->categorys[$catid]['modelid'];

            $this->db->set_model($modelid);
            foreach($_POST['listorders'] as $id => $listorder) {
                //echo "$id-$listorder<br>";
                $this->db->update(array('listorder'=>$listorder),array('id'=>$id));
            }
            showmessage(L('operation_success'),HTTP_REFERER);
        } else {
            showmessage(L('operation_failure'));
        }
    }
    /**
     * 显示栏目菜单列表
     */
    public function public_categorys() {
        $show_header = '';
        $cfg = getcache('common','commons');
        $ajax_show = intval($cfg['category_ajax']);
        $from = isset($_GET['from']) && in_array($_GET['from'],array('block')) ? $_GET['from'] : 'content';
        $tree = pc_base::load_sys_class('tree');
        if($from=='content' && $_SESSION['roleid'] != 1) {
            $this->priv_db = pc_base::load_model('category_priv_model');
            $priv_result = $this->priv_db->select(array('action'=>'init','roleid'=>$_SESSION['roleid'],'siteid'=>$this->siteid,'is_admin'=>1));
            $priv_catids = array();
            foreach($priv_result as $_v) {
                $priv_catids[] = $_v['catid'];
            }
            if(empty($priv_catids)) return '';
        }
        $categorys = array();

        if(!empty($this->categorys)) {
            unset($this->categorys[29]);
            unset($this->categorys[209]);
            //如果菜单是 1534（智能抓取）
            if($_GET['menuid'] == 1532){
                unset($this->categorys[3940]);
                unset($this->categorys[4710]);
                unset($this->categorys[5443]);
                unset($this->categorys[4918]);
                unset($this->categorys[5103]);
                unset($this->categorys[5446]);
            }
            foreach($this->categorys as $r) {
                if($r['siteid']!=$this->siteid ||  ($r['type']==2 && $r['child']==0)) continue;
                if($from=='content' && $_SESSION['roleid'] != 1 && !in_array($r['catid'],$priv_catids)) {
                    $arrchildid = explode(',',$r['arrchildid']);
                    $array_intersect = array_intersect($priv_catids,$arrchildid);
                    if(empty($array_intersect)) continue;
                }
                if($r['type']==1 || $from=='block') {
                    if($r['type']==0) {
                        $r['vs_show'] = "<a href='?m=block&c=block_admin&a=public_visualization&menuid=".$_GET['menuid']."&catid=".$r['catid']."&type=show' target='right'>[".L('content_page')."]</a>";
                    } else {
                        $r['vs_show'] ='';
                    }
                    $r['icon_type'] = 'file';
                    $r['add_icon'] = '';
                    $r['type'] = 'add';
                } else {
                    $r['icon_type'] = $r['vs_show'] = '';
                    $r['type'] = 'init';
                    $r['add_icon'] = "<a target='right' href='?m=content&c=content&menuid=".$_GET['menuid']."&catid=".$r['catid']."' onclick=javascript:openwinx('?m=content&c=content&a=add&menuid=".$_GET['menuid']."&catid=".$r['catid']."&hash_page=".$_SESSION['hash_page']."','')><img src='".IMG_PATH."add_content.gif' alt='".L('add')."'></a> ";
                }
                $categorys[$r['catid']] = $r;
            }
        }

        if(!empty($categorys)) {
            $tree->init($categorys);
            switch($from) {
                case 'block':
                    $strs = "<span class='\$icon_type'>\$add_icon<a href='?m=block&c=block_admin&a=public_visualization&menuid=".$_GET['menuid']."&catid=\$catid&type=list' target='right'>\$catname</a> \$vs_show</span>";
                    $strs2 = "<img src='".IMG_PATH."folder.gif'> <a href='?m=block&c=block_admin&a=public_visualization&menuid=".$_GET['menuid']."&catid=\$catid&type=category' target='right'>\$catname</a>";
                    break;

                default:
                    $strs = "<span class='\$icon_type'>\$add_icon<a href='?m=content&c=content&a=\$type&menuid=".$_GET['menuid']."&catid=\$catid' target='right' onclick='open_list(this)'>\$catname</a></span>";
                    $strs2 = "<span class='folder'>\$catname</span>";
                    break;
            }
            $categorys = $tree->get_treeview(0,'category_tree',$strs,$strs2,$ajax_show);
        } else {
            $categorys = L('please_add_category');
        }

        include $this->admin_tpl('category_tree');
        exit;
    }
    /**
     * 检查标题是否存在
     */
    public function public_check_title() {
        if($_GET['data']=='' || (!$_GET['catid'])) return '';
        $catid = intval($_GET['catid']);
        $modelid = $this->categorys[$catid]['modelid'];
        $this->db->set_model($modelid);
        $title = $_GET['data'];
        if(CHARSET=='gbk') $title = iconv('utf-8','gbk',$title);
        $r = $this->db->get_one(array('title'=>$title));
        if($r) {
            exit('1');
        } else {
            exit('0');
        }
    }

    /**
     * 修改某一字段数据
     */
    public function update_param() {
        $id = intval($_GET['id']);
        $field = $_GET['field'];
        $modelid = intval($_GET['modelid']);
        $value = $_GET['value'];
        if (CHARSET!='utf-8') {
            $value = iconv('utf-8', 'gbk', $value);
        }
        //检查字段是否存在
        $this->db->set_model($modelid);
        if ($this->db->field_exists($field)) {
            $this->db->update(array($field=>$value), array('id'=>$id));
            exit('200');
        } else {
            $this->db->table_name = $this->db->table_name.'_data';
            if ($this->db->field_exists($field)) {
                $this->db->update(array($field=>$value), array('id'=>$id));
                exit('200');
            } else {
                exit('300');
            }
        }
    }

    /**
     * 图片裁切
     */
    public function public_crop() {
        if (isset($_GET['picurl']) && !empty($_GET['picurl'])) {
            $picurl = $_GET['picurl'];
            $catid = intval($_GET['catid']);
            if (isset($_GET['module']) && !empty($_GET['module'])) {
                $module = $_GET['module'];
            }
            $show_header =  '';
            include $this->admin_tpl('crop');
        }
    }
    /**
     * 相关文章选择
     */
    public function public_relationlist() {
        pc_base::load_sys_class('format','',0);
        $show_header = '';
        $model_cache = getcache('model','commons');
        if(!isset($_GET['modelid'])) {
            showmessage(L('please_select_modelid'));
        } else {
            $page = intval($_GET['page']);

            $modelid = intval($_GET['modelid']);
            $this->db->set_model($modelid);
            $where = 'id not in(select atid from `bl_catandat` where catid=5584 and modid='.$modelid.')';
            if($_GET['catid']) {
                $catid = intval($_GET['catid']);
                $where .= 'AND id in(select atid from `bl_catandat` where catid='.$catid.' and modid='.$modelid.')';
            }
            //$where .= $where ?  ' AND status=99' : 'status=99';

            if(isset($_GET['keywords'])) {
                $keywords = trim($_GET['keywords']);
                $field = $_GET['field'];
                if(in_array($field, array('id','title','keywords','description'))) {
                    if($field=='id') {
                        $where .= " AND `id` ='$keywords'";
                    } else {
                        $where .= " AND `$field` like '%$keywords%'";
                    }
                }
            }
            $infos = $this->db->listinfo($where,'id desc',$_GET['page'],12,'',10,'', array(),'*,getcatnames(id) as catnames');
            $pages = $this->db->pages;
            include $this->admin_tpl('relationlist');
        }
    }
    public function public_getjson_ids() {
        $modelid = intval($_GET['modelid']);
        $id = intval($_GET['id']);
        $this->db->set_model($modelid);
        $tablename = $this->db->table_name;
        $this->db->table_name = $tablename.'_data';
        $r = $this->db->get_one(array('id'=>$id),'relation');

        if($r['relation']) {
            $relation = str_replace('|', ',', $r['relation']);
            $relation = trim($relation,',');
            $where = "id IN($relation)";
            $infos = array();
            $this->db->table_name = $tablename;
            $datas = $this->db->select($where,'id,title');
            foreach($datas as $_v) {
                $_v['sid'] = 'v'.$_v['id'];
                if(strtolower(CHARSET)=='gbk') $_v['title'] = iconv('gbk', 'utf-8', $_v['title']);
                $infos[] = $_v;
            }
            echo json_encode($infos);
        }
    }

    //文章预览
    public function public_preview() {

        //echo "ddd";exit;
        $catid = intval($_GET['catid']);
        $id = intval($_GET['id']);

        if(!$catid || !$id) showmessage(L('missing_part_parameters'),'blank');
        $page = intval($_GET['page']);
        $page = max($page,1);
        $CATEGORYS = getcache('category_content_'.$this->get_siteid(),'commons');

        if(!isset($CATEGORYS[$catid]) || $CATEGORYS[$catid]['type']!=0) showmessage(L('missing_part_parameters'),'blank');
        define('HTML', true);
        $CAT = $CATEGORYS[$catid];

        $siteid = $CAT['siteid'];
        $MODEL = getcache('model','commons');
        $modelid = $CAT['modelid'];

        $this->db->table_name = $this->db->db_tablepre.$MODEL[$modelid]['tablename'];
        $r = $this->db->get_one(array('id'=>$id));
        if(!$r) showmessage(L('information_does_not_exist'));
        $this->db->table_name = $this->db->table_name.'_data';
        $r2 = $this->db->get_one(array('id'=>$id));
        $rs = $r2 ? array_merge($r,$r2) : $r;

        //再次重新赋值，以数据库为准
        $catid = $CATEGORYS[$r['catid']]['catid'];
        $modelid = $CATEGORYS[$catid]['modelid'];

        require_once CACHE_MODEL_PATH.'content_output.class.php';
        $content_output = new content_output($modelid,$catid,$CATEGORYS);
        $data = $content_output->get($rs);
        extract($data);
        $CAT['setting'] = string2array($CAT['setting']);
        $template = $template ? $template : $CAT['setting']['show_template'];
        $allow_visitor = 1;
        //SEO
        $SEO = seo($siteid, $catid, $title, $description);

        define('STYLE',$CAT['setting']['template_list']);
        if(isset($rs['paginationtype'])) {
            $paginationtype = $rs['paginationtype'];
            $maxcharperpage = $rs['maxcharperpage'];
        }
        $pages = $titles = '';
        if($rs['paginationtype']==1) {
            //自动分页
            if($maxcharperpage < 10) $maxcharperpage = 500;
            $contentpage = pc_base::load_app_class('contentpage');
            $content = $contentpage->get_data($content,$maxcharperpage);
        }
        if($rs['paginationtype']!=0) {
            //手动分页
            $CONTENT_POS = strpos($content, '[page]');
            if($CONTENT_POS !== false) {
                $this->url = pc_base::load_app_class('url', 'content');
                $contents = array_filter(explode('[page]', $content));
                $pagenumber = count($contents);
                if (strpos($content, '[/page]')!==false && ($CONTENT_POS<7)) {
                    $pagenumber--;
                }
                for($i=1; $i<=$pagenumber; $i++) {
                    $pageurls[$i][0] = 'index.php?m=content&c=content&a=public_preview&steps='.intval($_GET['steps']).'&catid='.$catid.'&id='.$id.'&page='.$i;
                }
                $END_POS = strpos($content, '[/page]');
                if($END_POS !== false) {
                    if($CONTENT_POS>7) {
                        $content = '[page]'.$title.'[/page]'.$content;
                    }
                    if(preg_match_all("|\[page\](.*)\[/page\]|U", $content, $m, PREG_PATTERN_ORDER)) {
                        foreach($m[1] as $k=>$v) {
                            $p = $k+1;
                            $titles[$p]['title'] = strip_tags($v);
                            $titles[$p]['url'] = $pageurls[$p][0];
                        }
                    }
                }
                //当不存在 [/page]时，则使用下面分页
                $pages = content_pages($pagenumber,$page, $pageurls);
                //判断[page]出现的位置是否在第一位
                if($CONTENT_POS<7) {
                    $content = $contents[$page];
                } else {
                    if ($page==1 && !empty($titles)) {
                        $content = $title.'[/page]'.$contents[$page-1];
                    } else {
                        $content = $contents[$page-1];
                    }
                }
                if($titles) {
                    list($title, $content) = explode('[/page]', $content);
                    $content = trim($content);
                    if(strpos($content,'</p>')===0) {
                        $content = '<p>'.$content;
                    }
                    if(stripos($content,'<p>')===0) {
                        $content = $content.'</p>';
                    }
                }
            }
        }
        $template="show";
        include template('content',"show");


    }





    /**
     * 同时发布到其他栏目
     */
    public function add_othors() {
        $show_header = '';
        $sitelist = getcache('sitelist','commons');
        $siteid = $_GET['siteid'];
        //unset(categorys[29]);
        //unset(categorys[209]);
        //$cat=$this->categorys;
        //unset($cat[29]);
        //unset($cat[209]);
        //print_r($this->categorys);exit;
        include $this->admin_tpl('add_othors');

    }
    /**
     * 同时发布到其他栏目 异步加载栏目
     */
    public function public_getsite_categorys() {
        $ccid=-1;
        if(isset($_GET['catid']))
            $ccid=$_GET["catid"];
        $siteid = intval($_GET['siteid']);
        $this->categorys = getcache('category_content_'.$siteid,'commons');
        $models = getcache('model','commons');
        $tree = pc_base::load_sys_class('tree');
        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $categorys = array();
        if($_SESSION['roleid'] != 1) {
            $this->priv_db = pc_base::load_model('category_priv_model');
            $priv_result = $this->priv_db->select(array('action'=>'add','roleid'=>$_SESSION['roleid'],'siteid'=>$siteid,'is_admin'=>1));
            $priv_catids = array();
            foreach($priv_result as $_v) {
                $priv_catids[] = $_v['catid'];
            }
            if(empty($priv_catids)) return '';
        }


        //echo $ccid;exit;
        foreach($this->categorys as $r) {
            if($r['siteid']!=$siteid || $r['type']!=0) continue;
            if($r['catid']==29 || $r['catid']==209 || $r['catid']==5584 || $r['catid']==5585 || $r['catid']==$ccid) continue;
            if($_SESSION['roleid'] != 1 && !in_array($r['catid'],$priv_catids)) {
                $arrchildid = explode(',',$r['arrchildid']);
                $array_intersect = array_intersect($priv_catids,$arrchildid);
                if(empty($array_intersect)) continue;
            }
            //$r['modelname'] = $models[$r['modelid']]['name'];
            $r['style'] = $r['child'] ? 'color:#8A8A8A;' : '';
            $r['click'] ='' ;//$r['child'] ? '' : "onclick=\"select_list(this,'".safe_replace($r['catname'])."',".$r['catid'].")\" class='cu' title='".L('click_to_select')."'";
            $r['checkbox'] = $r['child'] ? '' : ' <input type="checkbox" name="catids[]" value="'.$r['catid'].'" id="catid'.$r['catid'].'" />';
            $r['catname']="<span id='catname".$r['catid']."'>".$r['catname']."</span>";
            $categorys[$r['catid']] = $r;

        }
        $str  = "<tr \$click >
					<td align='center'>\$id </td>
					<td style='\$style'>\$spacer\$catname\$checkbox </td>
					<td align='center'></td>
				</tr>";
        $tree->init($categorys);
        $categorys = $tree->get_tree(0, $str);
        echo $categorys;
    }

    public function public_sub_categorys() {
        $cfg = getcache('common','commons');
        $ajax_show = intval(abs($cfg['category_ajax']));
        $catid = intval($_POST['root']);
        $modelid = intval($_POST['modelid']);
        $this->categorys = getcache('category_content_'.$this->siteid,'commons');
        $tree = pc_base::load_sys_class('tree');
        if(!empty($this->categorys)) {
            foreach($this->categorys as $r) {
                if($r['siteid']!=$this->siteid ||  ($r['type']==2 && $r['child']==0)) continue;
                if($from=='content' && $_SESSION['roleid'] != 1 && !in_array($r['catid'],$priv_catids)) {
                    $arrchildid = explode(',',$r['arrchildid']);
                    $array_intersect = array_intersect($priv_catids,$arrchildid);
                    if(empty($array_intersect)) continue;
                }
                if($r['type']==1 || $from=='block') {
                    if($r['type']==0) {
                        $r['vs_show'] = "<a href='?m=block&c=block_admin&a=public_visualization&menuid=".$_GET['menuid']."&catid=".$r['catid']."&type=show' target='right'>[".L('content_page')."]</a>";
                    } else {
                        $r['vs_show'] ='';
                    }
                    $r['icon_type'] = 'file';
                    $r['add_icon'] = '';
                    $r['type'] = 'add';
                } else {
                    $r['icon_type'] = $r['vs_show'] = '';
                    $r['type'] = 'init';
                    $r['add_icon'] = "<a target='right' href='?m=content&c=content&menuid=".$_GET['menuid']."&catid=".$r['catid']."' onclick=javascript:openwinx('?m=content&c=content&a=add&menuid=".$_GET['menuid']."&catid=".$r['catid']."&hash_page=".$_SESSION['hash_page']."','')><img src='".IMG_PATH."add_content.gif' alt='".L('add')."'></a> ";
                }
                $categorys[$r['catid']] = $r;
            }
        }
        if(!empty($categorys)) {
            $tree->init($categorys);
            switch($from) {
                case 'block':
                    $strs = "<span class='\$icon_type'>\$add_icon<a href='?m=block&c=block_admin&a=public_visualization&menuid=".$_GET['menuid']."&catid=\$catid&type=list&pc_hash=".$_SESSION['pc_hash']."' target='right'>\$catname</a> \$vs_show</span>";
                    break;

                default:
                    $strs = "<span class='\$icon_type'>\$add_icon<a href='?m=content&c=content&a=\$type&menuid=".$_GET['menuid']."&catid=\$catid&pc_hash=".$_SESSION['pc_hash']."' target='right' onclick='open_list(this)'>\$catname</a></span>";
                    break;
            }
            $data = $tree->creat_sub_json($catid,$strs);
        }
        echo $data;
    }





    private function filter_utf8_char($ostr){

        /*preg_match_all('/[\x{0020}-\x{FFEF}|\x{0000}-\x{00ff}|\x{4e00}-\x{9fff}]+/u', $ostr, $matches);
        $str = join('', $matches[0]);
        if($str==''){
            $returnstr = '';
            $i = 0;
            $str_length = strlen($ostr);
            while ($i<=$str_length){
                $temp_str = substr($ostr, $i, 1);
                $ascnum = Ord($temp_str);
                if ($ascnum>=224){
                    $returnstr = $returnstr.substr($ostr, $i, 3);
                    $i = $i + 3;
                }elseif ($ascnum>=192){
                    $returnstr = $returnstr.substr($ostr, $i, 2);
                    $i = $i + 2;
                }elseif ($ascnum>=65 && $ascnum<=90){
                    $returnstr = $returnstr.substr($ostr, $i, 1);
                    $i = $i + 1;
                }elseif ($ascnum>=128 && $ascnum<=191){ // 特殊字符  
                    $i = $i + 1;
                }else{
                    $returnstr = $returnstr.substr($ostr, $i, 1);
                    $i = $i + 1;
                }
            }
            $str = $returnstr;
            preg_match_all('/[\x{FF00}-\x{FFEF}|\x{0000}-\x{00ff}|\x{4e00}-\x{9fff}]+/u', $str, $matches);
            $str = join('', $matches[0]);
        }*/
        return $ostr;


    }
}


?>