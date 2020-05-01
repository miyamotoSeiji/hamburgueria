<?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }
    echo $this->Html->div('py-5 bg-light',
        $this->Html->div('container',
            $this->Html->div('col-md-6 offset-md-3',
                $this->Flash->render('auth') . 
                $this->Form->create('User') .
                $this->Html->tag('fieldset',
                    $this->Html->tag('legend', 'Informe seu E-mail e Senha', array('class' => 'text-center')) .
                    $this->Form->input('email', array('label' => 'E-mail', 'class' => 'form-control')) .
                    $this->Form->input('password', array('label' => 'Senha', 'class' => 'form-control')) 
                ) . 
                $this->Html->tag('span',
                    $this->Form->button('Entrar', array('type' => 'submit', 'class' => 'btn btn-outline-success btn-lg')) . $this->Html->link('Voltar', '/produtos/', array('class' => 'btn btn-outline-primary btn-lg', 'style' => array('margin-left:5px;')))
                , array('style' => 'margin-left:8px;'))
            )
        )
    ) .
    $this->element('footer');
?>
