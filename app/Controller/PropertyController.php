<?php

App::Import('Model','PropertyAddress');
App::Import('Model','Property');

class PropertyController extends AppController {



	public function simple_search(){
		$this->layout = 'property_layout';
		$this->set('simple_search',true);
		$this->set('title_for_layout','Busqueda de Propiedades');

		$address = new PropertyAddress();

		$options =  array(
			'recursive' => -1, //int
			'fields' => array('PropertyAddress.state'),
			'order' => array('PropertyAddress.state'), //string or array defining order
			'group' => array('PropertyAddress.state'), 
		);

		$states = array();
		foreach($address->find('all',$options) as $state){
			$states[$state['PropertyAddress']['state']] = $state['PropertyAddress']['state'];
		}
		$this->set('states',$states);

	}

	public function map_search(){
		$this->layout = 'property_layout';
		$this->set('map_search',true);
		$this->set('title_for_layout','Busqueda por Mapa');
		$address = new PropertyAddress();

		$options =  array(
			'recursive' => -1, //int
			'fields' => array('PropertyAddress.state'),
			'order' => array('PropertyAddress.state'), //string or array defining order
			'group' => array('PropertyAddress.state'), 
		);

		$states = array();
		foreach($address->find('all',$options) as $state){
			$states[$state['PropertyAddress']['state']] = $state['PropertyAddress']['state'];
		}
		$this->set('states',$states);
	}

	public function getPropertyByStateMunicipalityAndQuarter(){
		$state = utf8_decode(isset($_REQUEST['state']) ? $_REQUEST[ 'state' ] : '');
		$municipality = utf8_decode(isset($_REQUEST['municipality']) ? $_REQUEST[ 'municipality' ] : '');
		$quarter = utf8_decode(isset($_REQUEST['quarter']) ? $_REQUEST[ 'quarter' ] : '');

		$property = new Property(); 

		$options =  array(
			'conditions'=>array('PropertyAddress.state' => $state,
				'PropertyAddress.municipality' => $municipality,
				'PropertyAddress.quarter' => $quarter)
			);

		$this->set('output',$property->find('all',$options));
		
	}

	public function user_searchs(){
		$this->layout = 'property_layout';
		$this->set('user_searchs',true);
		$this->set('title_for_layout','Mis Busquedas');	
	}

	public function add(){
		$this->set('title_for_layout','Registro de inmuebles');
		$this->loadModel('PropertyDescription');
		//Tipos
		$type = $this->Property->PropertyDescription->getColumnType('type');
		preg_match_all("/'(.*?)'/", $type, $enums);
		foreach($enums[1] as $value )
    	{
        	$enum[$value] = $value;
    	}
		$this->set('types', $enum);
		//Antiguedad
		unset($enum);
		$type = $this->PropertyDescription->getColumnType('antiquity');
		preg_match_all("/'(.*?)'/", $type, $enums);
		foreach($enums[1] as $value )
    	{
        	$enum[$value] = $value;
    	}
		$this->set('antiquities', $enum);
		//Informacion de ubicacion
		//Estados
		unset($enum);
		$this->loadModel('State');
		$this->State->recursive= -1;
		$states = $this->State->find('all');
		foreach ($states as $state){
			$enum[utf8_encode($state['State']['name'])] = utf8_encode($state['State']['name']);
		}
		$this->set('states', $enum);			
		if (!empty($this->request->data)) {						
			$this->Property->saveAll($this->request->data, array('validate'=>'first'));
			$this->Session->setFlash('Información almacenada.');
            //$this->redirect(array('action' => 'addlocation', $this->Property->id));
		}
	}
	/*public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'simple_search', 'map_search');
    }*/

}

?>