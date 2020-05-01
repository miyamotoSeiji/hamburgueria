 <?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }
    $this->request->data['View'] = true;
    echo $this->Html->div('py-5 bg-light', 
        $this->Html->div('container',
            $this->Html->tag('fieldset',
                $this->Html->tag('legend', 'Dados do seu pedido!', array('class' => 'text-center')) .
                $this->Html->div('col-md-12 jumbotron text-center mb-3', 
                    $this->Html->tag('h5', 'Pedido sendo realizado em nome de: ' . $this->request->data['User']['nome']) .
                    $this->Html->tag('h5', 'A Entrega será feita no endereço: ' . $this->request->data['User']['endereco'] . ' n°: ' . $this->request->data['User']['numero'] . ' Bairro: ' . $this->request->data['User']['bairro'] . ' CEP: ' . $this->request->data['User']['cep']) .
                    $this->Form->create('Pedido') .
                    $this->Html->div('row',
                        $this->Html->div('col', $this->Form->input('info', array('label' => 'Gostaria de acrescentar alguma informação ao pedido?', 'class' => 'form-control', 'type' => 'textarea', 'rows' => 5, 'disabled' => true)))
                    ) .
                    $this->Form->input('status_id', array('type' => 'hidden', 'value' => 2))  .
                    $this->element('PedidoProdutos/tabela', $this->request->data) 
                )
            ) . 
            $this->Html->tag('span',
                $this->Html->link('Voltar', '/pedidos/', array('class' => 'btn btn-outline-primary btn-lg', 'style' => array('margin-left:5px;')))
            )
        )
    ) .
    $this->element('footer');
?>