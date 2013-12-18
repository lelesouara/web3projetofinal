<?php
//IndexController

class IndexController extends AppController{
	public $name = "Index";

	public function beforeFilter() {
        //parent::beforeFilter();
        $this->Auth->allow('index');
    }

	public function index(){
	}


}