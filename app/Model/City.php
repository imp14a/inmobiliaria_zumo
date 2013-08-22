<?php
class City extends AppModel {
	var $name = 'City';
	var $displayField = 'name';
	var $validate = array(
	  'country_id' => array(
			      'rule' => 'numeric',
			      'message' => 'country_id is empty'
		),
	 'name' => array(
            'rule' => 'notEmpty',
		        'message' => 'name field is empty'
		)
	);

	var $belongsTo = array(
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id'
		),
		'State' => array(
			'className' => 'State',
			'foreignKey' => 'state_id'
		)
	); //muchas ciudades pertenecen a un pais

	var $hasAndBelongsToMany = array(
		'Municipality' => array(
			'className' => 'Municipality',
			'joinTable' => 'cities_municipalities',
			'foreignKey' => 'city_id',
			'associationForeignKey' => 'municipality_id',
			'unique' => true
		)
	);   //relacion muchos a muchos con municipios  ????
}
?>