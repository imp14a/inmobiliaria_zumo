<?php

App::Import('Model','PropertyAddress');
App::Import('Model','Property');
App::Import('Model','PropertyNearPlace');

class PropertyController extends AppController {

	 var $helpers = array('Number');

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
		$state = isset($_REQUEST['state']) ? $_REQUEST[ 'state' ] : '';
		$municipality = isset($_REQUEST['municipality']) ? $_REQUEST[ 'municipality' ] : '';
		$quarter = isset($_REQUEST['quarter']) ? $_REQUEST[ 'quarter' ] : '';

		$property = new Property(); 

		$options =  array(
			'conditions'=>array('PropertyAddress.state' => $state,
				'PropertyAddress.municipality' => $municipality,
				'PropertyAddress.quarter' => $quarter)
			);
		// TODO poner el paginador
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
			$enum[$state['State']['name']] = $state['State']['name'];
		}
		$this->set('states', $enum);			
		if (!empty($this->request->data)) {						
			$this->Property->saveAll($this->request->data, array('validate'=>'first'));
			$this->Session->setFlash('Información almacenada.');
            //$this->redirect(array('action' => 'adddetails', $this->Property->id));
		}
	}

	public function addnearplaces($id){
		$this->set('title_for_layout','Registro de lugares cercanos');
        $this->Property->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->Property->read();
            $this->set('state', $this->request->data['PropertyAddress']['state']);
        } 
        else {
            if (empty($this->request->data)) {
            }else{
                $this->Property->saveAll($this->request->data, array('validate'=>'first'));
                //Limpiar datos y regresar a la misma página
            }
        }
	}

	/*public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'simple_search', 'map_search');
    }*/

    public function view($id = null){
    	$this->layout = 'property_layout';
		$this->set('title_for_layout','Propiedad');
    }

    public function searchResult(){
    	$this->layout = 'property_layout';
    	$this->set('simple_search',true);
		$this->set('title_for_layout','Resultados de búsqueda');
    	if (!empty($this->data)) {
    		/*array(
				'PropertySearch' => array(
					'abalible_type' => 'both',
					'state' => 'MÃ©xico',
					'municipality' => 'Metepec',
					'quarter' => 'Santiaguito',
					'Type' => array(
						'any' => '1'
					),
					'Antiquity' => array(
						'any' => '1'
					),
					'min_price' => 'el menor precio',
					'max_price' => 'el mayor precio'
				),
				'AdvancedSearch' => array(
					'on' => '0',
					'rooms_number' => '1',
					'bathrooms_number' => '1',
					'parking_number' => '1',
					'levels_number' => '1',
					'contruction_meters' => '1'
				)
			)*/

			$options = array('conditions' => array(
				'PropertyAddress.state' => $this->data['PropertySearch']['state'],
				'PropertyAddress.municipality' => $this->data['PropertySearch']['municipality'],
				'PropertyAddress.quarter LIKE' => '%'.$this->data['PropertySearch']['quarter'].'%',
				)
			);
			if($this->data['PropertySearch']['abalible_type']=='rent'){
				//TODO minimize code
				$options['conditions']['Property.avalible_for_rent'] = true;
				if(is_numeric($this->data['PropertySearch']['min_price'])){
					$options['conditions']['AND']['PropertyPaymentInformation']['rent_price >'] = $this->data['PropertySearch']['min_price'];
				}
				if(is_numeric($this->data['PropertySearch']['min_price'])){
					$options['conditions']['AND']['PropertyPaymentInformation']['rent_price <'] = $this->data['PropertySearch']['min_price'];
				}
			}elseif($this->data['PropertySearch']['abalible_type']=='sell'){
				$options['conditions']['Property.avalible_for_sell'] = true;
				if(is_numeric($this->data['PropertySearch']['min_price'])){
					$options['conditions']['AND']['PropertyPaymentInformation']['sale_price >'] = $this->data['PropertySearch']['min_price'];
				}
				if(is_numeric($this->data['PropertySearch']['max_price'])){
					$options['conditions']['AND']['PropertyPaymentInformation']['sale_price <'] = $this->data['PropertySearch']['min_price'];
				}
			}else{
				if(is_numeric($this->data['PropertySearch']['min_price'])){
					$options['conditions']['AND']['OR']['PropertyPaymentInformation']['rent_price >'] = $this->data['PropertySearch']['min_price'];
					$options['conditions']['AND']['OR']['PropertyPaymentInformation']['sale_price >'] = $this->data['PropertySearch']['min_price'];
				}
				if(is_numeric($this->data['PropertySearch']['max_price'])){
					$options['conditions']['AND']['OR']['PropertyPaymentInformation']['rent_price <'] = $this->data['PropertySearch']['min_price'];
					$options['conditions']['AND']['OR']['PropertyPaymentInformation']['sale_price >'] = $this->data['PropertySearch']['min_price'];
				}
			}


			$or_type_array = array();
			foreach($this->data['PropertySearch']['Type'] as $type=>$value){
				if($type=='any' && $value) break;
				$type = str_replace("_", " ", $type);
				array_push($or_type_array, $type);
			}
			$or_type_Antiquity = array();
			foreach($this->data['PropertySearch']['Antiquity'] as $type=>$value){
				if($type=='any' && $value) break;
				$type = str_replace("_", " ", $type);
				array_push($or_type_Antiquity, $type);
			}

			if(count($or_type_array)>0){
				$options['conditions']['AND']['OR']['PropertyDescription.type'] = $or_type_array;
			}
			if(count($or_type_Antiquity)>0){
				$options['conditions']['AND']['OR']['PropertyDescription.antiquity'] = $or_type_Antiquity;
			}
			
			$this->set('found_properties', $this->Property->find('all',$options));

			//debug($this->Property->find('all',$options));
    		if($this->data['AdvancedSearch']['on']){
    			//TODO hacerla busqueda avanzada
    		}
    	}else{
    		$this->redirect(array('action' => 'simple_search'));
    	}
    }

}

?>