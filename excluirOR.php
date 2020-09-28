<?php
	# Carregar informações de SESSÃO...
	session_start();
	
	# Verificar se a sessão NÃO está ATIVA...
	if( empty($_SESSION) || !isset($_SESSION["LOGADO"]) || ($_SESSION["LOGADO"]==false) ){
		
		# Redirecionar para LOGIN...
		header("Location: login.php");
		exit;
		
	}
	
	# Verificar se está passando parâmetro (Código do CLIENTE)...
	if( empty($_GET) || !isset($_GET["codigo"]) ){
		
		# Redirecionar...
		//echo "Passa o c&oacute;digo, man&eacute;!";exit;
		header("Location: relatorioOR.php");
		exit;
		
	}
	
	# Abrir conexão com o banco de dados...
	$bd = new mysqli("localhost", "root", "", "celularecia");

	# Verificar erro na conexão ao BD...
	if ($bd->connect_errno) {
		echo "<h1>Erro ao estabelecer conexão com o banco de dados</h1>";
		exit;
	}

	# Capturando dados ATUAL do cliente...
	@$codigo = $_GET["codigo"];
	$os = $bd->query("select * from orcamento where CODIGO=$codigo");
	if($os && $os->num_rows==1){
		
		# Dados do cliente em questão...
		$os = $os->fetch_assoc();		
		
	}else{
		# Redirecionar...
		header("Location: relatorioOR.php");
		exit;
	}
	
	# Verificar se está recebendo ação (Atualizar Cliente)...
	if( isset($_POST) && !empty($_POST) ){
		
		# Forçar interpretação de dados (I/O) como UTF-8 (caracteres especiais)...
		header('charset=utf-8');
		
		# Capturar dados informados...
		$cNome 	     = trim(utf8_decode($_POST["campoNome"]));
		$cTelefone   = trim(utf8_decode($_POST["campoTelefone"]));
		$cAparelho   = trim(utf8_decode($_POST["campoAparelho"]));
		$cConserto   = trim(utf8_decode($_POST["campoConserto"]));
		$cValor      = trim(utf8_decode($_POST["campoValor"]));
		$cObservacao = trim(utf8_decode($_POST["campoObservacao"]));
				
		# Atualizar cadastro na tabela Cliente
			# esta variável receberá um valor verdairo ou falso, se houve realmente a inserção no banco
		$resultado = $bd->query("DELETE FROM orcamento 
	                                WHERE
									CODIGO=$codigo;");
		if($resultado){
			echo
			"<script>
			alert('O orçamento do cliente ".utf8_encode($cNome)." foi excluido com sucesso!'); 
			location= './relatorioOR.php';
			</script>";
			exit;
		}else{
			echo
			"<script>
			alert('Houve um erro, tente novamente!'); 
			location= './relatorioOR.php';
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
		
		<title>Excluir Orçamento - Celular & Cia</title>
		
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
		<div class="container">
			<div class="panel panel-default">
			  <div class="panel-body">
				<form method="POST">
					<div class="form-group">
					<label for="campoNome"><b>Nome</b></label>
						<input type="text" name="campoNome" class="form-control" placeholder="Digite o nome..."  value="<?php echo $os["NOME"];?>"/>
					</div>
					<div class="form-group">
						<label for="campoTelefone"><b>Telefone</b></label>
						<input type="text" name="campoTelefone" class="form-control" placeholder="Ex.: (14) 98765-4321"  value="<?php echo $os["TELEFONE"];?>"/>
					</div>
					<div class="form-group">
						<label form="campoAparelho"><b>Aparelho</b></label>
						<input type="text" name="campoAparelho" class="form-control" placeholder="Ex.: Celular, notebook"  value="<?php echo $os["APARELHO"];?>"/>
					</div>
					<div class="form-group">
						<label form="campoConserto"><b>Conserto</b></label>
						<input type="text" name="campoConserto" class="form-control" placeholder="Ex.: Troca de tela" value="<?php echo $os["CONSERTO"];?>" />
					</div>
					<div class="form-group">
						<label form="campoValor"><b>Valor</b></label>
						<input type="text" name="campoValor" class="form-control" placeholder="Ex.: R$100,00"  value="<?php echo $os["VALOR"];?>"/>
					</div>
					<div class="form-group">
						<label form="campoObservacao"><b>Observação</b></label>
						<input type="text" name="campoObservacao" class="form-control" placeholder="Ex.: Valor parcial já pago, Brindes" value="<?php echo $os["OBSERVACAO"];?>"/>
					</div>
                    <center><button class="btn btn-danger" type="submit">EXCLUIR</button></center>
		  <footer>
			<p>&copy; Celular & Cia <?php echo date("Y");?></p>
		  </footer>
		</div> <!-- /container -->
	</body>
	
</html>