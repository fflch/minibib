<h1>Sobre o sistema</h1>
O sistema, baseado em CRUD, é fundamentado em 3 relações:

- Acervo de Material (Records)
- Tombo dos Exemplares (Instances)
- Empréstimos Registrados (Um exemplar para um usuário)

O acervo pode ser utilizado para consulta online, além de servir como sistema interno de empréstimos na biblioteca, com base no tombo/localização do exemplar.

<h1>Como usar</h1>
<h2>Primeros passos</h2>

Para pode ter acesso às ações de administrador do sistema na sua máquina, vá ao arquivo .env e, caso não haja uma variável "ADMINS=" acrescente-a e, nela, insira seu número USP.
Para que o sistema reconheça como um Número USP válido, é necessário que você possua o valor das variáveis:<br/><br/>
<b>
REPLICADO_HOST<br />
REPLICADO_PORT<br />
REPLICADO_DATABASE<br />
REPLICADO_USERNAME<br />
REPLICADO_PASSWORD<br />
REPLICADO_CODUNDCLG<br />
REPLICADO_SYBASE<br />
SENHAUNICA_KEY<br />
SENHAUNICA_SECRET<br />
SENHAUNICA_CALLBACK_ID<br />
</b>
no seu arquivo .env.
<br />
<h3>ADMIN</h3>
Para ter, enfim, as ações e permissões do administrador do sistema, logue-se.
<h1>Cadastramento de exemplares</h1>
O sistema permite, aos administradores logados nesse sistema via Senha Única, o cadastramento e manuseio de materiais para o acervo da biblioteca. Para cadastrar um exemplar, os administradores preenchem um formulário com as principais informações do material.<br /> Uma vez criados, os materiais ficam listados na página principal. Nela, há um campo de busca por título, autor e tombo. <br/> Cada material permite ações como edição, visualização detalhada do material e o registro de um exemplar com seu tombo e localização.

<h1>Importação de vários exemplares que estejam em um CSV</h1>

Esta ação cadastra automaticamente no sistema vários exemplares de livros com um comando realizado no terminal (dezenas de milhares de exemplares, até onde foi testado):

Para importação de materiais que estejam em um arquivo CSV, é necessário que os exemplares contenham os campos "autores","titulo" e "tipo" e estejam todos preenchidos obrigatoriamente.
>ATENÇÃO: é de extrema importância verificar se o nome dos campos do CSV estão idênticos ao nome dos campos da Base de Dados;

>no arquivo "ImportCsv.php", localizado pasta app/Console/Commands, é necessário mudar somente o diretório onde o arquivo CSV se encontra

>caso teu arquivo haja mais campos do que os que hajam na function handle(), será necessário cadastrar manualmente, seguindo como exemplo o código.

>após verificada a primeira etapa e realizada a segunda, abra o terminal, no diretório que se encontra o projeto Minibib, dê o comando 'php artisan import-csv', e espere até que a importação seja realizada.

<h1>Instances</h1>
Os exemplares (instances) registram a localização física na biblioteca e tombo do material (record), os respectivos exemplares de cada material ficam listados na página principal. Dessa forma, a página principal serve como consulta online para o público, e controle interno para os funcionários como o de permitir sua edição e emprestar o exemplar. 

<h1>Empréstimos</h1>
O empréstimo associa o exemplar (ID do material) ao aluno pelo seu Nº USP.

Os empréstimos ativos são listados em uma página secundária, com informações básicas como título do material, nome do aluno e botão para devolução. Os dias são contabilizados com base na data de empréstimo, a data de devolução é preenchida ao confirmar a devolução do material pelo funcionário responsável. Dessa forma, no banco de dados ficam registrados as datas de empréstimo/devolução, o ID do exemplar, ID do funcionário e o número USP do aluno. 

