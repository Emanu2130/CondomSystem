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
$egresos_list = new cegresos_list();
$Page =& $egresos_list;

// Page init processing
$egresos_list->Page_Init();

// Page main processing
$egresos_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($egresos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var egresos_list = new ew_Page("egresos_list");

// page properties
egresos_list.PageID = "list"; // page ID
var EW_PAGE_ID = egresos_list.PageID; // for backward compatibility

// extend page with ValidateForm function
egresos_list.ValidateForm = function(fobj) {
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
		} // End Grid Add checking
	}
	if (fobj.a_list && fobj.a_list.value == "gridinsert" && addcnt == 0) { // No row added
		alert("No hay registros para agregarNo records to be added");
		return false;
	}
	return true;
}

// Extend page with empty row check
egresos_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "estado")) return false;
	if (ew_ValueChanged(fobj, infix, "total_rd")) return false;
	if (ew_ValueChanged(fobj, infix, "total_us")) return false;
	if (ew_ValueChanged(fobj, infix, "total_euros")) return false;
	if (ew_ValueChanged(fobj, infix, "Impuestos_pagados")) return false;
	if (ew_ValueChanged(fobj, infix, "Numero_Referencia")) return false;
	if (ew_ValueChanged(fobj, infix, "tipo_comprobante")) return false;
	if (ew_ValueChanged(fobj, infix, "Comprobante_fiscal")) return false;
	if (ew_ValueChanged(fobj, infix, "Metodo_pago")) return false;
	if (ew_ValueChanged(fobj, infix, "proveedor")) return false;
	if (ew_ValueChanged(fobj, infix, "fecha")) return false;
	if (ew_ValueChanged(fobj, infix, "tipo1")) return false;
	if (ew_ValueChanged(fobj, infix, "Empresa")) return false;
	if (ew_ValueChanged(fobj, infix, "locacion")) return false;
	if (ew_ValueChanged(fobj, infix, "cuenta_banco")) return false;
	return true;
}

// extend page with Form_CustomValidate function
egresos_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
egresos_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
egresos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
egresos_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($egresos->Export == "") { ?>
<?php
$gsMasterReturnUrl = "proveedoreslist.php";
if ($egresos_list->sDbMasterFilter <> "" && $egresos->getCurrentMasterTable() == "proveedores") {
	if ($egresos_list->bMasterRecordExists) {
		if ($egresos->getCurrentMasterTable() == $egresos->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "proveedoresmaster.php" ?>
<?php
	}
}
?>
<?php
$gsMasterReturnUrl = "locacioneslist.php";
if ($egresos_list->sDbMasterFilter <> "" && $egresos->getCurrentMasterTable() == "locaciones") {
	if ($egresos_list->bMasterRecordExists) {
		if ($egresos->getCurrentMasterTable() == $egresos->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "locacionesmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
if ($egresos->CurrentAction == "gridadd")
	$egresos->CurrentFilter = "0=1";
if ($egresos->CurrentAction == "gridadd") {
	$egresos_list->lStartRec = 1;
	if ($egresos_list->lDisplayRecs <= 0)
		$egresos_list->lDisplayRecs = 20;
	$egresos_list->lTotalRecs = $egresos_list->lDisplayRecs;
	$egresos_list->lStopRec = $egresos_list->lDisplayRecs;
} else {
	$bSelectLimit = ($egresos->Export == "" && $egresos->SelectLimit);
	if (!$bSelectLimit)
		$rs = $egresos_list->LoadRecordset();
	$egresos_list->lTotalRecs = ($bSelectLimit) ? $egresos->SelectRecordCount() : $rs->RecordCount();
	$egresos_list->lStartRec = 1;
	if ($egresos_list->lDisplayRecs <= 0) // Display all records
		$egresos_list->lDisplayRecs = $egresos_list->lTotalRecs;
	if (!($egresos->ExportAll && $egresos->Export <> ""))
		$egresos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $egresos_list->LoadRecordset($egresos_list->lStartRec-1, $egresos_list->lDisplayRecs);
}
?>
<p><span class="arenas" style="white-space: nowrap;">Modulo: Egresos
<?php if ($egresos->Export == "" && $egresos->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $egresos_list->PageUrl() ?>export=print"><img src='images/print.gif' alt='Printer Friendly' title='Printer Friendly' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $egresos_list->PageUrl() ?>export=excel"><img src='images/exportxls.gif' alt='Export to Excel' title='Export to Excel' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $egresos_list->PageUrl() ?>export=word"><img src='images/exportdoc.gif' alt='Export to Word' title='Export to Word' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($egresos->Export == "" && $egresos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(egresos_list);" style="text-decoration: none;"><img id="egresos_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="arenas">&nbsp;Buscar</span><br>
<div id="egresos_list_SearchPanel">
<form name="fegresoslistsrch" id="fegresoslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="egresos">
<table class="ewBasicSearch">
	<tr>
		<td><span class="arenas">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($egresos->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Buscar (*)">&nbsp;
			<a href="<?php echo $egresos_list->PageUrl() ?>cmd=reset">Mostrar todos</a>&nbsp;
			<a href="egresossrch.php">Consulta avanzada</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="arenas"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($egresos->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Frase exacta</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($egresos->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>Todas las palabras</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($egresos->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Cualquier palabra</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $egresos_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($egresos->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($egresos->CurrentAction <> "gridadd" && $egresos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($egresos_list->Pager)) $egresos_list->Pager = new cPrevNextPager($egresos_list->lStartRec, $egresos_list->lDisplayRecs, $egresos_list->lTotalRecs) ?>
<?php if ($egresos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($egresos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_list->PageUrl() ?>start=<?php echo $egresos_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($egresos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_list->PageUrl() ?>start=<?php echo $egresos_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $egresos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($egresos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_list->PageUrl() ?>start=<?php echo $egresos_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($egresos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_list->PageUrl() ?>start=<?php echo $egresos_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $egresos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $egresos_list->Pager->FromIndex ?> a <?php echo $egresos_list->Pager->ToIndex ?> de <?php echo $egresos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($egresos_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($egresos_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="egresos">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($egresos_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($egresos_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($egresos_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($egresos_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($egresos_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($egresos_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($egresos->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="arenas">
<?php if ($egresos->CurrentAction <> "gridadd" && $egresos->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $egresos->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<a href="<?php echo $egresos_list->PageUrl() ?>a=gridadd">Agregar en grid</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($egresos_list->lTotalRecs > 0) { ?>
<a href="<?php echo $egresos_list->PageUrl() ?>a=gridedit">Edición Múltiple</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($egresos_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fegresoslist)) alert('No se seleccionaron registros'); else {document.fegresoslist.action='egresosdelete.php';document.fegresoslist.encoding='application/x-www-form-urlencoded';document.fegresoslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($egresos->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (egresos_list.ValidateForm(document.fegresoslist)) document.fegresoslist.submit();return false;"><img src='images/insert.gif' alt='Insert' title='Insert' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($egresos->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (egresos_list.ValidateForm(document.fegresoslist)) document.fegresoslist.submit();return false;"><img src='images/update.gif' alt='Save' title='Save' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $egresos_list->PageUrl() ?>a=cancel"><img src='images/cancel.gif' alt='Cancel' title='Cancel' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fegresoslist" id="fegresoslist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="egresos">
<?php if ($egresos_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$egresos_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$egresos_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$egresos_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$egresos_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$egresos_list->lOptionCnt++; // Multi-select
}
	$egresos_list->lOptionCnt += count($egresos_list->ListOptions->Items); // Custom list options
?>
<?php echo $egresos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($egresos->id_pago->Visible) { // id_pago ?>
	<?php if ($egresos->SortUrl($egresos->id_pago) == "") { ?>
		<td>Id Pago</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->id_pago) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id Pago&nbsp;(*)</td><td style="width: 10px;"><?php if ($egresos->id_pago->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->id_pago->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->estado->Visible) { // estado ?>
	<?php if ($egresos->SortUrl($egresos->estado) == "") { ?>
		<td>Estado</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->estado) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Estado</td><td style="width: 10px;"><?php if ($egresos->estado->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->estado->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->total_rd->Visible) { // total_rd ?>
	<?php if ($egresos->SortUrl($egresos->total_rd) == "") { ?>
		<td>Total Rd</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->total_rd) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Total Rd&nbsp;(*)</td><td style="width: 10px;"><?php if ($egresos->total_rd->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->total_rd->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->total_us->Visible) { // total_us ?>
	<?php if ($egresos->SortUrl($egresos->total_us) == "") { ?>
		<td>Total Us</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->total_us) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Total Us&nbsp;(*)</td><td style="width: 10px;"><?php if ($egresos->total_us->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->total_us->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->total_euros->Visible) { // total_euros ?>
	<?php if ($egresos->SortUrl($egresos->total_euros) == "") { ?>
		<td>Total Euros</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->total_euros) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Total Euros</td><td style="width: 10px;"><?php if ($egresos->total_euros->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->total_euros->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->Impuestos_pagados->Visible) { // Impuestos_pagados ?>
	<?php if ($egresos->SortUrl($egresos->Impuestos_pagados) == "") { ?>
		<td>Impuestos Pagados</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->Impuestos_pagados) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Impuestos Pagados&nbsp;(*)</td><td style="width: 10px;"><?php if ($egresos->Impuestos_pagados->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->Impuestos_pagados->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->Numero_Referencia->Visible) { // Numero_Referencia ?>
	<?php if ($egresos->SortUrl($egresos->Numero_Referencia) == "") { ?>
		<td>Numero Referencia</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->Numero_Referencia) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Numero Referencia&nbsp;(*)</td><td style="width: 10px;"><?php if ($egresos->Numero_Referencia->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->Numero_Referencia->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->tipo_comprobante->Visible) { // tipo_comprobante ?>
	<?php if ($egresos->SortUrl($egresos->tipo_comprobante) == "") { ?>
		<td>Tipo Comprobante</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->tipo_comprobante) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tipo Comprobante</td><td style="width: 10px;"><?php if ($egresos->tipo_comprobante->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->tipo_comprobante->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->Comprobante_fiscal->Visible) { // Comprobante_fiscal ?>
	<?php if ($egresos->SortUrl($egresos->Comprobante_fiscal) == "") { ?>
		<td>NCF</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->Comprobante_fiscal) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>NCF&nbsp;(*)</td><td style="width: 10px;"><?php if ($egresos->Comprobante_fiscal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->Comprobante_fiscal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->Metodo_pago->Visible) { // Metodo_pago ?>
	<?php if ($egresos->SortUrl($egresos->Metodo_pago) == "") { ?>
		<td>Metodo Pago</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->Metodo_pago) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Metodo Pago</td><td style="width: 10px;"><?php if ($egresos->Metodo_pago->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->Metodo_pago->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->proveedor->Visible) { // proveedor ?>
	<?php if ($egresos->SortUrl($egresos->proveedor) == "") { ?>
		<td>Proveedor</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->proveedor) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Proveedor</td><td style="width: 10px;"><?php if ($egresos->proveedor->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->proveedor->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->fecha->Visible) { // fecha ?>
	<?php if ($egresos->SortUrl($egresos->fecha) == "") { ?>
		<td>Fecha</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->fecha) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Fecha</td><td style="width: 10px;"><?php if ($egresos->fecha->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->fecha->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->tipo1->Visible) { // tipo1 ?>
	<?php if ($egresos->SortUrl($egresos->tipo1) == "") { ?>
		<td>Tipo egreso</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->tipo1) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tipo egreso</td><td style="width: 10px;"><?php if ($egresos->tipo1->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->tipo1->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->Empresa->Visible) { // Empresa ?>
	<?php if ($egresos->SortUrl($egresos->Empresa) == "") { ?>
		<td>Empresa</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->Empresa) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Empresa</td><td style="width: 10px;"><?php if ($egresos->Empresa->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->Empresa->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->locacion->Visible) { // locacion ?>
	<?php if ($egresos->SortUrl($egresos->locacion) == "") { ?>
		<td>Locacion</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->locacion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Locacion</td><td style="width: 10px;"><?php if ($egresos->locacion->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->locacion->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->cuenta_banco->Visible) { // cuenta_banco ?>
	<?php if ($egresos->SortUrl($egresos->cuenta_banco) == "") { ?>
		<td>Cuenta Banco</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos->SortUrl($egresos->cuenta_banco) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Cuenta Banco</td><td style="width: 10px;"><?php if ($egresos->cuenta_banco->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos->cuenta_banco->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos->Export == "") { ?>
<?php if ($egresos->CurrentAction <> "gridadd" && $egresos->CurrentAction <> "gridedit") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="arenas" onclick="egresos_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($egresos_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<?php
if ($egresos->ExportAll && $egresos->Export <> "") {
	$egresos_list->lStopRec = $egresos_list->lTotalRecs;
} else {
	$egresos_list->lStopRec = $egresos_list->lStartRec + $egresos_list->lDisplayRecs - 1; // Set the last record to display
}
$egresos_list->lRecCount = $egresos_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$egresos->SelectLimit && $egresos_list->lStartRec > 1)
		$rs->Move($egresos_list->lStartRec - 1);
}
$egresos->total_rd->Total = 0; // Initialize total to zero for aggregation
$egresos->total_us->Total = 0; // Initialize total to zero for aggregation
$egresos->total_euros->Total = 0; // Initialize total to zero for aggregation
$egresos->Impuestos_pagados->Total = 0; // Initialize total to zero for aggregation
$egresos_list->lRowCnt = 0;
if ($egresos->CurrentAction == "gridadd")
	$egresos_list->lRowIndex = 0;
if ($egresos->CurrentAction == "gridedit")
	$egresos_list->lRowIndex = 0;
while (($egresos->CurrentAction == "gridadd" || !$rs->EOF) &&
	$egresos_list->lRecCount < $egresos_list->lStopRec) {
	$egresos_list->lRecCount++;
	if (intval($egresos_list->lRecCount) >= intval($egresos_list->lStartRec)) {
		$egresos_list->lRowCnt++;
		if ($egresos->CurrentAction == "gridadd" || $egresos->CurrentAction == "gridedit")
			$egresos_list->lRowIndex++;

	// Init row class and style
	$egresos->CssClass = "";
	$egresos->CssStyle = "";
	$egresos->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($egresos->CurrentAction == "gridadd") {
		$egresos_list->LoadDefaultValues(); // Load default values
	} else {
		$egresos_list->LoadRowValues($rs); // Load row values
	}
	if (is_numeric($egresos->total_rd->CurrentValue)) $egresos->total_rd->Total += $egresos->total_rd->CurrentValue; // Accumulate total
	if (is_numeric($egresos->total_us->CurrentValue)) $egresos->total_us->Total += $egresos->total_us->CurrentValue; // Accumulate total
	if (is_numeric($egresos->total_euros->CurrentValue)) $egresos->total_euros->Total += $egresos->total_euros->CurrentValue; // Accumulate total
	if (is_numeric($egresos->Impuestos_pagados->CurrentValue)) $egresos->Impuestos_pagados->Total += $egresos->Impuestos_pagados->CurrentValue; // Accumulate total
	$egresos->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($egresos->CurrentAction == "gridadd") // Grid add
		$egresos->RowType = EW_ROWTYPE_ADD; // Render add
	if ($egresos->CurrentAction == "gridadd" && $egresos->EventCancelled) // Insert failed
		$egresos_list->RestoreCurrentRowFormValues($egresos_list->lRowIndex); // Restore form values
	if ($egresos->CurrentAction == "gridedit") // Grid edit
		$egresos->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($egresos->RowType == EW_ROWTYPE_EDIT && $egresos->EventCancelled) { // Update failed
		if ($egresos->CurrentAction == "gridedit")
			$egresos_list->RestoreCurrentRowFormValues($egresos_list->lRowIndex); // Restore form values
	}
	if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$egresos_list->lEditRowCnt++;
		$egresos->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($egresos->RowType == EW_ROWTYPE_ADD || $egresos->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$egresos->CssClass = "ewTableEditRow";

	// Render row
	$egresos_list->RenderRow();
?>
	<tr<?php echo $egresos->RowAttributes() ?>>
	<?php if ($egresos->id_pago->Visible) { // id_pago ?>
		<td<?php echo $egresos->id_pago->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_id_pago" id="o<?php echo $egresos_list->lRowIndex ?>_id_pago" value="<?php echo ew_HtmlEncode($egresos->id_pago->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $egresos->id_pago->ViewAttributes() ?>><?php echo $egresos->id_pago->EditValue ?></div><input type="hidden" name="x<?php echo $egresos_list->lRowIndex ?>_id_pago" id="x<?php echo $egresos_list->lRowIndex ?>_id_pago" value="<?php echo ew_HtmlEncode($egresos->id_pago->CurrentValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->id_pago->ViewAttributes() ?>><?php echo $egresos->id_pago->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos->estado->Visible) { // estado ?>
		<td<?php echo $egresos->estado->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<div id="tp_x<?php echo $egresos_list->lRowIndex ?>_estado" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $egresos_list->lRowIndex ?>_estado" id="x<?php echo $egresos_list->lRowIndex ?>_estado" value="{value}"<?php echo $egresos->estado->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $egresos_list->lRowIndex ?>_estado" repeatcolumn="5">
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
<label><input type="radio" name="x<?php echo $egresos_list->lRowIndex ?>_estado" id="x<?php echo $egresos_list->lRowIndex ?>_estado" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $egresos->estado->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $egresos->estado->OldValue = "";
?>
</div>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_estado" id="o<?php echo $egresos_list->lRowIndex ?>_estado" value="<?php echo ew_HtmlEncode($egresos->estado->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $egresos_list->lRowIndex ?>_estado" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $egresos_list->lRowIndex ?>_estado" id="x<?php echo $egresos_list->lRowIndex ?>_estado" value="{value}"<?php echo $egresos->estado->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $egresos_list->lRowIndex ?>_estado" repeatcolumn="5">
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
<label><input type="radio" name="x<?php echo $egresos_list->lRowIndex ?>_estado" id="x<?php echo $egresos_list->lRowIndex ?>_estado" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $egresos->estado->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $egresos->estado->OldValue = "";
?>
</div>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->estado->ViewAttributes() ?>><?php echo $egresos->estado->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos->total_rd->Visible) { // total_rd ?>
		<td<?php echo $egresos->total_rd->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $egresos_list->lRowIndex ?>_total_rd" id="x<?php echo $egresos_list->lRowIndex ?>_total_rd" size="30" maxlength="255" value="<?php echo $egresos->total_rd->EditValue ?>"<?php echo $egresos->total_rd->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_total_rd" id="o<?php echo $egresos_list->lRowIndex ?>_total_rd" value="<?php echo ew_HtmlEncode($egresos->total_rd->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $egresos_list->lRowIndex ?>_total_rd" id="x<?php echo $egresos_list->lRowIndex ?>_total_rd" size="30" maxlength="255" value="<?php echo $egresos->total_rd->EditValue ?>"<?php echo $egresos->total_rd->EditAttributes() ?>>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->total_rd->ViewAttributes() ?>><?php echo $egresos->total_rd->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos->total_us->Visible) { // total_us ?>
		<td<?php echo $egresos->total_us->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $egresos_list->lRowIndex ?>_total_us" id="x<?php echo $egresos_list->lRowIndex ?>_total_us" size="30" maxlength="255" value="<?php echo $egresos->total_us->EditValue ?>"<?php echo $egresos->total_us->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_total_us" id="o<?php echo $egresos_list->lRowIndex ?>_total_us" value="<?php echo ew_HtmlEncode($egresos->total_us->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $egresos_list->lRowIndex ?>_total_us" id="x<?php echo $egresos_list->lRowIndex ?>_total_us" size="30" maxlength="255" value="<?php echo $egresos->total_us->EditValue ?>"<?php echo $egresos->total_us->EditAttributes() ?>>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->total_us->ViewAttributes() ?>><?php echo $egresos->total_us->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos->total_euros->Visible) { // total_euros ?>
		<td<?php echo $egresos->total_euros->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $egresos_list->lRowIndex ?>_total_euros" id="x<?php echo $egresos_list->lRowIndex ?>_total_euros" size="30" value="<?php echo $egresos->total_euros->EditValue ?>"<?php echo $egresos->total_euros->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_total_euros" id="o<?php echo $egresos_list->lRowIndex ?>_total_euros" value="<?php echo ew_HtmlEncode($egresos->total_euros->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $egresos_list->lRowIndex ?>_total_euros" id="x<?php echo $egresos_list->lRowIndex ?>_total_euros" size="30" value="<?php echo $egresos->total_euros->EditValue ?>"<?php echo $egresos->total_euros->EditAttributes() ?>>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->total_euros->ViewAttributes() ?>><?php echo $egresos->total_euros->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos->Impuestos_pagados->Visible) { // Impuestos_pagados ?>
		<td<?php echo $egresos->Impuestos_pagados->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $egresos_list->lRowIndex ?>_Impuestos_pagados" id="x<?php echo $egresos_list->lRowIndex ?>_Impuestos_pagados" size="30" maxlength="255" value="<?php echo $egresos->Impuestos_pagados->EditValue ?>"<?php echo $egresos->Impuestos_pagados->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_Impuestos_pagados" id="o<?php echo $egresos_list->lRowIndex ?>_Impuestos_pagados" value="<?php echo ew_HtmlEncode($egresos->Impuestos_pagados->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $egresos_list->lRowIndex ?>_Impuestos_pagados" id="x<?php echo $egresos_list->lRowIndex ?>_Impuestos_pagados" size="30" maxlength="255" value="<?php echo $egresos->Impuestos_pagados->EditValue ?>"<?php echo $egresos->Impuestos_pagados->EditAttributes() ?>>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->Impuestos_pagados->ViewAttributes() ?>><?php echo $egresos->Impuestos_pagados->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos->Numero_Referencia->Visible) { // Numero_Referencia ?>
		<td<?php echo $egresos->Numero_Referencia->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $egresos_list->lRowIndex ?>_Numero_Referencia" id="x<?php echo $egresos_list->lRowIndex ?>_Numero_Referencia" size="30" maxlength="255" value="<?php echo $egresos->Numero_Referencia->EditValue ?>"<?php echo $egresos->Numero_Referencia->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_Numero_Referencia" id="o<?php echo $egresos_list->lRowIndex ?>_Numero_Referencia" value="<?php echo ew_HtmlEncode($egresos->Numero_Referencia->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $egresos_list->lRowIndex ?>_Numero_Referencia" id="x<?php echo $egresos_list->lRowIndex ?>_Numero_Referencia" size="30" maxlength="255" value="<?php echo $egresos->Numero_Referencia->EditValue ?>"<?php echo $egresos->Numero_Referencia->EditAttributes() ?>>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->Numero_Referencia->ViewAttributes() ?>><?php echo $egresos->Numero_Referencia->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos->tipo_comprobante->Visible) { // tipo_comprobante ?>
		<td<?php echo $egresos->tipo_comprobante->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $egresos_list->lRowIndex ?>_tipo_comprobante" name="x<?php echo $egresos_list->lRowIndex ?>_tipo_comprobante"<?php echo $egresos->tipo_comprobante->EditAttributes() ?>>
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
if ($emptywrk) $egresos->tipo_comprobante->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_tipo_comprobante" id="o<?php echo $egresos_list->lRowIndex ?>_tipo_comprobante" value="<?php echo ew_HtmlEncode($egresos->tipo_comprobante->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $egresos_list->lRowIndex ?>_tipo_comprobante" name="x<?php echo $egresos_list->lRowIndex ?>_tipo_comprobante"<?php echo $egresos->tipo_comprobante->EditAttributes() ?>>
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
if ($emptywrk) $egresos->tipo_comprobante->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->tipo_comprobante->ViewAttributes() ?>><?php echo $egresos->tipo_comprobante->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos->Comprobante_fiscal->Visible) { // Comprobante_fiscal ?>
		<td<?php echo $egresos->Comprobante_fiscal->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $egresos_list->lRowIndex ?>_Comprobante_fiscal" id="x<?php echo $egresos_list->lRowIndex ?>_Comprobante_fiscal" size="30" maxlength="255" value="<?php echo $egresos->Comprobante_fiscal->EditValue ?>"<?php echo $egresos->Comprobante_fiscal->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_Comprobante_fiscal" id="o<?php echo $egresos_list->lRowIndex ?>_Comprobante_fiscal" value="<?php echo ew_HtmlEncode($egresos->Comprobante_fiscal->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $egresos_list->lRowIndex ?>_Comprobante_fiscal" id="x<?php echo $egresos_list->lRowIndex ?>_Comprobante_fiscal" size="30" maxlength="255" value="<?php echo $egresos->Comprobante_fiscal->EditValue ?>"<?php echo $egresos->Comprobante_fiscal->EditAttributes() ?>>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->Comprobante_fiscal->ViewAttributes() ?>><?php echo $egresos->Comprobante_fiscal->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos->Metodo_pago->Visible) { // Metodo_pago ?>
		<td<?php echo $egresos->Metodo_pago->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $egresos_list->lRowIndex ?>_Metodo_pago" name="x<?php echo $egresos_list->lRowIndex ?>_Metodo_pago"<?php echo $egresos->Metodo_pago->EditAttributes() ?>>
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
if ($emptywrk) $egresos->Metodo_pago->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_Metodo_pago" id="o<?php echo $egresos_list->lRowIndex ?>_Metodo_pago" value="<?php echo ew_HtmlEncode($egresos->Metodo_pago->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $egresos_list->lRowIndex ?>_Metodo_pago" name="x<?php echo $egresos_list->lRowIndex ?>_Metodo_pago"<?php echo $egresos->Metodo_pago->EditAttributes() ?>>
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
if ($emptywrk) $egresos->Metodo_pago->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->Metodo_pago->ViewAttributes() ?>><?php echo $egresos->Metodo_pago->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos->proveedor->Visible) { // proveedor ?>
		<td<?php echo $egresos->proveedor->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($egresos->proveedor->getSessionValue() <> "") { ?>
<div<?php echo $egresos->proveedor->ViewAttributes() ?>><?php echo $egresos->proveedor->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $egresos_list->lRowIndex ?>_proveedor" name="x<?php echo $egresos_list->lRowIndex ?>_proveedor" value="<?php echo ew_HtmlEncode($egresos->proveedor->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $egresos_list->lRowIndex ?>_proveedor" name="x<?php echo $egresos_list->lRowIndex ?>_proveedor"<?php echo $egresos->proveedor->EditAttributes() ?>>
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
if ($emptywrk) $egresos->proveedor->OldValue = "";
?>
</select>
<?php } ?>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_proveedor" id="o<?php echo $egresos_list->lRowIndex ?>_proveedor" value="<?php echo ew_HtmlEncode($egresos->proveedor->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($egresos->proveedor->getSessionValue() <> "") { ?>
<div<?php echo $egresos->proveedor->ViewAttributes() ?>><?php echo $egresos->proveedor->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $egresos_list->lRowIndex ?>_proveedor" name="x<?php echo $egresos_list->lRowIndex ?>_proveedor" value="<?php echo ew_HtmlEncode($egresos->proveedor->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $egresos_list->lRowIndex ?>_proveedor" name="x<?php echo $egresos_list->lRowIndex ?>_proveedor"<?php echo $egresos->proveedor->EditAttributes() ?>>
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
if ($emptywrk) $egresos->proveedor->OldValue = "";
?>
</select>
<?php } ?>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->proveedor->ViewAttributes() ?>><?php echo $egresos->proveedor->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos->fecha->Visible) { // fecha ?>
		<td<?php echo $egresos->fecha->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $egresos_list->lRowIndex ?>_fecha" id="x<?php echo $egresos_list->lRowIndex ?>_fecha" size="30" maxlength="255" value="<?php echo $egresos->fecha->EditValue ?>"<?php echo $egresos->fecha->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $egresos_list->lRowIndex ?>_fecha" name="cal_x<?php echo $egresos_list->lRowIndex ?>_fecha" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $egresos_list->lRowIndex ?>_fecha", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $egresos_list->lRowIndex ?>_fecha" // ID of the button
});
</script>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_fecha" id="o<?php echo $egresos_list->lRowIndex ?>_fecha" value="<?php echo ew_HtmlEncode($egresos->fecha->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $egresos_list->lRowIndex ?>_fecha" id="x<?php echo $egresos_list->lRowIndex ?>_fecha" size="30" maxlength="255" value="<?php echo $egresos->fecha->EditValue ?>"<?php echo $egresos->fecha->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $egresos_list->lRowIndex ?>_fecha" name="cal_x<?php echo $egresos_list->lRowIndex ?>_fecha" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $egresos_list->lRowIndex ?>_fecha", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $egresos_list->lRowIndex ?>_fecha" // ID of the button
});
</script>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->fecha->ViewAttributes() ?>><?php echo $egresos->fecha->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos->tipo1->Visible) { // tipo1 ?>
		<td<?php echo $egresos->tipo1->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $egresos_list->lRowIndex ?>_tipo1" name="x<?php echo $egresos_list->lRowIndex ?>_tipo1"<?php echo $egresos->tipo1->EditAttributes() ?>>
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
if ($emptywrk) $egresos->tipo1->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_tipo1" id="o<?php echo $egresos_list->lRowIndex ?>_tipo1" value="<?php echo ew_HtmlEncode($egresos->tipo1->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $egresos_list->lRowIndex ?>_tipo1" name="x<?php echo $egresos_list->lRowIndex ?>_tipo1"<?php echo $egresos->tipo1->EditAttributes() ?>>
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
if ($emptywrk) $egresos->tipo1->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->tipo1->ViewAttributes() ?>><?php echo $egresos->tipo1->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos->Empresa->Visible) { // Empresa ?>
		<td<?php echo $egresos->Empresa->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $egresos_list->lRowIndex ?>_Empresa" name="x<?php echo $egresos_list->lRowIndex ?>_Empresa"<?php echo $egresos->Empresa->EditAttributes() ?>>
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
if ($emptywrk) $egresos->Empresa->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_Empresa" id="o<?php echo $egresos_list->lRowIndex ?>_Empresa" value="<?php echo ew_HtmlEncode($egresos->Empresa->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $egresos_list->lRowIndex ?>_Empresa" name="x<?php echo $egresos_list->lRowIndex ?>_Empresa"<?php echo $egresos->Empresa->EditAttributes() ?>>
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
if ($emptywrk) $egresos->Empresa->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->Empresa->ViewAttributes() ?>><?php echo $egresos->Empresa->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos->locacion->Visible) { // locacion ?>
		<td<?php echo $egresos->locacion->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($egresos->locacion->getSessionValue() <> "") { ?>
<div<?php echo $egresos->locacion->ViewAttributes() ?>><?php echo $egresos->locacion->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $egresos_list->lRowIndex ?>_locacion" name="x<?php echo $egresos_list->lRowIndex ?>_locacion" value="<?php echo ew_HtmlEncode($egresos->locacion->CurrentValue) ?>">
<?php } else { ?>
<div id="tp_x<?php echo $egresos_list->lRowIndex ?>_locacion" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME; ?>"><input type="checkbox" name="x<?php echo $egresos_list->lRowIndex ?>_locacion[]" id="x<?php echo $egresos_list->lRowIndex ?>_locacion[]" value="{value}"<?php echo $egresos->locacion->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $egresos_list->lRowIndex ?>_locacion" repeatcolumn="4">
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
<label><input type="checkbox" name="x<?php echo $egresos_list->lRowIndex ?>_locacion[]" id="x<?php echo $egresos_list->lRowIndex ?>_locacion[]" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $egresos->locacion->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 4, 2) ?>
<?php
	}
}
if ($emptywrk) $egresos->locacion->OldValue = "";
?>
</div>
<?php } ?>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_locacion" id="o<?php echo $egresos_list->lRowIndex ?>_locacion" value="<?php echo ew_HtmlEncode($egresos->locacion->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($egresos->locacion->getSessionValue() <> "") { ?>
<div<?php echo $egresos->locacion->ViewAttributes() ?>><?php echo $egresos->locacion->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $egresos_list->lRowIndex ?>_locacion" name="x<?php echo $egresos_list->lRowIndex ?>_locacion" value="<?php echo ew_HtmlEncode($egresos->locacion->CurrentValue) ?>">
<?php } else { ?>
<div id="tp_x<?php echo $egresos_list->lRowIndex ?>_locacion" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME; ?>"><input type="checkbox" name="x<?php echo $egresos_list->lRowIndex ?>_locacion[]" id="x<?php echo $egresos_list->lRowIndex ?>_locacion[]" value="{value}"<?php echo $egresos->locacion->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $egresos_list->lRowIndex ?>_locacion" repeatcolumn="4">
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
<label><input type="checkbox" name="x<?php echo $egresos_list->lRowIndex ?>_locacion[]" id="x<?php echo $egresos_list->lRowIndex ?>_locacion[]" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $egresos->locacion->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 4, 2) ?>
<?php
	}
}
if ($emptywrk) $egresos->locacion->OldValue = "";
?>
</div>
<?php } ?>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->locacion->ViewAttributes() ?>><?php echo $egresos->locacion->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos->cuenta_banco->Visible) { // cuenta_banco ?>
		<td<?php echo $egresos->cuenta_banco->CellAttributes() ?>>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $egresos_list->lRowIndex ?>_cuenta_banco" name="x<?php echo $egresos_list->lRowIndex ?>_cuenta_banco"<?php echo $egresos->cuenta_banco->EditAttributes() ?>>
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
if ($emptywrk) $egresos->cuenta_banco->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $egresos_list->lRowIndex ?>_cuenta_banco" id="o<?php echo $egresos_list->lRowIndex ?>_cuenta_banco" value="<?php echo ew_HtmlEncode($egresos->cuenta_banco->OldValue) ?>">
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $egresos_list->lRowIndex ?>_cuenta_banco" name="x<?php echo $egresos_list->lRowIndex ?>_cuenta_banco"<?php echo $egresos->cuenta_banco->EditAttributes() ?>>
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
if ($emptywrk) $egresos->cuenta_banco->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos->cuenta_banco->ViewAttributes() ?>><?php echo $egresos->cuenta_banco->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD || $egresos->RowType == EW_ROWTYPE_EDIT) { ?>
<?php
	if ($egresos->CurrentAction == "gridedit")
		$egresos_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $egresos_list->lRowIndex . "_key\" id=\"k" . $egresos_list->lRowIndex . "_key\" value=\"" . $egresos->id_pago->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($egresos->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $egresos->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $egresos->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $egresos->CopyUrl() ?>"><img src='images/copy.gif' alt='Copy' title='Copy' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($egresos->id_pago->CurrentValue) ?>" class="arenas" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($egresos_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($egresos->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($egresos->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($egresos->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
<?php
$egresos->total_rd->CurrentValue = $egresos->total_rd->Total;
$egresos->total_rd->ViewValue = $egresos->total_rd->CurrentValue;
$egresos->total_rd->CssStyle = "";
$egresos->total_rd->CssClass = "";
$egresos->total_rd->ViewCustomAttributes = "";
$egresos->total_rd->HrefValue = ""; // Clear href value
$egresos->total_us->CurrentValue = $egresos->total_us->Total;
$egresos->total_us->ViewValue = $egresos->total_us->CurrentValue;
$egresos->total_us->CssStyle = "";
$egresos->total_us->CssClass = "";
$egresos->total_us->ViewCustomAttributes = "";
$egresos->total_us->HrefValue = ""; // Clear href value
$egresos->total_euros->CurrentValue = $egresos->total_euros->Total;
$egresos->total_euros->ViewValue = $egresos->total_euros->CurrentValue;
$egresos->total_euros->CssStyle = "";
$egresos->total_euros->CssClass = "";
$egresos->total_euros->ViewCustomAttributes = "";
$egresos->total_euros->HrefValue = ""; // Clear href value
$egresos->Impuestos_pagados->CurrentValue = $egresos->Impuestos_pagados->Total;
$egresos->Impuestos_pagados->ViewValue = $egresos->Impuestos_pagados->CurrentValue;
$egresos->Impuestos_pagados->CssStyle = "";
$egresos->Impuestos_pagados->CssClass = "";
$egresos->Impuestos_pagados->ViewCustomAttributes = "";
$egresos->Impuestos_pagados->HrefValue = ""; // Clear href value
?>
<?php if ($egresos_list->lTotalRecs > 0) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
	<?php if ($egresos->id_pago->Visible) { // id_pago ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($egresos->estado->Visible) { // estado ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($egresos->total_rd->Visible) { // total_rd ?>
		<td>
		Total: 
<div<?php echo $egresos->total_rd->ViewAttributes() ?>><?php echo $egresos->total_rd->ViewValue ?></div>
		</td>
	<?php } ?>
	<?php if ($egresos->total_us->Visible) { // total_us ?>
		<td>
		Total: 
<div<?php echo $egresos->total_us->ViewAttributes() ?>><?php echo $egresos->total_us->ViewValue ?></div>
		</td>
	<?php } ?>
	<?php if ($egresos->total_euros->Visible) { // total_euros ?>
		<td>
		Total: 
<div<?php echo $egresos->total_euros->ViewAttributes() ?>><?php echo $egresos->total_euros->ViewValue ?></div>
		</td>
	<?php } ?>
	<?php if ($egresos->Impuestos_pagados->Visible) { // Impuestos_pagados ?>
		<td>
		Total: 
<div<?php echo $egresos->Impuestos_pagados->ViewAttributes() ?>><?php echo $egresos->Impuestos_pagados->ViewValue ?></div>
		</td>
	<?php } ?>
	<?php if ($egresos->Numero_Referencia->Visible) { // Numero_Referencia ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($egresos->tipo_comprobante->Visible) { // tipo_comprobante ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($egresos->Comprobante_fiscal->Visible) { // Comprobante_fiscal ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($egresos->Metodo_pago->Visible) { // Metodo_pago ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($egresos->proveedor->Visible) { // proveedor ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($egresos->fecha->Visible) { // fecha ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($egresos->tipo1->Visible) { // tipo1 ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($egresos->Empresa->Visible) { // Empresa ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($egresos->locacion->Visible) { // locacion ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($egresos->cuenta_banco->Visible) { // cuenta_banco ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
<?php if ($egresos->Export == "") { ?>
<?php if ($egresos->CurrentAction <> "gridadd" && $egresos->CurrentAction <> "gridedit") { ?>
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
foreach ($egresos_list->ListOptions->Items as $ListOption) {
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
<?php if ($egresos->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $egresos_list->lRowIndex ?>">
<?php } ?>
<?php if ($egresos->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $egresos_list->lRowIndex ?>">
<?php echo $egresos_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($egresos_list->lTotalRecs > 0) { ?>
<?php if ($egresos->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($egresos->CurrentAction <> "gridadd" && $egresos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($egresos_list->Pager)) $egresos_list->Pager = new cPrevNextPager($egresos_list->lStartRec, $egresos_list->lDisplayRecs, $egresos_list->lTotalRecs) ?>
<?php if ($egresos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($egresos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_list->PageUrl() ?>start=<?php echo $egresos_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($egresos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_list->PageUrl() ?>start=<?php echo $egresos_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $egresos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($egresos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_list->PageUrl() ?>start=<?php echo $egresos_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($egresos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_list->PageUrl() ?>start=<?php echo $egresos_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $egresos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $egresos_list->Pager->FromIndex ?> a <?php echo $egresos_list->Pager->ToIndex ?> de <?php echo $egresos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($egresos_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($egresos_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="egresos">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($egresos_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($egresos_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($egresos_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($egresos_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($egresos_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($egresos_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($egresos->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($egresos_list->lTotalRecs > 0) { ?>
<span class="arenas">
<?php if ($egresos->CurrentAction <> "gridadd" && $egresos->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $egresos->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<a href="<?php echo $egresos_list->PageUrl() ?>a=gridadd">Agregar en grid</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($egresos_list->lTotalRecs > 0) { ?>
<a href="<?php echo $egresos_list->PageUrl() ?>a=gridedit">Edición Múltiple</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($egresos_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fegresoslist)) alert('No se seleccionaron registros'); else {document.fegresoslist.action='egresosdelete.php';document.fegresoslist.encoding='application/x-www-form-urlencoded';document.fegresoslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($egresos->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (egresos_list.ValidateForm(document.fegresoslist)) document.fegresoslist.submit();return false;"><img src='images/insert.gif' alt='Insert' title='Insert' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($egresos->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (egresos_list.ValidateForm(document.fegresoslist)) document.fegresoslist.submit();return false;"><img src='images/update.gif' alt='Save' title='Save' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $egresos_list->PageUrl() ?>a=cancel"><img src='images/cancel.gif' alt='Cancel' title='Cancel' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($egresos->Export == "" && $egresos->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(egresos_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($egresos->Export == "") { ?>
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
class cegresos_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'egresos';

	// Page Object Name
	var $PageObjName = 'egresos_list';

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
	function cegresos_list() {
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
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'egresos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
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
	$egresos->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $egresos->Export; // Get export parameter, used in header
	$gsExportFile = $egresos->TableVar; // Get export file, used in header
	if ($egresos->Export == "print" || $egresos->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($egresos->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($egresos->Export == "word") {
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
		global $objForm, $gsSearchError, $Security, $egresos;
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
				$egresos->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($egresos->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($egresos->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to grid add mode
				if ($egresos->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$egresos->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($egresos->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Grid Insert
					if ($egresos->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd")
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
		if ($egresos->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $egresos->getRecordsPerPage(); // Restore from Session
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
		$egresos->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$egresos->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$egresos->setStartRecordNumber($this->lStartRec);
		} else {
			$this->RestoreSearchParms();
		}

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->sDbMasterFilter = $egresos->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $egresos->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($egresos->getMasterFilter() <> "" && $egresos->getCurrentMasterTable() == "proveedores") {
			global $proveedores;
			$rsmaster = $proveedores->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$egresos->setMasterFilter(""); // Clear master filter
				$egresos->setDetailFilter(""); // Clear detail filter
				$this->setMessage("No se encontraron registros"); // Set no record found
				$this->Page_Terminate($egresos->getReturnUrl()); // Return to caller
			} else {
				$proveedores->LoadListRowValues($rsmaster);
				$proveedores->RowType = EW_ROWTYPE_MASTER; // Master row
				$proveedores->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Load master record
		if ($egresos->getMasterFilter() <> "" && $egresos->getCurrentMasterTable() == "locaciones") {
			global $locaciones;
			$rsmaster = $locaciones->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$egresos->setMasterFilter(""); // Clear master filter
				$egresos->setDetailFilter(""); // Clear detail filter
				$this->setMessage("No se encontraron registros"); // Set no record found
				$this->Page_Terminate($egresos->getReturnUrl()); // Return to caller
			} else {
				$locaciones->LoadListRowValues($rsmaster);
				$locaciones->RowType = EW_ROWTYPE_MASTER; // Master row
				$locaciones->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in Session
		$egresos->setSessionWhere($sFilter);
		$egresos->CurrentFilter = "";

		// Export data only
		if (in_array($egresos->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $egresos;
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
			$egresos->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$egresos->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $egresos;
		$egresos->CurrentAction = ""; // Clear action
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
		global $conn, $objForm, $gsFormError, $egresos;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$egresos->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $egresos->SQL();
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
					$egresos->SendEmail = FALSE; // Do not send email on update success
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
			$egresos->EventCancelled = TRUE; // Set event cancelled
			$egresos->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $egresos;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $egresos->KeyFilter();
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
		global $egresos;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$egresos->id_pago->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($egresos->id_pago->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Grid Insert
	// Peform insert to grid
	function GridInsert() {
		global $conn, $objForm, $gsFormError, $egresos;
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
				$egresos->SendEmail = FALSE; // Do not send email on insert success

				// Validate Form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow(); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $egresos->id_pago->CurrentValue;

					// Add filter for this record
					$sFilter = $egresos->KeyFilter();
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
			$egresos->CurrentFilter = $sWrkFilter;
			$sSql = $egresos->SQL();
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
			$egresos->EventCancelled = TRUE; // Set event cancelled
			$egresos->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
	}

	// Check if empty row
	function EmptyRow() {
		global $egresos;
		if ($egresos->estado->CurrentValue <> $egresos->estado->OldValue)
			return FALSE;
		if ($egresos->total_rd->CurrentValue <> $egresos->total_rd->OldValue)
			return FALSE;
		if ($egresos->total_us->CurrentValue <> $egresos->total_us->OldValue)
			return FALSE;
		if ($egresos->total_euros->CurrentValue <> $egresos->total_euros->OldValue)
			return FALSE;
		if ($egresos->Impuestos_pagados->CurrentValue <> $egresos->Impuestos_pagados->OldValue)
			return FALSE;
		if ($egresos->Numero_Referencia->CurrentValue <> $egresos->Numero_Referencia->OldValue)
			return FALSE;
		if ($egresos->tipo_comprobante->CurrentValue <> $egresos->tipo_comprobante->OldValue)
			return FALSE;
		if ($egresos->Comprobante_fiscal->CurrentValue <> $egresos->Comprobante_fiscal->OldValue)
			return FALSE;
		if ($egresos->Metodo_pago->CurrentValue <> $egresos->Metodo_pago->OldValue)
			return FALSE;
		if ($egresos->proveedor->CurrentValue <> $egresos->proveedor->OldValue)
			return FALSE;
		if ($egresos->fecha->CurrentValue <> $egresos->fecha->OldValue)
			return FALSE;
		if ($egresos->tipo1->CurrentValue <> $egresos->tipo1->OldValue)
			return FALSE;
		if ($egresos->Empresa->CurrentValue <> $egresos->Empresa->OldValue)
			return FALSE;
		if ($egresos->locacion->CurrentValue <> $egresos->locacion->OldValue)
			return FALSE;
		if ($egresos->cuenta_banco->CurrentValue <> $egresos->cuenta_banco->OldValue)
			return FALSE;
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $egresos;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($egresos->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($egresos->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($egresos->id_pago->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $egresos;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $egresos->id_pago, FALSE); // Field id_pago
		$this->BuildSearchSql($sWhere, $egresos->estado, FALSE); // Field estado
		$this->BuildSearchSql($sWhere, $egresos->total_rd, FALSE); // Field total_rd
		$this->BuildSearchSql($sWhere, $egresos->total_us, FALSE); // Field total_us
		$this->BuildSearchSql($sWhere, $egresos->total_euros, FALSE); // Field total_euros
		$this->BuildSearchSql($sWhere, $egresos->Impuestos_pagados, FALSE); // Field Impuestos_pagados
		$this->BuildSearchSql($sWhere, $egresos->Numero_Referencia, FALSE); // Field Numero_Referencia
		$this->BuildSearchSql($sWhere, $egresos->tipo_comprobante, FALSE); // Field tipo_comprobante
		$this->BuildSearchSql($sWhere, $egresos->Comprobante_fiscal, FALSE); // Field Comprobante_fiscal
		$this->BuildSearchSql($sWhere, $egresos->Metodo_pago, FALSE); // Field Metodo_pago
		$this->BuildSearchSql($sWhere, $egresos->proveedor, FALSE); // Field proveedor
		$this->BuildSearchSql($sWhere, $egresos->fecha, FALSE); // Field fecha
		$this->BuildSearchSql($sWhere, $egresos->tipo1, FALSE); // Field tipo1
		$this->BuildSearchSql($sWhere, $egresos->notas, FALSE); // Field notas
		$this->BuildSearchSql($sWhere, $egresos->Empresa, FALSE); // Field Empresa
		$this->BuildSearchSql($sWhere, $egresos->locacion, TRUE); // Field locacion
		$this->BuildSearchSql($sWhere, $egresos->cuenta_banco, FALSE); // Field cuenta_banco

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($egresos->id_pago); // Field id_pago
			$this->SetSearchParm($egresos->estado); // Field estado
			$this->SetSearchParm($egresos->total_rd); // Field total_rd
			$this->SetSearchParm($egresos->total_us); // Field total_us
			$this->SetSearchParm($egresos->total_euros); // Field total_euros
			$this->SetSearchParm($egresos->Impuestos_pagados); // Field Impuestos_pagados
			$this->SetSearchParm($egresos->Numero_Referencia); // Field Numero_Referencia
			$this->SetSearchParm($egresos->tipo_comprobante); // Field tipo_comprobante
			$this->SetSearchParm($egresos->Comprobante_fiscal); // Field Comprobante_fiscal
			$this->SetSearchParm($egresos->Metodo_pago); // Field Metodo_pago
			$this->SetSearchParm($egresos->proveedor); // Field proveedor
			$this->SetSearchParm($egresos->fecha); // Field fecha
			$this->SetSearchParm($egresos->tipo1); // Field tipo1
			$this->SetSearchParm($egresos->notas); // Field notas
			$this->SetSearchParm($egresos->Empresa); // Field Empresa
			$this->SetSearchParm($egresos->locacion); // Field locacion
			$this->SetSearchParm($egresos->cuenta_banco); // Field cuenta_banco
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
		global $egresos;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = @$_GET["x_$FldParm"];
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = @$_GET["y_$FldParm"];
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$egresos->setAdvancedSearch("x_$FldParm", $FldVal);
		$egresos->setAdvancedSearch("z_$FldParm", @$_GET["z_$FldParm"]);
		$egresos->setAdvancedSearch("v_$FldParm", @$_GET["v_$FldParm"]);
		$egresos->setAdvancedSearch("y_$FldParm", $FldVal2);
		$egresos->setAdvancedSearch("w_$FldParm", @$_GET["w_$FldParm"]);
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
		global $egresos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		if (is_numeric($sKeyword)) $sql .= "id_pago = " . $sKeyword . " OR ";
		$sql .= $egresos->estado->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (is_numeric($sKeyword)) $sql .= "total_rd = " . $sKeyword . " OR ";
		if (is_numeric($sKeyword)) $sql .= "total_us = " . $sKeyword . " OR ";
		if (is_numeric($sKeyword)) $sql .= "Impuestos_pagados = " . $sKeyword . " OR ";
		$sql .= $egresos->Numero_Referencia->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $egresos->tipo_comprobante->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $egresos->Comprobante_fiscal->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $egresos->Metodo_pago->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $egresos->proveedor->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $egresos->tipo1->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $egresos->notas->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $egresos->Empresa->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $egresos->locacion->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $egresos->cuenta_banco->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $egresos;
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
			$egresos->setBasicSearchKeyword($sSearchKeyword);
			$egresos->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $egresos;
		$this->sSrchWhere = "";
		$egresos->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $egresos;
		$egresos->setBasicSearchKeyword("");
		$egresos->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $egresos;
		$egresos->setAdvancedSearch("x_id_pago", "");
		$egresos->setAdvancedSearch("x_estado", "");
		$egresos->setAdvancedSearch("x_total_rd", "");
		$egresos->setAdvancedSearch("x_total_us", "");
		$egresos->setAdvancedSearch("x_total_euros", "");
		$egresos->setAdvancedSearch("x_Impuestos_pagados", "");
		$egresos->setAdvancedSearch("x_Numero_Referencia", "");
		$egresos->setAdvancedSearch("x_tipo_comprobante", "");
		$egresos->setAdvancedSearch("x_Comprobante_fiscal", "");
		$egresos->setAdvancedSearch("x_Metodo_pago", "");
		$egresos->setAdvancedSearch("x_proveedor", "");
		$egresos->setAdvancedSearch("x_fecha", "");
		$egresos->setAdvancedSearch("y_fecha", "");
		$egresos->setAdvancedSearch("x_tipo1", "");
		$egresos->setAdvancedSearch("x_notas", "");
		$egresos->setAdvancedSearch("x_Empresa", "");
		$egresos->setAdvancedSearch("x_locacion", "");
		$egresos->setAdvancedSearch("x_cuenta_banco", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $egresos;
		$this->sSrchWhere = $egresos->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
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

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $egresos;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$egresos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$egresos->CurrentOrderType = @$_GET["ordertype"];
			$egresos->UpdateSort($egresos->id_pago); // Field 
			$egresos->UpdateSort($egresos->estado); // Field 
			$egresos->UpdateSort($egresos->total_rd); // Field 
			$egresos->UpdateSort($egresos->total_us); // Field 
			$egresos->UpdateSort($egresos->total_euros); // Field 
			$egresos->UpdateSort($egresos->Impuestos_pagados); // Field 
			$egresos->UpdateSort($egresos->Numero_Referencia); // Field 
			$egresos->UpdateSort($egresos->tipo_comprobante); // Field 
			$egresos->UpdateSort($egresos->Comprobante_fiscal); // Field 
			$egresos->UpdateSort($egresos->Metodo_pago); // Field 
			$egresos->UpdateSort($egresos->proveedor); // Field 
			$egresos->UpdateSort($egresos->fecha); // Field 
			$egresos->UpdateSort($egresos->tipo1); // Field 
			$egresos->UpdateSort($egresos->Empresa); // Field 
			$egresos->UpdateSort($egresos->locacion); // Field 
			$egresos->UpdateSort($egresos->cuenta_banco); // Field 
			$egresos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $egresos;
		$sOrderBy = $egresos->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($egresos->SqlOrderBy() <> "") {
				$sOrderBy = $egresos->SqlOrderBy();
				$egresos->setSessionOrderBy($sOrderBy);
				$egresos->id_pago->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $egresos;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$egresos->getCurrentMasterTable = ""; // Clear master table
				$egresos->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$egresos->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$egresos->proveedor->setSessionValue("");
				$egresos->locacion->setSessionValue("");
			}

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$egresos->setSessionOrderBy($sOrderBy);
				$egresos->id_pago->setSort("");
				$egresos->estado->setSort("");
				$egresos->total_rd->setSort("");
				$egresos->total_us->setSort("");
				$egresos->total_euros->setSort("");
				$egresos->Impuestos_pagados->setSort("");
				$egresos->Numero_Referencia->setSort("");
				$egresos->tipo_comprobante->setSort("");
				$egresos->Comprobante_fiscal->setSort("");
				$egresos->Metodo_pago->setSort("");
				$egresos->proveedor->setSort("");
				$egresos->fecha->setSort("");
				$egresos->tipo1->setSort("");
				$egresos->Empresa->setSort("");
				$egresos->locacion->setSort("");
				$egresos->cuenta_banco->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$egresos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $egresos;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$egresos->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$egresos->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $egresos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$egresos->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$egresos->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$egresos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $egresos;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $egresos;

		// Load search values
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $egresos;
		$egresos->id_pago->setFormValue($objForm->GetValue("x_id_pago"));
		$egresos->id_pago->OldValue = $objForm->GetValue("o_id_pago");
		$egresos->estado->setFormValue($objForm->GetValue("x_estado"));
		$egresos->estado->OldValue = $objForm->GetValue("o_estado");
		$egresos->total_rd->setFormValue($objForm->GetValue("x_total_rd"));
		$egresos->total_rd->OldValue = $objForm->GetValue("o_total_rd");
		$egresos->total_us->setFormValue($objForm->GetValue("x_total_us"));
		$egresos->total_us->OldValue = $objForm->GetValue("o_total_us");
		$egresos->total_euros->setFormValue($objForm->GetValue("x_total_euros"));
		$egresos->total_euros->OldValue = $objForm->GetValue("o_total_euros");
		$egresos->Impuestos_pagados->setFormValue($objForm->GetValue("x_Impuestos_pagados"));
		$egresos->Impuestos_pagados->OldValue = $objForm->GetValue("o_Impuestos_pagados");
		$egresos->Numero_Referencia->setFormValue($objForm->GetValue("x_Numero_Referencia"));
		$egresos->Numero_Referencia->OldValue = $objForm->GetValue("o_Numero_Referencia");
		$egresos->tipo_comprobante->setFormValue($objForm->GetValue("x_tipo_comprobante"));
		$egresos->tipo_comprobante->OldValue = $objForm->GetValue("o_tipo_comprobante");
		$egresos->Comprobante_fiscal->setFormValue($objForm->GetValue("x_Comprobante_fiscal"));
		$egresos->Comprobante_fiscal->OldValue = $objForm->GetValue("o_Comprobante_fiscal");
		$egresos->Metodo_pago->setFormValue($objForm->GetValue("x_Metodo_pago"));
		$egresos->Metodo_pago->OldValue = $objForm->GetValue("o_Metodo_pago");
		$egresos->proveedor->setFormValue($objForm->GetValue("x_proveedor"));
		$egresos->proveedor->OldValue = $objForm->GetValue("o_proveedor");
		$egresos->fecha->setFormValue($objForm->GetValue("x_fecha"));
		$egresos->fecha->CurrentValue = ew_UnFormatDateTime($egresos->fecha->CurrentValue, 7);
		$egresos->fecha->OldValue = $objForm->GetValue("o_fecha");
		$egresos->tipo1->setFormValue($objForm->GetValue("x_tipo1"));
		$egresos->tipo1->OldValue = $objForm->GetValue("o_tipo1");
		$egresos->Empresa->setFormValue($objForm->GetValue("x_Empresa"));
		$egresos->Empresa->OldValue = $objForm->GetValue("o_Empresa");
		$egresos->locacion->setFormValue($objForm->GetValue("x_locacion"));
		$egresos->locacion->OldValue = $objForm->GetValue("o_locacion");
		$egresos->cuenta_banco->setFormValue($objForm->GetValue("x_cuenta_banco"));
		$egresos->cuenta_banco->OldValue = $objForm->GetValue("o_cuenta_banco");
	}

	// Restore form values
	function RestoreFormValues() {
		global $egresos;
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
		$egresos->Empresa->CurrentValue = $egresos->Empresa->FormValue;
		$egresos->locacion->CurrentValue = $egresos->locacion->FormValue;
		$egresos->cuenta_banco->CurrentValue = $egresos->cuenta_banco->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $egresos;

		// Call Recordset Selecting event
		$egresos->Recordset_Selecting($egresos->CurrentFilter);

		// Load list page SQL
		$sSql = $egresos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$egresos->Recordset_Selected($rs);
		return $rs;
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

			// Empresa
			$egresos->Empresa->HrefValue = "";

			// locacion
			$egresos->locacion->HrefValue = "";

			// cuenta_banco
			$egresos->cuenta_banco->HrefValue = "";
		} elseif ($egresos->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_pago
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
				$egresos->proveedor->OldValue = $egresos->proveedor->CurrentValue;
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
				$egresos->locacion->OldValue = $egresos->locacion->CurrentValue;
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
				$egresos->proveedor->OldValue = $egresos->proveedor->CurrentValue;
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
				$egresos->locacion->OldValue = $egresos->locacion->CurrentValue;
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

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $egresos;

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

	// Add record
	function AddRow() {
		global $conn, $Security, $egresos;
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

		// Field Empresa
		$egresos->Empresa->SetDbValueDef($egresos->Empresa->CurrentValue, "");
		$rsnew['Empresa'] =& $egresos->Empresa->DbValue;

		// Field locacion
		$egresos->locacion->SetDbValueDef($egresos->locacion->CurrentValue, "");
		$rsnew['locacion'] =& $egresos->locacion->DbValue;

		// Field cuenta_banco
		$egresos->cuenta_banco->SetDbValueDef($egresos->cuenta_banco->CurrentValue, "");
		$rsnew['cuenta_banco'] =& $egresos->cuenta_banco->DbValue;

		// Call Row Inserting event
		$bInsertRow = $egresos->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($egresos->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($egresos->CancelMessage <> "") {
				$this->setMessage($egresos->CancelMessage);
				$egresos->CancelMessage = "";
			} else {
				$this->setMessage("Insertar cancelado");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$egresos->id_pago->setDbValue($conn->Insert_ID());
			$rsnew['id_pago'] =& $egresos->id_pago->DbValue;

			// Call Row Inserted event
			$egresos->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $egresos;
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $egresos;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($egresos->ExportAll) {
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
		if ($egresos->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($egresos->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $egresos->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id_pago', $egresos->Export);
				ew_ExportAddValue($sExportStr, 'estado', $egresos->Export);
				ew_ExportAddValue($sExportStr, 'total_rd', $egresos->Export);
				ew_ExportAddValue($sExportStr, 'total_us', $egresos->Export);
				ew_ExportAddValue($sExportStr, 'total_euros', $egresos->Export);
				ew_ExportAddValue($sExportStr, 'Impuestos_pagados', $egresos->Export);
				ew_ExportAddValue($sExportStr, 'Numero_Referencia', $egresos->Export);
				ew_ExportAddValue($sExportStr, 'tipo_comprobante', $egresos->Export);
				ew_ExportAddValue($sExportStr, 'Comprobante_fiscal', $egresos->Export);
				ew_ExportAddValue($sExportStr, 'Metodo_pago', $egresos->Export);
				ew_ExportAddValue($sExportStr, 'proveedor', $egresos->Export);
				ew_ExportAddValue($sExportStr, 'fecha', $egresos->Export);
				ew_ExportAddValue($sExportStr, 'tipo1', $egresos->Export);
				ew_ExportAddValue($sExportStr, 'Empresa', $egresos->Export);
				ew_ExportAddValue($sExportStr, 'locacion', $egresos->Export);
				ew_ExportAddValue($sExportStr, 'cuenta_banco', $egresos->Export);
				echo ew_ExportLine($sExportStr, $egresos->Export);
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
				$egresos->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($egresos->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id_pago', $egresos->id_pago->CurrentValue);
					$XmlDoc->AddField('estado', $egresos->estado->CurrentValue);
					$XmlDoc->AddField('total_rd', $egresos->total_rd->CurrentValue);
					$XmlDoc->AddField('total_us', $egresos->total_us->CurrentValue);
					$XmlDoc->AddField('total_euros', $egresos->total_euros->CurrentValue);
					$XmlDoc->AddField('Impuestos_pagados', $egresos->Impuestos_pagados->CurrentValue);
					$XmlDoc->AddField('Numero_Referencia', $egresos->Numero_Referencia->CurrentValue);
					$XmlDoc->AddField('tipo_comprobante', $egresos->tipo_comprobante->CurrentValue);
					$XmlDoc->AddField('Comprobante_fiscal', $egresos->Comprobante_fiscal->CurrentValue);
					$XmlDoc->AddField('Metodo_pago', $egresos->Metodo_pago->CurrentValue);
					$XmlDoc->AddField('proveedor', $egresos->proveedor->CurrentValue);
					$XmlDoc->AddField('fecha', $egresos->fecha->CurrentValue);
					$XmlDoc->AddField('tipo1', $egresos->tipo1->CurrentValue);
					$XmlDoc->AddField('Empresa', $egresos->Empresa->CurrentValue);
					$XmlDoc->AddField('locacion', $egresos->locacion->CurrentValue);
					$XmlDoc->AddField('cuenta_banco', $egresos->cuenta_banco->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $egresos->Export <> "csv") { // Vertical format
						echo ew_ExportField('id_pago', $egresos->id_pago->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportField('estado', $egresos->estado->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportField('total_rd', $egresos->total_rd->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportField('total_us', $egresos->total_us->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportField('total_euros', $egresos->total_euros->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportField('Impuestos_pagados', $egresos->Impuestos_pagados->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportField('Numero_Referencia', $egresos->Numero_Referencia->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportField('tipo_comprobante', $egresos->tipo_comprobante->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportField('Comprobante_fiscal', $egresos->Comprobante_fiscal->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportField('Metodo_pago', $egresos->Metodo_pago->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportField('proveedor', $egresos->proveedor->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportField('fecha', $egresos->fecha->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportField('tipo1', $egresos->tipo1->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportField('Empresa', $egresos->Empresa->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportField('locacion', $egresos->locacion->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportField('cuenta_banco', $egresos->cuenta_banco->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $egresos->id_pago->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						ew_ExportAddValue($sExportStr, $egresos->estado->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						ew_ExportAddValue($sExportStr, $egresos->total_rd->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						ew_ExportAddValue($sExportStr, $egresos->total_us->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						ew_ExportAddValue($sExportStr, $egresos->total_euros->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						ew_ExportAddValue($sExportStr, $egresos->Impuestos_pagados->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						ew_ExportAddValue($sExportStr, $egresos->Numero_Referencia->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						ew_ExportAddValue($sExportStr, $egresos->tipo_comprobante->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						ew_ExportAddValue($sExportStr, $egresos->Comprobante_fiscal->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						ew_ExportAddValue($sExportStr, $egresos->Metodo_pago->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						ew_ExportAddValue($sExportStr, $egresos->proveedor->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						ew_ExportAddValue($sExportStr, $egresos->fecha->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						ew_ExportAddValue($sExportStr, $egresos->tipo1->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						ew_ExportAddValue($sExportStr, $egresos->Empresa->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						ew_ExportAddValue($sExportStr, $egresos->locacion->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						ew_ExportAddValue($sExportStr, $egresos->cuenta_banco->ExportValue($egresos->Export, $egresos->ExportOriginalValue), $egresos->Export);
						echo ew_ExportLine($sExportStr, $egresos->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($egresos->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($egresos->Export);
		}
	}

	// Set up Master Detail based on querystring parameter
	function SetUpMasterDetail() {
		global $egresos;
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
				$this->sDbMasterFilter = $egresos->SqlMasterFilter_proveedores();
				$this->sDbDetailFilter = $egresos->SqlDetailFilter_proveedores();
				if (@$_GET["id_proveedor"] <> "") {
					$GLOBALS["proveedores"]->id_proveedor->setQueryStringValue($_GET["id_proveedor"]);
					$egresos->proveedor->setQueryStringValue($GLOBALS["proveedores"]->id_proveedor->QueryStringValue);
					$egresos->proveedor->setSessionValue($egresos->proveedor->QueryStringValue);
					if (!is_numeric($GLOBALS["proveedores"]->id_proveedor->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id_proveedor@", ew_AdjustSql($GLOBALS["proveedores"]->id_proveedor->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@proveedor@", ew_AdjustSql($GLOBALS["proveedores"]->id_proveedor->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
			if ($sMasterTblVar == "locaciones") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $egresos->SqlMasterFilter_locaciones();
				$this->sDbDetailFilter = $egresos->SqlDetailFilter_locaciones();
				if (@$_GET["id_locacion"] <> "") {
					$GLOBALS["locaciones"]->id_locacion->setQueryStringValue($_GET["id_locacion"]);
					$egresos->locacion->setQueryStringValue($GLOBALS["locaciones"]->id_locacion->QueryStringValue);
					$egresos->locacion->setSessionValue($egresos->locacion->QueryStringValue);
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
			$egresos->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$egresos->setStartRecordNumber($this->lStartRec);
			$egresos->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$egresos->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master session values
			if ($sMasterTblVar <> "proveedores") {
				if ($egresos->proveedor->QueryStringValue == "") $egresos->proveedor->setSessionValue("");
			}
			if ($sMasterTblVar <> "locaciones") {
				if ($egresos->locacion->QueryStringValue == "") $egresos->locacion->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $egresos->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $egresos->getDetailFilter(); // Restore detail filter
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
