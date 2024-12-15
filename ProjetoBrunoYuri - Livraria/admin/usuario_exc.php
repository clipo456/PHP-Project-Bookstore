<?php 

    $titulo = "Livraria - Exclusão de Usuários";

    include_once("cabecalho.php");

    if(isset($_GET['id']) && (is_numeric($_GET['id']))){
        $id = $_GET['id'];
    } else if (isset($_POST['id']) && (is_numeric($_POST['id']))){
        $id = $_POST['id'];
    } else {
          header("Location: usuario_menu.php");
        exit();
      }
     require_once("conexao.php");


    if (isset($_POST['enviou'])){

            //SQL de exclusão
            $q="DELETE FROM usuario WHERE id = '$id'";

            $r= mysqli_query($dbc, $q);

            if($r){
                $sucesso ="<h1><b>Sucesso</b></h1>
                            <p>Seu registro foi incluido com sucesso!</p>
                            <p>Aguarde...Redirecionando!</p>";
                echo "<meta HTTP-EQUIV='refresh'
                    CONTENT='3;URL=usuario_menu.php'>";
            } else {
                $erro="<h1><b>Erro no sistema</b></h1>
                 <p>Você não pode ser registrado devido a um erro do sistema.
                 Pedimos desculpas por qualquer inconveniente.</p>";
                $erro .= "<p>" . mysqli_error($dbc) . "</p>";
            }
        }
    

    //Pesquisa para exibir o registro para exclusão
    $q = "SELECT * FROM usuario where id =$id";
    $r = @mysqli_query($dbc,$q);

    if(mysqli_num_rows($r) == 1){
        $row = mysqli_fetch_array($r,MYSQLI_ASSOC);

    

?>
<div class="container-fluid">
  <div class="row">

  <?php include_once("menu_lateral.php")?>

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Usuário - Exclusão</h1>

        </div>

        <?php
            if(isset($erro))
            echo"<div class='alert alert-danger'>$erro</div>";

            if(isset($sucesso))
                echo"<div class='alert alert-success'>$sucesso</div>";
        ?>

        <form method="post" action="usuario_exc.php">

        <div class="row">
            <div class="col-md-12 text-right">
            <a href="usuario_menu.php" class="btn btn-secondary">
             Fechar sem salvar
            </a>
                <input type="submit" class="btn btn-danger" value="Excluir" />
            </div>
        </div>

            <div class="row">
                <div class="col-md-4 form-group">
                <label>Primeiro nome</label>
                <input type="text" name="p_nome" maxlength="20" class= "form-control" placeholder="Digite o primeiro nome" value="<?php echo $row['p_nome']?>" disabled />
                </div>    

                <div class="col-md-8 form-group">
                <label>Ultimo nome</label>
                <input type="text" name="u_nome" maxlength="40" class= "form-control" placeholder="Digite o ultimo nome" value="<?php echo $row['u_nome']?>" disabled />
                </div>    
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                <label>Endereço de e-mail</label>
                <input type="email" name="email" maxlength="80" class= "form-control" placeholder="Digite o seu e-mail" value="<?php echo $row['email']?>" disabled />
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

