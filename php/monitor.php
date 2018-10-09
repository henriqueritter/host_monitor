<?php
$host="localhost";
$db="ping";
$user="ping";
$pass="senha";
$con=mysql_connect($host,$user,$pass) or trigger_error(mysql_error(),E_USER_ERROR);

mysql_select_db($db,$con);

$query=("SELECT host, status FROM hosts_status ORDER BY host_name ASC");
$dados=mysql_query($query, $con) or die(mysql_error());
$linha=mysql_fetch_assoc($dados);
$total=mysql_num_rows($dados);
?>

<html>
	<head>
		<title>Monitor - Monitor de Hosts</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="refresh" content="15">
		<link rel="stylesheet" href="style.css">
	</head>
	<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
		<table id="Table_01" width="1360" height="690" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<a href="cadastrar.php"	
						onmouseover="window.status='Cadastros';  return true;" 
						onmouseout="window.status='';  return true;">
						<img src="images/CADASTRAR.gif" width="376" height="88" border="0" alt="">
					</a>
				</td>
				<td colspan="3">
					<a href="index.php">
						<img src="images/VOLTAR.gif" width="399" height="88" border="0" alt="P&#225;gina Inicial">
					</a>
				</td>
				<td colspan="2">
					<img src="images/monitor.php_04.gif" width="585" height="88" alt="">
				</td>
			</tr>
			<tr>
				<td colspan="6">
					<img src="images/form.gif" width="1360" height="65" alt="">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<img src="images/cabecalho1.gif" width="503" height="55" alt="">
				</td>
				<td>
						<img src="images/form-08.gif" width="2" height="55" alt="">
				</td>
				<td colspan="2">
						<img src="images/cabecalho2.gif" width="402" height="55" alt="">
				</td>
				<td>
					<img src="images/monitor.php_09.gif" width="453" height="55" alt="">
				</td>
			</tr>
	
			<?php do { ?>
			<tr>
				<td width="503" height="49" colspan="2">
					<font face="arial"> <h1><center> <?=$linha['host']?></center> </h1></font>
				</td>
				<td width="404" height="49" colspan="3">
					<center>
						<?php if($linha['status']=== "UP") { ?> 
						<img src="images/UP.gif"> <?php } elseif ($linha['status']==="DOWN") { ?>
						<img src="images/DOWN.gif"> <?php } ?> 
					</center>
				</td>
				<td width="453" height="49">
					<img src="images/spacer.gif" width="453" height="49" alt="">
				</td> <!--widh=453,height=49"-->
			</tr>
			<?php  }while($linha=mysql_fetch_assoc($dados)); ?>
			<tr>
				<td width="1360" height="425" colspan="6">
					<img src="images/spacer.gif" width="1360" height="425" alt="">
				</td>
			</tr>
			<tr>
				<td>
					<img src="images/spacer.gif" width="376" height="1" alt="">
				</td>
				<td>
					<img src="images/spacer.gif" width="127" height="1" alt="">
				</td>
				<td>
					<img src="images/spacer.gif" width="2" height="1" alt="">
				</td>
				<td>
					<img src="images/spacer.gif" width="270" height="1" alt="">
				</td>
				<td>
					<img src="images/spacer.gif" width="132" height="1" alt="">
				</td>
				<td>
					<img src="images/spacer.gif" width="453" height="1" alt="">
				</td>
			</tr>
		</table>
	</body>
</html>
