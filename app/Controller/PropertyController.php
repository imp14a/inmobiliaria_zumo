<?php
class PropertyController extends AppController {

	public function index(){
		$this->layout = 'property_layout';

		$this->set('title_for_layout','Propiedades');
	}
}

?>