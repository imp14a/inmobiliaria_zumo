<?php
class Municipality extends AppModel {
	var $name = 'Municipality';
	var $displayField = 'name';
	var $validate = array(
    'name' => array(
            'rule' => 'notEmpty',
		        'message' => 'name field is empty'
		)
	);

	var $belongsTo = array(
		'State' => array(
			'className' => 'State',
			'foreignKey' => 'state_id'
		)
	);

	var $hasMany = array(
		'PostalCode' => array(
			'className' => 'PostalCode',
			'foreignKey' => 'municipality_id'
		)
	);


	var $hasAndBelongsToMany = array(
		'City' => array(
			'className' => 'City',
			'joinTable' => 'cities_municipalities',
			'foreignKey' => 'municipality_id',
			'associationForeignKey' => 'city_id',
			'unique' => true
		)
	);

}
?>
