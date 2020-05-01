<?php
    $pedido = $this->request->data['Pedido'];
    $pedidoProdutos = $this->request->data['PedidoProduto'];
    $listaProdutos = null;
    $total = 0;
    $botaoAdicionarProduto = null; 
    
    foreach ($pedidoProdutos as $pedidoProduto) {
        $botaoExcluirProduto = null;
            if ($pedido['status_id'] < 5) {
                $botaoExcluirProduto = $this->Html->link('Excluir', '/pedido_produtos/delete/' . $pedido['id'] . '/' . $pedidoProduto['id'], array('class' => 'btn btn-outline-primary btn-sm'));
                $botaoAdicionarProduto = $this->Html->link('Adicionar produto', '/pedido_produtos/addProduto/' . $pedido['id'], array('class' => 'btn btn-outline-success btn-lg'));
            }
            if (!empty($this->request->data['View']) && $this->request->data['View']) {
                $botaoExcluirProduto = null;
                $botaoAdicionarProduto = null; 
            }
            $total += $pedidoProduto['Produto']['valor'];
            $listaProdutos .= $this->Html->tag('tr', 
                $this->Html->tag('td', $pedidoProduto['Produto']['nome'], array('class' => 'text-center')) . 
                $this->Html->tag('td', $pedidoProduto['Produto']['info']) .
                $this->Html->tag('td', 'R$ ' . number_format($pedidoProduto['Produto']['valor'], 2, ',', '')) .
                $this->Html->tag('td', $botaoExcluirProduto) 
            );
        }
        $listaProdutos = $this->Html->div('col-md-12 ',
            $this->Html->tag('table',
                $this->Html->tag('thead',
                    $this->Html->tag('tr',
                        $this->Html->tag('th', 'Nome') . 
                        $this->Html->tag('th', 'Info') .
                        $this->Html->tag('th', 'Valor') .
                        $this->Html->tag('th', 'Ação')
                    )
                ) .
                $this->Html->tag('tbody',
                    $listaProdutos .
                    $this->Html->tag('tr', 
                        $this->Html->tag('td', '') . 
                        $this->Html->tag('td', 'Valor Total', array('class' => 'text-right')) .
                        $this->Html->tag('td', 'R$ ' . number_format($total, 2, ',', '')) .
                        $this->Html->tag('td', '') 
                    )        
                )
            , array('class' => 'table table-striped mt-3')) .
            $botaoAdicionarProduto
        );
       
       echo $listaProdutos;
?>