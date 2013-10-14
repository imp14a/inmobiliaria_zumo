<?php
class InmobiliariaZumoController extends AppController {

	public function index(){
        $this->layout = 'index_layout';
        
		$this->set('title_for_layout','!Bienvenido!');
	}

	public function about(){
		$this->set('title_for_layout','¿POR QUÉ ZUMO?');
	}

	public function alliances(){
		$this->set('title_for_layout', 'ALIANZAS');
	}

	public function components(){		
		$this->set('title_for_layout', 'COMPONENTES');
	}

	public function contact(){
		$this->set('title_for_layout', 'CONTACTO');	
	}

	public function downloadables(){
		$this->set('title_for_layout', 'DESCARGABLES');		
	}

	public function panelAdministration(){
        $this->set('title_for_layout','Panel de administración');
    }

    public function isAuthorized($user){
        return parent::isAuthorized($user);
    }
}

?>