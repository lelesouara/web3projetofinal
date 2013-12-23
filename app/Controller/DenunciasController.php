<?php 
#DenunciasController.php 

	class DenunciasController extends AppController{

		public $name = "Denuncias";
		public $components = array('Session', 'Cookie');

		public function beforeFilter() {
	        //parent::beforeFilter();
	        $this->Auth->allow('view', 'apoiar', 'ranking');
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
			$denuncia = $this->Denuncia->findById($id);
			
			$this->loadModel("Tag");
			$tags = $this->Tag->find(
    			'all',
    			array('order' => 'Tag.titulo ASC')
			);

			if($this->request->is('post')){
				$this->Denuncia->create();
				$this->Denuncia->id = $id;
				if($this->Denuncia->save($this->request->data)) {
					//Salva TAGS
					$Denuncia_id = $id;
					$arrTags = explode('@', $this->request->data['arrTags']);

					//Pega as que já estão no banco de dados 
					$inDatabaseTagsDenuncia = array();
					foreach($denuncia['Tags'] as $tagExistentes){
						$inDatabaseTagsDenuncia[] = $tagExistentes['id'];
					}

					$DenunciaTagsSalvas = 0;
					$QuantidadeTagsDenuncias = count($arrTags) - count($inDatabaseTagsDenuncia)	;

					foreach ($arrTags as $tag) {
						$this->loadModel("Denuncia_Tag");
						if(!in_array($tag, $inDatabaseTagsDenuncia)){
							$this->Denuncia_Tag->create();
							$this->Denuncia_Tag->denuncia_id = $Denuncia_id;
							$this->Denuncia_Tag->tag_id = $tag;
							if($this->Denuncia_Tag->save($this)){
								$DenunciaTagsSalvas++;
							}		
						}
					}
					if($QuantidadeTagsDenuncias == $DenunciaTagsSalvas)
						$this->Session->setFlash('Denúncia editada com sucesso!');
					else
						$this->Session->setFlash('Problemas ao editar marcações da denúncia.');
					return $this->redirect(array('controller' => 'Denuncias', 'action' => 'all'));
				}
			}

			$this->set('tags', $tags);
			$this->set('denuncia', $denuncia);
		}

		public function delete($id){
			$this->autoRender = false;

			if($this->request->is('post')){
				if($this->Denuncia->deleteAll(array('Denuncia.id' => $id), true)){
					$this->Session->setFlash('Deletado com sucesso!');
					return $this->redirect(array('controller' => 'Denuncias', 'action' => 'all'));	
				}else{
					$this->Session->setFlash('Erro ao deletar');
					return $this->redirect(array('controller' => 'Denuncias', 'action' => 'all'));	
				}
			}
		}

		public function apoiar($id){
			$this->autoRender = false;

			if($this->Cookie->check("apoiou.$id")){
				$this->Session->setFlash('Você já está apoiando esta denúncia.');
				return $this->redirect(array('controller' => 'index', 'action' => 'index'));	
			}

			$this->loadModel('Ranking');
			// 0 - not exists, 1 exists
			$existsInDb = $this->Ranking->find('count', array('conditions' => array('denuncia_id' => $id)));
			if(!$existsInDb){
				$this->Ranking->create();
				$this->Ranking->denuncia_id = $id;
				$this->Ranking->qtdapoios = 1;
				if($this->Ranking->save($this)){
					$this->Session->setFlash('Você está apoiando esta denúncia. Obrigado!');
					$this->Cookie->write('apoiou.'.$id, $id, false, '2 Days');
					return $this->redirect(array('controller' => 'index', 'action' => 'index'));	
				}
			}else{
				$apoio = $this->Ranking->find('all', array('conditions' => array('denuncia_id' => $id)));
				
				$this->Ranking->create();
				$this->Ranking->id = $apoio[0]['Ranking']['id'];
				$this->Ranking->denuncia_id = $id;
				$this->Ranking->qtdapoios = $apoio[0]['Ranking']['qtdapoios']+1;
				if($this->Ranking->save($this)){
					$this->Session->setFlash('Você está apoiando esta denúncia. Obrigado!');
					$this->Cookie->write('apoiou.'.$id, $id, false, '2 Days');
					return $this->redirect(array('controller' => 'index', 'action' => 'index'));
				}
			}
		}

		public function ranking(){
			$this->loadModel('Ranking');
			$rankingLista = $this->Ranking->find('all', array('order' => 'qtdapoios DESC', 'limit' => 20));
			$this->set('lista', $rankingLista);
		}

	}
?>