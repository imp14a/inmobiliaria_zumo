<?php

class Property extends AppModel {

	public $name = 'Property';
	public $useTable = 'properties';

	public $hasOne = array( 'PropertyAddress','PropertyDescription',
		'PropertyPaymentInformation');

	public $hasMany = array(
        'PropertyArea', 'PropertyInformation'
    );


}

?>
