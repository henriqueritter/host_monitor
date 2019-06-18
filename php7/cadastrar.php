<?php
/*
# Autor: Henrique Ritter
# Pagina de cadastro de Hosts
# 
# https://github.com/henriqueritter/host_monitor
*/
$host="localhost";
$db="ping";	
$user="ping";	
$pass="senha";  //DB Password - Senha do Banco de dados
$con=mysqli_connect($host,$user,$pass,$db);

if(mysqli_connect_errno())
{
	echo "Deu Erro" . mysqli_connect_error();
}
//$sqlhost= $_GET['campo_host'];
//$sqlnome= $_GET['campo_nome'];
$sqlhost= $_POST['campo_host'];
$sqlnome= $_POST['campo_nome'];

$btgravar= $_POST['botao'];
$btexcluir= $_POST['excluir'];

if($sqlhost!=""){
	if($btgravar==="Gravar"){
		$query=("REPLACE INTO hosts_status values('$sqlhost','','$sqlnome')");
		$dados=mysqli_query($con,$query);
		$linha=mysqli_fetch_assoc($dados);
		//$total=mysql_num_rows($dados);
	}

	if($btexcluir==="Excluir"){
		$query=("DELETE FROM hosts_status where host ='$sqlhost'");
                $dados=mysqli_query($con,$query);
                $linha=mysqli_fetch_assoc($dados);
                //$total=mysql_num_rows($dados);
	}

}

mysqli_free_result($dados);
?>


<html>
	<head>
		<title>Cadastrar - Monitor de Hosts</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<center>
			<table>
				<tr>
					<td colspan="2"><center> <b><font size="5">Cadastro de Hosts</font> </b> </center> </td>
				</tr>
				<tr>
					<td> <font size="4"> <b><center> Host </center></b> </font> </td>
					<td> <font size="4"> <b><center> Nome do Host </center></b> </font> </td>
				</tr>
				<tr>
				<form action=" " method="POST">
					<td>	<input type="text" name="campo_host" value="" size="25" autofocus maxlength="25"> </td>
					<td>	<input type="text" name="campo_nome" value="" size="25" maxlength="25"> </td>
				</tr>
				<tr>
					<td><center>    <input type="submit" name="botao" value="Gravar" class="searchbutton"> </center> </td>
					<td><center>    <input type="submit" name="excluir" value="Excluir" class="searchbutton"> </center> </td>
				</tr>
				<tr>
					<td colspan="2">
						<center>
							<font size="4">
								<?php if($btgravar==="Gravar"){ ?>
										O host <b><?php echo $sqlhost ?></b> foi gravado
								<?php }
									if($btexcluir==="Excluir"){  ?>
										O host <b><?php echo $sqlhost ?></b> foi excluido
								<?php } ?>
							</font>
						</center>
					</td>
				</tr>
				</form>
			</table>
		</center>
		<iframe src="monitor.php" width="100%" height="100%">
	</body>
</html>
