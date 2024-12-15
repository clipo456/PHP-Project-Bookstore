<?php 

    $titulo = "Livraria - Cadastro de Usuário";

    include_once("cabecalho.php");

    if (isset($_POST['enviou'])){

        require_once("conexao.php");

        $erros = array();

        //Verifica se há um primeiro nome
        if(empty($_POST['p_nome'])){
            $erros[]='Você esqueceu de digitar o seu primeiro nome';
        }else{
            $pn = mysqli_real_escape_string($dbc, trim($_POST['p_nome']));
        }

        //Verifica se há um ultimo nome
        if(empty($_POST['u_nome'])){
            $erros[]='Você esqueceu de digitar o seu último nome';
        }else{
            $un = mysqli_real_escape_string($dbc, trim($_POST['u_nome']));
        }

        //Verifica se há um endereço de e-mail
        if(empty($_POST['email'])){
            $erros[]='Você esqueceu de digitar o seu e-mail';
        }else{
            $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
        }

        //Verifica se há uma senha e testa confirmação
        if(!empty($_POST['pass1'])){
            if($_POST['pass1'] != $_POST['pass2']){
                $erros[] = 'Sua senha não corresponde a confirmação';
            }else {
                $p = mysqli_real_escape_string($dbc,trim($_POST['pass1']));
            }
        }else {
            $erros[]= 'Você esqueceu de digitar sua senha.';
        }

        if(empty($erros)){

        
            //SQL de inserção
            $q="INSERT INTO usuario (p_nome, u_nome, email,pass,data_reg) VALUES('$pn', '$un', '$e', SHA1('cotip2022.$p'), NOW())";

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
        }else{
            $erro = "<h1><b>Erro(s)!</b></h1>
            <p>Ocorreram o(s) seguinte(s) erro(s): <br />";
            foreach($erros as $msg){
                $erro .= "- $msg <br />";
            
            }
            $erro .= "<p>Por favor, tente novamente.</p>";
        }
    }

?>
<div class="container-fluid">
  <div class="row">

  <?php include_once("menu_lateral.php")?>

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Usuário - Cadastro</h1>

        </div>

        <?php
            if(isset($erro))
            echo"<div class='alert alert-danger'>$erro</div>";

            if(isset($sucesso))
                echo"<div class='alert alert-success'>$sucesso</div>";
        ?>

        <form method="post" action="usuario_cad.php">

        <div class="row">
            <div class="col-md-12 text-right">
            <a href="usuario_menu.php" class="btn btn-secondary">
             Fechar sem salvar
            </a>
                <input type="submit" class="btn btn-primary" value="Salvar" />
            </div>
        </div>

            <div class="row">
                <div class="col-md-4 form-group">
                <label>Primeiro nome</label>
                <input type="text" name="p_nome" maxlength="20" class= "form-control" placeholder="Digite o primeiro nome" value="<?php if (isset($_POST['p_nome'])) echo $_POST['p_nome']; ?>" />
                </div>    

                <div class="col-md-4 form-group">
                <label>Ultimo nome</label>
                <input type="text" name="u_nome" maxlength="40" class= "form-control" placeholder="Digite o ultimo nome" value="<?php if (isset($_POST['u_nome'])) echo $_POST['u_nome']; ?>"/>
                </div>    
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                <label>Endereço de e-mail</label>
                <input type="email" name="email" maxlength="80" class= "form-control" placeholder="Digite o seu e-mail" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/>
                </div>    
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                <label>Senha</label>
                <input type="password" name="pass1" maxlength="80" class= "form-control" placeholder="Digite uma senha"/>
                </div>    

                <div class="col-md-4 form-group">
                <label>Confirme a senha</label>
                <input type="password" name="pass2" maxlength="80" class= "form-control" placeholder="Digite uma senha"/>
                </div>    
            </div>

            <input type="hidden" name="enviou" value="true"/>

        </form>

    </main>
  </div>
</div>
  
<?php include_once("rodape.php")?>

