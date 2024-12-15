<?php
    $titulo = "Livraria - Cadastro";

    require_once("admin/conexao.php");
    include_once("cabecalho_site.php");
    
    include_once("menu_generos.php");

    //Inicia variavel erros
    if (isset($_POST['enviou'])){

        $erros = array();

        //Verifica se há um nome
        if(empty($_POST['txtnome'])){
            $erros[]='Você esqueceu de digitar o seu nome';
        }else{
            $nome = mysqli_real_escape_string($dbc, trim($_POST['txtnome']));
        }

        //Verifica se há um e-mail
        if(!empty($_POST['txtemail_1'])){
            if($_POST['txtemail_1'] != $_POST['txtemail_2']){
                $erros[] = 'Sua e-mail não corresponde a confirmação';
            }else {
                $email = mysqli_real_escape_string($dbc,trim($_POST['txtemail_1']));
            }
        }else {
            $erros[]= 'Você esqueceu de digitar seu email.';
        }

        //Verifica se há um endereço de e-mail
        if(empty($_POST['txtcpf'])){
            $erros[]='Você esqueceu de digitar o seu CPF';
        }else{
            $cpf = mysqli_real_escape_string($dbc, trim($_POST['txtcpf']));
        }

        //Verifica se há uma senha e testa confirmação
        if(!empty($_POST['txtsenha_1'])){
            if($_POST['txtsenha_1'] != $_POST['txtsenha_2']){
                $erros[] = 'Sua senha não corresponde a confirmação';
            }else {
                $senha = mysqli_real_escape_string($dbc,trim($_POST['txtsenha_1']));
            }
        }else {
            $erros[]= 'Você esqueceu de digitar sua senha.';
        }

        //Verifica se há um endereço de e-mail
        if(empty($_POST['txtend_nome'])){
            $erros[]='Você esqueceu de digitar o seu endereço';
        }else{
            $endnome = mysqli_real_escape_string($dbc, trim($_POST['txtend_nome']));
        }

        if(empty($_POST['txtend_num'])){
            $erros[]='Você esqueceu de digitar o numero do seu endereço';
        }else{
            $endnum = mysqli_real_escape_string($dbc, trim($_POST['txtend_num']));
        }

        if(empty($_POST['txtend_cep'])){
            $erros[]='Você esqueceu de digitar o seu cep';
        }else{
            $endcep = mysqli_real_escape_string($dbc, trim($_POST['txtend_cep']));
        }
        
        if(empty($_POST['txtend_cid'])){
            $erros[]='Você esqueceu de digitar o nome da sua cidade';
        }else{
            $endcid = mysqli_real_escape_string($dbc, trim($_POST['txtend_cid']));
        }

        if(empty($_POST['txtend_bai'])){
            $erros[]='Você esqueceu de digitar o nome da seu bairro';
        }else{
            $endbai = mysqli_real_escape_string($dbc, trim($_POST['txtend_bai']));
        }

        $endcomp = mysqli_real_escape_string($dbc, trim($_POST['txtend_comp']));
            $rg = mysqli_real_escape_string($dbc, trim($_POST['txtrg']));
            $sexo = mysqli_real_escape_string($dbc, trim($_POST['sexo']));
            $uf = mysqli_real_escape_string($dbc, trim($_POST['estado']));

        
        if(empty($erros)){

            
    
            //SQL de inserção
            $q="INSERT INTO cadcli (nome, email, senha,cpf,end_nome, end_num, cep, cidade, bairro, end_comp, sexo, uf, rg) VALUES('$nome', '$email', SHA1('cotip2022.$senha'),'$cpf','$endnome', '$endnum', '$endcep','$endcid','$endbai', '$endcomp', '$sexo', '$uf', '$rg')";

            $r= mysqli_query($dbc, $q);

            if($r){
                $sucesso ="<h1><b>Sucesso</b></h1>
                            <p>Seu registro foi incluido com sucesso!</p>
                            <p>Aguarde...Redirecionando!</p>";
                echo "<meta HTTP-EQUIV='refresh'
                    CONTENT='3;URL=cesta.php'>";

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
    <h3>Etapa 1 - Identificação</h3>
      <div class="row">
        <div class="col-md-12">
            <h4 class="text-danger"><?= $erro; ?></h4>
            <p>
                <a href="javascript:history.go(-1)" class="btn btn-primary">Voltar</a>
            </p>
        </div>
    </div>