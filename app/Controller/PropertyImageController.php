<?php

App::Import('Model','PropertyImage');

class PropertyImageController extends AppController {
	
	public function delete($id){
    	if ($this->PropertyImage->delete($id)) {
            $this->Session->setFlash('Propiedad actualizada!');
            $this->redirect($this->referer());
        }else{
            $this->Session->setFlash('Ha ocurrido un error, intente de nuevo.');
        }
    }
}

?>