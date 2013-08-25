
<?php
App::Import('Model','PropertyAddress');

class PropertyAddressController extends AppController {
	

	public function getMunicipalityForState(){
		$state = utf8_decode(isset($_REQUEST['state']) ? $_REQUEST[ 'state' ] : '');
		
		$address = new PropertyAddress();

		$options =  array(
			'conditions'=>array('PropertyAddress.state' => $state),
			'recursive' => -1, //int
			'fields' => array('PropertyAddress.municipality'),
			'order' => array('PropertyAddress.municipality'), //string or array defining order
			'group' => array('PropertyAddress.municipality'), 
		);

		$out = array();

		foreach($address->find('all',$options) as $res){
			array_push($out, utf8_encode($res['PropertyAddress']['municipality']));
		}

		$this->set('output',$out);
	}

	public function getQuartersForMunicipality(){
		$municipality = utf8_decode(isset($_REQUEST['municipality']) ? $_REQUEST[ 'municipality' ] : '');
		$address = new PropertyAddress();

		$options =  array(
			'conditions'=>array('PropertyAddress.municipality LIKE' => $municipality),
			'recursive' => -1, //int
			'fields' => array('PropertyAddress.quarter'),
			'order' => array('PropertyAddress.quarter'), //string or array defining order
			'group' => array('PropertyAddress.quarter'), 
		);

		$out = array();

		foreach($address->find('all',$options) as $res){
			array_push($out, utf8_encode($res['PropertyAddress']['quarter']));
		}

		$this->set('output',$out);
	}

}

?>