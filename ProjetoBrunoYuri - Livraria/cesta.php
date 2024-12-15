<?php
    $titulo = "Livraria - Cesta de Compras";

    require_once("admin/conexao.php");
    include_once("cabecalho_site.php");
    
    include_once("menu_generos.php");

    //Recupera valores passados pela página detalhes
    $produto = isset($_GET['produto']) ? $_GET['produto'] : '';
    //Inserir = S - Adicionado pelo botão comprar
    $inserir = isset($_GET['inserir']) ? $_GET['inserir'] : '';

    //qt = 1 default para quantidade
    $qt = 1;

    //Captura o ultimo ID da tabela pedido
    $sql = "SELECT id, status FROM pedidos ORDER BY id DESC";
    $rs = mysqli_query($dbc, $sql);
    $reg = mysqli_fetch_array($rs);
    $id = $reg['id'];
    $status = $reg['status'];

    //Insere um registro na tabela pedidos com o número do pedido
    if(empty($_SESSION['num_ped']) && $inserir == 'S'){
        //Incrementa 1 ao ultimo id
        $id_pedido = $id + 1;

        //prepara o número do pedido
        //(id, hora e primeiro digito do minuto)
        $num_ped = $id_pedido . "." . date("H") . substr(date("i"), 0 ,1);
        $_SESSION['num_ped'] = $num_ped;
        $_SESSION['id_ped'] = $id_pedido;
        $_SESSION['num_boleto'] = $id_pedido . date("H") . substr(date("i"), 0 ,1);

        $sqli = "INSERT INTO pedidos (num_ped, status) VALUES ('$num_ped', 'Em andamento')";
        mysqli_query($dbc, $sqli);
        $_SESSION['status'] = 'Em andamento';
    }

    //Excluir item do carrinho
    $excluir = isset($_GET['excluir']) ? $_GET['excluir'] : '';
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    if($excluir == "S") {
        $sqld = "DELETE FROM itens WHERE id = '" . $id . "'";
        mysqli_query($dbc,$sqld);
    }

    //Captura dados do produto selecionado 
    $sql = "SELECT id, codigo, nome, preco, desconto, desconto_boleto FROM livros WHERE codigo = '" . $produto . "'";
    $rs = mysqli_query($dbc, $sql);
    $reg = mysqli_fetch_array($rs);

    $codigo = isset($reg["codigo"]) ? $reg["codigo"] : '';
    $nome = isset($reg["nome"]) ? $reg["nome"] : '';
    $preco = isset($reg["preco"]) ? $reg["preco"] : 0;
    $desconto = isset($reg["desconto"]) ? $reg["desconto"] : 0;
    $desconto_boleto= isset($reg["desconto_boleto"]) ? $reg["desconto_boleto"] : 0;
    $preco_desconto = $preco - ($preco * $desconto /100);
    $preco_boleto = $preco_desconto - ($preco_desconto * $desconto_boleto /100);
    $num_ped = $_SESSION['num_ped'];

    //Verifica se o item já se encontra n ocarrinh
    $sql_dp = "SELECT codigo FROM itens WHERE codigo = '" . $produto . "'AND num_ped = '" . $num_ped . "'";
    $rs_dp = mysqli_query($dbc,$sql_dp);
    $item_duplicado = mysqli_num_rows($rs_dp);

    //Adiciona o produto na tabela de itens somente se 
    //$item_duplicado for igual a 0
    if($item_duplicado == 0 && $inserir == "S"){
        $sqli = "INSERT INTO itens VALUES(0, '$num_ped', '$codigo', '$nome', '$qt', '$preco_desconto', '$preco_boleto', '$desconto', '$desconto_boleto')";
        mysqli_query($dbc,$sqli);
    }

    //Atualiza itens do carrinho de acordo com os valores
    //Digitados no campo "quantidade de cada item"
    $atualiza=isset($_GET['atualiza']) ? $_GET['atualiza'] : '';

    if($atualiza == "S"){
        for($contador =1;  $contador <= $_SESSION['total_itens']; $contador++){
            $b[$contador] = $_POST['txt'.$contador];
            $c[$contador] = $_POST['id'.$contador];
            $sqla = "UPDATE itens SET qt= '" . $b[$contador] . " 'WHERE id = '" . $c[$contador]. "'";
            mysqli_query($dbc, $sqla);
        }
    }

    //Captura os itens adicionados ao carrinho para serem exibidos na pagina
    $sql= "SELECT * FROM itens WHERE num_ped = '" . $num_ped . "'ORDER BY id";
    $rs = mysqli_query($dbc, $sql);
    $total_itens = mysqli_num_rows($rs);
    $_SESSION['total_itens'] = $total_itens;

    ?>

    <!--Exibe os itens do carrinho-->

    <form name ="cesta" method="post" action="cesta.php?atualiza=S" onsubmit="return valida_form(this);">
    
    <table class="table table-striped table-responsive">
    <thead>
        <tr>
        <th>Descrição</th>
        <th width="10%" align="center">Quantidade</th>
        <th width="10%" align="center">Excluir item</th>
        <th width="15%" align="right">Preço unitário R$</th>
        <th width="15%" align="right">Total R$</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $subtotal = 0;
        $n = 0;
        while ($reg = mysqli_fetch_array($rs)) {
            $n = $n + 1;
            $id = $reg["id"];
            $codigo= $reg["codigo"];
            $nome = $reg["nome"];
            $qt = $reg["qt"];
            $preco_unitario = $reg["preco"];
            $preco_total = $preco_unitario * $qt;
            $subtotal = $subtotal + $preco_total;
            ?>
            <tr>
            <td><img src="img/livros/<?= $codigo; ?>.jpg" width="53x" height="32px" align="absmiddle" />&nbsp;&nbsp;&nbsp; 
            <?= $codigo; ?> - <?= $nome; ?>
            </td>
            <td>
                <input name="txt<?= $n; ?>"  value="<?= $qt; ?>" type="text" size="2" maxlength="6" /> 
            </td>
            <td>
                <a href="cesta.php?id=<?= $id; ?>&excluir=S"><img src="img/btn_removerItem.gif" hspace="5" border="0"/></a>
            </td>
            <td align="right">R$<?= number_format($preco_unitario, 2, ',',  '.');?>
            </td>
            <td align="right">R$<?= number_format($preco_total, 2, ',',  '.');?>
            </td>
            <input type="hidden" name="id<?= $n; ?>" value="<?= $id; ?>">
            <input type="hidden" name="cod<?= $n; ?>" value="<?= $codigo; ?>">
            </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="3">* O valor total da sua compra não inclui o frete, ele será calculado no fechamento do seu pedido.</td>
            <td align="right"><b>Subtotal</b></td>
            <td align="right"><b>R$ <?= number_format($subtotal, 2, ',', '.'); ?> 
            </td></b>
        </tr>
        <tr>
            <td colspan="4"><a href="index.php" class="btn btn-primary" value="">Comprar mais produtos</a>
            <input name="atualizaValores" type="submit" class="btn btn-secondary" value="Atualiza Valores" onsubmit="return valida_form(this);" />
            </td>
            <td>
                <a href="login.php" class="btn btn-success">Fechar pedido</a>
            </td>
        </tr>  
    </tbody>
    </table>
    
    
    
    
    </form>

    <script language="javascript">
        function valida_form(){
             <?php
             for ($contador=1; 
             $contador <= $_SESSION['total_itens'];
             $contador++) { ?>
             if(document.cesta.txt<?=$contador; ?>.value < 1) {
                 alert("O campo quantidade não pode ser menor que 1;");
                 document.cesta.txt<?= $contador; ?>.focus();
                 return false;
             }
             if(document.cesta.txt<?=$contador; ?>.value > 10) {
                 alert("O campo quantidade não pode ser maior que 10;");
                 document.cesta.txt<?= $contador; ?>.focus();
                 return false;
             }
             <?php } ?> 
             return true;
        }
     </script>