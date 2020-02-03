<?php
// ------------------------------------------------
// Controlador que realiza la gestión de usuarios
// ------------------------------------------------
include_once 'config.php';
//include_once 'modeloUser.php';
include_once 'modeloUserDB.php';

/*
 * Inicio Muestra o procesa el formulario (POST)
 */

function  ctlUserInicio(){
    $msg = "";
    $user ="";
    $clave ="";
    if ( $_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['user']) && isset($_POST['clave'])){
            $user =$_POST['user'];
            $clave=$_POST['clave'];
			if($user=="" || $clave==""){
				include_once 'plantilla/facceso2.php';
			}
			else{
				if (modeloUserDB::OkUser($user,$clave)){
					if($_SESSION['tusuarios'][$user][4]=="I"){
						include_once 'plantilla/facceso2.php';
					}
					else{
						$_SESSION['user'] = $user;
						$_SESSION['tipouser'] = modeloUserDB::modeloObtenerTipo($user);
						
						if ( $_SESSION['tipouser'] == "Máster"){
							$_SESSION['modo'] = GESTIONUSUARIOS;
							header('Location:index.php?orden=VerUsuarios');
						}
						else {	
						  // Usuario normal;
						  // PRIMERA VERSIÓN SOLO USUARIOS ADMISTRADORES
							$_SESSION['modo'] = GESTIONFICHEROS;
							$dir="app/file";
							
							if (!file_exists("app/file/".$user)) {
								mkdir("app/file/".$user, 0777, true);
							}
							 header('Location:index.php?orden=VerFicheros');
						}		
						
					}
							
				}
				else {
					//echo $_SESSION['tipouser'];
					include_once 'plantilla/facceso2.php';
				}  	
			}   
        }
    }

    
    include_once 'plantilla/facceso.php';
}

// Cierra la sesión y vuelca los datos
function ctlUserCerrar(){
    session_destroy();
    header('Location:index.php');
}

function ctlUserAlta(){
	include_once 'plantilla/añadir.php';
}

function ctlUserAltaError(){
	include_once 'plantilla/añadir2.php';
}

function ctlUserAltaError2(){
	include_once 'plantilla/añadir4.php';
}

function ctlUserRegistrar(){
	$id = $_GET['iduser'];
	$nombre = $_GET['nombre'];
	$contra = $_GET['contra'];
	$contra2 = $_GET['contra2'];
	$correo = $_GET['correo'];
	$tipouser = $_GET['tipouser'];
	$useracti = $_GET['useracti'];
	
	if($contra==$contra2){
	   modeloUserDB::Add2($id,$nombre,$contra,$correo,$tipouser,$useracti);
	}else{
	    include_once 'plantilla/añadir5.php';
	}
}


function ctlUserAlta2(){
	$id = $_GET['iduser'];
	$nombre = $_GET['nombre'];
	$contra = $_GET['contra'];
	$contra2 = $_GET['contra2'];
	$correo = $_GET['correo'];
	$tipouser = $_GET['tipouser'];
	$useracti = $_GET['useracti'];
	
	if($contra==$contra2){
	   modeloUserDB::Add($id,$nombre,$contra,$correo,$tipouser,$useracti);
	}else{
	    include_once 'plantilla/añadir3.php';
	}
}

function ctlUserDetalles(){
	$clav = $_GET['id'];
	modeloUserDB::GET($clav);	
}

function ctlUserModificar(){
	$clav = $_GET['id'];
	modeloUserDB::Update($clav);	
}

function ctlUserActualizar(){
	$id = $_GET['iduser'];
	$nombre = $_GET['nombre'];
	$contra = $_GET['contra'];
	$correo = $_GET['correo'];
	$tipouser = $_GET['tipouser'];
	$useracti = $_GET['useracti'];
	
	modeloUserDB::Update2($id,$nombre,$contra,$correo,$tipouser,$useracti);	
}



function ctlUserBorrar(){
	$clav = $_GET['id'];
	modeloUserDB::modeloUserDel($clav);

	//modeloUserDel($clav);
}


// Muestro la tabla con los usuario 
function ctlUserVerUsuarios (){
    // Obtengo los datos del modelo
    $usuarios = modeloUserDB::GetAll(); 
    // Invoco la vista 
    include_once 'plantilla/verusuariosp.php';
   
}
