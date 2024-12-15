<?php
    require_once("admin/conexao.php");
    include_once("cabecalho_site.php");

    $produto = $_GET['produto'];

    $sql = "SELECT livros.*,genero.descricao FROM livros INNER JOIN genero ON genero.id = livros.id_genero WHERE livros.codigo = '" . $produto . "'";

    $rs = mysqli_query($dbc,$sql);
    $reg = mysqli_fetch_array($rs);

    $codigo = $reg["codigo"];
    $nome = $reg["nome"];
    $autor = $reg["autor"];
    $numero_pg = $reg["numero_pg"];
    $preco = $reg["preco"];
    $genero = $reg["descricao"];
    $capa = $reg["capa"];
    $desconto = $reg["desconto"];
    $desconto_boleto = $reg["desconto_boleto"];
    $max_parcelas = $reg["max_parcelas"];
    $dimensoes = $reg["dimensoes"];
    $editora = $reg["editora"];
    $idioma = $reg["idioma"];
    $publicacao = $reg["publicacao"];
    $estoque = $reg["estoque"];
    $min_estoque = $reg["min_estoque"];
    $valor_desconto = $preco - ($preco * $desconto)/100;
    $valor_boleto= $valor_desconto - ($valor_desconto * $desconto_boleto/100);
    ?>
    <script>
    function ampliar_imagem(url,nome_janela,parametros){
        window.open(url,nome_janela,parametros);
    }
    </script>

    <h4>Detalhes</h4>

    <div class="row">
        <div class="col-md-4">
            <a href="#">
                <img src="img/livros/<?=$codigo;?>G.jpg" class="img-fluid" onclick="ampliar_imagem('ampliar.php?codigo=<?=$codigo; ?>&nome=<?=$nome;?>',
                        '','width=540, height=355,top=50,left=50')">
                <img src="img/btn_ampliar1.gif" width="140px" height="16px">
            </a>
            <br />
            <h4>Detalhes</h4>
            Código: <b><?=$codigo;?></b><br />
            Gênero: <b><?=$genero;?></b><br />
            Editora: <b><?=$editora;?></b><br />
            Publicação: <b><?=$publicacao;?></b><br />
            Autor: <b><?=$autor;?></b><br />
            Idioma: <b><?=$idioma;?></b><br />
            Capa: <b><?=$capa;?></b><br />
            Número de páginas: <b><?=$numero_pg;?></b><br />
            Dimensões: <b><?=$dimensoes;?></b><br />
        </div>

        <div class="col-md-8 jumbotron">
            <div class="row">
                <div class="col-md-10">
                    <h3><b><?= $nome; ?></b></h3>
                    <s>de R$ <?= number_format($preco,2,',','.')?></s>
                    <h4>por R$ <?= number_format($valor_desconto, 2, ',', '.')?></h4>
                </div>
                <div class="col-md-2 pull-right">
                <?php if($estoque > $min_estoque){ ?>
                    <a href="cesta.php?produto=<?=$codigo; ?>&inserir=S" class="btn btn-success">Comprar</a>
                    <?php } else{ ?>
                    <img src="img/btn_comprar_nd.gif" hspace="5">
                    <?php } ?>
                </div>
            </div>
            <div class="row">
            
                        <div class="col-md-12"> 
                            <b>Parcelamento no Cartão de crédito</b>
                        </div>
            </div>
            <div class="row">
            <?php
                $col_esq = '';
                $col_dir= '';

                for($contador =1; $contador <= $max_parcelas; $contador++){
                     if($contador % 2 == 1){
                         $col_esq .= $contador . ' x de R% ' . number_format($valor_desconto/$contador, 2, ',', '.') . ' sem juros.<br />';
                     }else {
                         $col_dir .= $contador . ' x de R$ ' . number_format($valor_desconto/$contador, 2, ',','.') . ' sem juros.<br />';
                     }
                }
                ?>
                <div class="col-md-6">
                    <?=$col_esq; ?>
                </div>
                <div class="col-md-6">
                    <?=$col_dir; ?>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-md-12">
                * Pague com Bolento Bancário e ganhe + <?= number_format($desconto_boleto, 0,',','.'); ?>% de desconto: <b>R$ <?= number_format($valor_boleto,2,',','.');?>.<b><br />
                * Este Produto pode ser pago com cartão de crédito em até <b><?= $max_parcelas; ?></b> parcelas. <br /> <br />
                <b>Formas de pagamento</b><br />
                <img src="img/banner_formapag.jpg" width="297px" height="23px"/>
                <br /><br / >
                <b>Prazos de entrega</b><br />
                2 dias úteis para o estado de São Paulo.<br />
                5 dias úteis para os demais estados.<br /><br />
                <b>Observações</b><br />
                As mercadorias adquiridas serão despachadas, via Sedex, no primeiro dia útil após a comprovação de pagamento, estando a entrega condicionada a disponibilidade de estoque.<br />
                Prazo médio de entrega dos Correios: 24 à 72 horas.

                </div>
            </div>
        </div>
    </div>

    