<?php 
/* DATOS DE USUARIO
• Identificador ( 5 a 10 caracteres, no debe existir previamente, solo letras y números)
• Contraseña ( 8 a 15 caracteres, debe ser segura)
• Nombre ( Nombre y apellidos del usuario
• Correo electrónico ( Valor válido de dirección correo, no debe existir previamente)
• Tipo de Plan (0-Básico |1-Profesional |2- Premium| 3- Máster)
• Estado: (A-Activo | B-Bloqueado |I-Inactivo )
*/
// Inicializo el modelo 
// Cargo los datos del fichero a la session
class ModeloUserDB {

	private static $dbh = null; 
	private static $consulta_user = "SELECT * from usuarios where id = ?";
	private static $consulta_email = "Select email from Usuarios where id = ?";
	private static $consulta_plan =	 "SELECT plan FROM usuarios WHERE id=?";
	private static $consulta_borrar = "DELETE FROM usuarios WHERE id=?";
	private static $consulta_id =	"SELECT ID FROM usuarios WHERE id=?";
	private static $consulta_insertar =	"INSERT INTO usuarios (id, clave, nombre, email, plan, estado) VALUES (?,?,?,?,?,?);";
	private static $consulta_update1 = "UPDATE usuarios set nombre=?, email=?, plan=?, estado=? WHERE id=?";
	private static $consulta_update2 = "UPDATE usuarios set clave=?, nombre=?, email=?, plan=?, estado=? WHERE id=?";

		
	public static function init(){
		if (self::$dbh == null){
			try {
				// Cambiar  los valores de las constantes en config.php
				$dsn = "mysql:host=".DBSERVER.";dbname=".DBNAME.";charset=utf8";
				self::$dbh = new PDO($dsn,DBUSER,DBPASSWORD);
				// Si se produce un error se genera una excepción;
				self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e){
				echo "Error de conexión ".$e->getMessage();
				exit();
			}
			
		}
		
	}
	
	
	
	
	public static function OkUser($user,$clave){
		$stmt = self::$dbh->prepare(self::$consulta_user);
		$stmt->bindValue(1,$user);
		$stmt->execute();  
		if ($stmt->rowCount() > 0 ){
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$fila = $stmt->fetch();
			$clavecifrada = $fila['clave'];
			if(password_verify($clave,$clavecifrada)){
				return true;
			}
		} 
		return false;
	}
	
	
	
	
	public static function modeloObtenerTipo($user){
		$plan=0;
		$stmt = self::$dbh->prepare(self::$consulta_plan);
		$stmt->bindValue(1,$user);
		$stmt->execute();  
		if ($stmt->rowCount() > 0 ){
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$fila = $stmt->fetch();
			$plan = $fila['plan'];
		}
		

		if($plan=="0"){
			return "Básico";
		}
		if($plan=="1"){
			return "Profesional";
		}
		if($plan=="2"){
			return "Premium";
		}
		if($plan=="3"){
			return "Máster";
		}
	}



	public static function modeloUserDel($user){
		$stmt = self::$dbh->prepare(self::$consulta_borrar);
		$stmt->bindValue(1,$user);
		$stmt->execute();  
		
		
		/*$conexion = mysqli_connect(DBSERVER,DBUSER,DBPASSWORD) or die ("No se ha podido conectar al servidor de Base de datos");
		$db = mysqli_select_db($conexion, DBNAME) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
		$consulta = "DELETE FROM usuarios WHERE id='$user'";
		$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");*/	
		
		rmdir("app/file/".$user);
		header('Location:index.php?orden=VerUsuarios');
	}
	
	
	
	// Tabla de todos los usuarios para visualizar
	public static function GetAll ():array{
		// Genero los datos para la vista que no muestra la contraseña ni los códigos de estado o plan
		// sino su traducción a texto  PLANES[$fila['plan']],
		$stmt = self::$dbh->query("select * from Usuarios");
		
		$tUserVista = [];
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		while ( $fila = $stmt->fetch()){
			$datosuser = [ 
				$fila['nombre'],
				$fila['email'], 
				PLANES[$fila['plan']],
				ESTADOS[$fila['estado']]
			   ];
			$tUserVista[$fila['id']] = $datosuser;       
		}
		return $tUserVista;
	}
	
	
	
	public static function Add($id,$nombre,$contra,$correo,$tipouser,$useracti){	
		$clave = password_hash($contra, PASSWORD_DEFAULT, ['cost' => 10]);
		
		$stmt = self::$dbh->prepare(self::$consulta_id);
		$stmt->bindValue(1,$id);
		$stmt->execute();  
		if ($stmt->rowCount() > 0 ){
			$var=1;
		}
		else{
			$var=0;
		}

		if($var==1){
			header('Location:index.php?orden=AltaError');
		}else{
			$stmt = self::$dbh->prepare(self::$consulta_insertar);
			$stmt->bindValue(1,$id);
			$stmt->bindValue(2,$clave);
			$stmt->bindValue(3,$nombre);
			$stmt->bindValue(4,$correo);
			$stmt->bindValue(5,$tipouser);
			$stmt->bindValue(6,$useracti);
			
			$stmt->execute();
			header('Location:index.php?orden=VerUsuarios');

		}
	}
	
	
	
	public static function Add2($id,$nombre,$contra,$correo,$tipouser,$useracti){	
		$clave = password_hash($contra, PASSWORD_DEFAULT, ['cost' => 10]);
		
		$stmt = self::$dbh->prepare(self::$consulta_id);
		$stmt->bindValue(1,$id);
		$stmt->execute();  
		if ($stmt->rowCount() > 0 ){
			$var=1;
		}
		else{
			$var=0;
		}

		if($var==1){
			header('Location:index.php?orden=AltaError2');
		}else{
			$stmt = self::$dbh->prepare(self::$consulta_insertar);
			$stmt->bindValue(1,$id);
			$stmt->bindValue(2,$clave);
			$stmt->bindValue(3,$nombre);
			$stmt->bindValue(4,$correo);
			$stmt->bindValue(5,$tipouser);
			$stmt->bindValue(6,$useracti);
			
			$stmt->execute();
			
			session_destroy();
			header('Location:index.php');

		}
	}



	public static function Update ($user){
		$stmt = self::$dbh->prepare(self::$consulta_user);
		$stmt->bindValue(1,$user);
		$stmt->execute();  
		if ($stmt->rowCount() > 0 ){
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$fila = $stmt->fetch();

			$campo1 = $fila['id'];
			$campo2 = $fila['clave'];
			$campo3 = $fila['nombre'];
			$campo4 = $fila['email'];
			$campo5 = $fila['plan'];
			$campo6 = $fila['estado']; 
		}
		

		$_SESSION['0'] = $user;
		$_SESSION['1'] = $campo2;
		$_SESSION['2'] = $campo3;
		$_SESSION['3'] = $campo4;
		$_SESSION['4']= $campo5;
		$_SESSION['5'] = $campo6;
		
		include_once "plantilla/modificar.php";
	}
	
	
	
	
	public static function Update2 ($id,$nombre,$contra,$correo,$tipouser,$useracti){
		$clave = password_hash($contra, PASSWORD_DEFAULT, ['cost' => 10]);
		
		
		
		$stmt = self::$dbh->prepare(self::$consulta_user);
		$stmt->bindValue(1,$id);
		$stmt->execute();  
		if ($stmt->rowCount() > 0 ){
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$fila = $stmt->fetch();
			$campo2 = $fila['clave'];
		}	
				
		if($contra==$campo2){
			$stmt = self::$dbh->prepare(self::$consulta_update1);
			$stmt->bindValue(1,$nombre);
			$stmt->bindValue(2,$correo);
			$stmt->bindValue(3,$tipouser);
			$stmt->bindValue(4,$useracti);
			$stmt->bindValue(5,$id);
			$stmt->execute();
				
		}else{
			//echo $campo2."<br>".$clave."<br>".$contra;
			$stmt = self::$dbh->prepare(self::$consulta_update2);
			$stmt->bindValue(1,$clave);
			$stmt->bindValue(2,$nombre);
			$stmt->bindValue(3,$correo);
			$stmt->bindValue(4,$tipouser);
			$stmt->bindValue(5,$useracti);
			$stmt->bindValue(6,$id);
			$stmt->execute();
		}	
		header('Location:index.php?orden=VerUsuarios');
	}
	
	
	
	
	public static function Get ($user){
		$stmt = self::$dbh->prepare(self::$consulta_user);
		$stmt->bindValue(1,$user);
		$stmt->execute();  
		if ($stmt->rowCount() > 0 ){
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$fila = $stmt->fetch();

			$campo1 = $fila['id'];
			$campo2 = $fila['clave'];
			$campo3 = $fila['nombre'];
			$campo4 = $fila['email'];
			$campo5 = $fila['plan'];
			$campo6 = $fila['estado']; 
		}
		

		$_SESSION['0'] = $user;
		$_SESSION['1'] = $campo2;
		$_SESSION['2'] = $campo3;
		$_SESSION['3'] = $campo4;
		$_SESSION['4']= $campo5;
		$_SESSION['5'] = $campo6;
				
		include_once "plantilla/detalles.php";
	}
}	

