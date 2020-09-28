<?php
	# Carregar informações de SESSÃO...
	session_start();
	
	# Verificar se a sessão NÃO está ATIVA...
	if( empty($_SESSION) || !isset($_SESSION["LOGADO"]) || ($_SESSION["LOGADO"]==false) ){
		
		# Redirecionar para LOGIN...
		header("Location: login.php");
		exit;
		
	}
	
	# Verificar se está recebendo ação (Cadastrar Cliente)...
	if( isset($_POST) && !empty($_POST) ){
		
		# Forçar interpretação de dados (I/O) como UTF-8 (caracteres especiais)...
		header('charset=utf-8');
		
		# Capturar dados informados...
		$cNome 	     = trim(utf8_decode($_POST["campoNome"]));
		$cTelefone   = trim(utf8_decode($_POST["campoTelefone"]));
		$cAparelho   = trim(utf8_decode($_POST["campoAparelho"]));
		$cConserto   = trim(utf8_decode($_POST["campoConserto"]));
		$cValor      = trim(utf8_decode($_POST["campoValor"]));
		$cPagamento  = trim(utf8_decode($_POST["campoPagamento"]));
		$cObservacao = trim(utf8_decode($_POST["campoObservacao"]));
		
		# Abrir conexão com o banco de dados...
		$bd = new mysqli("localhost", "root", "", "celularecia");

		# Verificar erro na conexão ao BD...
		if ($bd->connect_errno) {
			echo "<h1>Erro ao estabelecer conexão com o banco de dados</h1>";
			exit;
		}
		
		# Inserir cadastro na tabela OS
		$resultado = $bd->query("INSERT INTO # esta variável receberá um valor verdairo ou falso, se houve realmente a inserção no banco
									os (NOME,TELEFONE,APARELHO,CONSERTO,VALOR,PAGAMENTO,OBSERVACAO)
								VALUES
									('$cNome','$cTelefone','$cAparelho','$cConserto','$cValor','$cPagamento','$cObservacao');");
		if($resultado){
			echo "<script>
			alert('OS cadastrada com sucesso!'); 
			location= './index.php';
			</script>";
			exit;
		}else{
			echo "<script>alert('Não foi possível concluir esta ação. Tente novamente');
			location='./cadastroOS.php';
			</script>";
			exit;
		}
		
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Cadastro de OS - Celular&Cia</title>
		
		<!-- Biblioteca de CSS do Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
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
				<center><h4><p>Preencha as informações abaixo para incluir uma nova OS.</p></h4></center>
			</div>
		</div>
		
		<div class="container">
			<div class="panel panel-default">
			  <div class="panel-body">
				<form method="POST">
					<div class="form-group">
					<label for="campoNome"><b>Nome</b></label>
						<input type="text" name="campoNome" class="form-control" placeholder="Digite o nome..." required="required">
					</div>
					<div class="form-group">
						<label for="campoTelefone"><b>Telefone</b></label>
						<input type="text" name="campoTelefone" class="form-control" placeholder="Ex.: (14) 98765-4321" required="required"/>
					</div>
					<div class="form-group">
						<label form="campoAparelho"><b>Aparelho</b></label>
						<input type="text" name="campoAparelho" class="form-control" placeholder="Ex.: Celular, notebook" required="required" />
					</div>
					<div class="form-group">
						<label form="campoConserto"><b>Conserto</b></label>
						<input type="text" name="campoConserto" class="form-control" placeholder="Ex.: Troca de tela" required="required" />
					</div>
					<div class="form-group">
						<label form="campoValor"><b>Valor</b></label>
						<input type="text" name="campoValor" class="form-control" placeholder="Ex.: R$100,00" required="required" />
					</div>
					<div class="form-group">
						<label for="campoPagamento"><b>Pagamento</b></label>
						<select name="campoPagamento" class="form-control">
							<option value="À pagar">À pagar</option>
							<option value="Pago">Pago</option>
							<option value="Parcial">Parcial</option>
						</select>
					</div>
					<div class="form-group">
						<label form="campoObservacao"><b>Observação</b></label>
						<input type="text" name="campoObservacao" class="form-control" placeholder="Ex.: Valor parcial já pago, Brindes" required="required" />
					</div>
					<center>
					<div class="btn-group" role="group" aria-label="Basic example">
						<button class="btn btn-success" type="submit" href="index.php">CADASTRAR</button>
						<button class="btn btn-primary" href="index.php">CANCELAR</button>
					</div>
					</center>
				</form>
			  </div>
			</div>
		</div>
		<div class="container">
		  <hr>

		  <footer>
			<p>&copy; Celular & Cia <?php echo date("Y");?></p>
		  </footer>
		</div> <!-- /container -->
	</body>
	
</html>