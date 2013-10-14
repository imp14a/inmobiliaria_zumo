<?php



class UserFavoritesController extends AppController {

	public function add($property_id=null){
		
	}

	public function remove($property_id=null){
		
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