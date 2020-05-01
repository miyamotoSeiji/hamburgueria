<?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }
    
    $listaPedidos = null; 
    
    if (!empty($pedidos)) {
        $statusColor = array(1 => 'text-warning', 2 => 'text-success', 3 => 'text-warning', 4 => 'text-success', 5 => 'text-warning', 6 => 'text-success', 7 => 'text-success', 8 => 'text-danger' );
        $statusText = array(1 => 'Escolhendo Produto', 2 => 'Enviado!', 3 => 'Pedido Alterado!', 4 => 'Pedido Recebido!', 5 => "Em Preparação", 6 => 'Saiu Para Entrega!', 7 => 'Entregue!', 8 => 'Cancelado!' );
        foreach ($pedidos as $pedido) {
            $botaoAlterarPedido = null;
            if ($pedido['Pedido']['status_id'] < 5 || (!empty($userLogado) && $userLogado['User']['user_type'] == 'admin')) {
                $botaoAlterarPedido = $this->Html->link('Alterar pedido', '/pedidos/edit/' . $pedido['Pedido']['id'], array('class' => 'btn btn-outline-primary btn-sm'));
            }
            $listaPedidos .= $this->Html->tag('tr', 
                $this->Html->tag('td', $this->Html->link(date("d/m/Y H:i:s", strtotime($pedido['Pedido']['created'])), '/pedidos/view/' . $pedido['Pedido']['id'])) . 
                $this->Html->tag('td', $pedido['User']['nome']) .
                $this->Html->tag('td', $pedido['User']['endereco']) .
                $this->Html->tag('td', $this->Html->tag('h5', $statusText[$pedido['Pedido']['status_id']], array('class' => $statusColor[$pedido['Pedido']['status_id']]))) .
                $this->Html->tag('td', $botaoAlterarPedido) 
            );
        }
        $listaPedidos = $this->Html->div('col-md-12 ',
            $this->Html->tag('table',
                $this->Html->tag('thead',
                    $this->Html->tag('tr',
                        $this->Html->tag('th', 'Data e hora do pedido') . 
                        $this->Html->tag('th', 'Nome') .
                        $this->Html->tag('th', 'Endereço') .
                        $this->Html->tag('th', 'Status') .
                        $this->Html->tag('th', 'Ação') 
                    )
                ) .
                $this->Html->tag('tbody',
                    $listaPedidos 
                )
            , array('class' => 'table table-striped mt-3'))
       );
    } 
    $addProdutoTexto = $this->Html->tag('i', '', array('class' => 'fas fa-hotdog')) . " Olá! Não encontramos nenhum registro de pedido! Caso queira cadastrar um produto novo, clique no botão abaixo! " . $this->Html->tag('i', '', array('class' => 'fas fa-hotdog'));
    $botaoAddProduto = $this->Html->link('Cadastrar produto', '/produtos/add', array('class' => 'btn btn-large btn-outline-primary', 'style' => 'margin-top:10px'));
    $apresentacao = $this->Html->tag('section',
        $this->Html->div('container', 
            $this->Html->tag('h1', 'Gerencie os pedidos') .
            $this->Html->tag('p', 'Aqui estão todos os pedidos enviados para você, para cadastrar novos produtos, clique no botão abaixo') .
            $this->Html->tag('p', 
                $this->Html->link('Cadastrar novo produto', '/produtos', array('class' => 'btn btn-outline-primary btn-large'))
            )
        )
    , array('class' => 'jumbotron text-center')); 
    if (!empty($userLogado) && $userLogado['User']['user_type'] != 'admin') {
        $addProdutoTexto = $this->Html->tag('p', $this->Html->tag('i', '', array('class' => 'fas fa-hotdog')) . " Olá! Não encontramos nenhum registro de pedido!" . $this->Html->tag('i', '', array('class' => 'fas fa-hotdog')));
        $botaoAddProduto = $this->Html->tag('p', $this->Html->link('Fazer um pedido', '/produtos/', array('class' => 'btn btn-large btn-outline-primary')));
        $apresentacao = $this->Html->tag('section',
            $this->Html->div('container', 
                $this->Html->tag('h1', 'Gerencie seus pedidos') .
                $this->Html->tag('p', 'Todos os seu pedidos estão listados aqui')
            )
        , array('class' => 'jumbotron text-center')); 
    }
    if (empty($pedidos)) {
        $listaPedidos = $this->Html->div('col-md-10 offset-md-1',
            $this->Html->div('card',
                $this->Html->div('card-body text-center',
                    $addProdutoTexto .
                    $botaoAddProduto
                )
            , array('style' => 'height: 7rem;'))
        );
    } 
    
    echo $apresentacao .  
        $this->Html->div('py-5 bg-light',
            $this->Html->div('container',
                $this->Html->div('row',
                    $listaPedidos.
                    $this->Html->div('col-md-12',
                        $this->Paginator->numbers()
                    ) .
                    $this->Html->link('Voltar', '/produtos/', array('class' => 'btn btn-outline-primary btn-lg ml-3'))
                )  
            )
        ) .
        $this->element('footer');
 

?>
