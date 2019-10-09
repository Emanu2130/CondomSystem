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
$ingresos_add = new cingresos_add();
$Page =& $ingresos_add;

// Page init processing
$ingresos_add->Page_Init();

// Page main processing
$ingresos_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var ingresos_add = new ew_Page("ingresos_add");

// page properties
ingresos_add.PageID = "add"; // page ID
var EW_PAGE_ID = ingresos_add.PageID; // for backward compatibility

// extend page with ValidateForm function
ingresos_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_tipo_ingreso"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Tipo Ingreso");
		elm = fobj.elements["x" + infix + "_estado"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Estado");
		elm = fobj.elements["x" + infix + "_Numero_Factura"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Numero Factura");
		elm = fobj.elements["x" + infix + "_Fecha_Factura"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Fecha Factura");
		elm = fobj.elements["x" + infix + "_Fecha_Factura"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Factura");
		elm = fobj.elements["x" + infix + "_Fecha_Dep"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Fecha Deposito");
		elm = fobj.elements["x" + infix + "_Fecha_Dep"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Deposito");
		elm = fobj.elements["x" + infix + "_Descripcion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Descripcion");
		elm = fobj.elements["x" + infix + "_Valor_RD"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Valor RD");
		elm = fobj.elements["x" + infix + "_Valor_RD"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Decimal Incorrecto - Valor RD");
		elm = fobj.elements["x" + infix + "_Valor_US"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Valor US");
		elm = fobj.elements["x" + infix + "_Valor_US"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Decimal Incorrecto - Valor US");
		elm = fobj.elements["x" + infix + "_Valor_Euros"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Valor Euros");
		elm = fobj.elements["x" + infix + "_Valor_Euros"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Decimal Incorrecto - Valor Euros");
		elm = fobj.elements["x" + infix + "_Valor_Tarjeta_credito"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Valor Tarjeta Credito");
		elm = fobj.elements["x" + infix + "_Valor_Tarjeta_credito"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Decimal Incorrecto - Valor Tarjeta Credito");
		elm = fobj.elements["x" + infix + "_Empresa"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Empresa");
		elm = fobj.elements["x" + infix + "_tipo_comprobante"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Tipo Comprobante");
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
ingresos_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
ingresos_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
ingresos_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
ingresos_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Agregar Modulo: Ingresos<br><br>
<a href="<?php echo $ingresos->getReturnUrl() ?>">Volver</a></span></p>
<?php $ingresos_add->ShowMessage() ?>
<form name="fingresosadd" id="fingresosadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return ingresos_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="ingresos">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($ingresos->tipo_ingreso->Visible) { // tipo_ingreso ?>
	<tr<?php echo $ingresos->tipo_ingreso->RowAttributes ?>>
		<td class="ewTableHeader">Tipo Ingreso<span class="ewRequerido">&nbsp;*</span></td>
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
&nbsp;<a name="aol_x_tipo_ingreso" id="aol_x_tipo_ingreso" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:ingresos_add,lnk:'aol_x_tipo_ingreso',el:'x_tipo_ingreso',hdr:this.innerHTML, url:'ingresos_tiposaddopt.php',lf:'x_id_ingresos',df:'x_nombre',df2:'',pf:'',ff:''});">Agregar Tipo Ingreso</a>
</span><?php echo $ingresos->tipo_ingreso->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->estado->Visible) { // estado ?>
	<tr<?php echo $ingresos->estado->RowAttributes ?>>
		<td class="ewTableHeader">Estado<span class="ewRequerido">&nbsp;*</span></td>
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
		<td class="ewTableHeader">Numero Factura<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $ingresos->Numero_Factura->CellAttributes() ?>><span id="el_Numero_Factura">
<input type="text" name="x_Numero_Factura" id="x_Numero_Factura" size="30" maxlength="25" value="<?php echo $ingresos->Numero_Factura->EditValue ?>"<?php echo $ingresos->Numero_Factura->EditAttributes() ?>>
</span><?php echo $ingresos->Numero_Factura->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Fecha_Factura->Visible) { // Fecha_Factura ?>
	<tr<?php echo $ingresos->Fecha_Factura->RowAttributes ?>>
		<td class="ewTableHeader">Fecha Factura<span class="ewRequerido">&nbsp;*</span></td>
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
		<td class="ewTableHeader">Fecha Deposito<span class="ewRequerido">&nbsp;*</span></td>
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
		<td class="ewTableHeader">Descripcion<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $ingresos->Descripcion->CellAttributes() ?>><span id="el_Descripcion">
<textarea name="x_Descripcion" id="x_Descripcion" cols="35" rows="4"<?php echo $ingresos->Descripcion->EditAttributes() ?>><?php echo $ingresos->Descripcion->EditValue ?></textarea>
</span><?php echo $ingresos->Descripcion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Valor_RD->Visible) { // Valor_RD ?>
	<tr<?php echo $ingresos->Valor_RD->RowAttributes ?>>
		<td class="ewTableHeader">Valor RD<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $ingresos->Valor_RD->CellAttributes() ?>><span id="el_Valor_RD">
<input type="text" name="x_Valor_RD" id="x_Valor_RD" size="30" maxlength="25" value="<?php echo $ingresos->Valor_RD->EditValue ?>"<?php echo $ingresos->Valor_RD->EditAttributes() ?>>
</span><?php echo $ingresos->Valor_RD->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Valor_US->Visible) { // Valor_US ?>
	<tr<?php echo $ingresos->Valor_US->RowAttributes ?>>
		<td class="ewTableHeader">Valor US<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $ingresos->Valor_US->CellAttributes() ?>><span id="el_Valor_US">
<input type="text" name="x_Valor_US" id="x_Valor_US" size="30" maxlength="25" value="<?php echo $ingresos->Valor_US->EditValue ?>"<?php echo $ingresos->Valor_US->EditAttributes() ?>>
</span><?php echo $ingresos->Valor_US->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Valor_Euros->Visible) { // Valor_Euros ?>
	<tr<?php echo $ingresos->Valor_Euros->RowAttributes ?>>
		<td class="ewTableHeader">Valor Euros<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $ingresos->Valor_Euros->CellAttributes() ?>><span id="el_Valor_Euros">
<input type="text" name="x_Valor_Euros" id="x_Valor_Euros" size="30" value="<?php echo $ingresos->Valor_Euros->EditValue ?>"<?php echo $ingresos->Valor_Euros->EditAttributes() ?>>
</span><?php echo $ingresos->Valor_Euros->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Valor_Tarjeta_credito->Visible) { // Valor_Tarjeta_credito ?>
	<tr<?php echo $ingresos->Valor_Tarjeta_credito->RowAttributes ?>>
		<td class="ewTableHeader">Valor Tarjeta Credito<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $ingresos->Valor_Tarjeta_credito->CellAttributes() ?>><span id="el_Valor_Tarjeta_credito">
<input type="text" name="x_Valor_Tarjeta_credito" id="x_Valor_Tarjeta_credito" size="30" maxlength="25" value="<?php echo $ingresos->Valor_Tarjeta_credito->EditValue ?>"<?php echo $ingresos->Valor_Tarjeta_credito->EditAttributes() ?>>
</span><?php echo $ingresos->Valor_Tarjeta_credito->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->Empresa->Visible) { // Empresa ?>
	<tr<?php echo $ingresos->Empresa->RowAttributes ?>>
		<td class="ewTableHeader">Empresa<span class="ewRequerido">&nbsp;*</span></td>
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
&nbsp;<a name="aol_x_Empresa" id="aol_x_Empresa" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:ingresos_add,lnk:'aol_x_Empresa',el:'x_Empresa',hdr:this.innerHTML, url:'empresasaddopt.php',lf:'x_id_empresa',df:'x_nombre',df2:'',pf:'',ff:''});">Agregar Empresa</a>
</span><?php echo $ingresos->Empresa->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->tipo_comprobante->Visible) { // tipo_comprobante ?>
	<tr<?php echo $ingresos->tipo_comprobante->RowAttributes ?>>
		<td class="ewTableHeader">Tipo Comprobante<span class="ewRequerido">&nbsp;*</span></td>
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
&nbsp;<a name="aol_x_tipo_comprobante" id="aol_x_tipo_comprobante" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:ingresos_add,lnk:'aol_x_tipo_comprobante',el:'x_tipo_comprobante',hdr:this.innerHTML, url:'comprobantes_tiposaddopt.php',lf:'x_nombre_tipo',df:'x_nombre_tipo',df2:'',pf:'',ff:''});">Agregar Tipo Comprobante</a>
</span><?php echo $ingresos->tipo_comprobante->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->NCF->Visible) { // NCF ?>
	<tr<?php echo $ingresos->NCF->RowAttributes ?>>
		<td class="ewTableHeader">NCF<span class="ewRequerido">&nbsp;*</span></td>
		<td<?php echo $ingresos->NCF->CellAttributes() ?>><span id="el_NCF">
<input type="text" name="x_NCF" id="x_NCF" size="30" maxlength="255" value="<?php echo $ingresos->NCF->EditValue ?>"<?php echo $ingresos->NCF->EditAttributes() ?>>
</span><?php echo $ingresos->NCF->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->locacion->Visible) { // locacion ?>
	<tr<?php echo $ingresos->locacion->RowAttributes ?>>
		<td class="ewTableHeader">Locacion<span class="ewRequerido">&nbsp;*</span></td>
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
&nbsp;<a name="aol_x_locacion" id="aol_x_locacion" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:ingresos_add,lnk:'aol_x_locacion',el:'x_locacion[]',hdr:this.innerHTML, url:'locacionesaddopt.php',lf:'x_id_locacion',df:'x_nombre',df2:'',pf:'',ff:''});">Agregar Locacion</a>
<?php } ?>
</span><?php echo $ingresos->locacion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->cuenta_banco->Visible) { // cuenta_banco ?>
	<tr<?php echo $ingresos->cuenta_banco->RowAttributes ?>>
		<td class="ewTableHeader">Cuenta Banco<span class="ewRequerido">&nbsp;*</span></td>
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
&nbsp;<a name="aol_x_cuenta_banco" id="aol_x_cuenta_banco" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:ingresos_add,lnk:'aol_x_cuenta_banco',el:'x_cuenta_banco',hdr:this.innerHTML, url:'cuentas_bancariasaddopt.php',lf:'x_id_banco',df:'x_Banco',df2:'x_numero_cuenta',pf:'',ff:''});">Agregar Cuenta Banco</a>
</span><?php echo $ingresos->cuenta_banco->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ingresos->proveedor->Visible) { // proveedor ?>
	<tr<?php echo $ingresos->proveedor->RowAttributes ?>>
		<td class="ewTableHeader">Proveedor</td>
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
&nbsp;<a name="aol_x_proveedor" id="aol_x_proveedor" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:ingresos_add,lnk:'aol_x_proveedor',el:'x_proveedor',hdr:this.innerHTML, url:'proveedoresaddopt.php',lf:'x_id_proveedor',df:'x_nombre',df2:'',pf:'',ff:''});">Agregar Proveedor</a>
<?php } ?>
</span><?php echo $ingresos->proveedor->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="  Agregar  ">
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
class cingresos_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'ingresos';

	// Page Object Name
	var $PageObjName = 'ingresos_add';

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
	function cingresos_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $ingresos;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id_ingreso"] != "") {
		  $ingresos->id_ingreso->setQueryStringValue($_GET["id_ingreso"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $ingresos->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$ingresos->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $ingresos->CurrentAction = "C"; // Copy Record
		  } else {
		    $ingresos->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($ingresos->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No se encontraron registros"); // No record found
		      $this->Page_Terminate("ingresoslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$ingresos->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Nuevo registro creado"); // Set up success message
					$sReturnUrl = $ingresos->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "ingresosview.php")
						$sReturnUrl = $ingresos->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$ingresos->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $ingresos;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $ingresos;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $ingresos;
		$ingresos->tipo_ingreso->setFormValue($objForm->GetValue("x_tipo_ingreso"));
		$ingresos->estado->setFormValue($objForm->GetValue("x_estado"));
		$ingresos->Numero_Factura->setFormValue($objForm->GetValue("x_Numero_Factura"));
		$ingresos->Fecha_Factura->setFormValue($objForm->GetValue("x_Fecha_Factura"));
		$ingresos->Fecha_Factura->CurrentValue = ew_UnFormatDateTime($ingresos->Fecha_Factura->CurrentValue, 7);
		$ingresos->Fecha_Dep->setFormValue($objForm->GetValue("x_Fecha_Dep"));
		$ingresos->Fecha_Dep->CurrentValue = ew_UnFormatDateTime($ingresos->Fecha_Dep->CurrentValue, 7);
		$ingresos->Descripcion->setFormValue($objForm->GetValue("x_Descripcion"));
		$ingresos->Valor_RD->setFormValue($objForm->GetValue("x_Valor_RD"));
		$ingresos->Valor_US->setFormValue($objForm->GetValue("x_Valor_US"));
		$ingresos->Valor_Euros->setFormValue($objForm->GetValue("x_Valor_Euros"));
		$ingresos->Valor_Tarjeta_credito->setFormValue($objForm->GetValue("x_Valor_Tarjeta_credito"));
		$ingresos->Empresa->setFormValue($objForm->GetValue("x_Empresa"));
		$ingresos->tipo_comprobante->setFormValue($objForm->GetValue("x_tipo_comprobante"));
		$ingresos->NCF->setFormValue($objForm->GetValue("x_NCF"));
		$ingresos->locacion->setFormValue($objForm->GetValue("x_locacion"));
		$ingresos->cuenta_banco->setFormValue($objForm->GetValue("x_cuenta_banco"));
		$ingresos->proveedor->setFormValue($objForm->GetValue("x_proveedor"));
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

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $ingresos;
		$sFilter = $ingresos->KeyFilter();

		// Call Row Selecting event
		$ingresos->Row_Selecting($sFilter);

		// Load sql based on filter
		$ingresos->CurrentFilter = $sFilter;
		$sSql = $ingresos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$ingresos->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $ingresos;
		$ingresos->id_ingreso->setDbValue($rs->fields('id_ingreso'));
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
		} elseif ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add row

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
		}

		// Call Row Rendered event
		$ingresos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $ingresos;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($ingresos->tipo_ingreso->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Tipo Ingreso";
		}
		if ($ingresos->estado->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Estado";
		}
		if ($ingresos->Numero_Factura->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Numero Factura";
		}
		if ($ingresos->Fecha_Factura->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Fecha Factura";
		}
		if (!ew_CheckEuroDate($ingresos->Fecha_Factura->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Factura";
		}
		if ($ingresos->Fecha_Dep->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Fecha Deposito";
		}
		if (!ew_CheckEuroDate($ingresos->Fecha_Dep->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Deposito";
		}
		if ($ingresos->Descripcion->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Descripcion";
		}
		if ($ingresos->Valor_RD->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Valor RD";
		}
		if (!ew_CheckNumber($ingresos->Valor_RD->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Decimal Incorrecto - Valor RD";
		}
		if ($ingresos->Valor_US->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Valor US";
		}
		if (!ew_CheckNumber($ingresos->Valor_US->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Decimal Incorrecto - Valor US";
		}
		if ($ingresos->Valor_Euros->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Valor Euros";
		}
		if (!ew_CheckNumber($ingresos->Valor_Euros->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Decimal Incorrecto - Valor Euros";
		}
		if ($ingresos->Valor_Tarjeta_credito->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Valor Tarjeta Credito";
		}
		if (!ew_CheckNumber($ingresos->Valor_Tarjeta_credito->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Decimal Incorrecto - Valor Tarjeta Credito";
		}
		if ($ingresos->Empresa->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Empresa";
		}
		if ($ingresos->tipo_comprobante->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Tipo Comprobante";
		}
		if ($ingresos->locacion->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Locacion";
		}
		if ($ingresos->cuenta_banco->FormValue == "") {
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

	// Add record
	function AddRow() {
		global $conn, $Security, $ingresos;
		$rsnew = array();

		// Field tipo_ingreso
		$ingresos->tipo_ingreso->SetDbValueDef($ingresos->tipo_ingreso->CurrentValue, 0);
		$rsnew['tipo_ingreso'] =& $ingresos->tipo_ingreso->DbValue;

		// Field estado
		$ingresos->estado->SetDbValueDef($ingresos->estado->CurrentValue, "");
		$rsnew['estado'] =& $ingresos->estado->DbValue;

		// Field Numero_Factura
		$ingresos->Numero_Factura->SetDbValueDef($ingresos->Numero_Factura->CurrentValue, "");
		$rsnew['Numero_Factura'] =& $ingresos->Numero_Factura->DbValue;

		// Field Fecha_Factura
		$ingresos->Fecha_Factura->SetDbValueDef(ew_UnFormatDateTime($ingresos->Fecha_Factura->CurrentValue, 7), ew_CurrentDate());
		$rsnew['Fecha_Factura'] =& $ingresos->Fecha_Factura->DbValue;

		// Field Fecha_Dep
		$ingresos->Fecha_Dep->SetDbValueDef(ew_UnFormatDateTime($ingresos->Fecha_Dep->CurrentValue, 7), ew_CurrentDate());
		$rsnew['Fecha_Dep'] =& $ingresos->Fecha_Dep->DbValue;

		// Field Descripcion
		$ingresos->Descripcion->SetDbValueDef($ingresos->Descripcion->CurrentValue, "");
		$rsnew['Descripcion'] =& $ingresos->Descripcion->DbValue;

		// Field Valor_RD
		$ingresos->Valor_RD->SetDbValueDef($ingresos->Valor_RD->CurrentValue, 0);
		$rsnew['Valor_RD'] =& $ingresos->Valor_RD->DbValue;

		// Field Valor_US
		$ingresos->Valor_US->SetDbValueDef($ingresos->Valor_US->CurrentValue, 0);
		$rsnew['Valor_US'] =& $ingresos->Valor_US->DbValue;

		// Field Valor_Euros
		$ingresos->Valor_Euros->SetDbValueDef($ingresos->Valor_Euros->CurrentValue, 0);
		$rsnew['Valor_Euros'] =& $ingresos->Valor_Euros->DbValue;

		// Field Valor_Tarjeta_credito
		$ingresos->Valor_Tarjeta_credito->SetDbValueDef($ingresos->Valor_Tarjeta_credito->CurrentValue, 0);
		$rsnew['Valor_Tarjeta_credito'] =& $ingresos->Valor_Tarjeta_credito->DbValue;

		// Field Empresa
		$ingresos->Empresa->SetDbValueDef($ingresos->Empresa->CurrentValue, "");
		$rsnew['Empresa'] =& $ingresos->Empresa->DbValue;

		// Field tipo_comprobante
		$ingresos->tipo_comprobante->SetDbValueDef($ingresos->tipo_comprobante->CurrentValue, "");
		$rsnew['tipo_comprobante'] =& $ingresos->tipo_comprobante->DbValue;

		// Field NCF
		$ingresos->NCF->SetDbValueDef($ingresos->NCF->CurrentValue, "");
		$rsnew['NCF'] =& $ingresos->NCF->DbValue;

		// Field locacion
		$ingresos->locacion->SetDbValueDef($ingresos->locacion->CurrentValue, "");
		$rsnew['locacion'] =& $ingresos->locacion->DbValue;

		// Field cuenta_banco
		$ingresos->cuenta_banco->SetDbValueDef($ingresos->cuenta_banco->CurrentValue, "");
		$rsnew['cuenta_banco'] =& $ingresos->cuenta_banco->DbValue;

		// Field proveedor
		$ingresos->proveedor->SetDbValueDef($ingresos->proveedor->CurrentValue, NULL);
		$rsnew['proveedor'] =& $ingresos->proveedor->DbValue;

		// Call Row Inserting event
		$bInsertRow = $ingresos->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($ingresos->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($ingresos->CancelMessage <> "") {
				$this->setMessage($ingresos->CancelMessage);
				$ingresos->CancelMessage = "";
			} else {
				$this->setMessage("Insertar cancelado");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$ingresos->id_ingreso->setDbValue($conn->Insert_ID());
			$rsnew['id_ingreso'] =& $ingresos->id_ingreso->DbValue;

			// Call Row Inserted event
			$ingresos->Row_Inserted($rsnew);
		}
		return $AddRow;
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
