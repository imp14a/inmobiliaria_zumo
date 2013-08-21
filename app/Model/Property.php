<?php

class Property extends AppModel {

	public $name = 'Property';

	public $hasOne = array( 'PropertyAddress','PropertyDescription',
		'PropertyLocation','PropertyPaymentInformation');

	public $hasMany = array(

		);


}

?>
