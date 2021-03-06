<?php

App::Import('Model','PropertyArea');

class PropertyAreaController extends AppController {

	public function getPropertyAreas(){
		$this->layout = "ajax";
		$area = utf8_decode(isset($_REQUEST['name']) ? $_REQUEST[ 'name' ] : '');
		$options =  array(
			'recursive' => -1, //int
			'conditions'=>array('PropertyArea.area_name LIKE' => $area."%"),
			'fields' => array('PropertyArea.area_name'),
			'order' => array('PropertyArea.area_name'), //string or array defining order
			'group' => array('PropertyArea.area_name') 
		);
		$out = array();
		foreach($this->PropertyArea->find('all', $options) as $res){
			array_push($out, utf8_encode($res['PropertyArea']['area_name']));
		}
		$this->set('output', $out);
	}

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('getPropertyAreas');
    }

    public function delete($id){
		if ($this->PropertyArea->delete($id)) {
            $this->Session->setFlash('Propiedad actualizada!');
            $this->redirect($this->referer());
        }else{
            $this->Session->setFlash('Ha ocurrido un error, intente de nuevo.');
        }
    }

}

?>