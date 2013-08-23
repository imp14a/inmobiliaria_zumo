<?php

class PropertyLocation extends AppModel {

	public $name = 'PropertyLocation';
	public $useTable = 'property_location';

    public $belongsTo = 'Property';

}

?>
