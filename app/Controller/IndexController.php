<?php
//IndexController

class IndexController extends AppController{
	public $name = "Index";

	public function beforeFilter() {
        //parent::beforeFilter();
        $this->Auth->allow('index');
    }

	public function index(){
		$this->loadModel('Denuncia');
                
                $options = array(
                    'order' => array('Denuncia.id DESC'),
                    'limit' => 4
                );
                $this->paginate = $options;
		$denuncias = $this->paginate("Denuncia");
                
		$this->set('ultimasDenuncias', $denuncias);
	}


}