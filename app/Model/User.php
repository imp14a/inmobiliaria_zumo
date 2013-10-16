<?php

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

	public $name = 'User';

    public $validate = array(
   'username' => array(
        'valid' => array('rule' => array('checkusers'),
           'message' => 'El usuario que desea agregar ya existe'),
        'required' => array('rule' => array('minLength', '1'),
            'message' => 'Nombre de usuario obligatorio')),
   'password'   => array(
        'required' => array('rule' => array('minLength', '1'),
            'message' => 'Contraseña obligatoria'),
        'length' => array('rule' => array('minLength', 6),
            'message' => 'La longitud mínima de la contraseña es de 6 caracteres'),
        'valid' => array('rule' => array('checkpasswords'),
            'message' => 'Las contraseñas deben coincidir')
      ),
    'email' => array(
        'valid' => array('rule' => array('checkemail'),
            'message' => 'El email que desea agregar ya existe')
        )
   );

    public function checkpasswords()
    {
        return strcmp($this->data['User']['password'],$this->data['User']['password_confirm']) == 0;
    }

    public function checkusers()
    {
        $username = $this->find('count', array(
            'conditions' => array('username' => $this->data['User']['username']),
            'recursive' => -1));
        return $username === 0;
    }

    public function checkemail()
    {
        $username = $this->find('count', array(
            'conditions' => array('email' => $this->data['User']['email']),
            'recursive' => -1));
        return $username === 0;
    }

	public $hasMany = array(
        'UserSearch'
    );

    public function isAdmin($user) {
	    return $this->isAdmin;
	}
    
    public function beforeSave($options = null) {
        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;
    }
}

?>
