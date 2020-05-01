<?php
App::uses('AppModel', 'Model');

class Produto extends AppModel {

    public $validate = array(
        'nome' => array(
            'required' => array('rule' => 'notBlank', 'message' => 'Informe o seu nome'),
            'minLengh' => array('rule' => array('minLength', 3),'message' => 'O nome deve ter pelo menos 3 digitos')
        ),
        'foto' => array(
            'required' => array('rule' => 'notBlank', 'message' => 'Carregue uma imagem'),
            'image' => array('rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg')), 'message' => 'Carregue uma imagem válida')
        ),
        'valor' => array(
            'required' => array('rule' => 'notBlank', 'message' => 'Informe o valor do seu produto'), 
            'price' => array('rule' => array('decimal', 2), 'message' => 'Informe um valor válido.')
        )
    );
}