<?php 
    $gen= isset($_GET['gen_nome']) ? $_GET['gen_nome'] : 'Home';
    ?>


<ul class="nav nav-tabs">
    <li class="nav-item" ><a href="index.php" class="nav-link <?php if($gen == 'Home') echo 'active'; ?>">
        Home
    </a>
    </li>
    <li class="nav-item"><a href="generos.php?gen_id=23&gen_nome=Fantasia" class="nav-link <?php if($gen == 'Fantasia') echo 'active'; ?>">
        Fantasia
    </a>
    </li>
    <li class="nav-item"><a href="generos.php?gen_id=24&gen_nome=Ação" class="nav-link <?php if($gen == 'Ação') echo 'active'; ?>">
        Ação
    </a>
    </li>
    <li class="nav-item"><a href="generos.php?gen_id=28&gen_nome=Romance" class="nav-link <?php if($gen == 'Romance') echo 'active'; ?>">
        Romance
    </a>
    </li>
    <li class="nav-item"><a href="generos.php?gen_id=21&gen_nome=Ficção" class="nav-link <?php if($gen == 'Ficção') echo 'active'; ?>">
        Ficção
    </a>
    </li>
</ul>