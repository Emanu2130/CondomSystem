<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "egresosinfo.php" ?>
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
$egresos_edit = new cegresos_edit();
$Page =& $egresos_edit;

// Page init processing
$egresos_edit->Page_Init();

// Page main processing
$egresos_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var egresos_edit = new ew_Page("egresos_edit");

// page properties
egresos_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = egresos_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
egresos_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_estado"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Estado");
		elm = fobj.elements["x" + infix + "_total_rd"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Total Rd");
		elm = fobj.elements["x" + infix + "_total_rd"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Decimal Incorrecto - Total Rd");
		elm = fobj.elements["x" + infix + "_total_us"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Total Us");
		elm = fobj.elements["x" + infix + "_total_us"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Decimal Incorrecto - Total Us");
		elm = fobj.elements["x" + infix + "_total_euros"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Total Euros");
		elm = fobj.elements["x" + infix + "_total_euros"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Decimal Incorrecto - Total Euros");
		elm = fobj.elements["x" + infix + "_Impuestos_pagados"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Impuestos Pagados");
		elm = fobj.elements["x" + infix + "_Impuestos_pagados"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Decimal Incorrecto - Impuestos Pagados");
		elm = fobj.elements["x" + infix + "_tipo_comprobante"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Tipo Comprobante");
		elm = fobj.elements["x" + infix + "_Metodo_pago"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Metodo Pago");
		elm = fobj.elements["x" + infix + "_proveedor"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Proveedor");
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Fecha");
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "Fecha incorrecta, formato = dd/mm/yyyy - Fecha");
		elm = fobj.elements["x" + infix + "_tipo1"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Tipo egreso");
		elm = fobj.elements["x" + infix + "_Empresa"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Empresa");
		elm = fobj.elements["x" + infix + "_locacion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Locacion");
		elm = fobj.elements["x" + infix + "_cuenta_banco"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Cuenta Banco");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
egresos_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
egresos_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
egresos_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
egresos_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Editar Modulo: Egresos<br><br>
<a href="<?php echo $egresos->getReturnUrl() ?>">Volver</a></span></p>
<?php $egresos_edit->ShowMessage() ?>
<form name="fegresosedit" id="fegresosedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return egresos_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="egresos">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($egresos->id_pago->Visible) { // id_pago ?>
	<tr<?php echo $egresos->id_pago->RowAttributes ?>>
		<td class="ewTableHeader">Id Pago</td>
		<td<?php echo $egresos->id_pago->CellAttributes() ?>><span id="el_id_pago">
<div<?php echo $egresos->id_pago->ViewAttributes() ?>><?php echo $egresos->id_pago->EditValue ?></div><input type="hidden" name="x_id_pago" id="x_id_pago" value="<?php echo ew_HtmlEncode($egresos->id_pago->CurrentValue) ?>">
</span><?php echo $egresos->id_pago->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->estado->Visible) { // estado ?>
	<tr<?php echo $egresos->estado->RowAttributes ?>>
		<td class="ewTableHeader">Estado<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos->estado->CellAttributes() ?>><span id="el_estado">
<div id="tp_x_estado" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_estado" id="x_estado" value="{value}"<?php echo $egresos->estado->EditAttributes() ?>></div>
<div id="dsl_x_estado" repeatcolumn="5">
<?php
$arwrk = $egresos->estado->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($egresos->estado->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_estado" id="x_estado" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $egresos->estado->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $egresos->estado->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->total_rd->Visible) { // total_rd ?>
	<tr<?php echo $egresos->total_rd->RowAttributes ?>>
		<td class="ewTableHeader">Total Rd<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos->total_rd->CellAttributes() ?>><span id="el_total_rd">
<input type="text" name="x_total_rd" id="x_total_rd" size="30" maxlength="255" value="<?php echo $egresos->total_rd->EditValue ?>"<?php echo $egresos->total_rd->EditAttributes() ?>>
</span><?php echo $egresos->total_rd->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->total_us->Visible) { // total_us ?>
	<tr<?php echo $egresos->total_us->RowAttributes ?>>
		<td class="ewTableHeader">Total Us<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos->total_us->CellAttributes() ?>><span id="el_total_us">
<input type="text" name="x_total_us" id="x_total_us" size="30" maxlength="255" value="<?php echo $egresos->total_us->EditValue ?>"<?php echo $egresos->total_us->EditAttributes() ?>>
</span><?php echo $egresos->total_us->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->total_euros->Visible) { // total_euros ?>
	<tr<?php echo $egresos->total_euros->RowAttributes ?>>
		<td class="ewTableHeader">Total Euros<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos->total_euros->CellAttributes() ?>><span id="el_total_euros">
<input type="text" name="x_total_euros" id="x_total_euros" size="30" value="<?php echo $egresos->total_euros->EditValue ?>"<?php echo $egresos->total_euros->EditAttributes() ?>>
</span><?php echo $egresos->total_euros->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->Impuestos_pagados->Visible) { // Impuestos_pagados ?>
	<tr<?php echo $egresos->Impuestos_pagados->RowAttributes ?>>
		<td class="ewTableHeader">Impuestos Pagados<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos->Impuestos_pagados->CellAttributes() ?>><span id="el_Impuestos_pagados">
<input type="text" name="x_Impuestos_pagados" id="x_Impuestos_pagados" size="30" maxlength="255" value="<?php echo $egresos->Impuestos_pagados->EditValue ?>"<?php echo $egresos->Impuestos_pagados->EditAttributes() ?>>
</span><?php echo $egresos->Impuestos_pagados->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->Numero_Referencia->Visible) { // Numero_Referencia ?>
	<tr<?php echo $egresos->Numero_Referencia->RowAttributes ?>>
		<td class="ewTableHeader">Numero Referencia<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos->Numero_Referencia->CellAttributes() ?>><span id="el_Numero_Referencia">
<input type="text" name="x_Numero_Referencia" id="x_Numero_Referencia" size="30" maxlength="255" value="<?php echo $egresos->Numero_Referencia->EditValue ?>"<?php echo $egresos->Numero_Referencia->EditAttributes() ?>>
</span><?php echo $egresos->Numero_Referencia->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->tipo_comprobante->Visible) { // tipo_comprobante ?>
	<tr<?php echo $egresos->tipo_comprobante->RowAttributes ?>>
		<td class="ewTableHeader">Tipo Comprobante<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos->tipo_comprobante->CellAttributes() ?>><span id="el_tipo_comprobante">
<select id="x_tipo_comprobante" name="x_tipo_comprobante"<?php echo $egresos->tipo_comprobante->EditAttributes() ?>>
<?php
if (is_array($egresos->tipo_comprobante->EditValue)) {
	$arwrk = $egresos->tipo_comprobante->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($egresos->tipo_comprobante->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
&nbsp;<a name="aol_x_tipo_comprobante" id="aol_x_tipo_comprobante" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:egresos_edit,lnk:'aol_x_tipo_comprobante',el:'x_tipo_comprobante',hdr:this.innerHTML, url:'comprobantes_tiposaddopt.php',lf:'x_nombre_tipo',df:'x_nombre_tipo',df2:'',pf:'',ff:''});">Agregar Tipo Comprobante</a>
</span><?php echo $egresos->tipo_comprobante->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->Comprobante_fiscal->Visible) { // Comprobante_fiscal ?>
	<tr<?php echo $egresos->Comprobante_fiscal->RowAttributes ?>>
		<td class="ewTableHeader">NCF<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos->Comprobante_fiscal->CellAttributes() ?>><span id="el_Comprobante_fiscal">
<input type="text" name="x_Comprobante_fiscal" id="x_Comprobante_fiscal" size="30" maxlength="255" value="<?php echo $egresos->Comprobante_fiscal->EditValue ?>"<?php echo $egresos->Comprobante_fiscal->EditAttributes() ?>>
</span><?php echo $egresos->Comprobante_fiscal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->Metodo_pago->Visible) { // Metodo_pago ?>
	<tr<?php echo $egresos->Metodo_pago->RowAttributes ?>>
		<td class="ewTableHeader">Metodo Pago<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos->Metodo_pago->CellAttributes() ?>><span id="el_Metodo_pago">
<select id="x_Metodo_pago" name="x_Metodo_pago"<?php echo $egresos->Metodo_pago->EditAttributes() ?>>
<?php
if (is_array($egresos->Metodo_pago->EditValue)) {
	$arwrk = $egresos->Metodo_pago->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($egresos->Metodo_pago->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
&nbsp;<a name="aol_x_Metodo_pago" id="aol_x_Metodo_pago" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:egresos_edit,lnk:'aol_x_Metodo_pago',el:'x_Metodo_pago',hdr:this.innerHTML, url:'metodos_pagoaddopt.php',lf:'x_id_metodo',df:'x_metodo',df2:'',pf:'',ff:''});">Agregar Metodo Pago</a>
</span><?php echo $egresos->Metodo_pago->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->proveedor->Visible) { // proveedor ?>
	<tr<?php echo $egresos->proveedor->RowAttributes ?>>
		<td class="ewTableHeader">Proveedor<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos->proveedor->CellAttributes() ?>><span id="el_proveedor">
<?php if ($egresos->proveedor->getSessionValue() <> "") { ?>
<div<?php echo $egresos->proveedor->ViewAttributes() ?>><?php echo $egresos->proveedor->ViewValue ?></div>
<input type="hidden" id="x_proveedor" name="x_proveedor" value="<?php echo ew_HtmlEncode($egresos->proveedor->CurrentValue) ?>">
<?php } else { ?>
<select id="x_proveedor" name="x_proveedor"<?php echo $egresos->proveedor->EditAttributes() ?>>
<?php
if (is_array($egresos->proveedor->EditValue)) {
	$arwrk = $egresos->proveedor->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($egresos->proveedor->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
&nbsp;<a name="aol_x_proveedor" id="aol_x_proveedor" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:egresos_edit,lnk:'aol_x_proveedor',el:'x_proveedor',hdr:this.innerHTML, url:'proveedoresaddopt.php',lf:'x_id_proveedor',df:'x_nombre',df2:'',pf:'',ff:''});">Agregar Proveedor</a>
<?php } ?>
</span><?php echo $egresos->proveedor->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->fecha->Visible) { // fecha ?>
	<tr<?php echo $egresos->fecha->RowAttributes ?>>
		<td class="ewTableHeader">Fecha<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos->fecha->CellAttributes() ?>><span id="el_fecha">
<input type="text" name="x_fecha" id="x_fecha" size="30" maxlength="255" value="<?php echo $egresos->fecha->EditValue ?>"<?php echo $egresos->fecha->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_fecha" name="cal_x_fecha" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_fecha", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_fecha" // ID of the button
});
</script>
</span><?php echo $egresos->fecha->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->tipo1->Visible) { // tipo1 ?>
	<tr<?php echo $egresos->tipo1->RowAttributes ?>>
		<td class="ewTableHeader">Tipo egreso<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos->tipo1->CellAttributes() ?>><span id="el_tipo1">
<select id="x_tipo1" name="x_tipo1"<?php echo $egresos->tipo1->EditAttributes() ?>>
<?php
if (is_array($egresos->tipo1->EditValue)) {
	$arwrk = $egresos->tipo1->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($egresos->tipo1->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
&nbsp;<a name="aol_x_tipo1" id="aol_x_tipo1" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:egresos_edit,lnk:'aol_x_tipo1',el:'x_tipo1',hdr:this.innerHTML, url:'egresos_tipo1addopt.php',lf:'x_id_tipo',df:'x_tipo',df2:'',pf:'',ff:''});">Agregar Tipo egreso</a>
</span><?php echo $egresos->tipo1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->notas->Visible) { // notas ?>
	<tr<?php echo $egresos->notas->RowAttributes ?>>
		<td class="ewTableHeader">Notas</td>
		<td<?php echo $egresos->notas->CellAttributes() ?>><span id="el_notas">
<textarea name="x_notas" id="x_notas" cols="35" rows="4"<?php echo $egresos->notas->EditAttributes() ?>><?php echo $egresos->notas->EditValue ?></textarea>
</span><?php echo $egresos->notas->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->Empresa->Visible) { // Empresa ?>
	<tr<?php echo $egresos->Empresa->RowAttributes ?>>
		<td class="ewTableHeader">Empresa<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos->Empresa->CellAttributes() ?>><span id="el_Empresa">
<select id="x_Empresa" name="x_Empresa"<?php echo $egresos->Empresa->EditAttributes() ?>>
<?php
if (is_array($egresos->Empresa->EditValue)) {
	$arwrk = $egresos->Empresa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($egresos->Empresa->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
&nbsp;<a name="aol_x_Empresa" id="aol_x_Empresa" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:egresos_edit,lnk:'aol_x_Empresa',el:'x_Empresa',hdr:this.innerHTML, url:'empresasaddopt.php',lf:'x_id_empresa',df:'x_nombre',df2:'',pf:'',ff:''});">Agregar Empresa</a>
</span><?php echo $egresos->Empresa->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->locacion->Visible) { // locacion ?>
	<tr<?php echo $egresos->locacion->RowAttributes ?>>
		<td class="ewTableHeader">Locacion<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos->locacion->CellAttributes() ?>><span id="el_locacion">
<?php if ($egresos->locacion->getSessionValue() <> "") { ?>
<div<?php echo $egresos->locacion->ViewAttributes() ?>><?php echo $egresos->locacion->ViewValue ?></div>
<input type="hidden" id="x_locacion" name="x_locacion" value="<?php echo ew_HtmlEncode($egresos->locacion->CurrentValue) ?>">
<?php } else { ?>
<div id="tp_x_locacion" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME; ?>"><input type="checkbox" name="x_locacion[]" id="x_locacion[]" value="{value}"<?php echo $egresos->locacion->EditAttributes() ?>></div>
<div id="dsl_x_locacion" repeatcolumn="4">
<?php
$arwrk = $egresos->locacion->EditValue;
if (is_array($arwrk)) {
	$armultiwrk= explode(",", strval($egresos->locacion->CurrentValue));
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
<label><input type="checkbox" name="x_locacion[]" id="x_locacion[]" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $egresos->locacion->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 4, 2) ?>
<?php
	}
}
?>
</div>
&nbsp;<a name="aol_x_locacion" id="aol_x_locacion" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:egresos_edit,lnk:'aol_x_locacion',el:'x_locacion[]',hdr:this.innerHTML, url:'locacionesaddopt.php',lf:'x_id_locacion',df:'x_nombre',df2:'',pf:'',ff:''});">Agregar Locacion</a>
<?php } ?>
</span><?php echo $egresos->locacion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($egresos->cuenta_banco->Visible) { // cuenta_banco ?>
	<tr<?php echo $egresos->cuenta_banco->RowAttributes ?>>
		<td class="ewTableHeader">Cuenta Banco<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $egresos->cuenta_banco->CellAttributes() ?>><span id="el_cuenta_banco">
<select id="x_cuenta_banco" name="x_cuenta_banco"<?php echo $egresos->cuenta_banco->EditAttributes() ?>>
<?php
if (is_array($egresos->cuenta_banco->EditValue)) {
	$arwrk = $egresos->cuenta_banco->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($egresos->cuenta_banco->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
&nbsp;<a name="aol_x_cuenta_banco" id="aol_x_cuenta_banco" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:egresos_edit,lnk:'aol_x_cuenta_banco',el:'x_cuenta_banco',hdr:this.innerHTML, url:'cuentas_bancariasaddopt.php',lf:'x_id_banco',df:'x_Banco',df2:'x_numero_cuenta',pf:'',ff:''});">Agregar Cuenta Banco</a>
</span><?php echo $egresos->cuenta_banco->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="  Editar  ">
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
class cegresos_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'egresos';

	// Page Object Name
	var $PageObjName = 'egresos_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $egresos;
		if ($egresos->UseTokenInUrl) $PageUrl .= "t=" . $egresos->TableVar . "&"; // add page token
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
		global $objForm, $egresos;
		if ($egresos->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($egresos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($egresos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cegresos_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["egresos"] = new cegresos();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Initialize other table object
		$GLOBALS['proveedores'] = new cproveedores();

		// Initialize other table object
		$GLOBALS['locaciones'] = new clocaciones();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'egresos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $egresos;
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

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $egresos;

		// Load key from QueryString
		if (@$_GET["id_pago"] <> "")
			$egresos->id_pago->setQueryStringValue($_GET["id_pago"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$egresos->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$egresos->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else {
			$egresos->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($egresos->id_pago->CurrentValue == "")
			$this->Page_Terminate("egresoslist.php"); // Invalid key, return to list
		switch ($egresos->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No se encontraron registros"); // No record found
					$this->Page_Terminate("egresoslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$egresos->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Actualizar completado"); // Update success
					$sReturnUrl = $egresos->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "egresosview.php")
						$sReturnUrl = $egresos->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$egresos->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $egresos;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $egresos;
		$egresos->id_pago->setFormValue($objForm->GetValue("x_id_pago"));
		$egresos->estado->setFormValue($objForm->GetValue("x_estado"));
		$egresos->total_rd->setFormValue($objForm->GetValue("x_total_rd"));
		$egresos->total_us->setFormValue($objForm->GetValue("x_total_us"));
		$egresos->total_euros->setFormValue($objForm->GetValue("x_total_euros"));
		$egresos->Impuestos_pagados->setFormValue($objForm->GetValue("x_Impuestos_pagados"));
		$egresos->Numero_Referencia->setFormValue($objForm->GetValue("x_Numero_Referencia"));
		$egresos->tipo_comprobante->setFormValue($objForm->GetValue("x_tipo_comprobante"));
		$egresos->Comprobante_fiscal->setFormValue($objForm->GetValue("x_Comprobante_fiscal"));
		$egresos->Metodo_pago->setFormValue($objForm->GetValue("x_Metodo_pago"));
		$egresos->proveedor->setFormValue($objForm->GetValue("x_proveedor"));
		$egresos->fecha->setFormValue($objForm->GetValue("x_fecha"));
		$egresos->fecha->CurrentValue = ew_UnFormatDateTime($egresos->fecha->CurrentValue, 7);
		$egresos->tipo1->setFormValue($objForm->GetValue("x_tipo1"));
		$egresos->notas->setFormValue($objForm->GetValue("x_notas"));
		$egresos->Empresa->setFormValue($objForm->GetValue("x_Empresa"));
		$egresos->locacion->setFormValue($objForm->GetValue("x_locacion"));
		$egresos->cuenta_banco->setFormValue($objForm->GetValue("x_cuenta_banco"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $egresos;
		$this->LoadRow();
		$egresos->id_pago->CurrentValue = $egresos->id_pago->FormValue;
		$egresos->estado->CurrentValue = $egresos->estado->FormValue;
		$egresos->total_rd->CurrentValue = $egresos->total_rd->FormValue;
		$egresos->total_us->CurrentValue = $egresos->total_us->FormValue;
		$egresos->total_euros->CurrentValue = $egresos->total_euros->FormValue;
		$egresos->Impuestos_pagados->CurrentValue = $egresos->Impuestos_pagados->FormValue;
		$egresos->Numero_Referencia->CurrentValue = $egresos->Numero_Referencia->FormValue;
		$egresos->tipo_comprobante->CurrentValue = $egresos->tipo_comprobante->FormValue;
		$egresos->Comprobante_fiscal->CurrentValue = $egresos->Comprobante_fiscal->FormValue;
		$egresos->Metodo_pago->CurrentValue = $egresos->Metodo_pago->FormValue;
		$egresos->proveedor->CurrentValue = $egresos->proveedor->FormValue;
		$egresos->fecha->CurrentValue = $egresos->fecha->FormValue;
		$egresos->fecha->CurrentValue = ew_UnFormatDateTime($egresos->fecha->CurrentValue, 7);
		$egresos->tipo1->CurrentValue = $egresos->tipo1->FormValue;
		$egresos->notas->CurrentValue = $egresos->notas->FormValue;
		$egresos->Empresa->CurrentValue = $egresos->Empresa->FormValue;
		$egresos->locacion->CurrentValue = $egresos->locacion->FormValue;
		$egresos->cuenta_banco->CurrentValue = $egresos->cuenta_banco->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $egresos;
		$sFilter = $egresos->KeyFilter();

		// Call Row Selecting event
		$egresos->Row_Selecting($sFilter);

		// Load sql based on filter
		$egresos->CurrentFilter = $sFilter;
		$sSql = $egresos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$egresos->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $egresos;
		$egresos->id_pago->setDbValue($rs->fields('id_pago'));
		$egresos->estado->setDbValue($rs->fields('estado'));
		$egresos->total_rd->setDbValue($rs->fields('total_rd'));
		$egresos->total_us->setDbValue($rs->fields('total_us'));
		$egresos->total_euros->setDbValue($rs->fields('total_euros'));
		$egresos->Impuestos_pagados->setDbValue($rs->fields('Impuestos_pagados'));
		$egresos->Numero_Referencia->setDbValue($rs->fields('Numero_Referencia'));
		$egresos->tipo_comprobante->setDbValue($rs->fields('tipo_comprobante'));
		$egresos->Comprobante_fiscal->setDbValue($rs->fields('Comprobante_fiscal'));
		$egresos->Metodo_pago->setDbValue($rs->fields('Metodo_pago'));
		$egresos->proveedor->setDbValue($rs->fields('proveedor'));
		$egresos->fecha->setDbValue($rs->fields('fecha'));
		$egresos->tipo1->setDbValue($rs->fields('tipo1'));
		$egresos->notas->setDbValue($rs->fields('notas'));
		$egresos->Empresa->setDbValue($rs->fields('Empresa'));
		$egresos->locacion->setDbValue($rs->fields('locacion'));
		$egresos->cuenta_banco->setDbValue($rs->fields('cuenta_banco'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $egresos;

		// Call Row_Rendering event
		$egresos->Row_Rendering();

		// Common render codes for all row types
		// id_pago

		$egresos->id_pago->CellCssStyle = "";
		$egresos->id_pago->CellCssClass = "";

		// estado
		$egresos->estado->CellCssStyle = "";
		$egresos->estado->CellCssClass = "";

		// total_rd
		$egresos->total_rd->CellCssStyle = "";
		$egresos->total_rd->CellCssClass = "";

		// total_us
		$egresos->total_us->CellCssStyle = "";
		$egresos->total_us->CellCssClass = "";

		// total_euros
		$egresos->total_euros->CellCssStyle = "";
		$egresos->total_euros->CellCssClass = "";

		// Impuestos_pagados
		$egresos->Impuestos_pagados->CellCssStyle = "";
		$egresos->Impuestos_pagados->CellCssClass = "";

		// Numero_Referencia
		$egresos->Numero_Referencia->CellCssStyle = "";
		$egresos->Numero_Referencia->CellCssClass = "";

		// tipo_comprobante
		$egresos->tipo_comprobante->CellCssStyle = "";
		$egresos->tipo_comprobante->CellCssClass = "";

		// Comprobante_fiscal
		$egresos->Comprobante_fiscal->CellCssStyle = "";
		$egresos->Comprobante_fiscal->CellCssClass = "";

		// Metodo_pago
		$egresos->Metodo_pago->CellCssStyle = "";
		$egresos->Metodo_pago->CellCssClass = "";

		// proveedor
		$egresos->proveedor->CellCssStyle = "";
		$egresos->proveedor->CellCssClass = "";

		// fecha
		$egresos->fecha->CellCssStyle = "";
		$egresos->fecha->CellCssClass = "";

		// tipo1
		$egresos->tipo1->CellCssStyle = "";
		$egresos->tipo1->CellCssClass = "";

		// notas
		$egresos->notas->CellCssStyle = "";
		$egresos->notas->CellCssClass = "";

		// Empresa
		$egresos->Empresa->CellCssStyle = "";
		$egresos->Empresa->CellCssClass = "";

		// locacion
		$egresos->locacion->CellCssStyle = "";
		$egresos->locacion->CellCssClass = "";

		// cuenta_banco
		$egresos->cuenta_banco->CellCssStyle = "";
		$egresos->cuenta_banco->CellCssClass = "";
		if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_pago
			$egresos->id_pago->ViewValue = $egresos->id_pago->CurrentValue;
			$egresos->id_pago->CssStyle = "";
			$egresos->id_pago->CssClass = "";
			$egresos->id_pago->ViewCustomAttributes = "";

			// estado
			if (strval($egresos->estado->CurrentValue) <> "") {
				switch ($egresos->estado->CurrentValue) {
					case "Pagado":
						$egresos->estado->ViewValue = "Pagado";
						break;
					case "Pendiente":
						$egresos->estado->ViewValue = "Pendiente";
						break;
					default:
						$egresos->estado->ViewValue = $egresos->estado->CurrentValue;
				}
			} else {
				$egresos->estado->ViewValue = NULL;
			}
			$egresos->estado->CssStyle = "";
			$egresos->estado->CssClass = "";
			$egresos->estado->ViewCustomAttributes = "";

			// total_rd
			$egresos->total_rd->ViewValue = $egresos->total_rd->CurrentValue;
			$egresos->total_rd->CssStyle = "";
			$egresos->total_rd->CssClass = "";
			$egresos->total_rd->ViewCustomAttributes = "";

			// total_us
			$egresos->total_us->ViewValue = $egresos->total_us->CurrentValue;
			$egresos->total_us->CssStyle = "";
			$egresos->total_us->CssClass = "";
			$egresos->total_us->ViewCustomAttributes = "";

			// total_euros
			$egresos->total_euros->ViewValue = $egresos->total_euros->CurrentValue;
			$egresos->total_euros->CssStyle = "";
			$egresos->total_euros->CssClass = "";
			$egresos->total_euros->ViewCustomAttributes = "";

			// Impuestos_pagados
			$egresos->Impuestos_pagados->ViewValue = $egresos->Impuestos_pagados->CurrentValue;
			$egresos->Impuestos_pagados->CssStyle = "";
			$egresos->Impuestos_pagados->CssClass = "";
			$egresos->Impuestos_pagados->ViewCustomAttributes = "";

			// Numero_Referencia
			$egresos->Numero_Referencia->ViewValue = $egresos->Numero_Referencia->CurrentValue;
			$egresos->Numero_Referencia->CssStyle = "";
			$egresos->Numero_Referencia->CssClass = "";
			$egresos->Numero_Referencia->ViewCustomAttributes = "";

			// tipo_comprobante
			if (strval($egresos->tipo_comprobante->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre_tipo` FROM `comprobantes_tipos` WHERE `nombre_tipo` = '" . ew_AdjustSql($egresos->tipo_comprobante->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nombre_tipo` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$egresos->tipo_comprobante->ViewValue = $rswrk->fields('nombre_tipo');
					$rswrk->Close();
				} else {
					$egresos->tipo_comprobante->ViewValue = $egresos->tipo_comprobante->CurrentValue;
				}
			} else {
				$egresos->tipo_comprobante->ViewValue = NULL;
			}
			$egresos->tipo_comprobante->CssStyle = "";
			$egresos->tipo_comprobante->CssClass = "";
			$egresos->tipo_comprobante->ViewCustomAttributes = "";

			// Comprobante_fiscal
			$egresos->Comprobante_fiscal->ViewValue = $egresos->Comprobante_fiscal->CurrentValue;
			$egresos->Comprobante_fiscal->CssStyle = "";
			$egresos->Comprobante_fiscal->CssClass = "";
			$egresos->Comprobante_fiscal->ViewCustomAttributes = "";

			// Metodo_pago
			if (strval($egresos->Metodo_pago->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `metodo` FROM `metodos_pago` WHERE `id_metodo` = " . ew_AdjustSql($egresos->Metodo_pago->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `metodo` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$egresos->Metodo_pago->ViewValue = $rswrk->fields('metodo');
					$rswrk->Close();
				} else {
					$egresos->Metodo_pago->ViewValue = $egresos->Metodo_pago->CurrentValue;
				}
			} else {
				$egresos->Metodo_pago->ViewValue = NULL;
			}
			$egresos->Metodo_pago->CssStyle = "";
			$egresos->Metodo_pago->CssClass = "";
			$egresos->Metodo_pago->ViewCustomAttributes = "";

			// proveedor
			if (strval($egresos->proveedor->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `proveedores` WHERE `id_proveedor` = " . ew_AdjustSql($egresos->proveedor->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$egresos->proveedor->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$egresos->proveedor->ViewValue = $egresos->proveedor->CurrentValue;
				}
			} else {
				$egresos->proveedor->ViewValue = NULL;
			}
			$egresos->proveedor->CssStyle = "";
			$egresos->proveedor->CssClass = "";
			$egresos->proveedor->ViewCustomAttributes = "";

			// fecha
			$egresos->fecha->ViewValue = $egresos->fecha->CurrentValue;
			$egresos->fecha->ViewValue = ew_FormatDateTime($egresos->fecha->ViewValue, 7);
			$egresos->fecha->CssStyle = "";
			$egresos->fecha->CssClass = "";
			$egresos->fecha->ViewCustomAttributes = "";

			// tipo1
			if (strval($egresos->tipo1->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `tipo` FROM `egresos_tipo1` WHERE `id_tipo` = " . ew_AdjustSql($egresos->tipo1->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `tipo` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$egresos->tipo1->ViewValue = $rswrk->fields('tipo');
					$rswrk->Close();
				} else {
					$egresos->tipo1->ViewValue = $egresos->tipo1->CurrentValue;
				}
			} else {
				$egresos->tipo1->ViewValue = NULL;
			}
			$egresos->tipo1->CssStyle = "";
			$egresos->tipo1->CssClass = "";
			$egresos->tipo1->ViewCustomAttributes = "";

			// notas
			$egresos->notas->ViewValue = $egresos->notas->CurrentValue;
			$egresos->notas->CssStyle = "";
			$egresos->notas->CssClass = "";
			$egresos->notas->ViewCustomAttributes = "";

			// Empresa
			if (strval($egresos->Empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($egresos->Empresa->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$egresos->Empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$egresos->Empresa->ViewValue = $egresos->Empresa->CurrentValue;
				}
			} else {
				$egresos->Empresa->ViewValue = NULL;
			}
			$egresos->Empresa->CssStyle = "";
			$egresos->Empresa->CssClass = "";
			$egresos->Empresa->ViewCustomAttributes = "";

			// locacion
			if (strval($egresos->locacion->CurrentValue) <> "") {
				$arwrk = explode(",", $egresos->locacion->CurrentValue);
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
					$egresos->locacion->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$egresos->locacion->ViewValue .= $rswrk->fields('nombre');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $egresos->locacion->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$egresos->locacion->ViewValue = $egresos->locacion->CurrentValue;
				}
			} else {
				$egresos->locacion->ViewValue = NULL;
			}
			$egresos->locacion->CssStyle = "";
			$egresos->locacion->CssClass = "";
			$egresos->locacion->ViewCustomAttributes = "";

			// cuenta_banco
			if (strval($egresos->cuenta_banco->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `Banco`, `numero_cuenta` FROM `cuentas_bancarias` WHERE `id_banco` = " . ew_AdjustSql($egresos->cuenta_banco->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `Banco` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$egresos->cuenta_banco->ViewValue = $rswrk->fields('Banco');
					$egresos->cuenta_banco->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('numero_cuenta');
					$rswrk->Close();
				} else {
					$egresos->cuenta_banco->ViewValue = $egresos->cuenta_banco->CurrentValue;
				}
			} else {
				$egresos->cuenta_banco->ViewValue = NULL;
			}
			$egresos->cuenta_banco->CssStyle = "";
			$egresos->cuenta_banco->CssClass = "";
			$egresos->cuenta_banco->ViewCustomAttributes = "";

			// id_pago
			$egresos->id_pago->HrefValue = "";

			// estado
			$egresos->estado->HrefValue = "";

			// total_rd
			$egresos->total_rd->HrefValue = "";

			// total_us
			$egresos->total_us->HrefValue = "";

			// total_euros
			$egresos->total_euros->HrefValue = "";

			// Impuestos_pagados
			$egresos->Impuestos_pagados->HrefValue = "";

			// Numero_Referencia
			$egresos->Numero_Referencia->HrefValue = "";

			// tipo_comprobante
			$egresos->tipo_comprobante->HrefValue = "";

			// Comprobante_fiscal
			$egresos->Comprobante_fiscal->HrefValue = "";

			// Metodo_pago
			$egresos->Metodo_pago->HrefValue = "";

			// proveedor
			$egresos->proveedor->HrefValue = "";

			// fecha
			$egresos->fecha->HrefValue = "";

			// tipo1
			$egresos->tipo1->HrefValue = "";

			// notas
			$egresos->notas->HrefValue = "";

			// Empresa
			$egresos->Empresa->HrefValue = "";

			// locacion
			$egresos->locacion->HrefValue = "";

			// cuenta_banco
			$egresos->cuenta_banco->HrefValue = "";
		} elseif ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_pago
			$egresos->id_pago->EditCustomAttributes = "";
			$egresos->id_pago->EditValue = $egresos->id_pago->CurrentValue;
			$egresos->id_pago->CssStyle = "";
			$egresos->id_pago->CssClass = "";
			$egresos->id_pago->ViewCustomAttributes = "";

			// estado
			$egresos->estado->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("Pagado", "Pagado");
			$arwrk[] = array("Pendiente", "Pendiente");
			$egresos->estado->EditValue = $arwrk;

			// total_rd
			$egresos->total_rd->EditCustomAttributes = "";
			$egresos->total_rd->EditValue = ew_HtmlEncode($egresos->total_rd->CurrentValue);

			// total_us
			$egresos->total_us->EditCustomAttributes = "";
			$egresos->total_us->EditValue = ew_HtmlEncode($egresos->total_us->CurrentValue);

			// total_euros
			$egresos->total_euros->EditCustomAttributes = "";
			$egresos->total_euros->EditValue = ew_HtmlEncode($egresos->total_euros->CurrentValue);

			// Impuestos_pagados
			$egresos->Impuestos_pagados->EditCustomAttributes = "";
			$egresos->Impuestos_pagados->EditValue = ew_HtmlEncode($egresos->Impuestos_pagados->CurrentValue);

			// Numero_Referencia
			$egresos->Numero_Referencia->EditCustomAttributes = "";
			$egresos->Numero_Referencia->EditValue = ew_HtmlEncode($egresos->Numero_Referencia->CurrentValue);

			// tipo_comprobante
			$egresos->tipo_comprobante->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `nombre_tipo`, `nombre_tipo`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `comprobantes_tipos`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nombre_tipo` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$egresos->tipo_comprobante->EditValue = $arwrk;

			// Comprobante_fiscal
			$egresos->Comprobante_fiscal->EditCustomAttributes = "";
			$egresos->Comprobante_fiscal->EditValue = ew_HtmlEncode($egresos->Comprobante_fiscal->CurrentValue);

			// Metodo_pago
			$egresos->Metodo_pago->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_metodo`, `metodo`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `metodos_pago`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `metodo` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$egresos->Metodo_pago->EditValue = $arwrk;

			// proveedor
			$egresos->proveedor->EditCustomAttributes = "";
			if ($egresos->proveedor->getSessionValue() <> "") {
				$egresos->proveedor->CurrentValue = $egresos->proveedor->getSessionValue();
			if (strval($egresos->proveedor->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `proveedores` WHERE `id_proveedor` = " . ew_AdjustSql($egresos->proveedor->CurrentValue) . "";
				$sSqlWrk .= " ORDER BY `nombre` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$egresos->proveedor->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$egresos->proveedor->ViewValue = $egresos->proveedor->CurrentValue;
				}
			} else {
				$egresos->proveedor->ViewValue = NULL;
			}
			$egresos->proveedor->CssStyle = "";
			$egresos->proveedor->CssClass = "";
			$egresos->proveedor->ViewCustomAttributes = "";
			} else {
			$sSqlWrk = "SELECT `id_proveedor`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `proveedores`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nombre` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$egresos->proveedor->EditValue = $arwrk;
			}

			// fecha
			$egresos->fecha->EditCustomAttributes = "";
			$egresos->fecha->EditValue = ew_HtmlEncode(ew_FormatDateTime($egresos->fecha->CurrentValue, 7));

			// tipo1
			$egresos->tipo1->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_tipo`, `tipo`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `egresos_tipo1`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `tipo` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$egresos->tipo1->EditValue = $arwrk;

			// notas
			$egresos->notas->EditCustomAttributes = "";
			$egresos->notas->EditValue = ew_HtmlEncode($egresos->notas->CurrentValue);

			// Empresa
			$egresos->Empresa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_empresa`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `empresas`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nombre` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$egresos->Empresa->EditValue = $arwrk;

			// locacion
			$egresos->locacion->EditCustomAttributes = "";
			if ($egresos->locacion->getSessionValue() <> "") {
				$egresos->locacion->CurrentValue = $egresos->locacion->getSessionValue();
			if (strval($egresos->locacion->CurrentValue) <> "") {
				$arwrk = explode(",", $egresos->locacion->CurrentValue);
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
					$egresos->locacion->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$egresos->locacion->ViewValue .= $rswrk->fields('nombre');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $egresos->locacion->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$egresos->locacion->ViewValue = $egresos->locacion->CurrentValue;
				}
			} else {
				$egresos->locacion->ViewValue = NULL;
			}
			$egresos->locacion->CssStyle = "";
			$egresos->locacion->CssClass = "";
			$egresos->locacion->ViewCustomAttributes = "";
			} else {
			$sSqlWrk = "SELECT `id_locacion`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `locaciones`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nombre` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$egresos->locacion->EditValue = $arwrk;
			}

			// cuenta_banco
			$egresos->cuenta_banco->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_banco`, `Banco`, `numero_cuenta`, '' AS SelectFilterFld FROM `cuentas_bancarias`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `Banco` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar", ""));
			$egresos->cuenta_banco->EditValue = $arwrk;

			// Edit refer script
			// id_pago

			$egresos->id_pago->HrefValue = "";

			// estado
			$egresos->estado->HrefValue = "";

			// total_rd
			$egresos->total_rd->HrefValue = "";

			// total_us
			$egresos->total_us->HrefValue = "";

			// total_euros
			$egresos->total_euros->HrefValue = "";

			// Impuestos_pagados
			$egresos->Impuestos_pagados->HrefValue = "";

			// Numero_Referencia
			$egresos->Numero_Referencia->HrefValue = "";

			// tipo_comprobante
			$egresos->tipo_comprobante->HrefValue = "";

			// Comprobante_fiscal
			$egresos->Comprobante_fiscal->HrefValue = "";

			// Metodo_pago
			$egresos->Metodo_pago->HrefValue = "";

			// proveedor
			$egresos->proveedor->HrefValue = "";

			// fecha
			$egresos->fecha->HrefValue = "";

			// tipo1
			$egresos->tipo1->HrefValue = "";

			// notas
			$egresos->notas->HrefValue = "";

			// Empresa
			$egresos->Empresa->HrefValue = "";

			// locacion
			$egresos->locacion->HrefValue = "";

			// cuenta_banco
			$egresos->cuenta_banco->HrefValue = "";
		}

		// Call Row Rendered event
		$egresos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $egresos;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($egresos->estado->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Estado";
		}
		if ($egresos->total_rd->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Total Rd";
		}
		if (!ew_CheckNumber($egresos->total_rd->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Decimal Incorrecto - Total Rd";
		}
		if ($egresos->total_us->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Total Us";
		}
		if (!ew_CheckNumber($egresos->total_us->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Decimal Incorrecto - Total Us";
		}
		if ($egresos->total_euros->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Total Euros";
		}
		if (!ew_CheckNumber($egresos->total_euros->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Decimal Incorrecto - Total Euros";
		}
		if ($egresos->Impuestos_pagados->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Impuestos Pagados";
		}
		if (!ew_CheckNumber($egresos->Impuestos_pagados->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Decimal Incorrecto - Impuestos Pagados";
		}
		if ($egresos->tipo_comprobante->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Tipo Comprobante";
		}
		if ($egresos->Metodo_pago->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Metodo Pago";
		}
		if ($egresos->proveedor->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Proveedor";
		}
		if ($egresos->fecha->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Fecha";
		}
		if (!ew_CheckEuroDate($egresos->fecha->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Fecha incorrecta, formato = dd/mm/yyyy - Fecha";
		}
		if ($egresos->tipo1->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Tipo egreso";
		}
		if ($egresos->Empresa->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Empresa";
		}
		if ($egresos->locacion->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Locacion";
		}
		if ($egresos->cuenta_banco->FormValue == "") {
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
		global $conn, $Security, $egresos;
		$sFilter = $egresos->KeyFilter();
		$egresos->CurrentFilter = $sFilter;
		$sSql = $egresos->SQL();
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

			// Field id_pago
			// Field estado

			$egresos->estado->SetDbValueDef($egresos->estado->CurrentValue, "");
			$rsnew['estado'] =& $egresos->estado->DbValue;

			// Field total_rd
			$egresos->total_rd->SetDbValueDef($egresos->total_rd->CurrentValue, 0);
			$rsnew['total_rd'] =& $egresos->total_rd->DbValue;

			// Field total_us
			$egresos->total_us->SetDbValueDef($egresos->total_us->CurrentValue, 0);
			$rsnew['total_us'] =& $egresos->total_us->DbValue;

			// Field total_euros
			$egresos->total_euros->SetDbValueDef($egresos->total_euros->CurrentValue, 0);
			$rsnew['total_euros'] =& $egresos->total_euros->DbValue;

			// Field Impuestos_pagados
			$egresos->Impuestos_pagados->SetDbValueDef($egresos->Impuestos_pagados->CurrentValue, 0);
			$rsnew['Impuestos_pagados'] =& $egresos->Impuestos_pagados->DbValue;

			// Field Numero_Referencia
			$egresos->Numero_Referencia->SetDbValueDef($egresos->Numero_Referencia->CurrentValue, "");
			$rsnew['Numero_Referencia'] =& $egresos->Numero_Referencia->DbValue;

			// Field tipo_comprobante
			$egresos->tipo_comprobante->SetDbValueDef($egresos->tipo_comprobante->CurrentValue, "");
			$rsnew['tipo_comprobante'] =& $egresos->tipo_comprobante->DbValue;

			// Field Comprobante_fiscal
			$egresos->Comprobante_fiscal->SetDbValueDef($egresos->Comprobante_fiscal->CurrentValue, "");
			$rsnew['Comprobante_fiscal'] =& $egresos->Comprobante_fiscal->DbValue;

			// Field Metodo_pago
			$egresos->Metodo_pago->SetDbValueDef($egresos->Metodo_pago->CurrentValue, "");
			$rsnew['Metodo_pago'] =& $egresos->Metodo_pago->DbValue;

			// Field proveedor
			$egresos->proveedor->SetDbValueDef($egresos->proveedor->CurrentValue, "");
			$rsnew['proveedor'] =& $egresos->proveedor->DbValue;

			// Field fecha
			$egresos->fecha->SetDbValueDef(ew_UnFormatDateTime($egresos->fecha->CurrentValue, 7), ew_CurrentDate());
			$rsnew['fecha'] =& $egresos->fecha->DbValue;

			// Field tipo1
			$egresos->tipo1->SetDbValueDef($egresos->tipo1->CurrentValue, "");
			$rsnew['tipo1'] =& $egresos->tipo1->DbValue;

			// Field notas
			$egresos->notas->SetDbValueDef($egresos->notas->CurrentValue, NULL);
			$rsnew['notas'] =& $egresos->notas->DbValue;

			// Field Empresa
			$egresos->Empresa->SetDbValueDef($egresos->Empresa->CurrentValue, "");
			$rsnew['Empresa'] =& $egresos->Empresa->DbValue;

			// Field locacion
			$egresos->locacion->SetDbValueDef($egresos->locacion->CurrentValue, "");
			$rsnew['locacion'] =& $egresos->locacion->DbValue;

			// Field cuenta_banco
			$egresos->cuenta_banco->SetDbValueDef($egresos->cuenta_banco->CurrentValue, "");
			$rsnew['cuenta_banco'] =& $egresos->cuenta_banco->DbValue;

			// Call Row Updating event
			$bUpdateRow = $egresos->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($egresos->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($egresos->CancelMessage <> "") {
					$this->setMessage($egresos->CancelMessage);
					$egresos->CancelMessage = "";
				} else {
					$this->setMessage("Actualizar cancelado");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$egresos->Row_Updated($rsold, $rsnew);
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
