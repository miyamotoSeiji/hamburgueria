<?php
App::uses('AppModel', 'Model');

class Pedido extends AppModel {
     
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );
    
    public $hasMany = array('PedidoProduto');
    
    public function cancelarPedido($pedido) {
        $this->id = $pedido['Pedido']['id'];
        $pedidoCancelado = $this->saveField('status_id', 8);
        
        return $pedidoCancelado;
    }
}