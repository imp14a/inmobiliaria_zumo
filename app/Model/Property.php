<?php

class Property extends AppModel {

	public $name = 'Property';
	public $useTable = 'property';

	public $hasOne = array( 'PropertyAddress','PropertyDescription',
		'PropertyLocation','PropertyPaymentInformation');

	public $hasMany = array(

		);


}

?>
