<?php
class Country extends AppModel {
	var $name = 'Country';
	var $displayField = 'name';
	var $validate = array(
      'name' => array(
            'rule' => 'notEmpty',
		        'message' => 'name field is empty'
		)
);

	var $hasMany = array(
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'country_id'
		),
		'PostalCode' => array(
			'className' => 'PostalCode',
			'foreignKey' => 'country_id'
		),
		'State' => array(
			'className' => 'State',
			'foreignKey' => 'country_id'
		)
	); //un pais pertenece a muchos estados a muchos codigos postales, a muchas ciudades y carriers
}
?>