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
		$denuncias = $this->Denuncia->find('all', array('limit' => 10, 'order' => 'Denuncia.id DESC'));
		$this->set('ultimasDenuncias', $denuncias);
	}


}