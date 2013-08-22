<?php
class Quarter extends AppModel {
	var $name = 'Quarter';
	var $displayField = 'name';
	var $validate = array(
    'name' => array(
            'rule' => 'notEmpty',
		        'message' => 'name field is empty'
		)
	);
	

	var $hasMany = array(
		'PostalCode' => array(
			'className' => 'PostalCode',
			'foreignKey' => 'quarter_id'
		)
	);      // un codigo postal tiene muchas localidades o colonias

}
?>