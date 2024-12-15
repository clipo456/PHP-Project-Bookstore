<?php 
    require_once("admin/conexao.php");
    include_once("cabecalho_site.php");

    $ordenar = isset($_GET['ordenar']);
    if($ordenar ==""){
        $ordenar = "preco DESC";
    }else{
        $ordenar= $_GET['ordenar'];
    }



    //Seleciona as ofertas em destaque e ordena
    $q = "SELECT * FROM livros WHERE destaque = 'S' ORDER BY " . $ordenar;
    $r = mysqli_query($dbc, $q);
    $total_registros = mysqli_num_rows($r);

    include_once("menu_generos.php");
?>

<script>
    function ampliar_imagem(url,nome_janela,parametros){
        window.open(url,nome_janela,parametros);
    }
</script>
<div class="row">
    <div class="col-md-12">
        <img src="img/pexels-element-digital-1370295.jpg" width="1200px" class="img-fluid">
    </div>
</div>

<div class="row">
<div class="col-md-8">
    <h5>Destaques [Total de itens em destaque: <?=$total_registros; ?>]</h5>
</div>
<div class="col-md-4">
    <span class="h5 pull-right">
        Ordenar por:
        <?php if ($ordenar == "preco ASC") { ?>
        <span class="badge badge-pill badge-secondary">Menor preço</span>
        <a href="index.php?ordenar=preco DESC">Maior preço</a>
        <?php } else{ ?>
        <a href="index.php?ordenar=preco ASC">Menor preço</a>
        <span class="badge badge-pill badge-secondary">Maior preço</span>
        <?php } ?>
        </span>
</div>
</div>
<br />
<?php 
    for($contador = 0; $contador < $total_registros; $contador++){
        $reg = mysqli_fetch_array($r,MYSQLI_ASSOC);
        $codigo = $reg["codigo"];
        $nome = $reg["nome"];
        $estoque = $reg["estoque"];
        $min_estoque = $reg["min_estoque"];
        $preco = $reg["preco"];
        $desconto = $reg["desconto"];   
        $valor_desconto = $preco - ($preco * $desconto /100);

        //Exibe dados da coluna da esquerda
        if($contador % 2==0){
            ?>
            <div class="row">
                <div class="col-md-2">
                    <a href="#">
                        <img src="img/livros/<?=$codigo;?>.jpg" width="100px" height="100px" onclick="ampliar_imagem('ampliar.php?codigo=<?=$codigo; ?>&nome=<?=$nome;?>',
                        '','width=540, height=355,top=50,left=50')">
                        <img src="img/btn_ampliar1.gif" width="140px" height="16px">
                    </a>
                </div>
                <div class="col-md-4">
                    <b><?=$nome; ?></b><br />
                    <s>de R$ <?php echo number_format($preco, 2,',','.')?></s><br />
                    Por: <b>R$
                    <?php echo number_format($valor_desconto, 2,',','.')?></b><br />
                    <a href="detalhes.php?produto=<?= $codigo; ?>" class="btn btn-sm btn-success">Mais Detalhes</a>
                    <?php if($estoque < $min_estoque) { ?>
                    <img src="img/btn_detalhes_nd.gif" vspace="5" border="0"> <?php } ?> <br/ > <br />
                </div>
                <?php } else { ?>
                    <div class="col-md-2">
                    <a href="#">
                        <img src="img/livros/<?=$codigo;?>.jpg" width="100px" height="100px" onclick="ampliar_imagem('ampliar.php?codigo=<?=$codigo; ?>&nome=<?=$nome;?>',
                        '','width=540, height=355,top=50,left=50')">
                        <img src="img/btn_ampliar1.gif" width="140px" height="16px">
                    </a>
                </div>
                <div class="col-md-4">
                    <b><?=$nome; ?></b><br />
                    <s>de R$ <?php echo number_format($preco, 2,',','.')?></s><br />
                    Por: <b>R$
                    <?php echo number_format($valor_desconto, 2,',','.')?></b><br />
                    <a href="detalhes.php?produto=<?= $codigo; ?>" class="btn btn-sm btn-success">Mais Detalhes</a>
                    <?php if($estoque < $min_estoque) { ?>
                    <img src="img/btn_detalhes_nd.gif" vspace="5" border="0"> <?php } ?> <br/ > <br />
                </div>
            </div>
            <?php
        }
    }
   ?>



<?php 
    include_once("rodape_site.php");
?>

