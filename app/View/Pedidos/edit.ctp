 <?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }
    $selectStatus = null;
    if ($userLogado['User']['user_type'] == 'admin') {
        $selectStatus = $this->Html->div('row',
            $this->Html->div('col', 
                $this->Form->input('Pedido.status_id', array('label' => 'Alterar Status', 'class' => 'form-control', 'type' => 'select', 'options' => array(4 => 'Pedido Recebido', 5 => 'Preparando o Pedido', 6 => 'Saiu Para Entrega', 7 => 'Entregue', 8 => 'Cancelado')))
            )
        );
    }
    echo $this->Html->div('py-5 bg-light', 
        $this->Html->div('container',
            $this->Html->tag('fieldset',
                $this->Html->tag('legend', 'Dados do seu pedido!', array('class' => 'text-center')) .
                $this->Html->div('col-md-12 jumbotron text-center mb-3', 
                    $this->Html->tag('h5', 'Pedido sendo realizado em nome de: ' . $this->request->data['User']['nome']) .
                    $this->Html->tag('h5', 'A Entrega será feita no endereço: ' . $this->request->data['User']['endereco'] . ' n°: ' . $this->request->data['User']['numero'] . ' Bairro: ' . $this->request->data['User']['bairro'] . ' CEP: ' . $this->request->data['User']['cep']) .
                    $this->Html->tag('h5', 'Telefone para contato: ' . $this->request->data['User']['telefone']) .
                    $this->Form->create('Pedido') .
                    $this->Html->div('row',
                        $this->Html->div('col', $this->Form->input('info', array('label' => 'Gostaria de acrescentar alguma informação ao pedido?', 'class' => 'form-control', 'type' => 'textarea', 'rows' => 5)))
                    ) .
                    $this->Form->input('status_id', array('type' => 'hidden')) .
                    $selectStatus .
                    $this->element('PedidoProdutos/tabela', $this->request->data) 
                )
            ) . 
            $this->Html->tag('span',
                $this->Form->button('Enviar Pedido', array('type' => 'submit', 'class' => 'btn btn-outline-success btn-lg')) . $this->Html->link('Voltar', '/produtos/', array('class' => 'btn btn-outline-primary btn-lg', 'style' => array('margin-left:5px;')))
            )
        )
    ) .
    $this->element('footer');
?>
