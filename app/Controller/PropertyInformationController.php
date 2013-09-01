<?php

App::Import('Model','PropertyInformation');

class PropertyInformationController extends AppController {

	public function getPropertyCategories(){
		$this->layout = "ajax";
		$category = utf8_decode(isset($_REQUEST['category']) ? $_REQUEST[ 'category' ] : '');
		$options =  array(
			'recursive' => -1, //int
			'conditions'=>array('PropertyInformation.category LIKE' => $category."%"),
			'fields' => array('PropertyInformation.category'),
			'order' => array('PropertyInformation.category'), //string or array defining order
			'group' => array('PropertyInformation.category') 
		);
		$out = array();
		foreach($this->PropertyInformation->find('all', $options) as $res){
			array_push($out, utf8_encode($res['PropertyInformation']['category']));
		}
		$this->set('output', $out);
	}

	public function getPropertyElementsByCategory(){
		$this->layout = "ajax";
		$name = utf8_decode(isset($_REQUEST['name']) ? $_REQUEST[ 'name' ] : '');
		$options =  array(
			'recursive' => -1, //int
			'conditions'=>array('PropertyInformation.name LIKE' => $name."%"),
			'fields' => array('PropertyInformation.name'),
			'order' => array('PropertyInformation.name'), //string or array defining order
			'group' => array('PropertyInformation.name') 
		);
		$out = array();
		foreach($this->PropertyInformation->find('all', $options) as $res){
			array_push($out, utf8_encode($res['PropertyInformation']['name']));
		}
		$this->set('output', $out);
	}

}

?>