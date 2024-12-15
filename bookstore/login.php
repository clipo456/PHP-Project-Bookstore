<?php
    $titulo = "Livraria - Login";
 
    require_once("admin/conexao.php");
    include_once("cabecalho_site.php");
    
    include_once("menu_generos.php");
    
    ?>
    <script language="javascript">
    function valida_form(){
        if(document.form_entrega.txtemail1.value == ""){
            alert("Por favor, preencha o campo [Seu e-mail].");
            form_entrega.txtemail1.focus();
            return false;
        }
        if(document.form_entrega.textsenha1.value == ""){
            alert("Por favor, preencha o campo [Sua Senha].");
            form_entrega.txtsenha1.focus();
            return false;
        }
        return true;
    }
    function valida_form1(){
        if(document.form_cadastro.txtemail2.value == ""){
            alert("Por favor, preencha o campo [Seu e-mail].");
            form_cadastro.txtemail2.focus();
            return false;
        }
        return true;
    }
    

    
    </script>

    <h3>Etapa 1 - Identificação</h3>

    <div class="row">
        <div class="col-md-6">
        <h4>Já sou cadastrado</h4>
        <p>Para prosseguir, por favor, identifique-se utilizando os campos abaixo e depois clique no botão "Continuar"</p><br / >
        <form name="form_entrega" method="post" action="login1.php" onsubmit="return valida_form(this);">
        <p><label>Seu E-mail</label>
        <input name="txtemail1" type="text" /></p>
        <p><label>Sua Senha</label>
        <input type="password" name="txtsenha1" /></p>
        <input type="submit" class="btn btn-success" value="continuar">
        </form>
        </div>
        <div class="col-md-6">
            <h4>Quero Cadastrar</h4>
            <p>Caso esta seja sua primeira compra na Loja de Miniaturas, preencha o campo com seu e-mail e clique no botão "Continuar".</p><br />
            <form name="form_cadastro" method="post" action="cadastro.php" onsubmit="return valida_form1(this);">
            <p><label>Seu E-mail</label>
            <input name="txtemail2" type="text" /></p>
            <p><label>Sua Senha</label>
            <input type="text" name="txtsenha2" disabled="disabled" value="Será solicitado na próxima etapa"/></p>
            <input type="submit" class="btn btn-success" value="continuar">
        </div>    
    </div>