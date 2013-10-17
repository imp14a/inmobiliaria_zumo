<?php

App::import('Model','UserFavorite');

class UserFavoritesController extends AppController {

	public function add($property_id=null){
		if($this->Session->read('Auth.User')){
			$data = array(
				'property_id'=>$property_id,
				'user_id'=>$this->Session->read('Auth.User.id')
				);
			$uf = new UserFavorite();
			$uf->save($data);
		}else{
			$this->Session->setFlash('Error: Necesitas ingresar para guardar en Favoritos.','default', array('class'=>'message error'));
		}
		$this->redirect(array('controller' => 'Property', 'action' => 'view',$property_id));
	}

	public function remove($property_id=null){
		if($this->Session->read('Auth.User')){
			$uf = new UserFavorite();
			$found = $uf->findByPropertyIdAndUserId($property_id,$this->Session->read('Auth.User.id'));
			
			if(!$uf->delete($found['UserFavorite']['id'])){
				$this->Session->setFlash('Error: No se pudo quitar de Favoritos.','default', array('class'=>'message error'));
			}
		}else{
			$this->Session->setFlash('Error: Necesitas ingresar para eliminar de Favoritos.','default', array('class'=>'message error'));
		}
		$this->redirect(array('controller' => 'Property', 'action' => 'view',$property_id));
	}

	public function index(){
		$this->set('title_for_layout','Mis favoritos');
	}

	 public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'remove', 'index');
    }
}

?>