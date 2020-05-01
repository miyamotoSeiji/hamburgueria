<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
 
    public $helpers = array(
        'Html', 
        'Js' => array('Jquery'), 
        'Form', 
        'Session', 
        'Flash',
        'Time',
    );  

    public $components = array(
        'RequestHandler', 
        'Session',
        'Flash',
    );
    
    public $userLogado = false;
    
    public function checkLogin() {
        $this->userLogado = $this->Session->read('userLogado');
        if (!$this->userLogado) {
            $this->redirect('/entrar');
        }        
    }
    
    public $paginate = array();
    public $paginateOrderFields = array();
    
    public function paginateConditions() {
        $text = null;
        $paginateConditions = $this->paginate['conditions'];
        
        return $paginateConditions;
    }
    
    public function paginateOrder() {
        $order = array();
        $sort = $this->Session->read($this->modelClass . 'Sort');
        $direction = $this->Session->read($this->modelClass . 'Direction');
        if (empty($direction)) {
            $direction = 'asc';            
        }        
        if (empty($sort)) {
            $order = $this->paginate['order'];
        } else {
            $order = array($sort => $direction);
        }

        return $order;        
    }
    
    public $saveMethod = 'save';
    
    public $saveOptions = array();

}
?>
