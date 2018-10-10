#!/usr/bin/python2.7
#coding: utf-8
'''
* ---------------------------------------------------
* Titulo: Host Monitor - Monitor de Hosts
* Modulo: sendMail.py  (Envio de E-mail)
* Data: 04/out/2018
* Finalidade: Enviar o arquivo de Log para os e-mails
* cadastrados
* -----------------------------------------------------
* S.O:  Debian 8
* Versão do Python: 2.7
'''

import smtplib
import os
from email.MIMEMultipart import MIMEMultipart
from email.MIMEBase import MIMEBase
from email.MIMEText import MIMEText
from email.Utils import COMMASPACE, formatdate

from email import Encoders

#Funcao de enviar o email
def enviar_email(de, para, assunto, mensagem, arquivos=[], servidor='localhost'):  #Verificar localhost
	#verificar se as variaveis sao listas
	assert type(para) == list
	assert type(arquivos) == list
	
	#Cria objtos de mensagem
	msg = MIMEMultipart()
	#Define cabecalho do email
	msg['From'] = de
	msg['To'] = COMMASPACE.join(para)
	msg['Date'] = formatdate(localtime=True)
	
	msg['Subject'] = assunto
	
	#Coloca o texto da mensagem 
	
	msg.attach(MIMEText(mensagem))
	
	#Adiciona arquivos
	for f in arquivos:
		parte = MIMEBase('application', 'octet-stream')
		parte.set_payload(open(f, 'rb').read())
		Encoders.encode_base64(parte)
		parte.add_header('Content-Disposition', 'attachment; filename="%s"' % os.path.basename(f))
		
		msg.attach(parte)
		
	#Conexao com server smtp
	smtp = smtplib.SMTP(servidor, 587)
	smtp.starttls()
	smtp.login('usuariologin', 'senha')
	smtp.sendmail(de, para, msg.as_string())
	smtp.close()
