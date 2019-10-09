<?php
define("EW_PAGE_ID", "preview", TRUE);
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "ingresosinfo.php" ?>
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
$rs = $ingresos->LoadRs($filter);
$nTotalRecs = ($rs) ? $rs->RecordCount() : 0;
?>
<link href="arenas.css" rel="stylesheet" type="text/css">
<p><span class="arenas" style="white-space: nowrap;">Modulo: Ingresos
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
			<td valign="top">Id Ingreso</td>
			<td valign="top">Tipo Ingreso</td>
			<td valign="top">Estado</td>
			<td valign="top">Numero Factura</td>
			<td valign="top">Fecha Factura</td>
			<td valign="top">Fecha Deposito</td>
			<td valign="top">Valor RD</td>
			<td valign="top">Valor US</td>
			<td valign="top">Valor Euros</td>
			<td valign="top">Valor Tarjeta Credito</td>
			<td valign="top">Empresa</td>
			<td valign="top">Tipo Comprobante</td>
			<td valign="top">NCF</td>
			<td valign="top">Locacion</td>
			<td valign="top">Cuenta Banco</td>
			<td valign="top">Proveedor</td>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$nRecCount = 0;
while ($rs && !$rs->EOF) {

	// Init row class and style
	$nRecCount++;
	$ingresos->CssClass = "ewTableRow";
	$ingresos->CssStyle = "";
	$ingresos->LoadListRowValues($rs);

	// Render row
	$ingresos->RowType = EW_ROWTYPE_PREVIEW; // Preview record
	$ingresos->RenderListRow();
?>
	<tr<?php echo $ingresos->RowAttributes() ?>>
		<!-- id_ingreso -->
		<td>
<div<?php echo $ingresos->id_ingreso->ViewAttributes() ?>><?php echo $ingresos->id_ingreso->ViewValue ?></div></td>
		<!-- tipo_ingreso -->
		<td>
<div<?php echo $ingresos->tipo_ingreso->ViewAttributes() ?>><?php echo $ingresos->tipo_ingreso->ViewValue ?></div></td>
		<!-- estado -->
		<td>
<div<?php echo $ingresos->estado->ViewAttributes() ?>><?php echo $ingresos->estado->ViewValue ?></div></td>
		<!-- Numero_Factura -->
		<td>
<div<?php echo $ingresos->Numero_Factura->ViewAttributes() ?>><?php echo $ingresos->Numero_Factura->ViewValue ?></div></td>
		<!-- Fecha_Factura -->
		<td>
<div<?php echo $ingresos->Fecha_Factura->ViewAttributes() ?>><?php echo $ingresos->Fecha_Factura->ViewValue ?></div></td>
		<!-- Fecha_Dep -->
		<td>
<div<?php echo $ingresos->Fecha_Dep->ViewAttributes() ?>><?php echo $ingresos->Fecha_Dep->ViewValue ?></div></td>
		<!-- Valor_RD -->
		<td>
<div<?php echo $ingresos->Valor_RD->ViewAttributes() ?>><?php echo $ingresos->Valor_RD->ViewValue ?></div></td>
		<!-- Valor_US -->
		<td>
<div<?php echo $ingresos->Valor_US->ViewAttributes() ?>><?php echo $ingresos->Valor_US->ViewValue ?></div></td>
		<!-- Valor_Euros -->
		<td>
<div<?php echo $ingresos->Valor_Euros->ViewAttributes() ?>><?php echo $ingresos->Valor_Euros->ViewValue ?></div></td>
		<!-- Valor_Tarjeta_credito -->
		<td>
<div<?php echo $ingresos->Valor_Tarjeta_credito->ViewAttributes() ?>><?php echo $ingresos->Valor_Tarjeta_credito->ViewValue ?></div></td>
		<!-- Empresa -->
		<td>
<div<?php echo $ingresos->Empresa->ViewAttributes() ?>><?php echo $ingresos->Empresa->ViewValue ?></div></td>
		<!-- tipo_comprobante -->
		<td>
<div<?php echo $ingresos->tipo_comprobante->ViewAttributes() ?>><?php echo $ingresos->tipo_comprobante->ViewValue ?></div></td>
		<!-- NCF -->
		<td>
<div<?php echo $ingresos->NCF->ViewAttributes() ?>><?php echo $ingresos->NCF->ViewValue ?></div></td>
		<!-- locacion -->
		<td>
<div<?php echo $ingresos->locacion->ViewAttributes() ?>><?php echo $ingresos->locacion->ViewValue ?></div></td>
		<!-- cuenta_banco -->
		<td>
<div<?php echo $ingresos->cuenta_banco->ViewAttributes() ?>><?php echo $ingresos->cuenta_banco->ViewValue ?></div></td>
		<!-- proveedor -->
		<td>
<div<?php echo $ingresos->proveedor->ViewAttributes() ?>><?php echo $ingresos->proveedor->ViewValue ?></div></td>
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
