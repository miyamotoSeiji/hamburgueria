<?php
class ProdutoFixture extends CakeTestFixture {
    
    public $name = 'Produto';
    public $import = array('model' => 'Produto', 'records' => false);

    public function init() {
        $this->records = array(
            array(
                'id' => 1,
                'nome' => 'X-Tudo',
                'valor' => '25.00',
                'foto' => 'foto.jpg',
                'info' => 'Tem tudo',
                'created' => date('Y-m-d h:i:s'),
                'modified' => date('Y-m-d h:i:s'),
                'deleted' => null,
            ),
        );
        parent::init();
    }
}
?>