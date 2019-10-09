<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "ingresos_tiposinfo.php" ?>
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
$ingresos_tipos_list = new cingresos_tipos_list();
$Page =& $ingresos_tipos_list;

// Page init processing
$ingresos_tipos_list->Page_Init();

// Page main processing
$ingresos_tipos_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($ingresos_tipos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var ingresos_tipos_list = new ew_Page("ingresos_tipos_list");

// page properties
ingresos_tipos_list.PageID = "list"; // page ID
var EW_PAGE_ID = ingresos_tipos_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
ingresos_tipos_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
ingresos_tipos_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
ingresos_tipos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
ingresos_tipos_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($ingresos_tipos->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($ingresos_tipos->Export == "" && $ingresos_tipos->SelectLimit);
	if (!$bSelectLimit)
		$rs = $ingresos_tipos_list->LoadRecordset();
	$ingresos_tipos_list->lTotalRecs = ($bSelectLimit) ? $ingresos_tipos->SelectRecordCount() : $rs->RecordCount();
	$ingresos_tipos_list->lStartRec = 1;
	if ($ingresos_tipos_list->lDisplayRecs <= 0) // Display all records
		$ingresos_tipos_list->lDisplayRecs = $ingresos_tipos_list->lTotalRecs;
	if (!($ingresos_tipos->ExportAll && $ingresos_tipos->Export <> ""))
		$ingresos_tipos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $ingresos_tipos_list->LoadRecordset($ingresos_tipos_list->lStartRec-1, $ingresos_tipos_list->lDisplayRecs);
?>
<p><span class="arenas" style="white-space: nowrap;">Modulo: Ingresos Tipos
<?php if ($ingresos_tipos->Export == "" && $ingresos_tipos->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $ingresos_tipos_list->PageUrl() ?>export=print"><img src='images/print.gif' alt='Printer Friendly' title='Printer Friendly' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $ingresos_tipos_list->PageUrl() ?>export=excel"><img src='images/exportxls.gif' alt='Export to Excel' title='Export to Excel' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $ingresos_tipos_list->PageUrl() ?>export=word"><img src='images/exportdoc.gif' alt='Export to Word' title='Export to Word' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($ingresos_tipos->Export == "" && $ingresos_tipos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(ingresos_tipos_list);" style="text-decoration: none;"><img id="ingresos_tipos_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="arenas">&nbsp;Buscar</span><br>
<div id="ingresos_tipos_list_SearchPanel">
<form name="fingresos_tiposlistsrch" id="fingresos_tiposlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="ingresos_tipos">
<table class="ewBasicSearch">
	<tr>
		<td><span class="arenas">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($ingresos_tipos->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Buscar (*)">&nbsp;
			<a href="<?php echo $ingresos_tipos_list->PageUrl() ?>cmd=reset">Mostrar todos</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="arenas"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($ingresos_tipos->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Frase exacta</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($ingresos_tipos->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>Todas las palabras</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($ingresos_tipos->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Cualquier palabra</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $ingresos_tipos_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($ingresos_tipos->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($ingresos_tipos->CurrentAction <> "gridadd" && $ingresos_tipos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($ingresos_tipos_list->Pager)) $ingresos_tipos_list->Pager = new cPrevNextPager($ingresos_tipos_list->lStartRec, $ingresos_tipos_list->lDisplayRecs, $ingresos_tipos_list->lTotalRecs) ?>
<?php if ($ingresos_tipos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($ingresos_tipos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_tipos_list->PageUrl() ?>start=<?php echo $ingresos_tipos_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($ingresos_tipos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_tipos_list->PageUrl() ?>start=<?php echo $ingresos_tipos_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $ingresos_tipos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($ingresos_tipos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_tipos_list->PageUrl() ?>start=<?php echo $ingresos_tipos_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($ingresos_tipos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_tipos_list->PageUrl() ?>start=<?php echo $ingresos_tipos_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $ingresos_tipos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $ingresos_tipos_list->Pager->FromIndex ?> a <?php echo $ingresos_tipos_list->Pager->ToIndex ?> de <?php echo $ingresos_tipos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($ingresos_tipos_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($ingresos_tipos_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="ingresos_tipos">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($ingresos_tipos_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($ingresos_tipos_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($ingresos_tipos_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($ingresos_tipos_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($ingresos_tipos_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($ingresos_tipos_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($ingresos_tipos->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $ingresos_tipos->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($ingresos_tipos_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fingresos_tiposlist)) alert('No se seleccionaron registros'); else {document.fingresos_tiposlist.action='ingresos_tiposdelete.php';document.fingresos_tiposlist.encoding='application/x-www-form-urlencoded';document.fingresos_tiposlist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fingresos_tiposlist" id="fingresos_tiposlist" class="ewForm" action="" method="post">
<?php if ($ingresos_tipos_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$ingresos_tipos_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$ingresos_tipos_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$ingresos_tipos_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$ingresos_tipos_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$ingresos_tipos_list->lOptionCnt++; // Multi-select
}
	$ingresos_tipos_list->lOptionCnt += count($ingresos_tipos_list->ListOptions->Items); // Custom list options
?>
<?php echo $ingresos_tipos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($ingresos_tipos->id_ingresos->Visible) { // id_ingresos ?>
	<?php if ($ingresos_tipos->SortUrl($ingresos_tipos->id_ingresos) == "") { ?>
		<td>Id Ingresos</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos_tipos->SortUrl($ingresos_tipos->id_ingresos) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id Ingresos</td><td style="width: 10px;"><?php if ($ingresos_tipos->id_ingresos->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos_tipos->id_ingresos->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos_tipos->nombre->Visible) { // nombre ?>
	<?php if ($ingresos_tipos->SortUrl($ingresos_tipos->nombre) == "") { ?>
		<td>Nombre</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ingresos_tipos->SortUrl($ingresos_tipos->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nombre&nbsp;(*)</td><td style="width: 10px;"><?php if ($ingresos_tipos->nombre->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ingresos_tipos->nombre->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($ingresos_tipos->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="arenas" onclick="ingresos_tipos_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($ingresos_tipos_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($ingresos_tipos->ExportAll && $ingresos_tipos->Export <> "") {
	$ingresos_tipos_list->lStopRec = $ingresos_tipos_list->lTotalRecs;
} else {
	$ingresos_tipos_list->lStopRec = $ingresos_tipos_list->lStartRec + $ingresos_tipos_list->lDisplayRecs - 1; // Set the last record to display
}
$ingresos_tipos_list->lRecCount = $ingresos_tipos_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$ingresos_tipos->SelectLimit && $ingresos_tipos_list->lStartRec > 1)
		$rs->Move($ingresos_tipos_list->lStartRec - 1);
}
$ingresos_tipos_list->lRowCnt = 0;
while (($ingresos_tipos->CurrentAction == "gridadd" || !$rs->EOF) &&
	$ingresos_tipos_list->lRecCount < $ingresos_tipos_list->lStopRec) {
	$ingresos_tipos_list->lRecCount++;
	if (intval($ingresos_tipos_list->lRecCount) >= intval($ingresos_tipos_list->lStartRec)) {
		$ingresos_tipos_list->lRowCnt++;

	// Init row class and style
	$ingresos_tipos->CssClass = "";
	$ingresos_tipos->CssStyle = "";
	$ingresos_tipos->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($ingresos_tipos->CurrentAction == "gridadd") {
		$ingresos_tipos_list->LoadDefaultValues(); // Load default values
	} else {
		$ingresos_tipos_list->LoadRowValues($rs); // Load row values
	}
	$ingresos_tipos->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$ingresos_tipos_list->RenderRow();
?>
	<tr<?php echo $ingresos_tipos->RowAttributes() ?>>
	<?php if ($ingresos_tipos->id_ingresos->Visible) { // id_ingresos ?>
		<td<?php echo $ingresos_tipos->id_ingresos->CellAttributes() ?>>
<div<?php echo $ingresos_tipos->id_ingresos->ViewAttributes() ?>><?php echo $ingresos_tipos->id_ingresos->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($ingresos_tipos->nombre->Visible) { // nombre ?>
		<td<?php echo $ingresos_tipos->nombre->CellAttributes() ?>>
<div<?php echo $ingresos_tipos->nombre->ViewAttributes() ?>><?php echo $ingresos_tipos->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($ingresos_tipos->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $ingresos_tipos->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $ingresos_tipos->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $ingresos_tipos->CopyUrl() ?>"><img src='images/copy.gif' alt='Copy' title='Copy' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($ingresos_tipos->id_ingresos->CurrentValue) ?>" class="arenas" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($ingresos_tipos_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($ingresos_tipos->CurrentAction <> "gridadd")
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
<?php if ($ingresos_tipos_list->lTotalRecs > 0) { ?>
<?php if ($ingresos_tipos->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($ingresos_tipos->CurrentAction <> "gridadd" && $ingresos_tipos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($ingresos_tipos_list->Pager)) $ingresos_tipos_list->Pager = new cPrevNextPager($ingresos_tipos_list->lStartRec, $ingresos_tipos_list->lDisplayRecs, $ingresos_tipos_list->lTotalRecs) ?>
<?php if ($ingresos_tipos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($ingresos_tipos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_tipos_list->PageUrl() ?>start=<?php echo $ingresos_tipos_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($ingresos_tipos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_tipos_list->PageUrl() ?>start=<?php echo $ingresos_tipos_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $ingresos_tipos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($ingresos_tipos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_tipos_list->PageUrl() ?>start=<?php echo $ingresos_tipos_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($ingresos_tipos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $ingresos_tipos_list->PageUrl() ?>start=<?php echo $ingresos_tipos_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $ingresos_tipos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $ingresos_tipos_list->Pager->FromIndex ?> a <?php echo $ingresos_tipos_list->Pager->ToIndex ?> de <?php echo $ingresos_tipos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($ingresos_tipos_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($ingresos_tipos_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="ingresos_tipos">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($ingresos_tipos_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($ingresos_tipos_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($ingresos_tipos_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($ingresos_tipos_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($ingresos_tipos_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($ingresos_tipos_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($ingresos_tipos->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($ingresos_tipos_list->lTotalRecs > 0) { ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $ingresos_tipos->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($ingresos_tipos_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fingresos_tiposlist)) alert('No se seleccionaron registros'); else {document.fingresos_tiposlist.action='ingresos_tiposdelete.php';document.fingresos_tiposlist.encoding='application/x-www-form-urlencoded';document.fingresos_tiposlist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($ingresos_tipos->Export == "" && $ingresos_tipos->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(ingresos_tipos_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($ingresos_tipos->Export == "") { ?>
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
class cingresos_tipos_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'ingresos_tipos';

	// Page Object Name
	var $PageObjName = 'ingresos_tipos_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $ingresos_tipos;
		if ($ingresos_tipos->UseTokenInUrl) $PageUrl .= "t=" . $ingresos_tipos->TableVar . "&"; // add page token
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
		global $objForm, $ingresos_tipos;
		if ($ingresos_tipos->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($ingresos_tipos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($ingresos_tipos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cingresos_tipos_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["ingresos_tipos"] = new cingresos_tipos();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'ingresos_tipos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $ingresos_tipos;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$ingresos_tipos->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $ingresos_tipos->Export; // Get export parameter, used in header
	$gsExportFile = $ingresos_tipos->TableVar; // Get export file, used in header
	if ($ingresos_tipos->Export == "print" || $ingresos_tipos->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($ingresos_tipos->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($ingresos_tipos->Export == "word") {
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
		global $objForm, $gsSearchError, $Security, $ingresos_tipos;
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
		if ($ingresos_tipos->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $ingresos_tipos->getRecordsPerPage(); // Restore from Session
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
		$ingresos_tipos->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$ingresos_tipos->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$ingresos_tipos->setStartRecordNumber($this->lStartRec);
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
		$ingresos_tipos->setSessionWhere($sFilter);
		$ingresos_tipos->CurrentFilter = "";

		// Export data only
		if (in_array($ingresos_tipos->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $ingresos_tipos;
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
			$ingresos_tipos->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$ingresos_tipos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $ingresos_tipos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $ingresos_tipos->nombre->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $ingresos_tipos;
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
			$ingresos_tipos->setBasicSearchKeyword($sSearchKeyword);
			$ingresos_tipos->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $ingresos_tipos;
		$this->sSrchWhere = "";
		$ingresos_tipos->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $ingresos_tipos;
		$ingresos_tipos->setBasicSearchKeyword("");
		$ingresos_tipos->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $ingresos_tipos;
		$this->sSrchWhere = $ingresos_tipos->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $ingresos_tipos;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$ingresos_tipos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$ingresos_tipos->CurrentOrderType = @$_GET["ordertype"];
			$ingresos_tipos->UpdateSort($ingresos_tipos->id_ingresos); // Field 
			$ingresos_tipos->UpdateSort($ingresos_tipos->nombre); // Field 
			$ingresos_tipos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $ingresos_tipos;
		$sOrderBy = $ingresos_tipos->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($ingresos_tipos->SqlOrderBy() <> "") {
				$sOrderBy = $ingresos_tipos->SqlOrderBy();
				$ingresos_tipos->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $ingresos_tipos;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$ingresos_tipos->setSessionOrderBy($sOrderBy);
				$ingresos_tipos->id_ingresos->setSort("");
				$ingresos_tipos->nombre->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$ingresos_tipos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $ingresos_tipos;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$ingresos_tipos->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$ingresos_tipos->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $ingresos_tipos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$ingresos_tipos->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$ingresos_tipos->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$ingresos_tipos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $ingresos_tipos;

		// Call Recordset Selecting event
		$ingresos_tipos->Recordset_Selecting($ingresos_tipos->CurrentFilter);

		// Load list page SQL
		$sSql = $ingresos_tipos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$ingresos_tipos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $ingresos_tipos;
		$sFilter = $ingresos_tipos->KeyFilter();

		// Call Row Selecting event
		$ingresos_tipos->Row_Selecting($sFilter);

		// Load sql based on filter
		$ingresos_tipos->CurrentFilter = $sFilter;
		$sSql = $ingresos_tipos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$ingresos_tipos->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $ingresos_tipos;
		$ingresos_tipos->id_ingresos->setDbValue($rs->fields('id_ingresos'));
		$ingresos_tipos->nombre->setDbValue($rs->fields('nombre'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $ingresos_tipos;

		// Call Row_Rendering event
		$ingresos_tipos->Row_Rendering();

		// Common render codes for all row types
		// id_ingresos

		$ingresos_tipos->id_ingresos->CellCssStyle = "";
		$ingresos_tipos->id_ingresos->CellCssClass = "";

		// nombre
		$ingresos_tipos->nombre->CellCssStyle = "";
		$ingresos_tipos->nombre->CellCssClass = "";
		if ($ingresos_tipos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_ingresos
			$ingresos_tipos->id_ingresos->ViewValue = $ingresos_tipos->id_ingresos->CurrentValue;
			$ingresos_tipos->id_ingresos->CssStyle = "";
			$ingresos_tipos->id_ingresos->CssClass = "";
			$ingresos_tipos->id_ingresos->ViewCustomAttributes = "";

			// nombre
			$ingresos_tipos->nombre->ViewValue = $ingresos_tipos->nombre->CurrentValue;
			$ingresos_tipos->nombre->CssStyle = "";
			$ingresos_tipos->nombre->CssClass = "";
			$ingresos_tipos->nombre->ViewCustomAttributes = "";

			// id_ingresos
			$ingresos_tipos->id_ingresos->HrefValue = "";

			// nombre
			$ingresos_tipos->nombre->HrefValue = "";
		}

		// Call Row Rendered event
		$ingresos_tipos->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $ingresos_tipos;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($ingresos_tipos->ExportAll) {
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
		if ($ingresos_tipos->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($ingresos_tipos->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $ingresos_tipos->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id_ingresos', $ingresos_tipos->Export);
				ew_ExportAddValue($sExportStr, 'nombre', $ingresos_tipos->Export);
				echo ew_ExportLine($sExportStr, $ingresos_tipos->Export);
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
				$ingresos_tipos->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($ingresos_tipos->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id_ingresos', $ingresos_tipos->id_ingresos->CurrentValue);
					$XmlDoc->AddField('nombre', $ingresos_tipos->nombre->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $ingresos_tipos->Export <> "csv") { // Vertical format
						echo ew_ExportField('id_ingresos', $ingresos_tipos->id_ingresos->ExportValue($ingresos_tipos->Export, $ingresos_tipos->ExportOriginalValue), $ingresos_tipos->Export);
						echo ew_ExportField('nombre', $ingresos_tipos->nombre->ExportValue($ingresos_tipos->Export, $ingresos_tipos->ExportOriginalValue), $ingresos_tipos->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $ingresos_tipos->id_ingresos->ExportValue($ingresos_tipos->Export, $ingresos_tipos->ExportOriginalValue), $ingresos_tipos->Export);
						ew_ExportAddValue($sExportStr, $ingresos_tipos->nombre->ExportValue($ingresos_tipos->Export, $ingresos_tipos->ExportOriginalValue), $ingresos_tipos->Export);
						echo ew_ExportLine($sExportStr, $ingresos_tipos->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($ingresos_tipos->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($ingresos_tipos->Export);
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
