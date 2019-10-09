<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "metodos_pagoinfo.php" ?>
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
$metodos_pago_list = new cmetodos_pago_list();
$Page =& $metodos_pago_list;

// Page init processing
$metodos_pago_list->Page_Init();

// Page main processing
$metodos_pago_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($metodos_pago->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var metodos_pago_list = new ew_Page("metodos_pago_list");

// page properties
metodos_pago_list.PageID = "list"; // page ID
var EW_PAGE_ID = metodos_pago_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
metodos_pago_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
metodos_pago_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
metodos_pago_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
metodos_pago_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($metodos_pago->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($metodos_pago->Export == "" && $metodos_pago->SelectLimit);
	if (!$bSelectLimit)
		$rs = $metodos_pago_list->LoadRecordset();
	$metodos_pago_list->lTotalRecs = ($bSelectLimit) ? $metodos_pago->SelectRecordCount() : $rs->RecordCount();
	$metodos_pago_list->lStartRec = 1;
	if ($metodos_pago_list->lDisplayRecs <= 0) // Display all records
		$metodos_pago_list->lDisplayRecs = $metodos_pago_list->lTotalRecs;
	if (!($metodos_pago->ExportAll && $metodos_pago->Export <> ""))
		$metodos_pago_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $metodos_pago_list->LoadRecordset($metodos_pago_list->lStartRec-1, $metodos_pago_list->lDisplayRecs);
?>
<p><span class="arenas" style="white-space: nowrap;">Modulo: Metodos Pago
<?php if ($metodos_pago->Export == "" && $metodos_pago->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $metodos_pago_list->PageUrl() ?>export=print"><img src='images/print.gif' alt='Printer Friendly' title='Printer Friendly' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $metodos_pago_list->PageUrl() ?>export=excel"><img src='images/exportxls.gif' alt='Export to Excel' title='Export to Excel' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $metodos_pago_list->PageUrl() ?>export=word"><img src='images/exportdoc.gif' alt='Export to Word' title='Export to Word' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($metodos_pago->Export == "" && $metodos_pago->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(metodos_pago_list);" style="text-decoration: none;"><img id="metodos_pago_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="arenas">&nbsp;Buscar</span><br>
<div id="metodos_pago_list_SearchPanel">
<form name="fmetodos_pagolistsrch" id="fmetodos_pagolistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="metodos_pago">
<table class="ewBasicSearch">
	<tr>
		<td><span class="arenas">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($metodos_pago->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Buscar (*)">&nbsp;
			<a href="<?php echo $metodos_pago_list->PageUrl() ?>cmd=reset">Mostrar todos</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="arenas"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($metodos_pago->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Frase exacta</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($metodos_pago->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>Todas las palabras</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($metodos_pago->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Cualquier palabra</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $metodos_pago_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($metodos_pago->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($metodos_pago->CurrentAction <> "gridadd" && $metodos_pago->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($metodos_pago_list->Pager)) $metodos_pago_list->Pager = new cPrevNextPager($metodos_pago_list->lStartRec, $metodos_pago_list->lDisplayRecs, $metodos_pago_list->lTotalRecs) ?>
<?php if ($metodos_pago_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($metodos_pago_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_list->PageUrl() ?>start=<?php echo $metodos_pago_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($metodos_pago_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_list->PageUrl() ?>start=<?php echo $metodos_pago_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $metodos_pago_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($metodos_pago_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_list->PageUrl() ?>start=<?php echo $metodos_pago_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($metodos_pago_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_list->PageUrl() ?>start=<?php echo $metodos_pago_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $metodos_pago_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $metodos_pago_list->Pager->FromIndex ?> a <?php echo $metodos_pago_list->Pager->ToIndex ?> de <?php echo $metodos_pago_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($metodos_pago_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($metodos_pago_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="metodos_pago">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($metodos_pago_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($metodos_pago_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($metodos_pago_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($metodos_pago_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($metodos_pago_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($metodos_pago_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($metodos_pago->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $metodos_pago->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($metodos_pago_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fmetodos_pagolist)) alert('No se seleccionaron registros'); else {document.fmetodos_pagolist.action='metodos_pagodelete.php';document.fmetodos_pagolist.encoding='application/x-www-form-urlencoded';document.fmetodos_pagolist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fmetodos_pagolist" id="fmetodos_pagolist" class="ewForm" action="" method="post">
<?php if ($metodos_pago_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$metodos_pago_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$metodos_pago_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$metodos_pago_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$metodos_pago_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$metodos_pago_list->lOptionCnt++; // Multi-select
}
	$metodos_pago_list->lOptionCnt += count($metodos_pago_list->ListOptions->Items); // Custom list options
?>
<?php echo $metodos_pago->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($metodos_pago->id_metodo->Visible) { // id_metodo ?>
	<?php if ($metodos_pago->SortUrl($metodos_pago->id_metodo) == "") { ?>
		<td>Id Metodo</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $metodos_pago->SortUrl($metodos_pago->id_metodo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id Metodo</td><td style="width: 10px;"><?php if ($metodos_pago->id_metodo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($metodos_pago->id_metodo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($metodos_pago->metodo->Visible) { // metodo ?>
	<?php if ($metodos_pago->SortUrl($metodos_pago->metodo) == "") { ?>
		<td>Metodo</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $metodos_pago->SortUrl($metodos_pago->metodo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Metodo&nbsp;(*)</td><td style="width: 10px;"><?php if ($metodos_pago->metodo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($metodos_pago->metodo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($metodos_pago->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="arenas" onclick="metodos_pago_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($metodos_pago_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($metodos_pago->ExportAll && $metodos_pago->Export <> "") {
	$metodos_pago_list->lStopRec = $metodos_pago_list->lTotalRecs;
} else {
	$metodos_pago_list->lStopRec = $metodos_pago_list->lStartRec + $metodos_pago_list->lDisplayRecs - 1; // Set the last record to display
}
$metodos_pago_list->lRecCount = $metodos_pago_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$metodos_pago->SelectLimit && $metodos_pago_list->lStartRec > 1)
		$rs->Move($metodos_pago_list->lStartRec - 1);
}
$metodos_pago_list->lRowCnt = 0;
while (($metodos_pago->CurrentAction == "gridadd" || !$rs->EOF) &&
	$metodos_pago_list->lRecCount < $metodos_pago_list->lStopRec) {
	$metodos_pago_list->lRecCount++;
	if (intval($metodos_pago_list->lRecCount) >= intval($metodos_pago_list->lStartRec)) {
		$metodos_pago_list->lRowCnt++;

	// Init row class and style
	$metodos_pago->CssClass = "";
	$metodos_pago->CssStyle = "";
	$metodos_pago->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($metodos_pago->CurrentAction == "gridadd") {
		$metodos_pago_list->LoadDefaultValues(); // Load default values
	} else {
		$metodos_pago_list->LoadRowValues($rs); // Load row values
	}
	$metodos_pago->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$metodos_pago_list->RenderRow();
?>
	<tr<?php echo $metodos_pago->RowAttributes() ?>>
	<?php if ($metodos_pago->id_metodo->Visible) { // id_metodo ?>
		<td<?php echo $metodos_pago->id_metodo->CellAttributes() ?>>
<div<?php echo $metodos_pago->id_metodo->ViewAttributes() ?>><?php echo $metodos_pago->id_metodo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($metodos_pago->metodo->Visible) { // metodo ?>
		<td<?php echo $metodos_pago->metodo->CellAttributes() ?>>
<div<?php echo $metodos_pago->metodo->ViewAttributes() ?>><?php echo $metodos_pago->metodo->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($metodos_pago->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $metodos_pago->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $metodos_pago->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $metodos_pago->CopyUrl() ?>"><img src='images/copy.gif' alt='Copy' title='Copy' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($metodos_pago->id_metodo->CurrentValue) ?>" class="arenas" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($metodos_pago_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($metodos_pago->CurrentAction <> "gridadd")
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
<?php if ($metodos_pago_list->lTotalRecs > 0) { ?>
<?php if ($metodos_pago->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($metodos_pago->CurrentAction <> "gridadd" && $metodos_pago->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($metodos_pago_list->Pager)) $metodos_pago_list->Pager = new cPrevNextPager($metodos_pago_list->lStartRec, $metodos_pago_list->lDisplayRecs, $metodos_pago_list->lTotalRecs) ?>
<?php if ($metodos_pago_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($metodos_pago_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_list->PageUrl() ?>start=<?php echo $metodos_pago_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($metodos_pago_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_list->PageUrl() ?>start=<?php echo $metodos_pago_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $metodos_pago_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($metodos_pago_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_list->PageUrl() ?>start=<?php echo $metodos_pago_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($metodos_pago_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $metodos_pago_list->PageUrl() ?>start=<?php echo $metodos_pago_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $metodos_pago_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $metodos_pago_list->Pager->FromIndex ?> a <?php echo $metodos_pago_list->Pager->ToIndex ?> de <?php echo $metodos_pago_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($metodos_pago_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($metodos_pago_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="metodos_pago">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($metodos_pago_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($metodos_pago_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($metodos_pago_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($metodos_pago_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($metodos_pago_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($metodos_pago_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($metodos_pago->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($metodos_pago_list->lTotalRecs > 0) { ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $metodos_pago->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($metodos_pago_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fmetodos_pagolist)) alert('No se seleccionaron registros'); else {document.fmetodos_pagolist.action='metodos_pagodelete.php';document.fmetodos_pagolist.encoding='application/x-www-form-urlencoded';document.fmetodos_pagolist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($metodos_pago->Export == "" && $metodos_pago->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(metodos_pago_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($metodos_pago->Export == "") { ?>
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
class cmetodos_pago_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'metodos_pago';

	// Page Object Name
	var $PageObjName = 'metodos_pago_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $metodos_pago;
		if ($metodos_pago->UseTokenInUrl) $PageUrl .= "t=" . $metodos_pago->TableVar . "&"; // add page token
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
		global $objForm, $metodos_pago;
		if ($metodos_pago->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($metodos_pago->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($metodos_pago->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmetodos_pago_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["metodos_pago"] = new cmetodos_pago();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'metodos_pago', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $metodos_pago;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$metodos_pago->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $metodos_pago->Export; // Get export parameter, used in header
	$gsExportFile = $metodos_pago->TableVar; // Get export file, used in header
	if ($metodos_pago->Export == "print" || $metodos_pago->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($metodos_pago->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($metodos_pago->Export == "word") {
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
		global $objForm, $gsSearchError, $Security, $metodos_pago;
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
		if ($metodos_pago->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $metodos_pago->getRecordsPerPage(); // Restore from Session
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
		$metodos_pago->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$metodos_pago->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$metodos_pago->setStartRecordNumber($this->lStartRec);
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
		$metodos_pago->setSessionWhere($sFilter);
		$metodos_pago->CurrentFilter = "";

		// Export data only
		if (in_array($metodos_pago->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $metodos_pago;
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
			$metodos_pago->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$metodos_pago->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $metodos_pago;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $metodos_pago->metodo->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $metodos_pago;
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
			$metodos_pago->setBasicSearchKeyword($sSearchKeyword);
			$metodos_pago->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $metodos_pago;
		$this->sSrchWhere = "";
		$metodos_pago->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $metodos_pago;
		$metodos_pago->setBasicSearchKeyword("");
		$metodos_pago->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $metodos_pago;
		$this->sSrchWhere = $metodos_pago->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $metodos_pago;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$metodos_pago->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$metodos_pago->CurrentOrderType = @$_GET["ordertype"];
			$metodos_pago->UpdateSort($metodos_pago->id_metodo); // Field 
			$metodos_pago->UpdateSort($metodos_pago->metodo); // Field 
			$metodos_pago->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $metodos_pago;
		$sOrderBy = $metodos_pago->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($metodos_pago->SqlOrderBy() <> "") {
				$sOrderBy = $metodos_pago->SqlOrderBy();
				$metodos_pago->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $metodos_pago;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$metodos_pago->setSessionOrderBy($sOrderBy);
				$metodos_pago->id_metodo->setSort("");
				$metodos_pago->metodo->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$metodos_pago->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $metodos_pago;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$metodos_pago->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$metodos_pago->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $metodos_pago->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$metodos_pago->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$metodos_pago->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$metodos_pago->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $metodos_pago;

		// Call Recordset Selecting event
		$metodos_pago->Recordset_Selecting($metodos_pago->CurrentFilter);

		// Load list page SQL
		$sSql = $metodos_pago->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$metodos_pago->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $metodos_pago;
		$sFilter = $metodos_pago->KeyFilter();

		// Call Row Selecting event
		$metodos_pago->Row_Selecting($sFilter);

		// Load sql based on filter
		$metodos_pago->CurrentFilter = $sFilter;
		$sSql = $metodos_pago->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$metodos_pago->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $metodos_pago;
		$metodos_pago->id_metodo->setDbValue($rs->fields('id_metodo'));
		$metodos_pago->metodo->setDbValue($rs->fields('metodo'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $metodos_pago;

		// Call Row_Rendering event
		$metodos_pago->Row_Rendering();

		// Common render codes for all row types
		// id_metodo

		$metodos_pago->id_metodo->CellCssStyle = "";
		$metodos_pago->id_metodo->CellCssClass = "";

		// metodo
		$metodos_pago->metodo->CellCssStyle = "";
		$metodos_pago->metodo->CellCssClass = "";
		if ($metodos_pago->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_metodo
			$metodos_pago->id_metodo->ViewValue = $metodos_pago->id_metodo->CurrentValue;
			$metodos_pago->id_metodo->CssStyle = "";
			$metodos_pago->id_metodo->CssClass = "";
			$metodos_pago->id_metodo->ViewCustomAttributes = "";

			// metodo
			$metodos_pago->metodo->ViewValue = $metodos_pago->metodo->CurrentValue;
			$metodos_pago->metodo->CssStyle = "";
			$metodos_pago->metodo->CssClass = "";
			$metodos_pago->metodo->ViewCustomAttributes = "";

			// id_metodo
			$metodos_pago->id_metodo->HrefValue = "";

			// metodo
			$metodos_pago->metodo->HrefValue = "";
		}

		// Call Row Rendered event
		$metodos_pago->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $metodos_pago;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($metodos_pago->ExportAll) {
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
		if ($metodos_pago->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($metodos_pago->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $metodos_pago->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id_metodo', $metodos_pago->Export);
				ew_ExportAddValue($sExportStr, 'metodo', $metodos_pago->Export);
				echo ew_ExportLine($sExportStr, $metodos_pago->Export);
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
				$metodos_pago->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($metodos_pago->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id_metodo', $metodos_pago->id_metodo->CurrentValue);
					$XmlDoc->AddField('metodo', $metodos_pago->metodo->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $metodos_pago->Export <> "csv") { // Vertical format
						echo ew_ExportField('id_metodo', $metodos_pago->id_metodo->ExportValue($metodos_pago->Export, $metodos_pago->ExportOriginalValue), $metodos_pago->Export);
						echo ew_ExportField('metodo', $metodos_pago->metodo->ExportValue($metodos_pago->Export, $metodos_pago->ExportOriginalValue), $metodos_pago->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $metodos_pago->id_metodo->ExportValue($metodos_pago->Export, $metodos_pago->ExportOriginalValue), $metodos_pago->Export);
						ew_ExportAddValue($sExportStr, $metodos_pago->metodo->ExportValue($metodos_pago->Export, $metodos_pago->ExportOriginalValue), $metodos_pago->Export);
						echo ew_ExportLine($sExportStr, $metodos_pago->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($metodos_pago->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($metodos_pago->Export);
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
