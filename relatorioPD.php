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
	$cBuscar = trim(utf8_decode($_POST["buscar"]));
?>
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
			  <a class="navbar-brand" href="index.php">Celular & Cia</a>
			</div>
			<a href="sair.php">Sair</a>
		  </div>
		</nav>
		
		<div class="jumbotron">
			<div class="container">
				<center><h4><p>Visualização de pedidos semanais</p></h4></center>
			</div>
        <nav class="navbar">
        <a class="navbar-brand"></a>
        <form class="form-inline" method="POST">
            <input class="form-control mr-sm-2" type="search" placeholder="Busca por data" name="buscar" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
        </nav>
        </div>
        <?php
        $pedido = $bd->query("select * from pedido where SEMANA = $cBuscar");
        if($pedido && $pedido->num_rows>0){
            while($pd = $pedido->fetch_assoc()){
            echo
        '<div class="container">
        <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"> <b><h5>Semana: </h5></b>'
                            .utf8_encode($pd["SEMANA"]).'
                            </button>
                            </h2>
                          </div>
                          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
						  <div class="card-body">
						  <table class="table table-hover table-striped">
						  <thead>
						  <th width="4%">QNT</th>
						  <th width="16%">PECA</th>
						  <th width="16%">MODELO</th>
						  <th width="16%">COR</th>
						  <th width="16%">PREÇO</th>
						  <th width="16%">M. OBRA</th>
						  <th width="16%">LUCRO</th>
						  <th><center>OPÇÕES</center></th>
					  	  </thead>
						  <tbody>
						  <tr>
						  <td>'.utf8_encode($pd["QNT"]).'</td>
						  <td align="center">'.utf8_encode($pd["PECA"]).'</td>
						  <td align="left">'.utf8_encode($pd["MODELO"]).'</td>
						  <td align="left">'.utf8_encode($pd["COR"]).'</td>
						  <td align="left">'.utf8_encode($pd["PRECO"]).'</td>
						  <td align="left">'.utf8_encode($pd["MAOOBRA"]).'</td>
						  <td align="left">'.utf8_encode($pd["LUCRO"]).'</td>
						  <td align="left">
						  <div class="btn-group" role="group" aria-label="Basic example">
							  <a title="Alterar" class="btn btn-warning" href="alteraOS.php?codigo='.$pd["COD"].'">✎</a>
							  <a title="Excluir" class="btn btn-danger" href="excluirOS.php?codigo='.$pd["COD"].'">☠</a>
						  </div>
					  </td>
					  </tr>
					  </tbody>
					  </table>
                    </div><!-- card body -->
                    </div> <!-- collapse show -->
                </div> <!-- card -->
                </div> <!-- accordion -->
                </div><!-- container -->';
            }
        }

        ?>

        
	</body>
</html>