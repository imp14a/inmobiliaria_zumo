<?php

class User extends AppModel {

	public $name = 'User';

	public $hasMany = array(
        'SearchSaved' => array(
            'className' => 'SearchSavedByUser',
        )
    );

    public function isAdmin($user) {
	    return $this->isAdmin;
	}

	public function beforeSave($options = array()) {
        if (isset($this->request->data['User']['password'])) {
            $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
        }
        return true;
    }
}

?>
