<?php
class PostalCode extends AppModel {
	var $name = 'PostalCode';
	var $validate = array(
	  'start' => array(
            'rule' => 'notEmpty',
		        'message' => 'start field is empty'
		),
	  'country_id' => array(
			      'rule' => 'numeric',
			      'message' => 'country_id is empty'
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
		),
		'Municipality' => array(
			'className' => 'Municipality',
			'foreignKey' => 'municipality_id'
		),
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city_id'
		),
		'Quarter' => array(
			'className' => 'Quarter',
			'foreignKey' => 'quarter_id'
		)
	);
}
?>
