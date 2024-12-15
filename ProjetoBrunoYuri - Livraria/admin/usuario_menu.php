<?php 

$titulo = "Livraria - Menu de usuário";

include_once("cabecalho.php");

require_once("conexao.php");

//Número de registros para mostrar por página
$exiba= 3;

//Captura a busca
$where = mysqli_real_escape_string($dbc, trim(isset($_GET['q'])) ? $_GET['q'] : '');

//Determina a quantidade de páginas
if(isset($_GET['p']) && is_numeric($_GET['p'])){
    $pagina = $_GET['p'];
} else{
    $q = "SELECT COUNT(id) FROM usuario WHERE p_nome like '%$where%' OR u_nome like '%$where%'";
    $r = @mysqli_query($dbc ,$q);
    $row = @mysqli_fetch_array($r, MYSQLI_NUM);
    $qtde = $row[0];

    //Calcula o número de páginas
    if($qtde > $exiba) {
        //A função ceil arredonda o valor para cima ex: 5.05 é 6
        $pagina = ceil($qtde / $exiba);
    }else {
        $pagina = 1;
    }
}
//Determina uma posição no BD para começar a retornar os resultados
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
    $inicio = $_GET['s'];
}else {
    $inicio = 0;
}

//Determina a ordenação, por padrão é por ID
$ordem = isset($_GET['ordem']) ? $_GET['ordem'] : 'id';

//Determina a ordem de classificação dos registros
switch ($ordem){
    case 'id' : $order_by = 'id';
    break;
    case 'p_nome' : $order_by = 'p_nome';
    break;
    case 'email' : $order_by = 'email';
    break;
    case 'data_reg' : $order_by = 'data_reg';
    break;
    default:
    $order_by= 'id';
    $ordem= 'id';
    break;
}

//Determina uma posição 

$q = "SELECT id, p_nome, u_nome, email, data_reg FROM usuario WHERE p_nome like '%$where%' OR u_nome like '%$where%' ORDER BY $order_by LIMIT $inicio, $exiba";

$r = @mysqli_query($dbc, $q);

if(mysqli_num_rows($r) > 0){
    $saida = '<div class="table-responsive col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="10%"><a href="usuario_menu.php?ordem=id">Código</a></th>
                            <th width="25%"><a href="usuario_menu.php?ordem=pnome">Nome</a></th>
                            <th width="25%"><a href="usuario_menu.php?ordem=email">E-mail</a></th>
                            <th width="20%"><a href="usuario_menu.php?ordem=data_reg">Data Reg.</a></th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>';
                    
                    while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
                        $saida .= '<tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['p_nome'] . ' ' . $row['u_nome'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['data_reg'] . '</td>
                        <td>
                            <a href="usuario_alt.php?id='. $row['id'] . '"class="btn btn-sm btn-warning"> Alterar</a>
                            <a href="usuario_exc.php?id='. $row['id'] . '"class="btn btn-sm btn-danger"> Excluir</a>
                        </td>
                        </tr>';
                    }
                    $saida .= '</tbody></table></div>';
}else {
    $saida = "<div class='alert alert-warning'>
        Sua pesquisa por <b>$where</b> não encontrou nenhum resultado.<br />
        <b>Dicas</b><br />
        - Tente palavras menos específicas.<br / >
        - Tente palavras chaves diferentes.<br />
        - Confira a ortografia das palavras e se elas estão acentuadas corretamente.<br />
    </div>";
}

if($pagina > 1) {
    $pag = ''; 
    $pagina_correta = ($inicio / $exiba) + 1;

    //botão anterior
    if($pagina_correta != 1) {
        $pag .= '<li class="page-item"><a class="page-link" href="usuario_menu.php?s=' . ($inicio - $exiba) . '&p=' . $pagina . '&ordem=' . $ordem . '">Anterior</a></li>';
    } else {
        $pag .= '<li class="page-item disabled"><a class="page-link">Anterior</a></li>';
    }

    //Todas as páginas 
    for($i = 1; $i <= $pagina; $i++) {
        if($i != $pagina_correta){
            $pag .= '<li class="page-item"><a class="page-link" href="usuario_menu.php?s=' . ($exiba * ($i - 1)) . '&p=' . $pagina . '&ordem=' . $ordem . '">' . $i . '</a></li>';
        } else {
            $pag .= '<li class="page-item disabled"><a class="page-link">' . $i . '</a></li>';
        }
    }

    //botão próximo
    if($pagina_correta != $pagina){
        $pag .= '<li class="page-item"><a class="page-link" href="usuario_menu.php?s=' . ($inicio + $exiba) . '&p=' . $pagina . '&ordem=' . $ordem  . '">Próximo</a></li>';
    } else {
        $pag .= '<li class="page-item disabled"><a class="page-link">Próximo</a></li>';
    }
}

?>
<div class="container-fluid">
  <div class="row">

  <?php include_once("menu_lateral.php")?>

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      
      <div class="row mt-3 ">
        <div class="col-md-3"> 
            <h2>Usuários</h2>
        </div>
        <div class="col-md-6">
        </div>
        <div class="col-md-3 text-right">
            <a href="usuario_cad.php" class="btn btn-primary">
             Inserir Usuário
            </a>
        </div>
      </div>
        

        <div class="row">
            <?php echo $saida; ?>
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

