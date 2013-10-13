<?php

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

	public $name = 'User';

    public $validate = array(
   'username' => array(
        'valid' => array('rule' => array('alphaNumeric'),
           'message' => 'Nombre debe ser alfanumérico'),
        'required' => array('rule' => array('minLength', '1'),
            'message' => 'Nombre de usuario obligatorio')),
   'password'   => array(
        'required' => array('rule' => array('minLength', '1'),
            'message' => 'Contraseña obligatoria'),
        'length' => array('rule' => array('minLength', 6),
            'message' => 'La longitud mínima de la contraseña es de 6 caracteres'),
        'valid' => array('rule' => array('checkpasswords'),
            'message' => 'Las contraseñas deben coincidir')
      )
   );

    public function checkpasswords()
    {
        return strcmp($this->data['User']['password'],$this->data['User']['password_confirm']) == 0;
    }

	public $hasMany = array(
        'UserSearch'
    );

    public function isAdmin($user) {
	    return $this->isAdmin;
	}
    
    public function beforeSave() {
        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;
    }
}

?>
