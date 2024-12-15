<?php 

$titulo = "Livraria - Admin Dashboard";

include_once("cabecalho.php");

require_once("conexao.php");

?>

<div class="container-fluid">
  <div class="row">

  <?php include_once("menu_lateral.php")?>

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

  <div class="row mt-3 ">
        <div class="col-md-12"> 
            <h2>Selecione uma das opções a esquerda para inserir e/ou alterar informações do banco de dados.</h2>
        </div>
  </div>

  <div class='row'>
            <ul class='pagination'>
                <?php if (isset($pag)) echo $pag; ?>
            </ul>
        </div>

    </main>
  </div>
</div>
  
<?php include_once("rodape.php")?>
