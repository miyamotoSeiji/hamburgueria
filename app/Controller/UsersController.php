<?php
class UsersController extends AppController {
   
    public function login() {
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $password = md5($this->request->data['User']['password']);
                $userLogado = $this->User->find('first', array('conditions' => array('email' => $this->request->data['User']['email'], 'password' => $password)));
                if (!empty($userLogado)) {
                    $this->Session->write('userLogado', $userLogado);
                    if ($userLogado['User']['user_type'] == 'admin') {
                        $this->redirect('/pedidos/index');
                    }
                    $this->redirect('/produtos/index');
                }
                $this->Flash->set('Nome ou senha inválidos! Tente novamente!', array('params' => array('class' => 'alert alert-danger')));
            }
            
        }
    }
    
    public function logout() {
        $this->Session->delete('userLogado');
        $pedido = $this->Session->read('pedido');
        if (!empty($pedido)) {
            $modelPedido = ClassRegistry::init('Pedido');
            $modelPedido->cancelarPedido($pedido);
        }
        $this->Session->delete('pedido');
        $this->redirect('/entrar');
    }
    
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->set('O cadastro foi salvo com sucesso!', array('params' => array('class' => 'alert alert-success')));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Flash->set('Não foi possível completar o cadastro!', array('params' => array('class' => 'alert alert-danger')));
        }
    }

    public function edit($id = null) {
        $this->checkLogin();
        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                $this->Flash->set(' Dados Alterados com sucesso.', array('params' => array('class' => 'alert alert-success')));
                if ($this->userLogado['User']['user_type'] != 'admin') {
                    $this->redirect('/produtos/index');
                } else {
                    $this->redirect('/pedidos/index');
                }
            }
            $this->Flash->set('Não foi possível alterar.', array('params' => array('class' => 'alert alert-danger')));
        }

        if (!$this->request->data) {
            $this->request->data = $user;
        }
    }
    
    public function trocarSenha($id = null) {
        $this->checkLogin();
        $this->edit($id);
        $this->request->data['User']['password'] = null;
    }

} 