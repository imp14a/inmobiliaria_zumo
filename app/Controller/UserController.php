<?php

App::import('Model','PostalCode');

class UserController extends AppController {

	public function index(){
		$this->set('title_for_layout','Usuario');
	}

	public function register(){
		$this->set('title_for_layout','Usuario');
	}

	public function get_Postal_Code(){

		$this->layout = "ajax";

		$postalC = isset($_GET['cp']) ? $_GET[ 'cp' ] : null;
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