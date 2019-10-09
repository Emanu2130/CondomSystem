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
$ingresos_search = new cingresos_search();
$Page =& $ingresos_search;

// Page init processing
$ingresos_search->Page_Init();

// Page main processing
$ingresos_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var ingresos_search = new ew_Page("ingresos_search");

// page properties
ingresos_search.PageID = "search"; // page ID
var EW_PAGE_ID = ingresos_search.PageID; // for backward compatibility

// extend page with validate function for search
ingresos_search.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_id_ingreso"];
	if (elm && !ew_CheckInteger(elm.value))
		return ew_OnError(this, elm, "Entero Incorrecto - Id Ingreso");
	elm = fobj.elements["x" + infix + "_Fecha_Factura"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Factura");
	elm = fobj.elements["x" + infix + "_Fecha_Dep"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Deposito");
	elm = fobj.elements["x" + infix + "_Valor_RD"];
	if (elm && !ew_CheckNumber(elm.value))
		return ew_OnError(this, elm, "Decimal Incorrecto - Valor RD");
	elm = fobj.elements["x" + infix + "_Valor_US"];
	if (elm && !ew_CheckNumber(elm.value))
		return ew_OnError(this, elm, "Decimal Incorrecto - Valor US");
	elm = fobj.elements["x" + infix + "_Valor_Euros"];
	if (elm && !ew_CheckNumber(elm.value))
		return ew_OnError(this, elm, "Decimal Incorrecto - Valor Euros");
	elm = fobj.elements["x" + infix + "_Valor_Tarjeta_credito"];
	if (elm && !ew_CheckNumber(elm.value))
		return ew_OnError(this, elm, "Decimal Incorrecto - Valor Tarjeta Credito");

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
ingresos_search.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
ingresos_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
ingresos_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
ingresos_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="arenas">Buscar Modulo: Ingresos<br><br>
<a href="<?php echo $ingresos->getReturnUrl() ?>">Volver a la lista</a></span></p>
<?php $ingresos_search->ShowMessage() ?>
<form name="fingresossearch" id="fingresossearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return ingresos_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="ingresos">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $ingresos->id_ingreso->RowAttributes ?>>
		<td class="ewTableHeader">Id Ingreso</td>
		<td<?php echo $ingresos->id_ingreso->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_id_ingreso" id="z_id_ingreso" value="="></span></td>
		<td<?php echo $ingresos->id_ingreso->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_id_ingreso" id="x_id_ingreso" value="<?php echo $ingresos->id_ingreso->EditValue ?>"<?php echo $ingresos->id_ingreso->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $ingresos->tipo_ingreso->RowAttributes ?>>
		<td class="ewTableHeader">Tipo Ingreso</td>
		<td<?php echo $ingresos->tipo_ingreso->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_tipo_ingreso" id="z_tipo_ingreso" value="="></span></td>
		<td<?php echo $ingresos->tipo_ingreso->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<select id="x_tipo_ingreso" name="x_tipo_ingreso"<?php echo $ingresos->tipo_ingreso->EditAttributes() ?>>
<?php
if (is_array($ingresos->tipo_ingreso->EditValue)) {
	$arwrk = $ingresos->tipo_ingreso->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($ingresos->tipo_ingreso->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $ingresos->estado->RowAttributes ?>>
		<td class="ewTableHeader">Estado</td>
		<td<?php echo $ingresos->estado->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_estado" id="z_estado" value="LIKE"></span></td>
		<td<?php echo $ingresos->estado->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<select id="x_estado" name="x_estado"<?php echo $ingresos->estado->EditAttributes() ?>>
<?php
if (is_array($ingresos->estado->EditValue)) {
	$arwrk = $ingresos->estado->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($ingresos->estado->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $ingresos->Numero_Factura->RowAttributes ?>>
		<td class="ewTableHeader">Numero Factura</td>
		<td<?php echo $ingresos->Numero_Factura->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_Numero_Factura" id="z_Numero_Factura" value="LIKE"></span></td>
		<td<?php echo $ingresos->Numero_Factura->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_Numero_Factura" id="x_Numero_Factura" size="30" maxlength="25" value="<?php echo $ingresos->Numero_Factura->EditValue ?>"<?php echo $ingresos->Numero_Factura->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $ingresos->Fecha_Factura->RowAttributes ?>>
		<td class="ewTableHeader">Fecha Factura</td>
		<td<?php echo $ingresos->Fecha_Factura->CellAttributes() ?>><span class="ewSearchOpr">entre<input type="hidden" name="z_Fecha_Factura" id="z_Fecha_Factura" value="BETWEEN"></span></td>
		<td<?php echo $ingresos->Fecha_Factura->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_Fecha_Factura" id="x_Fecha_Factura" value="<?php echo $ingresos->Fecha_Factura->EditValue ?>"<?php echo $ingresos->Fecha_Factura->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Fecha_Factura" name="cal_x_Fecha_Factura" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_Fecha_Factura", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_Fecha_Factura" // ID of the button
});
</script>
</span></td>
				<td><span class="ewSearchOpr" id="btw1_Fecha_Factura" name="btw1_Fecha_Factura">&nbsp;y&nbsp;</span></td>
				<td><span class="arenas" id="btw1_Fecha_Factura" name="btw1_Fecha_Factura">
<input type="text" name="y_Fecha_Factura" id="y_Fecha_Factura" value="<?php echo $ingresos->Fecha_Factura->EditValue2 ?>"<?php echo $ingresos->Fecha_Factura->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_y_Fecha_Factura" name="cal_y_Fecha_Factura" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "y_Fecha_Factura", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_y_Fecha_Factura" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $ingresos->Fecha_Dep->RowAttributes ?>>
		<td class="ewTableHeader">Fecha Deposito</td>
		<td<?php echo $ingresos->Fecha_Dep->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_Fecha_Dep" id="z_Fecha_Dep" value="="></span></td>
		<td<?php echo $ingresos->Fecha_Dep->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_Fecha_Dep" id="x_Fecha_Dep" value="<?php echo $ingresos->Fecha_Dep->EditValue ?>"<?php echo $ingresos->Fecha_Dep->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Fecha_Dep" name="cal_x_Fecha_Dep" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_Fecha_Dep", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_Fecha_Dep" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $ingresos->Descripcion->RowAttributes ?>>
		<td class="ewTableHeader">Descripcion</td>
		<td<?php echo $ingresos->Descripcion->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_Descripcion" id="z_Descripcion" value="LIKE"></span></td>
		<td<?php echo $ingresos->Descripcion->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<textarea name="x_Descripcion" id="x_Descripcion" cols="35" rows="4"<?php echo $ingresos->Descripcion->EditAttributes() ?>><?php echo $ingresos->Descripcion->EditValue ?></textarea>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $ingresos->Valor_RD->RowAttributes ?>>
		<td class="ewTableHeader">Valor RD</td>
		<td<?php echo $ingresos->Valor_RD->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_Valor_RD" id="z_Valor_RD" value="="></span></td>
		<td<?php echo $ingresos->Valor_RD->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_Valor_RD" id="x_Valor_RD" size="30" maxlength="25" value="<?php echo $ingresos->Valor_RD->EditValue ?>"<?php echo $ingresos->Valor_RD->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $ingresos->Valor_US->RowAttributes ?>>
		<td class="ewTableHeader">Valor US</td>
		<td<?php echo $ingresos->Valor_US->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_Valor_US" id="z_Valor_US" value="="></span></td>
		<td<?php echo $ingresos->Valor_US->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_Valor_US" id="x_Valor_US" size="30" maxlength="25" value="<?php echo $ingresos->Valor_US->EditValue ?>"<?php echo $ingresos->Valor_US->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $ingresos->Valor_Euros->RowAttributes ?>>
		<td class="ewTableHeader">Valor Euros</td>
		<td<?php echo $ingresos->Valor_Euros->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_Valor_Euros" id="z_Valor_Euros" value="="></span></td>
		<td<?php echo $ingresos->Valor_Euros->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_Valor_Euros" id="x_Valor_Euros" size="30" value="<?php echo $ingresos->Valor_Euros->EditValue ?>"<?php echo $ingresos->Valor_Euros->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $ingresos->Valor_Tarjeta_credito->RowAttributes ?>>
		<td class="ewTableHeader">Valor Tarjeta Credito</td>
		<td<?php echo $ingresos->Valor_Tarjeta_credito->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_Valor_Tarjeta_credito" id="z_Valor_Tarjeta_credito" value="="></span></td>
		<td<?php echo $ingresos->Valor_Tarjeta_credito->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_Valor_Tarjeta_credito" id="x_Valor_Tarjeta_credito" size="30" maxlength="25" value="<?php echo $ingresos->Valor_Tarjeta_credito->EditValue ?>"<?php echo $ingresos->Valor_Tarjeta_credito->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $ingresos->Empresa->RowAttributes ?>>
		<td class="ewTableHeader">Empresa</td>
		<td<?php echo $ingresos->Empresa->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_Empresa" id="z_Empresa" value="LIKE"></span></td>
		<td<?php echo $ingresos->Empresa->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<select id="x_Empresa" name="x_Empresa"<?php echo $ingresos->Empresa->EditAttributes() ?>>
<?php
if (is_array($ingresos->Empresa->EditValue)) {
	$arwrk = $ingresos->Empresa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($ingresos->Empresa->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $ingresos->tipo_comprobante->RowAttributes ?>>
		<td class="ewTableHeader">Tipo Comprobante</td>
		<td<?php echo $ingresos->tipo_comprobante->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_tipo_comprobante" id="z_tipo_comprobante" value="LIKE"></span></td>
		<td<?php echo $ingresos->tipo_comprobante->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<select id="x_tipo_comprobante" name="x_tipo_comprobante"<?php echo $ingresos->tipo_comprobante->EditAttributes() ?>>
<?php
if (is_array($ingresos->tipo_comprobante->EditValue)) {
	$arwrk = $ingresos->tipo_comprobante->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($ingresos->tipo_comprobante->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $ingresos->NCF->RowAttributes ?>>
		<td class="ewTableHeader">NCF</td>
		<td<?php echo $ingresos->NCF->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_NCF" id="z_NCF" value="LIKE"></span></td>
		<td<?php echo $ingresos->NCF->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<input type="text" name="x_NCF" id="x_NCF" size="30" maxlength="255" value="<?php echo $ingresos->NCF->EditValue ?>"<?php echo $ingresos->NCF->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $ingresos->locacion->RowAttributes ?>>
		<td class="ewTableHeader">Locacion</td>
		<td<?php echo $ingresos->locacion->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_locacion" id="z_locacion" value="LIKE"></span></td>
		<td<?php echo $ingresos->locacion->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<div id="tp_x_locacion" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME; ?>"><input type="checkbox" name="x_locacion[]" id="x_locacion[]" value="{value}"<?php echo $ingresos->locacion->EditAttributes() ?>></div>
<div id="dsl_x_locacion" repeatcolumn="4">
<?php
$arwrk = $ingresos->locacion->EditValue;
if (is_array($arwrk)) {
	$armultiwrk= explode(",", strval($ingresos->locacion->AdvancedSearch->SearchValue));
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
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $ingresos->cuenta_banco->RowAttributes ?>>
		<td class="ewTableHeader">Cuenta Banco</td>
		<td<?php echo $ingresos->cuenta_banco->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_cuenta_banco" id="z_cuenta_banco" value="LIKE"></span></td>
		<td<?php echo $ingresos->cuenta_banco->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<select id="x_cuenta_banco" name="x_cuenta_banco"<?php echo $ingresos->cuenta_banco->EditAttributes() ?>>
<?php
if (is_array($ingresos->cuenta_banco->EditValue)) {
	$arwrk = $ingresos->cuenta_banco->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($ingresos->cuenta_banco->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $ingresos->proveedor->RowAttributes ?>>
		<td class="ewTableHeader">Proveedor</td>
		<td<?php echo $ingresos->proveedor->CellAttributes() ?>><span class="ewSearchOpr">contiene<input type="hidden" name="z_proveedor" id="z_proveedor" value="LIKE"></span></td>
		<td<?php echo $ingresos->proveedor->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="arenas">
<select id="x_proveedor" name="x_proveedor"<?php echo $ingresos->proveedor->EditAttributes() ?>>
<?php
if (is_array($ingresos->proveedor->EditValue)) {
	$arwrk = $ingresos->proveedor->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($ingresos->proveedor->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
class cingresos_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'ingresos';

	// Page Object Name
	var $PageObjName = 'ingresos_search';

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
	function cingresos_search() {
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
			define("EW_PAGE_ID", 'search', TRUE);

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

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsSearchError, $ingresos;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$ingresos->CurrentAction = $objForm->GetValue("a_search");
			switch ($ingresos->CurrentAction) {
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
						$sSrchStr = $ingresos->UrlParm($sSrchStr);
						$this->Page_Terminate("ingresoslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$ingresos->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $ingresos;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $ingresos->id_ingreso); // id_ingreso
	$this->BuildSearchUrl($sSrchUrl, $ingresos->tipo_ingreso); // tipo_ingreso
	$this->BuildSearchUrl($sSrchUrl, $ingresos->estado); // estado
	$this->BuildSearchUrl($sSrchUrl, $ingresos->Numero_Factura); // Numero_Factura
	$this->BuildSearchUrl($sSrchUrl, $ingresos->Fecha_Factura); // Fecha_Factura
	$this->BuildSearchUrl($sSrchUrl, $ingresos->Fecha_Dep); // Fecha_Dep
	$this->BuildSearchUrl($sSrchUrl, $ingresos->Descripcion); // Descripcion
	$this->BuildSearchUrl($sSrchUrl, $ingresos->Valor_RD); // Valor_RD
	$this->BuildSearchUrl($sSrchUrl, $ingresos->Valor_US); // Valor_US
	$this->BuildSearchUrl($sSrchUrl, $ingresos->Valor_Euros); // Valor_Euros
	$this->BuildSearchUrl($sSrchUrl, $ingresos->Valor_Tarjeta_credito); // Valor_Tarjeta_credito
	$this->BuildSearchUrl($sSrchUrl, $ingresos->Empresa); // Empresa
	$this->BuildSearchUrl($sSrchUrl, $ingresos->tipo_comprobante); // tipo_comprobante
	$this->BuildSearchUrl($sSrchUrl, $ingresos->NCF); // NCF
	$this->BuildSearchUrl($sSrchUrl, $ingresos->locacion); // locacion
	$this->BuildSearchUrl($sSrchUrl, $ingresos->cuenta_banco); // cuenta_banco
	$this->BuildSearchUrl($sSrchUrl, $ingresos->proveedor); // proveedor
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
		global $objForm, $ingresos;

		// Load search values
		$ingresos->id_ingreso->AdvancedSearch->SearchValue = $objForm->GetValue("x_id_ingreso");
		$ingresos->tipo_ingreso->AdvancedSearch->SearchValue = $objForm->GetValue("x_tipo_ingreso");
		$ingresos->estado->AdvancedSearch->SearchValue = $objForm->GetValue("x_estado");
		$ingresos->Numero_Factura->AdvancedSearch->SearchValue = $objForm->GetValue("x_Numero_Factura");
		$ingresos->Fecha_Factura->AdvancedSearch->SearchValue = $objForm->GetValue("x_Fecha_Factura");
		$ingresos->Fecha_Factura->AdvancedSearch->SearchValue2 = $objForm->GetValue("y_Fecha_Factura");
		$ingresos->Fecha_Dep->AdvancedSearch->SearchValue = $objForm->GetValue("x_Fecha_Dep");
		$ingresos->Descripcion->AdvancedSearch->SearchValue = $objForm->GetValue("x_Descripcion");
		$ingresos->Valor_RD->AdvancedSearch->SearchValue = $objForm->GetValue("x_Valor_RD");
		$ingresos->Valor_US->AdvancedSearch->SearchValue = $objForm->GetValue("x_Valor_US");
		$ingresos->Valor_Euros->AdvancedSearch->SearchValue = $objForm->GetValue("x_Valor_Euros");
		$ingresos->Valor_Tarjeta_credito->AdvancedSearch->SearchValue = $objForm->GetValue("x_Valor_Tarjeta_credito");
		$ingresos->Empresa->AdvancedSearch->SearchValue = $objForm->GetValue("x_Empresa");
		$ingresos->tipo_comprobante->AdvancedSearch->SearchValue = $objForm->GetValue("x_tipo_comprobante");
		$ingresos->NCF->AdvancedSearch->SearchValue = $objForm->GetValue("x_NCF");
		$ingresos->locacion->AdvancedSearch->SearchValue = $objForm->GetValue("x_locacion");
		$ingresos->cuenta_banco->AdvancedSearch->SearchValue = $objForm->GetValue("x_cuenta_banco");
		$ingresos->proveedor->AdvancedSearch->SearchValue = $objForm->GetValue("x_proveedor");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $ingresos;

		// Call Row_Rendering event
		$ingresos->Row_Rendering();

		// Common render codes for all row types
		// id_ingreso

		$ingresos->id_ingreso->CellCssStyle = "";
		$ingresos->id_ingreso->CellCssClass = "";

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

			// id_ingreso
			$ingresos->id_ingreso->HrefValue = "";

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
		} elseif ($ingresos->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id_ingreso
			$ingresos->id_ingreso->EditCustomAttributes = "";
			$ingresos->id_ingreso->EditValue = ew_HtmlEncode($ingresos->id_ingreso->AdvancedSearch->SearchValue);

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
			$ingresos->Numero_Factura->EditValue = ew_HtmlEncode($ingresos->Numero_Factura->AdvancedSearch->SearchValue);

			// Fecha_Factura
			$ingresos->Fecha_Factura->EditCustomAttributes = "";
			$ingresos->Fecha_Factura->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($ingresos->Fecha_Factura->AdvancedSearch->SearchValue, 7), 7));
			$ingresos->Fecha_Factura->EditCustomAttributes = "";
			$ingresos->Fecha_Factura->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($ingresos->Fecha_Factura->AdvancedSearch->SearchValue2, 7), 7));

			// Fecha_Dep
			$ingresos->Fecha_Dep->EditCustomAttributes = "";
			$ingresos->Fecha_Dep->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($ingresos->Fecha_Dep->AdvancedSearch->SearchValue, 7), 7));

			// Descripcion
			$ingresos->Descripcion->EditCustomAttributes = "";
			$ingresos->Descripcion->EditValue = ew_HtmlEncode($ingresos->Descripcion->AdvancedSearch->SearchValue);

			// Valor_RD
			$ingresos->Valor_RD->EditCustomAttributes = "";
			$ingresos->Valor_RD->EditValue = ew_HtmlEncode($ingresos->Valor_RD->AdvancedSearch->SearchValue);

			// Valor_US
			$ingresos->Valor_US->EditCustomAttributes = "";
			$ingresos->Valor_US->EditValue = ew_HtmlEncode($ingresos->Valor_US->AdvancedSearch->SearchValue);

			// Valor_Euros
			$ingresos->Valor_Euros->EditCustomAttributes = "";
			$ingresos->Valor_Euros->EditValue = ew_HtmlEncode($ingresos->Valor_Euros->AdvancedSearch->SearchValue);

			// Valor_Tarjeta_credito
			$ingresos->Valor_Tarjeta_credito->EditCustomAttributes = "";
			$ingresos->Valor_Tarjeta_credito->EditValue = ew_HtmlEncode($ingresos->Valor_Tarjeta_credito->AdvancedSearch->SearchValue);

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
			$ingresos->NCF->EditValue = ew_HtmlEncode($ingresos->NCF->AdvancedSearch->SearchValue);

			// locacion
			$ingresos->locacion->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_locacion`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `locaciones`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nombre` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$ingresos->locacion->EditValue = $arwrk;

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

		// Call Row Rendered event
		$ingresos->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $ingresos;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($ingresos->id_ingreso->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Entero Incorrecto - Id Ingreso";
		}
		if (!ew_CheckEuroDate($ingresos->Fecha_Factura->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Factura";
		}
		if (!ew_CheckEuroDate($ingresos->Fecha_Factura->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Factura";
		}
		if (!ew_CheckEuroDate($ingresos->Fecha_Dep->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Fecha incorrecta, formato = dd/mm/yyyy - Fecha Deposito";
		}
		if (!ew_CheckNumber($ingresos->Valor_RD->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Decimal Incorrecto - Valor RD";
		}
		if (!ew_CheckNumber($ingresos->Valor_US->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Decimal Incorrecto - Valor US";
		}
		if (!ew_CheckNumber($ingresos->Valor_Euros->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Decimal Incorrecto - Valor Euros";
		}
		if (!ew_CheckNumber($ingresos->Valor_Tarjeta_credito->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Decimal Incorrecto - Valor Tarjeta Credito";
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
		global $ingresos;
		$ingresos->id_ingreso->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_id_ingreso");
		$ingresos->tipo_ingreso->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_tipo_ingreso");
		$ingresos->estado->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_estado");
		$ingresos->Numero_Factura->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_Numero_Factura");
		$ingresos->Fecha_Factura->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_Fecha_Factura");
		$ingresos->Fecha_Factura->AdvancedSearch->SearchValue2 = $ingresos->getAdvancedSearch("y_Fecha_Factura");
		$ingresos->Fecha_Dep->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_Fecha_Dep");
		$ingresos->Descripcion->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_Descripcion");
		$ingresos->Valor_RD->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_Valor_RD");
		$ingresos->Valor_US->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_Valor_US");
		$ingresos->Valor_Euros->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_Valor_Euros");
		$ingresos->Valor_Tarjeta_credito->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_Valor_Tarjeta_credito");
		$ingresos->Empresa->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_Empresa");
		$ingresos->tipo_comprobante->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_tipo_comprobante");
		$ingresos->NCF->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_NCF");
		$ingresos->locacion->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_locacion");
		$ingresos->cuenta_banco->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_cuenta_banco");
		$ingresos->proveedor->AdvancedSearch->SearchValue = $ingresos->getAdvancedSearch("x_proveedor");
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
