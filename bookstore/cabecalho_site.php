<?php 
  session_start();
?> 


<html>
    <head>
        <meta charset="UTF-8">

        <link href="css/bootstrap.min.css" 
            rel="stylesheet">
        
        <link href="css/sticky-footer-navbar.css" 
            rel="stylesheet">
    </head>

    <body>
    <header>
      <!-- Navbar fixa -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
	       
		<a class="navbar-brand" href="index.php">Livraria Online</a>
        
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" 
			aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
						<?php include_once('menu_superior.php'); ?>
		</div>
    </button>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="admin/dashboard.php" rgbcolor="(52f,58f,64f)">Admin</a>
        </li>
      </ul>
      </nav>
	  
    </header>

  <div class="container theme-showcase" role="main">
