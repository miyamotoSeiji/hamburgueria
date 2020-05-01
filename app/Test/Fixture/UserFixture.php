<?php
class UserFixture extends CakeTestFixture {
    
    public $name = 'User';
    public $import = array('model' => 'User', 'records' => false);

    public function init() {
        $this->records = array(
            array(
                'id' => 1,
                'nome' => 'Usuário',
                'telefone' => '(14) 99633-0891',
                'endereco' => 'Rua',
                'numero' => 10,
                'bairro' => 'Bairro',
                'cep' => '17519560',
                'email' => 'teste@teste.com.br',
                'password' => md5('1234'),
                'user_type' => 'admin',
                'created' => date('Y-m-d h:i:s'),
                'modified' => date('Y-m-d h:i:s'),
                'deleted' => null,
            ),
        );
        parent::init();
    }
}
?>