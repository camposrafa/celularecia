
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
        $cSemana = trim(utf8_decode($_POST["campoSemana"]));
		$cQnt 	     = trim(utf8_decode($_POST["campoQnt"]));
		$cPeca   = trim(utf8_decode($_POST["campoPeca"]));
        $cModelo   = trim(utf8_decode($_POST["campoModelo"]));
        $cCor = trim(utf8_decode($_POST["campoCor"]));
		$cPreco   = trim(utf8_decode($_POST["campoPreco"]));
		$cMobra  = trim(utf8_decode($_POST["campoMobra"]));
        $cLucro  = trim(utf8_decode($_POST["campoLucro"]));
        $cFrete = trim(utf8_decode($_POST["campoFrete"]));
		
		
		# Abrir conexão com o banco de dados...
		$bd = new mysqli("localhost", "root", "", "celularecia");

		# Verificar erro na conexão ao BD...
		if ($bd->connect_errno) {
			echo "<h1>Erro ao estabelecer conexão com o banco de dados</h1>";
			exit;
		}

		# Inserir cadastro na tabela OS
		$resultado = $bd->query("INSERT INTO # esta variável receberá um valor verdairo ou falso, se houve realmente a inserção no banco
									pedido (SEMANA,QNT,PECA,MODELO,COR,PRECO,MAOOBRA,LUCRO,FRETE)
								VALUES
									('$cSemana','$cQnt','$cPeca','$cModelo','$cCor','$cPreco','$cMobra','$cLucro','$cFrete');");
		if($resultado){
			echo "<script>
			location= './cadastroPD.php';
			</script>";
			exit;
		}else{
			echo "<script>alert('Não foi possível concluir esta ação. Tente novamente');
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
		
		<title>Cadastro de Pedidos - Celular&Cia</title>
		
		<!-- Biblioteca de CSS do Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script>
			function concluir(){
				alert("Pedido cadastrado com sucesso! Você será redirecionado para a tela inicial.");
				location="./index.php";
			}
		</script>
		
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
				<center><h4><p>Preencha as informações abaixo para incluir um novo pedido.</p></h4></center>
			</div>
		</div>
		
		<div class="container">
			<div class="panel panel-default">
			  <div class="panel-body">
				<form method="POST">
				<div class="form-group">
					<label for="campoSemana"><b>Semana</b></label>
						<input type="text" name="campoSemana" class="form-control" placeholder="Digite a semana do pedido (AAAA/DD/MM)" required="required">
					</div>
			</select>
			</div>
			</div>
			
					<div class="form-group">
						<label for="campoQnt"><b>Quantidade</b></label>
						<input type="text" name="campoQnt" class="form-control" placeholder="1, 2, 3..." required="required"/>
					</div>
					<div class="form-group">
						<label form="campoPeca"><b>Peça</b></label>
						<input type="text" name="campoPeca" class="form-control" placeholder="Ex.: Frontal, alto falante..." required="required" />
					</div>
					<div class="form-group">
						<label form="campoModelo"><b>Modelo</b></label>
						<input type="text" name="campoModelo" class="form-control" placeholder="Ex.: Troca de tela" required="required" />
					</div>
					<div class="form-group">
						<label form="campoCor"><b>Cor</b></label>
						<input type="text" name="campoCor" class="form-control" placeholder="Preto, Dourado..." required="required" />
					</div>
					<div class="form-group">
						<label form="campoPreco"><b>Preço</b></label>
						<input type="text" name="campoPreco" class="form-control" placeholder="Preço da peça" required="required" />
					</div>
                    <div class="form-group">
						<label form="campoMobra"><b>Mão de Obra</b></label>
						<input type="text" name="campoMobra" class="form-control" placeholder="Custo do trabalho" required="required" />
					</div>
                    <div class="form-group">
						<label form="campoLucro"><b>Lucro</b></label>
						<input type="text" name="campoLucro" class="form-control" placeholder="Total - Gastos" required="required" />
					</div>
                    <div class="form-group">
						<label form="campoFrete"><b>Frete</b></label>
						<input type="text" name="campoFrete" class="form-control" placeholder="Custo do frete" required="required" />
					</div>
					<center>
						<button class="btn btn-primary" type="submit">ADICIONAR ITEM</button>
						<button class="btn btn-success" onclick="concluir()" href="./index.php">CONCLUIR</button>
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