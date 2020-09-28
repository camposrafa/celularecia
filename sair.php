<?php 
	/*
	Lembra do Dragon Ball ;)
	*/
	
	# Instancia a sessão ativa...
	session_start();
	
	# Destruir sessão...
	session_destroy();
	
	# Limpar variável de controle da sessão...
	$_SESSION = array();
	
	# Redirecionar para área de login...
	header("Location: login.php");
?>