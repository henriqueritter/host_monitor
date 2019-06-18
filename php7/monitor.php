<?php
/*
# Autor: Henrique Ritter
# Pagina de status dos Hosts
# Esta página irá exibir os hosts cadastrados separando por Categoria(nome dado: Filial)
# https://github.com/henriqueritter/host_monitor
*/
$host="localhost";
$db="ping";
$user="ping";
$pass="senha";
$con=mysqli_connect($host,$user,$pass,$db);

if(mysqli_connect_errno())
{
	echo "Erro ao Conectar" . mysqli_connect_error();
}
$hosts=array();
$hoststatus=array();
$contador=0;
$filial=array();
?>


<html>
	<head>
		<title>Monitor - Monitor de Hosts</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="refresh" content="15">
		<link rel="stylesheet" href="style.css">
		<script>
			$(document).ready(function(){
					window.location.href='#foo';
			});
		</script>
	</head>

	<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<!-- Ajuste o WIDTH da tabela conforme a resolução da tela -->
			<?php
			$query=("SELECT distinct(host_name) as host_name from hosts_status order by host_name asc");
			$dados=mysqli_query($con,$query);
			//Separa os Hosts por Filiais (ou categorias)
			$contador=0;
			while($linha = mysqli_fetch_assoc($dados)){
				$linha['host_name'];
				$filial[$contador]=$linha['host_name'];
				$contador++;
			}
			$contador=0;
			mysqli_free_result($dados);
			?>

			 <tr>
                                <td height="60" colspan= <?php echo count($filial); ?> >
					<font size="6"><b>
						<center>Status Links</center></b>
					</font>
				</td>
                        </tr>

			<tr>
			<?php
			while(count($filial)>$contador){ ?>
				<td valign="top">
				<table border="0"  cellpadding="0" cellspacing="4"> <!-- width = 260 -->
					<tr height="4"><td colspan="2">
						<font size="4">
							<b><center><?php echo $filial[$contador];  ?></center></b>
						</font>
					</td></tr>
						<?php
						$query=("SELECT host, status FROM hosts_status where host_name='{$filial[$contador]}'" );
						$dados=mysqli_query($con,$query);

						while($linha=mysqli_fetch_assoc($dados)){
						?>
					<tr>
						<td height="38">
							<font size="4"><center><?php echo $linha['host'] ?></center></font>
						</td>
						<td width="30" height="30"><center>
							<?php if($linha['status']==="UP"){ ?> <img src="img/UP.gif">
							<?php } elseif($linha['status']==="DOWN"){ ?> <img src="img/DOWN.gif"> 
							<?php } elseif($linha['status']==="INTR"){ ?> <img src="img/INTR.gif">
							<?php } ?>
						</center></td>
					</tr>
						<?php
						}
						mysqli_free_result($dados);
						?>
				</table>
				</td>
			<?php $contador++;
			}
			?>
			</tr>
		</table>
	</body>
</html>

