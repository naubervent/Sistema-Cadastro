<?php
    require_once('autoriza.php');
?>
<?php
    require_once('conexao.php');
    require_once('appvars.php');

    if(isset($_GET['id']) && isset($_GET['nome']) && isset($_GET['data']) && 
        isset($_GET['pontuacao']) && isset($_GET['foto'])){

        $id = $_GET['id'];  
        $nome = $_GET['nome'];  
        $data = $_GET['data'];
        $pontuacao = $_GET['pontuacao'];
        $foto = $_GET['foto'];

                
    }
    else if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['pontuacao'])) {
        
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $pontuacao = $_POST['pontuacao'];
        $foto = $_POST['foto'];
    }
    else{
        echo "Nenhuma pontuação foi especificada para ser removoda";
    }
    
    if (isset($_POST['submit'])) {
        if ($_POST['confirmar'] == 'sim') {
            //Conecat ao banco de dados
            $dbc = mysqli_connect(db_host, db_user, db_senha, db_nome);

            $query = "UPDATE guitarwars SET aprovado = 1 WHERE id = '$id'";

            mysqli_query($dbc, $query);

            mysqli_close($dbc);

            echo "A pontuação foi aprovada com sucesso.";
        }
        else{
            echo "Houve um problema para aprovara a pontuação.";
        }
    }

    else if(isset($id) && isset($nome) && isset($data) &&
        isset($pontuacao) && isset($foto)){
        echo 'Tem certeza que deseja aprovar a pontuação abaixo?';
        echo  '<p>Id: '.$id.'<br>Nome: '.$nome. '<br>Data: '.$data. '<br>Pontuação: '.$pontuacao. '<br>Foto: '.$foto.'</p>';

        echo '<form action="aprovar-pontuacao.php" method="POST">';
        echo '<input type="radio" class="" name="confirmar" value="sim" />Sim';
        echo '<input type="radio" class="" name="confirmar" value="nao" checked />Não<br>';

        echo '<input type="submit" value="Submit" name="submit" class="btn btn-danger" /> <br>';

        echo '<input type="hidden" class="" name="id" value="'.$id.'" />';
        echo '<input type="hidden" class="" name="nome" value="'.$nome.'" />';
        echo '<input type="hidden" class="" name="pontuacao" value="'.$pontuacao.'" />';
        echo '<input type="hidden" class="" name="foto" value="'.$foto.'" />';
        echo '</form>';
    }
    

    echo '<p><a href="admin.php">Voltar para página admin</a></p>'

?>