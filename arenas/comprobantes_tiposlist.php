<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "comprobantes_tiposinfo.php" ?>
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
$comprobantes_tipos_list = new ccomprobantes_tipos_list();
$Page =& $comprobantes_tipos_list;

// Page init processing
$comprobantes_tipos_list->Page_Init();

// Page main processing
$comprobantes_tipos_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($comprobantes_tipos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var comprobantes_tipos_list = new ew_Page("comprobantes_tipos_list");

// page properties
comprobantes_tipos_list.PageID = "list"; // page ID
var EW_PAGE_ID = comprobantes_tipos_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
comprobantes_tipos_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
comprobantes_tipos_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
comprobantes_tipos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
comprobantes_tipos_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($comprobantes_tipos->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($comprobantes_tipos->Export == "" && $comprobantes_tipos->SelectLimit);
	if (!$bSelectLimit)
		$rs = $comprobantes_tipos_list->LoadRecordset();
	$comprobantes_tipos_list->lTotalRecs = ($bSelectLimit) ? $comprobantes_tipos->SelectRecordCount() : $rs->RecordCount();
	$comprobantes_tipos_list->lStartRec = 1;
	if ($comprobantes_tipos_list->lDisplayRecs <= 0) // Display all records
		$comprobantes_tipos_list->lDisplayRecs = $comprobantes_tipos_list->lTotalRecs;
	if (!($comprobantes_tipos->ExportAll && $comprobantes_tipos->Export <> ""))
		$comprobantes_tipos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $comprobantes_tipos_list->LoadRecordset($comprobantes_tipos_list->lStartRec-1, $comprobantes_tipos_list->lDisplayRecs);
?>
<p><span class="arenas" style="white-space: nowrap;">Modulo: Comprobantes Tipos
<?php if ($comprobantes_tipos->Export == "" && $comprobantes_tipos->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $comprobantes_tipos_list->PageUrl() ?>export=print"><img src='images/print.gif' alt='Printer Friendly' title='Printer Friendly' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $comprobantes_tipos_list->PageUrl() ?>export=excel"><img src='images/exportxls.gif' alt='Export to Excel' title='Export to Excel' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $comprobantes_tipos_list->PageUrl() ?>export=word"><img src='images/exportdoc.gif' alt='Export to Word' title='Export to Word' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($comprobantes_tipos->Export == "" && $comprobantes_tipos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(comprobantes_tipos_list);" style="text-decoration: none;"><img id="comprobantes_tipos_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="arenas">&nbsp;Buscar</span><br>
<div id="comprobantes_tipos_list_SearchPanel">
<form name="fcomprobantes_tiposlistsrch" id="fcomprobantes_tiposlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="comprobantes_tipos">
<table class="ewBasicSearch">
	<tr>
		<td><span class="arenas">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($comprobantes_tipos->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Buscar (*)">&nbsp;
			<a href="<?php echo $comprobantes_tipos_list->PageUrl() ?>cmd=reset">Mostrar todos</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="arenas"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($comprobantes_tipos->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Frase exacta</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($comprobantes_tipos->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>Todas las palabras</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($comprobantes_tipos->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Cualquier palabra</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $comprobantes_tipos_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($comprobantes_tipos->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($comprobantes_tipos->CurrentAction <> "gridadd" && $comprobantes_tipos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($comprobantes_tipos_list->Pager)) $comprobantes_tipos_list->Pager = new cPrevNextPager($comprobantes_tipos_list->lStartRec, $comprobantes_tipos_list->lDisplayRecs, $comprobantes_tipos_list->lTotalRecs) ?>
<?php if ($comprobantes_tipos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($comprobantes_tipos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_list->PageUrl() ?>start=<?php echo $comprobantes_tipos_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($comprobantes_tipos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_list->PageUrl() ?>start=<?php echo $comprobantes_tipos_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $comprobantes_tipos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($comprobantes_tipos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_list->PageUrl() ?>start=<?php echo $comprobantes_tipos_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($comprobantes_tipos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_list->PageUrl() ?>start=<?php echo $comprobantes_tipos_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $comprobantes_tipos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $comprobantes_tipos_list->Pager->FromIndex ?> a <?php echo $comprobantes_tipos_list->Pager->ToIndex ?> de <?php echo $comprobantes_tipos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($comprobantes_tipos_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($comprobantes_tipos_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="comprobantes_tipos">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($comprobantes_tipos_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($comprobantes_tipos_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($comprobantes_tipos_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($comprobantes_tipos_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($comprobantes_tipos_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($comprobantes_tipos_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($comprobantes_tipos->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $comprobantes_tipos->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($comprobantes_tipos_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fcomprobantes_tiposlist)) alert('No se seleccionaron registros'); else {document.fcomprobantes_tiposlist.action='comprobantes_tiposdelete.php';document.fcomprobantes_tiposlist.encoding='application/x-www-form-urlencoded';document.fcomprobantes_tiposlist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fcomprobantes_tiposlist" id="fcomprobantes_tiposlist" class="ewForm" action="" method="post">
<?php if ($comprobantes_tipos_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$comprobantes_tipos_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$comprobantes_tipos_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$comprobantes_tipos_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$comprobantes_tipos_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$comprobantes_tipos_list->lOptionCnt++; // Multi-select
}
	$comprobantes_tipos_list->lOptionCnt += count($comprobantes_tipos_list->ListOptions->Items); // Custom list options
?>
<?php echo $comprobantes_tipos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($comprobantes_tipos->id_comprobante->Visible) { // id_comprobante ?>
	<?php if ($comprobantes_tipos->SortUrl($comprobantes_tipos->id_comprobante) == "") { ?>
		<td>Id Comprobante</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $comprobantes_tipos->SortUrl($comprobantes_tipos->id_comprobante) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id Comprobante</td><td style="width: 10px;"><?php if ($comprobantes_tipos->id_comprobante->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($comprobantes_tipos->id_comprobante->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($comprobantes_tipos->nombre_tipo->Visible) { // nombre_tipo ?>
	<?php if ($comprobantes_tipos->SortUrl($comprobantes_tipos->nombre_tipo) == "") { ?>
		<td>Nombre Tipo</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $comprobantes_tipos->SortUrl($comprobantes_tipos->nombre_tipo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nombre Tipo&nbsp;(*)</td><td style="width: 10px;"><?php if ($comprobantes_tipos->nombre_tipo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($comprobantes_tipos->nombre_tipo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($comprobantes_tipos->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="arenas" onclick="comprobantes_tipos_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($comprobantes_tipos_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($comprobantes_tipos->ExportAll && $comprobantes_tipos->Export <> "") {
	$comprobantes_tipos_list->lStopRec = $comprobantes_tipos_list->lTotalRecs;
} else {
	$comprobantes_tipos_list->lStopRec = $comprobantes_tipos_list->lStartRec + $comprobantes_tipos_list->lDisplayRecs - 1; // Set the last record to display
}
$comprobantes_tipos_list->lRecCount = $comprobantes_tipos_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$comprobantes_tipos->SelectLimit && $comprobantes_tipos_list->lStartRec > 1)
		$rs->Move($comprobantes_tipos_list->lStartRec - 1);
}
$comprobantes_tipos_list->lRowCnt = 0;
while (($comprobantes_tipos->CurrentAction == "gridadd" || !$rs->EOF) &&
	$comprobantes_tipos_list->lRecCount < $comprobantes_tipos_list->lStopRec) {
	$comprobantes_tipos_list->lRecCount++;
	if (intval($comprobantes_tipos_list->lRecCount) >= intval($comprobantes_tipos_list->lStartRec)) {
		$comprobantes_tipos_list->lRowCnt++;

	// Init row class and style
	$comprobantes_tipos->CssClass = "";
	$comprobantes_tipos->CssStyle = "";
	$comprobantes_tipos->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($comprobantes_tipos->CurrentAction == "gridadd") {
		$comprobantes_tipos_list->LoadDefaultValues(); // Load default values
	} else {
		$comprobantes_tipos_list->LoadRowValues($rs); // Load row values
	}
	$comprobantes_tipos->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$comprobantes_tipos_list->RenderRow();
?>
	<tr<?php echo $comprobantes_tipos->RowAttributes() ?>>
	<?php if ($comprobantes_tipos->id_comprobante->Visible) { // id_comprobante ?>
		<td<?php echo $comprobantes_tipos->id_comprobante->CellAttributes() ?>>
<div<?php echo $comprobantes_tipos->id_comprobante->ViewAttributes() ?>><?php echo $comprobantes_tipos->id_comprobante->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($comprobantes_tipos->nombre_tipo->Visible) { // nombre_tipo ?>
		<td<?php echo $comprobantes_tipos->nombre_tipo->CellAttributes() ?>>
<div<?php echo $comprobantes_tipos->nombre_tipo->ViewAttributes() ?>><?php echo $comprobantes_tipos->nombre_tipo->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($comprobantes_tipos->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $comprobantes_tipos->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $comprobantes_tipos->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $comprobantes_tipos->CopyUrl() ?>"><img src='images/copy.gif' alt='Copy' title='Copy' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($comprobantes_tipos->id_comprobante->CurrentValue) ?>" class="arenas" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($comprobantes_tipos_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($comprobantes_tipos->CurrentAction <> "gridadd")
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
<?php if ($comprobantes_tipos_list->lTotalRecs > 0) { ?>
<?php if ($comprobantes_tipos->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($comprobantes_tipos->CurrentAction <> "gridadd" && $comprobantes_tipos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($comprobantes_tipos_list->Pager)) $comprobantes_tipos_list->Pager = new cPrevNextPager($comprobantes_tipos_list->lStartRec, $comprobantes_tipos_list->lDisplayRecs, $comprobantes_tipos_list->lTotalRecs) ?>
<?php if ($comprobantes_tipos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($comprobantes_tipos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_list->PageUrl() ?>start=<?php echo $comprobantes_tipos_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($comprobantes_tipos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_list->PageUrl() ?>start=<?php echo $comprobantes_tipos_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $comprobantes_tipos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($comprobantes_tipos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_list->PageUrl() ?>start=<?php echo $comprobantes_tipos_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($comprobantes_tipos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $comprobantes_tipos_list->PageUrl() ?>start=<?php echo $comprobantes_tipos_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $comprobantes_tipos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $comprobantes_tipos_list->Pager->FromIndex ?> a <?php echo $comprobantes_tipos_list->Pager->ToIndex ?> de <?php echo $comprobantes_tipos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($comprobantes_tipos_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($comprobantes_tipos_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="comprobantes_tipos">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($comprobantes_tipos_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($comprobantes_tipos_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($comprobantes_tipos_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($comprobantes_tipos_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($comprobantes_tipos_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($comprobantes_tipos_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($comprobantes_tipos->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($comprobantes_tipos_list->lTotalRecs > 0) { ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $comprobantes_tipos->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($comprobantes_tipos_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fcomprobantes_tiposlist)) alert('No se seleccionaron registros'); else {document.fcomprobantes_tiposlist.action='comprobantes_tiposdelete.php';document.fcomprobantes_tiposlist.encoding='application/x-www-form-urlencoded';document.fcomprobantes_tiposlist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($comprobantes_tipos->Export == "" && $comprobantes_tipos->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(comprobantes_tipos_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($comprobantes_tipos->Export == "") { ?>
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
class ccomprobantes_tipos_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'comprobantes_tipos';

	// Page Object Name
	var $PageObjName = 'comprobantes_tipos_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $comprobantes_tipos;
		if ($comprobantes_tipos->UseTokenInUrl) $PageUrl .= "t=" . $comprobantes_tipos->TableVar . "&"; // add page token
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
		global $objForm, $comprobantes_tipos;
		if ($comprobantes_tipos->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($comprobantes_tipos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($comprobantes_tipos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccomprobantes_tipos_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["comprobantes_tipos"] = new ccomprobantes_tipos();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'comprobantes_tipos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $comprobantes_tipos;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$comprobantes_tipos->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $comprobantes_tipos->Export; // Get export parameter, used in header
	$gsExportFile = $comprobantes_tipos->TableVar; // Get export file, used in header
	if ($comprobantes_tipos->Export == "print" || $comprobantes_tipos->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($comprobantes_tipos->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($comprobantes_tipos->Export == "word") {
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
		global $objForm, $gsSearchError, $Security, $comprobantes_tipos;
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
		if ($comprobantes_tipos->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $comprobantes_tipos->getRecordsPerPage(); // Restore from Session
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
		$comprobantes_tipos->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$comprobantes_tipos->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$comprobantes_tipos->setStartRecordNumber($this->lStartRec);
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
		$comprobantes_tipos->setSessionWhere($sFilter);
		$comprobantes_tipos->CurrentFilter = "";

		// Export data only
		if (in_array($comprobantes_tipos->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $comprobantes_tipos;
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
			$comprobantes_tipos->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$comprobantes_tipos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $comprobantes_tipos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $comprobantes_tipos->nombre_tipo->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $comprobantes_tipos->descripcion->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $comprobantes_tipos;
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
			$comprobantes_tipos->setBasicSearchKeyword($sSearchKeyword);
			$comprobantes_tipos->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $comprobantes_tipos;
		$this->sSrchWhere = "";
		$comprobantes_tipos->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $comprobantes_tipos;
		$comprobantes_tipos->setBasicSearchKeyword("");
		$comprobantes_tipos->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $comprobantes_tipos;
		$this->sSrchWhere = $comprobantes_tipos->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $comprobantes_tipos;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$comprobantes_tipos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$comprobantes_tipos->CurrentOrderType = @$_GET["ordertype"];
			$comprobantes_tipos->UpdateSort($comprobantes_tipos->id_comprobante); // Field 
			$comprobantes_tipos->UpdateSort($comprobantes_tipos->nombre_tipo); // Field 
			$comprobantes_tipos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $comprobantes_tipos;
		$sOrderBy = $comprobantes_tipos->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($comprobantes_tipos->SqlOrderBy() <> "") {
				$sOrderBy = $comprobantes_tipos->SqlOrderBy();
				$comprobantes_tipos->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $comprobantes_tipos;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$comprobantes_tipos->setSessionOrderBy($sOrderBy);
				$comprobantes_tipos->id_comprobante->setSort("");
				$comprobantes_tipos->nombre_tipo->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$comprobantes_tipos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $comprobantes_tipos;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$comprobantes_tipos->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$comprobantes_tipos->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $comprobantes_tipos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$comprobantes_tipos->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$comprobantes_tipos->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$comprobantes_tipos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $comprobantes_tipos;

		// Call Recordset Selecting event
		$comprobantes_tipos->Recordset_Selecting($comprobantes_tipos->CurrentFilter);

		// Load list page SQL
		$sSql = $comprobantes_tipos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$comprobantes_tipos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $comprobantes_tipos;
		$sFilter = $comprobantes_tipos->KeyFilter();

		// Call Row Selecting event
		$comprobantes_tipos->Row_Selecting($sFilter);

		// Load sql based on filter
		$comprobantes_tipos->CurrentFilter = $sFilter;
		$sSql = $comprobantes_tipos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$comprobantes_tipos->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $comprobantes_tipos;
		$comprobantes_tipos->id_comprobante->setDbValue($rs->fields('id_comprobante'));
		$comprobantes_tipos->nombre_tipo->setDbValue($rs->fields('nombre_tipo'));
		$comprobantes_tipos->descripcion->setDbValue($rs->fields('descripcion'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $comprobantes_tipos;

		// Call Row_Rendering event
		$comprobantes_tipos->Row_Rendering();

		// Common render codes for all row types
		// id_comprobante

		$comprobantes_tipos->id_comprobante->CellCssStyle = "";
		$comprobantes_tipos->id_comprobante->CellCssClass = "";

		// nombre_tipo
		$comprobantes_tipos->nombre_tipo->CellCssStyle = "";
		$comprobantes_tipos->nombre_tipo->CellCssClass = "";
		if ($comprobantes_tipos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_comprobante
			$comprobantes_tipos->id_comprobante->ViewValue = $comprobantes_tipos->id_comprobante->CurrentValue;
			$comprobantes_tipos->id_comprobante->CssStyle = "";
			$comprobantes_tipos->id_comprobante->CssClass = "";
			$comprobantes_tipos->id_comprobante->ViewCustomAttributes = "";

			// nombre_tipo
			$comprobantes_tipos->nombre_tipo->ViewValue = $comprobantes_tipos->nombre_tipo->CurrentValue;
			$comprobantes_tipos->nombre_tipo->CssStyle = "";
			$comprobantes_tipos->nombre_tipo->CssClass = "";
			$comprobantes_tipos->nombre_tipo->ViewCustomAttributes = "";

			// id_comprobante
			$comprobantes_tipos->id_comprobante->HrefValue = "";

			// nombre_tipo
			$comprobantes_tipos->nombre_tipo->HrefValue = "";
		}

		// Call Row Rendered event
		$comprobantes_tipos->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $comprobantes_tipos;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($comprobantes_tipos->ExportAll) {
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
		if ($comprobantes_tipos->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($comprobantes_tipos->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $comprobantes_tipos->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id_comprobante', $comprobantes_tipos->Export);
				ew_ExportAddValue($sExportStr, 'nombre_tipo', $comprobantes_tipos->Export);
				echo ew_ExportLine($sExportStr, $comprobantes_tipos->Export);
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
				$comprobantes_tipos->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($comprobantes_tipos->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id_comprobante', $comprobantes_tipos->id_comprobante->CurrentValue);
					$XmlDoc->AddField('nombre_tipo', $comprobantes_tipos->nombre_tipo->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $comprobantes_tipos->Export <> "csv") { // Vertical format
						echo ew_ExportField('id_comprobante', $comprobantes_tipos->id_comprobante->ExportValue($comprobantes_tipos->Export, $comprobantes_tipos->ExportOriginalValue), $comprobantes_tipos->Export);
						echo ew_ExportField('nombre_tipo', $comprobantes_tipos->nombre_tipo->ExportValue($comprobantes_tipos->Export, $comprobantes_tipos->ExportOriginalValue), $comprobantes_tipos->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $comprobantes_tipos->id_comprobante->ExportValue($comprobantes_tipos->Export, $comprobantes_tipos->ExportOriginalValue), $comprobantes_tipos->Export);
						ew_ExportAddValue($sExportStr, $comprobantes_tipos->nombre_tipo->ExportValue($comprobantes_tipos->Export, $comprobantes_tipos->ExportOriginalValue), $comprobantes_tipos->Export);
						echo ew_ExportLine($sExportStr, $comprobantes_tipos->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($comprobantes_tipos->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($comprobantes_tipos->Export);
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
