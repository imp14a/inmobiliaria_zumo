<?php

class Property extends AppModel {

	public $name = 'Property';
	public $useTable = 'properties';

	public $hasOne = array( 'PropertyAddress','PropertyDescription',
		'PropertyPaymentInformation');

	public $hasMany = array(
        'PropertyArea', 'PropertyInformation', 'PropertyImage', 'PropertyNearPlace'
    );

    public function afterFind($results, $primary = false) {
    	
    	if(isset($results[0]['PropertyNearPlace'])){
    		$results[0]['PropertyNearPlace'] = $this->organzeByCategory($results[0]['PropertyNearPlace'],'type');
    	}
    	if(isset($results[0]['PropertyInformation'])){
    		$results[0]['PropertyInformation'] = $this->organzeByCategory($results[0]['PropertyInformation'],'category');
    	}
	    return $results;
	}

	private function organzeByCategory($nps,$index){
		$nearPlaces = array();
		foreach($nps as $np){
			if(!isset($nearPlaces[$np[$index]])){
				$nearPlaces[$np[$index]] = array();	
			}
			array_push($nearPlaces[$np[$index]], $np);
		}

		return $nearPlaces;
	}

}

?>
