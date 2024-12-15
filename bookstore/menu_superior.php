<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a href="pedidos.php" class="nav-link">
            Meus pedidos
        </a>
    </li>
    <li class="nav-item">
        <a href="login.php" class="nav-link">
            Meu cadastro
        </a>
    </li>
    <li class="nav-item">
        <a href="cesta.php" class="nav-link">
            Meu carrinho (
                <?php if(isset($_SESSION['total_itens'])) {
                    if($_SESSION['total_itens']==0){
                        echo "vazio";
                    }else{
                        echo $_SESSION['total_itens'] . "produto(s)";
                    }
                }else{
                    echo "vazio";
                }?>
                )
        </a>
    </li>
</ul>