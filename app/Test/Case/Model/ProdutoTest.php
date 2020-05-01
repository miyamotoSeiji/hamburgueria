<?php
App::uses('AppModelTestCase', 'Test'); 

class ProdutoTest extends AppModelTestCase {
    
    public $fixtures = array(
        'app.produto',
    );    
    
    public $modelName = 'Produto';
    
    public function testInstance() {
        $this->assertTrueInstance();
    }

    public function testInvalidNome() {
        $this->assertEqualsInvalidField('nome', null);
        $this->assertEqualsInvalidField('nome', 'Br');
    }

    public function testInvalidIdade() {
        $this->assertEqualsInvalidField('valor', null);
        $this->assertEqualsInvalidField('valor', 'abc');
    }
}