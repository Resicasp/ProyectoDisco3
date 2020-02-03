<html>
	<header>
		<link rel="shortcut icon" href="../img/disco.png"/>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8"/>
		<link href="web/css/cabecera.css" rel="stylesheet" type="text/css" />
		<link href="web/css/iniciar.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="web/js/funciones.js"></script>
		<title>DiscoStu</title>
	</header>
	
	<nav>	
		<ul id="menu-bar">
		<li><b><a href="../index.html"><img class="disco" src="../img/disco.png"></a></b></li>
		 <li><a href="../index.html">Inicio</a></li>
		
		 
		 <li class="active" id="ini"><a href="iniciar.html">Iniciar Sesion</a></li> 
		</ul>
	</nav>
	
	<section>
		<center>
		<br><br><br><br>
			<form action='index.php' class="formu2">
				<input type='hidden' name='idfichero' value=<?php error_reporting(0); echo $_SESSION['0']?>>
				<!--Usuario:<input name="iduser" type="text" value=<?php echo $_SESSION['0']?> disabled><br>-->
				<h2>Nombre: <?php echo $_SESSION['0']?><br></h2>
				Nombre:<input name="nombre" type="text" value=<?php echo $_SESSION['0']?>><br>
				Tipo:<input name="tipo" type="text" value=<?php echo $_SESSION['1']?> disabled><br>
				Tamaño:<input name="tamaño" type="text" value=<?php echo $_SESSION['2']?> disabled><br>
				Extension:<input name="extension" type="text" value=<?php echo $_SESSION['3']?> disabled><br>
				
				
				<br><br><br>
				<input type='submit' name="orden" class="myButton" value='Actualizar Fichero'>
				
			</form>
			<form action='index.php' class="formuatras">
				<input type='hidden' name='orden' value='VerFicheros'><input type='submit' class="myButton" value='Atrás'>
			</form>
		</center>
	</section>
	
	<footer class="final">	
		<center><a href="http://www.facebook.es"><img src="../img/F.png" class="fotofacebook"/></a>
		<a href="http://www.instagram.es"><img src="../img/I.png" class="fotoinsta"/></a>
		<a href="http://www.twitter.es"><img src="../img/T.png" class="fototwitter"/></a>
		<img src="../img/copi.png" class="fotocopi"/></center>
		<span class="info">&nbsp&nbsp&nbsp&nbsp&nbsp David Gómez Roldán<br>gomezdavid253@gmail.com</span>
	</footer>
</html>
