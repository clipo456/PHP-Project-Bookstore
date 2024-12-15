<?php
    $titulo = "Livraria - Cadastro";

    require_once("admin/conexao.php");
    include_once("cabecalho_site.php");
    
    include_once("menu_generos.php");

    ?>

    <form action="cadastro1.php" name="cadastro" method="POST">
        <div class="row">
            <div class="col-md-6 form-group">
            <h4 class="mt-3 ">Dados pessoais</h4>
            <label>Nome Completo <span class="text-danger"><b>*</b></span></label>
            <input type="text" class="form-control" name="txtnome" maxlength="60" placeholder="Digite seu nome completo" value="<?php if (isset($_POST['txtnome'])) echo $_POST['txtnome'];?>"/>
            <br />
            <label>CPF<span class="text-danger"><b>*</b></span></label>
            <input type="text" class="form-control" name="txtcpf" maxlength="11" placeholder="Digite seu CPF" value="<?php if (isset($_POST['txtcpf'])) echo $_POST['txtcpf'];?>"/>
            <br />
            <label>RG</label>
            <input type="text" class="form-control" name="txtrg" maxlength="14" placeholder="Digite seu RG" value="<?php if (isset($_POST['txtrg'])) echo $_POST['txtrg'];?>"/>
            <br />
            <label>Sexo</label>
            <select class="form-control" name="sexo">
                <option value="">Selecione...</option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
                <option value="O">Outro</option>
            </select>
            <br />
            <label>E-mail<span class="text-danger"><b>*</b></span></label>
            <input type="text" class="form-control" name="txtemail_1" maxlength="80" placeholder="Digite seu E-mail" value="<?php if (isset($_POST['txtemail_1'])) echo $_POST['txtemail_1'];?>"/>
            <br />
            <label>Confirmação de E-mail<span class="text-danger"><b>*</b></span></label>
            <input type="text" class="form-control" name="txtemail_2" maxlength="80" placeholder="Digite seu E-mail" value="<?php if (isset($_POST['txtemail_2'])) echo $_POST['txtemail_2'];?>"/>
            <br />
            <label>Senha<span class="text-danger"><b>*</b></span></label>
            <input type="password" class="form-control" name="txtsenha_1" maxlength="40" placeholder="Digite a sua senha" value="<?php if (isset($_POST['txtsenha_1'])) echo $_POST['txtsenha_1'];?>"/>
            <br />
            <label>Confimação de Senha<span class="text-danger"><b>*</b></span></label>
            <input type="password" class="form-control" name="txtsenha_2" maxlength="40" placeholder="Confirme a sua senha" value="<?php if (isset($_POST['txtsenha_2'])) echo $_POST['txtsenha_2'];?>" />
            <br />
            </div>
            <div class="col-md-6 form-group">
            <h4 class="mt-3 ">Endereço de entrega</h4>
            <label>Logradouro<span class="text-danger"><b>*</b></span></label>
            <input type="text" class="form-control" name="txtend_nome" maxlength="60" placeholder="Digite seu endereço" value="<?php if (isset($_POST['txtend_nome'])) echo $_POST['txtend_nome'];?>"/>
            <br />
            <label>Número<span class="text-danger"><b>*</b></span></label>
            <input type="text" class="form-control" name="txtend_num" maxlength="10" placeholder="Digite o número de seu endereço" value="<?php if (isset($_POST['txtend_num'])) echo $_POST['txtend_num'];?>"/>
            <br />
            <label>Complemento</label>
            <input type="text" class="form-control" name="txtend_comp" maxlength="20" placeholder="Digite o complemento de seu endereço" value="<?php if (isset($_POST['txtend_comp'])) echo $_POST['txtend_comp'];?>"/>
            <br />
            <label>Estado<span class="text-danger"><b>*</b></span></label>
            <select class="form-control" name="estado">
                <option value="">Selecione...</option>
            </select>
            <br />
            <label>CEP<span class="text-danger"><b>*</b></span></label>
            <input type="text" class="form-control" name="txtend_cep" maxlength="8" placeholder="Digite o CEP de seu endereço" value="<?php if (isset($_POST['txtend_cep'])) echo $_POST['txtend_cep'];?>"/>
            <br />
            <label>Cidade<span class="text-danger"><b>*</b></span></label>
            <input type="text" class="form-control" name="txtend_cid" maxlength="45" placeholder="Digite sua cidade" value="<?php if (isset($_POST['txtend_cid'])) echo $_POST['txtend_cid'];?>"/>
            <br />
            <label>Bairro<span class="text-danger"><b>*</b></span></label>
            <input type="text" class="form-control" name="txtend_bai" maxlength="40" placeholder="Digite o nome do bairro" value="<?php if (isset($_POST['txtend_bai'])) echo $_POST['txtend_bai'];?>"/>
            <br />
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Salvar" />
        <input type="hidden" name="enviou" value="true"/>
    </form>