<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="Página de Login">
	<meta name="author" content="Página de Login">
	<link rel="icon" href="imagens/favicon.ico">
	
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link href="css/estilo-remover-email.css" rel="stylesheet">
  </head>
  <body>
  <?php
  require_once('conexao.php');
  require_once('appvars.php');

	if(isset($_POST['submit'])){
	
		$nome = trim($_POST['nome']);
		$pontuacao = trim($_POST['pontuacao']);
		$arquivo = trim($_FILES['arquivo']['name']);
					
		$tamanho_do_arquivo = $_FILES['arquivo']['size'];
		$tipo_do_arquivo = $_FILES['arquivo']['type'];	

			if (!empty($nome) && !empty($pontuacao) && !empty($arquivo)) {
				if ((($tipo_do_arquivo == 'image/gif') || ($tipo_do_arquivo == 'image/jpeg') ||
					($tipo_do_arquivo == 'image/pjpeg') || ($tipo_do_arquivo == 'image/png')) &&
					($tamanho_do_arquivo > 0) && ($tamanho_do_arquivo <= GW_MAXFILESIZE)) {
						$target = GW_UPLOAD .time() . $arquivo;
						$extensao = explode("/", $target);			
					if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $target)){

						$dbc = mysqli_connect(db_host, db_user, db_senha, db_nome)
					        or die('Erro de conexão.');
					
						$query = "INSERT INTO guitarwars (nome, data, pontuacao, foto) VALUES ('$nome', NOW(),
						 '$pontuacao', '$extensao[1]')";
								 
						mysqli_query($dbc,$query)
							or die('Erro ao executar a query no banco de dados');
								
							
							
							 
						echo '<p>O brigado por adicionar seu recorde</p>';
						echo '<p>Nome: '.$nome. '</br>';
						echo 'Pontuação: '.$pontuacao. '</br>';						
						echo '<img src="' . GW_UPLOAD . $extensao[1] . '" alt="pontuação imagem" /></br>';						
						echo '<p><a href="admin.php">Voltar para página admin</a></p>';
							 
						$nome = "";
						$pontuacao = "";						
						$arquivo = "";
						//$aprovado = "";
							 
						mysqli_close($dbc);
							 
						echo "Cadastro inserido com sucesso.<br>";
						echo "Extensão do arquivo: ".$extensao[1];
						}
						else{
							echo "Não foi possível enviar o arquivo na linha move_uploaded_file()";
						}
					}
					else{
						if ($tamanho_do_arquivo > GW_MAXFILESIZE) {
							echo "O arquivo <strong>" . $arquivo . "</strong> é muito grande. Favor enviar arquivos até 32K";
						}
						else{
							echo "Tipo de arquivo inválido. Favor enviar arquivos do tipo jpeg, gif, png";
						    echo "<br>".$arquivo;
						}
						
					}
				//Tenta excluir o arquivo gráfico temporário	
				@unlink($_FILES['arquivo']['tmp_name']);								
			}
			else{
				echo "Um ou mais campos estão em branco. Favor preencher.";
				echo "<br>Aprovado: ".$aprovado;
			}	
	}	
  ?>
  <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  
  <div class="form-group mx-auto table-remover-email">
  	<h1>Página de cadastro</h1>
  </div>
  
  <div class="form-group mx-auto table-remover-email">
			<label for="nome">Nome</label>
			<input type="text" class="form-control" required name="nome">
  </div>
  
  <div class="form-group mx-auto table-remover-email">
			<label for="pontuacao">Pontuação</label>
			<input type="text" class="form-control" required name="pontuacao">
  </div>
  
  <div class="form-group table-remover-email">
			<label for="arquivo">Foto</label>
			<input type="file" required name="arquivo">
  </div>
  
  
  
  
  
  <div class="form-inline table-remover-email">
			<button type="submit" value="submit" name="submit" class="btn btn-success">Cadastrar</button>
  </div>

  <div class="form-inline table-remover-email">
  <a href="admin.php"><button type="button" value="submit" name="submit" class="btn btn-link">Voltar >> Admin</button></a>
  </div>
  
  
  </form>
  
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>