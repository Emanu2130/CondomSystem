<?php

// id_proveedor
$proveedores->id_proveedor->CellCssStyle = "";
$proveedores->id_proveedor->CellCssClass = "";

// nombre
$proveedores->nombre->CellCssStyle = "";
$proveedores->nombre->CellCssClass = "";

// rnc_cedula
$proveedores->rnc_cedula->CellCssStyle = "";
$proveedores->rnc_cedula->CellCssClass = "";

// telefonos
$proveedores->telefonos->CellCssStyle = "";
$proveedores->telefonos->CellCssClass = "";

// Empresa
$proveedores->Empresa->CellCssStyle = "";
$proveedores->Empresa->CellCssClass = "";
?>
<p><span class="arenas">Registro maestro: Proveedores<br>
<a href="<?php echo $gsMasterReturnUrl ?>">Volver a la pagina principal</a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader">Id Proveedor</td>
			<td class="ewTableHeader">Nombre</td>
			<td class="ewTableHeader">Rnc /cedula</td>
			<td class="ewTableHeader">Telefonos</td>
			<td class="ewTableHeader">Empresa</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $proveedores->id_proveedor->CellAttributes() ?>>
<div<?php echo $proveedores->id_proveedor->ViewAttributes() ?>><?php echo $proveedores->id_proveedor->ListViewValue() ?></div></td>
			<td<?php echo $proveedores->nombre->CellAttributes() ?>>
<div<?php echo $proveedores->nombre->ViewAttributes() ?>><?php echo $proveedores->nombre->ListViewValue() ?></div></td>
			<td<?php echo $proveedores->rnc_cedula->CellAttributes() ?>>
<div<?php echo $proveedores->rnc_cedula->ViewAttributes() ?>><?php echo $proveedores->rnc_cedula->ListViewValue() ?></div></td>
			<td<?php echo $proveedores->telefonos->CellAttributes() ?>>
<div<?php echo $proveedores->telefonos->ViewAttributes() ?>><?php echo $proveedores->telefonos->ListViewValue() ?></div></td>
			<td<?php echo $proveedores->Empresa->CellAttributes() ?>>
<div<?php echo $proveedores->Empresa->ViewAttributes() ?>><?php echo $proveedores->Empresa->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
