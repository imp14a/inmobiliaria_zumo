<?php

class PropertyImage extends AppModel {

	public $name = 'PropertyImage';
	public $useTable = 'property_image';


    public $belongsTo = 'Property';

}

?>
