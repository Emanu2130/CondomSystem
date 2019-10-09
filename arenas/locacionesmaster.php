<?php

// id_locacion
$locaciones->id_locacion->CellCssStyle = "";
$locaciones->id_locacion->CellCssClass = "";

// id_empresa
$locaciones->id_empresa->CellCssStyle = "";
$locaciones->id_empresa->CellCssClass = "";

// nombre
$locaciones->nombre->CellCssStyle = "";
$locaciones->nombre->CellCssClass = "";

// notas
$locaciones->notas->CellCssStyle = "";
$locaciones->notas->CellCssClass = "";
?>
<p><span class="arenas">Registro maestro: Locaciones<br>
<a href="<?php echo $gsMasterReturnUrl ?>">Volver a la pagina principal</a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader">Id Locacion</td>
			<td class="ewTableHeader">Id Empresa</td>
			<td class="ewTableHeader">Nombre</td>
			<td class="ewTableHeader">Notas</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $locaciones->id_locacion->CellAttributes() ?>>
<div<?php echo $locaciones->id_locacion->ViewAttributes() ?>><?php echo $locaciones->id_locacion->ListViewValue() ?></div></td>
			<td<?php echo $locaciones->id_empresa->CellAttributes() ?>>
<div<?php echo $locaciones->id_empresa->ViewAttributes() ?>><?php echo $locaciones->id_empresa->ListViewValue() ?></div></td>
			<td<?php echo $locaciones->nombre->CellAttributes() ?>>
<div<?php echo $locaciones->nombre->ViewAttributes() ?>><?php echo $locaciones->nombre->ListViewValue() ?></div></td>
			<td<?php echo $locaciones->notas->CellAttributes() ?>>
<div<?php echo $locaciones->notas->ViewAttributes() ?>><?php echo $locaciones->notas->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
