<?php

App::import('Model','PostalCode');
App::uses('AuthComponent', 'Controller/Component');

class UserController extends AppController {

    var $components = array('Session');

	public function index(){
		$this->set('title_for_layout','Listado de Usuarios');
        $this->set('users', $this->User->find('all'));
	}


    public function add($id = null){
        App::uses('Security', 'Utility'); 
        $this->set('title_for_layout','Registro de usuarios');
        $this->User->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->User->read();
        } 
        else {
            if (empty($this->request->data)) {
            }else{
                if (isset($this->request->data['User']['password'])) {
                    $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
                }
                if($this->User->save($this->request->data)){
                    $this->Session->setFlash('Usuario Registrado!');
                    $this->redirect(array('action' => 'login'));
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
    /*public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'register', 'login', 'logout');
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash('Usuario o contraseña inválidos, intente de nuevo.');
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('add', 'login', 'logout'))) {
            return true;
        }

        if (in_array($this->action, array('index', 'edit', 'delete'))) {
            if ($this->User->isAdmin($user)) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }*/
}

?>