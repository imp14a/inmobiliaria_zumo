<?php

class Property extends AppModel {

	public $name = 'Property';
	public $useTable = 'properties';

    var $validate = array(
        'name' => 'alphaNumeric'
    );

	public $hasOne = array( 'PropertyAddress','PropertyDescription',
		'PropertyLocation','PropertyPaymentInformation');

	/*public $hasMany = array(
        'Images' => array(
            'className' => 'PropertyImage',
        ),
        'ExtraAreas' => array(
            'className' => 'PropertyExtraArea',
        )
        ,'ExtraInformations' => array(
            'className' => 'PropertyExtraInformation',
        )
    );*/


}

?>
