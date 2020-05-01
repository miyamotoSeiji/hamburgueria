<?php
class PedidoProdutosController extends AppController {
    
    var $name = 'PedidoProduto';
    
    public $uses = array('PedidoProduto', 'Pedido', 'Produto');
    
    public function add($produtoId = null) {
        $this->checkLogin();
        $pedido = $this->Session->read('pedido');
        if (empty($pedido)) {
            $modelPedido = ClassRegistry::init('Pedido');
            $modelPedido->id = false;
            $pedidoData = array('Pedido' => array('user_id' => $this->userLogado['User']['id']));
            $pedido = $modelPedido->save($pedidoData);
            $pedidoId = $pedido['Pedido']['id'];
            $this->Session->write('pedido', $pedido);
        } else {
            $pedidoId = $pedido['Pedido']['id'];
        }
        if (!empty($pedidoId)) {
            $this->PedidoProduto->id = false;
            $this->request->data['PedidoProduto']['pedido_id'] = $pedidoId;
            $this->request->data['PedidoProduto']['produto_id'] = $produtoId;
            if ($this->PedidoProduto->save($this->request->data)) {
                $this->Flash->set('Produto adicionado ao seu pedido com sucesso!', array('params' => array('class' => 'alert alert-success')));
                $this->redirect('/produtos/');
            }
        } 
    }
    
    public function addProduto($pedidoId) {
        $pedido = $this->Session->read('pedido');
        if (empty($pedido)) {
            $modelPedido = ClassRegistry::init('Pedido');
            $pedido = $modelPedido->findById($pedidoId);    
            $this->Session->write('pedido', $pedido);
        }
        $this->redirect('/produtos/');
    }
    
    public function edit($id = null) {
        $this->checkLogin();
        $pedido = $this->Pedido->findById($id);
        if (!$pedido) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Pedido->id = $id;
            if ($this->Pedido->save($this->request->data)) {
                $this->Flash->set('Pedido Alterado.', array('params' => array('class' => 'alert alert-success')));
                $this->redirect('/pedidos/index');
            }
            $this->Flash->set('Não foi possível alterar.', array('params' => array('class' => 'alert alert-error')));
        }

        if (!$this->request->data) {
            $this->request->data = $pedido;
        }
    }
    
    public function delete($pedidoId, $id) {
        $this->checkLogin();
        if (!empty($id)) {
            $this->PedidoProduto->id = $id;
            $this->PedidoProduto->saveField('deleted', date('Y-m-d H:i:s'));
            $this->Flash->set('Produto excluído com sucesso!.', array('params' => array('class' => 'alert alert-success')));
            $this->redirect('/Pedidos/edit/' . $pedidoId);
        }
    }
    
} 
