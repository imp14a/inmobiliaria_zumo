<?php

App::Import('Model','UserSearch');

class UserSearchController extends AppController {

	public function save_search(){
		if (!empty($this->request->data)) {			
			$this->request->data['UserSearch']['user_id'] = $this->Auth->user('id');			
			var_dump($this->request->data);
			if($this->UserSearch->saveAll($this->request->data, array('validate'=>'first'))){
				$this->Session->setFlash('Búsqueda registrada.');
				$this->redirect(array('action' => 'index'));					
			}else{
				$this->Session->setFlash('Ha ocurrido un error, por favor intente más tarde');
			}
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
		$this->set('title_for_layout','Mis búsquedas');
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
		foreach($this->UserSearch->find('all', $options) as $res){
			array_push($out, utf8_encode(json_encode($res['UserSearch'])));
		}
		$this->set('output', $out);
	}

	public function beforeFilter() {
        parent::beforeFilter();
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('save_search', 'index', 'getSearchesByUser', 'delete'))) {
            return true;
        }
        return parent::isAuthorized($user);
    }
}

?>