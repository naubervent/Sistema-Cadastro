<?php
    
    $usuario = 'admin';
    $senha = '1234';
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
    	($_SERVER['PHP_AUTH_USER'] != $usuario) || ($_SERVER['PHP_AUTH_PW'] != $senha)) {
    	
    	header('HTTP/ 1.1 401 Unauthorized');
	    header('WWW-Authenticate: Basic realm="Guitar Wars"');
	    exit('<h2>Guitar Wars</h2>Desculpe, você deve digitar um '.
			'usuário e senha válidos para acessar esta página.');
    }

?>