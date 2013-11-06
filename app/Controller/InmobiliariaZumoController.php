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
		if(!empty($this->data)){
			
			$message = '			Hola, se recibió información de contacto de parte de: ' . $this->data['ContactMessage']['username'] . '<'.$this->data['ContactMessage']['email'].' >,
			 con el siguiente mensaje: 

			 '.$this->data['ContactMessage']['message'].'

			  Contáctalo.' ;
			$this->send_mail($this->data['ContactMessage']['email'],$this->data['ContactMessage']['username'],$message);
			$this->Session->setFlash("El mensaje fue enviado correctamente, nosotros nos pondremos en contacto.");
		}
	}

	public function downloadables(){
		$this->set('title_for_layout', 'DESCARGABLES');		
	}

	public function panelAdministration(){
        $this->set('title_for_layout','Panel de administración');
    }

    public function news(){
    	$this->set('title_for_layout', 'NOTICIAS');	
    }

    public function isAuthorized($user){
        return parent::isAuthorized($user);
    }

    public function send_mail($receiver = null, $name = null, $message = null) { 
    	App::uses('CakeEmail', 'Network/Email');
        $email = new CakeEmail('zumomail');
        $email->from(Configure::read('email.info'));
        $email->to($Configure::read('email.contact'));
        $email->subject('Correo contacto: '.utf8_encode($name));
        $email->send($message);
    }
}

?>