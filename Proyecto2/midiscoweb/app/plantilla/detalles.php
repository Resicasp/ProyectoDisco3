<html>
	<header>
		<link rel="shortcut icon" href="../img/disco.png"/>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8"/>
		<link href="web/css/cabecera.css" rel="stylesheet" type="text/css" />
		<link href="web/css/iniciar.css" rel="stylesheet" type="text/css" />
		<title>DiscoWeb</title>
	</header>
		
	<nav>	
		<ul id="menu-bar">
		<li><b><a href="../index.html"><img class="disco" src="../img/disco.png"></a></b></li>
		 <li><a href="../index.html">Inicio</a></li>
		
		 
		 <li class="active" id="ini"><a href="iniciar.html">Iniciar Sesion</a></li> 
		</ul>
	</nav>
	
	<section><br><br><br><br><br><br><br>
		<center>
			<div id="content">
				<table class="princ2">
					<tr>
						<th><b><center>Campo</center></b></th>
						<th><b><center>Detalles</center></b></th>
					</tr>
					
					<tr>
						<td>Usuario:</td>
						<td><?php error_reporting(0); echo $_SESSION['0']?></td>
					</tr>	
					<tr>
						<td>Nombre:</td>
						<td><?php echo $_SESSION['2']?></td>
					</tr>
					<!--  <tr>
						<td>Contraseña:</td>
						<td><?php echo $_SESSION['1']?></td>
					</tr>	-->
					<tr>
						<td>Correo:</td>
						<td><?php echo $_SESSION['3']?></td>
					</tr>	
					<tr>
						<td>Tipo de usuario:</td>
						<td><?php  if($_SESSION['4']=="0"){echo "Basico";} if($_SESSION['4']=="1"){echo "Profesional";} if($_SESSION['4']=="2"){echo "Premium";} if($_SESSION['4']=="3"){echo "Máster";}?></td>
					</tr>	
					<tr>
						<td>¿Usuario activo?</td>
						<td><?php  if($_SESSION['5']=="I"){echo "Inactivo";} if($_SESSION['5']=="B"){echo "Bloqueado";} if($_SESSION['5']=="A"){echo "Activo";}?></td>
					</tr>
				</table>
			</div>
			<br><br>
			<form action='index.php'>
				<input type='hidden' name='orden' value='VerUsuarios'> <input type='submit' class="myButton" value='Atrás'>
	
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
