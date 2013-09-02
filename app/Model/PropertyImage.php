<?php

class PropertyImage extends AppModel {

	public $name = 'PropertyImage';

	public function beforeSave($options = array()) {
		if (!empty($this->data['PropertyImage']['image']) && 
			is_uploaded_file($this->data['PropertyImage']['image']['tmp_name'])){
            $fileData = fread(fopen($this->data['PropertyImage']['image']['tmp_name'], "r"), 
                                     $this->data['PropertyImage']['image']['size']);
        $this->data['PropertyImage']['image'] = $fileData;
		}
		return true;
	}
}

?>
