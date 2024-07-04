O sistema, baseado em CRUD, é fundamentado em 3 relações:

- Acervo de Material (Records)
- Tombo dos Exemplares (Instances)
- Empréstimos Registrados

O acervo pode ser utilizado para consulta online, além de servir como sistema interno de empréstimos na biblioteca, com base no tombo/localização do exemplar.

					Cadastramento
O sistema permite, aos administradores logados nesse sistema via Senha Única, o cadastramento e manuseio de materiais para o acervo da biblioteca. Para cadastrar, os administradores preenchem um formulário com as principais informações do material, uma vez criados os materiais ficam listados na página principal. Nesta, há um campo de busca por título, autor e tombo; cada material permite ações como edição, visualização detalhada e o registro de tombo.
=======================================================================================================

		Cadastramento de automático de vários exemplares que estejam em um CSV
Esta ação cadastra automaticamente no sistema vários exemplares de livros com um comando realizado no terminal (dezenas de milhares de exemplares, até onde foi testado):

>para importação de materiais que estejam em um arquivo CSV, é necessário que os exemplares contenham os campos "autores","titulo" e "tipo" e estejam todos preenchidos obrigatoriamente.
ATENÇÃO: é de extrema importância verificar se o nome dos campos do CSV estão idênticos ao nome dos campos da Base de Dados;

>no arquivo "ImportCsv.php", localizado pasta app/Console/Commands, é necessário mudar somente o diretório onde o arquivo CSV se encontra

>caso teu arquivo haja mais campos do que os que hajam na function handle(), será necessário cadastrar manualmente, seguindo como exemplo o código.

>após verificada a primeira etapa e realizada a segunda, abra o terminal, no diretório que se encontra o projeto Minibib, dê o comando 'php artisan import-csv', e espere até que a importação seja realizada.
=======================================================================================================

					Instances
Os exemplares (instances) registram a localização física na biblioteca e tombo do material (record), os respectivos exemplares de cada material ficam listados na página principal. Dessa forma, a página principal serve como consulta online para o público, e controle interno para os funcionários, mostrando a disponibilidade do exemplar, permitindo sua edição e empréstimo. 
=======================================================================================================

					Empréstimos
O empréstimo associa o exemplar (tombo) ao aluno pelo seu código de identificação, no caso o número USP, registrando a data do empréstimo. No sistema, as relações são feitas pelas chaves estrangeiras das tabelas no banco de dados, o empréstimo cria uma relação entre aluno e o tombo, que por sua vez é relacionado ao material, assim cada modalidade mantém sua independência dentro do banco de dados. 

Os empréstimos ativos são listados em uma página secundária, com informações básicas como título do material, nome do aluno e botão para devolução. Os dias são contabilizados com base na data de empréstimo, a data de devolução é preenchida ao confirmar a devolução do material pelo funcionário responsável. Dessa forma, no banco de dados ficam registrados as datas de empréstimo/devolução, o ID do exemplar, ID do funcionário e o número USP do aluno. 

