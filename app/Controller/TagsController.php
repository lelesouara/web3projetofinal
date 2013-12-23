<?php 
#DenunciasController.php 

	class TagsController extends AppController{

		public $name = "Tags";
		public $components = array('Session', 'Cookie');

		public function beforeFilter() {
	        //parent::beforeFilter();
	        $this->Auth->allow('all');
    	}

    	public function all(){
    	}

		public function add(){
		}

		public function edit($id){
		}

		public function delete(){
		}

	}
?>