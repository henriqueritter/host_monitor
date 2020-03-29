# Host_Monitor

S.O Debian 9.9.0 x64 || Mint 16  x64
Apache 2.4.10
MySQL 14.14
Python 2.7.9
PHP 7.0

### Descrição 
É uma aplicação que através recurso 'ping' do Sistema operacional monitora e armazena dados de status dos hosts.

### Módulos
* Python: Responsável por efetuar o ping nos hosts cadastrados e armazenar o status no banco de dados MySQL, também é responsável por encaminhar um e-mail no dia seguinte contendo o arquivo de Log que foi gerado com os hosts que estiveram offline no dia anterior.

* PHP: A Página monitor.php é responsável por exibir os hosts e seus status e a página cadastrar.php é responsável por cadastrar ou excluir os hosts do banco de dados.

* MySQL: Contém apenas duas tabelas, na tabela hosts_status são armazenados os dados dos hosts, status e nomes e na tabela controle_data é armazenado apenas um registro contendo a data do dia atual que é alterada na função de envio de e-mail para que o envio seja diário.

### Prints da tela

![Image of Cadastro](https://github.com/henriqueritter/host_monitor/blob/master/print_tela_cadastro.png)

![Image of Monitor](https://github.com/henriqueritter/host_monitor/blob/master/print_tela_monitor.png)
