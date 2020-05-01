<?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }
    
    $listaProdutos = null;
    $meuPedido= null;
    if (!empty($pedido) && !empty($userLogado) && $userLogado['User']['user_type'] != 'admin') {
        $meuPedido = $this->Html->div('row',
            $this->Html->div('col-md-6',
                $this->Html->tag('p',
                    $this->Html->link('Meu Pedido', '/pedidos/edit/' . $pedido['Pedido']['id'], array('class' => 'btn btn-outline-success btn-lg'))                    
                , array('class' => 'text-left'))
            ).
            $this->Html->div('col-md-6',
                $this->Html->tag('p',
                    $this->Html->link('Pedidos Anteriores', '/pedidos/', array('class' => 'btn btn-outline-secondary btn-lg'))
                , array('class' => 'text-right'))
            )
        );
    }
    
    if (empty($pedido)&& !empty($userLogado) && $userLogado['User']['user_type'] != 'admin') {
        $meuPedido = $this->Html->div('col-md-12',
            $this->Html->tag('p',
                $this->Html->link('Pedidos Anteriores', '/pedidos/', array('class' => 'btn btn-outline-secondary btn-lg'))
            , array('class' => 'text-right'))
        );
    }
    
    if (!empty($produtos)) {
        foreach ($produtos as $produto) {
            $botaoAlterar = null;
            $botaoPedir = $this->Html->link('Adicionar ao pedido', '/pedido_produtos/add/' . $produto['Produto']['id'], array('class' => 'btn btn-outline-primary btn-sm'));
            if (!empty($userLogado) && ($userLogado['User']['user_type'] == 'admin')) {
                $botaoAlterar = $this->Html->link('Alterar', '/produtos/edit/' . $produto['Produto']['id'], array('class' => 'btn btn-outline-primary btn-sm'));
                if (!empty($pedido)) {
                    $botaoPedir = $this->Html->link('Adicionar ao pedido', '/pedido_produtos/add/' . $produto['Produto']['id'], array('class' => 'btn btn-outline-primary btn-sm'));
                } else {
                    $botaoPedir = null;
                }
            } 
            $listaProdutos .= $this->Html->div('col-md-4', 
                $this->Html->div('card shadow-sm',
                    $this->Html->tag('title', $produto['Produto']['nome']) .
                    $this->Html->image('../app/webroot/img/produtos/1/' . $produto['Produto']['foto'], array('alt' => $produto['Produto']['nome'] , 'style' => 'margin-bottom:10px;', 'width'=>'100%', 'height'=>'250px')) .
                    $this->Html->div('card-body',
                        $this->Html->tag('h6', $produto['Produto']['nome'] . ' R$: ' . str_replace('.', ',', $produto['Produto']['valor'])) .
                        $this->Html->tag('p', $produto['Produto']['info']) .
                        $this->Html->div('d-flex justify-content-between align-items-center',
                            $this->Html->div('btn-group',
                                $botaoAlterar .
                                $botaoPedir
                            )
                        )
                    )
                )
            , array('style' => 'margin-bottom:20px;'));
        }
    } 
    
    if (empty($produtos) && !empty($userLogado) && $userLogado['User']['user_type'] == 'admin') {
        $listaProdutos = $this->Html->div('col-md-10 offset-md-1',
            $this->Html->div('card',
                $this->Html->div('card-body text-center',
                    $this->Html->tag('i', '', array('class' => 'fas fa-hotdog')) . " Olá! Não encontramos nenhum produto! Caso queira cadastrar um, clique no botão abaixo! " . $this->Html->tag('i', '', array('class' => 'fas fa-hotdog')) .
                    $this->Html->link('Cadastrar novo produto', '/produtos/add', array('class' => 'btn btn-large btn-outline-primary', 'style' => 'margin-top:10px'))
                )
            , array('style' => 'height: 7rem;'))
        );
    }
    
    $textoCadastrar = $this->Html->tag('h1', 'FAÇA SEU PEDIDO') . $this->Html->tag('p', 'Adicione nossos lanches ao seu pedido clicando no botão "Adicionar ao pedido", caso ainda não esteja cadastrado clique no botão abaixo');
    $botaoCadastrar = $this->Html->link('Cadastrar', '/cadastrar', array('class' => 'btn btn-outline-primary btn-large'));
    $cadastrarProduto = null;
    if (!empty($userLogado)) {
        if ($userLogado['User']['user_type'] != 'admin') {
            $textoCadastrar = $this->Html->tag('h1', 'FAÇA SEU PEDIDO') . $this->Html->tag('p', 'Adicione nossos lanches ao seu pedido clicando no botão "Adicionar ao seu pedido"');
            $botaoCadastrar = null;
        } else {
            $textoCadastrar = $this->Html->tag('h1', 'GERENCIE SEUS PRODUTOS') . $this->Html->tag('p', 'Adicione produtos clicando no botão abaixo');
            $botaoCadastrar = $this->Html->link('Cadastrar novo produto', '/produtos/add', array('class' => 'btn btn-outline-primary btn-large')) . 
                $this->Html->tag('p', 'Ou gerencie os pedidos realizados clicando no botão abaixo') . 
                $this->Html->link('Pedidos', '/pedidos/', array('class' => 'btn btn-outline-primary btn-large'));
        }
    }
    $apresentacao = $this->Html->tag('section',
        $this->Html->div('container', 
            $textoCadastrar .
            $this->Html->tag('p', 
                $botaoCadastrar
            )
        )
    , array('class' => 'jumbotron text-center'));
    
    echo $apresentacao .
        $this->Html->div('py-5 bg-light',
            $this->Html->div('container',
                $meuPedido .
                $this->Html->div('row',
                    $cadastrarProduto .
                    $listaProdutos .
                    $this->Html->div('col-md-12',
                        $this->Paginator->numbers()
                    )  
                )
            )
        ) .
        $this->element('footer');

?>
