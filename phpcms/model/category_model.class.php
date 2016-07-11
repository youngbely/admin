<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('model', '', 0);
class category_model extends model {
	public $table_name = '';
	public function __construct() {
		$this->db_config = pc_base::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'category';
		parent::__construct();// parent::set_data($arr);
	}
        
        public function insertOther($data, $return_insert_id = false, $replace = false) {
               $retId=$this->insert($data, $return_insert_id, $replace);
               $dataDir=array();
               $dataDir["classid"]="C".$retId;//str_pad($retId, 3, "0", STR_PAD_LEFT);
               $dataDir["parentclassid"]="C".$data["parentid"];
               /*if ($data["parentid"]==0)//一级栏目
               {
                    $dataDir["classid"]=str_pad($retId, 3, "0", STR_PAD_LEFT);
                    $dataDir["parentclassid"]="C".$data["parentid"];
                    //$dataDir["catdir"]="C".$data["parentid"];
                   
               }  else {
                    $dataDir["classid"]="C".$retId;
               }*/
               $this->update($dataDir,array("catid"=>$retId));
	       return $retId;
	}
}
?>