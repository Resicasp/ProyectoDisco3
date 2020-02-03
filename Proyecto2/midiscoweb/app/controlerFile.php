<?php
// --------------------------------------------------------------
// Controlador que realiza la gestión de ficheros de un usuario
// ---------------------------------------------------------------

include_once 'config.php';
include_once 'modeloFile.php';

function ctlUserVerFicheros(){
	   // Obtengo los datos del modelo
    $ficheros = modeloUserFileGetAll(); 
    // Invoco la vista 
    include_once 'plantilla/verficherosp.php';
	
}

function ctlUserBorrarFichero(){
	$clav = $_GET['id'];
	modeloUserDelFile($clav);
}

function ctlUserDetallesFichero(){
	$clav = $_GET['id'];
	$clav2 = $_GET['clave'];
	modeloUserDetallesFile($clav,$clav2);
}

function ctlUserModificarFichero(){
	$clav = $_GET['id'];
	$clav2 = $_GET['clave'];
	modeloUserModificarFile($clav,$clav2);
}

function ctlUserActualizarFichero(){
	$id = $_GET['idfichero'];
	$nombre = $_GET['nombre'];
	modeloUserActualizarFile($id,$nombre);
}

function ctlUserAltaFichero(){
	include_once 'plantilla/crearfichero.php';
}

function ctlUserAltaFichero2(){
	$nombre = $_GET['namefile'];
	$extension = $_GET['extension'];
	modeloUserCreateFile($nombre,$extension);
}

function ctlFileDownload(){
	$nombre = $_GET['id'];
	
	if(!empty("app/file/".$_SESSION['user']."/".$nombre)){
    $fileName = basename("app/file/".$_SESSION['user']."/".$nombre);
    $filePath = "app/file/".$_SESSION['user']."/".$nombre;
    if(!empty("app/file/".$_SESSION['user']."/".$nombre) && file_exists($filePath)){
        // Define headers
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        
        // Read the file
        readfile($filePath);
        exit;
    }else{
        echo 'The file does not exist.';
    }
}
}
?>
