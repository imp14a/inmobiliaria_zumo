<?php

App::import('Model','PostalCode');
App::uses('AuthComponent', 'Controller/Component');
App::uses('Folder', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class UserController extends AppController {

    var $components = array('Session');

	public function index(){
		$this->set('title_for_layout','Listado de Usuarios');
        $this->set('users', $this->User->find('all'));
	}


    public function add($id = null){
        $this->set('title_for_layout','Registro de usuarios');
        $this->User->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->User->read();
        } 
        else {
            if (!empty($this->request->data)) {
                if($this->User->save($this->request->data, false)){
                    $this->Session->setFlash('Usuario Registrado!');
                    $this->redirect(array('action' => 'index'));
                }else{
                    $this->Session->setFlash(__('Ha ocurrido en error, intente de nuevo.'));
                }
            }
        }
    }

    public function delete($id) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        if ($this->User->delete($id)) {
            $this->Session->setFlash('Usuario eliminado.');
            $this->redirect(array('action' => 'index'));
        }else{
            $this->Session->setFlash('Ha ocurrido un error, intente de nuevo.');
        }
    }

	public function getPostalCode(){

		$this->layout = "ajax";

		$postalC = isset($_REQUEST['cp']) ? $_REQUEST[ 'cp' ] : null;
        if(($postalC == NULL && empty($this->params))){
            return $this->redirect(array('action' => 'register'), array('error'=>'Codigo postal Invalido:'.$postalC));
        }
        if($postalC == NULL){
            $postalC = $this->params["form"]["postalC"];
        }
        $postalCode = new PostalCode();
        $REO = 0;
        $postalCode->recursive = 0;
        $responses = $postalCode->find("all",array('conditions' => array('PostalCode.start LIKE' => $postalC."%"), 'fields' => array( 'PostalCode.start', 'State.id', 'State.name', 'Municipality.name', 'Quarter.name', 'City.name' ) ) );
        $out = array();

        foreach($responses as $resp){			
            $REO++;
            $out[] = array(
                    'CP'=>$resp["PostalCode"]["start"], 
                    'StateId'=>$resp["State"]["id"], 
                    'StateName'=>$resp["State"]["name"], 
                    'MunicipalityName'=>$resp["Municipality"]["name"],
                    'QuarterName'=>$resp["Quarter"]["name"],
                    'CityName'=>$resp["City"]["name"]
                    );

        }
        $this->set('output', $out);
	}

    /**
     * Login & logout
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register', 'login', 'logout', 'send_mail',
         'getSecretUserId', 'confirm');
    }

    public function login() {
        $this->set('title_for_layout','Ingresa');
        $this->layout = "modal";
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash('Usuario o contraseña incorrectos, intente de nuevo.');
        }
    }

    public function register(){
        $this->set('title_for_layout','Registro');
        $this->layout = "modal";
        if (!empty($this->request->data)) {                         
            if($this->User->save($this->request->data)){
                $this->send_mail($this->request->data['User']['email'], $this->request->data['User']['username']);
                $this->request->data = null;
                $this->Session->setFlash('En breve recibirá un correo para confirmar su registro.');            
            }else{
                $this->Session->setFlash('Ha ocurrido un error, intente de nuevo.');
            }
        }
    }

    public function confirm($access = null){
        if ($this->request->is('get')) {            
            $access = urldecode($access);
            $access = base64_decode(strtr($access, '-_,', '+/='));
            $key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
            $decrypted = Security::rijndael($access, $key, 'decrypt');
            $this->request->data = $this->User->read(null, $decrypted);
            if($this->User->saveField('emailConfirmed', true, false)){
                $user = $this->User->findById($decrypted);
                $user = $user['User'];               
                if($this->Auth->login($user)){
                    $this->Session->setFlash('Usuario confirmado correctamente.');
                    $this->redirect(array('controller' => 'property', 'action' => 'simple_search'));    
                }
            }else{
                $this->Session->setFlash('Ha ocurrido un error con la clave proporcionada.');
            }
        }
    }

    public function getSecretUserId(){
        // Encrypt data.
        $key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
        $encrypted = Security::rijndael(intval($this->User->getInsertID()), $key, 'encrypt');
        return strtr(base64_encode($encrypted), '+/=', '-_,');
    }
                    
    public function send_mail($receiver = null, $name = null) {
        $confirmation_link = "http://".$_SERVER['HTTP_HOST']."/inmobiliaria_zumo/index.php/User/confirm/".urlencode($this->getSecretUserId());
        $message = 'Hola, ' . utf8_encode($name) . ', para confirmar tu correo da clic en la siguiente dirección: ' . $confirmation_link;        
        $email = new CakeEmail('zumomail');
        $email->from(Configure::read('email.info'));
        $email->to($receiver);
        $email->subject('Confirmación de correo');
        $email->send($message);
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('register', 'login', 'logout', 'getPostalCode'))) {
            return true;
        }
        return parent::isAuthorized($user);
    }

}

?>