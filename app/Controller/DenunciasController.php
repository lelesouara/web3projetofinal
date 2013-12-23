<?php 
#DenunciasController.php 

	class DenunciasController extends AppController{

		public $name = "Denuncias";
		public $components = array('Session', 'Cookie');

		public function beforeFilter() {
	        //parent::beforeFilter();
	        $this->Auth->allow('view');
    	}

    	public function view($id){
    		$denuncia = $this->Denuncia->findById($id);
    		$this->set('denuncia', $denuncia);
    	}

    	public function all(){
    		//Todas as denuncias do usuario logado.
    		$minhasDenuncias = $this->Denuncia->find('all',
    			array('conditions' => array(
    				'user_id' => $this->Auth->user('id')
    			))
    		);
    		$this->set('minhasDenuncias', $minhasDenuncias);
    	}

		public function add(){
			$this->loadModel("Tag");
			$tags = $this->Tag->find(
    			'all',
    			array('order' => 'Tag.titulo ASC')
			);

			if($this->request->is('post')){
				//Adicionar a denúncia;
				$this->Denuncia->create();
				if($this->Denuncia->save($this->request->data)) {

					//Ao salvar ele salva as tags
					$Denuncia_id = $this->Denuncia->id;
					$arrTags = explode('@', $this->request->data['arrTags']);
					
					$DenunciaTagsSalvas = 0;
					$QuantidadeTagsDenuncias = count($arrTags);

					foreach ($arrTags as $tag) {
						$this->loadModel("Denuncia_Tag");
						$this->Denuncia_Tag->create();
						$this->Denuncia_Tag->denuncia_id = $Denuncia_id;
						$this->Denuncia_Tag->tag_id = $tag;
						if($this->Denuncia_Tag->save($this)){
							$DenunciaTagsSalvas++;
						}	
					}
					if($QuantidadeTagsDenuncias == $DenunciaTagsSalvas)
						$this->Session->setFlash('Denúncia salva com sucesso!');
					else
						$this->Session->setFlash('Problemas ao salvar marcações da denúncia.');
					return $this->redirect(array('controller' => 'Denuncias', 'action' => 'add'));	
				}	
				
			}

			$this->set('tags', $tags);
		}

		public function edit($id){
		}

		public function delete(){
			if($this->request->is('post')){
				if($this->Denuncia->delete($this->request->data('Denuncia.id'))){
					$this->Session->setFlash('Deletado com sucesso!');
					return $this->redirect(array('controller' => 'Denuncias', 'action' => 'all'));	
				}
			}
		}

	}
?>