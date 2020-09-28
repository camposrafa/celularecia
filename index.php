<?php
	# Carregar informações de SESSÃO...
	session_start();
	
	# Verificar se a sessão NÃO está ATIVA...
	if( empty($_SESSION) || !isset($_SESSION["LOGADO"]) || ($_SESSION["LOGADO"]==false) ){
		
		# Redirecionar para LOGIN...
		header("Location: login.php");
		exit;
		
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Início - Celular & Cia</title>
		
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
			  <a class="navbar-brand" href="#">Celular & Cia</a>
			</div>
			<a href="sair.php">Sair</a>
		  </div>
		</nav>

		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron">
		  <div class="container">
		  	<div class="row">
		  	 <div class="card" style="width: 16rem;">
					<div class="card-body">
					<h5 class="card-title">Cadastro de OS</h5>
					<p class="card-text">Utilize esta opção para cadastrar um novo serviço.</p>
					<a href="cadastroOS.php" class="btn btn-dark">Cadastrar >></a>
					</div>			
			 </div>
			 <div class="card" style="width: 16rem;">
					<div class="card-body">
					<h5 class="card-title">Relatório de OS</h5>
					<p class="card-text">Utilize esta opção para visualizar e editar suas OS.</p>
					<a href="relatorioOS.php" class="btn btn-dark">Visualizar >></a>
					</div>			
			 </div>
			 <div class="card" style="width: 16rem;">
					<div class="card-body">
					<h5 class="card-title">Criar Orçamentos</h5>
					<p class="card-text">Utilize esta opção para cadastrar um orçamento.</p>
					<a href="cadastroOR.php" class="btn btn-dark">Cadastrar >></a>
					</div>			
			 </div>
			 <div class="card" style="width: 18rem;">
					<div class="card-body">
					<h5 class="card-title">Relatório de Orçamentos</h5>
					<p class="card-text">Utilize esta opção para visualizar e editar um orçamento.</p>
					<a href="relatorioOR.php" class="btn btn-dark">Visualizar >></a>
					</div>			
			 </div>
			 <hr>
			 <div class="card" style="width: 16rem;">
					<div class="card-body">
					<h5 class="card-title">Pedidos de peças</h5>
					<p class="card-text">Utilize esta opção para cadastrar um pedido.</p>
					<a href="cadastroPD.php" class="btn btn-dark">Cadastrar >></a>
					</div>			
			 </div>
			 <div class="card" style="width: 16rem;">
					<div class="card-body">
					<h5 class="card-title">Relatório de Pedidos</h5>
					<p class="card-text">Utilize esta opção para visualizar e editar suas OS.</p>
					<a href="relatorioPD.php" class="btn btn-dark">Visualizar >></a>
					</div>			
			 </div>
			 <div class="card" style="width: 16rem;">
					<div class="card-body">
					<h5 class="card-title">Lucros e Despesas</h5>
					<p class="card-text">Utilize esta opção para visualizar lucros e gastos</p>
					<a href="lucrosDespesas.php" class="btn btn-dark">Cadastrar >></a>
					</div>			
			 </div>
			 <div class="card" style="width: 18rem;">
					<div class="card-body">
					<h5 class="card-title">Outros Serviços / à fazer</h5>
					<p class="card-text">Utilize esta opção para visualizar visitas técnicas e outros serviços</p>
					<a href="outros.php" class="btn btn-dark">Visualizar >></a>
					</div>			
			 </div>
			</div>
		   </div>
		  </div>	
		<div class="container">
		  <hr>
		  <footer>
			<p>&copy; Celular & Cia <?php echo date("Y");?></p>
		</div> <!-- /container -->
	<body>	
</html>
<?php 
?>