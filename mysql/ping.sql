/* Cria banco PING */
CREATE DATABASE ping;
USE ping;
/* Cria tabela hosts_status para armazenar os status dos hosts */
CREATE TABLE hosts_status (HOST VARCHAR(20) PRIMARY KEY, STATUS VARCHAR(4), HOST_NAME VARCHAR(25));

/* Cria tabela de controle de data para enviar o email diariamente */
CREATE TABLE controle_data (ID INT(2) PRIMARY KEY, DATA VARCHAR(4));
INSERT INTO controle_data VALUES(1,'0000');

/* Cria usuario PING e concede privilegios */
CREATE USER 'ping'@'localhost' IDENTIFIED BY 'senha';

GRANT ALL PRIVILEGES ON ping.* TO 'ping'@'localhost';

FLUSH PRIVILEGES;

COMMIT;                                                               
