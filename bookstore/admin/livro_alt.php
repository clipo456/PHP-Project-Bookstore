<?php 

    $titulo = "Livraria - Alteração de livros";

    include_once("cabecalho.php");

    if(isset($_GET['id']) && (is_numeric($_GET['id']))){
        $id = $_GET['id'];
    } else if (isset($_POST['id']) && (is_numeric($_POST['id']))){
        $id = $_POST['id'];
    } else {
          header("Location: livro_menu.php");
        exit();
      }
     require_once("conexao.php");
    if (isset($_POST['enviou'])){

        $erros = array();

        //Verifica se há um nome
        if(empty($_POST['nome'])){
            $erros[]='Você esqueceu de digitar o Título';
        }else{
            $nome = mysqli_real_escape_string($dbc, trim($_POST['nome']));
        }

        //Verifica se há um autor
        if(empty($_POST['autor'])){
            $erros[]='Você esqueceu de digitar o autor';
        }else{
            $autor = mysqli_real_escape_string($dbc, trim($_POST['autor']));
        }

        //Verifica se há um n de páginas
        if(empty($_POST['numero_pg'])){
            $erros[]='Você esqueceu de digitar a quantidade de páginas';
        }else{
            $numero_pg = mysqli_real_escape_string($dbc, trim($_POST['numero_pg']));
        }

        //Verifica se há dimensões
        if(empty($_POST['dimensoes'])){
            $erros[]='Você esqueceu de digitar as dimensões';
        }else{
            $dimensoes = mysqli_real_escape_string($dbc, trim($_POST['dimensoes']));
        }

        //Verifica se há uma capa
        if(empty($_POST['capa'])){
            $erros[]='Você esqueceu de digitar a capa';
        }else{
            $capa = mysqli_real_escape_string($dbc, trim($_POST['capa']));
        }

        //Verifica se há uma editora
        if(empty($_POST['editora'])){
            $erros[]='Você esqueceu de digitar a Editora';
        }else{
            $editora = mysqli_real_escape_string($dbc, trim($_POST['editora']));
        }
        
        //Verifica se há um idioma
        if(empty($_POST['idioma'])){
            $erros[]='Você esqueceu de digitar o idioma';
        }else{
            $idioma = mysqli_real_escape_string($dbc, trim($_POST['idioma']));
        }

        //Verifica se há uma data de publicacao
        if(empty($_POST['publicacao'])){
            $erros[]='Você esqueceu de digitar a data publicação';
        }else{
            $publicacao = mysqli_real_escape_string($dbc, trim($_POST['publicacao']));
        }

        //Verifica se há um preço
        if(empty($_POST['preco'])){
            $erros[]='Você esqueceu de digitar o preço';
        }else{
            $preco = mysqli_real_escape_string($dbc, trim($_POST['preco']));
        }
        
        //Verifica se há um desconto
        if(empty($_POST['desconto'])){
            $desconto=0;
        }else{
            $desconto = mysqli_real_escape_string($dbc, trim($_POST['desconto']));
        }

        //Verifica se há um desconto no boleto
        if(empty($_POST['descontob'])){
            $descontob=0;
        }else{
            $descontob = mysqli_real_escape_string($dbc, trim($_POST['descontob']));
        }

        //Verifica se há um maximo de parcelas
        if(empty($_POST['maxp'])){
            $erros[]='Você esqueceu de digitar o número máximo de parcelas';
        }else{
            $maxp = mysqli_real_escape_string($dbc, trim($_POST['maxp']));
        }

        //Verifica se há um estoque
        if(empty($_POST['estq'])){
            $erros[]='Você esqueceu de digitar o estoque';
        }else{
            $estq = mysqli_real_escape_string($dbc, trim($_POST['estq']));
        }

        //Verifica se há um estoque mínimo
        if(empty($_POST['estqmin'])){
            $erros[]='Você esqueceu de digitar o estoque mínimo';
        }else{
            $estqmin = mysqli_real_escape_string($dbc, trim($_POST['estqmin']));
        }   

        //Verifica se há um status
        if(empty($_POST['estatus'])){
            $erros[]='Você esqueceu de escolher a opção de destaque';
        }else{
            $estatus = mysqli_real_escape_string($dbc, trim($_POST['estatus']));
        }


        if(empty($erros)){

            
            //SQL de alteração
            $q="UPDATE livros SET nome ='$nome', autor = '$autor', numero_pg = '$numero_pg',dimensoes = '$dimensoes', capa = '$capa', editora = '$editora', idioma ='$idioma' , publicacao  = '$publicacao', preco = '$preco', max_parcelas ='$maxp', estoque = '$estq', min_estoque = '$estqmin', destaque ='$estatus' WHERE id='$id'";

            $r= mysqli_query($dbc, $q);

            if($r){
                $sucesso ="<h1><b>Sucesso</b></h1>
                            <p>Seu registro foi alterado com sucesso!</p>
                            <p>Aguarde...Redirecionando!</p>";
                echo "<meta HTTP-EQUIV='refresh'
                    CONTENT='3;URL=livro_menu.php'>";
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
    $q = "SELECT * FROM livros where id =$id";
    $r = @mysqli_query($dbc,$q);

    if(mysqli_num_rows($r) == 1){
        $row = mysqli_fetch_array($r,MYSQLI_ASSOC);

    

?>
<div class="container-fluid">
  <div class="row">

  <?php include_once("menu_lateral.php")?>

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Livros - Alteração</h1>

        </div>

        <?php
            if(isset($erro))
            echo"<div class='alert alert-danger'>$erro</div>";

            if(isset($sucesso))
                echo"<div class='alert alert-success'>$sucesso</div>";
        ?>

        <form method="post" action="livro_alt.php">

        <div class="row">
            <div class="col-md-12 text-right">
            <a href="livro_menu.php" class="btn btn-secondary">
             Fechar sem salvar
            </a>
                <input type="submit" class="btn btn-warning" value="Salvar Alteração" />
            </div>
        </div>

        
            <div class="row">
                <div class="col-md-8 form-group">
                <label>Título</label>
                <input type="text" name="nome" maxlength="80" class= "form-control" placeholder="Digite o nome" value="<?php echo $row['nome']?>" />
                </div>    

            <div class="col-md-4">
                    <div class= "form-check">
                        <label>Destaque</label></br>
                        <input type="radio" class="form-check-input" name="estatus" id="flexRadioDefault2" value="S" <?php echo $row['destaque']?> />
                        <label class="form-check-label"for="flexRadioDefault2">Sim</label></br>
                        <input type="radio" class="form-check-input" name="estatus" id="flexRadioDefault2" value="N" <?php echo $row['destaque']?> />
                        <label class="form-check-label"for="flexRadioDefault2">Não</label></br>
                    </div>
                </div>   
            </div>

            <div class="row">
                <div class="col-md-5 form-group">
                    <label>Gênero</label>
                    <select name="id_genero" class="form-control">
                        <option value="0">Selecione uma categoria</option>
                        <?php 
                            $linha='';
                            require_once("conexao.php");
                            $sql_categoria = "SELECT id, descricao FROM genero ORDER BY descricao";
                            $res = @mysqli_query($dbc,$sql_categoria);
                            while ($item = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                $linha .= "<option value='". $item['id'] . "'>" . $item['descricao'] . "</option>";
                            }
                            echo $linha;
                        ?>
                    </select>
                </div>

                <div class="col-md-3 form-group">
                        <label>Autor</label>
                        <input type="text" name="autor" maxlength="50" class= "form-control" placeholder="Digite o autor da obra" value="<?php echo $row['autor']?>"/>
                </div>    
                  
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                <label>Número de páginas</label>
                <input type="number" min="1" name="numero_pg" maxlength="30" class= "form-control" placeholder="Digite a quantidade de páginas" value="<?php echo $row['numero_pg']?>"/>
                </div>   
            
                <div class="col-md-4 form-group">
                <label>Dimensões</label>
                <input type="text" name="dimensoes" maxlength="30" class= "form-control" placeholder="Digite as dimensões do livro (a X b X c)" value="<?php echo $row['dimensoes']?>"/>
                </div>

                <div class="col-md-4 form-group">
                <label>Capa</label>
                <input type="text" name="capa" maxlength="30" class= "form-control" placeholder="Digite o tipo de capa" value="<?php echo $row['capa']?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                <label>Editora</label>
                <input type="text" name="editora" maxlength="30" class= "form-control" placeholder="Digite a editora" value="<?php echo $row['editora']?>"/>
                </div>

                <div class="col-md-4 form-group">
                <label>Idioma</label>
                <input type="text" name="idioma" maxlength="30" class= "form-control" placeholder="Digite o idioma" value="<?php echo $row['idioma']?>"/>
                </div>

                <div class="col-md-4 form-group">
                <label>Publicação</label>
                <input type="date" name="publicacao" maxlength="4" class= "form-control" placeholder="Selecione a data de publicação" value="<?php echo $row['publicacao']?>"/>
                </div>  
                
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                <label>Preço</label>
                <input type="text" name="preco" maxlength="30" class= "form-control" placeholder="Digite o preço" value="<?php echo $row['preco']?>"/>
                </div>

                <div class="col-md-4 form-group">
                <label>Desconto</label>
                <input type="text" name="desconto" maxlength="30" class= "form-control" placeholder="Digite o desconto" value="<?php echo $row['desconto']?>"/>
                </div>

                <div class="col-md-4 form-group">
                <label>Desconto no Boleto</label>
                <input type="text" name="descontob" maxlength="30" class= "form-control" placeholder="Digite o desconto no boleto" value="<?php echo $row['desconto_boleto']?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                <label>Máximo de parcelas</label>
                <input type="select" name="maxp" maxlength="30" class= "form-control" placeholder="Seleciono o número máximo de parcelas" />
                </div>

                <div class="col-md-4 form-group">
                <label>Estoque</label>
                <input type="text" name="estq" maxlength="30" class= "form-control" placeholder="Digite o estoque" value="<?php echo $row['estoque']?>"/>
                </div>

                <div class="col-md-4 form-group">
                <label>Estoque mínimo</label>
                <input type="text" name="estqmin" maxlength="30" class= "form-control" placeholder="Digite o estoque mínimo" value="<?php echo $row['min_estoque']?>"/>
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
