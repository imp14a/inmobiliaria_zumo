<?php
class State extends AppModel {
	var $name = 'State';
	var $displayField = 'name';
	var $validate = array(
    'name' => array(
            'rule' => 'notEmpty',
		        'message' => 'name field is empty'
		),    
    'country_id' => array(
			      'rule' => 'notEmpty',
			      'message' => 'country_id is empty' 
		) 
	);

	var $belongsTo = array(
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id'
		)
	);

	var $hasMany = array(
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'state_id'
		),
		'PostalCode' => array(
			'className' => 'PostalCode',
			'foreignKey' => 'state_id'
		)
	);

}
?>