<?php
App::uses('AppModel', 'Model');

class PedidoProduto extends AppModel {

    public $belongsTo = array(
        'Pedido' => array(
            'className' => 'Pedido',
            'foreignKey' => 'pedido_id'
        ),
        'Produto' => array(
            'className' => 'Produto',
            'foreignKey' => 'produto_id'
        )
    );
}