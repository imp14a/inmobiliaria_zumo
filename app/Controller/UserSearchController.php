<?php

App::Import('Model','UserSearch');
App::Import('Model','UserFavorite');

class UserSearchController extends AppController {

	var $components = array('Session');

	public $uses = array("Property");
	var $paginate = array(
        'limit' => 9,
        'order' => array(
            'Property.name' => 'asc'
        ),
        'recursive'=>2
    );

	public function save_search(){
		if (!empty($this->request->data)) {			
			$this->request->data['UserSearch']['user_id'] = $this->Auth->user('id');			
			$us = new UserSearch();
   			if($us->save($this->request->data, false)){
				$this->Session->setFlash('Búsqueda registrada.');
				$this->redirect(array('action' => 'index'));					
			}else{
				$this->Session->setFlash('Ha ocurrido un error, por favor intente más tarde');
			}
		}
	}

	public function delete_all(){
		if ($this->UserSearch->deleteAll(array('UserSearch.user_id' => $this->Auth->user('id')), false)) {
            $this->Session->setFlash('Se han eliminado todas las búsquedas.');
            $this->redirect(array('action' => 'index'));
        }else{
        	$this->Session->setFlash('Ha ocurrido un error, intente de nuevo.');
        }
	}

	public function delete(){
		$this->layout = "ajax";
		$user_search_id = utf8_decode(isset($_REQUEST['user_search_id']) ? $_REQUEST['user_search_id'] : '');
		$out = array();
        if ($this->UserSearch->delete($user_search_id)) {
            $out = array('success' => 1);
        }else{
        	$out = array('success' => 0);
        }
        $this->set('output', $out);
	}

	public function index(){
		$this->layout = 'property_layout';
		$this->set('user_searchs',true);
		$this->set('title_for_layout','Mis búsquedas');

		$user_id = $this->Session->read('Auth.User.id');

		$uf = new UserFavorite();
		$userFavorites = $uf->findByUserId($user_id);

		$q = array();
		foreach($userFavorites as $favorite){
			array_push($q, $favorite['property_id']);
		}
		$options = array('Property.id'=>$q);

		$this->set('found_properties', $this->paginate('Property', $options));
	}

	public function getSearchesByUser(){
		$this->layout = "ajax";
		$user_id = utf8_decode(isset($_REQUEST['user_id']) ? $_REQUEST[ 'user_id' ] : '');
		$options =  array(
			'recursive' => -1, //int
			'conditions'=>array('UserSearch.user_id' => $user_id),
			'order' => array('UserSearch.date')
		);
		$out = array();
		$us = new UserSearch();
		foreach($us->find('all', $options) as $res){
			array_push($out, utf8_encode(json_encode($res['UserSearch'])));
		}
		$this->set('output', $out);
	}

	public function beforeFilter() {
        parent::beforeFilter();
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('save_search', 'index', 'getSearchesByUser', 'delete', 'delete_all'))) {
            return true;
        }
        return parent::isAuthorized($user);
    }
}

?>