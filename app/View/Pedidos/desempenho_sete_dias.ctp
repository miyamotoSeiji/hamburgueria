<?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }
    
    $apresentacao = $this->Html->tag('section',
        $this->Html->div('container', 
            $this->Html->tag('h1', 'Aqui estão as suas vendas dos últimos 7 dias') .
            $this->Html->tag('p', 'O período abrange as datas entre ' . $vendidos['periodoInicio'] . ' e ' . $vendidos['periodoFinal'])
        )
    , array('class' => 'jumbotron text-center')); 
    
    $desempenho = $this->Html->div('col-md-12 text-center',
        $this->Html->tag('h2', 'Nenhuma venda de produto foi encontrada nesse período :(')
    );
    
    if (!empty($vendidos['Produtos'])) {    
        $total = 0;
        $listaProdutos = null;
        foreach ($vendidos['Produtos'] as $produto) {
            $listaProdutos .= $this->Html->tag('tr', 
                $this->Html->tag('td', $produto['nome'], array('class' => 'text-center')) . 
                $this->Html->tag('td', $produto['quantidade']) .
                $this->Html->tag('td', 'R$ ' . number_format($produto['total'], 2, ',', ''))
            );
            $total += $produto['total'];
        }
        $desempenho = $this->Html->div('col-md-12 ',
            $this->Html->tag('table',
                $this->Html->tag('thead',
                    $this->Html->tag('tr',
                        $this->Html->tag('th', 'Nome') . 
                        $this->Html->tag('th', 'Quantidade Vendida') .
                        $this->Html->tag('th', 'Total') 
                    )
                ) .
                $this->Html->tag('tbody',
                    $listaProdutos .
                    $this->Html->tag('tr', 
                        $this->Html->tag('td', '') . 
                        $this->Html->tag('td', 'Valor Total', array('class' => 'text-right')) .
                        $this->Html->tag('td', 'R$ ' . number_format($total, 2, ',', ''))
                    )        
                )
            , array('class' => 'table table-striped mt-3'))
        );
    }    
       
    echo $apresentacao . $this->Html->div('py-5 bg-light',
        $this->Html->div('container',
            $this->Html->div('row',
                $desempenho .
                $this->Html->link('Voltar', '/pedidos/', array('class' => 'btn btn-outline-primary btn-lg ml-3'))
            )  
        )
    );
    echo $this->element('footer');
?>