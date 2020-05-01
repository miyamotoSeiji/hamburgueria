<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
class ProdutosController extends AppController {
   
    var $name = 'Produtos';
    
    public $uses = array('Produto');
    
    public $paginate = array(
        'fields' => array(
            'Produto.id',
            'Produto.nome',
            'Produto.foto',
            'Produto.valor',
            'Produto.info',
        ),
        'conditions' => array('Produto.deleted IS NULL'),
        'limit' => 9,
        'order' => array('Produto.id' => 'desc')
    );
      
    public function index() {
        $userLogado = $this->Session->read('userLogado');
        $pedido = $this->Session->read('pedido');
        $this->set('userLogado', $userLogado);
        $this->set('pedido', $pedido);
        $this->paginate['conditions'] = $this->paginateConditions();
        try {
            $records = $this->paginate(null, null, $this->paginateOrderFields);
        } catch (NotFoundException $e) {
            if ($userLogado['User']['user_type'] == 'admin') {
                $this->redirect('/produtos/add');
            }
        }        
        $this->set('produtos', $records);
    }
    
    public function add() {
        $this->checkLogin();
        if (!empty($this->request->data[$this->modelClass])) {
            $this->{$this->modelClass}->id = false;
            $this->request->data['Produto']['user_id'] = $this->userLogado['User']['id'];
            if (!empty($this->request->data['Produto']['foto'])) {
                new Folder(ROOT_URL . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'webroot' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR . $this->userLogado['User']['id'], true, 0666);
                copy($this->request->data['Produto']['foto']['tmp_name'], ROOT_URL . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'webroot' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR . $this->userLogado['User']['id'] . DIRECTORY_SEPARATOR . 'foto' . $this->request->data['Produto']['nome'] . date('dmYHi') . '.jpg');
                $this->request->data['Produto']['foto'] = 'foto' . $this->request->data['Produto']['nome'] . date('dmYHi') . '.jpg';
            }
            if ($this->Produto->save($this->request->data)) {
                $this->Flash->set('O cadastro foi salvo com sucesso!', array('params' => array('class' => 'alert alert-success')));
                $this->redirect('/produtos/index');
            }
        } 
    }
    
    public function edit($id = null) {
        $this->checkLogin();
        $produto = $this->Produto->findById($id);
        if (!$produto) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Produto->id = $id;
            if (!empty($this->request->data['Produto']['foto']['tmp_name'])) {
                copy($this->request->data['Produto']['foto']['tmp_name'], ROOT_URL . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'webroot' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR . $this->userLogado['User']['id'] . DIRECTORY_SEPARATOR . 'foto' . $this->request->data['Produto']['nome'] . date('dmYHi') . '.jpg');
                $this->request->data['Produto']['foto'] = 'foto' . $this->request->data['Produto']['nome'] . date('dmYHi') . '.jpg';
            } else {
                unset($this->request->data['Produto']['foto']);
            }
            if ($this->Produto->save($this->request->data)) {
                $this->Flash->set('Dados Alterados.', array('params' => array('class' => 'alert alert-success')));
                $this->redirect('/produtos/index');
            }
            $this->Flash->set('Nãoo foi possível alterar.', array('params' => array('class' => 'alert alert-error')));
        }

        if (!$this->request->data) {
            $this->request->data = $produto;
        }
    }
    
    public function delete($id = null) {
        $this->checkLogin();
        if (!empty($id)) {
            $this->Produto->id = $id;
            $this->Produto->saveField('deleted', date('Y-m-d H:i:s'));
            $this->Flash->set('Produto excluido com sucesso!.', array('params' => array('class' => 'alert alert-success')));
            $this->redirect('/Produtos/index');
        }
    }
    
} 
