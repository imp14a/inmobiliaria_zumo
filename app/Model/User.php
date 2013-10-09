<?php

class User extends AppModel {

	public $name = 'User';

    public $validate = array(
        'password' => array(
            'length' => array(                              
                'rule' => array('minLength', 6),
                'message' => 'Debe ingresar por lo menos 6 caracteres.',
            ),
            'passwordequal'  => array(
                'rule' => 'checkpasswords',
                'message' => 'Las contraseñas no coinciden.'
            )
        )
    );

    public function checkpasswords()
    {
        return strcmp($this->data['User']['password'],$this->data['User']['password_confirm']) == 0;
    }

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
