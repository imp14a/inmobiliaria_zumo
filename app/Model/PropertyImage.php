<?php

class PropertyImage extends AppModel {

	public $name = 'PropertyImage';

	public function beforeSave($options = array()) {
		if (!empty($this->request->data['PropertyImage']['image']) && 
			is_uploaded_file($this->request->data['PropertyImage']['image']['tmp_name'])){
            $fileData = fread(fopen($this->request->data['PropertyImage']['image']['tmp_name'], "r"), 
                                     $this->request->data['PropertyImage']['image']['size']);
        	$this->request->data['PropertyImage']['image'] = $fileData;
		}else{
			return false;
		}
		return true;
	}
}

?>
