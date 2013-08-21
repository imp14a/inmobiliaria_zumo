<?php

class Property extends AppModel {

	public $name = 'PropertyAddress';

	public $hasOne = array( 'PropertyAddress','PropertyDescription',
		'PropertyLocation','PropertyPaymentInformation');

	public $hasMany = array(
        'Images' => array(
            'className' => 'PropertyImage',
        ),
        'ExtraAreas' => array(
            'className' => 'PropertyExtraArea',
        )
        ,'ExtraInformations' => array(
            'className' => 'PropertyExtraInformation',
        )
    );


}

?>
