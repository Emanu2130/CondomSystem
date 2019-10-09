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
$ingresos_list = new cingresos_list();
$Page =& $ingresos_list;

// Page init processing
$ingresos_list->Page_Init();

// Page main processing
$ingresos_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($ingresos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var ingresos_list = new ew_Page("ingresos_list");

// page properties
ingresos_list.PageID = "list"; // page ID
var EW_PAGE_ID = ingresos_list.PageID; // for backward compatibility

// extend page with ValidateForm function
ingresos_list.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	var addcnt = 0;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		var chkthisrow = true;
		if (fobj.a_list && fobj.a_list.value == "gridinsert")
			chkthisrow = !(this.EmptyRow(fobj, infix));
		else
			chkthisrow = true;
		if (chkthisrow) {
			addcnt += 1;
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
		} // End Grid Add checking
	}
	if (fobj.a_list && fobj.a_list.value == "gridinsert" && addcnt == 0) { // No row added
		alert("No hay registros para agregarNo records to be added");
		return false;
	}
	return true;
}

// Extend page with empty row check
ingresos_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "tipo_ingreso")) return false;
	if (ew_ValueChanged(fobj, infix, "estado")) return false;
	if (ew_ValueChanged(fobj, infix, "Numero_Factura")) return false;
	if (ew_ValueChanged(fobj, infix, "Fecha_Factura")) return false;
	if (ew_ValueChanged(fobj, infix, "Fecha_Dep")) return false;
	if (ew_ValueChanged(fobj, infix, "Valor_RD")) return false;
	if (ew_ValueChanged(fobj, infix, "Valor_US")) return false;
	if (ew_ValueChanged(fobj, infix, "Valor_Euros")) return false;
	if (ew_ValueChanged(fobj, infix, "Valor_Tarjeta_credito")) return false;
	if (ew_ValueChanged(fobj, infix, "Empresa")) return false;
	if (ew_ValueChanged(fobj, infix, "tipo_comprobante")) return false;
	if (ew_ValueChanged(fobj, infix, "NCF")) return false;
	if (ew_ValueChanged(fobj, infix, "locacion")) return false;
	if (ew_ValueChanged(fobj, infix, "cuenta_banco")) return false;
	if (ew_ValueChanged(fobj, infix, "proveedor")) return false;
	return true;
}

// extend page with Form_CustomValidate function
ingresos_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
ingresos_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
ingresos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
ingresos_list.ValidateRequired = false; // no JavaScript validation
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
<?php } ?>
<?php if ($ingresos->Export == "") { ?>
<?php
$gsMasterReturnUrl = "proveedoreslist.php";
if ($ingresos_list->sDbMasterFilter <> "" && $ingresos->getCurrentMasterTable() == "proveedores") {
	if ($ingresos_list->bMasterRecordExists) {
		if ($ingresos->getCurrentMasterTable() == $ingresos->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "proveedoresmaster.php" ?>
<?php
	}
}
?>
<?php
$gsMasterReturnUrl = "locacioneslist.php";
if ($ingresos_list->sDbMasterFilter <> "" && $ingresos->getCurrentMasterTable() == "locaciones") {
	if ($ingresos_list->bMasterRecordExists) {
		if ($ingresos->getCurrentMasterTable() == $ingresos->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "locacionesmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
if ($ingresos->CurrentAction == "gridadd")
	$ingresos->CurrentFilter = "0=1";
if ($ingresos->CurrentAction == "gridadd") {
	$ingresos_list->lStartRec = 1;
	if ($ingresos_list->lDisplayRecs <= 0)
		$ingresos_list->lDisplayRecs = 20;
	$ingresos_list->lTotalRecs = $ingresos_list->lDisplayRecs;
	$ingresos_list->lStopRec = $ingresos_list->lDisplayRecs;
} else {
	$bSelectLimit = ($ingresos->Export == "" && $ingresos->SelectLimit);
	if (!$bSelectLimit)
		$rs = $ingresos_list->LoadRecordset();
	$ingresos_list->lTotalRecs = ($bSelectLimit) ? $ingresos->SelectRecordCount() : $rs->RecordCount();
	$ingresos_list->lStartRec = 1;
	if ($ingresos_list->lDisplayRecs <= 0) // Display all records
		$ingresos_list->lDisplayRecs = $ingresos_list->lTotalRecs;
	if (!($ingresos->ExportAll && $ingresos->Export <> ""))
		$ingresos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $ingresos_list->LoadRecordset($ingresos_list->lStartRec-1, $ingresos_list->lDisplayRecs);
}
?>
<p><span class="arenas" style="white-space: nowrap;">Modulo: Ingresos
<?php if ($ingresos->Export == "" && $ingresos->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $ingresos_list->PageUrl() ?>export=print"><img src='images/print.gif' alt='Printer Friendly' title='Printer Friendly' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $ingresos_list->PageUrl() ?>export=excel"><img src='images/exportxls.gif' alt='Export to Excel' title='Export to Excel' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $ingresos_list->PageUrl() ?>export=word"><img src='images/exportdoc.gif' alt='Export to Word' title='Export to Word' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($ingresos->Export == "" && $ingresos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(ingresos_list);" style="text-decoration: none;"><img id="ingresos_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="arenas">&nbsp;Buscar</span><br>
<div id="ingresos_list_SearchPanel">
<form name="fingresoslistsrch" id="fingresoslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="ingresos">
<table class="ewBasicSearch">
	<tr>
		<td><span class="arenas">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($ingresos->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Buscar (*)">&nbsp;
			<a href="<?php echo $ingresos_list->PageUrl() ?>cmd=reset">Mostrar todos</a>&nbsp;
			<a href="ingresossrch.php">Consulta avanzada</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="arenas"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($ingresos->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Frase exacta</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($ingresos->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>Todas las palabras</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($ingresos->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Cualquier palabra</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $ingresos_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($ingresos->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($ingresos->CurrentAction <> "gridadd" && $ingresos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($ingresos_list->Pager)) $ingresos_list->Pager = new cPrevNextPager($ingresos_list->lStartRec, $ingresos_list->lDisplayRecs, $ingresos_list->lTotalRecs) ?>
<?php if ($ingresos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($ingresos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_list->PageUrl() ?>start=<?php echo $ingresos_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($ingresos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_list->PageUrl() ?>start=<?php echo $ingresos_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $ingresos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($ingresos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_list->PageUrl() ?>start=<?php echo $ingresos_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($ingresos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_list->PageUrl() ?>start=<?php echo $ingresos_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $ingresos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $ingresos_list->Pager->FromIndex ?> a <?php echo $ingresos_list->Pager->ToIndex ?> de <?php echo $ingresos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($ingresos_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($ingresos_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="ingresos">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($ingresos_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($ingresos_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($ingresos_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($ingresos_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($ingresos_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($ingresos_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($ingresos->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="arenas">
<?php if ($ingresos->CurrentAction <> "gridadd" && $ingresos->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $ingresos->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<a href="<?php echo $ingresos_list->PageUrl() ?>a=gridadd">Agregar en grid</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($ingresos_list->lTotalRecs > 0) { ?>
<a href="<?php echo $ingresos_list->PageUrl() ?>a=gridedit">Edición Múltiple</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($ingresos_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fingresoslist)) alert('No se seleccionaron registros'); else {document.fingresoslist.action='ingresosdelete.php';document.fingresoslist.encoding='application/x-www-form-urlencoded';document.fingresoslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fingresoslist)) alert('No se seleccionaron registros'); else {document.fingresoslist.action='ingresosupdate.php';document.fingresoslist.encoding='application/x-www-form-urlencoded';document.fingresoslist.submit();};return false;">Actualizar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($ingresos->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (ingresos_list.ValidateForm(document.fingresoslist)) document.fingresoslist.submit();return false;"><img src='images/insert.gif' alt='Insert' title='Insert' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($ingresos->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (ingresos_list.ValidateForm(document.fingresoslist)) document.fingresoslist.submit();return false;"><img src='images/update.gif' alt='Save' title='Save' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $ingresos_list->PageUrl() ?>a=cancel"><img src='images/cancel.gif' alt='Cancel' title='Cancel' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fingresoslist" id="fingresoslist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="ingresos">
<?php if ($ingresos_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$ingresos_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$ingresos_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$ingresos_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$ingresos_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$ingresos_list->lOptionCnt++; // Multi-select
}
	$ingresos_list->lOptionCnt += count($ingresos_list->ListOptions->Items); // Custom list options
?>
<?php echo $ingresos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($ingresos->id_ingreso->Visible) { // id_ingreso ?>
	<?php if ($ingresos->SortUrl($ingresos->id_ingreso) == "") { ?>
		<td>Id Ingreso</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->id_ingreso) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id Ingreso</td><td style="width: 10px;"><?php if ($ingresos->id_ingreso->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->id_ingreso->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->tipo_ingreso->Visible) { // tipo_ingreso ?>
	<?php if ($ingresos->SortUrl($ingresos->tipo_ingreso) == "") { ?>
		<td>Tipo Ingreso</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->tipo_ingreso) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tipo Ingreso</td><td style="width: 10px;"><?php if ($ingresos->tipo_ingreso->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->tipo_ingreso->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->estado->Visible) { // estado ?>
	<?php if ($ingresos->SortUrl($ingresos->estado) == "") { ?>
		<td>Estado</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->estado) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Estado</td><td style="width: 10px;"><?php if ($ingresos->estado->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->estado->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->Numero_Factura->Visible) { // Numero_Factura ?>
	<?php if ($ingresos->SortUrl($ingresos->Numero_Factura) == "") { ?>
		<td>Numero Factura</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->Numero_Factura) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Numero Factura&nbsp;(*)</td><td style="width: 10px;"><?php if ($ingresos->Numero_Factura->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->Numero_Factura->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->Fecha_Factura->Visible) { // Fecha_Factura ?>
	<?php if ($ingresos->SortUrl($ingresos->Fecha_Factura) == "") { ?>
		<td>Fecha Factura</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->Fecha_Factura) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Fecha Factura</td><td style="width: 10px;"><?php if ($ingresos->Fecha_Factura->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->Fecha_Factura->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->Fecha_Dep->Visible) { // Fecha_Dep ?>
	<?php if ($ingresos->SortUrl($ingresos->Fecha_Dep) == "") { ?>
		<td>Fecha Deposito</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->Fecha_Dep) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Fecha Deposito</td><td style="width: 10px;"><?php if ($ingresos->Fecha_Dep->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->Fecha_Dep->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->Valor_RD->Visible) { // Valor_RD ?>
	<?php if ($ingresos->SortUrl($ingresos->Valor_RD) == "") { ?>
		<td>Valor RD</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->Valor_RD) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Valor RD&nbsp;(*)</td><td style="width: 10px;"><?php if ($ingresos->Valor_RD->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->Valor_RD->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->Valor_US->Visible) { // Valor_US ?>
	<?php if ($ingresos->SortUrl($ingresos->Valor_US) == "") { ?>
		<td>Valor US</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->Valor_US) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Valor US&nbsp;(*)</td><td style="width: 10px;"><?php if ($ingresos->Valor_US->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->Valor_US->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->Valor_Euros->Visible) { // Valor_Euros ?>
	<?php if ($ingresos->SortUrl($ingresos->Valor_Euros) == "") { ?>
		<td>Valor Euros</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->Valor_Euros) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Valor Euros&nbsp;(*)</td><td style="width: 10px;"><?php if ($ingresos->Valor_Euros->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->Valor_Euros->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->Valor_Tarjeta_credito->Visible) { // Valor_Tarjeta_credito ?>
	<?php if ($ingresos->SortUrl($ingresos->Valor_Tarjeta_credito) == "") { ?>
		<td>Valor Tarjeta Credito</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->Valor_Tarjeta_credito) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Valor Tarjeta Credito&nbsp;(*)</td><td style="width: 10px;"><?php if ($ingresos->Valor_Tarjeta_credito->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->Valor_Tarjeta_credito->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->Empresa->Visible) { // Empresa ?>
	<?php if ($ingresos->SortUrl($ingresos->Empresa) == "") { ?>
		<td>Empresa</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->Empresa) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Empresa</td><td style="width: 10px;"><?php if ($ingresos->Empresa->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->Empresa->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->tipo_comprobante->Visible) { // tipo_comprobante ?>
	<?php if ($ingresos->SortUrl($ingresos->tipo_comprobante) == "") { ?>
		<td>Tipo Comprobante</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->tipo_comprobante) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tipo Comprobante</td><td style="width: 10px;"><?php if ($ingresos->tipo_comprobante->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->tipo_comprobante->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->NCF->Visible) { // NCF ?>
	<?php if ($ingresos->SortUrl($ingresos->NCF) == "") { ?>
		<td>NCF</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->NCF) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>NCF&nbsp;(*)</td><td style="width: 10px;"><?php if ($ingresos->NCF->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->NCF->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->locacion->Visible) { // locacion ?>
	<?php if ($ingresos->SortUrl($ingresos->locacion) == "") { ?>
		<td>Locacion</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->locacion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Locacion</td><td style="width: 10px;"><?php if ($ingresos->locacion->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->locacion->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->cuenta_banco->Visible) { // cuenta_banco ?>
	<?php if ($ingresos->SortUrl($ingresos->cuenta_banco) == "") { ?>
		<td>Cuenta Banco</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->cuenta_banco) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Cuenta Banco</td><td style="width: 10px;"><?php if ($ingresos->cuenta_banco->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->cuenta_banco->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->proveedor->Visible) { // proveedor ?>
	<?php if ($ingresos->SortUrl($ingresos->proveedor) == "") { ?>
		<td>Proveedor</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos->SortUrl($ingresos->proveedor) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Proveedor</td><td style="width: 10px;"><?php if ($ingresos->proveedor->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos->proveedor->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos->Export == "") { ?>
<?php if ($ingresos->CurrentAction <> "gridadd" && $ingresos->CurrentAction <> "gridedit") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="arenas" onclick="ingresos_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($ingresos_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<?php
if ($ingresos->ExportAll && $ingresos->Export <> "") {
	$ingresos_list->lStopRec = $ingresos_list->lTotalRecs;
} else {
	$ingresos_list->lStopRec = $ingresos_list->lStartRec + $ingresos_list->lDisplayRecs - 1; // Set the last record to display
}
$ingresos_list->lRecCount = $ingresos_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$ingresos->SelectLimit && $ingresos_list->lStartRec > 1)
		$rs->Move($ingresos_list->lStartRec - 1);
}
$ingresos->Valor_RD->Total = 0; // Initialize total to zero for aggregation
$ingresos->Valor_US->Total = 0; // Initialize total to zero for aggregation
$ingresos->Valor_Euros->Total = 0; // Initialize total to zero for aggregation
$ingresos->Valor_Tarjeta_credito->Total = 0; // Initialize total to zero for aggregation
$ingresos_list->lRowCnt = 0;
if ($ingresos->CurrentAction == "gridadd")
	$ingresos_list->lRowIndex = 0;
if ($ingresos->CurrentAction == "gridedit")
	$ingresos_list->lRowIndex = 0;
while (($ingresos->CurrentAction == "gridadd" || !$rs->EOF) &&
	$ingresos_list->lRecCount < $ingresos_list->lStopRec) {
	$ingresos_list->lRecCount++;
	if (intval($ingresos_list->lRecCount) >= intval($ingresos_list->lStartRec)) {
		$ingresos_list->lRowCnt++;
		if ($ingresos->CurrentAction == "gridadd" || $ingresos->CurrentAction == "gridedit")
			$ingresos_list->lRowIndex++;

	// Init row class and style
	$ingresos->CssClass = "";
	$ingresos->CssStyle = "";
	$ingresos->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($ingresos->CurrentAction == "gridadd") {
		$ingresos_list->LoadDefaultValues(); // Load default values
	} else {
		$ingresos_list->LoadRowValues($rs); // Load row values
	}
	if (is_numeric($ingresos->Valor_RD->CurrentValue)) $ingresos->Valor_RD->Total += $ingresos->Valor_RD->CurrentValue; // Accumulate total
	if (is_numeric($ingresos->Valor_US->CurrentValue)) $ingresos->Valor_US->Total += $ingresos->Valor_US->CurrentValue; // Accumulate total
	if (is_numeric($ingresos->Valor_Euros->CurrentValue)) $ingresos->Valor_Euros->Total += $ingresos->Valor_Euros->CurrentValue; // Accumulate total
	if (is_numeric($ingresos->Valor_Tarjeta_credito->CurrentValue)) $ingresos->Valor_Tarjeta_credito->Total += $ingresos->Valor_Tarjeta_credito->CurrentValue; // Accumulate total
	$ingresos->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($ingresos->CurrentAction == "gridadd") // Grid add
		$ingresos->RowType = EW_ROWTYPE_ADD; // Render add
	if ($ingresos->CurrentAction == "gridadd" && $ingresos->EventCancelled) // Insert failed
		$ingresos_list->RestoreCurrentRowFormValues($ingresos_list->lRowIndex); // Restore form values
	if ($ingresos->CurrentAction == "gridedit") // Grid edit
		$ingresos->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($ingresos->RowType == EW_ROWTYPE_EDIT && $ingresos->EventCancelled) { // Update failed
		if ($ingresos->CurrentAction == "gridedit")
			$ingresos_list->RestoreCurrentRowFormValues($ingresos_list->lRowIndex); // Restore form values
	}
	if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$ingresos_list->lEditRowCnt++;
		$ingresos->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($ingresos->RowType == EW_ROWTYPE_ADD || $ingresos->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$ingresos->CssClass = "ewTableEditRow";

	// Render row
	$ingresos_list->RenderRow();
?>
	<tr<?php echo $ingresos->RowAttributes() ?>>
	<?php if ($ingresos->id_ingreso->Visible) { // id_ingreso ?>
		<td<?php echo $ingresos->id_ingreso->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_id_ingreso" id="o<?php echo $ingresos_list->lRowIndex ?>_id_ingreso" value="<?php echo ew_HtmlEncode($ingresos->id_ingreso->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $ingresos->id_ingreso->ViewAttributes() ?>><?php echo $ingresos->id_ingreso->EditValue ?></div><input type="hidden" name="x<?php echo $ingresos_list->lRowIndex ?>_id_ingreso" id="x<?php echo $ingresos_list->lRowIndex ?>_id_ingreso" value="<?php echo ew_HtmlEncode($ingresos->id_ingreso->CurrentValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->id_ingreso->ViewAttributes() ?>><?php echo $ingresos->id_ingreso->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ingresos->tipo_ingreso->Visible) { // tipo_ingreso ?>
		<td<?php echo $ingresos->tipo_ingreso->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $ingresos_list->lRowIndex ?>_tipo_ingreso" name="x<?php echo $ingresos_list->lRowIndex ?>_tipo_ingreso"<?php echo $ingresos->tipo_ingreso->EditAttributes() ?>>
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
if ($emptywrk) $ingresos->tipo_ingreso->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_tipo_ingreso" id="o<?php echo $ingresos_list->lRowIndex ?>_tipo_ingreso" value="<?php echo ew_HtmlEncode($ingresos->tipo_ingreso->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $ingresos_list->lRowIndex ?>_tipo_ingreso" name="x<?php echo $ingresos_list->lRowIndex ?>_tipo_ingreso"<?php echo $ingresos->tipo_ingreso->EditAttributes() ?>>
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
if ($emptywrk) $ingresos->tipo_ingreso->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->tipo_ingreso->ViewAttributes() ?>><?php echo $ingresos->tipo_ingreso->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ingresos->estado->Visible) { // estado ?>
		<td<?php echo $ingresos->estado->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $ingresos_list->lRowIndex ?>_estado" name="x<?php echo $ingresos_list->lRowIndex ?>_estado"<?php echo $ingresos->estado->EditAttributes() ?>>
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
if ($emptywrk) $ingresos->estado->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_estado" id="o<?php echo $ingresos_list->lRowIndex ?>_estado" value="<?php echo ew_HtmlEncode($ingresos->estado->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $ingresos_list->lRowIndex ?>_estado" name="x<?php echo $ingresos_list->lRowIndex ?>_estado"<?php echo $ingresos->estado->EditAttributes() ?>>
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
if ($emptywrk) $ingresos->estado->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->estado->ViewAttributes() ?>><?php echo $ingresos->estado->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ingresos->Numero_Factura->Visible) { // Numero_Factura ?>
		<td<?php echo $ingresos->Numero_Factura->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_Numero_Factura" id="x<?php echo $ingresos_list->lRowIndex ?>_Numero_Factura" size="30" maxlength="25" value="<?php echo $ingresos->Numero_Factura->EditValue ?>"<?php echo $ingresos->Numero_Factura->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_Numero_Factura" id="o<?php echo $ingresos_list->lRowIndex ?>_Numero_Factura" value="<?php echo ew_HtmlEncode($ingresos->Numero_Factura->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_Numero_Factura" id="x<?php echo $ingresos_list->lRowIndex ?>_Numero_Factura" size="30" maxlength="25" value="<?php echo $ingresos->Numero_Factura->EditValue ?>"<?php echo $ingresos->Numero_Factura->EditAttributes() ?>>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->Numero_Factura->ViewAttributes() ?>><?php echo $ingresos->Numero_Factura->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ingresos->Fecha_Factura->Visible) { // Fecha_Factura ?>
		<td<?php echo $ingresos->Fecha_Factura->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Factura" id="x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Factura" value="<?php echo $ingresos->Fecha_Factura->EditValue ?>"<?php echo $ingresos->Fecha_Factura->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Factura" name="cal_x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Factura" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Factura", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Factura" // ID of the button
});
</script>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_Fecha_Factura" id="o<?php echo $ingresos_list->lRowIndex ?>_Fecha_Factura" value="<?php echo ew_HtmlEncode($ingresos->Fecha_Factura->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Factura" id="x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Factura" value="<?php echo $ingresos->Fecha_Factura->EditValue ?>"<?php echo $ingresos->Fecha_Factura->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Factura" name="cal_x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Factura" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Factura", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Factura" // ID of the button
});
</script>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->Fecha_Factura->ViewAttributes() ?>><?php echo $ingresos->Fecha_Factura->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ingresos->Fecha_Dep->Visible) { // Fecha_Dep ?>
		<td<?php echo $ingresos->Fecha_Dep->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Dep" id="x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Dep" value="<?php echo $ingresos->Fecha_Dep->EditValue ?>"<?php echo $ingresos->Fecha_Dep->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Dep" name="cal_x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Dep" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Dep", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Dep" // ID of the button
});
</script>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_Fecha_Dep" id="o<?php echo $ingresos_list->lRowIndex ?>_Fecha_Dep" value="<?php echo ew_HtmlEncode($ingresos->Fecha_Dep->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Dep" id="x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Dep" value="<?php echo $ingresos->Fecha_Dep->EditValue ?>"<?php echo $ingresos->Fecha_Dep->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Dep" name="cal_x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Dep" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Dep", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $ingresos_list->lRowIndex ?>_Fecha_Dep" // ID of the button
});
</script>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->Fecha_Dep->ViewAttributes() ?>><?php echo $ingresos->Fecha_Dep->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ingresos->Valor_RD->Visible) { // Valor_RD ?>
		<td<?php echo $ingresos->Valor_RD->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_Valor_RD" id="x<?php echo $ingresos_list->lRowIndex ?>_Valor_RD" size="30" maxlength="25" value="<?php echo $ingresos->Valor_RD->EditValue ?>"<?php echo $ingresos->Valor_RD->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_Valor_RD" id="o<?php echo $ingresos_list->lRowIndex ?>_Valor_RD" value="<?php echo ew_HtmlEncode($ingresos->Valor_RD->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_Valor_RD" id="x<?php echo $ingresos_list->lRowIndex ?>_Valor_RD" size="30" maxlength="25" value="<?php echo $ingresos->Valor_RD->EditValue ?>"<?php echo $ingresos->Valor_RD->EditAttributes() ?>>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->Valor_RD->ViewAttributes() ?>><?php echo $ingresos->Valor_RD->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ingresos->Valor_US->Visible) { // Valor_US ?>
		<td<?php echo $ingresos->Valor_US->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_Valor_US" id="x<?php echo $ingresos_list->lRowIndex ?>_Valor_US" size="30" maxlength="25" value="<?php echo $ingresos->Valor_US->EditValue ?>"<?php echo $ingresos->Valor_US->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_Valor_US" id="o<?php echo $ingresos_list->lRowIndex ?>_Valor_US" value="<?php echo ew_HtmlEncode($ingresos->Valor_US->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_Valor_US" id="x<?php echo $ingresos_list->lRowIndex ?>_Valor_US" size="30" maxlength="25" value="<?php echo $ingresos->Valor_US->EditValue ?>"<?php echo $ingresos->Valor_US->EditAttributes() ?>>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->Valor_US->ViewAttributes() ?>><?php echo $ingresos->Valor_US->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ingresos->Valor_Euros->Visible) { // Valor_Euros ?>
		<td<?php echo $ingresos->Valor_Euros->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_Valor_Euros" id="x<?php echo $ingresos_list->lRowIndex ?>_Valor_Euros" size="30" value="<?php echo $ingresos->Valor_Euros->EditValue ?>"<?php echo $ingresos->Valor_Euros->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_Valor_Euros" id="o<?php echo $ingresos_list->lRowIndex ?>_Valor_Euros" value="<?php echo ew_HtmlEncode($ingresos->Valor_Euros->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_Valor_Euros" id="x<?php echo $ingresos_list->lRowIndex ?>_Valor_Euros" size="30" value="<?php echo $ingresos->Valor_Euros->EditValue ?>"<?php echo $ingresos->Valor_Euros->EditAttributes() ?>>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->Valor_Euros->ViewAttributes() ?>><?php echo $ingresos->Valor_Euros->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ingresos->Valor_Tarjeta_credito->Visible) { // Valor_Tarjeta_credito ?>
		<td<?php echo $ingresos->Valor_Tarjeta_credito->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_Valor_Tarjeta_credito" id="x<?php echo $ingresos_list->lRowIndex ?>_Valor_Tarjeta_credito" size="30" maxlength="25" value="<?php echo $ingresos->Valor_Tarjeta_credito->EditValue ?>"<?php echo $ingresos->Valor_Tarjeta_credito->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_Valor_Tarjeta_credito" id="o<?php echo $ingresos_list->lRowIndex ?>_Valor_Tarjeta_credito" value="<?php echo ew_HtmlEncode($ingresos->Valor_Tarjeta_credito->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_Valor_Tarjeta_credito" id="x<?php echo $ingresos_list->lRowIndex ?>_Valor_Tarjeta_credito" size="30" maxlength="25" value="<?php echo $ingresos->Valor_Tarjeta_credito->EditValue ?>"<?php echo $ingresos->Valor_Tarjeta_credito->EditAttributes() ?>>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->Valor_Tarjeta_credito->ViewAttributes() ?>><?php echo $ingresos->Valor_Tarjeta_credito->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ingresos->Empresa->Visible) { // Empresa ?>
		<td<?php echo $ingresos->Empresa->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $ingresos_list->lRowIndex ?>_Empresa" name="x<?php echo $ingresos_list->lRowIndex ?>_Empresa"<?php echo $ingresos->Empresa->EditAttributes() ?>>
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
if ($emptywrk) $ingresos->Empresa->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_Empresa" id="o<?php echo $ingresos_list->lRowIndex ?>_Empresa" value="<?php echo ew_HtmlEncode($ingresos->Empresa->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $ingresos_list->lRowIndex ?>_Empresa" name="x<?php echo $ingresos_list->lRowIndex ?>_Empresa"<?php echo $ingresos->Empresa->EditAttributes() ?>>
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
if ($emptywrk) $ingresos->Empresa->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->Empresa->ViewAttributes() ?>><?php echo $ingresos->Empresa->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ingresos->tipo_comprobante->Visible) { // tipo_comprobante ?>
		<td<?php echo $ingresos->tipo_comprobante->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $ingresos_list->lRowIndex ?>_tipo_comprobante" name="x<?php echo $ingresos_list->lRowIndex ?>_tipo_comprobante"<?php echo $ingresos->tipo_comprobante->EditAttributes() ?>>
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
if ($emptywrk) $ingresos->tipo_comprobante->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_tipo_comprobante" id="o<?php echo $ingresos_list->lRowIndex ?>_tipo_comprobante" value="<?php echo ew_HtmlEncode($ingresos->tipo_comprobante->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $ingresos_list->lRowIndex ?>_tipo_comprobante" name="x<?php echo $ingresos_list->lRowIndex ?>_tipo_comprobante"<?php echo $ingresos->tipo_comprobante->EditAttributes() ?>>
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
if ($emptywrk) $ingresos->tipo_comprobante->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->tipo_comprobante->ViewAttributes() ?>><?php echo $ingresos->tipo_comprobante->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ingresos->NCF->Visible) { // NCF ?>
		<td<?php echo $ingresos->NCF->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_NCF" id="x<?php echo $ingresos_list->lRowIndex ?>_NCF" size="30" maxlength="255" value="<?php echo $ingresos->NCF->EditValue ?>"<?php echo $ingresos->NCF->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_NCF" id="o<?php echo $ingresos_list->lRowIndex ?>_NCF" value="<?php echo ew_HtmlEncode($ingresos->NCF->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ingresos_list->lRowIndex ?>_NCF" id="x<?php echo $ingresos_list->lRowIndex ?>_NCF" size="30" maxlength="255" value="<?php echo $ingresos->NCF->EditValue ?>"<?php echo $ingresos->NCF->EditAttributes() ?>>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->NCF->ViewAttributes() ?>><?php echo $ingresos->NCF->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ingresos->locacion->Visible) { // locacion ?>
		<td<?php echo $ingresos->locacion->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($ingresos->locacion->getSessionValue() <> "") { ?>
<div<?php echo $ingresos->locacion->ViewAttributes() ?>><?php echo $ingresos->locacion->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $ingresos_list->lRowIndex ?>_locacion" name="x<?php echo $ingresos_list->lRowIndex ?>_locacion" value="<?php echo ew_HtmlEncode($ingresos->locacion->CurrentValue) ?>">
<?php } else { ?>
<div id="tp_x<?php echo $ingresos_list->lRowIndex ?>_locacion" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME; ?>"><input type="checkbox" name="x<?php echo $ingresos_list->lRowIndex ?>_locacion[]" id="x<?php echo $ingresos_list->lRowIndex ?>_locacion[]" value="{value}"<?php echo $ingresos->locacion->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $ingresos_list->lRowIndex ?>_locacion" repeatcolumn="4">
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
<label><input type="checkbox" name="x<?php echo $ingresos_list->lRowIndex ?>_locacion[]" id="x<?php echo $ingresos_list->lRowIndex ?>_locacion[]" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $ingresos->locacion->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 4, 2) ?>
<?php
	}
}
if ($emptywrk) $ingresos->locacion->OldValue = "";
?>
</div>
<?php } ?>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_locacion" id="o<?php echo $ingresos_list->lRowIndex ?>_locacion" value="<?php echo ew_HtmlEncode($ingresos->locacion->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($ingresos->locacion->getSessionValue() <> "") { ?>
<div<?php echo $ingresos->locacion->ViewAttributes() ?>><?php echo $ingresos->locacion->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $ingresos_list->lRowIndex ?>_locacion" name="x<?php echo $ingresos_list->lRowIndex ?>_locacion" value="<?php echo ew_HtmlEncode($ingresos->locacion->CurrentValue) ?>">
<?php } else { ?>
<div id="tp_x<?php echo $ingresos_list->lRowIndex ?>_locacion" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME; ?>"><input type="checkbox" name="x<?php echo $ingresos_list->lRowIndex ?>_locacion[]" id="x<?php echo $ingresos_list->lRowIndex ?>_locacion[]" value="{value}"<?php echo $ingresos->locacion->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $ingresos_list->lRowIndex ?>_locacion" repeatcolumn="4">
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
<label><input type="checkbox" name="x<?php echo $ingresos_list->lRowIndex ?>_locacion[]" id="x<?php echo $ingresos_list->lRowIndex ?>_locacion[]" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $ingresos->locacion->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 4, 2) ?>
<?php
	}
}
if ($emptywrk) $ingresos->locacion->OldValue = "";
?>
</div>
<?php } ?>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->locacion->ViewAttributes() ?>><?php echo $ingresos->locacion->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ingresos->cuenta_banco->Visible) { // cuenta_banco ?>
		<td<?php echo $ingresos->cuenta_banco->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $ingresos_list->lRowIndex ?>_cuenta_banco" name="x<?php echo $ingresos_list->lRowIndex ?>_cuenta_banco"<?php echo $ingresos->cuenta_banco->EditAttributes() ?>>
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
if ($emptywrk) $ingresos->cuenta_banco->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_cuenta_banco" id="o<?php echo $ingresos_list->lRowIndex ?>_cuenta_banco" value="<?php echo ew_HtmlEncode($ingresos->cuenta_banco->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $ingresos_list->lRowIndex ?>_cuenta_banco" name="x<?php echo $ingresos_list->lRowIndex ?>_cuenta_banco"<?php echo $ingresos->cuenta_banco->EditAttributes() ?>>
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
if ($emptywrk) $ingresos->cuenta_banco->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->cuenta_banco->ViewAttributes() ?>><?php echo $ingresos->cuenta_banco->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ingresos->proveedor->Visible) { // proveedor ?>
		<td<?php echo $ingresos->proveedor->CellAttributes() ?>>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($ingresos->proveedor->getSessionValue() <> "") { ?>
<div<?php echo $ingresos->proveedor->ViewAttributes() ?>><?php echo $ingresos->proveedor->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $ingresos_list->lRowIndex ?>_proveedor" name="x<?php echo $ingresos_list->lRowIndex ?>_proveedor" value="<?php echo ew_HtmlEncode($ingresos->proveedor->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $ingresos_list->lRowIndex ?>_proveedor" name="x<?php echo $ingresos_list->lRowIndex ?>_proveedor"<?php echo $ingresos->proveedor->EditAttributes() ?>>
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
if ($emptywrk) $ingresos->proveedor->OldValue = "";
?>
</select>
<?php } ?>
<input type="hidden" name="o<?php echo $ingresos_list->lRowIndex ?>_proveedor" id="o<?php echo $ingresos_list->lRowIndex ?>_proveedor" value="<?php echo ew_HtmlEncode($ingresos->proveedor->OldValue) ?>">
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($ingresos->proveedor->getSessionValue() <> "") { ?>
<div<?php echo $ingresos->proveedor->ViewAttributes() ?>><?php echo $ingresos->proveedor->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $ingresos_list->lRowIndex ?>_proveedor" name="x<?php echo $ingresos_list->lRowIndex ?>_proveedor" value="<?php echo ew_HtmlEncode($ingresos->proveedor->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $ingresos_list->lRowIndex ?>_proveedor" name="x<?php echo $ingresos_list->lRowIndex ?>_proveedor"<?php echo $ingresos->proveedor->EditAttributes() ?>>
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
if ($emptywrk) $ingresos->proveedor->OldValue = "";
?>
</select>
<?php } ?>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ingresos->proveedor->ViewAttributes() ?>><?php echo $ingresos->proveedor->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD || $ingresos->RowType == EW_ROWTYPE_EDIT) { ?>
<?php
	if ($ingresos->CurrentAction == "gridedit")
		$ingresos_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $ingresos_list->lRowIndex . "_key\" id=\"k" . $ingresos_list->lRowIndex . "_key\" value=\"" . $ingresos->id_ingreso->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($ingresos->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $ingresos->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $ingresos->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $ingresos->CopyUrl() ?>"><img src='images/copy.gif' alt='Copy' title='Copy' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($ingresos->id_ingreso->CurrentValue) ?>" class="arenas" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($ingresos_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($ingresos->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($ingresos->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($ingresos->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
<?php
$ingresos->Valor_RD->CurrentValue = $ingresos->Valor_RD->Total;
$ingresos->Valor_RD->ViewValue = $ingresos->Valor_RD->CurrentValue;
$ingresos->Valor_RD->CssStyle = "";
$ingresos->Valor_RD->CssClass = "";
$ingresos->Valor_RD->ViewCustomAttributes = "";
$ingresos->Valor_RD->HrefValue = ""; // Clear href value
$ingresos->Valor_US->CurrentValue = $ingresos->Valor_US->Total;
$ingresos->Valor_US->ViewValue = $ingresos->Valor_US->CurrentValue;
$ingresos->Valor_US->CssStyle = "";
$ingresos->Valor_US->CssClass = "";
$ingresos->Valor_US->ViewCustomAttributes = "";
$ingresos->Valor_US->HrefValue = ""; // Clear href value
$ingresos->Valor_Euros->CurrentValue = $ingresos->Valor_Euros->Total;
$ingresos->Valor_Euros->ViewValue = $ingresos->Valor_Euros->CurrentValue;
$ingresos->Valor_Euros->CssStyle = "";
$ingresos->Valor_Euros->CssClass = "";
$ingresos->Valor_Euros->ViewCustomAttributes = "";
$ingresos->Valor_Euros->HrefValue = ""; // Clear href value
$ingresos->Valor_Tarjeta_credito->CurrentValue = $ingresos->Valor_Tarjeta_credito->Total;
$ingresos->Valor_Tarjeta_credito->ViewValue = $ingresos->Valor_Tarjeta_credito->CurrentValue;
$ingresos->Valor_Tarjeta_credito->CssStyle = "";
$ingresos->Valor_Tarjeta_credito->CssClass = "";
$ingresos->Valor_Tarjeta_credito->ViewCustomAttributes = "";
$ingresos->Valor_Tarjeta_credito->HrefValue = ""; // Clear href value
?>
<?php if ($ingresos_list->lTotalRecs > 0) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
	<?php if ($ingresos->id_ingreso->Visible) { // id_ingreso ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($ingresos->tipo_ingreso->Visible) { // tipo_ingreso ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($ingresos->estado->Visible) { // estado ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($ingresos->Numero_Factura->Visible) { // Numero_Factura ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($ingresos->Fecha_Factura->Visible) { // Fecha_Factura ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($ingresos->Fecha_Dep->Visible) { // Fecha_Dep ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($ingresos->Valor_RD->Visible) { // Valor_RD ?>
		<td>
		Total: 
<div<?php echo $ingresos->Valor_RD->ViewAttributes() ?>><?php echo $ingresos->Valor_RD->ViewValue ?></div>
		</td>
	<?php } ?>
	<?php if ($ingresos->Valor_US->Visible) { // Valor_US ?>
		<td>
		Total: 
<div<?php echo $ingresos->Valor_US->ViewAttributes() ?>><?php echo $ingresos->Valor_US->ViewValue ?></div>
		</td>
	<?php } ?>
	<?php if ($ingresos->Valor_Euros->Visible) { // Valor_Euros ?>
		<td>
		Total: 
<div<?php echo $ingresos->Valor_Euros->ViewAttributes() ?>><?php echo $ingresos->Valor_Euros->ViewValue ?></div>
		</td>
	<?php } ?>
	<?php if ($ingresos->Valor_Tarjeta_credito->Visible) { // Valor_Tarjeta_credito ?>
		<td>
		Total: 
<div<?php echo $ingresos->Valor_Tarjeta_credito->ViewAttributes() ?>><?php echo $ingresos->Valor_Tarjeta_credito->ViewValue ?></div>
		</td>
	<?php } ?>
	<?php if ($ingresos->Empresa->Visible) { // Empresa ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($ingresos->tipo_comprobante->Visible) { // tipo_comprobante ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($ingresos->NCF->Visible) { // NCF ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($ingresos->locacion->Visible) { // locacion ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($ingresos->cuenta_banco->Visible) { // cuenta_banco ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($ingresos->proveedor->Visible) { // proveedor ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
<?php if ($ingresos->Export == "") { ?>
<?php if ($ingresos->CurrentAction <> "gridadd" && $ingresos->CurrentAction <> "gridedit") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php

// Custom list options
foreach ($ingresos_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->FooterCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</tfoot>	
<?php } ?>
</table>
<?php } ?>
<?php if ($ingresos->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $ingresos_list->lRowIndex ?>">
<?php } ?>
<?php if ($ingresos->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $ingresos_list->lRowIndex ?>">
<?php echo $ingresos_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($ingresos_list->lTotalRecs > 0) { ?>
<?php if ($ingresos->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($ingresos->CurrentAction <> "gridadd" && $ingresos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($ingresos_list->Pager)) $ingresos_list->Pager = new cPrevNextPager($ingresos_list->lStartRec, $ingresos_list->lDisplayRecs, $ingresos_list->lTotalRecs) ?>
<?php if ($ingresos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($ingresos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_list->PageUrl() ?>start=<?php echo $ingresos_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($ingresos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_list->PageUrl() ?>start=<?php echo $ingresos_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $ingresos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($ingresos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_list->PageUrl() ?>start=<?php echo $ingresos_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($ingresos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_list->PageUrl() ?>start=<?php echo $ingresos_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $ingresos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $ingresos_list->Pager->FromIndex ?> a <?php echo $ingresos_list->Pager->ToIndex ?> de <?php echo $ingresos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($ingresos_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($ingresos_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="ingresos">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($ingresos_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($ingresos_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($ingresos_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($ingresos_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($ingresos_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($ingresos_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($ingresos->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($ingresos_list->lTotalRecs > 0) { ?>
<span class="arenas">
<?php if ($ingresos->CurrentAction <> "gridadd" && $ingresos->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $ingresos->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<a href="<?php echo $ingresos_list->PageUrl() ?>a=gridadd">Agregar en grid</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($ingresos_list->lTotalRecs > 0) { ?>
<a href="<?php echo $ingresos_list->PageUrl() ?>a=gridedit">Edición Múltiple</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($ingresos_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fingresoslist)) alert('No se seleccionaron registros'); else {document.fingresoslist.action='ingresosdelete.php';document.fingresoslist.encoding='application/x-www-form-urlencoded';document.fingresoslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fingresoslist)) alert('No se seleccionaron registros'); else {document.fingresoslist.action='ingresosupdate.php';document.fingresoslist.encoding='application/x-www-form-urlencoded';document.fingresoslist.submit();};return false;">Actualizar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($ingresos->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (ingresos_list.ValidateForm(document.fingresoslist)) document.fingresoslist.submit();return false;"><img src='images/insert.gif' alt='Insert' title='Insert' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($ingresos->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (ingresos_list.ValidateForm(document.fingresoslist)) document.fingresoslist.submit();return false;"><img src='images/update.gif' alt='Save' title='Save' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $ingresos_list->PageUrl() ?>a=cancel"><img src='images/cancel.gif' alt='Cancel' title='Cancel' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($ingresos->Export == "" && $ingresos->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(ingresos_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($ingresos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class cingresos_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'ingresos';

	// Page Object Name
	var $PageObjName = 'ingresos_list';

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
	function cingresos_list() {
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
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'ingresos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
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
	$ingresos->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $ingresos->Export; // Get export parameter, used in header
	$gsExportFile = $ingresos->TableVar; // Get export file, used in header
	if ($ingresos->Export == "print" || $ingresos->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($ingresos->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($ingresos->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
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
	var $lDisplayRecs; // Number of display records
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs;
	var $lRecRange;
	var $sSrchWhere;
	var $lRecCnt;
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex;
	var $lOptionCnt;
	var $lRecPerRow;
	var $lColCnt;
	var $sDeleteConfirmMsg; // Delete confirm message
	var $sDbMasterFilter;
	var $sDbDetailFilter;
	var $bMasterRecordExists;	
	var $ListOptions;
	var $sMultiSelectKey;

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsSearchError, $Security, $ingresos;
		$this->lDisplayRecs = 20;
		$this->lRecRange = 10;
		$this->lRecCnt = 0; // Record count

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		$this->sSrchWhere = ""; // Search WHERE clause

		// Master/Detail
		$this->sDbMasterFilter = ""; // Master filter
		$this->sDbDetailFilter = ""; // Detail filter

		// Create form object
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page dynamically
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterDetail();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$ingresos->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($ingresos->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($ingresos->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to grid add mode
				if ($ingresos->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$ingresos->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($ingresos->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Grid Insert
					if ($ingresos->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd")
						$this->GridInsert();
				}
			}

			// Get search criteria for advanced search
			$this->LoadSearchValues(); // Get search values
			if ($this->ValidateSearch()) {
				$sSrchAdvanced = $this->AdvancedSearchWhere();
			} else {
				$this->setMessage($gsSearchError);
			}

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($ingresos->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $ingresos->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchAdvanced)" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchBasic)" : $sSrchBasic;

		// Call Recordset_Searching event
		$ingresos->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$ingresos->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$ingresos->setStartRecordNumber($this->lStartRec);
		} else {
			$this->RestoreSearchParms();
		}

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->sDbMasterFilter = $ingresos->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $ingresos->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($ingresos->getMasterFilter() <> "" && $ingresos->getCurrentMasterTable() == "proveedores") {
			global $proveedores;
			$rsmaster = $proveedores->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$ingresos->setMasterFilter(""); // Clear master filter
				$ingresos->setDetailFilter(""); // Clear detail filter
				$this->setMessage("No se encontraron registros"); // Set no record found
				$this->Page_Terminate($ingresos->getReturnUrl()); // Return to caller
			} else {
				$proveedores->LoadListRowValues($rsmaster);
				$proveedores->RowType = EW_ROWTYPE_MASTER; // Master row
				$proveedores->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Load master record
		if ($ingresos->getMasterFilter() <> "" && $ingresos->getCurrentMasterTable() == "locaciones") {
			global $locaciones;
			$rsmaster = $locaciones->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$ingresos->setMasterFilter(""); // Clear master filter
				$ingresos->setDetailFilter(""); // Clear detail filter
				$this->setMessage("No se encontraron registros"); // Set no record found
				$this->Page_Terminate($ingresos->getReturnUrl()); // Return to caller
			} else {
				$locaciones->LoadListRowValues($rsmaster);
				$locaciones->RowType = EW_ROWTYPE_MASTER; // Master row
				$locaciones->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in Session
		$ingresos->setSessionWhere($sFilter);
		$ingresos->CurrentFilter = "";

		// Export data only
		if (in_array($ingresos->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $ingresos;
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->lDisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->lDisplayRecs = -1;
				} else {
					$this->lDisplayRecs = 20; // Non-numeric, load default
				}
			}
			$ingresos->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$ingresos->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $ingresos;
		$ingresos->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add Mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
	}

	// Switch to Grid Edit Mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Peform update to grid
	function GridUpdate() {
		global $conn, $objForm, $gsFormError, $ingresos;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$ingresos->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $ingresos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));

		// Update all rows based on key
		while ($sThisKey <> "") {

			// Load all values & keys
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$bGridUpdate = FALSE; // Form error, reset action
				$this->setMessage($gsFormError);
			} else {
				if ($this->SetupKeyValues($sThisKey)) { // Set up key values
					$ingresos->SendEmail = FALSE; // Do not send email on update success
					$bGridUpdate = $this->EditRow(); // Update this row
				} else {
					$bGridUpdate = FALSE; // update failed
				}
			}
			if ($bGridUpdate) {
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			} else {
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		if ($bGridUpdate) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->setMessage("Actualizar completado"); // Set update success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->getMessage() == "")
				$this->setMessage("Actualizar falló"); // Set update failed message
			$ingresos->EventCancelled = TRUE; // Set event cancelled
			$ingresos->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $ingresos;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $ingresos->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		global $ingresos;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$ingresos->id_ingreso->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($ingresos->id_ingreso->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Grid Insert
	// Peform insert to grid
	function GridInsert() {
		global $conn, $objForm, $gsFormError, $ingresos;
		$rowindex = 1;
		$bGridInsert = FALSE;

		// Begin transaction
		$conn->BeginTrans();

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		$sKey = "";

		// Get row count
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$ingresos->SendEmail = FALSE; // Do not send email on insert success

				// Validate Form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow(); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $ingresos->id_ingreso->CurrentValue;

					// Add filter for this record
					$sFilter = $ingresos->KeyFilter();
					if ($sWrkFilter <> "")
						$sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($bGridInsert) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$ingresos->CurrentFilter = $sWrkFilter;
			$sSql = $ingresos->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->setMessage("Insertar completado"); // Set insert success message
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($addcnt == 0) { // No record inserted
				$this->setMessage("No hay registros para agregarNo records to be added");
			} elseif ($this->getMessage() == "") {
				$this->setMessage("Insertar incorrecto"); // Set insert failed message
			}
			$ingresos->EventCancelled = TRUE; // Set event cancelled
			$ingresos->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
	}

	// Check if empty row
	function EmptyRow() {
		global $ingresos;
		if ($ingresos->tipo_ingreso->CurrentValue <> $ingresos->tipo_ingreso->OldValue)
			return FALSE;
		if ($ingresos->estado->CurrentValue <> $ingresos->estado->OldValue)
			return FALSE;
		if ($ingresos->Numero_Factura->CurrentValue <> $ingresos->Numero_Factura->OldValue)
			return FALSE;
		if ($ingresos->Fecha_Factura->CurrentValue <> $ingresos->Fecha_Factura->OldValue)
			return FALSE;
		if ($ingresos->Fecha_Dep->CurrentValue <> $ingresos->Fecha_Dep->OldValue)
			return FALSE;
		if ($ingresos->Valor_RD->CurrentValue <> $ingresos->Valor_RD->OldValue)
			return FALSE;
		if ($ingresos->Valor_US->CurrentValue <> $ingresos->Valor_US->OldValue)
			return FALSE;
		if ($ingresos->Valor_Euros->CurrentValue <> $ingresos->Valor_Euros->OldValue)
			return FALSE;
		if ($ingresos->Valor_Tarjeta_credito->CurrentValue <> $ingresos->Valor_Tarjeta_credito->OldValue)
			return FALSE;
		if ($ingresos->Empresa->CurrentValue <> $ingresos->Empresa->OldValue)
			return FALSE;
		if ($ingresos->tipo_comprobante->CurrentValue <> $ingresos->tipo_comprobante->OldValue)
			return FALSE;
		if ($ingresos->NCF->CurrentValue <> $ingresos->NCF->OldValue)
			return FALSE;
		if ($ingresos->locacion->CurrentValue <> $ingresos->locacion->OldValue)
			return FALSE;
		if ($ingresos->cuenta_banco->CurrentValue <> $ingresos->cuenta_banco->OldValue)
			return FALSE;
		if ($ingresos->proveedor->CurrentValue <> $ingresos->proveedor->OldValue)
			return FALSE;
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $ingresos;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($ingresos->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($ingresos->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($ingresos->id_ingreso->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $ingresos;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $ingresos->id_ingreso, FALSE); // Field id_ingreso
		$this->BuildSearchSql($sWhere, $ingresos->tipo_ingreso, FALSE); // Field tipo_ingreso
		$this->BuildSearchSql($sWhere, $ingresos->estado, FALSE); // Field estado
		$this->BuildSearchSql($sWhere, $ingresos->Numero_Factura, FALSE); // Field Numero_Factura
		$this->BuildSearchSql($sWhere, $ingresos->Fecha_Factura, FALSE); // Field Fecha_Factura
		$this->BuildSearchSql($sWhere, $ingresos->Fecha_Dep, FALSE); // Field Fecha_Dep
		$this->BuildSearchSql($sWhere, $ingresos->Descripcion, FALSE); // Field Descripcion
		$this->BuildSearchSql($sWhere, $ingresos->Valor_RD, FALSE); // Field Valor_RD
		$this->BuildSearchSql($sWhere, $ingresos->Valor_US, FALSE); // Field Valor_US
		$this->BuildSearchSql($sWhere, $ingresos->Valor_Euros, FALSE); // Field Valor_Euros
		$this->BuildSearchSql($sWhere, $ingresos->Valor_Tarjeta_credito, FALSE); // Field Valor_Tarjeta_credito
		$this->BuildSearchSql($sWhere, $ingresos->Empresa, FALSE); // Field Empresa
		$this->BuildSearchSql($sWhere, $ingresos->tipo_comprobante, FALSE); // Field tipo_comprobante
		$this->BuildSearchSql($sWhere, $ingresos->NCF, FALSE); // Field NCF
		$this->BuildSearchSql($sWhere, $ingresos->locacion, TRUE); // Field locacion
		$this->BuildSearchSql($sWhere, $ingresos->cuenta_banco, FALSE); // Field cuenta_banco
		$this->BuildSearchSql($sWhere, $ingresos->proveedor, FALSE); // Field proveedor

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($ingresos->id_ingreso); // Field id_ingreso
			$this->SetSearchParm($ingresos->tipo_ingreso); // Field tipo_ingreso
			$this->SetSearchParm($ingresos->estado); // Field estado
			$this->SetSearchParm($ingresos->Numero_Factura); // Field Numero_Factura
			$this->SetSearchParm($ingresos->Fecha_Factura); // Field Fecha_Factura
			$this->SetSearchParm($ingresos->Fecha_Dep); // Field Fecha_Dep
			$this->SetSearchParm($ingresos->Descripcion); // Field Descripcion
			$this->SetSearchParm($ingresos->Valor_RD); // Field Valor_RD
			$this->SetSearchParm($ingresos->Valor_US); // Field Valor_US
			$this->SetSearchParm($ingresos->Valor_Euros); // Field Valor_Euros
			$this->SetSearchParm($ingresos->Valor_Tarjeta_credito); // Field Valor_Tarjeta_credito
			$this->SetSearchParm($ingresos->Empresa); // Field Empresa
			$this->SetSearchParm($ingresos->tipo_comprobante); // Field tipo_comprobante
			$this->SetSearchParm($ingresos->NCF); // Field NCF
			$this->SetSearchParm($ingresos->locacion); // Field locacion
			$this->SetSearchParm($ingresos->cuenta_banco); // Field cuenta_banco
			$this->SetSearchParm($ingresos->proveedor); // Field proveedor
		}
		return $sWhere;
	}

	// Build search sql
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = @$_GET["x_$FldParm"];
		$FldOpr = @$_GET["z_$FldParm"];
		$FldCond = @$_GET["v_$FldParm"];
		$FldVal2 = @$_GET["y_$FldParm"];
		$FldOpr2 = @$_GET["w_$FldParm"];
		$sWrk = "";
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		if ($sWrk <> "") {
			if ($Where <> "") $Where .= " AND ";
			$Where .= "(" . $sWrk . ")";
		}
	}

	// Set search parm
	function SetSearchParm(&$Fld) {
		global $ingresos;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = @$_GET["x_$FldParm"];
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = @$_GET["y_$FldParm"];
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$ingresos->setAdvancedSearch("x_$FldParm", $FldVal);
		$ingresos->setAdvancedSearch("z_$FldParm", @$_GET["z_$FldParm"]);
		$ingresos->setAdvancedSearch("v_$FldParm", @$_GET["v_$FldParm"]);
		$ingresos->setAdvancedSearch("y_$FldParm", $FldVal2);
		$ingresos->setAdvancedSearch("w_$FldParm", @$_GET["w_$FldParm"]);
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $ingresos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		if (is_numeric($sKeyword)) $sql .= "tipo_ingreso = " . $sKeyword . " OR ";
		$sql .= $ingresos->estado->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $ingresos->Numero_Factura->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $ingresos->Descripcion->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (is_numeric($sKeyword)) $sql .= "Valor_RD = " . $sKeyword . " OR ";
		if (is_numeric($sKeyword)) $sql .= "Valor_US = " . $sKeyword . " OR ";
		if (is_numeric($sKeyword)) $sql .= "Valor_Euros = " . $sKeyword . " OR ";
		if (is_numeric($sKeyword)) $sql .= "Valor_Tarjeta_credito = " . $sKeyword . " OR ";
		$sql .= $ingresos->Empresa->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $ingresos->tipo_comprobante->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $ingresos->NCF->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $ingresos->locacion->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $ingresos->cuenta_banco->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $ingresos->proveedor->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $ingresos;
		$sSearchStr = "";
		$sSearchKeyword = ew_StripSlashes(@$_GET[EW_TABLE_BASIC_SEARCH]);
		$sSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$ingresos->setBasicSearchKeyword($sSearchKeyword);
			$ingresos->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $ingresos;
		$this->sSrchWhere = "";
		$ingresos->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $ingresos;
		$ingresos->setBasicSearchKeyword("");
		$ingresos->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $ingresos;
		$ingresos->setAdvancedSearch("x_id_ingreso", "");
		$ingresos->setAdvancedSearch("x_tipo_ingreso", "");
		$ingresos->setAdvancedSearch("x_estado", "");
		$ingresos->setAdvancedSearch("x_Numero_Factura", "");
		$ingresos->setAdvancedSearch("x_Fecha_Factura", "");
		$ingresos->setAdvancedSearch("y_Fecha_Factura", "");
		$ingresos->setAdvancedSearch("x_Fecha_Dep", "");
		$ingresos->setAdvancedSearch("x_Descripcion", "");
		$ingresos->setAdvancedSearch("x_Valor_RD", "");
		$ingresos->setAdvancedSearch("x_Valor_US", "");
		$ingresos->setAdvancedSearch("x_Valor_Euros", "");
		$ingresos->setAdvancedSearch("x_Valor_Tarjeta_credito", "");
		$ingresos->setAdvancedSearch("x_Empresa", "");
		$ingresos->setAdvancedSearch("x_tipo_comprobante", "");
		$ingresos->setAdvancedSearch("x_NCF", "");
		$ingresos->setAdvancedSearch("x_locacion", "");
		$ingresos->setAdvancedSearch("x_cuenta_banco", "");
		$ingresos->setAdvancedSearch("x_proveedor", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $ingresos;
		$this->sSrchWhere = $ingresos->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
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

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $ingresos;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$ingresos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$ingresos->CurrentOrderType = @$_GET["ordertype"];
			$ingresos->UpdateSort($ingresos->id_ingreso); // Field 
			$ingresos->UpdateSort($ingresos->tipo_ingreso); // Field 
			$ingresos->UpdateSort($ingresos->estado); // Field 
			$ingresos->UpdateSort($ingresos->Numero_Factura); // Field 
			$ingresos->UpdateSort($ingresos->Fecha_Factura); // Field 
			$ingresos->UpdateSort($ingresos->Fecha_Dep); // Field 
			$ingresos->UpdateSort($ingresos->Valor_RD); // Field 
			$ingresos->UpdateSort($ingresos->Valor_US); // Field 
			$ingresos->UpdateSort($ingresos->Valor_Euros); // Field 
			$ingresos->UpdateSort($ingresos->Valor_Tarjeta_credito); // Field 
			$ingresos->UpdateSort($ingresos->Empresa); // Field 
			$ingresos->UpdateSort($ingresos->tipo_comprobante); // Field 
			$ingresos->UpdateSort($ingresos->NCF); // Field 
			$ingresos->UpdateSort($ingresos->locacion); // Field 
			$ingresos->UpdateSort($ingresos->cuenta_banco); // Field 
			$ingresos->UpdateSort($ingresos->proveedor); // Field 
			$ingresos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $ingresos;
		$sOrderBy = $ingresos->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($ingresos->SqlOrderBy() <> "") {
				$sOrderBy = $ingresos->SqlOrderBy();
				$ingresos->setSessionOrderBy($sOrderBy);
				$ingresos->id_ingreso->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $ingresos;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$ingresos->getCurrentMasterTable = ""; // Clear master table
				$ingresos->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$ingresos->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$ingresos->proveedor->setSessionValue("");
				$ingresos->locacion->setSessionValue("");
			}

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$ingresos->setSessionOrderBy($sOrderBy);
				$ingresos->id_ingreso->setSort("");
				$ingresos->tipo_ingreso->setSort("");
				$ingresos->estado->setSort("");
				$ingresos->Numero_Factura->setSort("");
				$ingresos->Fecha_Factura->setSort("");
				$ingresos->Fecha_Dep->setSort("");
				$ingresos->Valor_RD->setSort("");
				$ingresos->Valor_US->setSort("");
				$ingresos->Valor_Euros->setSort("");
				$ingresos->Valor_Tarjeta_credito->setSort("");
				$ingresos->Empresa->setSort("");
				$ingresos->tipo_comprobante->setSort("");
				$ingresos->NCF->setSort("");
				$ingresos->locacion->setSort("");
				$ingresos->cuenta_banco->setSort("");
				$ingresos->proveedor->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$ingresos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $ingresos;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$ingresos->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$ingresos->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $ingresos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$ingresos->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$ingresos->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$ingresos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $ingresos;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $ingresos;

		// Load search values
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $ingresos;
		$ingresos->id_ingreso->setFormValue($objForm->GetValue("x_id_ingreso"));
		$ingresos->id_ingreso->OldValue = $objForm->GetValue("o_id_ingreso");
		$ingresos->tipo_ingreso->setFormValue($objForm->GetValue("x_tipo_ingreso"));
		$ingresos->tipo_ingreso->OldValue = $objForm->GetValue("o_tipo_ingreso");
		$ingresos->estado->setFormValue($objForm->GetValue("x_estado"));
		$ingresos->estado->OldValue = $objForm->GetValue("o_estado");
		$ingresos->Numero_Factura->setFormValue($objForm->GetValue("x_Numero_Factura"));
		$ingresos->Numero_Factura->OldValue = $objForm->GetValue("o_Numero_Factura");
		$ingresos->Fecha_Factura->setFormValue($objForm->GetValue("x_Fecha_Factura"));
		$ingresos->Fecha_Factura->CurrentValue = ew_UnFormatDateTime($ingresos->Fecha_Factura->CurrentValue, 7);
		$ingresos->Fecha_Factura->OldValue = $objForm->GetValue("o_Fecha_Factura");
		$ingresos->Fecha_Dep->setFormValue($objForm->GetValue("x_Fecha_Dep"));
		$ingresos->Fecha_Dep->CurrentValue = ew_UnFormatDateTime($ingresos->Fecha_Dep->CurrentValue, 7);
		$ingresos->Fecha_Dep->OldValue = $objForm->GetValue("o_Fecha_Dep");
		$ingresos->Valor_RD->setFormValue($objForm->GetValue("x_Valor_RD"));
		$ingresos->Valor_RD->OldValue = $objForm->GetValue("o_Valor_RD");
		$ingresos->Valor_US->setFormValue($objForm->GetValue("x_Valor_US"));
		$ingresos->Valor_US->OldValue = $objForm->GetValue("o_Valor_US");
		$ingresos->Valor_Euros->setFormValue($objForm->GetValue("x_Valor_Euros"));
		$ingresos->Valor_Euros->OldValue = $objForm->GetValue("o_Valor_Euros");
		$ingresos->Valor_Tarjeta_credito->setFormValue($objForm->GetValue("x_Valor_Tarjeta_credito"));
		$ingresos->Valor_Tarjeta_credito->OldValue = $objForm->GetValue("o_Valor_Tarjeta_credito");
		$ingresos->Empresa->setFormValue($objForm->GetValue("x_Empresa"));
		$ingresos->Empresa->OldValue = $objForm->GetValue("o_Empresa");
		$ingresos->tipo_comprobante->setFormValue($objForm->GetValue("x_tipo_comprobante"));
		$ingresos->tipo_comprobante->OldValue = $objForm->GetValue("o_tipo_comprobante");
		$ingresos->NCF->setFormValue($objForm->GetValue("x_NCF"));
		$ingresos->NCF->OldValue = $objForm->GetValue("o_NCF");
		$ingresos->locacion->setFormValue($objForm->GetValue("x_locacion"));
		$ingresos->locacion->OldValue = $objForm->GetValue("o_locacion");
		$ingresos->cuenta_banco->setFormValue($objForm->GetValue("x_cuenta_banco"));
		$ingresos->cuenta_banco->OldValue = $objForm->GetValue("o_cuenta_banco");
		$ingresos->proveedor->setFormValue($objForm->GetValue("x_proveedor"));
		$ingresos->proveedor->OldValue = $objForm->GetValue("o_proveedor");
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

			// id_ingreso
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
				$ingresos->locacion->OldValue = $ingresos->locacion->CurrentValue;
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
				$ingresos->proveedor->OldValue = $ingresos->proveedor->CurrentValue;
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
		} elseif ($ingresos->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_ingreso
			$ingresos->id_ingreso->EditCustomAttributes = "";
			$ingresos->id_ingreso->EditValue = $ingresos->id_ingreso->CurrentValue;
			$ingresos->id_ingreso->CssStyle = "";
			$ingresos->id_ingreso->CssClass = "";
			$ingresos->id_ingreso->ViewCustomAttributes = "";

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
				$ingresos->locacion->OldValue = $ingresos->locacion->CurrentValue;
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
				$ingresos->proveedor->OldValue = $ingresos->proveedor->CurrentValue;
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

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $ingresos;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

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

			// Field id_ingreso
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

	// Add record
	function AddRow() {
		global $conn, $Security, $ingresos;
		$rsnew = array();

		// Field id_ingreso
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

	// Load advanced search
	function LoadAdvancedSearch() {
		global $ingresos;
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $ingresos;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($ingresos->ExportAll) {
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export 1 page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($ingresos->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($ingresos->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $ingresos->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id_ingreso', $ingresos->Export);
				ew_ExportAddValue($sExportStr, 'tipo_ingreso', $ingresos->Export);
				ew_ExportAddValue($sExportStr, 'estado', $ingresos->Export);
				ew_ExportAddValue($sExportStr, 'Numero_Factura', $ingresos->Export);
				ew_ExportAddValue($sExportStr, 'Fecha_Factura', $ingresos->Export);
				ew_ExportAddValue($sExportStr, 'Fecha_Dep', $ingresos->Export);
				ew_ExportAddValue($sExportStr, 'Valor_RD', $ingresos->Export);
				ew_ExportAddValue($sExportStr, 'Valor_US', $ingresos->Export);
				ew_ExportAddValue($sExportStr, 'Valor_Euros', $ingresos->Export);
				ew_ExportAddValue($sExportStr, 'Valor_Tarjeta_credito', $ingresos->Export);
				ew_ExportAddValue($sExportStr, 'Empresa', $ingresos->Export);
				ew_ExportAddValue($sExportStr, 'tipo_comprobante', $ingresos->Export);
				ew_ExportAddValue($sExportStr, 'NCF', $ingresos->Export);
				ew_ExportAddValue($sExportStr, 'locacion', $ingresos->Export);
				ew_ExportAddValue($sExportStr, 'cuenta_banco', $ingresos->Export);
				ew_ExportAddValue($sExportStr, 'proveedor', $ingresos->Export);
				echo ew_ExportLine($sExportStr, $ingresos->Export);
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row for display
				$ingresos->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($ingresos->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id_ingreso', $ingresos->id_ingreso->CurrentValue);
					$XmlDoc->AddField('tipo_ingreso', $ingresos->tipo_ingreso->CurrentValue);
					$XmlDoc->AddField('estado', $ingresos->estado->CurrentValue);
					$XmlDoc->AddField('Numero_Factura', $ingresos->Numero_Factura->CurrentValue);
					$XmlDoc->AddField('Fecha_Factura', $ingresos->Fecha_Factura->CurrentValue);
					$XmlDoc->AddField('Fecha_Dep', $ingresos->Fecha_Dep->CurrentValue);
					$XmlDoc->AddField('Valor_RD', $ingresos->Valor_RD->CurrentValue);
					$XmlDoc->AddField('Valor_US', $ingresos->Valor_US->CurrentValue);
					$XmlDoc->AddField('Valor_Euros', $ingresos->Valor_Euros->CurrentValue);
					$XmlDoc->AddField('Valor_Tarjeta_credito', $ingresos->Valor_Tarjeta_credito->CurrentValue);
					$XmlDoc->AddField('Empresa', $ingresos->Empresa->CurrentValue);
					$XmlDoc->AddField('tipo_comprobante', $ingresos->tipo_comprobante->CurrentValue);
					$XmlDoc->AddField('NCF', $ingresos->NCF->CurrentValue);
					$XmlDoc->AddField('locacion', $ingresos->locacion->CurrentValue);
					$XmlDoc->AddField('cuenta_banco', $ingresos->cuenta_banco->CurrentValue);
					$XmlDoc->AddField('proveedor', $ingresos->proveedor->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $ingresos->Export <> "csv") { // Vertical format
						echo ew_ExportField('id_ingreso', $ingresos->id_ingreso->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportField('tipo_ingreso', $ingresos->tipo_ingreso->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportField('estado', $ingresos->estado->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportField('Numero_Factura', $ingresos->Numero_Factura->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportField('Fecha_Factura', $ingresos->Fecha_Factura->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportField('Fecha_Dep', $ingresos->Fecha_Dep->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportField('Valor_RD', $ingresos->Valor_RD->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportField('Valor_US', $ingresos->Valor_US->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportField('Valor_Euros', $ingresos->Valor_Euros->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportField('Valor_Tarjeta_credito', $ingresos->Valor_Tarjeta_credito->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportField('Empresa', $ingresos->Empresa->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportField('tipo_comprobante', $ingresos->tipo_comprobante->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportField('NCF', $ingresos->NCF->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportField('locacion', $ingresos->locacion->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportField('cuenta_banco', $ingresos->cuenta_banco->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportField('proveedor', $ingresos->proveedor->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $ingresos->id_ingreso->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						ew_ExportAddValue($sExportStr, $ingresos->tipo_ingreso->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						ew_ExportAddValue($sExportStr, $ingresos->estado->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						ew_ExportAddValue($sExportStr, $ingresos->Numero_Factura->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						ew_ExportAddValue($sExportStr, $ingresos->Fecha_Factura->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						ew_ExportAddValue($sExportStr, $ingresos->Fecha_Dep->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						ew_ExportAddValue($sExportStr, $ingresos->Valor_RD->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						ew_ExportAddValue($sExportStr, $ingresos->Valor_US->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						ew_ExportAddValue($sExportStr, $ingresos->Valor_Euros->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						ew_ExportAddValue($sExportStr, $ingresos->Valor_Tarjeta_credito->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						ew_ExportAddValue($sExportStr, $ingresos->Empresa->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						ew_ExportAddValue($sExportStr, $ingresos->tipo_comprobante->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						ew_ExportAddValue($sExportStr, $ingresos->NCF->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						ew_ExportAddValue($sExportStr, $ingresos->locacion->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						ew_ExportAddValue($sExportStr, $ingresos->cuenta_banco->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						ew_ExportAddValue($sExportStr, $ingresos->proveedor->ExportValue($ingresos->Export, $ingresos->ExportOriginalValue), $ingresos->Export);
						echo ew_ExportLine($sExportStr, $ingresos->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($ingresos->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($ingresos->Export);
		}
	}

	// Set up Master Detail based on querystring parameter
	function SetUpMasterDetail() {
		global $ingresos;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "proveedores") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $ingresos->SqlMasterFilter_proveedores();
				$this->sDbDetailFilter = $ingresos->SqlDetailFilter_proveedores();
				if (@$_GET["id_proveedor"] <> "") {
					$GLOBALS["proveedores"]->id_proveedor->setQueryStringValue($_GET["id_proveedor"]);
					$ingresos->proveedor->setQueryStringValue($GLOBALS["proveedores"]->id_proveedor->QueryStringValue);
					$ingresos->proveedor->setSessionValue($ingresos->proveedor->QueryStringValue);
					if (!is_numeric($GLOBALS["proveedores"]->id_proveedor->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id_proveedor@", ew_AdjustSql($GLOBALS["proveedores"]->id_proveedor->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@proveedor@", ew_AdjustSql($GLOBALS["proveedores"]->id_proveedor->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
			if ($sMasterTblVar == "locaciones") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $ingresos->SqlMasterFilter_locaciones();
				$this->sDbDetailFilter = $ingresos->SqlDetailFilter_locaciones();
				if (@$_GET["id_locacion"] <> "") {
					$GLOBALS["locaciones"]->id_locacion->setQueryStringValue($_GET["id_locacion"]);
					$ingresos->locacion->setQueryStringValue($GLOBALS["locaciones"]->id_locacion->QueryStringValue);
					$ingresos->locacion->setSessionValue($ingresos->locacion->QueryStringValue);
					if (!is_numeric($GLOBALS["locaciones"]->id_locacion->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id_locacion@", ew_AdjustSql($GLOBALS["locaciones"]->id_locacion->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@locacion@", ew_AdjustSql($GLOBALS["locaciones"]->id_locacion->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$ingresos->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$ingresos->setStartRecordNumber($this->lStartRec);
			$ingresos->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$ingresos->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master session values
			if ($sMasterTblVar <> "proveedores") {
				if ($ingresos->proveedor->QueryStringValue == "") $ingresos->proveedor->setSessionValue("");
			}
			if ($sMasterTblVar <> "locaciones") {
				if ($ingresos->locacion->QueryStringValue == "") $ingresos->locacion->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $ingresos->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $ingresos->getDetailFilter(); // Restore detail filter
		}
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
