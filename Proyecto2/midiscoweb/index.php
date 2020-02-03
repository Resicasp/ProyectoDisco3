<?php
session_start();
include_once 'app/config.php';
include_once 'app/controlerFile.php';
include_once 'app/controlerUser.php';
include_once 'app/modeloUser.php';
include_once 'app/modeloFile.php';
include_once 'app/modeloUserDB.php';
// Inicializo el modelo
modeloUserInit();
modeloUserDB::Init();
// Enrutamiento
// Relación entre peticiones y función que la va a tratar
// Versión sin POO no manejo de Clases ni objetos
$rutasUser = [
    "Inicio"      => "ctlUserInicio",
    "Alta"        => "ctlUserAlta",
	"AltaError"        => "ctlUserAltaError",
	"AltaError2"        => "ctlUserAltaError2",
	"Alta Usuario"        => "ctlUserAlta2",
    "Detalles"    => "ctlUserDetalles",
    "Modificar"   => "ctlUserModificar",
	"Actualizar Datos"   => "ctlUserActualizar",
    "Borrar"      => "ctlUserBorrar",
	"Registrar Usuario" =>  "ctlUserRegistrar",
    "Cerrar"      => "ctlUserCerrar",
    "VerUsuarios" => "ctlUserVerUsuarios",
	"VerFicheros" => "ctlUserVerFicheros",
	"BorrarFichero"      => "ctlUserBorrarFichero",
	"DetallesFichero"  => "ctlUserDetallesFichero",
	"AltaFichero"  => "ctlUserAltaFichero",
	"ModificarFichero"  => "ctlUserModificarFichero",
	"Actualizar Fichero" => "ctlUserActualizarFichero",
	"Crear Fichero" => "ctlUserAltaFichero2",
	"file" => "ctlFileDownload",
];
if(isset($_GET['orden'])){
	if($_GET['orden']=="Registrar Usuario"){
		$_SESSION['user']="1";
		$_SESSION['modo'] = GESTIONUSUARIOS;
	}
}else{
	
}


	
// Si no hay usuario a Inicio
if (!isset($_SESSION['user'])){
    $procRuta = "ctlUserInicio";
} else {
    if ($_SESSION['modo'] == GESTIONUSUARIOS){
        if (isset($_GET['orden'])){
            // La orden tiene una funcion asociada 
            if ( isset ($rutasUser[$_GET['orden']]) ){
                $procRuta =  $rutasUser[$_GET['orden']];
            }
            else {
                // Error no existe función para la ruta
                header('Status: 404 Not Found');
                echo '<html><body><h1>Error 404: No existe la ruta <i>' .
                    $_GET['ctl'] .
                    '</p></body></html>';
                    exit;
            }
        }
        else {
            $procRuta = "ctlUserVerUsuarios";
        }
    }
    // Usuario Normal PRIMERA VERSION SIN ACCIONES
    else {
		if (isset($_GET['orden'])){
            // La orden tiene una funcion asociada 
            if ( isset ($rutasUser[$_GET['orden']]) ){
                $procRuta =  $rutasUser[$_GET['orden']];
            }
            else {
                // Error no existe función para la ruta
                header('Status: 404 Not Found');
                echo '<html><body><h1>Error 404: No existe la ruta <i></p></body></html>';
                    exit;
            }
        }
        else {
            $procRuta = "ctlUserVerFicheros";
        }  
    }
}

// Llamo a la función seleccionada
$procRuta();




