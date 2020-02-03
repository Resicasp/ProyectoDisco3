<?php
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();

?>
<script type="text/javascript" src="web/js/funciones2.js"></script>
<script type="text/javascript" src="web/js/jquery.js"></script>		
<center>
<h2>Ficheros:</h2>
<table>
	<th>Nombre</th><th>Tipo</th><th>Tamaño</th><th>Extension</th><th></th><th></th><th></th><th></th>
	<tr>
<?php
$auto = $_SERVER['PHP_SELF'];
// identificador => Nombre, email, plan y Estado
?>
<?php foreach ($ficheros as $clave => $datosusuario) : ?>
<tr>		
	<?php for  ($j=0; $j < count($datosusuario); $j++) :?>
     <td width="100px"><center><?=$datosusuario[$j] ?></center></td>
	<?php endfor;?>
<td>&nbsp;&nbsp;<a href="<?= $auto?>?orden=BorrarFichero&id=<?= $datosusuario[0] ?>"><img class="borrar" title="Borrar" src="../img/borrar.png"></a>&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;<a href="<?= $auto?>?orden=ModificarFichero&id=<?= $datosusuario[0] ?>&clave=<?= $clave ?>"><img class="modificar" title="Modificar" src="../img/modificar.png"></a>&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;<a href="<?= $auto?>?orden=DetallesFichero&id=<?= $datosusuario[0] ?>&clave=<?= $clave ?>"><img class="detalles" title="Detalles" src="../img/informe.png"></a>&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;<a href="<?= $auto?>?orden=file&id=<?= $datosusuario[0] ?>&clave=<?= $clave ?>"><img class="descargar" title="Descargar" src="../img/descargar.png"></a>&nbsp;&nbsp;</td>
</tr>
<?php endforeach; ?>


</table>
<br><br>
<form action='index.php'>
	<input type='hidden' name='orden' value='AltaFichero'> <input type='submit' class="myButton" value='Nuevo Fichero'>
</form>

<form action='index.php'>
	<input type='hidden' name='orden' value='Cerrar'> <input type='submit' class="myButton" value='Cerrar Sesión'>
</form>
</center>
<?php
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido de la página principal

$contenido = ob_get_clean();
include_once "principal.php";

?>