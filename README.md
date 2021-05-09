<h1 align="center">
Host Monitor
</h1>

<p align="center">
<img alt="Debian" src="https://img.shields.io/badge/Debian-D70A53?style=for-the-badge&logo=debian&logoColor=white" /> <img alt="Apache" src="https://img.shields.io/badge/apache-%23D42029.svg?&style=for-the-badge&logo=apache&logoColor=white"/> <img alt="MySQL" src="https://img.shields.io/badge/mysql-%2300f.svg?&style=for-the-badge&logo=mysql&logoColor=white"/> <img alt="Python" src="https://img.shields.io/badge/python-%2314354C.svg?&style=for-the-badge&logo=python&logoColor=white"/> <img alt="PHP" src="https://img.shields.io/badge/php-%23777BB4.svg?&style=for-the-badge&logo=php&logoColor=white"/>
</p>

### Índice
- [Ambiente](#ambiente)
- [Descrição](#descrição)
- [Módulos](#módulos)
- [Telas da Aplicação](#telas-da-aplicação)
- [Instalação](#instalação)
- [Licença](#licença)

___________________

### Ambiente
Debian 9.9 x64 || Mint 16 x64
Apache 2.4
MySQL 14.14
Python 2.7.9
PHP 7.0
________________
### Descrição 
O Host Monitor foi desenvolvido para auxiliar o departamento de T.I, é uma aplicação utilizada para checar a disponibilidade de alguns hosts, utilizando o recurso 'ping' do Sistema operacional a aplicação consulta e armazena os dados de status dos hosts, exibe em tempo real em um painel e envia um e-mail contendo os hosts e o período em que estiveram offline.
________________
### Módulos
* Python: Responsável por efetuar o ping nos hosts cadastrados e armazenar o status de rede no banco de dados MySQL, também é responsável por enviar um e-mail diário contendo o arquivo de Log que foi gerado com os hosts que estiveram offline durante o dia.

* PHP: A Página monitor.php tem por finalidade exibir os hosts e seus status e a página cadastrar.php é exibe o painel junto ao formulário para cadastrar ou excluir os hosts do banco de dados.

* MySQL: Contém apenas duas tabelas, na tabela hosts_status são armazenados os dados dos hosts, status e nomes e na tabela controle_data é armazenado apenas um registro contendo a data do dia atual que é alterada na função de envio de e-mail para que o envio seja diário.
________________
### Telas da Aplicação

![Tela de Cadastro](https://github.com/henriqueritter/host_monitor/blob/master/print_tela_cadastro.png)

![Painel dos hosts](https://github.com/henriqueritter/host_monitor/blob/master/print_tela_monitor.png)
________________
### Instalação

* **Autor:** 	Henrique C. Ritter
* **Versão S.O:** Debian 9.9.0 
* **Data:** 	27/06/2019

```
#Logar como root
su -

#Atualizar pacotes
apt-get update

#Instalar dependências
apt-get install mysql-server apache2 php7.0 php7.0-mysql python-mysql.connector -y

# Baixar o projeto do Github
cd /opt/
wget https://github.com/henriqueritter/host_monitor/archive/master.zip

#Extrair o projeto
unzip master.zip

# Executar o script SQL no MySQL para criar o usuário 'ping' e o banco 'ping' com as tabelas necessárias
mysql -u root -p < /opt/host_monitor-master/mysql/ping.sql

# Criar pasta monitor dentro do /var/www/html 
mkdir /var/www/html/monitor					#Alterar a permissao CHMOD(CHOWN) usuario WWW-DATA
chmod 777 /var/www/html/monitor/

# Copiar os arquivos PHP para a pasta monitor
cp -r /opt/host_monitor-master/php7/* /var/www/html/monitor
service apache2 restart

# Criar e dar permissão no arquivo de LOG.
> /var/log/hosts_status.log
chmod 777 /var/log/hosts_status.log

# Criar a pasta onde será colocado os arquivos do Python e dar permissão
mkdir /etc/host_monitor/
chmod 777 /etc/host_monitor/

# Copiar os arquivos e dar permissão de executar no arquivo main.py
cp /opt/host_monitor-master/python/* /etc/host_monitor/
chmod +x /etc/host_monitor/main.py

#---------------------------------------------------------------------------------------
# Após copiar os arquivos e pastas executar ose seguintes passos:

# Alterar as configurações de envio de email do arquivo /etc/host_monitor/main.py na linha 'enviar_email()'
# Sendo: enviar_email('email_origem@dominio.com',['email_destinatario@dominio.com','outro_destinatario@dominio.com], 'Status Links', 'Status Links', ['/var/log/hosts_status.log'], 'mail.smtp.do.server.a.ser.usado.para.envio.com.br')
pico /etc/host_monitor/main.py

# Alterar o arquivo: /etc/host_monitor/sendMain.py na linha 'smtp.login()'
# Preenchendo como:  smtp.login('usuarioServerEmail','senhaUsuarioEmail')
pico /etc/host_monitor/sendMail.py

# Agendar no crontab para a cada 5 minutos executar a aplicação Python
crontab -e
# Adicionar a linha:
*/2 * * * * /etc/host_monitor/main.py

# Testar acessando via Browser o endereço: localhost/monitor 
# Gravar algum host e esperar a execução do arquivo /etc/host_monitor/main.py 
# Ou executar manualmente via linha de comando digitando /etc/host_monitor/main.py

#----------------------------------------------------------
# OPCIONAL: Entrar no Mysql e alterar senha padrão do MYSQL e alterar nos arquivos necessários
mysql
MYSQL[(none)]>use mysql;
MYSQL[mysql]>set password for 'ping'@'localhost' = PASSWORD('novasenha');
MYSQL[mysql]>flush privileges;
MYSQL[mysql]>exit

#--------------
# Acessar os arquivos do PHP
pico /var/www/html/monitor/index.php
#Alterar o valor da variavel $pass para a senha que você definiu anteriormente no MySQL
pico /var/www/html/monitor/monitor.php
#Alterar o valor da variavel $pass para a senha que você definiu anteriormente no MySQL
#--------------
# Alterar a senha do MySQL no arquivo de conexão do Python
pico /etc/host_monitor/cnxMySql.py
#altere o valor da variavel bd_passwd e coloque a senha que você definiu anteriormente.
```
________________
### Licença
MIT


