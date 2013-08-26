<?php

App::import('Model','PostalCode');

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
                if(!empty($this->request->data['User']['password'])) {
                    $this->request->data['User']['password'] = Security::hash($this->request->data['User']['password']);
                }
                if($this->User->save($this->request->data)){ //, array('validate'=>'first'))){
                    $this->Session->setFlash('Usuario Registrado!');
            $this->redirect(array('action' => 'index'));
                }else{

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
}

?>