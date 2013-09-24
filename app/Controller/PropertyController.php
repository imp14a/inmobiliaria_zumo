<?php


App::Import('Model','Property');
App::Import('Model','PropertyArea');
App::Import('Model','PropertyImage');
App::Import('Model','PropertyAddress');
App::Import('Model','PropertyNearPlace');

class PropertyController extends AppController {

	 var $helpers = array('Number');

	 var $paginate = array(
        'limit' => 9,
        'order' => array(
            'Property.name' => 'asc'
        )
    );

	public function index(){
		$this->set('title_for_layout','Listado de Propiedades');
        $this->set('properties', $this->Property->find('all'));
	}

	public function delete($id) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Property->delete($id)) {
            $this->Session->setFlash('Propiedad eliminada.');
            $this->redirect(array('action' => 'index'));
        }else{
        	$this->Session->setFlash('Ha ocurrido un error, intente de nuevo.');
        }
    }

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

		$pa = new PropertyArea();

		$this->set('areas',$pa->find('all',
			array('conditions'=>array('PropertyArea.area_name !='=>''),
				'fields'=>array('PropertyArea.area_name'),
				'group'=> array('PropertyArea.area_name'))));
		

		$pnp = new PropertyNearPlace();

		$this->set('services',$pnp->find('all',
			array('conditions'=>array('PropertyNearPlace.type !='=>''),
				'fields'=>array('PropertyNearPlace.type'),
				'group'=> array('PropertyNearPlace.type'))));

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
		$available_type = isset($_REQUEST['available_type']) ? $_REQUEST[ 'available_type' ] : '';

		$property = new Property(); 

		$options =  array(
			'conditions'=>array('PropertyAddress.state' => $state,
				'PropertyAddress.municipality' => $municipality,
				'PropertyAddress.quarter' => $quarter)
			);

		if($available_type == 'rent')
			$options['conditions']['Property.available_for_rent'] = 1;
		if($available_type == 'sell')
			$options['conditions']['Property.available_for_sell'] = 1;

		$this->set('output',$property->find('all',$options));
		
	}

	public function user_searchs(){
		$this->layout = 'property_layout';
		$this->set('user_searchs',true);
		$this->set('title_for_layout','Mis Busquedas');
	}

	public function add($id = null){
		$this->set('title_for_layout','Registro de inmuebles');
		$this->loadModel('PropertyDescription');
		//Tipos
		$type = $this->Property->PropertyDescription->getColumnType('type');
		preg_match_all("/'(.*?)'/", $type, $enums);
		foreach($enums[1] as $value )
    	{
    		if($value != 'Cualquiera')
        		$enum[$value] = $value;
    	}
		$this->set('types', $enum);
		//Antiguedad
		unset($enum);
		$type = $this->PropertyDescription->getColumnType('antiquity');
		preg_match_all("/'(.*?)'/", $type, $enums);
		foreach($enums[1] as $value )
    	{
    		if($value != 'Cualquiera')
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

		$this->Property->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->Property->read();
        } 
        else {		
			if (!empty($this->request->data)) {						
				if($this->Property->saveAll($this->request->data, array('validate'=>'first'))){
					$this->Session->setFlash('Propiedad registrada.');
					$this->redirect(array('action' => 'addnearplaces', $this->Property->id));					
				}else{
					$this->Session->setFlash('Ha ocurrido un error, por favor intente más tarde');
				}
			}
		}
	}

	public function addnearplaces($id){
		$this->set('title_for_layout','Registro de lugares cercanos');
        $this->Property->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->Property->read();
        } 
        else {
            if (!empty($this->request->data)) {    
            	if($this->Property->saveAll($this->request->data, array('validate'=>'first'))){
            		$this->Session->setFlash('Lugares registrados.');
					$this->redirect(array('action' => 'index'));					
            	}else{
            		$this->Session->setFlash('Ha ocurrido un error, por favor intente más tarde');
            	}
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

		$this->Property->recursive = 1;

		
		$this->set('property_fist_image',$this->Property->findById($id));
		
		$pi = new PropertyImage();
		
		$this->set('property',$this->Property->findById($id));
		
    }

    public function searchResult(){
    	$this->layout = 'property_layout';
    	$this->set('simple_search',true);
		$this->set('title_for_layout','Resultados de búsqueda');
    	if (!empty($this->data)) {

			$options = array(
				'PropertyAddress.state' => $this->data['PropertySearch']['state'],
				'PropertyAddress.municipality' => $this->data['PropertySearch']['municipality'],
				'PropertyAddress.quarter LIKE' => '%'.$this->data['PropertySearch']['quarter'].'%',
			);
			if($this->data['PropertySearch']['available_type']=='rent'){
				$options['Property.available_for_rent'] = true;
			}elseif($this->data['PropertySearch']['available_type']=='sell'){
				$options['Property.available_for_sell'] = true;
			}

			$price = str_replace(",", "", $this->data['PropertySearch']['min_price']);
			$price = str_replace("$ ", "", $price);
			if(is_numeric($price)){
				$options['PropertyPaymentInformation.'.$this->data['PropertySearch']['available_type'].'_price >='] = $price;
			}
			$price = str_replace(",", "", $this->data['PropertySearch']['max_price']);
			$price = str_replace("$ ", "", $price);
			if(is_numeric($price)){
				$options['PropertyPaymentInformation.'.$this->data['PropertySearch']['available_type'].'_price <='] = $price;
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
				$options['AND']['OR']['PropertyDescription.type'] = $or_type_array;
			}
			if(count($or_type_Antiquity)>0){
				$options['AND']['OR']['PropertyDescription.antiquity'] = $or_type_Antiquity;
			}
    		if($this->data['AdvancedSearch']['on']){
				$options['PropertyDescription.number_of_rooms >='] = $this->data['AdvancedSearch']['rooms_number'];
				$options['PropertyDescription.number_of_bathrooms >='] = $this->data['AdvancedSearch']['bathrooms_number'];
				$options['PropertyDescription.number_of_parkings >='] = $this->data['AdvancedSearch']['parking_number'];
				$options['PropertyDescription.number_of_levels  >='] = $this->data['AdvancedSearch']['levels_number'];
				$options['PropertyDescription.square_meters_of_construction >='] = $this->data['AdvancedSearch']['contruction_meters'];
				/**
				  TODO terminar la busqueda avanzada
				 */
    		}

    		$this->set('found_properties', $data = $this->paginate('Property', $options));
    	}else{
    		$this->redirect(array('action' => 'simple_search'));
    	}
    }

}

?>