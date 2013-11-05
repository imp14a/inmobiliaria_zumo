<?php

class DownloadableController extends AppController{

	public $components = array('Paginator');
	public $paginate = array(
        'fields' => array('Downloadable.id', 'Downloadable.file_name'
        	,'Downloadable.title', 'Downloadable.description'),
        'limit' => 1,
        'order' => array(
            'Downloadable.title' => 'asc'
        )
    );

	public function index(){
		$this->set('title_for_layout','Listado de Descargables');
        $this->set('downloadables', $this->Downloadable->find('all'));
	}

	public function view($id = null){
		$this->set('title_for_layout','Vista de Descargable');
		$this->Downloadable->id = $id === null ? $this->Downloadable->find('first') : $id;
		if ($this->request->is('get')) {
			$id_docs = $this->Downloadable->find('list', array('fields'=>array('Downloadable.id'),
				'recursive'=>-1));
			$no_docs = $this->Downloadable->find('count', array('recursive' => -1));
			$marca = false;
			$back_id = "";
			$next_id = "";
			$no_doc = 0;
			foreach ($id_docs as $key => $value) {
				if($marca){
					$next_id = $value;
					break;
				}
				if(strcmp($value, $this->Downloadable->id) === 0){
					$marca = true;
					$next_id = $value;
				}
				if(!$marca){
					$back_id = $value;
				}
				$no_doc++;
			}	
			$this->set('no_doc', $no_doc);
			$this->set('back_id', $back_id);	
			$this->set('next_id', $next_id);
			$this->set('no_docs', $no_docs);
			$this->set('downloadable', $this->Downloadable->read());
        } 
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
				}
				else{
					$this->Session->setFlash('Ha ocurrido un error al subir el archivo, intente de nuevo.');
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