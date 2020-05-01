# Hamburgueria do Sr. Val

Hamburgueria do Sr. Val é um aplicativo web para cadastro e gerenciamento de pedidos de produtos da lanchonete do Sr Valbernielson, onde seus clientes podem se cadastrar para realizar pedidos a serem preparados e entregues.

Todos os produtos do Sr Valbernielson ficam expextos na página principal do aplicativa, equivalente ao cardápio em um restaurante.

Este projeto foi desenvolvido exclusivamente como parte do processo seletivo para uma vaga de desenvolvedor web.

A documentação com as informações da atividade pode ser encontrada na pasta raiz desse repositório como "Desafio - Hamburgueria.pdf".

## Instalação

Para o desenvolvimento desse projeto foi utilizado o pacote de servidores XAMPP na versão v3.2.1 utilizando os modulos MySQL e Apache, juntamente com o framework CakePHP na versão 2.10.19, Bootstrap na versão 4.4.1 e também o conjunto Font Awesome em seu kit gratuito.
Todas as ferramentas utilizadas no projeto são distribuidas de forma livre e grátuita.

Após a instalação do XAMPP é necessário criar o banco de dados relacional, para isso é preciso criar a base de dados "hamburgueria" em localhost, em seguida rodar o script localizado neste repositório em: hamburgueria/app/Config/Schema/00-metadata.sql

Após a configuração do banco de dados é preciso clonar este repositório ( https://github.com/miyamotoSeiji/hamburgueria.git ) na pasta "htdocs" localizada dentro do diretório de instalação do XAMPP.

Para ter acesso ao aplicativo em servidor local, acesse pelo navegador: http://localhost/hamburgueria/

## Manual de utilização

O sistema tem o propósito de atender dois tipos de usuario especificos:

- Os usuários clientes do Sr Valbernielson.
- O próprio Sr Valbernielson com funções de administrador (Nesse manual vamos chama-lo de Sr. Val).

Para cada um dos usuários existem funcionalidades compartilhadas e funcionalidades distintas:

### Sr. Val

O Sr. Val por ser administrador da lanchonete tem acesso ao sistema em modo "administrador".
O seu login no sistema é especifico e pode ser feito utilizando os seguintes dados:

- E-mail: srval@hamburguer.com
- Senha: 1234 (Pode ser alterado no sistema, após o primeiro acesso, caso seja necessário) 

#### Pedidos

Ao acessar o sistema o Sr. Val é direcionado a página onde se encontram todos os pedidos.
Para cada pedido, é possíver verificar seus detalhes ao clicar em cima da data e hora em que o pedido foi aberto;
Como administrador o Sr.Val também pode realizar alterações no pedido, excluindo ou adicionando produtos e alterando o status.

O status pode ser alterado para:

- Pedido Recebido
- Preparando o Pedido
- Saiu Para Entrega
- Entregue
- Cancelado

Em algumas situações o status se altera automaticamente, por exemplo:

Assim que o cliente inicia seu pedido adicionando um produto, o status fica em "Escolhendo Produto", esse status só se alterá após o cliente enviar o pedido, mudando o status para "Enviado", a partir desse ponto, quem pode alterar o status é o Sr. Val.

Caso o cliente altere alguma coisa no pedido com o status "Pedido Recebido", os sistema fara o status se tornar "Pedido Alterado", para que o Sr. Val saiba que algo pode ter sido mudado.

Após o Sr. Val alterar o status para "Preparando o Pedido", já não é mais possível que o cliente realize alterações.
 
#### Produtos

Para realizar vendas é necessário que o Sr. Val tenha produtos em seu cardápio.

Para adicionar produtos basta clicar no botão "Cadastrar novo produto", caso o Sr.Val esteja na tela dos pedidos, ele será redirecionado para a tela de cardápio, que também possui o mesmo botão, porém ao clicar nele, haverá um redirecionamento para o formulário de cadastro do produto

Para cadastrar um novo produto é necessário fornecer:

- Uma foto do produto
- Nome do produto
- Valor do produto
- Informações extras (Campo não obrigatório)

Após fornecer essas informações, basta clicar no botão "Cadastrar" e pronto o produto já deve aparecer no cardápio.

No cardápio, o Sr. val pode realizar alteraçõs nos produtos clicando no botão "Alterar", Na tela de alteração, além de alterar qualque informação do produto, é possível exclui-lo do cardápio, clicando no botão "Excluir";

#### Menu Perfil

No menu superior no cando direito é possivel acessar um menu com algumas opções:

- Alterar meus dados (onde é possivel realizar alterações nos dados do Sr.Val)
- Trocar a senha
- Pedidos anteriores (acessa a todos os pedidos já realizados)
- Vendas dos ultimos 7 dias (desempenho da semana)
- Sair (Realiza o logout do sistema)

### Clientes

Logo que o cliente acessa o sistema ele encontra o cardápio do Sr. Val, para poder realizar algum pedido é preciso que ele se cadastre no sistema e esteja logado.

#### Cadastro Cliente

Para se cadastrar o cliente deve clicar no botão "Cadastrar" localizado no menu superior do sistema e informar os seguites dados:

- Nome
- E-mail
- Telefone
- Endereço
- Número
- Bairro
- CEP
- Senha

Em seguida basta clicar no botão "Cadastrar" ao fim do formulário. o cadastro será salvo e o cliente será redirecionado para a tela de login, que também pode ser acessada pelo botão "Entrar" no menu superior.

#### Fazendo um pedido

Após o cadastro e login o cliente pode abrir um pedido ao escolher algum produto e clicar no botão "Adicionar ao pedido", ele pode adicionar um mesmo produto, quantas vezes quiser e qualquer produto que quiser.

Para gerenciar seu pedido, basta clicar no botão "Meu Pedido" na parte superior do cardápio.

##### Meu Pedido

Em "Meu Pedido" Estarão as informações para entrega, e caso o cliente queira passar mais alguma informação relevante a respeito do pedido, basta que ele informe no campo que está disponivel com o texto "Gostaria de acrescentar alguma informação ao pedido?".

Nesa tela, também ficarão listados todos os produtos contidos nesse pedido, assim como o valor de cada um e o valor total, é possível também excluir um produto ao clicar no botão "Excluir" na linha do produto.
Caso queira adicionar mais produtos, basta clicar no botão "Adicionar produto", que o cliente volta para a página do cardápio e poderá adicionar novamente qualquer produto.

Para concluir o pedido e enviar para o Sr. Val, basta clicar no botão "Enviar Pedido", e aguardar que o Sr. Val Altere o status para "Pedido Recebido".

O Cliente consegue realizar modificações no pedido desde que o status não seja "Preparando o Pedido".

##### Pedidos Anteriores

Após o envio do pedido, o cliente é redirecionado para a tela onde estarão listados todos os pedidos já feitos, inclusive o ultimo realizado, é possível acessar essa tela também pelo menu do perfil do usuário na opção "Pedidos anteriores", ou mesmo pelo cardápio, clicando no botão "Pedidos Anteriores".

Nessa tela é possível verificar o atual status do pedido e caso o status não seja "Preparando o Pedido", ainda é possivel altera-lo clicando em "Alterar Pedido".

E dessa forma concluímos esse manual.

## Issues e Melhorias

Este projeto foi desenvolvido exclusivamanente como processo seletivo para a vaga de desenvolvedor, devido ao prazo estabelecido e falta de experiência, nem todas as funcionalidades estão funcionando 100%

Listarei nessa seção os problemas encontrados e possíveis melhorias que podem ser feitas.

+ Issues
    + Validação no campo foto da entidade Animal, a validação para este campo não está funcionando, permitindo que o Sr. Val realize a inclusão de qualquer tipo de arquivo, além de imagens
+ Melhorias    
    + As mensagens de notificação poderiam desaparecer após alguns segundos, liberando espaço em tela
    + Utilização do dropzone.js no upload de imagens, dessa forma, além de facilitar o carregamento da foto, seria possível ter um preview da imagem
    + Melhorias visuais, tanto nos formulários quanto nas páginas principais, foi utilizado o bootstrap, mas não foi possível aproveitar todo seu potêncial
    + Mais testes unitários, os testes feitos foram realizados em cima das validações nos modelos, aprender a realizar testes unitário na camada de controller.
    + Não utilizei a versão mais recente do CakePHP pois, é com essa versão que eu estava acostuma do a trabalhar, para utilizar as versões mais recentes, devido as alterações gigantescas realizadas, não haveria tempo para reaprender e migrar. Mas fica aqui como possível melhoria.
    + Trabalhei nesse projeto com o conhecimento adquirido em meu útimo emprego, sei que hoje já existem novas teconologias e formas de se programar, porém não tive oportudade de aprende-las por enquanto, mas é um dos meus objetivos.

## Considerações finais

Gostaria de agradecer pela oportunidade de participar desse processo seletivo apesar do curto tempo, foi bem divertido trabalhar nesse projeto, me faz querer melhorar e me esforçar para evoluir e aprender cada vez mais.
Gostaria de ter aplicado coisas que estava começando a aprender em um curso a respeito de composer e migrate, mas por falta de experiência usando essas tecnologias acabei falhando e não conseguindo aplicar.
Independente do resultado desse exame, estou muito contente, programar é uma das minhas paixões, tenho muito o que aprender ainda, e pra ser sincero estou bastante defasado com relação as novas tecnologias, mas só de saber que existem novas formas de se pensar e programar me deixa muito empolgado.

Gostaria muito de poder fazer parte da família DSIN, poder evoluir cada dia mais e ser motivo de orgulho a todos.
Muito obrigado!!!

