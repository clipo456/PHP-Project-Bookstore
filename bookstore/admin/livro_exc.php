<?php 

    $titulo = "Livraria - Exclusão de livros";

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

            //SQL de exclusão
            $q="DELETE FROM livros WHERE id = '$id'";

            $r= mysqli_query($dbc, $q);

            if($r){
                $sucesso ="<h1><b>Sucesso</b></h1>
                            <p>Seu registro foi excluido com sucesso!</p>
                            <p>Aguarde...Redirecionando!</p>";
                echo "<meta HTTP-EQUIV='refresh'
                    CONTENT='1;URL=livro_menu.php'>";
            } else {
                $erro="<h1><b>Erro no sistema</b></h1>
                 <p>Você não pode alterar o registro devido a um erro do sistema.
                 Pedimos desculpas por qualquer inconveniente.</p>";
                $erro .= "<p>" . mysqli_error($dbc) . "</p>";
            }
        }
    

    //Pesquisa para exibir o registro para exclusão
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
        <h1 class="h2">livro - Exclusão</h1>

        </div>

        <?php
            if(isset($erro))
            echo"<div class='alert alert-danger'>$erro</div>";

            if(isset($sucesso))
                echo"<div class='alert alert-success'>$sucesso</div>";
        ?>

        <form method="post" action="livro_exc.php">

        <div class="row">
            <div class="col-md-12 text-right">
            <a href="livro_menu.php" class="btn btn-secondary">
             Fechar sem salvar
            </a>
                <input type="submit" class="btn btn-danger" value="Excluir" />
            </div>
        </div>

        <div class="row">
                <div class="col-md-8 form-group">
                <label>Título</label>
                <input type="text" name="nome" maxlength="80" class= "form-control" placeholder="Digite o nome" value="<?php echo $row['nome']?>" disabled />
                </div>    

            <div class="col-md-4">
                    <div class= "form-check">
                        <label>Destaque</label></br>
                        <input type="radio" class="form-check-input" name="estatus" id="flexRadioDefault2" value="S" <?php echo $row['destaque']?> disabled />
                        <label class="form-check-label"for="flexRadioDefault2">Sim</label></br>
                        <input type="radio" class="form-check-input" name="estatus" id="flexRadioDefault2" value="N" <?php echo $row['destaque']?> disabled />
                        <label class="form-check-label"for="flexRadioDefault2">Não</label></br>
                    </div>
                </div>   
            </div>

            <div class="row">
                <div class="col-md-5 form-group">
                    <label>Gênero</label>
                    <select name="id_genero" class="form-control" disabled>
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
                        <input type="text" name="autor" maxlength="50" class= "form-control" placeholder="Digite o autor da obra" value="<?php echo $row['autor']?>" disabled/>
                </div>    
                  
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                <label>Número de páginas</label>
                <input type="number" min="1" name="numero_pg" maxlength="30" class= "form-control" placeholder="Digite a quantidade de páginas" value="<?php echo $row['numero_pg']?>" disabled/>
                </div>   
            
                <div class="col-md-4 form-group">
                <label>Dimensões</label>
                <input type="text" name="dimensoes" maxlength="30" class= "form-control" placeholder="Digite as dimensões do livro (a X b X c)" value="<?php echo $row['dimensoes']?>" disabled/>
                </div>

                <div class="col-md-4 form-group">
                <label>Capa</label>
                <input type="text" name="capa" maxlength="30" class= "form-control" placeholder="Digite o tipo de capa" value="<?php echo $row['capa']?>" disabled/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                <label>Editora</label>
                <input type="text" name="editora" maxlength="30" class= "form-control" placeholder="Digite a editora" value="<?php echo $row['editora']?>" disabled/>
                </div>

                <div class="col-md-4 form-group">
                <label>Idioma</label>
                <input type="text" name="idioma" maxlength="30" class= "form-control" placeholder="Digite o idioma" value="<?php echo $row['idioma']?>" disabled/>
                </div>

                <div class="col-md-4 form-group">
                <label>Publicação</label>
                <input type="date" name="publicacao" maxlength="4" class= "form-control" placeholder="Selecione a data de publicação" value="<?php echo $row['publicacao']?>" disabled/>
                </div>  
                
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                <label>Preço</label>
                <input type="text" name="preco" maxlength="30" class= "form-control" placeholder="Digite o preço" value="<?php echo $row['preco']?>" disabled/>
                </div>

                <div class="col-md-4 form-group">
                <label>Desconto</label>
                <input type="text" name="desconto" maxlength="30" class= "form-control" placeholder="Digite o desconto" value="<?php echo $row['desconto']?>" disabled/>
                </div>

                <div class="col-md-4 form-group">
                <label>Desconto no Boleto</label>
                <input type="text" name="descontob" maxlength="30" class= "form-control" placeholder="Digite o desconto no boleto" value="<?php echo $row['desconto_boleto']?>" disabled/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                <label>Máximo de parcelas</label>
                <input type="select" name="maxp" maxlength="30" class= "form-control" placeholder="Seleciono o número máximo de parcelas" disabled />
                </div>

                <div class="col-md-4 form-group">
                <label>Estoque</label>
                <input type="text" name="estq" maxlength="30" class= "form-control" placeholder="Digite o estoque" value="<?php echo $row['estoque']?>" disabled/>
                </div>

                <div class="col-md-4 form-group">
                <label>Estoque mínimo</label>
                <input type="text" name="estqmin" maxlength="30" class= "form-control" placeholder="Digite o estoque mínimo" value="<?php echo $row['min_estoque']?>" disabled/>
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

