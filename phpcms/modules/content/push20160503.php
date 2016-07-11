<?php
defined('IN_PHPCMS') or exit('No permission resources.');

pc_base::load_app_class('admin','admin',0);
pc_base::load_sys_class('push_factory', '', 0);
//权限判断，根据栏目里面的权限设置检查	
/*if((isset($_GET['catid']) || isset($_POST['catid'])) && $_SESSION['roleid'] != 1) {
	$catid = isset($_GET['catid']) ? intval($_GET['catid']) : intval($_POST['catid']);
	$this->priv_db = pc_base::load_model('category_priv_model');
	$priv_datas = $this->priv_db->get_one(array('catid'=>$catid,'is_admin'=>1,'action'=>'push'));
	if(!$priv_datas['catid']) showmessage(L('permission_to_operate'),'blank');
}*/

class push extends admin {
	
	public function __construct() {
		parent::__construct();
		$this->siteid = $this->get_siteid();
		/*$module = (isset($_GET['module']) && !empty($_GET['module'])) ? $_GET['module'] : 'admin';
		if (in_array($module, array('admin', 'special','content'))) {
			$this->push = push_factory::get_instance()->get_api($module);
		} else {
			showmessage(L('not_exists_push'), 'blank');
		}*/
	}
	
	/**
	 * 推送选择界面
	 */
	public function init() {
		if ($_POST['dosubmit']) {
			$ids = explode('|', $_POST['id']);
			$currCatid = $_POST["catid"];
			$catids = $_POST['catids'];
			$db = pc_base::load_model('content_model');
			$db->table_name = "bl_catandat";
			$action = $_GET["action"];

			if($action == '1')//移除
			{
				$idStr = implode(',',$ids);
				$where = "atid in ('".$idStr."') and modid = 1 and catid = ".$currCatid;
                $db->delete($where);
			}
			if(is_array($ids)) {
				foreach($ids as $id) {
					foreach($catids as $catid){
						if ($currCatid == $catid){
                            continue;
                        }
						$db->insert(array("catid"=>$catid,"atid"=>$id,"modid"=>1),false,true);
					}
				}
			}
			showmessage(L('success'), '', '', 'push');
		} else {
			$tpl =  'push_to_category';
			include $this->admin_tpl($tpl);
		}
	}
	
	public function public_ajax_get() {
		if (method_exists($this->push, $_GET['action'])) {
			$html = $this->push->{$_GET['action']}($_GET['html']);
			echo $html;
		} else {
			echo 'CLASS METHOD NO EXISTS!';
		}
	}
}
?>