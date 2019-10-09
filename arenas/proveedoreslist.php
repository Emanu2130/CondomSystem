<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "proveedoresinfo.php" ?>
<?php include "usuariosinfo.php" ?>
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
$proveedores_list = new cproveedores_list();
$Page =& $proveedores_list;

// Page init processing
$proveedores_list->Page_Init();

// Page main processing
$proveedores_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($proveedores->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var proveedores_list = new ew_Page("proveedores_list");

// page properties
proveedores_list.PageID = "list"; // page ID
var EW_PAGE_ID = proveedores_list.PageID; // for backward compatibility

// extend page with ValidateForm function
proveedores_list.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Nombre");
		elm = fobj.elements["x" + infix + "_rnc_cedula"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Rnc /cedula");
		elm = fobj.elements["x" + infix + "_telefonos"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Telefonos");
		elm = fobj.elements["x" + infix + "_Empresa"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Empresa");

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
proveedores_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "nombre")) return false;
	if (ew_ValueChanged(fobj, infix, "rnc_cedula")) return false;
	if (ew_ValueChanged(fobj, infix, "telefonos")) return false;
	if (ew_ValueChanged(fobj, infix, "Empresa")) return false;
	return true;
}

// extend page with Form_CustomValidate function
proveedores_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
proveedores_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
proveedores_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
proveedores_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($proveedores->Export == "") { ?>
<?php } ?>
<?php
if ($proveedores->CurrentAction == "gridadd")
	$proveedores->CurrentFilter = "0=1";
if ($proveedores->CurrentAction == "gridadd") {
	$proveedores_list->lStartRec = 1;
	if ($proveedores_list->lDisplayRecs <= 0)
		$proveedores_list->lDisplayRecs = 20;
	$proveedores_list->lTotalRecs = $proveedores_list->lDisplayRecs;
	$proveedores_list->lStopRec = $proveedores_list->lDisplayRecs;
} else {
	$bSelectLimit = ($proveedores->Export == "" && $proveedores->SelectLimit);
	if (!$bSelectLimit)
		$rs = $proveedores_list->LoadRecordset();
	$proveedores_list->lTotalRecs = ($bSelectLimit) ? $proveedores->SelectRecordCount() : $rs->RecordCount();
	$proveedores_list->lStartRec = 1;
	if ($proveedores_list->lDisplayRecs <= 0) // Display all records
		$proveedores_list->lDisplayRecs = $proveedores_list->lTotalRecs;
	if (!($proveedores->ExportAll && $proveedores->Export <> ""))
		$proveedores_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $proveedores_list->LoadRecordset($proveedores_list->lStartRec-1, $proveedores_list->lDisplayRecs);
}
?>
<p><span class="arenas" style="white-space: nowrap;">Modulo: Proveedores
<?php if ($proveedores->Export == "" && $proveedores->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $proveedores_list->PageUrl() ?>export=print"><img src='images/print.gif' alt='Printer Friendly' title='Printer Friendly' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $proveedores_list->PageUrl() ?>export=excel"><img src='images/exportxls.gif' alt='Export to Excel' title='Export to Excel' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $proveedores_list->PageUrl() ?>export=word"><img src='images/exportdoc.gif' alt='Export to Word' title='Export to Word' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($proveedores->Export == "" && $proveedores->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(proveedores_list);" style="text-decoration: none;"><img id="proveedores_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="arenas">&nbsp;Buscar</span><br>
<div id="proveedores_list_SearchPanel">
<form name="fproveedoreslistsrch" id="fproveedoreslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="proveedores">
<table class="ewBasicSearch">
	<tr>
		<td><span class="arenas">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($proveedores->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Buscar (*)">&nbsp;
			<a href="<?php echo $proveedores_list->PageUrl() ?>cmd=reset">Mostrar todos</a>&nbsp;
			<a href="proveedoressrch.php">Consulta avanzada</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="arenas"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($proveedores->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Frase exacta</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($proveedores->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>Todas las palabras</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($proveedores->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Cualquier palabra</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $proveedores_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($proveedores->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($proveedores->CurrentAction <> "gridadd" && $proveedores->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($proveedores_list->Pager)) $proveedores_list->Pager = new cPrevNextPager($proveedores_list->lStartRec, $proveedores_list->lDisplayRecs, $proveedores_list->lTotalRecs) ?>
<?php if ($proveedores_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($proveedores_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_list->PageUrl() ?>start=<?php echo $proveedores_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($proveedores_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_list->PageUrl() ?>start=<?php echo $proveedores_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $proveedores_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($proveedores_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_list->PageUrl() ?>start=<?php echo $proveedores_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($proveedores_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_list->PageUrl() ?>start=<?php echo $proveedores_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $proveedores_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $proveedores_list->Pager->FromIndex ?> a <?php echo $proveedores_list->Pager->ToIndex ?> de <?php echo $proveedores_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($proveedores_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($proveedores_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="proveedores">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($proveedores_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($proveedores_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($proveedores_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($proveedores_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($proveedores_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($proveedores_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($proveedores->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="arenas">
<?php if ($proveedores->CurrentAction <> "gridadd" && $proveedores->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $proveedores->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<a href="<?php echo $proveedores_list->PageUrl() ?>a=gridadd">Agregar en grid</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($proveedores_list->lTotalRecs > 0) { ?>
<a href="<?php echo $proveedores_list->PageUrl() ?>a=gridedit">Edición Múltiple</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($proveedores_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fproveedoreslist)) alert('No se seleccionaron registros'); else {document.fproveedoreslist.action='proveedoresdelete.php';document.fproveedoreslist.encoding='application/x-www-form-urlencoded';document.fproveedoreslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($proveedores->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (proveedores_list.ValidateForm(document.fproveedoreslist)) document.fproveedoreslist.submit();return false;"><img src='images/insert.gif' alt='Insert' title='Insert' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($proveedores->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (proveedores_list.ValidateForm(document.fproveedoreslist)) document.fproveedoreslist.submit();return false;"><img src='images/update.gif' alt='Save' title='Save' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $proveedores_list->PageUrl() ?>a=cancel"><img src='images/cancel.gif' alt='Cancel' title='Cancel' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fproveedoreslist" id="fproveedoreslist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="proveedores">
<?php if ($proveedores_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$proveedores_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$proveedores_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$proveedores_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$proveedores_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$proveedores_list->lOptionCnt++; // Detail
}
if ($Security->IsLoggedIn()) {
	$proveedores_list->lOptionCnt++; // Detail
}
if ($Security->IsLoggedIn()) {
	$proveedores_list->lOptionCnt++; // Multi-select
}
	$proveedores_list->lOptionCnt += count($proveedores_list->ListOptions->Items); // Custom list options
?>
<?php echo $proveedores->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($proveedores->id_proveedor->Visible) { // id_proveedor ?>
	<?php if ($proveedores->SortUrl($proveedores->id_proveedor) == "") { ?>
		<td>Id Proveedor</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $proveedores->SortUrl($proveedores->id_proveedor) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id Proveedor</td><td style="width: 10px;"><?php if ($proveedores->id_proveedor->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($proveedores->id_proveedor->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($proveedores->nombre->Visible) { // nombre ?>
	<?php if ($proveedores->SortUrl($proveedores->nombre) == "") { ?>
		<td>Nombre</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $proveedores->SortUrl($proveedores->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nombre&nbsp;(*)</td><td style="width: 10px;"><?php if ($proveedores->nombre->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($proveedores->nombre->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($proveedores->rnc_cedula->Visible) { // rnc_cedula ?>
	<?php if ($proveedores->SortUrl($proveedores->rnc_cedula) == "") { ?>
		<td>Rnc /cedula</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $proveedores->SortUrl($proveedores->rnc_cedula) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Rnc /cedula&nbsp;(*)</td><td style="width: 10px;"><?php if ($proveedores->rnc_cedula->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($proveedores->rnc_cedula->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($proveedores->telefonos->Visible) { // telefonos ?>
	<?php if ($proveedores->SortUrl($proveedores->telefonos) == "") { ?>
		<td>Telefonos</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $proveedores->SortUrl($proveedores->telefonos) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Telefonos&nbsp;(*)</td><td style="width: 10px;"><?php if ($proveedores->telefonos->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($proveedores->telefonos->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($proveedores->Empresa->Visible) { // Empresa ?>
	<?php if ($proveedores->SortUrl($proveedores->Empresa) == "") { ?>
		<td>Empresa</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $proveedores->SortUrl($proveedores->Empresa) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Empresa</td><td style="width: 10px;"><?php if ($proveedores->Empresa->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($proveedores->Empresa->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($proveedores->Export == "") { ?>
<?php if ($proveedores->CurrentAction <> "gridadd" && $proveedores->CurrentAction <> "gridedit") { ?>
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
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="arenas" onclick="proveedores_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($proveedores_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<?php
if ($proveedores->ExportAll && $proveedores->Export <> "") {
	$proveedores_list->lStopRec = $proveedores_list->lTotalRecs;
} else {
	$proveedores_list->lStopRec = $proveedores_list->lStartRec + $proveedores_list->lDisplayRecs - 1; // Set the last record to display
}
$proveedores_list->lRecCount = $proveedores_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$proveedores->SelectLimit && $proveedores_list->lStartRec > 1)
		$rs->Move($proveedores_list->lStartRec - 1);
}
$proveedores_list->lRowCnt = 0;
if ($proveedores->CurrentAction == "gridadd")
	$proveedores_list->lRowIndex = 0;
if ($proveedores->CurrentAction == "gridedit")
	$proveedores_list->lRowIndex = 0;
while (($proveedores->CurrentAction == "gridadd" || !$rs->EOF) &&
	$proveedores_list->lRecCount < $proveedores_list->lStopRec) {
	$proveedores_list->lRecCount++;
	if (intval($proveedores_list->lRecCount) >= intval($proveedores_list->lStartRec)) {
		$proveedores_list->lRowCnt++;
		if ($proveedores->CurrentAction == "gridadd" || $proveedores->CurrentAction == "gridedit")
			$proveedores_list->lRowIndex++;

	// Init row class and style
	$proveedores->CssClass = "";
	$proveedores->CssStyle = "";
	$proveedores->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($proveedores->CurrentAction == "gridadd") {
		$proveedores_list->LoadDefaultValues(); // Load default values
	} else {
		$proveedores_list->LoadRowValues($rs); // Load row values
	}
	$proveedores->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($proveedores->CurrentAction == "gridadd") // Grid add
		$proveedores->RowType = EW_ROWTYPE_ADD; // Render add
	if ($proveedores->CurrentAction == "gridadd" && $proveedores->EventCancelled) // Insert failed
		$proveedores_list->RestoreCurrentRowFormValues($proveedores_list->lRowIndex); // Restore form values
	if ($proveedores->CurrentAction == "gridedit") // Grid edit
		$proveedores->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($proveedores->RowType == EW_ROWTYPE_EDIT && $proveedores->EventCancelled) { // Update failed
		if ($proveedores->CurrentAction == "gridedit")
			$proveedores_list->RestoreCurrentRowFormValues($proveedores_list->lRowIndex); // Restore form values
	}
	if ($proveedores->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$proveedores_list->lEditRowCnt++;
		$proveedores->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($proveedores->RowType == EW_ROWTYPE_ADD || $proveedores->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$proveedores->CssClass = "ewTableEditRow";

	// Render row
	$proveedores_list->RenderRow();
?>
	<tr<?php echo $proveedores->RowAttributes() ?>>
	<?php if ($proveedores->id_proveedor->Visible) { // id_proveedor ?>
		<td<?php echo $proveedores->id_proveedor->CellAttributes() ?>>
<?php if ($proveedores->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $proveedores_list->lRowIndex ?>_id_proveedor" id="o<?php echo $proveedores_list->lRowIndex ?>_id_proveedor" value="<?php echo ew_HtmlEncode($proveedores->id_proveedor->OldValue) ?>">
<?php } ?>
<?php if ($proveedores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $proveedores->id_proveedor->ViewAttributes() ?>><?php echo $proveedores->id_proveedor->EditValue ?></div><input type="hidden" name="x<?php echo $proveedores_list->lRowIndex ?>_id_proveedor" id="x<?php echo $proveedores_list->lRowIndex ?>_id_proveedor" value="<?php echo ew_HtmlEncode($proveedores->id_proveedor->CurrentValue) ?>">
<?php } ?>
<?php if ($proveedores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $proveedores->id_proveedor->ViewAttributes() ?>><?php echo $proveedores->id_proveedor->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($proveedores->nombre->Visible) { // nombre ?>
		<td<?php echo $proveedores->nombre->CellAttributes() ?>>
<?php if ($proveedores->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $proveedores_list->lRowIndex ?>_nombre" id="x<?php echo $proveedores_list->lRowIndex ?>_nombre" size="30" maxlength="255" value="<?php echo $proveedores->nombre->EditValue ?>"<?php echo $proveedores->nombre->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $proveedores_list->lRowIndex ?>_nombre" id="o<?php echo $proveedores_list->lRowIndex ?>_nombre" value="<?php echo ew_HtmlEncode($proveedores->nombre->OldValue) ?>">
<?php } ?>
<?php if ($proveedores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $proveedores_list->lRowIndex ?>_nombre" id="x<?php echo $proveedores_list->lRowIndex ?>_nombre" size="30" maxlength="255" value="<?php echo $proveedores->nombre->EditValue ?>"<?php echo $proveedores->nombre->EditAttributes() ?>>
<?php } ?>
<?php if ($proveedores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $proveedores->nombre->ViewAttributes() ?>><?php echo $proveedores->nombre->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($proveedores->rnc_cedula->Visible) { // rnc_cedula ?>
		<td<?php echo $proveedores->rnc_cedula->CellAttributes() ?>>
<?php if ($proveedores->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $proveedores_list->lRowIndex ?>_rnc_cedula" id="x<?php echo $proveedores_list->lRowIndex ?>_rnc_cedula" size="30" maxlength="255" value="<?php echo $proveedores->rnc_cedula->EditValue ?>"<?php echo $proveedores->rnc_cedula->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $proveedores_list->lRowIndex ?>_rnc_cedula" id="o<?php echo $proveedores_list->lRowIndex ?>_rnc_cedula" value="<?php echo ew_HtmlEncode($proveedores->rnc_cedula->OldValue) ?>">
<?php } ?>
<?php if ($proveedores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $proveedores_list->lRowIndex ?>_rnc_cedula" id="x<?php echo $proveedores_list->lRowIndex ?>_rnc_cedula" size="30" maxlength="255" value="<?php echo $proveedores->rnc_cedula->EditValue ?>"<?php echo $proveedores->rnc_cedula->EditAttributes() ?>>
<?php } ?>
<?php if ($proveedores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $proveedores->rnc_cedula->ViewAttributes() ?>><?php echo $proveedores->rnc_cedula->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($proveedores->telefonos->Visible) { // telefonos ?>
		<td<?php echo $proveedores->telefonos->CellAttributes() ?>>
<?php if ($proveedores->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $proveedores_list->lRowIndex ?>_telefonos" id="x<?php echo $proveedores_list->lRowIndex ?>_telefonos" size="30" maxlength="255" value="<?php echo $proveedores->telefonos->EditValue ?>"<?php echo $proveedores->telefonos->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $proveedores_list->lRowIndex ?>_telefonos" id="o<?php echo $proveedores_list->lRowIndex ?>_telefonos" value="<?php echo ew_HtmlEncode($proveedores->telefonos->OldValue) ?>">
<?php } ?>
<?php if ($proveedores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $proveedores_list->lRowIndex ?>_telefonos" id="x<?php echo $proveedores_list->lRowIndex ?>_telefonos" size="30" maxlength="255" value="<?php echo $proveedores->telefonos->EditValue ?>"<?php echo $proveedores->telefonos->EditAttributes() ?>>
<?php } ?>
<?php if ($proveedores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $proveedores->telefonos->ViewAttributes() ?>><?php echo $proveedores->telefonos->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($proveedores->Empresa->Visible) { // Empresa ?>
		<td<?php echo $proveedores->Empresa->CellAttributes() ?>>
<?php if ($proveedores->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $proveedores_list->lRowIndex ?>_Empresa" name="x<?php echo $proveedores_list->lRowIndex ?>_Empresa"<?php echo $proveedores->Empresa->EditAttributes() ?>>
<?php
if (is_array($proveedores->Empresa->EditValue)) {
	$arwrk = $proveedores->Empresa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($proveedores->Empresa->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if ($emptywrk) $proveedores->Empresa->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $proveedores_list->lRowIndex ?>_Empresa" id="o<?php echo $proveedores_list->lRowIndex ?>_Empresa" value="<?php echo ew_HtmlEncode($proveedores->Empresa->OldValue) ?>">
<?php } ?>
<?php if ($proveedores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $proveedores_list->lRowIndex ?>_Empresa" name="x<?php echo $proveedores_list->lRowIndex ?>_Empresa"<?php echo $proveedores->Empresa->EditAttributes() ?>>
<?php
if (is_array($proveedores->Empresa->EditValue)) {
	$arwrk = $proveedores->Empresa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($proveedores->Empresa->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if ($emptywrk) $proveedores->Empresa->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($proveedores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $proveedores->Empresa->ViewAttributes() ?>><?php echo $proveedores->Empresa->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($proveedores->RowType == EW_ROWTYPE_ADD || $proveedores->RowType == EW_ROWTYPE_EDIT) { ?>
<?php
	if ($proveedores->CurrentAction == "gridedit")
		$proveedores_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $proveedores_list->lRowIndex . "_key\" id=\"k" . $proveedores_list->lRowIndex . "_key\" value=\"" . $proveedores->id_proveedor->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($proveedores->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $proveedores->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $proveedores->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $proveedores->CopyUrl() ?>"><img src='images/copy.gif' alt='Copy' title='Copy' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="ingresoslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=proveedores&id_proveedor=<?php echo urlencode(strval($proveedores->id_proveedor->CurrentValue)) ?>">Ingresos</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="egresoslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=proveedores&id_proveedor=<?php echo urlencode(strval($proveedores->id_proveedor->CurrentValue)) ?>">Egresos</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($proveedores->id_proveedor->CurrentValue) ?>" class="arenas" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($proveedores_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($proveedores->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($proveedores->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($proveedores->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($proveedores->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $proveedores_list->lRowIndex ?>">
<?php } ?>
<?php if ($proveedores->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $proveedores_list->lRowIndex ?>">
<?php echo $proveedores_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($proveedores_list->lTotalRecs > 0) { ?>
<?php if ($proveedores->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($proveedores->CurrentAction <> "gridadd" && $proveedores->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($proveedores_list->Pager)) $proveedores_list->Pager = new cPrevNextPager($proveedores_list->lStartRec, $proveedores_list->lDisplayRecs, $proveedores_list->lTotalRecs) ?>
<?php if ($proveedores_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($proveedores_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_list->PageUrl() ?>start=<?php echo $proveedores_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($proveedores_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_list->PageUrl() ?>start=<?php echo $proveedores_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $proveedores_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($proveedores_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_list->PageUrl() ?>start=<?php echo $proveedores_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($proveedores_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $proveedores_list->PageUrl() ?>start=<?php echo $proveedores_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $proveedores_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $proveedores_list->Pager->FromIndex ?> a <?php echo $proveedores_list->Pager->ToIndex ?> de <?php echo $proveedores_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($proveedores_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($proveedores_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="proveedores">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($proveedores_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($proveedores_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($proveedores_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($proveedores_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($proveedores_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($proveedores_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($proveedores->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($proveedores_list->lTotalRecs > 0) { ?>
<span class="arenas">
<?php if ($proveedores->CurrentAction <> "gridadd" && $proveedores->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $proveedores->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<a href="<?php echo $proveedores_list->PageUrl() ?>a=gridadd">Agregar en grid</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($proveedores_list->lTotalRecs > 0) { ?>
<a href="<?php echo $proveedores_list->PageUrl() ?>a=gridedit">Edición Múltiple</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($proveedores_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fproveedoreslist)) alert('No se seleccionaron registros'); else {document.fproveedoreslist.action='proveedoresdelete.php';document.fproveedoreslist.encoding='application/x-www-form-urlencoded';document.fproveedoreslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($proveedores->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (proveedores_list.ValidateForm(document.fproveedoreslist)) document.fproveedoreslist.submit();return false;"><img src='images/insert.gif' alt='Insert' title='Insert' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($proveedores->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (proveedores_list.ValidateForm(document.fproveedoreslist)) document.fproveedoreslist.submit();return false;"><img src='images/update.gif' alt='Save' title='Save' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $proveedores_list->PageUrl() ?>a=cancel"><img src='images/cancel.gif' alt='Cancel' title='Cancel' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($proveedores->Export == "" && $proveedores->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(proveedores_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($proveedores->Export == "") { ?>
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
class cproveedores_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'proveedores';

	// Page Object Name
	var $PageObjName = 'proveedores_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $proveedores;
		if ($proveedores->UseTokenInUrl) $PageUrl .= "t=" . $proveedores->TableVar . "&"; // add page token
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
		global $objForm, $proveedores;
		if ($proveedores->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($proveedores->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($proveedores->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cproveedores_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["proveedores"] = new cproveedores();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'proveedores', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $proveedores;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$proveedores->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $proveedores->Export; // Get export parameter, used in header
	$gsExportFile = $proveedores->TableVar; // Get export file, used in header
	if ($proveedores->Export == "print" || $proveedores->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($proveedores->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($proveedores->Export == "word") {
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
		global $objForm, $gsSearchError, $Security, $proveedores;
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

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$proveedores->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($proveedores->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($proveedores->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to grid add mode
				if ($proveedores->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$proveedores->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($proveedores->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Grid Insert
					if ($proveedores->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd")
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
		if ($proveedores->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $proveedores->getRecordsPerPage(); // Restore from Session
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
		$proveedores->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$proveedores->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$proveedores->setStartRecordNumber($this->lStartRec);
		} else {
			$this->RestoreSearchParms();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in Session
		$proveedores->setSessionWhere($sFilter);
		$proveedores->CurrentFilter = "";

		// Export data only
		if (in_array($proveedores->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $proveedores;
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
			$proveedores->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$proveedores->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $proveedores;
		$proveedores->CurrentAction = ""; // Clear action
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
		global $conn, $objForm, $gsFormError, $proveedores;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$proveedores->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $proveedores->SQL();
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
					$proveedores->SendEmail = FALSE; // Do not send email on update success
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
			$proveedores->EventCancelled = TRUE; // Set event cancelled
			$proveedores->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $proveedores;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $proveedores->KeyFilter();
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
		global $proveedores;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$proveedores->id_proveedor->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($proveedores->id_proveedor->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Grid Insert
	// Peform insert to grid
	function GridInsert() {
		global $conn, $objForm, $gsFormError, $proveedores;
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
				$proveedores->SendEmail = FALSE; // Do not send email on insert success

				// Validate Form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow(); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $proveedores->id_proveedor->CurrentValue;

					// Add filter for this record
					$sFilter = $proveedores->KeyFilter();
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
			$proveedores->CurrentFilter = $sWrkFilter;
			$sSql = $proveedores->SQL();
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
			$proveedores->EventCancelled = TRUE; // Set event cancelled
			$proveedores->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
	}

	// Check if empty row
	function EmptyRow() {
		global $proveedores;
		if ($proveedores->nombre->CurrentValue <> $proveedores->nombre->OldValue)
			return FALSE;
		if ($proveedores->rnc_cedula->CurrentValue <> $proveedores->rnc_cedula->OldValue)
			return FALSE;
		if ($proveedores->telefonos->CurrentValue <> $proveedores->telefonos->OldValue)
			return FALSE;
		if ($proveedores->Empresa->CurrentValue <> $proveedores->Empresa->OldValue)
			return FALSE;
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $proveedores;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($proveedores->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($proveedores->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($proveedores->id_proveedor->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $proveedores;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $proveedores->id_proveedor, FALSE); // Field id_proveedor
		$this->BuildSearchSql($sWhere, $proveedores->nombre, FALSE); // Field nombre
		$this->BuildSearchSql($sWhere, $proveedores->rnc_cedula, FALSE); // Field rnc_cedula
		$this->BuildSearchSql($sWhere, $proveedores->telefonos, FALSE); // Field telefonos
		$this->BuildSearchSql($sWhere, $proveedores->notas, FALSE); // Field notas
		$this->BuildSearchSql($sWhere, $proveedores->Empresa, FALSE); // Field Empresa

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($proveedores->id_proveedor); // Field id_proveedor
			$this->SetSearchParm($proveedores->nombre); // Field nombre
			$this->SetSearchParm($proveedores->rnc_cedula); // Field rnc_cedula
			$this->SetSearchParm($proveedores->telefonos); // Field telefonos
			$this->SetSearchParm($proveedores->notas); // Field notas
			$this->SetSearchParm($proveedores->Empresa); // Field Empresa
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
		global $proveedores;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = @$_GET["x_$FldParm"];
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = @$_GET["y_$FldParm"];
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$proveedores->setAdvancedSearch("x_$FldParm", $FldVal);
		$proveedores->setAdvancedSearch("z_$FldParm", @$_GET["z_$FldParm"]);
		$proveedores->setAdvancedSearch("v_$FldParm", @$_GET["v_$FldParm"]);
		$proveedores->setAdvancedSearch("y_$FldParm", $FldVal2);
		$proveedores->setAdvancedSearch("w_$FldParm", @$_GET["w_$FldParm"]);
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
		global $proveedores;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $proveedores->nombre->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $proveedores->rnc_cedula->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $proveedores->telefonos->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $proveedores->notas->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $proveedores->Empresa->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $proveedores;
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
			$proveedores->setBasicSearchKeyword($sSearchKeyword);
			$proveedores->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $proveedores;
		$this->sSrchWhere = "";
		$proveedores->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $proveedores;
		$proveedores->setBasicSearchKeyword("");
		$proveedores->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $proveedores;
		$proveedores->setAdvancedSearch("x_id_proveedor", "");
		$proveedores->setAdvancedSearch("x_nombre", "");
		$proveedores->setAdvancedSearch("x_rnc_cedula", "");
		$proveedores->setAdvancedSearch("x_telefonos", "");
		$proveedores->setAdvancedSearch("x_notas", "");
		$proveedores->setAdvancedSearch("x_Empresa", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $proveedores;
		$this->sSrchWhere = $proveedores->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $proveedores;
		 $proveedores->id_proveedor->AdvancedSearch->SearchValue = $proveedores->getAdvancedSearch("x_id_proveedor");
		 $proveedores->nombre->AdvancedSearch->SearchValue = $proveedores->getAdvancedSearch("x_nombre");
		 $proveedores->rnc_cedula->AdvancedSearch->SearchValue = $proveedores->getAdvancedSearch("x_rnc_cedula");
		 $proveedores->telefonos->AdvancedSearch->SearchValue = $proveedores->getAdvancedSearch("x_telefonos");
		 $proveedores->notas->AdvancedSearch->SearchValue = $proveedores->getAdvancedSearch("x_notas");
		 $proveedores->Empresa->AdvancedSearch->SearchValue = $proveedores->getAdvancedSearch("x_Empresa");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $proveedores;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$proveedores->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$proveedores->CurrentOrderType = @$_GET["ordertype"];
			$proveedores->UpdateSort($proveedores->id_proveedor); // Field 
			$proveedores->UpdateSort($proveedores->nombre); // Field 
			$proveedores->UpdateSort($proveedores->rnc_cedula); // Field 
			$proveedores->UpdateSort($proveedores->telefonos); // Field 
			$proveedores->UpdateSort($proveedores->Empresa); // Field 
			$proveedores->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $proveedores;
		$sOrderBy = $proveedores->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($proveedores->SqlOrderBy() <> "") {
				$sOrderBy = $proveedores->SqlOrderBy();
				$proveedores->setSessionOrderBy($sOrderBy);
				$proveedores->id_proveedor->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $proveedores;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$proveedores->setSessionOrderBy($sOrderBy);
				$proveedores->id_proveedor->setSort("");
				$proveedores->nombre->setSort("");
				$proveedores->rnc_cedula->setSort("");
				$proveedores->telefonos->setSort("");
				$proveedores->Empresa->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$proveedores->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $proveedores;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$proveedores->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$proveedores->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $proveedores->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$proveedores->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$proveedores->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$proveedores->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $proveedores;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $proveedores;

		// Load search values
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $proveedores;
		$proveedores->id_proveedor->setFormValue($objForm->GetValue("x_id_proveedor"));
		$proveedores->id_proveedor->OldValue = $objForm->GetValue("o_id_proveedor");
		$proveedores->nombre->setFormValue($objForm->GetValue("x_nombre"));
		$proveedores->nombre->OldValue = $objForm->GetValue("o_nombre");
		$proveedores->rnc_cedula->setFormValue($objForm->GetValue("x_rnc_cedula"));
		$proveedores->rnc_cedula->OldValue = $objForm->GetValue("o_rnc_cedula");
		$proveedores->telefonos->setFormValue($objForm->GetValue("x_telefonos"));
		$proveedores->telefonos->OldValue = $objForm->GetValue("o_telefonos");
		$proveedores->Empresa->setFormValue($objForm->GetValue("x_Empresa"));
		$proveedores->Empresa->OldValue = $objForm->GetValue("o_Empresa");
	}

	// Restore form values
	function RestoreFormValues() {
		global $proveedores;
		$proveedores->id_proveedor->CurrentValue = $proveedores->id_proveedor->FormValue;
		$proveedores->nombre->CurrentValue = $proveedores->nombre->FormValue;
		$proveedores->rnc_cedula->CurrentValue = $proveedores->rnc_cedula->FormValue;
		$proveedores->telefonos->CurrentValue = $proveedores->telefonos->FormValue;
		$proveedores->Empresa->CurrentValue = $proveedores->Empresa->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $proveedores;

		// Call Recordset Selecting event
		$proveedores->Recordset_Selecting($proveedores->CurrentFilter);

		// Load list page SQL
		$sSql = $proveedores->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$proveedores->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $proveedores;
		$sFilter = $proveedores->KeyFilter();

		// Call Row Selecting event
		$proveedores->Row_Selecting($sFilter);

		// Load sql based on filter
		$proveedores->CurrentFilter = $sFilter;
		$sSql = $proveedores->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$proveedores->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $proveedores;
		$proveedores->id_proveedor->setDbValue($rs->fields('id_proveedor'));
		$proveedores->nombre->setDbValue($rs->fields('nombre'));
		$proveedores->rnc_cedula->setDbValue($rs->fields('rnc_cedula'));
		$proveedores->telefonos->setDbValue($rs->fields('telefonos'));
		$proveedores->notas->setDbValue($rs->fields('notas'));
		$proveedores->Empresa->setDbValue($rs->fields('Empresa'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $proveedores;

		// Call Row_Rendering event
		$proveedores->Row_Rendering();

		// Common render codes for all row types
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
		if ($proveedores->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_proveedor
			$proveedores->id_proveedor->ViewValue = $proveedores->id_proveedor->CurrentValue;
			$proveedores->id_proveedor->CssStyle = "";
			$proveedores->id_proveedor->CssClass = "";
			$proveedores->id_proveedor->ViewCustomAttributes = "";

			// nombre
			$proveedores->nombre->ViewValue = $proveedores->nombre->CurrentValue;
			$proveedores->nombre->CssStyle = "";
			$proveedores->nombre->CssClass = "";
			$proveedores->nombre->ViewCustomAttributes = "";

			// rnc_cedula
			$proveedores->rnc_cedula->ViewValue = $proveedores->rnc_cedula->CurrentValue;
			$proveedores->rnc_cedula->CssStyle = "";
			$proveedores->rnc_cedula->CssClass = "";
			$proveedores->rnc_cedula->ViewCustomAttributes = "";

			// telefonos
			$proveedores->telefonos->ViewValue = $proveedores->telefonos->CurrentValue;
			$proveedores->telefonos->CssStyle = "";
			$proveedores->telefonos->CssClass = "";
			$proveedores->telefonos->ViewCustomAttributes = "";

			// Empresa
			if (strval($proveedores->Empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($proveedores->Empresa->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$proveedores->Empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$proveedores->Empresa->ViewValue = $proveedores->Empresa->CurrentValue;
				}
			} else {
				$proveedores->Empresa->ViewValue = NULL;
			}
			$proveedores->Empresa->CssStyle = "";
			$proveedores->Empresa->CssClass = "";
			$proveedores->Empresa->ViewCustomAttributes = "";

			// id_proveedor
			$proveedores->id_proveedor->HrefValue = "";

			// nombre
			$proveedores->nombre->HrefValue = "";

			// rnc_cedula
			$proveedores->rnc_cedula->HrefValue = "";

			// telefonos
			$proveedores->telefonos->HrefValue = "";

			// Empresa
			$proveedores->Empresa->HrefValue = "";
		} elseif ($proveedores->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_proveedor
			// nombre

			$proveedores->nombre->EditCustomAttributes = "";
			$proveedores->nombre->EditValue = ew_HtmlEncode($proveedores->nombre->CurrentValue);

			// rnc_cedula
			$proveedores->rnc_cedula->EditCustomAttributes = "";
			$proveedores->rnc_cedula->EditValue = ew_HtmlEncode($proveedores->rnc_cedula->CurrentValue);

			// telefonos
			$proveedores->telefonos->EditCustomAttributes = "";
			$proveedores->telefonos->EditValue = ew_HtmlEncode($proveedores->telefonos->CurrentValue);

			// Empresa
			$proveedores->Empresa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_empresa`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `empresas`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$proveedores->Empresa->EditValue = $arwrk;
		} elseif ($proveedores->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_proveedor
			$proveedores->id_proveedor->EditCustomAttributes = "";
			$proveedores->id_proveedor->EditValue = $proveedores->id_proveedor->CurrentValue;
			$proveedores->id_proveedor->CssStyle = "";
			$proveedores->id_proveedor->CssClass = "";
			$proveedores->id_proveedor->ViewCustomAttributes = "";

			// nombre
			$proveedores->nombre->EditCustomAttributes = "";
			$proveedores->nombre->EditValue = ew_HtmlEncode($proveedores->nombre->CurrentValue);

			// rnc_cedula
			$proveedores->rnc_cedula->EditCustomAttributes = "";
			$proveedores->rnc_cedula->EditValue = ew_HtmlEncode($proveedores->rnc_cedula->CurrentValue);

			// telefonos
			$proveedores->telefonos->EditCustomAttributes = "";
			$proveedores->telefonos->EditValue = ew_HtmlEncode($proveedores->telefonos->CurrentValue);

			// Empresa
			$proveedores->Empresa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id_empresa`, `nombre`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `empresas`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Seleccionar"));
			$proveedores->Empresa->EditValue = $arwrk;

			// Edit refer script
			// id_proveedor

			$proveedores->id_proveedor->HrefValue = "";

			// nombre
			$proveedores->nombre->HrefValue = "";

			// rnc_cedula
			$proveedores->rnc_cedula->HrefValue = "";

			// telefonos
			$proveedores->telefonos->HrefValue = "";

			// Empresa
			$proveedores->Empresa->HrefValue = "";
		}

		// Call Row Rendered event
		$proveedores->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $proveedores;

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
		global $gsFormError, $proveedores;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($proveedores->nombre->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Nombre";
		}
		if ($proveedores->rnc_cedula->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Rnc /cedula";
		}
		if ($proveedores->telefonos->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Telefonos";
		}
		if ($proveedores->Empresa->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Empresa";
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
		global $conn, $Security, $proveedores;
		$sFilter = $proveedores->KeyFilter();
			if ($proveedores->nombre->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(nombre = '" . ew_AdjustSql($proveedores->nombre->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$proveedores->CurrentFilter = $sFilterChk;
			$sSqlChk = $proveedores->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", "nombre", "Valor duplicado '%v' para el indice '%f'");
				$sIdxErrMsg = str_replace("%v", $proveedores->nombre->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);				
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
			if ($proveedores->rnc_cedula->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(rnc_cedula = '" . ew_AdjustSql($proveedores->rnc_cedula->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$proveedores->CurrentFilter = $sFilterChk;
			$sSqlChk = $proveedores->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", "rnc_cedula", "Valor duplicado '%v' para el indice '%f'");
				$sIdxErrMsg = str_replace("%v", $proveedores->rnc_cedula->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);				
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$proveedores->CurrentFilter = $sFilter;
		$sSql = $proveedores->SQL();
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

			// Field id_proveedor
			// Field nombre

			$proveedores->nombre->SetDbValueDef($proveedores->nombre->CurrentValue, "");
			$rsnew['nombre'] =& $proveedores->nombre->DbValue;

			// Field rnc_cedula
			$proveedores->rnc_cedula->SetDbValueDef($proveedores->rnc_cedula->CurrentValue, "");
			$rsnew['rnc_cedula'] =& $proveedores->rnc_cedula->DbValue;

			// Field telefonos
			$proveedores->telefonos->SetDbValueDef($proveedores->telefonos->CurrentValue, "");
			$rsnew['telefonos'] =& $proveedores->telefonos->DbValue;

			// Field Empresa
			$proveedores->Empresa->SetDbValueDef($proveedores->Empresa->CurrentValue, "");
			$rsnew['Empresa'] =& $proveedores->Empresa->DbValue;

			// Call Row Updating event
			$bUpdateRow = $proveedores->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($proveedores->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($proveedores->CancelMessage <> "") {
					$this->setMessage($proveedores->CancelMessage);
					$proveedores->CancelMessage = "";
				} else {
					$this->setMessage("Actualizar cancelado");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$proveedores->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $proveedores;
		if ($proveedores->nombre->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(nombre = '" . ew_AdjustSql($proveedores->nombre->CurrentValue) . "')";
			$rsChk = $proveedores->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", "nombre", "Valor duplicado '%v' para el indice '%f'");
				$sIdxErrMsg = str_replace("%v", $proveedores->nombre->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($proveedores->rnc_cedula->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(rnc_cedula = '" . ew_AdjustSql($proveedores->rnc_cedula->CurrentValue) . "')";
			$rsChk = $proveedores->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", "rnc_cedula", "Valor duplicado '%v' para el indice '%f'");
				$sIdxErrMsg = str_replace("%v", $proveedores->rnc_cedula->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// Field id_proveedor
		// Field nombre

		$proveedores->nombre->SetDbValueDef($proveedores->nombre->CurrentValue, "");
		$rsnew['nombre'] =& $proveedores->nombre->DbValue;

		// Field rnc_cedula
		$proveedores->rnc_cedula->SetDbValueDef($proveedores->rnc_cedula->CurrentValue, "");
		$rsnew['rnc_cedula'] =& $proveedores->rnc_cedula->DbValue;

		// Field telefonos
		$proveedores->telefonos->SetDbValueDef($proveedores->telefonos->CurrentValue, "");
		$rsnew['telefonos'] =& $proveedores->telefonos->DbValue;

		// Field Empresa
		$proveedores->Empresa->SetDbValueDef($proveedores->Empresa->CurrentValue, "");
		$rsnew['Empresa'] =& $proveedores->Empresa->DbValue;

		// Call Row Inserting event
		$bInsertRow = $proveedores->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($proveedores->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($proveedores->CancelMessage <> "") {
				$this->setMessage($proveedores->CancelMessage);
				$proveedores->CancelMessage = "";
			} else {
				$this->setMessage("Insertar cancelado");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$proveedores->id_proveedor->setDbValue($conn->Insert_ID());
			$rsnew['id_proveedor'] =& $proveedores->id_proveedor->DbValue;

			// Call Row Inserted event
			$proveedores->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $proveedores;
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $proveedores;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($proveedores->ExportAll) {
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
		if ($proveedores->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($proveedores->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $proveedores->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id_proveedor', $proveedores->Export);
				ew_ExportAddValue($sExportStr, 'nombre', $proveedores->Export);
				ew_ExportAddValue($sExportStr, 'rnc_cedula', $proveedores->Export);
				ew_ExportAddValue($sExportStr, 'telefonos', $proveedores->Export);
				ew_ExportAddValue($sExportStr, 'Empresa', $proveedores->Export);
				echo ew_ExportLine($sExportStr, $proveedores->Export);
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
				$proveedores->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($proveedores->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id_proveedor', $proveedores->id_proveedor->CurrentValue);
					$XmlDoc->AddField('nombre', $proveedores->nombre->CurrentValue);
					$XmlDoc->AddField('rnc_cedula', $proveedores->rnc_cedula->CurrentValue);
					$XmlDoc->AddField('telefonos', $proveedores->telefonos->CurrentValue);
					$XmlDoc->AddField('Empresa', $proveedores->Empresa->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $proveedores->Export <> "csv") { // Vertical format
						echo ew_ExportField('id_proveedor', $proveedores->id_proveedor->ExportValue($proveedores->Export, $proveedores->ExportOriginalValue), $proveedores->Export);
						echo ew_ExportField('nombre', $proveedores->nombre->ExportValue($proveedores->Export, $proveedores->ExportOriginalValue), $proveedores->Export);
						echo ew_ExportField('rnc_cedula', $proveedores->rnc_cedula->ExportValue($proveedores->Export, $proveedores->ExportOriginalValue), $proveedores->Export);
						echo ew_ExportField('telefonos', $proveedores->telefonos->ExportValue($proveedores->Export, $proveedores->ExportOriginalValue), $proveedores->Export);
						echo ew_ExportField('Empresa', $proveedores->Empresa->ExportValue($proveedores->Export, $proveedores->ExportOriginalValue), $proveedores->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $proveedores->id_proveedor->ExportValue($proveedores->Export, $proveedores->ExportOriginalValue), $proveedores->Export);
						ew_ExportAddValue($sExportStr, $proveedores->nombre->ExportValue($proveedores->Export, $proveedores->ExportOriginalValue), $proveedores->Export);
						ew_ExportAddValue($sExportStr, $proveedores->rnc_cedula->ExportValue($proveedores->Export, $proveedores->ExportOriginalValue), $proveedores->Export);
						ew_ExportAddValue($sExportStr, $proveedores->telefonos->ExportValue($proveedores->Export, $proveedores->ExportOriginalValue), $proveedores->Export);
						ew_ExportAddValue($sExportStr, $proveedores->Empresa->ExportValue($proveedores->Export, $proveedores->ExportOriginalValue), $proveedores->Export);
						echo ew_ExportLine($sExportStr, $proveedores->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($proveedores->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($proveedores->Export);
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
