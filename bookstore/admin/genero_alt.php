<?php 

    $titulo = "Livraria - Alteração de gêneros";

    include_once("cabecalho.php");

    if(isset($_GET['id']) && (is_numeric($_GET['id']))){
        $id = $_GET['id'];
    } else if (isset($_POST['id']) && (is_numeric($_POST['id']))){
        $id = $_POST['id'];
    } else {
          header("Location: genero_menu.php");
        exit();
      }
     require_once("conexao.php");
    if (isset($_POST['enviou'])){

        $erros = array();

        //Verifica se há um primeiro nome
        if(empty($_POST['descricao'])){
            $erros[]='Você esqueceu de digitar a descrição';
        }else{
            $desc = mysqli_real_escape_string($dbc, trim($_POST['descricao']));
        }

        if(empty($erros)){

            
            //SQL de alteração
            $q="UPDATE genero SET descricao = '$desc' WHERE id = '$id'";

            $r= mysqli_query($dbc, $q);

            if($r){
                $sucesso ="<h1><b>Sucesso</b></h1>
                            <p>Seu registro foi alterado com sucesso!</p>
                            <p>Aguarde...Redirecionando!</p>";
                echo "<meta HTTP-EQUIV='refresh'
                    CONTENT='3;URL=genero_menu.php'>";
            } else {
                $erro="<h1><b>Erro no sistema</b></h1>
                 <p>Você não pode alterar o registro devido a um erro do sistema.
                 Pedimos desculpas por qualquer inconveniente.</p>";
                $erro .= "<p>" . mysqli_error($dbc) . "</p>";
            }
        }else{
            $erro = "<h1><b>Erro(s)!</b></h1>
            <p>Ocorreram o(s) seguinte(s) erro(s): <br />";
            foreach($erros as $msg){
                $erro .= "- $msg <br />";
            
            }
            $erro .= "<p>Por favor, tente novamente.</p>";
        }
    }

    //Pesquisa para exibir o registro para alteração
    $q = "SELECT * FROM genero where id =$id";
    $r = @mysqli_query($dbc,$q);

    if(mysqli_num_rows($r) == 1){
        $row = mysqli_fetch_array($r,MYSQLI_ASSOC);

    

?>
<div class="container-fluid">
  <div class="row">

  <?php include_once("menu_lateral.php")?>

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">genero - Alteração</h1>

        </div>

        <?php
            if(isset($erro))
            echo"<div class='alert alert-danger'>$erro</div>";

            if(isset($sucesso))
                echo"<div class='alert alert-success'>$sucesso</div>";
        ?>

        <form method="post" action="genero_alt.php">

        <div class="row">
            <div class="col-md-12 text-right">
            <a href="genero_menu.php" class="btn btn-secondary">
             Fechar sem salvar
            </a>
                <input type="submit" class="btn btn-warning" value="Salvar Alteração" />
            </div>
        </div>

            <div class="row">
                <div class="col-md-12 form-group">
                <label>Descrição</label>
                <input type="text" name="descricao" maxlength="50" class= "form-control" placeholder="Digite a descrição" value="<?php echo $row['descricao']?>" />
                </div>
            </div>

            <input type="hidden" name="enviou" value="true"/>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>

        </form>

    </main>
  </div>
</div>
  
<?php 
    }
mysqli_close($dbc);
include_once("rodape.php")

?>

