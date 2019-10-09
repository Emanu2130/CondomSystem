<?php
define("EW_PAGE_ID", "preview", TRUE);
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "egresosinfo.php" ?>
<?php include "usuariosinfo.php" ?>
<?php	$usuarios = new cusuarios() ?>
<?php include "proveedoresinfo.php" ?>
<?php	$proveedores = new cproveedores() ?>
<?php include "locacionesinfo.php" ?>
<?php	$locaciones = new clocaciones() ?>
<?php include "userfn6.php" ?>
<?php

// Open connection to the database
$conn = ew_Connect();
$Security = new cAdvancedSecurity();
if (!$Security->IsLoggedIn()) $Security->AutoLogin();
if (!$Security->IsLoggedIn()) {
	echo "No tiene permisos para ver esta pagina";
	exit();
}

// Load filter
$qs = new cQueryString();
$filter = $qs->GetValue("f");
$filter = TEAdecrypt($filter, EW_RANDOM_KEY);
if ($filter == "") $filter = "0=1";

// Load recordset
$rs = $egresos->LoadRs($filter);
$nTotalRecs = ($rs) ? $rs->RecordCount() : 0;
?>
<link href="arenas.css" rel="stylesheet" type="text/css">
<p><span class="arenas" style="white-space: nowrap;">Modulo: Egresos
<?php if ($nTotalRecs > 0) { ?>
(<?php echo $nTotalRecs ?> Registros)
<?php } else { ?>
(No se encontraron registros)
<?php } ?>
</span></p>
<?php if ($nTotalRecs > 0) { ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table id="ewDetailsPreviewTable" name="ewDetailsPreviewTable" cellspacing="0" class="ewTable ewTableSeparate">
	<thead><!-- Table header -->
		<tr class="ewTableHeader">
			<td valign="top">Id Pago</td>
			<td valign="top">Estado</td>
			<td valign="top">Total Rd</td>
			<td valign="top">Total Us</td>
			<td valign="top">Total Euros</td>
			<td valign="top">Impuestos Pagados</td>
			<td valign="top">Numero Referencia</td>
			<td valign="top">Tipo Comprobante</td>
			<td valign="top">NCF</td>
			<td valign="top">Metodo Pago</td>
			<td valign="top">Proveedor</td>
			<td valign="top">Fecha</td>
			<td valign="top">Tipo egreso</td>
			<td valign="top">Empresa</td>
			<td valign="top">Locacion</td>
			<td valign="top">Cuenta Banco</td>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$nRecCount = 0;
while ($rs && !$rs->EOF) {

	// Init row class and style
	$nRecCount++;
	$egresos->CssClass = "ewTableRow";
	$egresos->CssStyle = "";
	$egresos->LoadListRowValues($rs);

	// Render row
	$egresos->RowType = EW_ROWTYPE_PREVIEW; // Preview record
	$egresos->RenderListRow();
?>
	<tr<?php echo $egresos->RowAttributes() ?>>
		<!-- id_pago -->
		<td>
<div<?php echo $egresos->id_pago->ViewAttributes() ?>><?php echo $egresos->id_pago->ViewValue ?></div></td>
		<!-- estado -->
		<td>
<div<?php echo $egresos->estado->ViewAttributes() ?>><?php echo $egresos->estado->ViewValue ?></div></td>
		<!-- total_rd -->
		<td>
<div<?php echo $egresos->total_rd->ViewAttributes() ?>><?php echo $egresos->total_rd->ViewValue ?></div></td>
		<!-- total_us -->
		<td>
<div<?php echo $egresos->total_us->ViewAttributes() ?>><?php echo $egresos->total_us->ViewValue ?></div></td>
		<!-- total_euros -->
		<td>
<div<?php echo $egresos->total_euros->ViewAttributes() ?>><?php echo $egresos->total_euros->ViewValue ?></div></td>
		<!-- Impuestos_pagados -->
		<td>
<div<?php echo $egresos->Impuestos_pagados->ViewAttributes() ?>><?php echo $egresos->Impuestos_pagados->ViewValue ?></div></td>
		<!-- Numero_Referencia -->
		<td>
<div<?php echo $egresos->Numero_Referencia->ViewAttributes() ?>><?php echo $egresos->Numero_Referencia->ViewValue ?></div></td>
		<!-- tipo_comprobante -->
		<td>
<div<?php echo $egresos->tipo_comprobante->ViewAttributes() ?>><?php echo $egresos->tipo_comprobante->ViewValue ?></div></td>
		<!-- Comprobante_fiscal -->
		<td>
<div<?php echo $egresos->Comprobante_fiscal->ViewAttributes() ?>><?php echo $egresos->Comprobante_fiscal->ViewValue ?></div></td>
		<!-- Metodo_pago -->
		<td>
<div<?php echo $egresos->Metodo_pago->ViewAttributes() ?>><?php echo $egresos->Metodo_pago->ViewValue ?></div></td>
		<!-- proveedor -->
		<td>
<div<?php echo $egresos->proveedor->ViewAttributes() ?>><?php echo $egresos->proveedor->ViewValue ?></div></td>
		<!-- fecha -->
		<td>
<div<?php echo $egresos->fecha->ViewAttributes() ?>><?php echo $egresos->fecha->ViewValue ?></div></td>
		<!-- tipo1 -->
		<td>
<div<?php echo $egresos->tipo1->ViewAttributes() ?>><?php echo $egresos->tipo1->ViewValue ?></div></td>
		<!-- Empresa -->
		<td>
<div<?php echo $egresos->Empresa->ViewAttributes() ?>><?php echo $egresos->Empresa->ViewValue ?></div></td>
		<!-- locacion -->
		<td>
<div<?php echo $egresos->locacion->ViewAttributes() ?>><?php echo $egresos->locacion->ViewValue ?></div></td>
		<!-- cuenta_banco -->
		<td>
<div<?php echo $egresos->cuenta_banco->ViewAttributes() ?>><?php echo $egresos->cuenta_banco->ViewValue ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
?>
	</tbody>
</table>
</div>
</td></tr></table>
<?php
if ($rs)
	$rs->Close();
}
$content = ob_get_contents();
ob_end_clean();
echo ew_ConvertToUtf8($content);
?>
