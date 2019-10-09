<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "nominainfo.php" ?>
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
$nomina_list = new cnomina_list();
$Page =& $nomina_list;

// Page init processing
$nomina_list->Page_Init();

// Page main processing
$nomina_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($nomina->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var nomina_list = new ew_Page("nomina_list");

// page properties
nomina_list.PageID = "list"; // page ID
var EW_PAGE_ID = nomina_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
nomina_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
nomina_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
nomina_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
nomina_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($nomina->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($nomina->Export == "" && $nomina->SelectLimit);
	if (!$bSelectLimit)
		$rs = $nomina_list->LoadRecordset();
	$nomina_list->lTotalRecs = ($bSelectLimit) ? $nomina->SelectRecordCount() : $rs->RecordCount();
	$nomina_list->lStartRec = 1;
	if ($nomina_list->lDisplayRecs <= 0) // Display all records
		$nomina_list->lDisplayRecs = $nomina_list->lTotalRecs;
	if (!($nomina->ExportAll && $nomina->Export <> ""))
		$nomina_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $nomina_list->LoadRecordset($nomina_list->lStartRec-1, $nomina_list->lDisplayRecs);
?>
<p><span class="arenas" style="white-space: nowrap;">Modulo: Nomina
<?php if ($nomina->Export == "" && $nomina->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $nomina_list->PageUrl() ?>export=print"><img src='images/print.gif' alt='Printer Friendly' title='Printer Friendly' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $nomina_list->PageUrl() ?>export=excel"><img src='images/exportxls.gif' alt='Export to Excel' title='Export to Excel' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $nomina_list->PageUrl() ?>export=word"><img src='images/exportdoc.gif' alt='Export to Word' title='Export to Word' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($nomina->Export == "" && $nomina->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(nomina_list);" style="text-decoration: none;"><img id="nomina_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="arenas">&nbsp;Buscar</span><br>
<div id="nomina_list_SearchPanel">
<form name="fnominalistsrch" id="fnominalistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="nomina">
<table class="ewBasicSearch">
	<tr>
		<td><span class="arenas">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($nomina->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Buscar (*)">&nbsp;
			<a href="<?php echo $nomina_list->PageUrl() ?>cmd=reset">Mostrar todos</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="arenas"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($nomina->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Frase exacta</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($nomina->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>Todas las palabras</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($nomina->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Cualquier palabra</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $nomina_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($nomina->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($nomina->CurrentAction <> "gridadd" && $nomina->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($nomina_list->Pager)) $nomina_list->Pager = new cPrevNextPager($nomina_list->lStartRec, $nomina_list->lDisplayRecs, $nomina_list->lTotalRecs) ?>
<?php if ($nomina_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($nomina_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_list->PageUrl() ?>start=<?php echo $nomina_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($nomina_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_list->PageUrl() ?>start=<?php echo $nomina_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $nomina_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($nomina_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_list->PageUrl() ?>start=<?php echo $nomina_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($nomina_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_list->PageUrl() ?>start=<?php echo $nomina_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $nomina_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $nomina_list->Pager->FromIndex ?> a <?php echo $nomina_list->Pager->ToIndex ?> de <?php echo $nomina_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($nomina_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($nomina_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="nomina">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($nomina_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($nomina_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($nomina_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($nomina_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($nomina_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($nomina_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($nomina->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $nomina->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($nomina_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fnominalist)) alert('No se seleccionaron registros'); else {document.fnominalist.action='nominadelete.php';document.fnominalist.encoding='application/x-www-form-urlencoded';document.fnominalist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fnominalist" id="fnominalist" class="ewForm" action="" method="post">
<?php if ($nomina_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$nomina_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$nomina_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$nomina_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$nomina_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$nomina_list->lOptionCnt++; // Multi-select
}
	$nomina_list->lOptionCnt += count($nomina_list->ListOptions->Items); // Custom list options
?>
<?php echo $nomina->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($nomina->id_nomina->Visible) { // id_nomina ?>
	<?php if ($nomina->SortUrl($nomina->id_nomina) == "") { ?>
		<td>Id Nomina</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $nomina->SortUrl($nomina->id_nomina) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id Nomina</td><td style="width: 10px;"><?php if ($nomina->id_nomina->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($nomina->id_nomina->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($nomina->id_empresa->Visible) { // id_empresa ?>
	<?php if ($nomina->SortUrl($nomina->id_empresa) == "") { ?>
		<td>Id Empresa</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $nomina->SortUrl($nomina->id_empresa) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id Empresa</td><td style="width: 10px;"><?php if ($nomina->id_empresa->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($nomina->id_empresa->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($nomina->empleado->Visible) { // empleado ?>
	<?php if ($nomina->SortUrl($nomina->empleado) == "") { ?>
		<td>Empleado</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $nomina->SortUrl($nomina->empleado) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Empleado</td><td style="width: 10px;"><?php if ($nomina->empleado->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($nomina->empleado->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($nomina->monto_pago->Visible) { // monto_pago ?>
	<?php if ($nomina->SortUrl($nomina->monto_pago) == "") { ?>
		<td>Pago quincenal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $nomina->SortUrl($nomina->monto_pago) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Pago quincenal</td><td style="width: 10px;"><?php if ($nomina->monto_pago->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($nomina->monto_pago->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($nomina->deducible_afp->Visible) { // deducible_afp ?>
	<?php if ($nomina->SortUrl($nomina->deducible_afp) == "") { ?>
		<td>Deducible Afp</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $nomina->SortUrl($nomina->deducible_afp) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Deducible Afp</td><td style="width: 10px;"><?php if ($nomina->deducible_afp->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($nomina->deducible_afp->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($nomina->deducible_sf->Visible) { // deducible_sf ?>
	<?php if ($nomina->SortUrl($nomina->deducible_sf) == "") { ?>
		<td>Deducible Sf</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $nomina->SortUrl($nomina->deducible_sf) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Deducible Sf</td><td style="width: 10px;"><?php if ($nomina->deducible_sf->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($nomina->deducible_sf->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($nomina->fecha->Visible) { // fecha ?>
	<?php if ($nomina->SortUrl($nomina->fecha) == "") { ?>
		<td>Fecha</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $nomina->SortUrl($nomina->fecha) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Fecha</td><td style="width: 10px;"><?php if ($nomina->fecha->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($nomina->fecha->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($nomina->notas->Visible) { // notas ?>
	<?php if ($nomina->SortUrl($nomina->notas) == "") { ?>
		<td>Notas</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $nomina->SortUrl($nomina->notas) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Notas&nbsp;(*)</td><td style="width: 10px;"><?php if ($nomina->notas->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($nomina->notas->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($nomina->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="arenas" onclick="nomina_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($nomina_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($nomina->ExportAll && $nomina->Export <> "") {
	$nomina_list->lStopRec = $nomina_list->lTotalRecs;
} else {
	$nomina_list->lStopRec = $nomina_list->lStartRec + $nomina_list->lDisplayRecs - 1; // Set the last record to display
}
$nomina_list->lRecCount = $nomina_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$nomina->SelectLimit && $nomina_list->lStartRec > 1)
		$rs->Move($nomina_list->lStartRec - 1);
}
$nomina->monto_pago->Total = 0; // Initialize total to zero for aggregation
$nomina->deducible_afp->Total = 0; // Initialize total to zero for aggregation
$nomina->deducible_sf->Total = 0; // Initialize total to zero for aggregation
$nomina_list->lRowCnt = 0;
while (($nomina->CurrentAction == "gridadd" || !$rs->EOF) &&
	$nomina_list->lRecCount < $nomina_list->lStopRec) {
	$nomina_list->lRecCount++;
	if (intval($nomina_list->lRecCount) >= intval($nomina_list->lStartRec)) {
		$nomina_list->lRowCnt++;

	// Init row class and style
	$nomina->CssClass = "";
	$nomina->CssStyle = "";
	$nomina->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($nomina->CurrentAction == "gridadd") {
		$nomina_list->LoadDefaultValues(); // Load default values
	} else {
		$nomina_list->LoadRowValues($rs); // Load row values
	}
	if (is_numeric($nomina->monto_pago->CurrentValue)) $nomina->monto_pago->Total += $nomina->monto_pago->CurrentValue; // Accumulate total
	if (is_numeric($nomina->deducible_afp->CurrentValue)) $nomina->deducible_afp->Total += $nomina->deducible_afp->CurrentValue; // Accumulate total
	if (is_numeric($nomina->deducible_sf->CurrentValue)) $nomina->deducible_sf->Total += $nomina->deducible_sf->CurrentValue; // Accumulate total
	$nomina->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$nomina_list->RenderRow();
?>
	<tr<?php echo $nomina->RowAttributes() ?>>
	<?php if ($nomina->id_nomina->Visible) { // id_nomina ?>
		<td<?php echo $nomina->id_nomina->CellAttributes() ?>>
<div<?php echo $nomina->id_nomina->ViewAttributes() ?>><?php echo $nomina->id_nomina->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($nomina->id_empresa->Visible) { // id_empresa ?>
		<td<?php echo $nomina->id_empresa->CellAttributes() ?>>
<div<?php echo $nomina->id_empresa->ViewAttributes() ?>><?php echo $nomina->id_empresa->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($nomina->empleado->Visible) { // empleado ?>
		<td<?php echo $nomina->empleado->CellAttributes() ?>>
<div<?php echo $nomina->empleado->ViewAttributes() ?>><?php echo $nomina->empleado->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($nomina->monto_pago->Visible) { // monto_pago ?>
		<td<?php echo $nomina->monto_pago->CellAttributes() ?>>
<div<?php echo $nomina->monto_pago->ViewAttributes() ?>><?php echo $nomina->monto_pago->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($nomina->deducible_afp->Visible) { // deducible_afp ?>
		<td<?php echo $nomina->deducible_afp->CellAttributes() ?>>
<div<?php echo $nomina->deducible_afp->ViewAttributes() ?>><?php echo $nomina->deducible_afp->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($nomina->deducible_sf->Visible) { // deducible_sf ?>
		<td<?php echo $nomina->deducible_sf->CellAttributes() ?>>
<div<?php echo $nomina->deducible_sf->ViewAttributes() ?>><?php echo $nomina->deducible_sf->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($nomina->fecha->Visible) { // fecha ?>
		<td<?php echo $nomina->fecha->CellAttributes() ?>>
<div<?php echo $nomina->fecha->ViewAttributes() ?>><?php echo $nomina->fecha->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($nomina->notas->Visible) { // notas ?>
		<td<?php echo $nomina->notas->CellAttributes() ?>>
<div<?php echo $nomina->notas->ViewAttributes() ?>><?php echo $nomina->notas->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($nomina->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $nomina->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $nomina->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<a href="<?php echo $nomina->CopyUrl() ?>"><img src='images/copy.gif' alt='Copy' title='Copy' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="arenas">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($nomina->id_nomina->CurrentValue) ?>" class="arenas" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($nomina_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($nomina->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
<?php
$nomina->monto_pago->CurrentValue = $nomina->monto_pago->Total;
$nomina->monto_pago->ViewValue = $nomina->monto_pago->CurrentValue;
if (strval($nomina->monto_pago->CurrentValue) <> "") {
	$sSqlWrk = "SELECT `salario_quincenal` FROM `empleados` WHERE `salario_quincenal` = " . ew_AdjustSql($nomina->monto_pago->CurrentValue) . "";
	$rswrk = $conn->Execute($sSqlWrk);
	if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
		$nomina->monto_pago->ViewValue = $rswrk->fields('salario_quincenal');
		$rswrk->Close();
	} else {
		$nomina->monto_pago->ViewValue = $nomina->monto_pago->CurrentValue;
	}
} else {
	$nomina->monto_pago->ViewValue = NULL;
}
$nomina->monto_pago->CssStyle = "";
$nomina->monto_pago->CssClass = "";
$nomina->monto_pago->ViewCustomAttributes = "";
$nomina->monto_pago->HrefValue = ""; // Clear href value
$nomina->deducible_afp->CurrentValue = $nomina->deducible_afp->Total;
$nomina->deducible_afp->ViewValue = $nomina->deducible_afp->CurrentValue;
if (strval($nomina->deducible_afp->CurrentValue) <> "") {
	$sSqlWrk = "SELECT `deducible_afp` FROM `empleados` WHERE `deducible_afp` = " . ew_AdjustSql($nomina->deducible_afp->CurrentValue) . "";
	$rswrk = $conn->Execute($sSqlWrk);
	if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
		$nomina->deducible_afp->ViewValue = $rswrk->fields('deducible_afp');
		$rswrk->Close();
	} else {
		$nomina->deducible_afp->ViewValue = $nomina->deducible_afp->CurrentValue;
	}
} else {
	$nomina->deducible_afp->ViewValue = NULL;
}
$nomina->deducible_afp->CssStyle = "";
$nomina->deducible_afp->CssClass = "";
$nomina->deducible_afp->ViewCustomAttributes = "";
$nomina->deducible_afp->HrefValue = ""; // Clear href value
$nomina->deducible_sf->CurrentValue = $nomina->deducible_sf->Total;
$nomina->deducible_sf->ViewValue = $nomina->deducible_sf->CurrentValue;
if (strval($nomina->deducible_sf->CurrentValue) <> "") {
	$sSqlWrk = "SELECT `deducible_sf` FROM `empleados` WHERE `deducible_sf` = " . ew_AdjustSql($nomina->deducible_sf->CurrentValue) . "";
	$rswrk = $conn->Execute($sSqlWrk);
	if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
		$nomina->deducible_sf->ViewValue = $rswrk->fields('deducible_sf');
		$rswrk->Close();
	} else {
		$nomina->deducible_sf->ViewValue = $nomina->deducible_sf->CurrentValue;
	}
} else {
	$nomina->deducible_sf->ViewValue = NULL;
}
$nomina->deducible_sf->CssStyle = "";
$nomina->deducible_sf->CssClass = "";
$nomina->deducible_sf->ViewCustomAttributes = "";
$nomina->deducible_sf->HrefValue = ""; // Clear href value
?>
<?php if ($nomina_list->lTotalRecs > 0) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
	<?php if ($nomina->id_nomina->Visible) { // id_nomina ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($nomina->id_empresa->Visible) { // id_empresa ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($nomina->empleado->Visible) { // empleado ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($nomina->monto_pago->Visible) { // monto_pago ?>
		<td>
		Total: 
<div<?php echo $nomina->monto_pago->ViewAttributes() ?>><?php echo $nomina->monto_pago->ViewValue ?></div>
		</td>
	<?php } ?>
	<?php if ($nomina->deducible_afp->Visible) { // deducible_afp ?>
		<td>
		Total: 
<div<?php echo $nomina->deducible_afp->ViewAttributes() ?>><?php echo $nomina->deducible_afp->ViewValue ?></div>
		</td>
	<?php } ?>
	<?php if ($nomina->deducible_sf->Visible) { // deducible_sf ?>
		<td>
		Total: 
<div<?php echo $nomina->deducible_sf->ViewAttributes() ?>><?php echo $nomina->deducible_sf->ViewValue ?></div>
		</td>
	<?php } ?>
	<?php if ($nomina->fecha->Visible) { // fecha ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($nomina->notas->Visible) { // notas ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
<?php if ($nomina->Export == "") { ?>
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
foreach ($nomina_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->FooterCellHtml;
}
?>
<?php } ?>
	</tr>
</tfoot>	
<?php } ?>
</table>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($nomina_list->lTotalRecs > 0) { ?>
<?php if ($nomina->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($nomina->CurrentAction <> "gridadd" && $nomina->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($nomina_list->Pager)) $nomina_list->Pager = new cPrevNextPager($nomina_list->lStartRec, $nomina_list->lDisplayRecs, $nomina_list->lTotalRecs) ?>
<?php if ($nomina_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="arenas">Pag&nbsp;</span></td>
<!--first page button-->
	<?php if ($nomina_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_list->PageUrl() ?>start=<?php echo $nomina_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($nomina_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_list->PageUrl() ?>start=<?php echo $nomina_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $nomina_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($nomina_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_list->PageUrl() ?>start=<?php echo $nomina_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($nomina_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $nomina_list->PageUrl() ?>start=<?php echo $nomina_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="arenas">&nbsp;de <?php echo $nomina_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="arenas">Registros <?php echo $nomina_list->Pager->FromIndex ?> a <?php echo $nomina_list->Pager->ToIndex ?> de <?php echo $nomina_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($nomina_list->sSrchWhere == "0=101") { ?>
	<span class="arenas">Ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="arenas">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($nomina_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Tamaño de pagina&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="nomina">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="arenas">
<option value="20"<?php if ($nomina_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="25"<?php if ($nomina_list->lDisplayRecs == 25) { ?> selected="selected"<?php } ?>>25</option>
<option value="50"<?php if ($nomina_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="75"<?php if ($nomina_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($nomina_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($nomina_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="ALL"<?php if ($nomina->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>>Todo</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($nomina_list->lTotalRecs > 0) { ?>
<span class="arenas">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $nomina->AddUrl() ?>">Agregar</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($nomina_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fnominalist)) alert('No se seleccionaron registros'); else {document.fnominalist.action='nominadelete.php';document.fnominalist.encoding='application/x-www-form-urlencoded';document.fnominalist.submit();};return false;">Eliminar los registros seleccionados</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($nomina->Export == "" && $nomina->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(nomina_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($nomina->Export == "") { ?>
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
class cnomina_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'nomina';

	// Page Object Name
	var $PageObjName = 'nomina_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $nomina;
		if ($nomina->UseTokenInUrl) $PageUrl .= "t=" . $nomina->TableVar . "&"; // add page token
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
		global $objForm, $nomina;
		if ($nomina->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($nomina->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($nomina->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cnomina_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["nomina"] = new cnomina();

		// Initialize other table object
		$GLOBALS['usuarios'] = new cusuarios();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'nomina', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $nomina;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$nomina->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $nomina->Export; // Get export parameter, used in header
	$gsExportFile = $nomina->TableVar; // Get export file, used in header
	if ($nomina->Export == "print" || $nomina->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($nomina->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($nomina->Export == "word") {
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
		global $objForm, $gsSearchError, $Security, $nomina;
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
		if ($nomina->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $nomina->getRecordsPerPage(); // Restore from Session
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
		$nomina->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$nomina->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$nomina->setStartRecordNumber($this->lStartRec);
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
		$nomina->setSessionWhere($sFilter);
		$nomina->CurrentFilter = "";

		// Export data only
		if (in_array($nomina->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $nomina;
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
			$nomina->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$nomina->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $nomina;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $nomina->notas->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $nomina;
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
			$nomina->setBasicSearchKeyword($sSearchKeyword);
			$nomina->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $nomina;
		$this->sSrchWhere = "";
		$nomina->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $nomina;
		$nomina->setBasicSearchKeyword("");
		$nomina->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $nomina;
		$this->sSrchWhere = $nomina->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $nomina;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$nomina->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$nomina->CurrentOrderType = @$_GET["ordertype"];
			$nomina->UpdateSort($nomina->id_nomina); // Field 
			$nomina->UpdateSort($nomina->id_empresa); // Field 
			$nomina->UpdateSort($nomina->empleado); // Field 
			$nomina->UpdateSort($nomina->monto_pago); // Field 
			$nomina->UpdateSort($nomina->deducible_afp); // Field 
			$nomina->UpdateSort($nomina->deducible_sf); // Field 
			$nomina->UpdateSort($nomina->fecha); // Field 
			$nomina->UpdateSort($nomina->notas); // Field 
			$nomina->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $nomina;
		$sOrderBy = $nomina->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($nomina->SqlOrderBy() <> "") {
				$sOrderBy = $nomina->SqlOrderBy();
				$nomina->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $nomina;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$nomina->setSessionOrderBy($sOrderBy);
				$nomina->id_nomina->setSort("");
				$nomina->id_empresa->setSort("");
				$nomina->empleado->setSort("");
				$nomina->monto_pago->setSort("");
				$nomina->deducible_afp->setSort("");
				$nomina->deducible_sf->setSort("");
				$nomina->fecha->setSort("");
				$nomina->notas->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$nomina->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $nomina;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$nomina->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$nomina->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $nomina->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$nomina->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$nomina->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$nomina->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $nomina;

		// Call Recordset Selecting event
		$nomina->Recordset_Selecting($nomina->CurrentFilter);

		// Load list page SQL
		$sSql = $nomina->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$nomina->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $nomina;
		$sFilter = $nomina->KeyFilter();

		// Call Row Selecting event
		$nomina->Row_Selecting($sFilter);

		// Load sql based on filter
		$nomina->CurrentFilter = $sFilter;
		$sSql = $nomina->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$nomina->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $nomina;
		$nomina->id_nomina->setDbValue($rs->fields('id_nomina'));
		$nomina->id_empresa->setDbValue($rs->fields('id_empresa'));
		$nomina->empleado->setDbValue($rs->fields('empleado'));
		$nomina->monto_pago->setDbValue($rs->fields('monto_pago'));
		$nomina->deducible_afp->setDbValue($rs->fields('deducible_afp'));
		$nomina->deducible_sf->setDbValue($rs->fields('deducible_sf'));
		$nomina->fecha->setDbValue($rs->fields('fecha'));
		$nomina->notas->setDbValue($rs->fields('notas'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $nomina;

		// Call Row_Rendering event
		$nomina->Row_Rendering();

		// Common render codes for all row types
		// id_nomina

		$nomina->id_nomina->CellCssStyle = "";
		$nomina->id_nomina->CellCssClass = "";

		// id_empresa
		$nomina->id_empresa->CellCssStyle = "";
		$nomina->id_empresa->CellCssClass = "";

		// empleado
		$nomina->empleado->CellCssStyle = "";
		$nomina->empleado->CellCssClass = "";

		// monto_pago
		$nomina->monto_pago->CellCssStyle = "";
		$nomina->monto_pago->CellCssClass = "";

		// deducible_afp
		$nomina->deducible_afp->CellCssStyle = "";
		$nomina->deducible_afp->CellCssClass = "";

		// deducible_sf
		$nomina->deducible_sf->CellCssStyle = "";
		$nomina->deducible_sf->CellCssClass = "";

		// fecha
		$nomina->fecha->CellCssStyle = "";
		$nomina->fecha->CellCssClass = "";

		// notas
		$nomina->notas->CellCssStyle = "";
		$nomina->notas->CellCssClass = "";
		if ($nomina->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_nomina
			$nomina->id_nomina->ViewValue = $nomina->id_nomina->CurrentValue;
			$nomina->id_nomina->CssStyle = "";
			$nomina->id_nomina->CssClass = "";
			$nomina->id_nomina->ViewCustomAttributes = "";

			// id_empresa
			if (strval($nomina->id_empresa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre` FROM `empresas` WHERE `id_empresa` = " . ew_AdjustSql($nomina->id_empresa->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$nomina->id_empresa->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$nomina->id_empresa->ViewValue = $nomina->id_empresa->CurrentValue;
				}
			} else {
				$nomina->id_empresa->ViewValue = NULL;
			}
			$nomina->id_empresa->CssStyle = "";
			$nomina->id_empresa->CssClass = "";
			$nomina->id_empresa->ViewCustomAttributes = "";

			// empleado
			if (strval($nomina->empleado->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nombre_completo` FROM `empleados` WHERE `id_empleado` = " . ew_AdjustSql($nomina->empleado->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$nomina->empleado->ViewValue = $rswrk->fields('nombre_completo');
					$rswrk->Close();
				} else {
					$nomina->empleado->ViewValue = $nomina->empleado->CurrentValue;
				}
			} else {
				$nomina->empleado->ViewValue = NULL;
			}
			$nomina->empleado->CssStyle = "";
			$nomina->empleado->CssClass = "";
			$nomina->empleado->ViewCustomAttributes = "";

			// monto_pago
			if (strval($nomina->monto_pago->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `salario_quincenal` FROM `empleados` WHERE `salario_quincenal` = " . ew_AdjustSql($nomina->monto_pago->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$nomina->monto_pago->ViewValue = $rswrk->fields('salario_quincenal');
					$rswrk->Close();
				} else {
					$nomina->monto_pago->ViewValue = $nomina->monto_pago->CurrentValue;
				}
			} else {
				$nomina->monto_pago->ViewValue = NULL;
			}
			$nomina->monto_pago->CssStyle = "";
			$nomina->monto_pago->CssClass = "";
			$nomina->monto_pago->ViewCustomAttributes = "";

			// deducible_afp
			if (strval($nomina->deducible_afp->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `deducible_afp` FROM `empleados` WHERE `deducible_afp` = " . ew_AdjustSql($nomina->deducible_afp->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$nomina->deducible_afp->ViewValue = $rswrk->fields('deducible_afp');
					$rswrk->Close();
				} else {
					$nomina->deducible_afp->ViewValue = $nomina->deducible_afp->CurrentValue;
				}
			} else {
				$nomina->deducible_afp->ViewValue = NULL;
			}
			$nomina->deducible_afp->CssStyle = "";
			$nomina->deducible_afp->CssClass = "";
			$nomina->deducible_afp->ViewCustomAttributes = "";

			// deducible_sf
			if (strval($nomina->deducible_sf->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `deducible_sf` FROM `empleados` WHERE `deducible_sf` = " . ew_AdjustSql($nomina->deducible_sf->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$nomina->deducible_sf->ViewValue = $rswrk->fields('deducible_sf');
					$rswrk->Close();
				} else {
					$nomina->deducible_sf->ViewValue = $nomina->deducible_sf->CurrentValue;
				}
			} else {
				$nomina->deducible_sf->ViewValue = NULL;
			}
			$nomina->deducible_sf->CssStyle = "";
			$nomina->deducible_sf->CssClass = "";
			$nomina->deducible_sf->ViewCustomAttributes = "";

			// fecha
			$nomina->fecha->ViewValue = $nomina->fecha->CurrentValue;
			$nomina->fecha->ViewValue = ew_FormatDateTime($nomina->fecha->ViewValue, 7);
			$nomina->fecha->CssStyle = "";
			$nomina->fecha->CssClass = "";
			$nomina->fecha->ViewCustomAttributes = "";

			// notas
			$nomina->notas->ViewValue = $nomina->notas->CurrentValue;
			$nomina->notas->CssStyle = "";
			$nomina->notas->CssClass = "";
			$nomina->notas->ViewCustomAttributes = "";

			// id_nomina
			$nomina->id_nomina->HrefValue = "";

			// id_empresa
			$nomina->id_empresa->HrefValue = "";

			// empleado
			$nomina->empleado->HrefValue = "";

			// monto_pago
			$nomina->monto_pago->HrefValue = "";

			// deducible_afp
			$nomina->deducible_afp->HrefValue = "";

			// deducible_sf
			$nomina->deducible_sf->HrefValue = "";

			// fecha
			$nomina->fecha->HrefValue = "";

			// notas
			$nomina->notas->HrefValue = "";
		}

		// Call Row Rendered event
		$nomina->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $nomina;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($nomina->ExportAll) {
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
		if ($nomina->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($nomina->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $nomina->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id_nomina', $nomina->Export);
				ew_ExportAddValue($sExportStr, 'id_empresa', $nomina->Export);
				ew_ExportAddValue($sExportStr, 'empleado', $nomina->Export);
				ew_ExportAddValue($sExportStr, 'monto_pago', $nomina->Export);
				ew_ExportAddValue($sExportStr, 'deducible_afp', $nomina->Export);
				ew_ExportAddValue($sExportStr, 'deducible_sf', $nomina->Export);
				ew_ExportAddValue($sExportStr, 'fecha', $nomina->Export);
				ew_ExportAddValue($sExportStr, 'notas', $nomina->Export);
				echo ew_ExportLine($sExportStr, $nomina->Export);
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
				$nomina->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($nomina->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id_nomina', $nomina->id_nomina->CurrentValue);
					$XmlDoc->AddField('id_empresa', $nomina->id_empresa->CurrentValue);
					$XmlDoc->AddField('empleado', $nomina->empleado->CurrentValue);
					$XmlDoc->AddField('monto_pago', $nomina->monto_pago->CurrentValue);
					$XmlDoc->AddField('deducible_afp', $nomina->deducible_afp->CurrentValue);
					$XmlDoc->AddField('deducible_sf', $nomina->deducible_sf->CurrentValue);
					$XmlDoc->AddField('fecha', $nomina->fecha->CurrentValue);
					$XmlDoc->AddField('notas', $nomina->notas->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $nomina->Export <> "csv") { // Vertical format
						echo ew_ExportField('id_nomina', $nomina->id_nomina->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
						echo ew_ExportField('id_empresa', $nomina->id_empresa->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
						echo ew_ExportField('empleado', $nomina->empleado->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
						echo ew_ExportField('monto_pago', $nomina->monto_pago->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
						echo ew_ExportField('deducible_afp', $nomina->deducible_afp->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
						echo ew_ExportField('deducible_sf', $nomina->deducible_sf->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
						echo ew_ExportField('fecha', $nomina->fecha->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
						echo ew_ExportField('notas', $nomina->notas->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $nomina->id_nomina->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
						ew_ExportAddValue($sExportStr, $nomina->id_empresa->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
						ew_ExportAddValue($sExportStr, $nomina->empleado->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
						ew_ExportAddValue($sExportStr, $nomina->monto_pago->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
						ew_ExportAddValue($sExportStr, $nomina->deducible_afp->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
						ew_ExportAddValue($sExportStr, $nomina->deducible_sf->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
						ew_ExportAddValue($sExportStr, $nomina->fecha->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
						ew_ExportAddValue($sExportStr, $nomina->notas->ExportValue($nomina->Export, $nomina->ExportOriginalValue), $nomina->Export);
						echo ew_ExportLine($sExportStr, $nomina->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($nomina->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($nomina->Export);
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
