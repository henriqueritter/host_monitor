# host_monitor

S.O Debian 8.11 (Jessie) x64
Apache 2.4.10
MySQL 14.14
Python 2.7.9
PHP 5.6.38

Descrição: É uma aplicação que monitora através da ferramenta 'Ping' do sistema operacional e armaeza estes dados para uma posterior consulta.

Módulos
Python: Responsável por efetuar o ping nos hosts cadastrados e armazenar o status no banco de dados MySQL, também é responsável por encaminhar um e-mail no dia seguinte contendo o arquivo de Log que foi gerado com os hosts que estiveram offline no dia anterior.

PHP: A Página monitor.php é responsável por exibir os hosts e seus status e a página cadastrar.php é responsável por cadastrar ou excluir os hosts do banco de dados.

MySQL: Contém apenas duas tabelas, na tabela hosts_status são armazenados os dados dos hosts, status e nomes e na tabela controle_data é armazenado apenas um registro contendo a data do dia atual que é alterada na função de envio de e-mail para que o envio seja diário.

