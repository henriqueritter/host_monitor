#!/usr/bin/python2.7
#coding: utf-8
'''
* ---------------------------------------------------
* Titulo: Host Monitor - Monitor de Hosts
* Modulo: main.py  (Principal)
* Data: 04/out/2018
* Finalidade: Checar o status de Hosts salvos em um banco de dados
* e retornar o estado atual para o mesmo banco para exibir em um
* painel em PHP e caso o host esteja continuamente interrompido,
* enviar um e-mail com a data e a identificação do host.
* -----------------------------------------------------
* S.O:  Debian 8
* Versão do Python: 2.7.9
'''
import os
import time
from cnxMySql import *
from sendEmail import *

def salvarLog(host):				#Adiciona a hora e o host que estava offline
	dt_hora = time.strftime("%d/%m/%Y %H:%M")
	mensagem = ("Em %s o HOST: %s estava offline \r\n" % (dt_hora,host))
	log = open("/var/log/hosts_status.log","a+")
	log.write(mensagem)
	log.close()

def ping():
	hosts = consultaHosts()
	for host in hosts:
		resposta = os.system("ping -c 1 " + host + " > /dev/null 2>&1")
		if resposta == 0:			#Altera o status dos hosts no banco
			updateStatus(host,"UP")
		else:
			stts=consultaStatus(host)
			if stts=="DOWN": 		#Se link ja estivesse offline, salva o status no log
				salvarLog(host)
			updateStatus(host,"DOWN")

	data_atual = time.strftime("%d%m")
	data_bd = consultaData()
	if data_atual != data_bd:
		#Envia o log por e-mail
		enviar_email('host.monitor@email.com.br',['destinatario@email.com.br'], 'Status Links', 'Status dos Links', ['/var/log/hosts_status.log'], 'mail.email.com.br')
		#Zera o log
		novo_log = open('/var/log/hosts_status.log','w+')
		novo_log.close()
		#Altera a data anterior do banco para enviar o log
		# apenas no proximo dia
		updateData(data_atual)
    
	# Para executar a cada 5 minutos sem agendar no crontab descomente as linhas abaixo
	'''time.sleep(xSegundos)
	ping() '''
ping()

