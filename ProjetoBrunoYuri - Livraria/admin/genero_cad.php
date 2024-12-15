<?php 
    $titulo = "Livraria - Cadastro de gênero";
    include_once("cabecalho.php");
    
    if (isset($_POST['enviou'])){
        require_once("conexao.php");

        $erros = array();

        //verifica se há uma descrição
        if (empty($_POST['descricao'])){
            $erros[] = 'voce esqueceu de digitar a descrição';
        }else {
            $desc = mysqli_real_escape_string($dbc, trim($_POST['descricao']));
        }
        if (empty($erros)) {
        //SQL de inserção
        $q = "INSERT INTO genero (descricao)
        VALUES ('$desc')";

        $r = mysqli_query($dbc, $q);

            if($r){
                $sucesso = "<h1><b>Sucesso</b></h1>
                    <p>Seu registro foi incluido com sucesso!</p>
                    <p>Aguarde...Redirecionando!</P>";
                echo "<meta HTTP-EQUIV= 'refresh' 
                    CONTENT='1;URL=genero_menu.php'>";
            }else{
                $erro = "<h1><b>Erro no Sistema</b></h1>
                    <p>Você não pode cadastrar devido a um erro no sistema. 
                    Pedimos desculpas por qualquer incoveniente.</p>";
                $erro .= "<p>" . mysqli_error($dbc) . "</p>";
            }
        }else{
            $erro = "<h1><b>Erro(s)!</b></h1>
                <p>Ocorreram o(s) seguinte(s) eros(s): <br/>";
            foreach ($erros as $msg) {
                $erro .= "- $msg<br/>";
            }
            $erro .= "<p>Por favor, tente novamente.</p>";
        }
    }
?>

<div class="container-fluid">
  <div class="row">

  <?php include_once("menu_lateral.php"); ?>
  
  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gênero - Cadastro</h1>
      </div>

        <?php
            if(isset($erro))
                echo "<div class='alert alert-danger'>$erro</div>";

            if(isset($sucesso))
                echo "<div class='alert alert-success'>$sucesso</div>";
        ?>

      <form method="post" action="genero_cad.php">
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="genero_menu.php" class="btn btn-secondary">Fechar sem salvar</a>
                <input type="submit"
                    class="btn btn-primary"
                    value="salvar" />
             </div>   
        </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Descrição</label>
                    <input type="text" name="descricao" maxlength="50" class="form-control" placeholder="Digite a descrição" value="<?php if (isset($_POST['descricao'])) echo $_POST['descricao']; ?>"/>
                </div> 
            </div>

                <input type="hidden" name="enviou" value="true" />
        </form>
    </main>
  </div>
</div>

<?php include_once("rodape.php"); ?>