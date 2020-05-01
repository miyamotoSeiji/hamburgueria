<?php
    echo $this->Html->tag('footer',
        $this->Html->div('container',
            $this->Html->tag('p',
                $this->Html->tag('a', 'Voltar ao topo', array('href' => '#')),
            array('class' => 'float-right')).
            $this->Html->tag('p', "Este projeto foi criado exclusivamente como parte do processo seletivo para vaga de desenvolvedor!") .
            $this->Html->tag('p', "Por Bruno Seiji Miyamoto")
        ),
    array('class' => 'text-muted'));
?>
