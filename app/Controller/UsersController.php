<?php

App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {
    
    public $components = array('RequestHandler');

    public function beforeFilter() {
        //parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
    }

    public function index() {
        $this->set('titlePage', 'Pagina Administrativa ->  Usuarios (Index)');
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function login() {
        if ($this->Auth->login()) {
            $this->redirect($this->Auth->redirect());
        } else {
            //$this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function view($id = null) {
    }

    public function add() {
        if (AuthComponent::user())
            $this->redirect(array('controller' => 'index', 'action' => 'index'));

        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Usuario cadastrado com sucesso!'), 'sucesso');
                $this->redirect(array('action' => 'login'));
            } 
        }
    }
}

?>