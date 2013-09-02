<?php

class PropertyAddress extends AppModel {

	public $name = 'PropertyAddress';
    
    public function beforeSave(){
    	if(!empty($this->data['PropertyAddress'])){
    		$this->data['PropertyAddress']['country'] = utf8_decode($this->data['PropertyAddress']['country']);
    		$this->data['PropertyAddress']['state'] = utf8_decode($this->data['PropertyAddress']['state']);	
    		$this->data['PropertyAddress']['street'] = utf8_decode($this->data['PropertyAddress']['street']);
    		$this->data['PropertyAddress']['quarter'] = utf8_decode($this->data['PropertyAddress']['quarter']);
    		$this->data['PropertyAddress']['quarter_google'] = utf8_decode($this->data['PropertyAddress']['quarter_google']);
    		$this->data['PropertyAddress']['municipality'] = utf8_decode($this->data['PropertyAddress']['municipality']);
    		$this->data['PropertyAddress']['municipality_google'] = utf8_decode($this->data['PropertyAddress']['municipality_google']);
    	}
    	return true;
    }
}

?>
