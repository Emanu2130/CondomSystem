<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "locacionesinfo.php" ?>
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
$locaciones_list = new clocaciones_list();
$Page =& $locaciones_list;

// Page init processing
$locaciones_list->Page_Init();

// Page main processing
$locaciones_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($locaciones->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var locaciones_list = new ew_Page("locaciones_list");

// page properties
locaciones_list.PageID = "list"; // page ID
var EW_PAGE_ID = locaciones_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
locaciones_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
locaciones_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
locaciones_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
locaciones_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($locaciones->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($locaciones->Export == "" && $locaciones->SelectLimit);
	if (!$bSelectLimit)
		$rs = $locaciones_list->LoadRecordset();
	$locaciones_list->lTotalRecs = ($bSelectLimit) ? $locaciones->SelectRecordCount() : $rs->RecordCount();
	$locaciones_list->lStartRec = 1;
	if ($locaciones_list->lDisplayRecs <= 0) // Display all records
		$locaciones_list->lDisplayRecs = $locaciones_list->lTotalRecs;
	if (!($locaciones->ExportAll && $locaciones->Export <> ""))
		$locaciones_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $locaciones_list->LoadRecordset($locaciones_list->lStartRec-1, $locaciones_list->lDisplayRecs);
?>
<p><span class="arenas" style="white-space: nowrap;">Modulo: Locaciones
<?php if ($locaciones->Export == "" && $locaciones->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $locaciones_list->PageUrl() ?>export=print"><img src='images/print.gif' alt='Printer Friendly' title='Printer Friendly' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $locaciones_list->PageUrl() ?>export=excel"><img src='images/exportxls.gif' alt='Export to Excel' title='Export to Excel' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $locaciones_list->PageUrl() ?>export=word"><img src='images/exportdoc.gif' alt='Export to Word' title='Export to Word' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($locaciones->Export == "" && $locaciones->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(locaciones_list);" style="text-decoration: none;"><img id="locaciones_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="arenas">&nbsp;Buscar</span><br>
<div id="locaciones_list_SearchPanel">
<form name="flocacioneslistsrch" id="flocacioneslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="locaciones">
<table class="ewBasicSearch">
	<tr>
		<td><span class="arenas">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($locaciones->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Buscar (*)">&nbsp;
			<a href="<?php echo $locaciones_list->PageUrl() ?>cmd=reset">Mostrar todos</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="arenas"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($locaciones->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Frase exacta</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($locaciones->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>Todas las palabras</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($locaciones->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Cualquier palabra</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $locaciones_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($locaciones->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($locaciones->CurrentAction <> "gridadd" && $locaciones->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($locaciones_list->Pager)) $locaciones_list->Pager = new cPrevNextPager($locaciones_list->lStartRec, $locaciones_list->lDisplayRecs, $locaciones_list->lTotalRecs) ?>
<?php if ($locaciones_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($locaciones_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_list->PageUrl() ?>start=<?php echo $locaciones_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($locaciones_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_list->PageUrl() ?>start=<?php echo $locaciones_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $locaciones_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($locaciones_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_list->PageUrl() ?>start=<?php echo $locaciones_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($locaciones_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_list->PageUrl() ?>start=<?php echo $locaciones_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $locaciones_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $locaciones_list->Pager->FromIndex ?> a <?php echo $locaciones_list->Pager->ToIndex ?> de <?php echo $locaciones_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($locaciones_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($locaciones_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="locaciones">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($locaciones_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($locaciones_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($locaciones_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($locaciones_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($locaciones_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($locaciones_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($locaciones->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $locaciones->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($locaciones_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.flocacioneslist)) alert('No se seleccionaron registros'); else {document.flocacioneslist.action='locacionesdelete.php';document.flocacioneslist.encoding='application/x-www-form-urlencoded';document.flocacioneslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="flocacioneslist" id="flocacioneslist" class="ewForm" action="" method="post">
<?php if ($locaciones_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$locaciones_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$locaciones_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$locaciones_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$locaciones_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$locaciones_list->lOptionCnt++; // Detail
}
if ($Security->IsLoggedIn()) {
	$locaciones_list->lOptionCnt++; // Detail
}
if ($Security->IsLoggedIn()) {
	$locaciones_list->lOptionCnt++; // Multi-select
}
	$locaciones_list->lOptionCnt += count($locaciones_list->ListOptions->Items); // Custom list options
?>
<?php echo $locaciones->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($locaciones->id_locacion->Visible) { // id_locacion ?>
	<?php if ($locaciones->SortUrl($locaciones->id_locacion) == "") { ?>
		<td>Id Locacion</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $locaciones->SortUrl($locaciones->id_locacion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id Locacion</td><td style="width: 10px;"><?php if ($locaciones->id_locacion->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($locaciones->id_locacion->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($locaciones->id_empresa->Visible) { // id_empresa ?>
	<?php if ($locaciones->SortUrl($locaciones->id_empresa) == "") { ?>
		<td>Id Empresa</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $locaciones->SortUrl($locaciones->id_empresa) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id Empresa</td><td style="width: 10px;"><?php if ($locaciones->id_empresa->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($locaciones->id_empresa->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($locaciones->nombre->Visible) { // nombre ?>
	<?php if ($locaciones->SortUrl($locaciones->nombre) == "") { ?>
		<td>Nombre</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $locaciones->SortUrl($locaciones->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nombre&nbsp;(*)</td><td style="width: 10px;"><?php if ($locaciones->nombre->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($locaciones->nombre->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($locaciones->notas->Visible) { // notas ?>
	<?php if ($locaciones->SortUrl($locaciones->notas) == "") { ?>
		<td>Notas</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $locaciones->SortUrl($locaciones->notas) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Notas&nbsp;(*)</td><td style="width: 10px;"><?php if ($locaciones->notas->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($locaciones->notas->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($locaciones->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="arenas" onclick="locaciones_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($locaciones_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($locaciones->ExportAll && $locaciones->Export <> "") {
	$locaciones_list->lStopRec = $locaciones_list->lTotalRecs;
} else {
	$locaciones_list->lStopRec = $locaciones_list->lStartRec + $locaciones_list->lDisplayRecs - 1; // Set the last record to display
}
$locaciones_list->lRecCount = $locaciones_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$locaciones->SelectLimit && $locaciones_list->lStartRec > 1)
		$rs->Move($locaciones_list->lStartRec - 1);
}
$locaciones_list->lRowCnt = 0;
while (($locaciones->CurrentAction == "gridadd" || !$rs->EOF) &&
	$locaciones_list->lRecCount < $locaciones_list->lStopRec) {
	$locaciones_list->lRecCount++;
	if (intval($locaciones_list->lRecCount) >= intval($locaciones_list->lStartRec)) {
		$locaciones_list->lRowCnt++;

	// Init row class and style
	$locaciones->CssClass = "";
	$locaciones->CssStyle = "";
	$locaciones->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($locaciones->CurrentAction == "gridadd") {
		$locaciones_list->LoadDefaultValues(); // Load default values
	} else {
		$locaciones_list->LoadRowValues($rs); // Load row values
	}
	$locaciones->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$locaciones_list->RenderRow();
?>
	<tr<?php echo $locaciones->RowAttributes() ?>>
	<?php if ($locaciones->id_locacion->Visible) { // id_locacion ?>
		<td<?php echo $locaciones->id_locacion->CellAttributes() ?>>
<div<?php echo $locaciones->id_locacion->ViewAttributes() ?>><?php echo $locaciones->id_locacion->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($locaciones->id_empresa->Visible) { // id_empresa ?>
		<td<?php echo $locaciones->id_empresa->CellAttributes() ?>>
<div<?php echo $locaciones->id_empresa->ViewAttributes() ?>><?php echo $locaciones->id_empresa->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($locaciones->nombre->Visible) { // nombre ?>
		<td<?php echo $locaciones->nombre->CellAttributes() ?>>
<div<?php echo $locaciones->nombre->ViewAttributes() ?>><?php echo $locaciones->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($locaciones->notas->Visible) { // notas ?>
		<td<?php echo $locaciones->notas->CellAttributes() ?>>
<div<?php echo $locaciones->notas->ViewAttributes() ?>><?php echo $locaciones->notas->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($locaciones->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $locaciones->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $locaciones->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $locaciones->CopyUrl() ?>"><img src='images/copy.gif' alt='Copy' title='Copy' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="ingresoslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=locaciones&id_locacion=<?php echo urlencode(strval($locaciones->id_locacion->CurrentValue)) ?>">Ingresos</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="egresoslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=locaciones&id_locacion=<?php echo urlencode(strval($locaciones->id_locacion->CurrentValue)) ?>">Egresos</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($locaciones->id_locacion->CurrentValue) ?>" class="arenas" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($locaciones_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($locaciones->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($locaciones_list->lTotalRecs > 0) { ?>
<?php if ($locaciones->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($locaciones->CurrentAction <> "gridadd" && $locaciones->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($locaciones_list->Pager)) $locaciones_list->Pager = new cPrevNextPager($locaciones_list->lStartRec, $locaciones_list->lDisplayRecs, $locaciones_list->lTotalRecs) ?>
<?php if ($locaciones_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($locaciones_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_list->PageUrl() ?>start=<?php echo $locaciones_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($locaciones_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_list->PageUrl() ?>start=<?php echo $locaciones_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $locaciones_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($locaciones_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_list->PageUrl() ?>start=<?php echo $locaciones_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($locaciones_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $locaciones_list->PageUrl() ?>start=<?php echo $locaciones_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $locaciones_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $locaciones_list->Pager->FromIndex ?> a <?php echo $locaciones_list->Pager->ToIndex ?> de <?php echo $locaciones_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($locaciones_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($locaciones_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="locaciones">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($locaciones_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($locaciones_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($locaciones_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($locaciones_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($locaciones_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($locaciones_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($locaciones->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($locaciones_list->lTotalRecs > 0) { ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $locaciones->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($locaciones_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.flocacioneslist)) alert('No se seleccionaron registros'); else {document.flocacioneslist.action='locacionesdelete.php';document.flocacioneslist.encoding='application/x-www-form-urlencoded';document.flocacioneslist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($locaciones->Export == "" && $locaciones->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(locaciones_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($locaciones->Export == "") { ?>
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
class clocaciones_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'locaciones';

	// Page Object Name
	var $PageObjName = 'locaciones_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $locaciones;
		if ($locaciones->UseTokenInUrl) $PageUrl .= "t=" . $locaciones->TableVar . "&"; // add page token
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
		global $objForm, $locaciones;
		if ($locaciones->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($locaciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($locaciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clocaciones_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["locaciones"] = new clocaciones();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'locaciones', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $locaciones;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$locaciones->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $locaciones->Export; // Get export parameter, used in header
	$gsExportFile = $locaciones->TableVar; // Get export file, used in header
	if ($locaciones->Export == "print" || $locaciones->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($locaciones->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($locaciones->Export == "word") {
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
		global $objForm, $gsSearchError, $Security, $locaciones;
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
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page dynamically
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($locaciones->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $locaciones->getRecordsPerPage(); // Restore from Session
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
		$locaciones->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$locaciones->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$locaciones->setStartRecordNumber($this->lStartRec);
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
		$locaciones->setSessionWhere($sFilter);
		$locaciones->CurrentFilter = "";

		// Export data only
		if (in_array($locaciones->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $locaciones;
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
			$locaciones->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$locaciones->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $locaciones;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $locaciones->nombre->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $locaciones->notas->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $locaciones;
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
			$locaciones->setBasicSearchKeyword($sSearchKeyword);
			$locaciones->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $locaciones;
		$this->sSrchWhere = "";
		$locaciones->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $locaciones;
		$locaciones->setBasicSearchKeyword("");
		$locaciones->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $locaciones;
		$this->sSrchWhere = $locaciones->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $locaciones;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$locaciones->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$locaciones->CurrentOrderType = @$_GET["ordertype"];
			$locaciones->UpdateSort($locaciones->id_locacion); // Field 
			$locaciones->UpdateSort($locaciones->id_empresa); // Field 
			$locaciones->UpdateSort($locaciones->nombre); // Field 
			$locaciones->UpdateSort($locaciones->notas); // Field 
			$locaciones->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $locaciones;
		$sOrderBy = $locaciones->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($locaciones->SqlOrderBy() <> "") {
				$sOrderBy = $locaciones->SqlOrderBy();
				$locaciones->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $locaciones;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$locaciones->setSessionOrderBy($sOrderBy);
				$locaciones->id_locacion->setSort("");
				$locaciones->id_empresa->setSort("");
				$locaciones->nombre->setSort("");
				$locaciones->notas->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$locaciones->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $locaciones;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$locaciones->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$locaciones->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $locaciones->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$locaciones->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$locaciones->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$locaciones->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $locaciones;

		// Call Recordset Selecting event
		$locaciones->Recordset_Selecting($locaciones->CurrentFilter);

		// Load list page SQL
		$sSql = $locaciones->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$locaciones->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $locaciones;
		$sFilter = $locaciones->KeyFilter();

		// Call Row Selecting event
		$locaciones->Row_Selecting($sFilter);

		// Load sql based on filter
		$locaciones->CurrentFilter = $sFilter;
		$sSql = $locaciones->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$locaciones->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $locaciones;
		$locaciones->id_locacion->setDbValue($rs->fields('id_locacion'));
		$locaciones->id_empresa->setDbValue($rs->fields('id_empresa'));
		$locaciones->nombre->setDbValue($rs->fields('nombre'));
		$locaciones->notas->setDbValue($rs->fields('notas'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $locaciones;

		// Call Row_Rendering event
		$locaciones->Row_Rendering();

		// Common render codes for all row types
		// id_locacion

		$locaciones->id_locacion->CellCssStyle = "";
		$locaciones->id_locacion->CellCssClass = "";

		// id_empresa
		$locaciones->id_empresa->CellCssStyle = "";
		$locaciones->id_empresa->CellCssClass = "";

		// nombre
		$locaciones->nombre->CellCssStyle = "";
		$locaciones->nombre->CellCssClass = "";

		// notas
		$locaciones->notas->CellCssStyle = "";
		$locaciones->notas->CellCssClass = "";
		if ($locaciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_locacion
			$locaciones->id_locacion->ViewValue = $locaciones->id_locacion->CurrentValue;
			$locaciones->id_locacion->CssStyle = "";
			$locaciones->id_locacion->CssClass = "";
			$locaciones->id_locacion->ViewCustomAttributes = "";

			// id_empresa
			if (strval($locaciones->id_empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($locaciones->id_empresa->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$locaciones->id_empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$locaciones->id_empresa->ViewValue = $locaciones->id_empresa->CurrentValue;
				}
			} else {
				$locaciones->id_empresa->ViewValue = NULL;
			}
			$locaciones->id_empresa->CssStyle = "";
			$locaciones->id_empresa->CssClass = "";
			$locaciones->id_empresa->ViewCustomAttributes = "";

			// nombre
			$locaciones->nombre->ViewValue = $locaciones->nombre->CurrentValue;
			$locaciones->nombre->CssStyle = "";
			$locaciones->nombre->CssClass = "";
			$locaciones->nombre->ViewCustomAttributes = "";

			// notas
			$locaciones->notas->ViewValue = $locaciones->notas->CurrentValue;
			$locaciones->notas->CssStyle = "";
			$locaciones->notas->CssClass = "";
			$locaciones->notas->ViewCustomAttributes = "";

			// id_locacion
			$locaciones->id_locacion->HrefValue = "";

			// id_empresa
			$locaciones->id_empresa->HrefValue = "";

			// nombre
			$locaciones->nombre->HrefValue = "";

			// notas
			$locaciones->notas->HrefValue = "";
		}

		// Call Row Rendered event
		$locaciones->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $locaciones;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($locaciones->ExportAll) {
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
		if ($locaciones->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($locaciones->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $locaciones->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id_locacion', $locaciones->Export);
				ew_ExportAddValue($sExportStr, 'id_empresa', $locaciones->Export);
				ew_ExportAddValue($sExportStr, 'nombre', $locaciones->Export);
				ew_ExportAddValue($sExportStr, 'notas', $locaciones->Export);
				echo ew_ExportLine($sExportStr, $locaciones->Export);
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
				$locaciones->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($locaciones->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id_locacion', $locaciones->id_locacion->CurrentValue);
					$XmlDoc->AddField('id_empresa', $locaciones->id_empresa->CurrentValue);
					$XmlDoc->AddField('nombre', $locaciones->nombre->CurrentValue);
					$XmlDoc->AddField('notas', $locaciones->notas->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $locaciones->Export <> "csv") { // Vertical format
						echo ew_ExportField('id_locacion', $locaciones->id_locacion->ExportValue($locaciones->Export, $locaciones->ExportOriginalValue), $locaciones->Export);
						echo ew_ExportField('id_empresa', $locaciones->id_empresa->ExportValue($locaciones->Export, $locaciones->ExportOriginalValue), $locaciones->Export);
						echo ew_ExportField('nombre', $locaciones->nombre->ExportValue($locaciones->Export, $locaciones->ExportOriginalValue), $locaciones->Export);
						echo ew_ExportField('notas', $locaciones->notas->ExportValue($locaciones->Export, $locaciones->ExportOriginalValue), $locaciones->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $locaciones->id_locacion->ExportValue($locaciones->Export, $locaciones->ExportOriginalValue), $locaciones->Export);
						ew_ExportAddValue($sExportStr, $locaciones->id_empresa->ExportValue($locaciones->Export, $locaciones->ExportOriginalValue), $locaciones->Export);
						ew_ExportAddValue($sExportStr, $locaciones->nombre->ExportValue($locaciones->Export, $locaciones->ExportOriginalValue), $locaciones->Export);
						ew_ExportAddValue($sExportStr, $locaciones->notas->ExportValue($locaciones->Export, $locaciones->ExportOriginalValue), $locaciones->Export);
						echo ew_ExportLine($sExportStr, $locaciones->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($locaciones->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($locaciones->Export);
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
