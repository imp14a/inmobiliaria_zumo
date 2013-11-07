<?php

App::Import('Model','PropertyNearPlace');

class PropertyNearPlaceController extends AppController {

	public function getNearPlaceTypes(){
		$this->layout = "ajax";
		$type = utf8_decode(isset($_REQUEST['type']) ? $_REQUEST[ 'type' ] : '');
		$options =  array(
			'recursive' => -1, //int
			'conditions' => array('PropertyNearPlace.type LIKE' => $type."%"),
			'fields' => array('PropertyNearPlace.type'),
			'order' => array('PropertyNearPlace.type'), //string or array defining order
			'group' => array('PropertyNearPlace.type') 
		);
		$out = array();
		foreach($this->PropertyNearPlace->find('all', $options) as $res){
			array_push($out, utf8_encode($res['PropertyNearPlace']['type']));
		}
		$this->set('output', $out);
	}

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('getNearPlaceTypes');
    }

    public function delete($id){
    	if ($this->PropertyNearPlace->delete($id)) {
            $this->Session->setFlash('Propiedad actualizada!');
            $this->redirect($this->referer());
        }else{
            $this->Session->setFlash('Ha ocurrido un error, intente de nuevo.');
        }
    }

}

?>