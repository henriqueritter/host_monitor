# Host Monitor

<img alt="Debian" src="https://img.shields.io/badge/Debian-D70A53?style=for-the-badge&logo=debian&logoColor=white" /> <img alt="Apache" src="https://img.shields.io/badge/apache-%23D42029.svg?&style=for-the-badge&logo=apache&logoColor=white"/> <img alt="MySQL" src="https://img.shields.io/badge/mysql-%2300f.svg?&style=for-the-badge&logo=mysql&logoColor=white"/> <img alt="Python" src="https://img.shields.io/badge/python-%2314354C.svg?&style=for-the-badge&logo=python&logoColor=white"/> <img alt="PHP" src="https://img.shields.io/badge/php-%23777BB4.svg?&style=for-the-badge&logo=php&logoColor=white"/>

### Ambiente
Debian 9.9 x64 || Mint 16 x64
Apache 2.4
MySQL 14.14
Python 2.7.9
PHP 7.0


### Descrição 
Host Monitor é uma aplicação para checar a disponibilidade de alguns hosts, através do recurso 'ping' do Sistema operacional consulta e armazena os dados de status dos hosts, exibe em tempo real em um painel e envia um e-mail de alerta caso algum ativo não responda a solicitação.

### Módulos
* Python: Responsável por efetuar o ping nos hosts cadastrados e armazenar o status de rede no banco de dados MySQL, também é responsável por encaminhar um e-mail ao virar o dia contendo o arquivo de Log que foi gerado com os hosts que estiveram offline durante o dia.

* PHP: A Página monitor.php tem por finalidade exibir os hosts e seus status e a página cadastrar.php é exibe o painel junto ao formulário para cadastrar ou excluir os hosts do banco de dados.

* MySQL: Contém apenas duas tabelas, na tabela hosts_status são armazenados os dados dos hosts, status e nomes e na tabela controle_data é armazenado apenas um registro contendo a data do dia atual que é alterada na função de envio de e-mail para que o envio seja diário.

### Telas da Aplicação

![Image of Cadastro](https://github.com/henriqueritter/host_monitor/blob/master/print_tela_cadastro.png)

![Image of Monitor](https://github.com/henriqueritter/host_monitor/blob/master/print_tela_monitor.png)
