<?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }
    echo $this->Html->div('py-5 bg-light', 
        $this->Html->div('container',
            $this->Html->div('col-md-8 offset-md-2',
                $this->Html->tag('fieldset',
                    $this->Html->tag('legend', 'Alterar dados do produto', array('class' => 'text-center')) .
                    $this->Form->create('Produto', array(
                        'default' => true,
                        'type' => 'file',
                        'inputDefaults' => array(
                            'div' => array('class' => 'form-group'),
                            'label' => false,
                            'legend' => false, 
                            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger'))
                        )
                    )). 
                    $this->Html->div('col', $this->Form->input('foto', array('label' => 'Foto recente', 'class' => 'form-control', 'type' => 'file', 'style' => 'height:44px;'))) .
                    $this->Form->create('Produto') .
                    $this->Html->div('row',
                        $this->Html->div('col', $this->Form->input('nome', array('label' => 'Nome', 'class' => 'form-control'))) .
                        $this->Html->div('col', $this->Form->input('valor', array('label' => 'Valor', 'class' => 'form-control')))
                    ) .
                    $this->Html->div('row',
                        $this->Html->div('col', $this->Form->input('info', array('label' => 'Informações extras', 'class' => 'form-control', 'type' => 'textarea', 'rows' => 5))) 
                    )
                ) . 
                $this->Html->tag('span',
                    $this->Form->button('ALterar', array('type' => 'submit', 'class' => 'btn btn-outline-success btn-lg')) . $this->Html->link('Excluir', '/produtos/delete/' . $this->request->data['Produto']['id'], array('class' => 'btn btn-outline-danger btn-lg', 'style' => array('margin-left:5px;'))) . $this->Html->link('Voltar', '/produtos/', array('class' => 'btn btn-outline-primary btn-lg', 'style' => array('margin-left:5px;')))
                , array('style' => 'margin-left:15px;')) .
                $this->Form->end()
            )
        )
    ) .
    $this->element('footer');
    
?>
