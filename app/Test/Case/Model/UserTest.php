<?php
App::uses('AppModelTestCase', 'Test'); 

class UserTest extends AppModelTestCase {
    
    public $fixtures = array(
        'app.user',
    );    
    
    public $modelName = 'User';
    
    public function testInstance() {
        $this->assertTrueInstance();
    }

    public function testInvalidNome() {
        $this->assertEqualsInvalidField('nome', null);
        $this->assertEqualsInvalidField('nome', 'Br');
    }

    public function testInvalidTelefone() {
        $this->assertEqualsInvalidField('telefone', null);
    }
    
    public function testInvalidEndereco() {
        $this->assertEqualsInvalidField('endereco', null);
    }
    
    public function testInvalidNumero() {
        $this->assertEqualsInvalidField('numero', null);
    }
    
    public function testInvalidBairro() {
        $this->assertEqualsInvalidField('bairro', null);
    }
    
    public function testInvalidCep() {
        $this->assertEqualsInvalidField('cep', null);
        $this->assertEqualsInvalidField('cep', 'asvbasd');
    }
    
    public function testInvalidEmail() {
        $this->assertEqualsInvalidField('email', null);
        $this->assertEqualsInvalidField('email', 'abcdsdsdsdsdsdsd');
        $this->assertEqualsInvalidField('email', 'teste@teste.com.br');
    }

    public function testInvalidSenha() {
        $this->assertEqualsInvalidField('password', null);
        $this->assertEqualsInvalidField('password', '12');
    }
}