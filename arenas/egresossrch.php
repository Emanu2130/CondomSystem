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
$egresos_search = new cegresos_search();
$Page =& $egresos_search;

// Page init processing
$egresos_search->Page_Init();

// Page main processing
$egresos_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var egresos_search = new ew_Page("egresos_search");

// page properties
egresos_search.PageID = "search"; // page ID
var EW_PAGE_ID = egresos_search.PageID; // for backward compatibility

// extend page with validate function for search
egresos_search.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_id_pago"];
	if (elm && !ew_CheckInteger(elm.value))
		return ew_OnError(this, elm, "Entero Incorrecto - Id Pago");
	elm = fobj.elements["x" + infix + "_total_rd"];
	if (elm && !ew_CheckNumber(elm.value))
		return ew_OnError(this, elm, "Decimal Incorrecto - Total Rd");
	elm = fobj.elements["x" + infix + "_total_us"];
	if (elm && !ew_CheckNumber(elm.value))
		return ew_OnError(this, elm, "Decimal Incorrecto - Total Us");
	elm = fobj.elements["x" + infix + "_total_euros"];
	if (elm && !ew_CheckNumber(elm.value))
		return ew_OnError(this, elm, "Decimal Incorrecto - Total Euros");
	elm = fobj.elements["x" + infix + "_Impuestos_pagados"];
	if (elm && !ew_CheckNumber(elm.value))
		return ew_OnError(this, elm, "Decimal Incorrecto - Impuestos Pagados");
	elm = fobj.elements["x" + infix + "_fecha"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Fecha incorrecta, formato = dd/mm/yyyy - Fecha");

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	for (var i=0;i<fobj.elements.length;i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
egresos_search.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
egresos_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
egresos_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
egresos_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Buscar Modulo: Egresos<br><br>
<a href="<?php echo $egresos->getReturnUrl() ?>">Volver a la lista</a></span></p>
<?php $egresos_search->ShowMessage() ?>
<form name="fegresossearch" id="fegresossearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return egresos_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="egresos">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $egresos->id_pago->RowAttributes ?>>
		<td class="ewTableHeader">Id Pago</td>
		<td<?php echo $egresos->id_pago->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_id_pago" id="z_id_pago" value="="></span></td>
		<td<?php echo $egresos->id_pago->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_id_pago" id="x_id_pago" value="<?php echo $egresos->id_pago->EditValue ?>"<?php echo $egresos->id_pago->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->estado->RowAttributes ?>>
		<td class="ewTableHeader">Estado</td>
		<td<?php echo $egresos->estado->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_estado" id="z_estado" value="LIKE"></span></td>
		<td<?php echo $egresos->estado->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<div id="tp_x_estado" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_estado" id="x_estado" value="{value}"<?php echo $egresos->estado->EditAttributes() ?>></div>
<div id="dsl_x_estado" repeatcolumn="5">
<?php
$arwrk = $egresos->estado->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($egresos->estado->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
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
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->total_rd->RowAttributes ?>>
		<td class="ewTableHeader">Total Rd</td>
		<td<?php echo $egresos->total_rd->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_total_rd" id="z_total_rd" value="="></span></td>
		<td<?php echo $egresos->total_rd->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_total_rd" id="x_total_rd" size="30" maxlength="255" value="<?php echo $egresos->total_rd->EditValue ?>"<?php echo $egresos->total_rd->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->total_us->RowAttributes ?>>
		<td class="ewTableHeader">Total Us</td>
		<td<?php echo $egresos->total_us->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_total_us" id="z_total_us" value="="></span></td>
		<td<?php echo $egresos->total_us->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_total_us" id="x_total_us" size="30" maxlength="255" value="<?php echo $egresos->total_us->EditValue ?>"<?php echo $egresos->total_us->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->total_euros->RowAttributes ?>>
		<td class="ewTableHeader">Total Euros</td>
		<td<?php echo $egresos->total_euros->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_total_euros" id="z_total_euros" value="="></span></td>
		<td<?php echo $egresos->total_euros->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_total_euros" id="x_total_euros" size="30" value="<?php echo $egresos->total_euros->EditValue ?>"<?php echo $egresos->total_euros->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->Impuestos_pagados->RowAttributes ?>>
		<td class="ewTableHeader">Impuestos Pagados</td>
		<td<?php echo $egresos->Impuestos_pagados->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_Impuestos_pagados" id="z_Impuestos_pagados" value="="></span></td>
		<td<?php echo $egresos->Impuestos_pagados->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_Impuestos_pagados" id="x_Impuestos_pagados" size="30" maxlength="255" value="<?php echo $egresos->Impuestos_pagados->EditValue ?>"<?php echo $egresos->Impuestos_pagados->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->Numero_Referencia->RowAttributes ?>>
		<td class="ewTableHeader">Numero Referencia</td>
		<td<?php echo $egresos->Numero_Referencia->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_Numero_Referencia" id="z_Numero_Referencia" value="LIKE"></span></td>
		<td<?php echo $egresos->Numero_Referencia->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_Numero_Referencia" id="x_Numero_Referencia" size="30" maxlength="255" value="<?php echo $egresos->Numero_Referencia->EditValue ?>"<?php echo $egresos->Numero_Referencia->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->tipo_comprobante->RowAttributes ?>>
		<td class="ewTableHeader">Tipo Comprobante</td>
		<td<?php echo $egresos->tipo_comprobante->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_tipo_comprobante" id="z_tipo_comprobante" value="="></span></td>
		<td<?php echo $egresos->tipo_comprobante->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<select id="x_tipo_comprobante" name="x_tipo_comprobante"<?php echo $egresos->tipo_comprobante->EditAttributes() ?>>
<?php
if (is_array($egresos->tipo_comprobante->EditValue)) {
	$arwrk = $egresos->tipo_comprobante->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($egresos->tipo_comprobante->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->Comprobante_fiscal->RowAttributes ?>>
		<td class="ewTableHeader">NCF</td>
		<td<?php echo $egresos->Comprobante_fiscal->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_Comprobante_fiscal" id="z_Comprobante_fiscal" value="LIKE"></span></td>
		<td<?php echo $egresos->Comprobante_fiscal->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_Comprobante_fiscal" id="x_Comprobante_fiscal" size="30" maxlength="255" value="<?php echo $egresos->Comprobante_fiscal->EditValue ?>"<?php echo $egresos->Comprobante_fiscal->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->Metodo_pago->RowAttributes ?>>
		<td class="ewTableHeader">Metodo Pago</td>
		<td<?php echo $egresos->Metodo_pago->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_Metodo_pago" id="z_Metodo_pago" value="="></span></td>
		<td<?php echo $egresos->Metodo_pago->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<select id="x_Metodo_pago" name="x_Metodo_pago"<?php echo $egresos->Metodo_pago->EditAttributes() ?>>
<?php
if (is_array($egresos->Metodo_pago->EditValue)) {
	$arwrk = $egresos->Metodo_pago->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($egresos->Metodo_pago->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->proveedor->RowAttributes ?>>
		<td class="ewTableHeader">Proveedor</td>
		<td<?php echo $egresos->proveedor->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_proveedor" id="z_proveedor" value="="></span></td>
		<td<?php echo $egresos->proveedor->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<select id="x_proveedor" name="x_proveedor"<?php echo $egresos->proveedor->EditAttributes() ?>>
<?php
if (is_array($egresos->proveedor->EditValue)) {
	$arwrk = $egresos->proveedor->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($egresos->proveedor->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->fecha->RowAttributes ?>>
		<td class="ewTableHeader">Fecha</td>
		<td<?php echo $egresos->fecha->CellAttributes() ?>><span class="ewSearchOpr">entre<input type="hidden" name="z_fecha" id="z_fecha" value="BETWEEN"></span></td>
		<td<?php echo $egresos->fecha->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_fecha" id="x_fecha" size="30" maxlength="255" value="<?php echo $egresos->fecha->EditValue ?>"<?php echo $egresos->fecha->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_fecha" name="cal_x_fecha" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_fecha", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_fecha" // ID of the button
});
</script>
</span></td>
				<td><span class="ewSearchOpr" id="btw1_fecha" name="btw1_fecha">&nbsp;y&nbsp;</span></td>
				<td><span class="arenas" id="btw1_fecha" name="btw1_fecha">
<input type="text" name="y_fecha" id="y_fecha" size="30" maxlength="255" value="<?php echo $egresos->fecha->EditValue2 ?>"<?php echo $egresos->fecha->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_y_fecha" name="cal_y_fecha" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "y_fecha", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_y_fecha" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->tipo1->RowAttributes ?>>
		<td class="ewTableHeader">Tipo egreso</td>
		<td<?php echo $egresos->tipo1->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_tipo1" id="z_tipo1" value="="></span></td>
		<td<?php echo $egresos->tipo1->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<select id="x_tipo1" name="x_tipo1"<?php echo $egresos->tipo1->EditAttributes() ?>>
<?php
if (is_array($egresos->tipo1->EditValue)) {
	$arwrk = $egresos->tipo1->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($egresos->tipo1->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->notas->RowAttributes ?>>
		<td class="ewTableHeader">Notas</td>
		<td<?php echo $egresos->notas->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_notas" id="z_notas" value="LIKE"></span></td>
		<td<?php echo $egresos->notas->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<textarea name="x_notas" id="x_notas" cols="35" rows="4"<?php echo $egresos->notas->EditAttributes() ?>><?php echo $egresos->notas->EditValue ?></textarea>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->Empresa->RowAttributes ?>>
		<td class="ewTableHeader">Empresa</td>
		<td<?php echo $egresos->Empresa->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_Empresa" id="z_Empresa" value="="></span></td>
		<td<?php echo $egresos->Empresa->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<select id="x_Empresa" name="x_Empresa"<?php echo $egresos->Empresa->EditAttributes() ?>>
<?php
if (is_array($egresos->Empresa->EditValue)) {
	$arwrk = $egresos->Empresa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($egresos->Empresa->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->locacion->RowAttributes ?>>
		<td class="ewTableHeader">Locacion</td>
		<td<?php echo $egresos->locacion->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_locacion" id="z_locacion" value="LIKE"></span></td>
		<td<?php echo $egresos->locacion->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<div id="tp_x_locacion" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME; ?>"><input type="checkbox" name="x_locacion[]" id="x_locacion[]" value="{value}"<?php echo $egresos->locacion->EditAttributes() ?>></div>
<div id="dsl_x_locacion" repeatcolumn="4">
<?php
$arwrk = $egresos->locacion->EditValue;
if (is_array($arwrk)) {
	$armultiwrk= explode(",", strval($egresos->locacion->AdvancedSearch->SearchValue));
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
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $egresos->cuenta_banco->RowAttributes ?>>
		<td class="ewTableHeader">Cuenta Banco</td>
		<td<?php echo $egresos->cuenta_banco->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_cuenta_banco" id="z_cuenta_banco" value="="></span></td>
		<td<?php echo $egresos->cuenta_banco->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<select id="x_cuenta_banco" name="x_cuenta_banco"<?php echo $egresos->cuenta_banco->EditAttributes() ?>>
<?php
if (is_array($egresos->cuenta_banco->EditValue)) {
	$arwrk = $egresos->cuenta_banco->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($egresos->cuenta_banco->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span></td>
			</tr></table>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="  Buscar  ">
<input type="button" name="Reset" id="Reset" value=" Reiniciar " onclick="ew_ClearForm(this.form);">
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
class cegresos_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'egresos';

	// Page Object Name
	var $PageObjName = 'egresos_search';

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
	function cegresos_search() {
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
			define("EW_PAGE_ID", 'search', TRUE);

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
		global $objForm, $gsSearchError, $egresos;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$egresos->CurrentAction = $objForm->GetValue("a_search");
			switch ($egresos->CurrentAction) {
				case "S": // Get Search Criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $egresos->UrlParm($sSrchStr);
						$this->Page_Terminate("egresoslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$egresos->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $egresos;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $egresos->id_pago); // id_pago
	$this->BuildSearchUrl($sSrchUrl, $egresos->estado); // estado
	$this->BuildSearchUrl($sSrchUrl, $egresos->total_rd); // total_rd
	$this->BuildSearchUrl($sSrchUrl, $egresos->total_us); // total_us
	$this->BuildSearchUrl($sSrchUrl, $egresos->total_euros); // total_euros
	$this->BuildSearchUrl($sSrchUrl, $egresos->Impuestos_pagados); // Impuestos_pagados
	$this->BuildSearchUrl($sSrchUrl, $egresos->Numero_Referencia); // Numero_Referencia
	$this->BuildSearchUrl($sSrchUrl, $egresos->tipo_comprobante); // tipo_comprobante
	$this->BuildSearchUrl($sSrchUrl, $egresos->Comprobante_fiscal); // Comprobante_fiscal
	$this->BuildSearchUrl($sSrchUrl, $egresos->Metodo_pago); // Metodo_pago
	$this->BuildSearchUrl($sSrchUrl, $egresos->proveedor); // proveedor
	$this->BuildSearchUrl($sSrchUrl, $egresos->fecha); // fecha
	$this->BuildSearchUrl($sSrchUrl, $egresos->tipo1); // tipo1
	$this->BuildSearchUrl($sSrchUrl, $egresos->notas); // notas
	$this->BuildSearchUrl($sSrchUrl, $egresos->Empresa); // Empresa
	$this->BuildSearchUrl($sSrchUrl, $egresos->locacion); // locacion
	$this->BuildSearchUrl($sSrchUrl, $egresos->cuenta_banco); // cuenta_banco
	return $sSrchUrl;
}

// Function to build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($Fld->FldDataType <> EW_DATATYPE_NUMBER) ||
			($Fld->FldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($Fld->FldDataType <> EW_DATATYPE_NUMBER) ||
			($Fld->FldDataType = EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $Fld->FldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($Fld->FldDataType <> EW_DATATYPE_NUMBER) ||
			($Fld->FldDataType = EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $Fld->FldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

	// Convert search value for date
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
			$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		return $Value;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $egresos;

		// Load search values
		$egresos->id_pago->AdvancedSearch->SearchValue = $objForm->GetValue("x_id_pago");
		$egresos->estado->AdvancedSearch->SearchValue = $objForm->GetValue("x_estado");
		$egresos->total_rd->AdvancedSearch->SearchValue = $objForm->GetValue("x_total_rd");
		$egresos->total_us->AdvancedSearch->SearchValue = $objForm->GetValue("x_total_us");
		$egresos->total_euros->AdvancedSearch->SearchValue = $objForm->GetValue("x_total_euros");
		$egresos->Impuestos_pagados->AdvancedSearch->SearchValue = $objForm->GetValue("x_Impuestos_pagados");
		$egresos->Numero_Referencia->AdvancedSearch->SearchValue = $objForm->GetValue("x_Numero_Referencia");
		$egresos->tipo_comprobante->AdvancedSearch->SearchValue = $objForm->GetValue("x_tipo_comprobante");
		$egresos->Comprobante_fiscal->AdvancedSearch->SearchValue = $objForm->GetValue("x_Comprobante_fiscal");
		$egresos->Metodo_pago->AdvancedSearch->SearchValue = $objForm->GetValue("x_Metodo_pago");
		$egresos->proveedor->AdvancedSearch->SearchValue = $objForm->GetValue("x_proveedor");
		$egresos->fecha->AdvancedSearch->SearchValue = $objForm->GetValue("x_fecha");
		$egresos->fecha->AdvancedSearch->SearchValue2 = $objForm->GetValue("y_fecha");
		$egresos->tipo1->AdvancedSearch->SearchValue = $objForm->GetValue("x_tipo1");
		$egresos->notas->AdvancedSearch->SearchValue = $objForm->GetValue("x_notas");
		$egresos->Empresa->AdvancedSearch->SearchValue = $objForm->GetValue("x_Empresa");
		$egresos->locacion->AdvancedSearch->SearchValue = $objForm->GetValue("x_locacion");
		$egresos->cuenta_banco->AdvancedSearch->SearchValue = $objForm->GetValue("x_cuenta_banco");
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
		} elseif ($egresos->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id_pago
			$egresos->id_pago->EditCustomAttributes = "";
			$egresos->id_pago->EditValue = ew_HtmlEncode($egresos->id_pago->AdvancedSearch->SearchValue);

			// estado
			$egresos->estado->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("Pagado", "Pagado");
			$arwrk[] = array("Pendiente", "Pendiente");
			$egresos->estado->EditValue = $arwrk;

			// total_rd
			$egresos->total_rd->EditCustomAttributes = "";
			$egresos->total_rd->EditValue = ew_HtmlEncode($egresos->total_rd->AdvancedSearch->SearchValue);

			// total_us
			$egresos->total_us->EditCustomAttributes = "";
			$egresos->total_us->EditValue = ew_HtmlEncode($egresos->total_us->AdvancedSearch->SearchValue);

			// total_euros
			$egresos->total_euros->EditCustomAttributes = "";
			$egresos->total_euros->EditValue = ew_HtmlEncode($egresos->total_euros->AdvancedSearch->SearchValue);

			// Impuestos_pagados
			$egresos->Impuestos_pagados->EditCustomAttributes = "";
			$egresos->Impuestos_pagados->EditValue = ew_HtmlEncode($egresos->Impuestos_pagados->AdvancedSearch->SearchValue);

			// Numero_Referencia
			$egresos->Numero_Referencia->EditCustomAttributes = "";
			$egresos->Numero_Referencia->EditValue = ew_HtmlEncode($egresos->Numero_Referencia->AdvancedSearch->SearchValue);

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
			$egresos->Comprobante_fiscal->EditValue = ew_HtmlEncode($egresos->Comprobante_fiscal->AdvancedSearch->SearchValue);

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
			$sSqlWrk = "SELECT `id_proveedor`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `proveedores`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nombre` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$egresos->proveedor->EditValue = $arwrk;

			// fecha
			$egresos->fecha->EditCustomAttributes = "";
			$egresos->fecha->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($egresos->fecha->AdvancedSearch->SearchValue, 7), 7));
			$egresos->fecha->EditCustomAttributes = "";
			$egresos->fecha->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($egresos->fecha->AdvancedSearch->SearchValue2, 7), 7));

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
			$egresos->notas->EditValue = ew_HtmlEncode($egresos->notas->AdvancedSearch->SearchValue);

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
			$sSqlWrk = "SELECT `id_locacion`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `locaciones`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nombre` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$egresos->locacion->EditValue = $arwrk;

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
		}

		// Call Row Rendered event
		$egresos->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $egresos;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($egresos->id_pago->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Entero Incorrecto - Id Pago";
		}
		if (!ew_CheckNumber($egresos->total_rd->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Decimal Incorrecto - Total Rd";
		}
		if (!ew_CheckNumber($egresos->total_us->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Decimal Incorrecto - Total Us";
		}
		if (!ew_CheckNumber($egresos->total_euros->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Decimal Incorrecto - Total Euros";
		}
		if (!ew_CheckNumber($egresos->Impuestos_pagados->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Decimal Incorrecto - Impuestos Pagados";
		}
		if (!ew_CheckEuroDate($egresos->fecha->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Fecha incorrecta, formato = dd/mm/yyyy - Fecha";
		}
		if (!ew_CheckEuroDate($egresos->fecha->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Fecha incorrecta, formato = dd/mm/yyyy - Fecha";
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $egresos;
		$egresos->id_pago->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_id_pago");
		$egresos->estado->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_estado");
		$egresos->total_rd->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_total_rd");
		$egresos->total_us->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_total_us");
		$egresos->total_euros->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_total_euros");
		$egresos->Impuestos_pagados->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_Impuestos_pagados");
		$egresos->Numero_Referencia->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_Numero_Referencia");
		$egresos->tipo_comprobante->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_tipo_comprobante");
		$egresos->Comprobante_fiscal->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_Comprobante_fiscal");
		$egresos->Metodo_pago->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_Metodo_pago");
		$egresos->proveedor->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_proveedor");
		$egresos->fecha->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_fecha");
		$egresos->fecha->AdvancedSearch->SearchValue2 = $egresos->getAdvancedSearch("y_fecha");
		$egresos->tipo1->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_tipo1");
		$egresos->notas->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_notas");
		$egresos->Empresa->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_Empresa");
		$egresos->locacion->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_locacion");
		$egresos->cuenta_banco->AdvancedSearch->SearchValue = $egresos->getAdvancedSearch("x_cuenta_banco");
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
