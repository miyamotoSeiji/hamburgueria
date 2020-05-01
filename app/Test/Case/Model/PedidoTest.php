<?php
App::uses('AppModelTestCase', 'Test'); 

class PedidoTest extends AppModelTestCase {
    
    public $fixtures = array(
        'app.pedido',
        'app.user',
    );    
    
    public $modelName = 'Pedido';
    
    public function testInstance() {
        $this->assertTrueInstance();
    }

    public function testCancelarPedido() {
        $pedido = array(
            'Pedido' => array(
                'user_id' => '1',
                'modified' => '2020-05-01 02:23:53',
                'created' => '2020-05-01 02:23:53',
                'id' => '1'
            )
        );
        $pedidoCancelado = $this->Pedido->cancelarPedido($pedido);
        
        $this->assertNotEmpty($pedidoCancelado);
    }
}