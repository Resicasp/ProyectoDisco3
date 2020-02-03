<html>
	<header>
		<link rel="shortcut icon" href="../img/disco.png"/>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8"/>
		<link href="web/css/cabecera.css" rel="stylesheet" type="text/css" />
		<link href="web/css/iniciar.css" rel="stylesheet" type="text/css" />
		<link href="web/css/varios.css" rel="stylesheet" type="text/css" />
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
				<input type='hidden' name='iduser' value=<?php echo $_SESSION['0']?>></input>
				<!--Usuario:<input name="iduser" type="text" value=<?php echo $_SESSION['0']?> disabled><br>-->
				<h2>Usuario: <?php echo $_SESSION['0']?><br></h2>
				Nombre:<input name="nombre" type="text" value=<?php echo $_SESSION['2']?>></input><br>
				Contraseña:<input name="contra" type="password" value=<?php echo $_SESSION['1']?>></input><br>
				Correo:<input name="correo" type="text" value=<?php echo $_SESSION['3']?>></input><br>
				
				<?php
				error_reporting(0);
				if($_SESSION['4']=="0"){
					echo "Tipo de Usuario:";
					echo '<select name="tipouser">
						<option value="0" selected="selected" >Basico</option>
						<option value="1">Profesional</option>
						<option value="2">Premium</option>
						<option value="3">Máster</option>
					</select> <br>'; 
				}
				if($_SESSION['4']=="1"){
					echo "Tipo de Usuario:";
					echo '<select name="tipouser">
						<option value="0">Basico</option>
						<option value="1" selected="selected">Profesional</option>
						<option value="2">Premium</option>
						<option value="3">Máster</option>
					</select> <br>'; 
				}
				if($_SESSION['4']=="2"){
					echo "Tipo de Usuario:";
					echo '<select name="tipouser">
						<option value="0">Basico</option>
						<option value="1">Profesional</option>
						<option value="2" selected="selected">Premium</option>
						<option value="3">Máster</option>
					</select> <br>'; 
				}
				if($_SESSION['4']=="3"){
					echo "Tipo de Usuario:";
					echo '<select name="tipouser">
						<option value="0">Basico</option>
						<option value="1">Profesional</option>
						<option value="2" >Premium</option>
						<option value="3" selected="selected">Máster</option>
					</select><br>'; 
				}
				?>
				
				
				<?php
				if($_SESSION['5']=="I"){
					echo "Estado del Usuario:";
					echo '<select name="useracti">
					<option value="A" >Activo</option>
					<option value="I" selected="selected">Inactivo</option>
					<option value="B">Bloqueado</option>
					</select>'; 
				}
				if($_SESSION['5']=="B"){
					echo "Estado del Usuario:";
					echo '<select name="useracti">
					<option value="A" >Activo</option>
					<option value="I" >Inactivo</option>
					<option value="B" selected="selected">Bloqueado</option>
					</select>'; 
				}
				if($_SESSION['5']=="A"){
					echo "Estado del Usuario:";
					echo '<select name="useracti">
					<option value="A" selected="selected" >Activo</option>
					<option value="I" >Inactivo</option>
					<option value="B">Bloqueado</option>
					</select>'; 
				}
				?>
				
				<br><br><br>
				<input type='submit' name="orden" class="myButton" value='Actualizar Datos'>	
			</form>
			<form action='index.php' class="formuatras">
				<input type='hidden' name='orden' value='VerUsuarios'><input type='submit' class="myButton" value='Atrás'>
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
