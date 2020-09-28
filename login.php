<?php
	# Verificar se a sessão ESTÁ ATIVA...
	session_start();
	if( !empty($_SESSION) && isset($_SESSION["LOGADO"]) && ($_SESSION["LOGADO"]==true) ){
		# Redirecionar para LOGIN...
		header("Location: index.php");
		exit;
	}

	# Verificar se está recebendo ação (Verificar Login)...
	if( isset($_POST) && !empty($_POST) ){
		
		# Capturar dados informados...
		$campoUsuario = trim($_POST["campoUsuario"]);
		$campoSenha = trim($_POST["campoSenha"]);
		
		# Abrir conexão com o banco de dados...
		$bd = new mysqli("localhost", "root", "", "celularecia");

		# Verificar erro na conexão ao BD...
		if ($bd->connect_errno) {
			echo "<h1>Erro ao estabelecer conexão com o banco de dados</h1>";
			exit;
		}
		
		# Verificar LOGIN...
		$result = $bd->query("select * from credencial where USUARIO='$campoUsuario' AND SENHA='$campoSenha'");
		if($result && $result->num_rows==1){
			
			# Recuperando informações do usuário no banco de dados...
			$infoUsuario = $result->fetch_array(MYSQLI_ASSOC);
			
			# Abrindo SESSÃO com os dados do usuário ativo...
			session_start();
			
			$_SESSION["LOGADO"]  = true;
			$_SESSION["CODIGO"]  = $infoUsuario["CODIGO"];
			$_SESSION["NOME"]    = $infoUsuario["NOME"];
			$_SESSION["USUARIO"] = $infoUsuario["USUARIO"];
			$_SESSION["SENHA"]   = $infoUsuario["SENHA"];
			
			//echo "<h1>Seja bem-vindo, ".$_SESSION["NOME"]."</h1>"; exit;
			
			# Redirecionar o usuário pra página inicial...
			header("Location: index.php");
			
		}else{
			
			# Bloqueio da sessão...
			$_SESSION["LOGADO"]  = false;
			echo "<script>alert('Usuário ou senha incorretos. Tente novamente');
			location='./login.php';
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
		
		<title>Login - Celular & Cia</title>
		
		<!-- Biblioteca de CSS do Bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		
		<!--[if lt IE 9]>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<![endif]-->
		
	</head>
	<body>
		<div class="jumbotron">
			<div class="container">
				<center><h1>LOGIN - Celular & Cia</h1>
				<p>
					Seja bem-vindo, utilize os campos abaixo para acessar o sistema.
				</p></center>
			</div>
		</div>
		<div class="container">
			<div class="panel panel-default">
			  <div class="panel-body">
				<form method="POST">
					<div class="form-group">
						<label for="campoUsuario">Usuário</label>
						<input type="text" name="campoUsuario" class="form-control" placeholder="Digite seu usuário..." required="required">
					</div>
					<div class="form-group">
						<label for="campoSenha">Senha</label>
						<input type="password" name="campoSenha" class="form-control" placeholder="Digite sua senha..." required="required">
					</div>
					<center><button class="btn btn-dark" type="submit">ENTRAR</button></center>
				</form>
			  </div>
			</div>
		</div>
	<body>	
</html>
