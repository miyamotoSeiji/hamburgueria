<?php
    $userLogado = $this->Session->read('userLogado');
    $botaoCadastrar = $this->Html->link('Cadastrar', '/cadastrar', array('class' => 'btn btn-outline-warning', 'style' => array('margin-right:5px;')));
    $botaoEntrar = $this->Html->link('Entrar', '/entrar', array('class' => 'btn btn-outline-warning'));
    $botaoPerfil = null;
    $desempenho = null;
    if (!empty($userLogado)) {
        if ($userLogado['User']['user_type'] == 'admin') {
            $desempenho = $this->Html->link('Vendas dos últimos 7 dias ', '/pedidos/desempenhoSeteDias', array('class' => 'dropdown-item'));
        }
        $botaoCadastrar = null;
        $botaoEntrar = null;
        $botaoPerfil = $this->Html->div('btn-group',
            $this->Html->tag('button', $this->Html->tag('i', '', array('class' => 'fas fa-bacon')) . ' Olá ' . $userLogado['User']['nome'], array('type' => 'button', 'class' => 'btn btn-outline-warning dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-haspopup' => 'true', 'aria-expanded' => 'false')) .
            $this->Html->div('dropdown-menu', 
                $this->Html->link('Alterar meus dados', '/users/edit/' . $userLogado['User']['id'], array('class' => 'dropdown-item')) .
                $this->Html->link('Trocar senha', '/users/trocarSenha/' . $userLogado['User']['id'], array('class' => 'dropdown-item')) .
                $this->Html->div('dropdown-divider', '') .
                $this->Html->link('Pedidos Anteriores', '/pedidos/', array('class' => 'dropdown-item')) .
                $desempenho . 
                $this->Html->div('dropdown-divider', '') .
                $this->Html->link('Sair', '/users/logout', array('class' => 'dropdown-item')) 
            )
        ); 
    }
    
    echo $this->Html->div('navbar navbar-dark bg-dark shadow-sm', 
        $this->Html->div('container d-flex justify-content-between',
            $this->Html->div('col-md-4',  
                $this->Html->tag('a', 
                    $this->Html->tag('strong', $this->Html->tag('i', '', array('class' => 'fas fa-hamburger fa-3x')) . 'Hamburgueria Do Sr. Val'), 
                array('class' => 'navbar-brand d-flex align-items-center', 'href' => '/hamburgueria/inicio'))
            ) .
            $this->Html->div('col-md-8 text-right',
                $botaoCadastrar . 
                $botaoEntrar .
                $botaoPerfil
            )
        )
    );
    echo $this->Flash->render();
?>
