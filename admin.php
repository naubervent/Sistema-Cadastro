<?php    
    require_once('autoriza.php');
?>
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
	
    <title>Guitar Wars</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Custom style for this template -->
	<link href="css/estilo-pontuacao.css" rel="stylesheet">
	
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

	$dbc = mysqli_connect(db_host, db_user, db_senha, db_nome)
	or die('Erro de conexão.');
	
	$query = "SELECT * FROM guitarwars ORDER BY pontuacao DESC, data ASC";
	
	$resultado = mysqli_query($dbc,$query)
    or die('Erro ao executar a query no banco de dados');
   ?>
  <form enctype="multipart/form-data  " action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <input type="hidden" name="MAX_FILE_SIZE" value="32768">
  
   	
	<div class="table-remover-email">
		<div class="table-remover-email">
	   		<h1>Página de administração.</h1>
	   	</div>
	  <table class="table table-striped">
	  <thead>
		  <tr>
			<th>Nome</th>
			<th>Data</th>
			<th>Pontuação</th>
			<th>Foto</th>
			<th>Acão</th>
			<th>Autoriza</th>
		  </tr>
		</thead>
		<tbody>
	<?php
		
		while($row = mysqli_fetch_array($resultado)){
			echo "<tr>";
					echo "<td>".$row['nome']."</td>";
					echo "<td>".$row['data']."</td>";
					echo "<td>".$row['pontuacao']."</td>";
					if(is_file(GW_UPLOAD . $row['foto'] ) && filesize(GW_UPLOAD . $row['foto']) > 0){
						echo '<td><img src="'. GW_UPLOAD .$row['foto'].'" alt="imagem da pontuacao" /></td>';
					}
					else{
						echo '<td><img src="'. GW_UPLOAD . 'unverified.gif' .'" alt="sem imagem" /></td>';
					}
					echo '<td><a href="remover-pontuacao.php?id=' . $row['id'] . '&amp;nome=' . $row['nome'] . 
					'&amp;data=' . $row['data'] . '&amp;pontuacao=' . $row['pontuacao'] . '&amp;foto=' .
					$row['foto'] . '"><button type="button" class="btn btn-danger">Excluir</button></a></td>';
					if ($row['aprovado'] == '0') {
							echo '<td><a href="aprovar-pontuacao.php?id=' . $row['id'] . '&amp;nome=' . $row['nome'] . 
							'&amp;data=' . $row['data'] . '&amp;pontuacao=' . $row['pontuacao'] . '&amp;foto=' .
							$row['foto'] . '"><button type="button" class="btn btn-warning">Aprovar</button></a></td>';
						}	
																	
			echo "</tr>";
			
		}
	
	mysqli_close($dbc);
	?>
        </tbody>
     </table>
	 <a class="btn btn-link" href="adiciona-pontuacao.php" role="button">Cadastrar Pontuação</a>
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
	
  
  
  