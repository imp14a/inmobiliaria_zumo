<?php
class InmobiliariaZumoController extends AppController {

	public function index(){
        $this->layout = 'index_layout';
        
		$this->set('title_for_layout','!Bienvenido!');
	}

	public function about(){
		$this->layout = 'default';

		$this->set('title_for_layout','¿POR QUÉ ZUMO?');
	}

	public function add(){
		$this->layout = 'default';

		$this->set('title_for_layout','Registro de inmuebles');	
	}
}

?>