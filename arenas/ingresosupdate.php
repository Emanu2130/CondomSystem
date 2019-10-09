<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "ingresosinfo.php" ?>
<?php include "usuariosinfo.php" ?>
<?php include "proveedoresinfo.php" ?>
<?php include "locacionesinfo.php" ?>
<?php include "userfn6.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Define page object
$ingresos_update = new cingresos_update();
$Page =& $ingresos_update;

// Page init processing
$ingresos_update->Page_Init();

// Page main processing
$ingresos_update->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var ingresos_update = new ew_Page("ingresos_update");

// page properties
ingresos_update.PageID = "update"; // page ID
var EW_PAGE_ID = ingresos_update.PageID; // for backward compatibility

// extend page with ValidateForm function
ingresos_update.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	if (!ew_UpdateSelected(fobj)) {
		alert('No se ha seleccionado campo a actualizar');
		return false;
	}
	var uelm;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_tipo_ingreso"];
		uelm = fobj.elements["u" + infix + "_tipo_ingreso"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Tipo Ingreso");
		}
		elm = fobj.elements["x" + infix + "_estado"];
		uelm = fobj.elements["u" + infix + "_estado"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Estado");
		}
		elm = fobj.elements["x" + infix + "_Numero_Factura"];
		uelm = fobj.elements["u" + infix + "_Numero_Factura"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Numero Factura");
		}
		elm = fobj.elements["x" + infix + "_Fecha_Factura"];
		uelm = fobj.elements["u" + infix + "_Fecha_Factura"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Fecha Factura");
		}
		elm = fobj.elements["x" + infix + "_Fecha_Factura"];
		uelm = fobj.elements["u" + infix + "_Fecha_Factura"];
		if (uelm && uelm.checked) {
			if (elm && !ew_CheckEuroDate(elm.value))
				return ew_OnError(this, elm, "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Factura");
		}
		elm = fobj.elements["x" + infix + "_Fecha_Dep"];
		uelm = fobj.elements["u" + infix + "_Fecha_Dep"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Fecha Deposito");
		}
		elm = fobj.elements["x" + infix + "_Fecha_Dep"];
		uelm = fobj.elements["u" + infix + "_Fecha_Dep"];
		if (uelm && uelm.checked) {
			if (elm && !ew_CheckEuroDate(elm.value))
				return ew_OnError(this, elm, "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Deposito");
		}
		elm = fobj.elements["x" + infix + "_Descripcion"];
		uelm = fobj.elements["u" + infix + "_Descripcion"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Descripcion");
		}
		elm = fobj.elements["x" + infix + "_Valor_RD"];
		uelm = fobj.elements["u" + infix + "_Valor_RD"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Valor RD");
		}
		elm = fobj.elements["x" + infix + "_Valor_RD"];
		uelm = fobj.elements["u" + infix + "_Valor_RD"];
		if (uelm && uelm.checked) {
			if (elm && !ew_CheckNumber(elm.value))
				return ew_OnError(this, elm, "Decimal Incorrecto - Valor RD");
		}
		elm = fobj.elements["x" + infix + "_Valor_US"];
		uelm = fobj.elements["u" + infix + "_Valor_US"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Valor US");
		}
		elm = fobj.elements["x" + infix + "_Valor_US"];
		uelm = fobj.elements["u" + infix + "_Valor_US"];
		if (uelm && uelm.checked) {
			if (elm && !ew_CheckNumber(elm.value))
				return ew_OnError(this, elm, "Decimal Incorrecto - Valor US");
		}
		elm = fobj.elements["x" + infix + "_Valor_Euros"];
		uelm = fobj.elements["u" + infix + "_Valor_Euros"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Valor Euros");
		}
		elm = fobj.elements["x" + infix + "_Valor_Euros"];
		uelm = fobj.elements["u" + infix + "_Valor_Euros"];
		if (uelm && uelm.checked) {
			if (elm && !ew_CheckNumber(elm.value))
				return ew_OnError(this, elm, "Decimal Incorrecto - Valor Euros");
		}
		elm = fobj.elements["x" + infix + "_Valor_Tarjeta_credito"];
		uelm = fobj.elements["u" + infix + "_Valor_Tarjeta_credito"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Valor Tarjeta Credito");
		}
		elm = fobj.elements["x" + infix + "_Valor_Tarjeta_credito"];
		uelm = fobj.elements["u" + infix + "_Valor_Tarjeta_credito"];
		if (uelm && uelm.checked) {
			if (elm && !ew_CheckNumber(elm.value))
				return ew_OnError(this, elm, "Decimal Incorrecto - Valor Tarjeta Credito");
		}
		elm = fobj.elements["x" + infix + "_Empresa"];
		uelm = fobj.elements["u" + infix + "_Empresa"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Empresa");
		}
		elm = fobj.elements["x" + infix + "_tipo_comprobante"];
		uelm = fobj.elements["u" + infix + "_tipo_comprobante"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Tipo Comprobante");
		}
		elm = fobj.elements["x" + infix + "_locacion"];
		uelm = fobj.elements["u" + infix + "_locacion"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Locacion");
		}
		elm = fobj.elements["x" + infix + "_cuenta_banco"];
		uelm = fobj.elements["u" + infix + "_cuenta_banco"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Ingrese el campo requerido - Cuenta Banco");
		}

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
ingresos_update.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
ingresos_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
ingresos_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
ingresos_update.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="arenas">Actualizar Modulo: Ingresos<br><br>
<a href="<?php echo $ingresos->getReturnUrl() ?>">Volver a la lista</a></span></p>
<?php $ingresos_update->ShowMessage() ?>
<form name="fingresosupdate" id="fingresosupdate" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return ingresos_update.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="ingresos">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php for ($i = 0; $i < $ingresos_update->nKeySelected; $i++) { ?>
<input type="hidden" name="k<?php echo $i+1 ?>_key" id="key<?php echo $i+1 ?>" value="<?php echo ew_HtmlEncode($ingresos_update->arRecKeys[$i]) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr class="ewTableHeader">
		<td>Actualizar<input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td>Nombre del campo</td>
		<td>Nuevo valor</td>
	</tr>
<?php if ($ingresos->tipo_ingreso->Visible) { // tipo_ingreso ?>
	<tr<?php echo $ingresos->tipo_ingreso->RowAttributes ?>>
		<td<?php echo $ingresos->tipo_ingreso->CellAttributes() ?>>
<input type="checkbox" name="u_tipo_ingreso" id="u_tipo_ingreso" value="1"<?php echo ($ingresos->tipo_ingreso->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->tipo_ingreso->CellAttributes() ?>>Tipo Ingreso</td>
		<td<?php echo $ingresos->tipo_ingreso->CellAttributes() ?>><span id="el_tipo_ingreso">
<select id="x_tipo_ingreso" name="x_tipo_ingreso"<?php echo $ingresos->tipo_ingreso->EditAttributes() ?>>
<?php
if (is_array($ingresos->tipo_ingreso->EditValue)) {
	$arwrk = $ingresos->tipo_ingreso->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($ingresos->tipo_ingreso->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $ingresos->tipo_ingreso->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->estado->Visible) { // estado ?>
	<tr<?php echo $ingresos->estado->RowAttributes ?>>
		<td<?php echo $ingresos->estado->CellAttributes() ?>>
<input type="checkbox" name="u_estado" id="u_estado" value="1"<?php echo ($ingresos->estado->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->estado->CellAttributes() ?>>Estado</td>
		<td<?php echo $ingresos->estado->CellAttributes() ?>><span id="el_estado">
<select id="x_estado" name="x_estado"<?php echo $ingresos->estado->EditAttributes() ?>>
<?php
if (is_array($ingresos->estado->EditValue)) {
	$arwrk = $ingresos->estado->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($ingresos->estado->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $ingresos->estado->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Numero_Factura->Visible) { // Numero_Factura ?>
	<tr<?php echo $ingresos->Numero_Factura->RowAttributes ?>>
		<td<?php echo $ingresos->Numero_Factura->CellAttributes() ?>>
<input type="checkbox" name="u_Numero_Factura" id="u_Numero_Factura" value="1"<?php echo ($ingresos->Numero_Factura->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->Numero_Factura->CellAttributes() ?>>Numero Factura</td>
		<td<?php echo $ingresos->Numero_Factura->CellAttributes() ?>><span id="el_Numero_Factura">
<input type="text" name="x_Numero_Factura" id="x_Numero_Factura" size="30" maxlength="25" value="<?php echo $ingresos->Numero_Factura->EditValue ?>"<?php echo $ingresos->Numero_Factura->EditAttributes() ?>>
</span><?php echo $ingresos->Numero_Factura->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Fecha_Factura->Visible) { // Fecha_Factura ?>
	<tr<?php echo $ingresos->Fecha_Factura->RowAttributes ?>>
		<td<?php echo $ingresos->Fecha_Factura->CellAttributes() ?>>
<input type="checkbox" name="u_Fecha_Factura" id="u_Fecha_Factura" value="1"<?php echo ($ingresos->Fecha_Factura->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->Fecha_Factura->CellAttributes() ?>>Fecha Factura</td>
		<td<?php echo $ingresos->Fecha_Factura->CellAttributes() ?>><span id="el_Fecha_Factura">
<input type="text" name="x_Fecha_Factura" id="x_Fecha_Factura" value="<?php echo $ingresos->Fecha_Factura->EditValue ?>"<?php echo $ingresos->Fecha_Factura->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Fecha_Factura" name="cal_x_Fecha_Factura" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_Fecha_Factura", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_Fecha_Factura" // ID of the button
});
</script>
</span><?php echo $ingresos->Fecha_Factura->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Fecha_Dep->Visible) { // Fecha_Dep ?>
	<tr<?php echo $ingresos->Fecha_Dep->RowAttributes ?>>
		<td<?php echo $ingresos->Fecha_Dep->CellAttributes() ?>>
<input type="checkbox" name="u_Fecha_Dep" id="u_Fecha_Dep" value="1"<?php echo ($ingresos->Fecha_Dep->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->Fecha_Dep->CellAttributes() ?>>Fecha Deposito</td>
		<td<?php echo $ingresos->Fecha_Dep->CellAttributes() ?>><span id="el_Fecha_Dep">
<input type="text" name="x_Fecha_Dep" id="x_Fecha_Dep" value="<?php echo $ingresos->Fecha_Dep->EditValue ?>"<?php echo $ingresos->Fecha_Dep->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Fecha_Dep" name="cal_x_Fecha_Dep" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_Fecha_Dep", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_Fecha_Dep" // ID of the button
});
</script>
</span><?php echo $ingresos->Fecha_Dep->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Descripcion->Visible) { // Descripcion ?>
	<tr<?php echo $ingresos->Descripcion->RowAttributes ?>>
		<td<?php echo $ingresos->Descripcion->CellAttributes() ?>>
<input type="checkbox" name="u_Descripcion" id="u_Descripcion" value="1"<?php echo ($ingresos->Descripcion->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->Descripcion->CellAttributes() ?>>Descripcion</td>
		<td<?php echo $ingresos->Descripcion->CellAttributes() ?>><span id="el_Descripcion">
<textarea name="x_Descripcion" id="x_Descripcion" cols="35" rows="4"<?php echo $ingresos->Descripcion->EditAttributes() ?>><?php echo $ingresos->Descripcion->EditValue ?></textarea>
</span><?php echo $ingresos->Descripcion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Valor_RD->Visible) { // Valor_RD ?>
	<tr<?php echo $ingresos->Valor_RD->RowAttributes ?>>
		<td<?php echo $ingresos->Valor_RD->CellAttributes() ?>>
<input type="checkbox" name="u_Valor_RD" id="u_Valor_RD" value="1"<?php echo ($ingresos->Valor_RD->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->Valor_RD->CellAttributes() ?>>Valor RD</td>
		<td<?php echo $ingresos->Valor_RD->CellAttributes() ?>><span id="el_Valor_RD">
<input type="text" name="x_Valor_RD" id="x_Valor_RD" size="30" maxlength="25" value="<?php echo $ingresos->Valor_RD->EditValue ?>"<?php echo $ingresos->Valor_RD->EditAttributes() ?>>
</span><?php echo $ingresos->Valor_RD->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Valor_US->Visible) { // Valor_US ?>
	<tr<?php echo $ingresos->Valor_US->RowAttributes ?>>
		<td<?php echo $ingresos->Valor_US->CellAttributes() ?>>
<input type="checkbox" name="u_Valor_US" id="u_Valor_US" value="1"<?php echo ($ingresos->Valor_US->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->Valor_US->CellAttributes() ?>>Valor US</td>
		<td<?php echo $ingresos->Valor_US->CellAttributes() ?>><span id="el_Valor_US">
<input type="text" name="x_Valor_US" id="x_Valor_US" size="30" maxlength="25" value="<?php echo $ingresos->Valor_US->EditValue ?>"<?php echo $ingresos->Valor_US->EditAttributes() ?>>
</span><?php echo $ingresos->Valor_US->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Valor_Euros->Visible) { // Valor_Euros ?>
	<tr<?php echo $ingresos->Valor_Euros->RowAttributes ?>>
		<td<?php echo $ingresos->Valor_Euros->CellAttributes() ?>>
<input type="checkbox" name="u_Valor_Euros" id="u_Valor_Euros" value="1"<?php echo ($ingresos->Valor_Euros->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->Valor_Euros->CellAttributes() ?>>Valor Euros</td>
		<td<?php echo $ingresos->Valor_Euros->CellAttributes() ?>><span id="el_Valor_Euros">
<input type="text" name="x_Valor_Euros" id="x_Valor_Euros" size="30" value="<?php echo $ingresos->Valor_Euros->EditValue ?>"<?php echo $ingresos->Valor_Euros->EditAttributes() ?>>
</span><?php echo $ingresos->Valor_Euros->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Valor_Tarjeta_credito->Visible) { // Valor_Tarjeta_credito ?>
	<tr<?php echo $ingresos->Valor_Tarjeta_credito->RowAttributes ?>>
		<td<?php echo $ingresos->Valor_Tarjeta_credito->CellAttributes() ?>>
<input type="checkbox" name="u_Valor_Tarjeta_credito" id="u_Valor_Tarjeta_credito" value="1"<?php echo ($ingresos->Valor_Tarjeta_credito->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->Valor_Tarjeta_credito->CellAttributes() ?>>Valor Tarjeta Credito</td>
		<td<?php echo $ingresos->Valor_Tarjeta_credito->CellAttributes() ?>><span id="el_Valor_Tarjeta_credito">
<input type="text" name="x_Valor_Tarjeta_credito" id="x_Valor_Tarjeta_credito" size="30" maxlength="25" value="<?php echo $ingresos->Valor_Tarjeta_credito->EditValue ?>"<?php echo $ingresos->Valor_Tarjeta_credito->EditAttributes() ?>>
</span><?php echo $ingresos->Valor_Tarjeta_credito->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Empresa->Visible) { // Empresa ?>
	<tr<?php echo $ingresos->Empresa->RowAttributes ?>>
		<td<?php echo $ingresos->Empresa->CellAttributes() ?>>
<input type="checkbox" name="u_Empresa" id="u_Empresa" value="1"<?php echo ($ingresos->Empresa->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->Empresa->CellAttributes() ?>>Empresa</td>
		<td<?php echo $ingresos->Empresa->CellAttributes() ?>><span id="el_Empresa">
<select id="x_Empresa" name="x_Empresa"<?php echo $ingresos->Empresa->EditAttributes() ?>>
<?php
if (is_array($ingresos->Empresa->EditValue)) {
	$arwrk = $ingresos->Empresa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($ingresos->Empresa->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $ingresos->Empresa->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->tipo_comprobante->Visible) { // tipo_comprobante ?>
	<tr<?php echo $ingresos->tipo_comprobante->RowAttributes ?>>
		<td<?php echo $ingresos->tipo_comprobante->CellAttributes() ?>>
<input type="checkbox" name="u_tipo_comprobante" id="u_tipo_comprobante" value="1"<?php echo ($ingresos->tipo_comprobante->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->tipo_comprobante->CellAttributes() ?>>Tipo Comprobante</td>
		<td<?php echo $ingresos->tipo_comprobante->CellAttributes() ?>><span id="el_tipo_comprobante">
<select id="x_tipo_comprobante" name="x_tipo_comprobante"<?php echo $ingresos->tipo_comprobante->EditAttributes() ?>>
<?php
if (is_array($ingresos->tipo_comprobante->EditValue)) {
	$arwrk = $ingresos->tipo_comprobante->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($ingresos->tipo_comprobante->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $ingresos->tipo_comprobante->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->NCF->Visible) { // NCF ?>
	<tr<?php echo $ingresos->NCF->RowAttributes ?>>
		<td<?php echo $ingresos->NCF->CellAttributes() ?>>
<input type="checkbox" name="u_NCF" id="u_NCF" value="1"<?php echo ($ingresos->NCF->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->NCF->CellAttributes() ?>>NCF</td>
		<td<?php echo $ingresos->NCF->CellAttributes() ?>><span id="el_NCF">
<input type="text" name="x_NCF" id="x_NCF" size="30" maxlength="255" value="<?php echo $ingresos->NCF->EditValue ?>"<?php echo $ingresos->NCF->EditAttributes() ?>>
</span><?php echo $ingresos->NCF->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->locacion->Visible) { // locacion ?>
	<tr<?php echo $ingresos->locacion->RowAttributes ?>>
		<td<?php echo $ingresos->locacion->CellAttributes() ?>>
<input type="checkbox" name="u_locacion" id="u_locacion" value="1"<?php echo ($ingresos->locacion->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->locacion->CellAttributes() ?>>Locacion</td>
		<td<?php echo $ingresos->locacion->CellAttributes() ?>><span id="el_locacion">
<?php if ($ingresos->locacion->getSessionValue() <> "") { ?>
<div<?php echo $ingresos->locacion->ViewAttributes() ?>><?php echo $ingresos->locacion->ViewValue ?></div>
<input type="hidden" id="x_locacion" name="x_locacion" value="<?php echo ew_HtmlEncode($ingresos->locacion->CurrentValue) ?>">
<?php } else { ?>
<div id="tp_x_locacion" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME; ?>"><input type="checkbox" name="x_locacion[]" id="x_locacion[]" value="{value}"<?php echo $ingresos->locacion->EditAttributes() ?>></div>
<div id="dsl_x_locacion" repeatcolumn="4">
<?php
$arwrk = $ingresos->locacion->EditValue;
if (is_array($arwrk)) {
	$armultiwrk= explode(",", strval($ingresos->locacion->CurrentValue));
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = "";
		for ($ari = 0; $ari < count($armultiwrk); $ari++) {
			if (strval($arwrk[$rowcntwrk][0]) == trim(strval($armultiwrk[$ari]))) {
				$selwrk = " checked=\"checked\"";
				if ($selwrk <> "") $emptywrk = FALSE;
				break;
			}
		}

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 4, 1) ?>
<label><input type="checkbox" name="x_locacion[]" id="x_locacion[]" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $ingresos->locacion->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 4, 2) ?>
<?php
	}
}
?>
</div>
<?php } ?>
</span><?php echo $ingresos->locacion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->cuenta_banco->Visible) { // cuenta_banco ?>
	<tr<?php echo $ingresos->cuenta_banco->RowAttributes ?>>
		<td<?php echo $ingresos->cuenta_banco->CellAttributes() ?>>
<input type="checkbox" name="u_cuenta_banco" id="u_cuenta_banco" value="1"<?php echo ($ingresos->cuenta_banco->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->cuenta_banco->CellAttributes() ?>>Cuenta Banco</td>
		<td<?php echo $ingresos->cuenta_banco->CellAttributes() ?>><span id="el_cuenta_banco">
<select id="x_cuenta_banco" name="x_cuenta_banco"<?php echo $ingresos->cuenta_banco->EditAttributes() ?>>
<?php
if (is_array($ingresos->cuenta_banco->EditValue)) {
	$arwrk = $ingresos->cuenta_banco->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($ingresos->cuenta_banco->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $ingresos->cuenta_banco->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->proveedor->Visible) { // proveedor ?>
	<tr<?php echo $ingresos->proveedor->RowAttributes ?>>
		<td<?php echo $ingresos->proveedor->CellAttributes() ?>>
<input type="checkbox" name="u_proveedor" id="u_proveedor" value="1"<?php echo ($ingresos->proveedor->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $ingresos->proveedor->CellAttributes() ?>>Proveedor</td>
		<td<?php echo $ingresos->proveedor->CellAttributes() ?>><span id="el_proveedor">
<?php if ($ingresos->proveedor->getSessionValue() <> "") { ?>
<div<?php echo $ingresos->proveedor->ViewAttributes() ?>><?php echo $ingresos->proveedor->ViewValue ?></div>
<input type="hidden" id="x_proveedor" name="x_proveedor" value="<?php echo ew_HtmlEncode($ingresos->proveedor->CurrentValue) ?>">
<?php } else { ?>
<select id="x_proveedor" name="x_proveedor"<?php echo $ingresos->proveedor->EditAttributes() ?>>
<?php
if (is_array($ingresos->proveedor->EditValue)) {
	$arwrk = $ingresos->proveedor->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($ingresos->proveedor->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
</span><?php echo $ingresos->proveedor->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="Actualizar">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class cingresos_update {

	// Page ID
	var $PageID = 'update';

	// Table Name
	var $TableName = 'ingresos';

	// Page Object Name
	var $PageObjName = 'ingresos_update';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $ingresos;
		if ($ingresos->UseTokenInUrl) $PageUrl .= "t=" . $ingresos->TableVar . "&"; // add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show Message
	function ShowMessage() {
		if ($this->getMessage() <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $this->getMessage() . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate Page request
	function IsPageRequest() {
		global $objForm, $ingresos;
		if ($ingresos->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($ingresos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($ingresos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cingresos_update() {
		global $conn;

		// Initialize table object
		$GLOBALS["ingresos"] = new cingresos();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Initialize other table object
		$GLOBALS['proveedores'] = new cproveedores();

		// Initialize other table object
		$GLOBALS['locaciones'] = new clocaciones();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'ingresos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $ingresos;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Global page loading event (in userfn6.php)
		Page_Loading();

		// Page load event, used in current page
		$this->Page_Load();
	}

	//
	//  Page_Terminate
	//  - called when exit page
	//  - if URL specified, redirect to the URL
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page unload event, used in current page
		$this->Page_Unload();

		// Global page unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close Connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			ob_end_clean();
			header("Location: $url");
		}
		exit();
	}
	var $nKeySelected;
	var $arRecKeys;
	var $sDisabled;

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $ingresos;

		// Try to load keys from list form
		$this->nKeySelected = 0;
		if (ew_IsHttpPost()) {
			if (isset($_POST["key_m"])) { // Key count > 0
				$this->nKeySelected = count($_POST["key_m"]); // Get number of keys
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
				$this->LoadMultiUpdateValues(); // Load initial values to form
			}
		}

		// Try to load key from update form
		if ($this->nKeySelected == 0) {
			$this->arRecKeys = array();

			// Create form object
			$objForm = new cFormObj();
			if (@$_POST["a_update"] <> "") {

				// Get action
				$ingresos->CurrentAction = $_POST["a_update"];

				// Get record keys
				$sKey = @$_POST["k" . strval($this->nKeySelected+1) . "_key"];
				while ($sKey <> "") {
					$this->arRecKeys[$this->nKeySelected] = ew_StripSlashes($sKey);
					$this->nKeySelected++;
					$sKey = @$_POST["k" . strval($this->nKeySelected+1) . "_key"];
				}
				$this->LoadFormValues(); // Get form values

				// Validate Form
				if (!$this->ValidateForm()) {
					$ingresos->CurrentAction = "I"; // Form error, reset action
					$this->setMessage($gsFormError);
				}
			}
		}
		if ($this->nKeySelected <= 0)
			$this->Page_Terminate("ingresoslist.php"); // No records selected, return to list
		switch ($ingresos->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setMessage("Actualizar completado"); // Set update success message
					$this->Page_Terminate($ingresos->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$ingresos->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $ingresos;
		$ingresos->CurrentFilter = $this->BuildKeyFilter();

		// Load recordset
		$rs = $this->LoadRecordset();
		$i = 1;
		while (!$rs->EOF) {
			if ($i == 1) {
				$ingresos->tipo_ingreso->setDbValue($rs->fields('tipo_ingreso'));
				$ingresos->estado->setDbValue($rs->fields('estado'));
				$ingresos->Numero_Factura->setDbValue($rs->fields('Numero_Factura'));
				$ingresos->Fecha_Factura->setDbValue($rs->fields('Fecha_Factura'));
				$ingresos->Fecha_Dep->setDbValue($rs->fields('Fecha_Dep'));
				$ingresos->Descripcion->setDbValue($rs->fields('Descripcion'));
				$ingresos->Valor_RD->setDbValue($rs->fields('Valor_RD'));
				$ingresos->Valor_US->setDbValue($rs->fields('Valor_US'));
				$ingresos->Valor_Euros->setDbValue($rs->fields('Valor_Euros'));
				$ingresos->Valor_Tarjeta_credito->setDbValue($rs->fields('Valor_Tarjeta_credito'));
				$ingresos->Empresa->setDbValue($rs->fields('Empresa'));
				$ingresos->tipo_comprobante->setDbValue($rs->fields('tipo_comprobante'));
				$ingresos->NCF->setDbValue($rs->fields('NCF'));
				$ingresos->locacion->setDbValue($rs->fields('locacion'));
				$ingresos->cuenta_banco->setDbValue($rs->fields('cuenta_banco'));
				$ingresos->proveedor->setDbValue($rs->fields('proveedor'));
			} else {
				if (!ew_CompareValue($ingresos->tipo_ingreso->DbValue, $rs->fields('tipo_ingreso')))
					$ingresos->tipo_ingreso->CurrentValue = NULL;
				if (!ew_CompareValue($ingresos->estado->DbValue, $rs->fields('estado')))
					$ingresos->estado->CurrentValue = NULL;
				if (!ew_CompareValue($ingresos->Numero_Factura->DbValue, $rs->fields('Numero_Factura')))
					$ingresos->Numero_Factura->CurrentValue = NULL;
				if (!ew_CompareValue($ingresos->Fecha_Factura->DbValue, $rs->fields('Fecha_Factura')))
					$ingresos->Fecha_Factura->CurrentValue = NULL;
				if (!ew_CompareValue($ingresos->Fecha_Dep->DbValue, $rs->fields('Fecha_Dep')))
					$ingresos->Fecha_Dep->CurrentValue = NULL;
				if (!ew_CompareValue($ingresos->Descripcion->DbValue, $rs->fields('Descripcion')))
					$ingresos->Descripcion->CurrentValue = NULL;
				if (!ew_CompareValue($ingresos->Valor_RD->DbValue, $rs->fields('Valor_RD')))
					$ingresos->Valor_RD->CurrentValue = NULL;
				if (!ew_CompareValue($ingresos->Valor_US->DbValue, $rs->fields('Valor_US')))
					$ingresos->Valor_US->CurrentValue = NULL;
				if (!ew_CompareValue($ingresos->Valor_Euros->DbValue, $rs->fields('Valor_Euros')))
					$ingresos->Valor_Euros->CurrentValue = NULL;
				if (!ew_CompareValue($ingresos->Valor_Tarjeta_credito->DbValue, $rs->fields('Valor_Tarjeta_credito')))
					$ingresos->Valor_Tarjeta_credito->CurrentValue = NULL;
				if (!ew_CompareValue($ingresos->Empresa->DbValue, $rs->fields('Empresa')))
					$ingresos->Empresa->CurrentValue = NULL;
				if (!ew_CompareValue($ingresos->tipo_comprobante->DbValue, $rs->fields('tipo_comprobante')))
					$ingresos->tipo_comprobante->CurrentValue = NULL;
				if (!ew_CompareValue($ingresos->NCF->DbValue, $rs->fields('NCF')))
					$ingresos->NCF->CurrentValue = NULL;
				if (!ew_CompareValue($ingresos->locacion->DbValue, $rs->fields('locacion')))
					$ingresos->locacion->CurrentValue = NULL;
				if (!ew_CompareValue($ingresos->cuenta_banco->DbValue, $rs->fields('cuenta_banco')))
					$ingresos->cuenta_banco->CurrentValue = NULL;
				if (!ew_CompareValue($ingresos->proveedor->DbValue, $rs->fields('proveedor')))
					$ingresos->proveedor->CurrentValue = NULL;
			}
			$i++;
			$rs->MoveNext();
		}
		$rs->Close();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $ingresos;
		$sWrkFilter = "";
		foreach ($this->arRecKeys as $sKey) {
			$sKey = trim($sKey);
			if ($this->SetupKeyValues($sKey)) {
				$sFilter = $ingresos->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}
		}
		return $sWrkFilter;
	}

	// Set up key value
	function SetupKeyValues($key) {
		global $ingresos;
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$ingresos->id_ingreso->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $ingresos;
		$conn->BeginTrans();

		// Get old recordset
		$ingresos->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $ingresos->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->arRecKeys as $sThisKey) {
			$sThisKey = trim($sThisKey);
			if ($this->SetupKeyValues($sThisKey)) {
				$ingresos->SendEmail = FALSE; // Do not send email on update success
				$UpdateRows = $this->EditRow(); // Update this row
			} else {
				$UpdateRows = FALSE;
			}
			if (!$UpdateRows)
				return; // Update failed
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}

		// Check if all rows updated
		if ($UpdateRows) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$rsnew = $conn->Execute($sSql);
		} else {
			$conn->RollbackTrans(); // Rollback transaction
		}
		return $UpdateRows;
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $ingresos;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $ingresos;
		$ingresos->tipo_ingreso->setFormValue($objForm->GetValue("x_tipo_ingreso"));
		$ingresos->tipo_ingreso->MultiUpdate = $objForm->GetValue("u_tipo_ingreso");
		$ingresos->estado->setFormValue($objForm->GetValue("x_estado"));
		$ingresos->estado->MultiUpdate = $objForm->GetValue("u_estado");
		$ingresos->Numero_Factura->setFormValue($objForm->GetValue("x_Numero_Factura"));
		$ingresos->Numero_Factura->MultiUpdate = $objForm->GetValue("u_Numero_Factura");
		$ingresos->Fecha_Factura->setFormValue($objForm->GetValue("x_Fecha_Factura"));
		$ingresos->Fecha_Factura->CurrentValue = ew_UnFormatDateTime($ingresos->Fecha_Factura->CurrentValue, 7);
		$ingresos->Fecha_Factura->MultiUpdate = $objForm->GetValue("u_Fecha_Factura");
		$ingresos->Fecha_Dep->setFormValue($objForm->GetValue("x_Fecha_Dep"));
		$ingresos->Fecha_Dep->CurrentValue = ew_UnFormatDateTime($ingresos->Fecha_Dep->CurrentValue, 7);
		$ingresos->Fecha_Dep->MultiUpdate = $objForm->GetValue("u_Fecha_Dep");
		$ingresos->Descripcion->setFormValue($objForm->GetValue("x_Descripcion"));
		$ingresos->Descripcion->MultiUpdate = $objForm->GetValue("u_Descripcion");
		$ingresos->Valor_RD->setFormValue($objForm->GetValue("x_Valor_RD"));
		$ingresos->Valor_RD->MultiUpdate = $objForm->GetValue("u_Valor_RD");
		$ingresos->Valor_US->setFormValue($objForm->GetValue("x_Valor_US"));
		$ingresos->Valor_US->MultiUpdate = $objForm->GetValue("u_Valor_US");
		$ingresos->Valor_Euros->setFormValue($objForm->GetValue("x_Valor_Euros"));
		$ingresos->Valor_Euros->MultiUpdate = $objForm->GetValue("u_Valor_Euros");
		$ingresos->Valor_Tarjeta_credito->setFormValue($objForm->GetValue("x_Valor_Tarjeta_credito"));
		$ingresos->Valor_Tarjeta_credito->MultiUpdate = $objForm->GetValue("u_Valor_Tarjeta_credito");
		$ingresos->Empresa->setFormValue($objForm->GetValue("x_Empresa"));
		$ingresos->Empresa->MultiUpdate = $objForm->GetValue("u_Empresa");
		$ingresos->tipo_comprobante->setFormValue($objForm->GetValue("x_tipo_comprobante"));
		$ingresos->tipo_comprobante->MultiUpdate = $objForm->GetValue("u_tipo_comprobante");
		$ingresos->NCF->setFormValue($objForm->GetValue("x_NCF"));
		$ingresos->NCF->MultiUpdate = $objForm->GetValue("u_NCF");
		$ingresos->locacion->setFormValue($objForm->GetValue("x_locacion"));
		$ingresos->locacion->MultiUpdate = $objForm->GetValue("u_locacion");
		$ingresos->cuenta_banco->setFormValue($objForm->GetValue("x_cuenta_banco"));
		$ingresos->cuenta_banco->MultiUpdate = $objForm->GetValue("u_cuenta_banco");
		$ingresos->proveedor->setFormValue($objForm->GetValue("x_proveedor"));
		$ingresos->proveedor->MultiUpdate = $objForm->GetValue("u_proveedor");
		$ingresos->id_ingreso->setFormValue($objForm->GetValue("x_id_ingreso"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $ingresos;
		$ingresos->id_ingreso->CurrentValue = $ingresos->id_ingreso->FormValue;
		$ingresos->tipo_ingreso->CurrentValue = $ingresos->tipo_ingreso->FormValue;
		$ingresos->estado->CurrentValue = $ingresos->estado->FormValue;
		$ingresos->Numero_Factura->CurrentValue = $ingresos->Numero_Factura->FormValue;
		$ingresos->Fecha_Factura->CurrentValue = $ingresos->Fecha_Factura->FormValue;
		$ingresos->Fecha_Factura->CurrentValue = ew_UnFormatDateTime($ingresos->Fecha_Factura->CurrentValue, 7);
		$ingresos->Fecha_Dep->CurrentValue = $ingresos->Fecha_Dep->FormValue;
		$ingresos->Fecha_Dep->CurrentValue = ew_UnFormatDateTime($ingresos->Fecha_Dep->CurrentValue, 7);
		$ingresos->Descripcion->CurrentValue = $ingresos->Descripcion->FormValue;
		$ingresos->Valor_RD->CurrentValue = $ingresos->Valor_RD->FormValue;
		$ingresos->Valor_US->CurrentValue = $ingresos->Valor_US->FormValue;
		$ingresos->Valor_Euros->CurrentValue = $ingresos->Valor_Euros->FormValue;
		$ingresos->Valor_Tarjeta_credito->CurrentValue = $ingresos->Valor_Tarjeta_credito->FormValue;
		$ingresos->Empresa->CurrentValue = $ingresos->Empresa->FormValue;
		$ingresos->tipo_comprobante->CurrentValue = $ingresos->tipo_comprobante->FormValue;
		$ingresos->NCF->CurrentValue = $ingresos->NCF->FormValue;
		$ingresos->locacion->CurrentValue = $ingresos->locacion->FormValue;
		$ingresos->cuenta_banco->CurrentValue = $ingresos->cuenta_banco->FormValue;
		$ingresos->proveedor->CurrentValue = $ingresos->proveedor->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $ingresos;

		// Call Recordset Selecting event
		$ingresos->Recordset_Selecting($ingresos->CurrentFilter);

		// Load list page SQL
		$sSql = $ingresos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$ingresos->Recordset_Selected($rs);
		return $rs;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $ingresos;

		// Call Row_Rendering event
		$ingresos->Row_Rendering();

		// Common render codes for all row types
		// tipo_ingreso

		$ingresos->tipo_ingreso->CellCssStyle = "";
		$ingresos->tipo_ingreso->CellCssClass = "";

		// estado
		$ingresos->estado->CellCssStyle = "";
		$ingresos->estado->CellCssClass = "";

		// Numero_Factura
		$ingresos->Numero_Factura->CellCssStyle = "";
		$ingresos->Numero_Factura->CellCssClass = "";

		// Fecha_Factura
		$ingresos->Fecha_Factura->CellCssStyle = "";
		$ingresos->Fecha_Factura->CellCssClass = "";

		// Fecha_Dep
		$ingresos->Fecha_Dep->CellCssStyle = "";
		$ingresos->Fecha_Dep->CellCssClass = "";

		// Descripcion
		$ingresos->Descripcion->CellCssStyle = "";
		$ingresos->Descripcion->CellCssClass = "";

		// Valor_RD
		$ingresos->Valor_RD->CellCssStyle = "";
		$ingresos->Valor_RD->CellCssClass = "";

		// Valor_US
		$ingresos->Valor_US->CellCssStyle = "";
		$ingresos->Valor_US->CellCssClass = "";

		// Valor_Euros
		$ingresos->Valor_Euros->CellCssStyle = "";
		$ingresos->Valor_Euros->CellCssClass = "";

		// Valor_Tarjeta_credito
		$ingresos->Valor_Tarjeta_credito->CellCssStyle = "";
		$ingresos->Valor_Tarjeta_credito->CellCssClass = "";

		// Empresa
		$ingresos->Empresa->CellCssStyle = "";
		$ingresos->Empresa->CellCssClass = "";

		// tipo_comprobante
		$ingresos->tipo_comprobante->CellCssStyle = "";
		$ingresos->tipo_comprobante->CellCssClass = "";

		// NCF
		$ingresos->NCF->CellCssStyle = "";
		$ingresos->NCF->CellCssClass = "";

		// locacion
		$ingresos->locacion->CellCssStyle = "";
		$ingresos->locacion->CellCssClass = "";

		// cuenta_banco
		$ingresos->cuenta_banco->CellCssStyle = "";
		$ingresos->cuenta_banco->CellCssClass = "";

		// proveedor
		$ingresos->proveedor->CellCssStyle = "";
		$ingresos->proveedor->CellCssClass = "";
		if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_ingreso
			$ingresos->id_ingreso->ViewValue = $ingresos->id_ingreso->CurrentValue;
			$ingresos->id_ingreso->CssStyle = "";
			$ingresos->id_ingreso->CssClass = "";
			$ingresos->id_ingreso->ViewCustomAttributes = "";

			// tipo_ingreso
			if (strval($ingresos->tipo_ingreso->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `ingresos_tipos` WHERE `id_ingresos` = " . ew_AdjustSql($ingresos->tipo_ingreso->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$ingresos->tipo_ingreso->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$ingresos->tipo_ingreso->ViewValue = $ingresos->tipo_ingreso->CurrentValue;
				}
			} else {
				$ingresos->tipo_ingreso->ViewValue = NULL;
			}
			$ingresos->tipo_ingreso->CssStyle = "";
			$ingresos->tipo_ingreso->CssClass = "";
			$ingresos->tipo_ingreso->ViewCustomAttributes = "";

			// estado
			if (strval($ingresos->estado->CurrentValue) <> "") {
				switch ($ingresos->estado->CurrentValue) {
					case "Cobrado":
						$ingresos->estado->ViewValue = "Cobrado";
						break;
					case "Pendiente":
						$ingresos->estado->ViewValue = "Pendiente";
						break;
					default:
						$ingresos->estado->ViewValue = $ingresos->estado->CurrentValue;
				}
			} else {
				$ingresos->estado->ViewValue = NULL;
			}
			$ingresos->estado->CssStyle = "";
			$ingresos->estado->CssClass = "";
			$ingresos->estado->ViewCustomAttributes = "";

			// Numero_Factura
			$ingresos->Numero_Factura->ViewValue = $ingresos->Numero_Factura->CurrentValue;
			$ingresos->Numero_Factura->CssStyle = "";
			$ingresos->Numero_Factura->CssClass = "";
			$ingresos->Numero_Factura->ViewCustomAttributes = "";

			// Fecha_Factura
			$ingresos->Fecha_Factura->ViewValue = $ingresos->Fecha_Factura->CurrentValue;
			$ingresos->Fecha_Factura->ViewValue = ew_FormatDateTime($ingresos->Fecha_Factura->ViewValue, 7);
			$ingresos->Fecha_Factura->CssStyle = "";
			$ingresos->Fecha_Factura->CssClass = "";
			$ingresos->Fecha_Factura->ViewCustomAttributes = "";

			// Fecha_Dep
			$ingresos->Fecha_Dep->ViewValue = $ingresos->Fecha_Dep->CurrentValue;
			$ingresos->Fecha_Dep->ViewValue = ew_FormatDateTime($ingresos->Fecha_Dep->ViewValue, 7);
			$ingresos->Fecha_Dep->CssStyle = "";
			$ingresos->Fecha_Dep->CssClass = "";
			$ingresos->Fecha_Dep->ViewCustomAttributes = "";

			// Descripcion
			$ingresos->Descripcion->ViewValue = $ingresos->Descripcion->CurrentValue;
			$ingresos->Descripcion->CssStyle = "";
			$ingresos->Descripcion->CssClass = "";
			$ingresos->Descripcion->ViewCustomAttributes = "";

			// Valor_RD
			$ingresos->Valor_RD->ViewValue = $ingresos->Valor_RD->CurrentValue;
			$ingresos->Valor_RD->CssStyle = "";
			$ingresos->Valor_RD->CssClass = "";
			$ingresos->Valor_RD->ViewCustomAttributes = "";

			// Valor_US
			$ingresos->Valor_US->ViewValue = $ingresos->Valor_US->CurrentValue;
			$ingresos->Valor_US->CssStyle = "";
			$ingresos->Valor_US->CssClass = "";
			$ingresos->Valor_US->ViewCustomAttributes = "";

			// Valor_Euros
			$ingresos->Valor_Euros->ViewValue = $ingresos->Valor_Euros->CurrentValue;
			$ingresos->Valor_Euros->CssStyle = "";
			$ingresos->Valor_Euros->CssClass = "";
			$ingresos->Valor_Euros->ViewCustomAttributes = "";

			// Valor_Tarjeta_credito
			$ingresos->Valor_Tarjeta_credito->ViewValue = $ingresos->Valor_Tarjeta_credito->CurrentValue;
			$ingresos->Valor_Tarjeta_credito->CssStyle = "";
			$ingresos->Valor_Tarjeta_credito->CssClass = "";
			$ingresos->Valor_Tarjeta_credito->ViewCustomAttributes = "";

			// Empresa
			if (strval($ingresos->Empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($ingresos->Empresa->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$ingresos->Empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$ingresos->Empresa->ViewValue = $ingresos->Empresa->CurrentValue;
				}
			} else {
				$ingresos->Empresa->ViewValue = NULL;
			}
			$ingresos->Empresa->CssStyle = "";
			$ingresos->Empresa->CssClass = "";
			$ingresos->Empresa->ViewCustomAttributes = "";

			// tipo_comprobante
			if (strval($ingresos->tipo_comprobante->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre_tipo` FROM `comprobantes_tipos` WHERE `nombre_tipo` = '" . ew_AdjustSql($ingresos->tipo_comprobante->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nombre_tipo` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$ingresos->tipo_comprobante->ViewValue = $rswrk->fields('nombre_tipo');
					$rswrk->Close();
				} else {
					$ingresos->tipo_comprobante->ViewValue = $ingresos->tipo_comprobante->CurrentValue;
				}
			} else {
				$ingresos->tipo_comprobante->ViewValue = NULL;
			}
			$ingresos->tipo_comprobante->CssStyle = "";
			$ingresos->tipo_comprobante->CssClass = "";
			$ingresos->tipo_comprobante->ViewCustomAttributes = "";

			// NCF
			$ingresos->NCF->ViewValue = $ingresos->NCF->CurrentValue;
			$ingresos->NCF->CssStyle = "";
			$ingresos->NCF->CssClass = "";
			$ingresos->NCF->ViewCustomAttributes = "";

			// locacion
			if (strval($ingresos->locacion->CurrentValue) <> "") {
				$arwrk = explode(",", $ingresos->locacion->CurrentValue);
				$sSqlWrk = "SELECT `nombre` FROM `locaciones` WHERE ";
				$sWhereWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sWhereWrk <> "") $sWhereWrk .= " OR ";
					$sWhereWrk .= "`id_locacion` = " . ew_AdjustSql(trim($wrk)) . "";
				}
				if ($sWhereWrk <> "") $sSqlWrk .= "(" . $sWhereWrk . ")";
				$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$ingresos->locacion->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$ingresos->locacion->ViewValue .= $rswrk->fields('nombre');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $ingresos->locacion->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$ingresos->locacion->ViewValue = $ingresos->locacion->CurrentValue;
				}
			} else {
				$ingresos->locacion->ViewValue = NULL;
			}
			$ingresos->locacion->CssStyle = "";
			$ingresos->locacion->CssClass = "";
			$ingresos->locacion->ViewCustomAttributes = "";

			// cuenta_banco
			if (strval($ingresos->cuenta_banco->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `Banco`, `numero_cuenta` FROM `cuentas_bancarias` WHERE `id_banco` = " . ew_AdjustSql($ingresos->cuenta_banco->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `Banco` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$ingresos->cuenta_banco->ViewValue = $rswrk->fields('Banco');
					$ingresos->cuenta_banco->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('numero_cuenta');
					$rswrk->Close();
				} else {
					$ingresos->cuenta_banco->ViewValue = $ingresos->cuenta_banco->CurrentValue;
				}
			} else {
				$ingresos->cuenta_banco->ViewValue = NULL;
			}
			$ingresos->cuenta_banco->CssStyle = "";
			$ingresos->cuenta_banco->CssClass = "";
			$ingresos->cuenta_banco->ViewCustomAttributes = "";

			// proveedor
			if (strval($ingresos->proveedor->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `proveedores` WHERE `id_proveedor` = " . ew_AdjustSql($ingresos->proveedor->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$ingresos->proveedor->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$ingresos->proveedor->ViewValue = $ingresos->proveedor->CurrentValue;
				}
			} else {
				$ingresos->proveedor->ViewValue = NULL;
			}
			$ingresos->proveedor->CssStyle = "";
			$ingresos->proveedor->CssClass = "";
			$ingresos->proveedor->ViewCustomAttributes = "";

			// tipo_ingreso
			$ingresos->tipo_ingreso->HrefValue = "";

			// estado
			$ingresos->estado->HrefValue = "";

			// Numero_Factura
			$ingresos->Numero_Factura->HrefValue = "";

			// Fecha_Factura
			$ingresos->Fecha_Factura->HrefValue = "";

			// Fecha_Dep
			$ingresos->Fecha_Dep->HrefValue = "";

			// Descripcion
			$ingresos->Descripcion->HrefValue = "";

			// Valor_RD
			$ingresos->Valor_RD->HrefValue = "";

			// Valor_US
			$ingresos->Valor_US->HrefValue = "";

			// Valor_Euros
			$ingresos->Valor_Euros->HrefValue = "";

			// Valor_Tarjeta_credito
			$ingresos->Valor_Tarjeta_credito->HrefValue = "";

			// Empresa
			$ingresos->Empresa->HrefValue = "";

			// tipo_comprobante
			$ingresos->tipo_comprobante->HrefValue = "";

			// NCF
			$ingresos->NCF->HrefValue = "";

			// locacion
			$ingresos->locacion->HrefValue = "";

			// cuenta_banco
			$ingresos->cuenta_banco->HrefValue = "";

			// proveedor
			$ingresos->proveedor->HrefValue = "";
		} elseif ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// tipo_ingreso
			$ingresos->tipo_ingreso->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_ingresos`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `ingresos_tipos`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nombre` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$ingresos->tipo_ingreso->EditValue = $arwrk;

			// estado
			$ingresos->estado->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("Cobrado", "Cobrado");
			$arwrk[] = array("Pendiente", "Pendiente");
			array_unshift($arwrk, array("", "Seleccionar"));
			$ingresos->estado->EditValue = $arwrk;

			// Numero_Factura
			$ingresos->Numero_Factura->EditCustomAttributes = "";
			$ingresos->Numero_Factura->EditValue = ew_HtmlEncode($ingresos->Numero_Factura->CurrentValue);

			// Fecha_Factura
			$ingresos->Fecha_Factura->EditCustomAttributes = "";
			$ingresos->Fecha_Factura->EditValue = ew_HtmlEncode(ew_FormatDateTime($ingresos->Fecha_Factura->CurrentValue, 7));

			// Fecha_Dep
			$ingresos->Fecha_Dep->EditCustomAttributes = "";
			$ingresos->Fecha_Dep->EditValue = ew_HtmlEncode(ew_FormatDateTime($ingresos->Fecha_Dep->CurrentValue, 7));

			// Descripcion
			$ingresos->Descripcion->EditCustomAttributes = "";
			$ingresos->Descripcion->EditValue = ew_HtmlEncode($ingresos->Descripcion->CurrentValue);

			// Valor_RD
			$ingresos->Valor_RD->EditCustomAttributes = "";
			$ingresos->Valor_RD->EditValue = ew_HtmlEncode($ingresos->Valor_RD->CurrentValue);

			// Valor_US
			$ingresos->Valor_US->EditCustomAttributes = "";
			$ingresos->Valor_US->EditValue = ew_HtmlEncode($ingresos->Valor_US->CurrentValue);

			// Valor_Euros
			$ingresos->Valor_Euros->EditCustomAttributes = "";
			$ingresos->Valor_Euros->EditValue = ew_HtmlEncode($ingresos->Valor_Euros->CurrentValue);

			// Valor_Tarjeta_credito
			$ingresos->Valor_Tarjeta_credito->EditCustomAttributes = "";
			$ingresos->Valor_Tarjeta_credito->EditValue = ew_HtmlEncode($ingresos->Valor_Tarjeta_credito->CurrentValue);

			// Empresa
			$ingresos->Empresa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_empresa`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `empresas`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nombre` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$ingresos->Empresa->EditValue = $arwrk;

			// tipo_comprobante
			$ingresos->tipo_comprobante->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `nombre_tipo`, `nombre_tipo`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `comprobantes_tipos`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nombre_tipo` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$ingresos->tipo_comprobante->EditValue = $arwrk;

			// NCF
			$ingresos->NCF->EditCustomAttributes = "";
			$ingresos->NCF->EditValue = ew_HtmlEncode($ingresos->NCF->CurrentValue);

			// locacion
			$ingresos->locacion->EditCustomAttributes = "";
			if ($ingresos->locacion->getSessionValue() <> "") {
				$ingresos->locacion->CurrentValue = $ingresos->locacion->getSessionValue();
			if (strval($ingresos->locacion->CurrentValue) <> "") {
				$arwrk = explode(",", $ingresos->locacion->CurrentValue);
				$sSqlWrk = "SELECT `nombre` FROM `locaciones` WHERE ";
				$sWhereWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sWhereWrk <> "") $sWhereWrk .= " OR ";
					$sWhereWrk .= "`id_locacion` = " . ew_AdjustSql(trim($wrk)) . "";
				}
				if ($sWhereWrk <> "") $sSqlWrk .= "(" . $sWhereWrk . ")";
				$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$ingresos->locacion->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$ingresos->locacion->ViewValue .= $rswrk->fields('nombre');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $ingresos->locacion->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$ingresos->locacion->ViewValue = $ingresos->locacion->CurrentValue;
				}
			} else {
				$ingresos->locacion->ViewValue = NULL;
			}
			$ingresos->locacion->CssStyle = "";
			$ingresos->locacion->CssClass = "";
			$ingresos->locacion->ViewCustomAttributes = "";
			} else {
			$sSqlWrk = "SELECT `id_locacion`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `locaciones`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nombre` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$ingresos->locacion->EditValue = $arwrk;
			}

			// cuenta_banco
			$ingresos->cuenta_banco->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_banco`, `Banco`, `numero_cuenta`, '' AS SelectFilterFld FROM `cuentas_bancarias`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `Banco` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar", ""));
			$ingresos->cuenta_banco->EditValue = $arwrk;

			// proveedor
			$ingresos->proveedor->EditCustomAttributes = "";
			if ($ingresos->proveedor->getSessionValue() <> "") {
				$ingresos->proveedor->CurrentValue = $ingresos->proveedor->getSessionValue();
			if (strval($ingresos->proveedor->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `proveedores` WHERE `id_proveedor` = " . ew_AdjustSql($ingresos->proveedor->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$ingresos->proveedor->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$ingresos->proveedor->ViewValue = $ingresos->proveedor->CurrentValue;
				}
			} else {
				$ingresos->proveedor->ViewValue = NULL;
			}
			$ingresos->proveedor->CssStyle = "";
			$ingresos->proveedor->CssClass = "";
			$ingresos->proveedor->ViewCustomAttributes = "";
			} else {
			$sSqlWrk = "SELECT `id_proveedor`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `proveedores`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nombre` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$ingresos->proveedor->EditValue = $arwrk;
			}

			// Edit refer script
			// tipo_ingreso

			$ingresos->tipo_ingreso->HrefValue = "";

			// estado
			$ingresos->estado->HrefValue = "";

			// Numero_Factura
			$ingresos->Numero_Factura->HrefValue = "";

			// Fecha_Factura
			$ingresos->Fecha_Factura->HrefValue = "";

			// Fecha_Dep
			$ingresos->Fecha_Dep->HrefValue = "";

			// Descripcion
			$ingresos->Descripcion->HrefValue = "";

			// Valor_RD
			$ingresos->Valor_RD->HrefValue = "";

			// Valor_US
			$ingresos->Valor_US->HrefValue = "";

			// Valor_Euros
			$ingresos->Valor_Euros->HrefValue = "";

			// Valor_Tarjeta_credito
			$ingresos->Valor_Tarjeta_credito->HrefValue = "";

			// Empresa
			$ingresos->Empresa->HrefValue = "";

			// tipo_comprobante
			$ingresos->tipo_comprobante->HrefValue = "";

			// NCF
			$ingresos->NCF->HrefValue = "";

			// locacion
			$ingresos->locacion->HrefValue = "";

			// cuenta_banco
			$ingresos->cuenta_banco->HrefValue = "";

			// proveedor
			$ingresos->proveedor->HrefValue = "";
		}

		// Call Row Rendered event
		$ingresos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $ingresos;

		// Initialize
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($ingresos->tipo_ingreso->MultiUpdate == "1") $lUpdateCnt++;
		if ($ingresos->estado->MultiUpdate == "1") $lUpdateCnt++;
		if ($ingresos->Numero_Factura->MultiUpdate == "1") $lUpdateCnt++;
		if ($ingresos->Fecha_Factura->MultiUpdate == "1") $lUpdateCnt++;
		if ($ingresos->Fecha_Dep->MultiUpdate == "1") $lUpdateCnt++;
		if ($ingresos->Descripcion->MultiUpdate == "1") $lUpdateCnt++;
		if ($ingresos->Valor_RD->MultiUpdate == "1") $lUpdateCnt++;
		if ($ingresos->Valor_US->MultiUpdate == "1") $lUpdateCnt++;
		if ($ingresos->Valor_Euros->MultiUpdate == "1") $lUpdateCnt++;
		if ($ingresos->Valor_Tarjeta_credito->MultiUpdate == "1") $lUpdateCnt++;
		if ($ingresos->Empresa->MultiUpdate == "1") $lUpdateCnt++;
		if ($ingresos->tipo_comprobante->MultiUpdate == "1") $lUpdateCnt++;
		if ($ingresos->NCF->MultiUpdate == "1") $lUpdateCnt++;
		if ($ingresos->locacion->MultiUpdate == "1") $lUpdateCnt++;
		if ($ingresos->cuenta_banco->MultiUpdate == "1") $lUpdateCnt++;
		if ($ingresos->proveedor->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = "No se ha seleccionado campo a actualizar";
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($ingresos->tipo_ingreso->MultiUpdate <> "" && $ingresos->tipo_ingreso->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Tipo Ingreso";
		}
		if ($ingresos->estado->MultiUpdate <> "" && $ingresos->estado->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Estado";
		}
		if ($ingresos->Numero_Factura->MultiUpdate <> "" && $ingresos->Numero_Factura->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Numero Factura";
		}
		if ($ingresos->Fecha_Factura->MultiUpdate <> "" && $ingresos->Fecha_Factura->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Fecha Factura";
		}
		if ($ingresos->Fecha_Factura->MultiUpdate <> "") {
			if (!ew_CheckEuroDate($ingresos->Fecha_Factura->FormValue)) {
				if ($gsFormError <> "") $gsFormError .= "<br>";
				$gsFormError .= "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Factura";
			}
		}
		if ($ingresos->Fecha_Dep->MultiUpdate <> "" && $ingresos->Fecha_Dep->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Fecha Deposito";
		}
		if ($ingresos->Fecha_Dep->MultiUpdate <> "") {
			if (!ew_CheckEuroDate($ingresos->Fecha_Dep->FormValue)) {
				if ($gsFormError <> "") $gsFormError .= "<br>";
				$gsFormError .= "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Deposito";
			}
		}
		if ($ingresos->Descripcion->MultiUpdate <> "" && $ingresos->Descripcion->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Descripcion";
		}
		if ($ingresos->Valor_RD->MultiUpdate <> "" && $ingresos->Valor_RD->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Valor RD";
		}
		if ($ingresos->Valor_RD->MultiUpdate <> "") {
			if (!ew_CheckNumber($ingresos->Valor_RD->FormValue)) {
				if ($gsFormError <> "") $gsFormError .= "<br>";
				$gsFormError .= "Decimal Incorrecto - Valor RD";
			}
		}
		if ($ingresos->Valor_US->MultiUpdate <> "" && $ingresos->Valor_US->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Valor US";
		}
		if ($ingresos->Valor_US->MultiUpdate <> "") {
			if (!ew_CheckNumber($ingresos->Valor_US->FormValue)) {
				if ($gsFormError <> "") $gsFormError .= "<br>";
				$gsFormError .= "Decimal Incorrecto - Valor US";
			}
		}
		if ($ingresos->Valor_Euros->MultiUpdate <> "" && $ingresos->Valor_Euros->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Valor Euros";
		}
		if ($ingresos->Valor_Euros->MultiUpdate <> "") {
			if (!ew_CheckNumber($ingresos->Valor_Euros->FormValue)) {
				if ($gsFormError <> "") $gsFormError .= "<br>";
				$gsFormError .= "Decimal Incorrecto - Valor Euros";
			}
		}
		if ($ingresos->Valor_Tarjeta_credito->MultiUpdate <> "" && $ingresos->Valor_Tarjeta_credito->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Valor Tarjeta Credito";
		}
		if ($ingresos->Valor_Tarjeta_credito->MultiUpdate <> "") {
			if (!ew_CheckNumber($ingresos->Valor_Tarjeta_credito->FormValue)) {
				if ($gsFormError <> "") $gsFormError .= "<br>";
				$gsFormError .= "Decimal Incorrecto - Valor Tarjeta Credito";
			}
		}
		if ($ingresos->Empresa->MultiUpdate <> "" && $ingresos->Empresa->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Empresa";
		}
		if ($ingresos->tipo_comprobante->MultiUpdate <> "" && $ingresos->tipo_comprobante->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Tipo Comprobante";
		}
		if ($ingresos->locacion->MultiUpdate <> "" && $ingresos->locacion->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Locacion";
		}
		if ($ingresos->cuenta_banco->MultiUpdate <> "" && $ingresos->cuenta_banco->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Cuenta Banco";
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $ingresos;
		$sFilter = $ingresos->KeyFilter();
		$ingresos->CurrentFilter = $sFilter;
		$sSql = $ingresos->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Field tipo_ingreso
			if ($ingresos->tipo_ingreso->MultiUpdate == "1") {
			$ingresos->tipo_ingreso->SetDbValueDef($ingresos->tipo_ingreso->CurrentValue, 0);
			$rsnew['tipo_ingreso'] =& $ingresos->tipo_ingreso->DbValue;
			}

			// Field estado
			if ($ingresos->estado->MultiUpdate == "1") {
			$ingresos->estado->SetDbValueDef($ingresos->estado->CurrentValue, "");
			$rsnew['estado'] =& $ingresos->estado->DbValue;
			}

			// Field Numero_Factura
			if ($ingresos->Numero_Factura->MultiUpdate == "1") {
			$ingresos->Numero_Factura->SetDbValueDef($ingresos->Numero_Factura->CurrentValue, "");
			$rsnew['Numero_Factura'] =& $ingresos->Numero_Factura->DbValue;
			}

			// Field Fecha_Factura
			if ($ingresos->Fecha_Factura->MultiUpdate == "1") {
			$ingresos->Fecha_Factura->SetDbValueDef(ew_UnFormatDateTime($ingresos->Fecha_Factura->CurrentValue, 7), ew_CurrentDate());
			$rsnew['Fecha_Factura'] =& $ingresos->Fecha_Factura->DbValue;
			}

			// Field Fecha_Dep
			if ($ingresos->Fecha_Dep->MultiUpdate == "1") {
			$ingresos->Fecha_Dep->SetDbValueDef(ew_UnFormatDateTime($ingresos->Fecha_Dep->CurrentValue, 7), ew_CurrentDate());
			$rsnew['Fecha_Dep'] =& $ingresos->Fecha_Dep->DbValue;
			}

			// Field Descripcion
			if ($ingresos->Descripcion->MultiUpdate == "1") {
			$ingresos->Descripcion->SetDbValueDef($ingresos->Descripcion->CurrentValue, "");
			$rsnew['Descripcion'] =& $ingresos->Descripcion->DbValue;
			}

			// Field Valor_RD
			if ($ingresos->Valor_RD->MultiUpdate == "1") {
			$ingresos->Valor_RD->SetDbValueDef($ingresos->Valor_RD->CurrentValue, 0);
			$rsnew['Valor_RD'] =& $ingresos->Valor_RD->DbValue;
			}

			// Field Valor_US
			if ($ingresos->Valor_US->MultiUpdate == "1") {
			$ingresos->Valor_US->SetDbValueDef($ingresos->Valor_US->CurrentValue, 0);
			$rsnew['Valor_US'] =& $ingresos->Valor_US->DbValue;
			}

			// Field Valor_Euros
			if ($ingresos->Valor_Euros->MultiUpdate == "1") {
			$ingresos->Valor_Euros->SetDbValueDef($ingresos->Valor_Euros->CurrentValue, 0);
			$rsnew['Valor_Euros'] =& $ingresos->Valor_Euros->DbValue;
			}

			// Field Valor_Tarjeta_credito
			if ($ingresos->Valor_Tarjeta_credito->MultiUpdate == "1") {
			$ingresos->Valor_Tarjeta_credito->SetDbValueDef($ingresos->Valor_Tarjeta_credito->CurrentValue, 0);
			$rsnew['Valor_Tarjeta_credito'] =& $ingresos->Valor_Tarjeta_credito->DbValue;
			}

			// Field Empresa
			if ($ingresos->Empresa->MultiUpdate == "1") {
			$ingresos->Empresa->SetDbValueDef($ingresos->Empresa->CurrentValue, "");
			$rsnew['Empresa'] =& $ingresos->Empresa->DbValue;
			}

			// Field tipo_comprobante
			if ($ingresos->tipo_comprobante->MultiUpdate == "1") {
			$ingresos->tipo_comprobante->SetDbValueDef($ingresos->tipo_comprobante->CurrentValue, "");
			$rsnew['tipo_comprobante'] =& $ingresos->tipo_comprobante->DbValue;
			}

			// Field NCF
			if ($ingresos->NCF->MultiUpdate == "1") {
			$ingresos->NCF->SetDbValueDef($ingresos->NCF->CurrentValue, "");
			$rsnew['NCF'] =& $ingresos->NCF->DbValue;
			}

			// Field locacion
			if ($ingresos->locacion->MultiUpdate == "1") {
			$ingresos->locacion->SetDbValueDef($ingresos->locacion->CurrentValue, "");
			$rsnew['locacion'] =& $ingresos->locacion->DbValue;
			}

			// Field cuenta_banco
			if ($ingresos->cuenta_banco->MultiUpdate == "1") {
			$ingresos->cuenta_banco->SetDbValueDef($ingresos->cuenta_banco->CurrentValue, "");
			$rsnew['cuenta_banco'] =& $ingresos->cuenta_banco->DbValue;
			}

			// Field proveedor
			if ($ingresos->proveedor->MultiUpdate == "1") {
			$ingresos->proveedor->SetDbValueDef($ingresos->proveedor->CurrentValue, NULL);
			$rsnew['proveedor'] =& $ingresos->proveedor->DbValue;
			}

			// Call Row Updating event
			$bUpdateRow = $ingresos->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($ingresos->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($ingresos->CancelMessage <> "") {
					$this->setMessage($ingresos->CancelMessage);
					$ingresos->CancelMessage = "";
				} else {
					$this->setMessage("Actualizar cancelado");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$ingresos->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
