<?php
class PedidoFixture extends CakeTestFixture {
    
    public $name = 'Pedido';
    public $import = array('model' => 'Pedido', 'records' => false);

    public function init() {
        $this->records = array(
            array(
                'id' => 1,
                'user_id' => 1,
                'status_id' => 1,
                'info' => 'Sem informações',
                'created' => date('Y-m-d h:i:s'),
                'modified' => date('Y-m-d h:i:s'),
                'deleted' => null,
            ),
        );
        parent::init();
    }
}
?>