<?php
    $titulo = "Livraria - Login";

    require_once("admin/conexao.php");
    include_once("cabecalho_site.php");
    
    include_once("menu_generos.php");

    //Inicia variavel erros
    $erro=0;

    //Captura dados enviados pelo método POST
    if($_POST['txtemail']<> ""){
        $email = $_POST['txtemail1'];
        $senha= $_POST['txtsenha1'];
    }

    //Verifica se o e-mail do cliente já está cadastrado
    $sql = "SELECT * FROM cadcli WHERE email = '" . $email . "'";
    $rs=mysqli_query($dbc,$sql);
    $total_registro = mysqli_num_rows($rs);

    if($total_registro == 0){
        $mensagem_erro = "E-mail não cadastrado.";
        $erro = 1;
    }

    //Verifica se o e-mail do cliente é valida
    if ($erro == 0){
    $sql = "SELECT * FROM cadcli WHERE senha = '" . $senha . "'";
    $rs=mysqli_query($dbc,$sql);
    $total_registro = mysqli_num_rows($rs);

    if($total_registro == 0){
        $mensagem_erro = "Senha Inválida.";
        $erro = $erro + 1;
    }

    //Recupera dados do cliente
    if($erro == 0){
        $sql = "SELECT * FROM cadcli WHERE email = '" . $email . "' AND senha = '" . $senha . "'";
        $rs = mysqli_query($dbc,$sql);
        $reg = mysqli_fetch_array($rs);

        //Armazena dados do cliente nas variações de sessão
        $_SESSION['id_cliente'] = $reg['id'];
        $_SESSION['email_cli'] = $reg['email'];
        $_SESSION['nome_cli'] = $reg['nome'];
        $_SESSION['cpf'] = $reg['cpf'];
        $_SESSION['rg'] = $reg['rg'];
        $_SESSION['sexo'] = $reg['sexo'];
        $_SESSION['end_nome'] = $reg['end_nome'];
        $_SESSION['end_num'] = $reg['end_num'];
        $_SESSION['end_comp'] = $reg['end_comp'];
        $_SESSION['cep'] = $reg['cep'];
        $_SESSION['bairro'] = $reg['bairro'];
        $_SESSION['cidade'] = $reg['cidade'];
        $_SESSION['uf'] = $reg['uf'];

        echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=cadastro1.php'>";

    }
}
    ?>
    <h3>Etapa 1 - Identificação</h3>
      <div class="row">
        <div class="col-md-12">
            <h4 class="text-danger"><?= $mensagem_erro; ?></h4>
            <p>
                <a href="javascript:history.go(-1)" class="btn btn-primary">Voltar</a>
            </p>
        </div>
    </div>