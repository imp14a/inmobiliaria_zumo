<?php

class DownloadableController extends AppController{

	public $components = array('Paginator');
	public $paginate = array(
        'limit' => 1,
        'order' => array(
            'Downloadable.title' => 'asc'
        )
    );

	public function index(){
		$this->set('title_for_layout','Listado de Descargables');
        $this->set('downloadables', $this->Downloadable->find('all'));
	}

	public function view(){
		$this->set('title_for_layout','Vista de Descargable');
		$this->Paginator->settings = $this->paginate;
		$downloadables = $this->Paginator->paginate('Downloadable');
		$this->set('downloadables', $downloadables);
	}

	public function delete($id) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Downloadable->delete($id)) {
            $this->Session->setFlash('Archivo eliminado.');
            $this->redirect(array('action' => 'index'));
        }else{
            $this->Session->setFlash('Ha ocurrido un error al tratar de eliminar, intente de nuevo.');
        }
    }

	public function upload($id = null){
		$this->set('title_for_layout','Subir Descargable');
		$this->Downloadable->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->Downloadable->read();
        } 
        else {
			if (!empty($this->request->data)) {  				
				$file = $this->request->data['Downloadable']['file'];
				if ($file['error'] === UPLOAD_ERR_OK) {
					if (move_uploaded_file($file['tmp_name'], WWW_ROOT.DS.'files'.DS.$file['name'])) {
						$this->request->data['Downloadable']['file_name'] = $file['name'];
						if($this->Downloadable->save($this->request->data)){
							$this->Session->setFlash('Archivo cargado con éxito');
							$this->redirect('index');
						}else{
							$this->Session->setFlash('Ha ocurrido un error al salvar el registro, intente de nuevo.');
						}	
					}else{
						$this->Session->setFlash('Ha ocurrido un error al salvar el archivo, intente de nuevo.');
					}
				}else{
					if($id!=null){
						if($this->Downloadable->save($this->request->data)){
							$this->Session->setFlash('Archivo actualizado con éxito');
							$this->redirect('index');
						}else{
							$this->Session->setFlash('Ha ocurrido un error al salvar el registro, intente de nuevo.');
						}	
					}else{
						$this->Session->setFlash('Ha ocurrido un error al subir el archivo, intente de nuevo.');
					}
				}
			}
		}
	}

	public function download($id = null){
		$this->Downloadable->id = $id;
		$file_info = $this->Downloadable->read();
		$path = WWW_ROOT.DS.'files'.DS.$file_info['Downloadable']['file_name'];
	    $this->response->file($path, array('download' => true, 'name' => $file_info['Downloadable']['file_name']));
    	return $this->response;
	}
	
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('download', 'view');
    }

	public function isAuthorized($user) {
        return parent::isAuthorized($user);
    }
}

?>