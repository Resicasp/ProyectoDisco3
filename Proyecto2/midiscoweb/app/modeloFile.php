<?php 

	function modeloUserFileGetAll(){
		$ficheros = [];
		$dir="app/file/".$_SESSION['user'];
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					$nombreyruta = $dir . "/" . $file;
					$ficheros[] = [$file, filetype($nombreyruta), filesize($nombreyruta),pathinfo($nombreyruta, PATHINFO_EXTENSION)];
				}
				closedir($dh);
			}
		}
		unset($ficheros[0]);
		unset($ficheros[1]);
		$_SESSION['tuficheros']=$ficheros;
		return $ficheros;
	}
	
	function modeloUserDelFile($file){
		unlink("app/file/".$_SESSION['user']."/".$file);
		header('Location:index.php?orden=VerFicheros');
	}
	
	function modeloUserDetallesFile($file, $file2){
		
		$_SESSION['0'] = $_SESSION['tuficheros'][$file2][0];
		$_SESSION['1'] = $_SESSION['tuficheros'][$file2][1];
		$_SESSION['2'] = $_SESSION['tuficheros'][$file2][2];
		$_SESSION['3'] = $_SESSION['tuficheros'][$file2][3];
		
		include_once "plantilla/detallesfichero.php";
	}
	
	
	function modeloUserModificarFile($file, $file2){
		$_SESSION['0'] = $_SESSION['tuficheros'][$file2][0];
		$_SESSION['1'] = $_SESSION['tuficheros'][$file2][1];
		$_SESSION['2'] = $_SESSION['tuficheros'][$file2][2];
		$_SESSION['3'] = $_SESSION['tuficheros'][$file2][3];
		
		include_once "plantilla/modificarfichero.php";
	}
	
	function modeloUserActualizarFile($file, $nombre){
		rename ("app/file/".$_SESSION['user']."/".$file, "app/file/".$_SESSION['user']."/".$nombre);
		header('Location:index.php?orden=VerFicheros');
	}
	
	function modeloUserCreateFile($nombre, $extension){
		$nombrecompleto=$nombre.".".$extension;
		$control = fopen("app/file/".$_SESSION['user']."/".$nombrecompleto,"w+");
		if($control == false){
			die("No se ha podido crear el archivo.");
		}
		header('Location:index.php?orden=VerFicheros');
	}
?>