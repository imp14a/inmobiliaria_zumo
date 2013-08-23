<?php

class PropertyDescription extends AppModel {

	public $name = 'PropertyDescription';
	public $useTable = 'property_description';

    public $belongsTo = 'Property';

}

?>
