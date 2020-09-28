<?php
	# Carregar informações de SESSÃO...
	session_start();
	
	# Verificar se a sessão NÃO está ATIVA...
	if( empty($_SESSION) || !isset($_SESSION["LOGADO"]) || ($_SESSION["LOGADO"]==false) ){
		
		# Redirecionar para LOGIN...
		header("Location: login.php");
		exit;
		
	}
	
	# Forçar interpretação de dados (I/O) como UTF-8 (caracteres especiais)...
	header('charset=utf-8');
	
	# Abrir conexão com o banco de dados...
	$bd = new mysqli("localhost", "root", "", "celularecia");

	# Verificar erro na conexão ao BD...
	if ($bd->connect_errno) {
		echo "<h1>Erro ao estabelecer conexão com o banco de dados</h1>";
		exit;
	}
	
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Celular & Cia</title>
		
		<!-- Biblioteca de CSS do Bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		
	</head>
	<body>
	<nav class="navbar navbar-dark bg-dark">
		  <div class="container">
			<div class="navbar-header">
			  <a class="navbar-brand" href="index.php">Celular & Cia</a>
			</div>
			<a href="sair.php">Sair</a>
		  </div>
		</nav>
		
		<div class="jumbotron">
			<div class="container">
				<center><h4><p>Visualização de ordens de serviço</p></h4></center>
			</div>
		</div>
		
		<div class="container">
			<table class="table table-hover table-striped">
				<thead>
					<th width="2%"><center>COD</center></th>
					<th width="18%">NOME</th>
					<th width="14%">TEL</th>
					<th width="16%">APARELHO</th>
					<th width="17%">CONSERTO</th>
					<th width="8%">VALOR</th>
					<th width="8%">PAGAMENTO</th>
					<th width="17%">OBSERVAÇÃO</th>
					<th><center>OPÇÕES</center></th>
				</thead>
				<tbody>
				<?php
					# Selecionar clientes no banco de dados...
					$ordem = $bd->query("select * from os");
					
					# Verificar se localizou algum cliente...
					if($ordem && $ordem->num_rows>0){
						while($os = $ordem->fetch_assoc()){
							echo'
							<tr>
								<td align="center"><strong>'.$os["CODIGO"].'</strong></td>
								<td>'.utf8_encode($os["NOME"]).'</td>
								<td align="left">'.utf8_encode($os["TELEFONE"]).'</td>
								<td align="left">'.utf8_encode($os["APARELHO"]).'</td>
								<td align="left">'.utf8_encode($os["CONSERTO"]).'</td>
								<td align="left">'.utf8_encode($os["VALOR"]).'</td>
								<td align="left">'.utf8_encode($os["PAGAMENTO"]).'</td>
								<td align="left">'.utf8_encode($os["OBSERVACAO"]).'</td>
								<td align="left">
									<div class="btn-group" role="group" aria-label="Basic example">
										<a title="Alterar" class="btn btn-warning" href="alteraOS.php?codigo='.$os["CODIGO"].'">✎</a>
										<a title="Excluir" class="btn btn-danger" href="excluirOS.php?codigo='.$os["CODIGO"].'">☠</a>
									</div>
								</td>
							</tr>';
						}
					}
				?>
				</tbody>
			</table>
				
		</div>
		<div class="container">
		  <hr>

		  <footer>
			<p>&copy; Celular & Cia <?php echo date("Y");?></p>
		  </footer>
		</div> <!-- /container -->
	
	</body>
	
</html>