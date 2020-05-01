<?php
App::uses('AppModel', 'Model');

class User extends AppModel {
       
    public $hasMany = array(
        'Pedido' => array('conditions' => array('Pedido.deleted IS NULL')),
    );
    
    public $validate = array(
        'nome' => array(
            'required' => array('rule' => 'notBlank', 'message' => 'Informe o seu nome'), 
            'minLengh' => array('rule' => array('minLength', 3), 'message' => 'O nome deve ter pelo menos 3 digitos')
        ),
        'email' => array(    
            'email' => array('rule' => 'email','message' => 'E-mail inválido.'), 
            'isUnique' => array('rule' => array('isUnique', array('email', 'deleted'), false), 'message' => 'E-mail já cadastrado.', 'on' => 'create'),
            'required' => array('rule' => 'notBlank', 'message' => 'Informe o seu E-mail para contato')
        ),
        'telefone' => array(
            'required' => array( 'rule' => 'notBlank', 'message' => 'Informe o seu Telefone para contato')
        ),
        'endereco' => array(
            'required' => array('rule' => 'notBlank', 'message' => 'Informe o seu endereço')
        ),
        'numero' => array(
            'required' => array('rule' => 'notBlank', 'message' => 'Informe o número da sua casa')
        ),
        'bairro' => array(
            'required' => array('rule' => 'notBlank', 'message' => 'Informe o seu Bairro')
        ),
        'cep' => array(
            'required' => array('rule' => 'notBlank', 'message' => 'Informe o seu CEP'),
            'numeric' => array('rule' => 'numeric', 'message' => 'O campo deve conter apenas números')
        ),
        'password' => array(
            'required' => array('rule' => 'notBlank', 'message' => 'Informe uma senha'),
            'minLengh' => array('rule' => array('minLength', 4), 'message' => 'A senha deve ter pelo menos 4 digitos')
        ),
        
    );

    public function beforeSave($options = array()) {
        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = md5($this->data['User']['password']);
        }
        
        return true;
    }
}