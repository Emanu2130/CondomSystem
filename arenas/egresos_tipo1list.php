<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "egresos_tipo1info.php" ?>
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
$egresos_tipo1_list = new cegresos_tipo1_list();
$Page =& $egresos_tipo1_list;

// Page init processing
$egresos_tipo1_list->Page_Init();

// Page main processing
$egresos_tipo1_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($egresos_tipo1->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var egresos_tipo1_list = new ew_Page("egresos_tipo1_list");

// page properties
egresos_tipo1_list.PageID = "list"; // page ID
var EW_PAGE_ID = egresos_tipo1_list.PageID; // for backward compatibility

// extend page with ValidateForm function
egresos_tipo1_list.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_tipo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Ingrese el campo requerido - Tipo");

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
egresos_tipo1_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "tipo")) return false;
	return true;
}

// extend page with Form_CustomValidate function
egresos_tipo1_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
egresos_tipo1_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
egresos_tipo1_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
egresos_tipo1_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($egresos_tipo1->Export == "") { ?>
<?php } ?>
<?php
if ($egresos_tipo1->CurrentAction == "gridadd")
	$egresos_tipo1->CurrentFilter = "0=1";
if ($egresos_tipo1->CurrentAction == "gridadd") {
	$egresos_tipo1_list->lStartRec = 1;
	if ($egresos_tipo1_list->lDisplayRecs <= 0)
		$egresos_tipo1_list->lDisplayRecs = 20;
	$egresos_tipo1_list->lTotalRecs = $egresos_tipo1_list->lDisplayRecs;
	$egresos_tipo1_list->lStopRec = $egresos_tipo1_list->lDisplayRecs;
} else {
	$bSelectLimit = ($egresos_tipo1->Export == "" && $egresos_tipo1->SelectLimit);
	if (!$bSelectLimit)
		$rs = $egresos_tipo1_list->LoadRecordset();
	$egresos_tipo1_list->lTotalRecs = ($bSelectLimit) ? $egresos_tipo1->SelectRecordCount() : $rs->RecordCount();
	$egresos_tipo1_list->lStartRec = 1;
	if ($egresos_tipo1_list->lDisplayRecs <= 0) // Display all records
		$egresos_tipo1_list->lDisplayRecs = $egresos_tipo1_list->lTotalRecs;
	if (!($egresos_tipo1->ExportAll && $egresos_tipo1->Export <> ""))
		$egresos_tipo1_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $egresos_tipo1_list->LoadRecordset($egresos_tipo1_list->lStartRec-1, $egresos_tipo1_list->lDisplayRecs);
}
?>
<p><span class="arenas" style="white-space: nowrap;">Modulo: Egresos Tipo 1
<?php if ($egresos_tipo1->Export == "" && $egresos_tipo1->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $egresos_tipo1_list->PageUrl() ?>export=print"><img src='images/print.gif' alt='Printer Friendly' title='Printer Friendly' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $egresos_tipo1_list->PageUrl() ?>export=excel"><img src='images/exportxls.gif' alt='Export to Excel' title='Export to Excel' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $egresos_tipo1_list->PageUrl() ?>export=word"><img src='images/exportdoc.gif' alt='Export to Word' title='Export to Word' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($egresos_tipo1->Export == "" && $egresos_tipo1->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(egresos_tipo1_list);" style="text-decoration: none;"><img id="egresos_tipo1_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="arenas">&nbsp;Buscar</span><br>
<div id="egresos_tipo1_list_SearchPanel">
<form name="fegresos_tipo1listsrch" id="fegresos_tipo1listsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="egresos_tipo1">
<table class="ewBasicSearch">
	<tr>
		<td><span class="arenas">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($egresos_tipo1->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Buscar (*)">&nbsp;
			<a href="<?php echo $egresos_tipo1_list->PageUrl() ?>cmd=reset">Mostrar todos</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="arenas"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($egresos_tipo1->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Frase exacta</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($egresos_tipo1->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>Todas las palabras</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($egresos_tipo1->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Cualquier palabra</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $egresos_tipo1_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($egresos_tipo1->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($egresos_tipo1->CurrentAction <> "gridadd" && $egresos_tipo1->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($egresos_tipo1_list->Pager)) $egresos_tipo1_list->Pager = new cPrevNextPager($egresos_tipo1_list->lStartRec, $egresos_tipo1_list->lDisplayRecs, $egresos_tipo1_list->lTotalRecs) ?>
<?php if ($egresos_tipo1_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($egresos_tipo1_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_list->PageUrl() ?>start=<?php echo $egresos_tipo1_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($egresos_tipo1_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_list->PageUrl() ?>start=<?php echo $egresos_tipo1_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $egresos_tipo1_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($egresos_tipo1_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_list->PageUrl() ?>start=<?php echo $egresos_tipo1_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($egresos_tipo1_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_list->PageUrl() ?>start=<?php echo $egresos_tipo1_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $egresos_tipo1_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $egresos_tipo1_list->Pager->FromIndex ?> a <?php echo $egresos_tipo1_list->Pager->ToIndex ?> de <?php echo $egresos_tipo1_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($egresos_tipo1_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($egresos_tipo1_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="egresos_tipo1">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($egresos_tipo1_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($egresos_tipo1_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($egresos_tipo1_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($egresos_tipo1_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($egresos_tipo1_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($egresos_tipo1_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($egresos_tipo1->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="arenas">
<?php if ($egresos_tipo1->CurrentAction <> "gridadd" && $egresos_tipo1->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $egresos_tipo1->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<a href="<?php echo $egresos_tipo1_list->PageUrl() ?>a=gridadd">Agregar en grid</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($egresos_tipo1_list->lTotalRecs > 0) { ?>
<a href="<?php echo $egresos_tipo1_list->PageUrl() ?>a=gridedit">Edición Múltiple</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($egresos_tipo1_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fegresos_tipo1list)) alert('No se seleccionaron registros'); else {document.fegresos_tipo1list.action='egresos_tipo1delete.php';document.fegresos_tipo1list.encoding='application/x-www-form-urlencoded';document.fegresos_tipo1list.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($egresos_tipo1->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (egresos_tipo1_list.ValidateForm(document.fegresos_tipo1list)) document.fegresos_tipo1list.submit();return false;"><img src='images/insert.gif' alt='Insert' title='Insert' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($egresos_tipo1->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (egresos_tipo1_list.ValidateForm(document.fegresos_tipo1list)) document.fegresos_tipo1list.submit();return false;"><img src='images/update.gif' alt='Save' title='Save' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $egresos_tipo1_list->PageUrl() ?>a=cancel"><img src='images/cancel.gif' alt='Cancel' title='Cancel' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fegresos_tipo1list" id="fegresos_tipo1list" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="egresos_tipo1">
<?php if ($egresos_tipo1_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$egresos_tipo1_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$egresos_tipo1_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$egresos_tipo1_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$egresos_tipo1_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$egresos_tipo1_list->lOptionCnt++; // Multi-select
}
	$egresos_tipo1_list->lOptionCnt += count($egresos_tipo1_list->ListOptions->Items); // Custom list options
?>
<?php echo $egresos_tipo1->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($egresos_tipo1->id_tipo->Visible) { // id_tipo ?>
	<?php if ($egresos_tipo1->SortUrl($egresos_tipo1->id_tipo) == "") { ?>
		<td>Id Tipo</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos_tipo1->SortUrl($egresos_tipo1->id_tipo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id Tipo</td><td style="width: 10px;"><?php if ($egresos_tipo1->id_tipo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos_tipo1->id_tipo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos_tipo1->tipo->Visible) { // tipo ?>
	<?php if ($egresos_tipo1->SortUrl($egresos_tipo1->tipo) == "") { ?>
		<td>Tipo</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $egresos_tipo1->SortUrl($egresos_tipo1->tipo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tipo&nbsp;(*)</td><td style="width: 10px;"><?php if ($egresos_tipo1->tipo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($egresos_tipo1->tipo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($egresos_tipo1->Export == "") { ?>
<?php if ($egresos_tipo1->CurrentAction <> "gridadd" && $egresos_tipo1->CurrentAction <> "gridedit") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="arenas" onclick="egresos_tipo1_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($egresos_tipo1_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<?php
if ($egresos_tipo1->ExportAll && $egresos_tipo1->Export <> "") {
	$egresos_tipo1_list->lStopRec = $egresos_tipo1_list->lTotalRecs;
} else {
	$egresos_tipo1_list->lStopRec = $egresos_tipo1_list->lStartRec + $egresos_tipo1_list->lDisplayRecs - 1; // Set the last record to display
}
$egresos_tipo1_list->lRecCount = $egresos_tipo1_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$egresos_tipo1->SelectLimit && $egresos_tipo1_list->lStartRec > 1)
		$rs->Move($egresos_tipo1_list->lStartRec - 1);
}
$egresos_tipo1_list->lRowCnt = 0;
if ($egresos_tipo1->CurrentAction == "gridadd")
	$egresos_tipo1_list->lRowIndex = 0;
if ($egresos_tipo1->CurrentAction == "gridedit")
	$egresos_tipo1_list->lRowIndex = 0;
while (($egresos_tipo1->CurrentAction == "gridadd" || !$rs->EOF) &&
	$egresos_tipo1_list->lRecCount < $egresos_tipo1_list->lStopRec) {
	$egresos_tipo1_list->lRecCount++;
	if (intval($egresos_tipo1_list->lRecCount) >= intval($egresos_tipo1_list->lStartRec)) {
		$egresos_tipo1_list->lRowCnt++;
		if ($egresos_tipo1->CurrentAction == "gridadd" || $egresos_tipo1->CurrentAction == "gridedit")
			$egresos_tipo1_list->lRowIndex++;

	// Init row class and style
	$egresos_tipo1->CssClass = "";
	$egresos_tipo1->CssStyle = "";
	$egresos_tipo1->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($egresos_tipo1->CurrentAction == "gridadd") {
		$egresos_tipo1_list->LoadDefaultValues(); // Load default values
	} else {
		$egresos_tipo1_list->LoadRowValues($rs); // Load row values
	}
	$egresos_tipo1->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($egresos_tipo1->CurrentAction == "gridadd") // Grid add
		$egresos_tipo1->RowType = EW_ROWTYPE_ADD; // Render add
	if ($egresos_tipo1->CurrentAction == "gridadd" && $egresos_tipo1->EventCancelled) // Insert failed
		$egresos_tipo1_list->RestoreCurrentRowFormValues($egresos_tipo1_list->lRowIndex); // Restore form values
	if ($egresos_tipo1->CurrentAction == "gridedit") // Grid edit
		$egresos_tipo1->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($egresos_tipo1->RowType == EW_ROWTYPE_EDIT && $egresos_tipo1->EventCancelled) { // Update failed
		if ($egresos_tipo1->CurrentAction == "gridedit")
			$egresos_tipo1_list->RestoreCurrentRowFormValues($egresos_tipo1_list->lRowIndex); // Restore form values
	}
	if ($egresos_tipo1->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$egresos_tipo1_list->lEditRowCnt++;
		$egresos_tipo1->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($egresos_tipo1->RowType == EW_ROWTYPE_ADD || $egresos_tipo1->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$egresos_tipo1->CssClass = "ewTableEditRow";

	// Render row
	$egresos_tipo1_list->RenderRow();
?>
	<tr<?php echo $egresos_tipo1->RowAttributes() ?>>
	<?php if ($egresos_tipo1->id_tipo->Visible) { // id_tipo ?>
		<td<?php echo $egresos_tipo1->id_tipo->CellAttributes() ?>>
<?php if ($egresos_tipo1->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $egresos_tipo1_list->lRowIndex ?>_id_tipo" id="o<?php echo $egresos_tipo1_list->lRowIndex ?>_id_tipo" value="<?php echo ew_HtmlEncode($egresos_tipo1->id_tipo->OldValue) ?>">
<?php } ?>
<?php if ($egresos_tipo1->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $egresos_tipo1->id_tipo->ViewAttributes() ?>><?php echo $egresos_tipo1->id_tipo->EditValue ?></div><input type="hidden" name="x<?php echo $egresos_tipo1_list->lRowIndex ?>_id_tipo" id="x<?php echo $egresos_tipo1_list->lRowIndex ?>_id_tipo" value="<?php echo ew_HtmlEncode($egresos_tipo1->id_tipo->CurrentValue) ?>">
<?php } ?>
<?php if ($egresos_tipo1->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos_tipo1->id_tipo->ViewAttributes() ?>><?php echo $egresos_tipo1->id_tipo->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($egresos_tipo1->tipo->Visible) { // tipo ?>
		<td<?php echo $egresos_tipo1->tipo->CellAttributes() ?>>
<?php if ($egresos_tipo1->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $egresos_tipo1_list->lRowIndex ?>_tipo" id="x<?php echo $egresos_tipo1_list->lRowIndex ?>_tipo" size="30" maxlength="255" value="<?php echo $egresos_tipo1->tipo->EditValue ?>"<?php echo $egresos_tipo1->tipo->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $egresos_tipo1_list->lRowIndex ?>_tipo" id="o<?php echo $egresos_tipo1_list->lRowIndex ?>_tipo" value="<?php echo ew_HtmlEncode($egresos_tipo1->tipo->OldValue) ?>">
<?php } ?>
<?php if ($egresos_tipo1->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $egresos_tipo1_list->lRowIndex ?>_tipo" id="x<?php echo $egresos_tipo1_list->lRowIndex ?>_tipo" size="30" maxlength="255" value="<?php echo $egresos_tipo1->tipo->EditValue ?>"<?php echo $egresos_tipo1->tipo->EditAttributes() ?>>
<?php } ?>
<?php if ($egresos_tipo1->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $egresos_tipo1->tipo->ViewAttributes() ?>><?php echo $egresos_tipo1->tipo->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($egresos_tipo1->RowType == EW_ROWTYPE_ADD || $egresos_tipo1->RowType == EW_ROWTYPE_EDIT) { ?>
<?php
	if ($egresos_tipo1->CurrentAction == "gridedit")
		$egresos_tipo1_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $egresos_tipo1_list->lRowIndex . "_key\" id=\"k" . $egresos_tipo1_list->lRowIndex . "_key\" value=\"" . $egresos_tipo1->id_tipo->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($egresos_tipo1->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $egresos_tipo1->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $egresos_tipo1->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $egresos_tipo1->CopyUrl() ?>"><img src='images/copy.gif' alt='Copy' title='Copy' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($egresos_tipo1->id_tipo->CurrentValue) ?>" class="arenas" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($egresos_tipo1_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($egresos_tipo1->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($egresos_tipo1->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($egresos_tipo1->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($egresos_tipo1->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $egresos_tipo1_list->lRowIndex ?>">
<?php } ?>
<?php if ($egresos_tipo1->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $egresos_tipo1_list->lRowIndex ?>">
<?php echo $egresos_tipo1_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($egresos_tipo1_list->lTotalRecs > 0) { ?>
<?php if ($egresos_tipo1->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($egresos_tipo1->CurrentAction <> "gridadd" && $egresos_tipo1->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($egresos_tipo1_list->Pager)) $egresos_tipo1_list->Pager = new cPrevNextPager($egresos_tipo1_list->lStartRec, $egresos_tipo1_list->lDisplayRecs, $egresos_tipo1_list->lTotalRecs) ?>
<?php if ($egresos_tipo1_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($egresos_tipo1_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_list->PageUrl() ?>start=<?php echo $egresos_tipo1_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($egresos_tipo1_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_list->PageUrl() ?>start=<?php echo $egresos_tipo1_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $egresos_tipo1_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($egresos_tipo1_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_list->PageUrl() ?>start=<?php echo $egresos_tipo1_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($egresos_tipo1_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $egresos_tipo1_list->PageUrl() ?>start=<?php echo $egresos_tipo1_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $egresos_tipo1_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $egresos_tipo1_list->Pager->FromIndex ?> a <?php echo $egresos_tipo1_list->Pager->ToIndex ?> de <?php echo $egresos_tipo1_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($egresos_tipo1_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($egresos_tipo1_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="egresos_tipo1">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($egresos_tipo1_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($egresos_tipo1_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($egresos_tipo1_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($egresos_tipo1_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($egresos_tipo1_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($egresos_tipo1_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($egresos_tipo1->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($egresos_tipo1_list->lTotalRecs > 0) { ?>
<span class="arenas">
<?php if ($egresos_tipo1->CurrentAction <> "gridadd" && $egresos_tipo1->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $egresos_tipo1->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<a href="<?php echo $egresos_tipo1_list->PageUrl() ?>a=gridadd">Agregar en grid</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($egresos_tipo1_list->lTotalRecs > 0) { ?>
<a href="<?php echo $egresos_tipo1_list->PageUrl() ?>a=gridedit">Edición Múltiple</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($egresos_tipo1_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fegresos_tipo1list)) alert('No se seleccionaron registros'); else {document.fegresos_tipo1list.action='egresos_tipo1delete.php';document.fegresos_tipo1list.encoding='application/x-www-form-urlencoded';document.fegresos_tipo1list.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($egresos_tipo1->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (egresos_tipo1_list.ValidateForm(document.fegresos_tipo1list)) document.fegresos_tipo1list.submit();return false;"><img src='images/insert.gif' alt='Insert' title='Insert' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($egresos_tipo1->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (egresos_tipo1_list.ValidateForm(document.fegresos_tipo1list)) document.fegresos_tipo1list.submit();return false;"><img src='images/update.gif' alt='Save' title='Save' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $egresos_tipo1_list->PageUrl() ?>a=cancel"><img src='images/cancel.gif' alt='Cancel' title='Cancel' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($egresos_tipo1->Export == "" && $egresos_tipo1->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(egresos_tipo1_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($egresos_tipo1->Export == "") { ?>
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
class cegresos_tipo1_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'egresos_tipo1';

	// Page Object Name
	var $PageObjName = 'egresos_tipo1_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $egresos_tipo1;
		if ($egresos_tipo1->UseTokenInUrl) $PageUrl .= "t=" . $egresos_tipo1->TableVar . "&"; // add page token
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
		global $objForm, $egresos_tipo1;
		if ($egresos_tipo1->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($egresos_tipo1->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($egresos_tipo1->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cegresos_tipo1_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["egresos_tipo1"] = new cegresos_tipo1();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'egresos_tipo1', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $egresos_tipo1;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$egresos_tipo1->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $egresos_tipo1->Export; // Get export parameter, used in header
	$gsExportFile = $egresos_tipo1->TableVar; // Get export file, used in header
	if ($egresos_tipo1->Export == "print" || $egresos_tipo1->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($egresos_tipo1->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($egresos_tipo1->Export == "word") {
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
		global $objForm, $gsSearchError, $Security, $egresos_tipo1;
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
				$egresos_tipo1->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($egresos_tipo1->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($egresos_tipo1->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to grid add mode
				if ($egresos_tipo1->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$egresos_tipo1->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($egresos_tipo1->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Grid Insert
					if ($egresos_tipo1->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd")
						$this->GridInsert();
				}
			}

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($egresos_tipo1->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $egresos_tipo1->getRecordsPerPage(); // Restore from Session
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
		$egresos_tipo1->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$egresos_tipo1->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$egresos_tipo1->setStartRecordNumber($this->lStartRec);
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
		$egresos_tipo1->setSessionWhere($sFilter);
		$egresos_tipo1->CurrentFilter = "";

		// Export data only
		if (in_array($egresos_tipo1->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $egresos_tipo1;
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
			$egresos_tipo1->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$egresos_tipo1->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $egresos_tipo1;
		$egresos_tipo1->CurrentAction = ""; // Clear action
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
		global $conn, $objForm, $gsFormError, $egresos_tipo1;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$egresos_tipo1->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $egresos_tipo1->SQL();
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
					$egresos_tipo1->SendEmail = FALSE; // Do not send email on update success
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
			$egresos_tipo1->EventCancelled = TRUE; // Set event cancelled
			$egresos_tipo1->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $egresos_tipo1;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $egresos_tipo1->KeyFilter();
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
		global $egresos_tipo1;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$egresos_tipo1->id_tipo->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($egresos_tipo1->id_tipo->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Grid Insert
	// Peform insert to grid
	function GridInsert() {
		global $conn, $objForm, $gsFormError, $egresos_tipo1;
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
				$egresos_tipo1->SendEmail = FALSE; // Do not send email on insert success

				// Validate Form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow(); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $egresos_tipo1->id_tipo->CurrentValue;

					// Add filter for this record
					$sFilter = $egresos_tipo1->KeyFilter();
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
			$egresos_tipo1->CurrentFilter = $sWrkFilter;
			$sSql = $egresos_tipo1->SQL();
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
			$egresos_tipo1->EventCancelled = TRUE; // Set event cancelled
			$egresos_tipo1->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
	}

	// Check if empty row
	function EmptyRow() {
		global $egresos_tipo1;
		if ($egresos_tipo1->tipo->CurrentValue <> $egresos_tipo1->tipo->OldValue)
			return FALSE;
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $egresos_tipo1;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($egresos_tipo1->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($egresos_tipo1->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($egresos_tipo1->id_tipo->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $egresos_tipo1;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $egresos_tipo1->tipo->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $egresos_tipo1;
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
			$egresos_tipo1->setBasicSearchKeyword($sSearchKeyword);
			$egresos_tipo1->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $egresos_tipo1;
		$this->sSrchWhere = "";
		$egresos_tipo1->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $egresos_tipo1;
		$egresos_tipo1->setBasicSearchKeyword("");
		$egresos_tipo1->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $egresos_tipo1;
		$this->sSrchWhere = $egresos_tipo1->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $egresos_tipo1;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$egresos_tipo1->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$egresos_tipo1->CurrentOrderType = @$_GET["ordertype"];
			$egresos_tipo1->UpdateSort($egresos_tipo1->id_tipo); // Field 
			$egresos_tipo1->UpdateSort($egresos_tipo1->tipo); // Field 
			$egresos_tipo1->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $egresos_tipo1;
		$sOrderBy = $egresos_tipo1->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($egresos_tipo1->SqlOrderBy() <> "") {
				$sOrderBy = $egresos_tipo1->SqlOrderBy();
				$egresos_tipo1->setSessionOrderBy($sOrderBy);
				$egresos_tipo1->tipo->setSort("ASC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $egresos_tipo1;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$egresos_tipo1->setSessionOrderBy($sOrderBy);
				$egresos_tipo1->id_tipo->setSort("");
				$egresos_tipo1->tipo->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$egresos_tipo1->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $egresos_tipo1;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$egresos_tipo1->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$egresos_tipo1->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $egresos_tipo1->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$egresos_tipo1->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$egresos_tipo1->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$egresos_tipo1->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $egresos_tipo1;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $egresos_tipo1;
		$egresos_tipo1->id_tipo->setFormValue($objForm->GetValue("x_id_tipo"));
		$egresos_tipo1->id_tipo->OldValue = $objForm->GetValue("o_id_tipo");
		$egresos_tipo1->tipo->setFormValue($objForm->GetValue("x_tipo"));
		$egresos_tipo1->tipo->OldValue = $objForm->GetValue("o_tipo");
	}

	// Restore form values
	function RestoreFormValues() {
		global $egresos_tipo1;
		$egresos_tipo1->id_tipo->CurrentValue = $egresos_tipo1->id_tipo->FormValue;
		$egresos_tipo1->tipo->CurrentValue = $egresos_tipo1->tipo->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $egresos_tipo1;

		// Call Recordset Selecting event
		$egresos_tipo1->Recordset_Selecting($egresos_tipo1->CurrentFilter);

		// Load list page SQL
		$sSql = $egresos_tipo1->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$egresos_tipo1->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $egresos_tipo1;
		$sFilter = $egresos_tipo1->KeyFilter();

		// Call Row Selecting event
		$egresos_tipo1->Row_Selecting($sFilter);

		// Load sql based on filter
		$egresos_tipo1->CurrentFilter = $sFilter;
		$sSql = $egresos_tipo1->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$egresos_tipo1->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $egresos_tipo1;
		$egresos_tipo1->id_tipo->setDbValue($rs->fields('id_tipo'));
		$egresos_tipo1->tipo->setDbValue($rs->fields('tipo'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $egresos_tipo1;

		// Call Row_Rendering event
		$egresos_tipo1->Row_Rendering();

		// Common render codes for all row types
		// id_tipo

		$egresos_tipo1->id_tipo->CellCssStyle = "";
		$egresos_tipo1->id_tipo->CellCssClass = "";

		// tipo
		$egresos_tipo1->tipo->CellCssStyle = "";
		$egresos_tipo1->tipo->CellCssClass = "";
		if ($egresos_tipo1->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_tipo
			$egresos_tipo1->id_tipo->ViewValue = $egresos_tipo1->id_tipo->CurrentValue;
			$egresos_tipo1->id_tipo->CssStyle = "";
			$egresos_tipo1->id_tipo->CssClass = "";
			$egresos_tipo1->id_tipo->ViewCustomAttributes = "";

			// tipo
			$egresos_tipo1->tipo->ViewValue = $egresos_tipo1->tipo->CurrentValue;
			$egresos_tipo1->tipo->CssStyle = "";
			$egresos_tipo1->tipo->CssClass = "";
			$egresos_tipo1->tipo->ViewCustomAttributes = "";

			// id_tipo
			$egresos_tipo1->id_tipo->HrefValue = "";

			// tipo
			$egresos_tipo1->tipo->HrefValue = "";
		} elseif ($egresos_tipo1->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_tipo
			// tipo

			$egresos_tipo1->tipo->EditCustomAttributes = "";
			$egresos_tipo1->tipo->EditValue = ew_HtmlEncode($egresos_tipo1->tipo->CurrentValue);
		} elseif ($egresos_tipo1->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_tipo
			$egresos_tipo1->id_tipo->EditCustomAttributes = "";
			$egresos_tipo1->id_tipo->EditValue = $egresos_tipo1->id_tipo->CurrentValue;
			$egresos_tipo1->id_tipo->CssStyle = "";
			$egresos_tipo1->id_tipo->CssClass = "";
			$egresos_tipo1->id_tipo->ViewCustomAttributes = "";

			// tipo
			$egresos_tipo1->tipo->EditCustomAttributes = "";
			$egresos_tipo1->tipo->EditValue = ew_HtmlEncode($egresos_tipo1->tipo->CurrentValue);

			// Edit refer script
			// id_tipo

			$egresos_tipo1->id_tipo->HrefValue = "";

			// tipo
			$egresos_tipo1->tipo->HrefValue = "";
		}

		// Call Row Rendered event
		$egresos_tipo1->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $egresos_tipo1;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($egresos_tipo1->tipo->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Ingrese el campo requerido - Tipo";
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
		global $conn, $Security, $egresos_tipo1;
		$sFilter = $egresos_tipo1->KeyFilter();
		$egresos_tipo1->CurrentFilter = $sFilter;
		$sSql = $egresos_tipo1->SQL();
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

			// Field id_tipo
			// Field tipo

			$egresos_tipo1->tipo->SetDbValueDef($egresos_tipo1->tipo->CurrentValue, "");
			$rsnew['tipo'] =& $egresos_tipo1->tipo->DbValue;

			// Call Row Updating event
			$bUpdateRow = $egresos_tipo1->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($egresos_tipo1->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($egresos_tipo1->CancelMessage <> "") {
					$this->setMessage($egresos_tipo1->CancelMessage);
					$egresos_tipo1->CancelMessage = "";
				} else {
					$this->setMessage("Actualizar cancelado");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$egresos_tipo1->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $egresos_tipo1;
		$rsnew = array();

		// Field id_tipo
		// Field tipo

		$egresos_tipo1->tipo->SetDbValueDef($egresos_tipo1->tipo->CurrentValue, "");
		$rsnew['tipo'] =& $egresos_tipo1->tipo->DbValue;

		// Call Row Inserting event
		$bInsertRow = $egresos_tipo1->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($egresos_tipo1->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($egresos_tipo1->CancelMessage <> "") {
				$this->setMessage($egresos_tipo1->CancelMessage);
				$egresos_tipo1->CancelMessage = "";
			} else {
				$this->setMessage("Insertar cancelado");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$egresos_tipo1->id_tipo->setDbValue($conn->Insert_ID());
			$rsnew['id_tipo'] =& $egresos_tipo1->id_tipo->DbValue;

			// Call Row Inserted event
			$egresos_tipo1->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $egresos_tipo1;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($egresos_tipo1->ExportAll) {
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
		if ($egresos_tipo1->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($egresos_tipo1->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $egresos_tipo1->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id_tipo', $egresos_tipo1->Export);
				ew_ExportAddValue($sExportStr, 'tipo', $egresos_tipo1->Export);
				echo ew_ExportLine($sExportStr, $egresos_tipo1->Export);
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
				$egresos_tipo1->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($egresos_tipo1->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id_tipo', $egresos_tipo1->id_tipo->CurrentValue);
					$XmlDoc->AddField('tipo', $egresos_tipo1->tipo->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $egresos_tipo1->Export <> "csv") { // Vertical format
						echo ew_ExportField('id_tipo', $egresos_tipo1->id_tipo->ExportValue($egresos_tipo1->Export, $egresos_tipo1->ExportOriginalValue), $egresos_tipo1->Export);
						echo ew_ExportField('tipo', $egresos_tipo1->tipo->ExportValue($egresos_tipo1->Export, $egresos_tipo1->ExportOriginalValue), $egresos_tipo1->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $egresos_tipo1->id_tipo->ExportValue($egresos_tipo1->Export, $egresos_tipo1->ExportOriginalValue), $egresos_tipo1->Export);
						ew_ExportAddValue($sExportStr, $egresos_tipo1->tipo->ExportValue($egresos_tipo1->Export, $egresos_tipo1->ExportOriginalValue), $egresos_tipo1->Export);
						echo ew_ExportLine($sExportStr, $egresos_tipo1->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($egresos_tipo1->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($egresos_tipo1->Export);
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
