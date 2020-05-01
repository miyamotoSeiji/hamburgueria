<?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }
    echo $this->Html->div('py-5 bg-light',
        $this->Html->div('container',
            $this->Html->div('col-md-6 offset-md-3',
                $this->Form->create('User') .
                $this->Html->tag('fieldset',
                    $this->Html->tag('legend', 'Trocar Senha', array('class' => 'text-center')) .
                    $this->Form->input('password', array('label' => 'Informe uma nova senha', 'class' => 'form-control')) 
                ) . 
                $this->Html->tag('span',
                    $this->Form->button('Trocar senha', array('type' => 'submit', 'class' => 'btn btn-outline-success btn-lg')) . $this->Html->link('Voltar', '/produtos/', array('class' => 'btn btn-outline-primary btn-lg', 'style' => array('margin-left:5px;')))
                , array('style' => 'margin-left:8px;'))
            )
        )
    ) .
    $this->element('footer');
?>