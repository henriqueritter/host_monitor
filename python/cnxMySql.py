#!/usr/bin/env python
#coding: utf-8
'''
* ---------------------------------------------------
* Titulo: Host Monitor - Monitor de Hosts
* Modulo: cnxMySql.py  (Conexão com o BD)
* Data: 04/out/2018
* Finalidade: Realizar conexões e consultas ao banco de
* dados MySQL para retornar ou alterar os dados de hosts
* ou controlar o envio de e-mail para que seja diário.
* -----------------------------------------------------
* S.O:  Debian 9
* Versão do Python: 2.7
'''

import sys
import mysql.connector

bd_host="localhost"
bd_user="ping"
bd_passwd="senha"
bd_banco="ping"

# Atualiza o status dos hosts
def updateStatus(host,status):
	cnx=mysql.connector.connect(host=bd_host, user=bd_user, passwd=bd_passwd, db=bd_banco)
	cursor=cnx.cursor()
	query="update hosts_status set status='%s' where host='%s';" % (status,host)
	cursor.execute(query)
	query=("commit")
	cursor.execute(query)
	cursor.close()
	cnx.close()

# Consulta e retorna os hosts que serão usados de parâmetro no ping
def consultaHosts():
	cnx=mysql.connector.connect(host=bd_host, user=bd_user, passwd=bd_passwd, db=bd_banco)
    	cursor=cnx.cursor()
    	query="select host from hosts_status;"
    	cursor.execute(query)
	hosts=[]

	for host, in cursor:
		hosts.append(host)
	return hosts

	cursor.close()
    	cnx.close()

# Consulta o status do host
def consultaStatus(host):
	cnx=mysql.connector.connect(host=bd_host, user=bd_user, passwd=bd_passwd, db=bd_banco)
	cursor=cnx.cursor()
	query="select status from hosts_status where host='%s';" % (host)
	cursor.execute(query)

	for status, in cursor:
		return status

	cursor.close()
	cnx.close

# Consulta a data do ultimo e-mail enviado
def consultaData():
	cnx=mysql.connector.connect(host=bd_host, user=bd_user, passwd=bd_passwd, db=bd_banco)
	cursor=cnx.cursor()
	query="select data from controle_data where id=1;"
	cursor.execute(query)
	for data, in cursor:
		return data
	cursor.close()
	cnx.close

# Altera o valor da tabela de controle de datas
def updateData(data):
	cnx=mysql.connector.connect(host=bd_host, user=bd_user, passwd=bd_passwd, db=bd_banco)
   	cursor=cnx.cursor()
    	query="update controle_data set data='%s' where id=1;" % (data)
	cursor.execute(query)
	query="commit"
	cursor.execute(query)
   	cursor.close()
    	cnx.close

