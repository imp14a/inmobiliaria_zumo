<?php
class InmobiliariaZumoController extends AppController {

	public function index(){
        $this->layout = 'index_layout';
        
		$this->set('title_for_layout','!Bienvenido!');
	}
}

?>