<?php
class PedidosController extends AppController {
    
    var $name = 'Pedidos';
    
    public $uses = array('Pedido');
    
    public $paginate = array(
        'fields' => array(
            'Pedido.id',
            'Pedido.user_id',
            'Pedido.status_id',
            'Pedido.info',
            'Pedido.created',
            'Pedido.modified',
            'Pedido.deleted',
        ),
        'contain' => array('User' => array('fields' => array('id', 'nome', 'endereco'))),
        'conditions' => array('Pedido.deleted IS NULL'),
        'limit' => 10,
        'order' => array('Pedido.id' => 'desc')
    );
      
    public function index() {
        $this->checkLogin();
        $userLogado = $this->Session->read('userLogado');
        $this->set('userLogado', $userLogado);
        $this->paginate['conditions'] = $this->paginateConditions();
        if ($userLogado['User']['user_type'] == 'cliente') {
            $this->paginate['conditions']['Pedido.user_id']  = $userLogado['User']['id'];            
        }
        try {
            $records = $this->paginate(null, null, $this->paginateOrderFields);
        } catch (NotFoundException $e) {
            if ($userLogado['User']['user_type'] == 'cliente') {
                $this->redirect('/pedidos/add');
            }
        }        
        $this->set('pedidos', $records);
    }
    
    public function edit($id = null) {
        $this->checkLogin();
        $userLogado = $this->userLogado;
        $this->set('userLogado', $userLogado);
        $this->Pedido->contain(array('User', 'PedidoProduto' => array('conditions' => array('PedidoProduto.deleted IS NULL'), 'Produto')));
        $pedido = $this->Pedido->findById($id);
        $this->Session->write('pedido', $pedido);
        if ($this->request->is(array('post', 'put'))) {
            $this->Pedido->id = $id;
            if ($this->request->data['Pedido']['status_id'] == 1) {
                $this->request->data['Pedido']['status_id'] = 2;
            }
            if ($this->request->data['Pedido']['status_id'] == 4 && $userLogado['User']['user_type'] != 'admin') {
                $this->request->data['Pedido']['status_id'] = 3;
            }
            if ($this->Pedido->save($this->request->data)) {
                $this->Session->delete('pedido');
                $this->Flash->set('Pedido enviado com sucesso!.', array('params' => array('class' => 'alert alert-success')));
                $this->redirect('/pedidos/index');
            }
            $this->Flash->set('Não foi possível alterar.', array('params' => array('class' => 'alert alert-error')));
        }

        if (!$this->request->data) {
            $this->request->data = $pedido;
        }
    }
    
    public function view($id = null) {
        $this->checkLogin();
        $this->Pedido->contain(array('User', 'PedidoProduto' => array('Produto')));
        $pedido = $this->Pedido->findById($id);
        if (!$this->request->data) {
            $this->request->data = $pedido;
        }
    }
    
    public function delete($id = null) {
        $this->checkLogin();
        if (!empty($id)) {
            $this->Pedido->id = $id;
            $this->Pedido->saveField('deleted', date('Y-m-d H:i:s'));
            $this->Flash->set('Pedido excluido com sucesso!.', array('params' => array('class' => 'alert alert-success')));
            $this->redirect('/Pedidos/index');
        }
    }
    
    public function desempenhoSeteDias() {
        $dataFinal = date("Y-m-d H:i:s");
        $dataInicial = date("Y-m-d", strtotime('-7 days', strtotime($dataFinal))) . " 00:00:00";
        $conditions = array('Pedido.created BETWEEN ? AND ?' => array($dataInicial, $dataFinal), 'Pedido.deleted IS NULL', 'Pedido.status_id' => 7);
        $pedidos = $this->Pedido->find('all', array(
            'conditions' => $conditions,
            'contain' => array('User', 'PedidoProduto' => array('conditions' => array('PedidoProduto.deleted IS NULL'), 'Produto'))
        ));
        $vendidos = array('periodoInicio' => date("d/m/Y", strtotime($dataInicial)), 'periodoFinal' => date("d/m/Y", strtotime($dataFinal)));
        if (!empty($pedidos)) {
            foreach ($pedidos as $pedido) {
                foreach($pedido['PedidoProduto'] as $produto) {
                    $vendidos['Produtos'][$produto['Produto']['nome']]['nome'] = $produto['Produto']['nome'];
                    if (!empty($vendidos['Produtos'][$produto['Produto']['nome']]['quantidade'])) {
                        $quantidade = $vendidos['Produtos'][$produto['Produto']['nome']]['quantidade'];
                        $vendidos['Produtos'][$produto['Produto']['nome']]['quantidade'] = $quantidade + 1;
                    } else {
                        $vendidos['Produtos'][$produto['Produto']['nome']]['quantidade'] = 1;
                    }
                    if (!empty($vendidos['Produtos'][$produto['Produto']['nome']]['total'])) {
                        $total = $vendidos['Produtos'][$produto['Produto']['nome']]['total'];
                        $vendidos['Produtos'][$produto['Produto']['nome']]['total'] = $total + $produto['Produto']['valor'];
                    } else {
                        $vendidos['Produtos'][$produto['Produto']['nome']]['total'] = $produto['Produto']['valor'];
                    }
                }
            }
        }
        $this->set('vendidos', $vendidos);
    }
    
} 
