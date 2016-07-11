	function typeid($field, $value, $fieldinfo) {

       extract($fieldinfo);
		$setting = string2array($setting);
		if(!$value) $value = $setting['defaultvalue'];
		if($errortips) {
			$errortips = $this->fields[$field]['errortips'];
			$this->formValidator .= '$("#'.$field.'").formValidator({onshow:"",onfocus:"'.$errortips.'"}).inputValidator({min:1,onerror:"'.$errortips.'"});';
		}
	 
       $rk_map=pc_base::load_config('rk','rk_conf');
	   $classId=$rk_map[$_GET["type"]]["classId"];
	   $db = pc_base::load_model('rkcats_model');
	    $where=array("parentclassid"=>$classId);
	    $r= $db->select($where, '*', '', 'listorder ASC');
		$data=array();
		foreach($r as $v)
		{
            
			$data[$v["catid"]]=$v["catname"];

		}
	    return form::select($data,$value,'name="info['.$field.']" id="'.$field.'" '.$formattribute.' '.$css,L('copyfrom_tips'));
	}
