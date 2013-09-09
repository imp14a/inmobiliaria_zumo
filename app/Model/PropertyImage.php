<?php

class PropertyImage extends AppModel {

	public $name = 'PropertyImage';

	public function beforeSave($options = array()) {
		if (!empty($this->data['PropertyImage']['image']) && 
			is_uploaded_file($this->data['PropertyImage']['image']['tmp_name'])){        
			$dest = APP.WEBROOT_DIR.DS.'img'.DS.'property_images'.DS.$this->data['PropertyImage']['image']['name'];
		    move_uploaded_file($this->data['PropertyImage']['image']['tmp_name'],$dest);
        	$this->data['PropertyImage']['image'] = $this->data['PropertyImage']['image']['name'];        	
        }
		return true;
	}
}

?>
