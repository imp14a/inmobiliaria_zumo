<?php

class User extends AppModel {

	public $name = 'User';
	public $name = 'user';

	public $hasMany = array(
        'SearchSaved' => array(
            'className' => 'SearchSavedByUser',
        )
    );
}

?>
