<?php
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();

?>
<script type="text/javascript" src="web/js/funciones2.js"></script>
<script type="text/javascript" src="web/js/jquery.js"></script>	
<center>
<h2>Usuarios:</h2>
<table >
	<th>Id</th><th>Nombre</th><th>Correo</th><th>Tipo</th><th>Estado</th><th></th><th></th><th></th>
	<tr>
<?php
$auto = $_SERVER['PHP_SELF'];
// identificador => Nombre, email, plan y Estado
?>
<?php foreach ($usuarios as $clave => $datosusuario) : ?>
<tr>		
<td><?= $clave ?></td> 
	<?php for  ($j=0; $j < count($datosusuario); $j++) :?>
     <td><?=$datosusuario[$j] ?></td>
	<?php endfor;?>
<td>&nbsp;&nbsp;<a href="#" onclick="confirmarBorrar('<?= $datosusuario[0]."','".$clave."'"?>);"><img class="borrar" title="Borrar" src="../img/borrar.png"></a>&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;<a href="<?= $auto?>?orden=Modificar&id=<?= $clave ?>"><img class="modificar" title="Modificar" src="../img/modificar.png"></a>&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;<a href="<?= $auto?>?orden=Detalles&id=<?= $clave?>"><img class="detalles" title="Detalles" src="../img/informe.png"></a>&nbsp;&nbsp;</td>
</tr>
<?php endforeach; ?>
</table>
<br>
<form action='index.php'>
	<input type='hidden' name='orden' value='Alta'> <input type='submit' class="myButton" value='Nuevo Usuario'>
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